<?php

namespace Adminetic\Blog\Http\Livewire\Admin\Category;

use Adminetic\Blog\Models\Admin\Category;
use Illuminate\Support\Str;
use Livewire\Component;

class QuickCategory extends Component
{
    public $model;
    public $category_id;
    public $name;
    public $categoryid;

    protected $rules = [
        'name' => 'required|max:255',
    ];

    public function mount($category_id = null)
    {
        $this->category_id = $category_id;
    }

    public function submit()
    {
        $category = Category::create([
            'code' => rand(100000, 999999),
            'name' => $this->name,
            'parent_id' => $this->categoryid ? ($this->categoryid != '' ? $this->categoryid : null) : null,
            'slug' => Str::slug($this->name),
        ]);

        $this->category_id = $category->id;

        $this->emit('quick_category_created');
    }

    public function render()
    {
        $parentcategories = Category::whereNull('parent_id')->with('childrenCategories')->get();

        return view('website::livewire.admin.category.quick-category', compact('parentcategories'));
    }
}
