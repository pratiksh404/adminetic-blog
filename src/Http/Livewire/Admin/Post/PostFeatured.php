<?php

namespace Adminetic\Blog\Http\Livewire\Admin\Post;

use Livewire\Component;
use Adminetic\Blog\Models\Admin\Post;

class PostFeatured extends Component
{
    public $post;

    protected $listeners = ['featured_changed' => 'featuredChanged'];


    public function featuredChanged(Post $post)
    {
        $post->update([
            'featured' => !$post->featured
        ]);

        $this->post = $post;
    }

    public function render()
    {
        return view('blog::livewire.admin.post.post-featured');
    }
}
