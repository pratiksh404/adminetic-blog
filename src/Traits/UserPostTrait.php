<?php

namespace Adminetic\Blog\Traits;

use Adminetic\Blog\Models\Admin\Post;

trait UserPostTrait
{
    // Relation
    public function posts()
    {
        return $this->hasMany(Post::class, 'author_id');
    }
}
