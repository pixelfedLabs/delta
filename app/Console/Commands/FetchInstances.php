<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Instance;

class FetchInstances extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'instance:fetchall';

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
        $instances = Instance::whereNotNull('approved_at')->get();

        foreach($instances as $instance) {
            $this->call('instance:fetch', ['domain' => $instance->domain]);
        }
    }
}
