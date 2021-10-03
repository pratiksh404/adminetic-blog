<?php

namespace Adminetic\Blog\Adapter;

use Pratiksh\Adminetic\Contracts\PluginInterface;
use Pratiksh\Adminetic\Traits\SidebarHelper;

class BlogAdapter implements PluginInterface
{
    use SidebarHelper;

    public function assets(): array
    {
        return array();
    }

    public function myMenu(): array
    {
        return  [
            [
                'type' => 'menu',
                'name' => 'Post',
                'is_active' => request()->routeIs('post*') ? 'active' : '',
                'conditions' => [
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('view-any', Adminetic\Blog\Models\Admin\Post::class),
                    ],
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('create', Adminetic\Blog\Models\Admin\Post::class),
                    ],
                ],
                'children' => $this->indexCreateChildren('post', Adminetic\Blog\Models\Admin\Post::class),
            ],
            [
                'type' => 'menu',
                'name' => 'Template',
                'is_active' => request()->routeIs('template*') ? 'active' : '',
                'conditions' => [
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('view-any', Adminetic\Blog\Models\Admin\Template::class),
                    ],
                    [
                        'type' => 'or',
                        'condition' => auth()->user()->can('create', Adminetic\Blog\Models\Admin\Template::class),
                    ],
                ],
                'children' => $this->indexCreateChildren('template', Adminetic\Blog\Models\Admin\Template::class),
            ]
        ];
    }
}
