<?php

namespace Adminetic\Blog\Contracts;

use Adminetic\Blog\Http\Requests\CategoryRequest;
use Adminetic\Blog\Models\Admin\Category;

interface CategoryRepositoryInterface
{
    public function indexCategory();

    public function createCategory();

    public function storeCategory(CategoryRequest $request);

    public function showCategory(Category $Category);

    public function editCategory(Category $Category);

    public function updateCategory(CategoryRequest $request, Category $Category);

    public function destroyCategory(Category $Category);
}
