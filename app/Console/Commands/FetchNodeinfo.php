<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use \Zttp\Zttp;
use App\Instance;
use App\InstanceScan;

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

        // $validator = dns_get_record($domain);

        // if(count($validator) == 0) {
        //     $this->error('invalid domain');
        //     return;
        // }
        $url = "https://{$domain}/api/nodeinfo/2.0.json";
        $response = Zttp::get($url);
        $body = $response->body();
        $json = $response->json();
        $instance = Instance::whereDomain($domain)->firstOrFail();
        if($response->status() != 200 || $json['software']['name'] != 'pixelfed') {
            $instance->approved_at = null;
            $instance->save();
            // todo: remove instance after XX attempts
            $this->error('invalid response');
            return;
        }
        $instance->nodeinfo = $body;
        $instance->user_count = $json['usage']['users']['total'];
        $instance->post_count = $json['usage']['localPosts'];
        $instance->save();

        $scan = new InstanceScan;
        $scan->code = $response->status();
        $scan->instance_id = $instance->id;
        $scan->domain = $instance->domain;
        $scan->user_count = $instance->user_count;
        $scan->post_count = $instance->post_count;
        $scan->nodeinfo = $body;
        $scan->save();
    }
}
