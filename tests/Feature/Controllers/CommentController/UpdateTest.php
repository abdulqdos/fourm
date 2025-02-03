<?php

use App\Models\Comment;
use App\Models\User;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\put;

it('requires authentication' , function () {
    put(route('comments.update', Comment::factory()->create()))
        ->assertRedirect(route('login'));
});

it('can update a comment' , function () {
    $comment = Comment::factory()->create(['body' => 'This is an old body']);
    $newBody = 'This is new body';

    actingAs($comment->user)
    ->put(route('comments.update', $comment) , ['body' => $newBody]);

    $this->assertDatabaseHas('comments', [
        'id' => $comment->id,
        'body' => $newBody
    ]);
});

it('redirects to the post show page' , function () {
    $comment = Comment::factory()->create();

    actingAs($comment->user)
        ->put(route('comments.update', $comment) , ['body' => 'new body'])
        ->assertRedirect(route('posts.show', $comment->post_id));
});

it('redirects to the correct page of comments' , function () {
    $comment = Comment::factory()->create();

    actingAs($comment->user)
        ->put(route('comments.update', ['comment' => $comment , 'page' => 2]) , ['body' => 'new body'])
        ->assertRedirect(route('posts.show', ['post' => $comment->post_id , 'page' => 2 ]));
});
it('cannot update comment from another user' , function () {
    $comment = Comment::factory()->create();

    actingAs(User::factory()->create())
        ->put(route('comments.update',  $comment ) , ['body' => 'new body'])
        ->assertForbidden();
});

it('requires a valid body' , function ($body) {
    $comment = Comment::factory()->create();

    actingAs($comment->user)
        ->put(route('comments.update',  $comment ) , ['body' => $body])
        ->assertInvalid('body');
})->with([
    null,
    1,
    true,
    1.5,
    str_repeat('a', 2501)
]);


