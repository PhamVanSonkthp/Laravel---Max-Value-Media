<?php

namespace App\Observers;

use App\Models\PostComment;

class PostCommentObserver
{
    /**
     * Handle the PostComment "created" event.
     *
     * @param  \App\Models\PostComment  $postComment
     * @return void
     */
    public function created(PostComment $postComment)
    {
        //
        $post = $postComment->post;

        if (!empty($post)) {
            $post->increment('number_comment');
        }
    }

    /**
     * Handle the PostComment "updated" event.
     *
     * @param  \App\Models\PostComment  $postComment
     * @return void
     */
    public function updated(PostComment $postComment)
    {
    }

    /**
     * Handle the PostComment "deleted" event.
     *
     * @param  \App\Models\PostComment  $postComment
     * @return void
     */
    public function deleted(PostComment $postComment)
    {
        //
        $post = $postComment->post;

        if (!empty($post)) {
            $post->decrement('number_comment');
        }
    }

    /**
     * Handle the PostComment "restored" event.
     *
     * @param  \App\Models\PostComment  $postComment
     * @return void
     */
    public function restored(PostComment $postComment)
    {
        //
        $post = $postComment->post;

        if (!empty($post)) {
            $post->increment('number_comment');
        }
    }

    /**
     * Handle the PostComment "force deleted" event.
     *
     * @param  \App\Models\PostComment  $postComment
     * @return void
     */
    public function forceDeleted(PostComment $postComment)
    {
        //
    }
}
