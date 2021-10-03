<?php

namespace Adminetic\Blog\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class AdmineticBlogPermissionCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'adminetic:blog-permission';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to create blog module permission flags.';

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
     * @return int
     */
    public function handle()
    {
        Artisan::call('make:permission Post --all');
        $this->info('Client Module Permission Created ... ✅');
        Artisan::call('make:permission Template --all');
        $this->info('Template Module Permission Created ... ✅');
        $this->info('Star to the admenictic repo would be appreciated.');
    }
}
