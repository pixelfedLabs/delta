<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ApproveInstance extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'instance:approve {domain}';

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

        $instance = Instance::whereDomain($domain)->firstOrFail();
        $instance->approved_at = now();
        $instance->save();

        $this->info("Instance {$domain} was successfully appproved.");
    }
}
