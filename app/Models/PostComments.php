<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Notifications\NewCommentNotification;
use App\Models\User;

class PostComments extends Model
{
    use HasFactory;


    protected $fillable = ['post_id', 'name', 'content'];


    protected static function booted()
    {   
        static::created(function ($comment) {
            //dd($comment->post->user_id);

            $user_id = $comment->post->user_id;
            $user= User::find($user_id);
            // /dd($user);
            $user->notify(new NewCommentNotification($comment));
            //$comment->post->name->notify(new NewCommentNotification($comment));
        });
    }


    public function post()
    {
        return $this->belongsTo(BlogPosts::class);
    }
}
