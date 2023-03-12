<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class BlogPosts extends Model
{
    use HasFactory;
    use Sluggable;

    protected $fillable = ['user_id', 'title', 'content', 'slug', 'image'];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'slug'
            ]
        ];
    }

    public function comments()
    {   
        return $this->hasMany(PostComments::class, 'post_id', 'id');
    }
}
