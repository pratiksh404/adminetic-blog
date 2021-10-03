<?php

namespace Adminetic\Blog\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class AdmineticBlogInstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'install:adminetic-blog';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to install adminetic blog.';

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
        Artisan::call('adminetic:blog-permission');
        $this->info('Blog Modules Permission Created ... ✅');
        Artisan::call('vendor:publish --provider="CyrildeWit\EloquentViewable\EloquentViewableServiceProvider" --tag="migrations"');
        $this->info('Adminetic Blog Installed.');
        $this->info('Star to the admenictic repo would be appreciated.');
    }
}
