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
        $url = "https://{$domain}/api/nodeinfo/2.0.json";

        try {
            $response = Zttp::timeout(60)->get($url);
        } catch (\Zttp\ConnectionException $e) {
            $instance = Instance::whereDomain($host)->first();
            if($instance) {
                $instance->approved_at = null;
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
            return 1;
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            $instance = Instance::whereDomain($host)->first();
            if($instance) {
                $instance->approved_at = null;
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
            return 1;
        }
        $body = $response->body();
        $json = $response->json();
        $instance = Instance::whereDomain($domain)->firstOrFail();
        if($response->status() != 200 || $json['software']['name'] != 'pixelfed' || $json['openRegistrations'] == false) {
            $instance->approved_at = null;
            $instance->save();
            // todo: remove instance after XX attempts
            $this->error('invalid response');
            return 1;
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

        return 1;
    }
}
