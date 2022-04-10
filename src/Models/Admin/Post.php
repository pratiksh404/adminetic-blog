<?php

namespace Adminetic\Blog\Models\Admin;

use App\Models\User;
use Conner\Tagging\Taggable;
use Adminetic\Blog\Traits\PostTrait;
use Illuminate\Support\Facades\Cache;
use drh2so4\Thumbnail\Traits\Thumbnail;
use Illuminate\Database\Eloquent\Model;
use Adminetic\Blog\Models\Admin\Category;
use Adminetic\Category\Traits\HasCategory;
use Cviebrock\EloquentSluggable\Sluggable;
use Spatie\Activitylog\Traits\LogsActivity;
use CyrildeWit\EloquentViewable\Contracts\Viewable;
use CyrildeWit\EloquentViewable\InteractsWithViews;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

class Post extends Model implements Viewable
{
    use LogsActivity, PostTrait, Sluggable, SluggableScopeHelpers, Taggable, InteractsWithViews, Thumbnail;

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
    }

    // Cache Keys
    private static function cacheKey()
    {
        Cache::has('posts') ? Cache::forget('posts') : '';
    }

    // Logs
    protected static $logName = 'post';

    // Casts
    protected $casts = [
        'meta_keywords' => 'array'
    ];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name',
            ],
        ];
    }

    // Accessors
    public function getStatusAttribute($attribute)
    {
        return $attribute <= 3 ? [
            1 => 'Draft',
            2 => 'Pending',
            3 => 'Published'
        ][$attribute] : 'N/A';
    }


    // Relation
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function mainCategory()
    {
        return $this->belongsTo(Category::class, 'main_category_id');
    }

    // Helper Function
    public function statusColor()
    {
        return $this->getRawOriginal('status') == 1 ? "danger" : ($this->getRawOriginal('status') == 2 ? "warning" : "success");
    }
}
