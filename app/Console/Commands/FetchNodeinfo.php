<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use \Zttp\Zttp;
use App\Instance;

class FetchNodeinfo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'instance:fetch {domain}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch Instance Nodeinfo';

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
        $domain = $this->argument('domain');

        $validator = dns_get_record($domain);

        if(count($validator) == 0) {
            $this->error('invalid domain');
            return;
        }
        $url = "https://{$domain}/api/nodeinfo/2.0.json";
        $response = Zttp::get($url);
        if($response->status() != 200) {
            $this->error('invalid response');
            return;
        }
        $body = $response->body();
        $json = $response->json();
        $instance = Instance::whereDomain($domain)->firstOrFail();
        $instance->nodeinfo = $body;
        $instance->user_count = $json['usage']['users']['total'];
        $instance->post_count = $json['usage']['localPosts'];
        $instance->save();
    }
}
