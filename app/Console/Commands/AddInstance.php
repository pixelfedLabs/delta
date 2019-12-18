<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Instance;
use \Zttp\Zttp;

class AddInstance extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'instance:add {domain}';

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
        $domain = $this->argument('domain');

        $validator = dns_get_record($domain);

        if(count($validator) == 0) {
            $this->error('invalid domain');
            return;
        }

        $url = "https://{$domain}/api/nodeinfo/2.0.json";
        $response = Zttp::get($url);
        $json = $response->json();
        if($response->status() != 200 || $json['software']['name'] != 'pixelfed') {
            $this->error('invalid response');
            return;
        }

        $instance = Instance::firstOrCreate(['name' => $domain, 'domain' => $domain]);

        if($this->confirm('Do you want to approve this instance?')) {
            $instance->approved_at = now();
            $instance->save();
        }

        $this->info("Added new instance: {$domain}!");
        $this->call('instance:fetch', ['domain' => $instance->domain]);
    }
}
