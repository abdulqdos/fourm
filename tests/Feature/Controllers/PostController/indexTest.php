<?php

use App\Http\Resources\PostResource;
use App\Models\post;
use function Pest\Laravel\get;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Inertia\Testing\AssertableInertia ;

//it('should return the correct component' , function () {
//    get(route('posts.index'))
//        ->assertComponent('Posts/Index');
//});

it('passes posts to the vue' , function () {
    $posts = Post::factory(3)->create();

    $posts->load('user');
    get(route('posts.index'))
        ->assertHasResource('post' , PostResource::make($posts->first()))
        ->assertHasPaginatedResource('posts' , PostResource::collection($posts));
});

