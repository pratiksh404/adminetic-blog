<?php

namespace Adminetic\Blog\Provider;

use Livewire\Livewire;
use Illuminate\Support\Facades\Gate;
use Adminetic\Blog\Models\Admin\Post;
use Illuminate\Support\Facades\Route;
use Adminetic\Blog\Policies\PostPolicy;
use Illuminate\Support\ServiceProvider;
use Adminetic\Blog\Models\Admin\Template;
use Adminetic\Blog\Policies\TemplatePolicy;
use Adminetic\Blog\View\Components\Dashboard;
use Adminetic\Blog\Repositories\PostRepository;
use Adminetic\Blog\Repositories\TemplateRepository;
use Adminetic\Blog\Contracts\PostRepositoryInterface;
use Adminetic\Blog\Http\Livewire\Admin\Post\PostsTable;
use Adminetic\Blog\Http\Livewire\Admin\Post\PostStatus;
use Adminetic\Blog\Contracts\TemplateRepositoryInterface;
use Adminetic\Blog\Http\Livewire\Admin\Post\PostFeatured;
use Adminetic\Blog\Http\Livewire\Admin\Post\PostPriority;
use Adminetic\Blog\Console\Commands\AdmineticBlogInstallCommand;
use Adminetic\Blog\Console\Commands\AdmineticBlogPermissionCommand;

class BlogServiceProvider extends ServiceProvider
{
    // Register Policies
    protected $policies = [
        Post::class => PostPolicy::class,
        Template::class => TemplatePolicy::class,
    ];

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // Publish Ressource
        if ($this->app->runningInConsole()) {
            $this->publishResource();
        }
        // Register Resources
        $this->registerResource();
        // Register Policies
        $this->registerPolicies();
        // Register View Components
        $this->registerLivewireComponents();
        // Register View Components
        $this->registerComponents();
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerCommands();
        /* Repository Interface Binding */
        $this->repos();
    }

    /**
     * Publish Package Resource.
     *
     *@return void
     */
    protected function publishResource()
    {
        // Publish Config File
        $this->publishes([
            __DIR__ . '/../../config/blog.php' => config_path('blog.php'),
        ], 'blog-config');
        // Publish View Files
        $this->publishes([
            __DIR__ . '/../../resources/views' => resource_path('views/vendor/adminetic/plugin/blog'),
        ], 'blog-views');
        // Publish Migration Files
        $this->publishes([
            __DIR__ . '/../../database/migrations' => database_path('migrations'),
        ], 'blog-migrations');
    }

    /**
     * Register Package Resource.
     *
     *@return void
     */
    protected function registerResource()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations'); // Loading Migration Files
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'blog'); // Loading Views Files
        $this->registerRoutes();
    }

    /**
     * Register Package Command.
     *
     *@return void
     */
    protected function registerCommands()
    {
        $this->commands([
            AdmineticBlogPermissionCommand::class,
            AdmineticBlogInstallCommand::class,
        ]);
    }

    /**
     * Register Routes.
     *
     * @return void
     */
    protected function registerRoutes()
    {
        Route::group($this->routeConfiguration(), function () {
            $this->loadRoutesFrom(__DIR__ . '/../../routes/web.php');
        });
    }

    /**
     * Register Route Configuration.
     *
     * @return void
     */
    protected function routeConfiguration()
    {
        return [
            'prefix' => config('adminetic.prefix', 'admin'),
            'middleware' => config('adminetic.middleware', ['web', 'auth']),
        ];
    }

    /**
     * Register Components.
     *
     *@return void
     */
    protected function registerLivewireComponents()
    {
        Livewire::component('admin.post.post-featured', PostFeatured::class);
        Livewire::component('admin.post.post-priority', PostPriority::class);
        Livewire::component('admin.post.posts-table', PostsTable::class);
        Livewire::component('admin.post.post-status', PostStatus::class);
    }

    /**
     * Repository Binding.
     *
     * @return void
     */
    protected function repos()
    {
        $this->app->bind(PostRepositoryInterface::class, PostRepository::class);
        $this->app->bind(TemplateRepositoryInterface::class, TemplateRepository::class);
    }

    /**
     * Register Policies.
     *
     *@return void
     */
    protected function registerPolicies()
    {
        foreach ($this->policies as $key => $value) {
            Gate::policy($key, $value);
        }
    }

    /**
     *
     *Register View Component
     *
     */
    protected function registerComponents()
    {
        $this->loadViewComponentsAs('blog', [
            Dashboard::class,
        ]);
    }
}
