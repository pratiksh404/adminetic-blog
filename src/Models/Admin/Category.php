<?php

namespace Adminetic\Blog\Models\Admin;

use Adminetic\Blog\Models\Admin\Post;
use App\Traits\CategoryMorphedByMany;
use Illuminate\Support\Facades\Cache;
use drh2so4\Thumbnail\Traits\Thumbnail;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Category extends Model
{
    use LogsActivity, Thumbnail, CategoryMorphedByMany;

    protected $guarded = [];

    // Forget cache on updating or saving and deleting
    public static function boot()
    {
        parent::boot();

        static::saving(function () {
            self::cacheKey();
        });

        static::deleting(function () {
            self::cacheKey();
        });

        Category::creating(function ($model) {
            $model->position = Category::max('position') + 1;
        });
    }

    // Cache Keys
    private static function cacheKey()
    {
        Cache::has('categories') ? Cache::forget('categories') : '';
    }

    // Logs
    protected static $logName = 'category';

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }

    protected $parentColumn = 'parent_id';

    protected $casts = [
        'meta_keywords' => 'array',
    ];

    // Relation
    public function categorizable()
    {
        return $this->morphTo();
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, $this->parentColumn);
    }

    public function categories()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function childrenCategories()
    {
        return $this->hasMany(Category::class, 'parent_id')->with('categories');
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function allPosts()
    {
        return $this->hasMany(Post::class, 'main_category_id');
    }

    // Scopes

    public function scopePositionCategory($query, $limit = 4)
    {
        return $query->with('children')->orderBy('position', 'desc')->take($limit);
    }

    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }
}
