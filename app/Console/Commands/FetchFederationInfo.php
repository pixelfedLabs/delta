<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Zttp\Zttp;
use App\Instance;
use GuzzleHttp\Exception\RequestException;

class FetchFederationInfo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'instance:federation';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $url = 'https://the-federation.info/graphql?query=query%20Platform(%24name%3A%20String!)%20%7B%0A%20%20platforms(name%3A%20%24name)%20%7B%0A%20%20%20%20name%0A%20%20%20%20code%0A%20%20%20%20displayName%0A%20%20%20%20description%0A%20%20%20%20tagline%0A%20%20%20%20website%0A%20%20%20%20icon%0A%20%20%20%20__typename%0A%20%20%7D%0A%20%20nodes(platform%3A%20%24name)%20%7B%0A%20%20%20%20id%0A%20%20%20%20name%0A%20%20%20%20version%0A%20%20%20%20openSignups%0A%20%20%20%20host%0A%20%20%20%20platform%20%7B%0A%20%20%20%20%20%20name%0A%20%20%20%20%20%20icon%0A%20%20%20%20%20%20__typename%0A%20%20%20%20%7D%0A%20%20%20%20countryCode%0A%20%20%20%20countryFlag%0A%20%20%20%20countryName%0A%20%20%20%20services%20%7B%0A%20%20%20%20%20%20name%0A%20%20%20%20%20%20__typename%0A%20%20%20%20%7D%0A%20%20%20%20__typename%0A%20%20%7D%0A%20%20statsGlobalToday(platform%3A%20%24name)%20%7B%0A%20%20%20%20usersTotal%0A%20%20%20%20usersHalfYear%0A%20%20%20%20usersMonthly%0A%20%20%20%20localPosts%0A%20%20%20%20localComments%0A%20%20%20%20__typename%0A%20%20%7D%0A%20%20statsNodes(platform%3A%20%24name)%20%7B%0A%20%20%20%20node%20%7B%0A%20%20%20%20%20%20id%0A%20%20%20%20%20%20__typename%0A%20%20%20%20%7D%0A%20%20%20%20usersTotal%0A%20%20%20%20usersHalfYear%0A%20%20%20%20usersMonthly%0A%20%20%20%20localPosts%0A%20%20%20%20localComments%0A%20%20%20%20__typename%0A%20%20%7D%0A%7D%0A&operationName=Platform&variables=%7B%22name%22%3A%22pixelfed%22%7D';

        $res = Zttp::accept('application/json')->get($url);
        $b = $res->json();
        if(!$b) {
            return;
        }
        foreach($b['data']['nodes'] as $n) {
            $host = $n['host'];
            if(in_array($host, ['comfybyte.ga'])) {
                continue;
            }
            $this->info("checking {$host}");
            if(count(dns_get_record($host, DNS_A)) < 1) {
                continue;
            }
            if(Instance::whereDomain($host)->exists()) {
                continue;
            }
            try {
                $t = Zttp::withOptions(['http_errors' => 0, 'verify' => 0])->get("https://{$host}/api/nodeinfo/2.0.json");
                if($t->isOk()) {
                    $i = Instance::firstOrCreate(['name' => $host, 'domain' => $host]);
                    $i->approved_at = now();
                    $i->save();
                    $this->call('instance:fetch', ['domain' => $host]);
                    $this->info($host);
                }
            } catch (RequestException $e) {
                continue;
            }
        }
        return;
    }
}
