<?php

namespace App\Policies;

use App\Models\BlogPosts;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PostPolicy
{   
    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, BlogPosts $post): bool
    {   
        return $user->id === $post->user_id || $user->role === 'admin';
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, BlogPosts $post): bool
    {
        return $user->id === $post->user_id || $user->role === 'admin';
    }
}
