<?php

use App\Http\Resources\PostResource;
use App\Models\post;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Inertia\Testing\AssertableInertia ;
use function Pest\Laravel\get;



it('passes posts to the vue' , function () {

    $posts = Post::factory(3)->create();
    get(route('posts.index'))
            ->assertHasResource('post' , PostResource::make($posts->first()))
            ->assertHasPaginatedResource('posts' , PostResource::collection($posts));
});

