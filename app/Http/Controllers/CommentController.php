<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\post;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    use AuthorizesRequests;

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Post $post)
    {
        $data = $request->validate(['body' => ['required', 'string', 'max:2500']]);

        Comment::create([
            ...$data,
            'post_id' => $post->id,
            'user_id' => $request->user()->id,
        ]);

        return to_route('posts.show', $post)
            ->banner('Your comment has been posted.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        $this->authorize('update', $comment);

        $data = $request->validate(['body' => ['required', 'string', 'max:2500'] ]);

        $comment->update($data);

        return to_route('posts.show', [ 'post' => $comment->post_id , 'page' => $request->query('page') ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment , Request $request)
    {
       $this->authorize('delete', $comment);
        $comment->delete();
        return to_route('posts.show', [ 'post' => $comment->post_id , 'page' => $request->query('page') ])
            ->dangerBanner('Your comment has been deleted.' );
    }
}
