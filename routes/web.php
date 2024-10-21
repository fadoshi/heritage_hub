<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use App\Http\Controllers\PostController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\RegisterController;

/* Route::get('/', function () {
    return view('welcome');
}); */

Auth::routes(['register' => false]);

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/blog/{post}', [App\Http\Controllers\HomeController::class, 'show'])->name('blog');

Route::middleware(AdminMiddleware::class)->group(function(){
    Route::get('/admin', [Controller::class, 'index'])->name('admin');
Route::get('/admin/invite', [Controller::class, 'invite_view'])->name('invite_view');
Route::post('/admin/invite', [AdminController::class, 'process_invites'])->name('process_invite');
Route::get('/registration/{token}', [AdminController::class, 'registration_view'])->name('registration');
Route::post('/registration', [RegisterController::class, 'register'])->name('register');

Route::get('/admin/posts', [PostController::class, 'index'])->name('admin_posts_index');
Route::get('/admin/posts/create', [PostController::class, 'create'])->name('admin_posts_create');
Route::post('/admin/posts', [PostController::class, 'store'])->name('admin_posts_store');
Route::get('/admin/posts/{post}/edit', [PostController::class, 'edit'])->name('admin_posts_edit');
Route::patch('/admin/posts/{post}', [PostController::class, 'update'])->name('admin_posts_update');
Route::delete('/admin/posts/{post}', [PostController::class, 'delete'])->name('admin_posts_delete');

Route::get('/admin/tags', [TagController::class, 'index'])->name('admin_tags_index');
Route::post('/admin/tags', [TagController::class, 'store'])->name('admin_tags_store');
Route::delete('/admin/tags/{tag}', [TagController::class, 'delete'])->name('admin_tags_delete');
});
