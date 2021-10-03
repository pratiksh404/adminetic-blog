<?php

use Illuminate\Support\Facades\Route;
use Adminetic\Blog\Http\Controllers\Admin\PostController;
use Adminetic\Blog\Http\Controllers\Admin\TemplateController;

Route::resource('post', PostController::class);
Route::resource('template', TemplateController::class);


Route::post('import-posts', [PostController::class, 'import'])->name('import_posts');
Route::post('export-posts', [PostController::class, 'export'])->name('export_posts');

/* AJAX ROUTE */
Route::get('get_template', [TemplateController::class, 'get_template'])->name('get_template');

/* Charts Routes */
Route::get('get-monthly-poster-view', [PosterController::class, 'get_monthly_poster_view'])->name('get_monthly_poster_view');
Route::get('get-monthly-post-view', [PostController::class, 'get_monthly_post_view'])->name('get_monthly_post_view');
Route::get('get-monthly-total-post-view', [PostController::class, 'get_monthly_post_total_view'])->name('get_monthly_post_total_view');
