<?php

namespace Adminetic\Blog\Http\Livewire\Admin\Post;

use Livewire\Component;
use Adminetic\Blog\Models\Admin\Post;

class PostStatus extends Component
{
    public $post;

    protected $listeners = ['status_changed' => 'statusChanged'];


    public function statusChanged($status, Post $post)
    {
        $post->update([
            'status' => $status
        ]);

        $this->post = $post;
    }

    public function render()
    {
        return view('blog::livewire.admin.post.post-status');
    }
}
