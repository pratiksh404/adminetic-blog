<?php

namespace Adminetic\Blog\Http\Controllers;

use Adminetic\Blog\Contracts\CategoryRepositoryInterface;
use Adminetic\Blog\Http\Requests\CategoryRequest;
use Adminetic\Blog\Models\Admin\Category;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    protected $categoryRepositoryInterface;

    public function __construct(CategoryRepositoryInterface $categoryRepositoryInterface)
    {
        $this->categoryRepositoryInterface = $categoryRepositoryInterface;
        $this->authorizeResource(Category::class, 'category');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('blog::admin.category.index', $this->categoryRepositoryInterface->indexCategory());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('blog::admin.category.create', $this->categoryRepositoryInterface->createCategory());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Adminetic\Blog\Http\Requests\CategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $this->categoryRepositoryInterface->storeCategory($request);

        return redirect(adminRedirectRoute('category'))->withSuccess('Category Created Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \Adminetic\Blog\Models\Admin\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('blog::admin.category.show', $this->categoryRepositoryInterface->showCategory($category));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Adminetic\Blog\Models\Admin\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('blog::admin.category.edit', $this->categoryRepositoryInterface->editCategory($category));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Adminetic\Blog\Http\Requests\CategoryRequest  $request
     * @param  \Adminetic\Blog\Models\Admin\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $this->categoryRepositoryInterface->updateCategory($request, $category);

        return redirect(adminRedirectRoute('category'))->withInfo('Category Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Adminetic\Blog\Models\Admin\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $this->categoryRepositoryInterface->destroyCategory($category);

        return redirect(adminRedirectRoute('category'))->withFail('Category Deleted Successfully.');
    }

    /**
     * Children Cateogry Reorder.
     */
    public function categoryChildrenReorder(Category $category)
    {
        return view('admin.category.children-reorder', compact('category'));
    }
}
