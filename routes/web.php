<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Resources\CommentResource;
use App\Http\Resources\PostResource;
use App\Http\Resources\UserResource;
use App\Models\Comment;
use App\Models\post;
use App\Models\User;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::resource('posts.comments', commentController::class)->shallow()->only(['store', 'update', 'destroy']);

    //    Route::post('posts/{post}/comments', [commentController::class, 'store'])->name('posts.comments.store');
    //    Route::delete('comments/{comment}', [commentController::class, 'destroy'])->name('comments.destroy');
    //    Route::put('comments/{comment}', [commentController::class, 'update'])->name('comments.update');

});

Route::get('posts', [PostController::class, 'index'])->name('posts.index');
Route::get('posts/{post}', [PostController::class, 'show'])->name('posts.show');

Route::get('test' , function () {
    return [
        UserResource::make(User::find(11)),
        PostResource::make(Post::find(1)),
        CommentResource::make(Comment::find(1))
    ];
});

