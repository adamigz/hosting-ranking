<?php

use App\Http\Controllers\AdminPagesController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Admin;
use App\Http\Controllers\AdminActionsController;
use App\Http\Controllers\PagesController;
use Illuminate\Routing\RouteGroup;
use App\Http\Controllers\ActionsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [PagesController::class, 'index'])->name('home');
Route::get('/hosting/{id}', [PagesController::class, 'hosting'])->name('hosting');
Route::get('/post/{title}', [PagesController::class, 'post'])->name('post');
Route::get('/posts', [PagesController::class, 'posts'])->name('posts');

Route::group(['middleware'=>['auth']], function() {
    Route::get('/vote/{id}', [ActionsController::class, 'vote'])->name('vote');
    Route::post('/comment/add/{id}', [ActionsController::class, 'addComment'])->name('addComment');
});

Route::get('/logout', function ()
{
    auth()->logout();
    Session()->flush();
    return redirect('/');
})->name('logout');

Route::group(['prefix'=>'admin','middleware'=>['auth','admin']], function() {
    Route::get('/', [AdminPagesController::class, 'goToDefault'])->name('admin.home');
    Route::get('/hostings', [AdminPagesController::class, 'hostings'])->name('admin.hostings');
    Route::get('/hostings/create', [AdminPagesController::class, 'createNewHosting'])->name('admin.hostings.create');
    Route::post('/hostings/create', [AdminActionsController::class, 'createNewHosting'])->name('admin.createNewHosting');
    Route::get('/hostings/{id}/edit', [AdminPagesController::class, 'editHosting'])->name('admin.hostings.edit');
    Route::post('/hostings/{id}/edit', [AdminActionsController::class, 'editHosting'])->name('admin.editHosting');
    Route::get('/hostings/{id}/delete', [AdminActionsController::class, 'deleteHosting'])->name('admin.hostings.delete');

    Route::get('/posts', [AdminPagesController::class, 'posts'])->name('admin.posts');
    Route::get('/posts/create', [AdminPagesController::class, 'createNewPost'])->name('admin.posts.create');
    Route::post('/posts/create', [AdminActionsController::class, 'createNewPost'])->name('admin.createNewPost');
    Route::get('/posts/{title}/edit', [AdminPagesController::class, 'editPost'])->name('admin.posts.edit');
    Route::post('/posts/{title}/edit', [AdminActionsController::class, 'editPost'])->name('admin.editPost');
    Route::get('/posts/{id}/delete', [AdminActionsController::class, 'deletePost'])->name('admin.posts.delete');

    Route::get('/settings', [AdminPagesController::class, 'settings'])->name('admin.settings');
    Route::post('/settings', [AdminActionsController::class, 'settings'])->name('admin.saveSettings');
});

require __DIR__.'/auth.php';
