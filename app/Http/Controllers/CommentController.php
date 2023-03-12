<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PostComments;

class CommentController extends Controller
{
    /**

     * Store a newly created resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @return \Illuminate\Http\Response

     */

    public function store(Request $request)

    {

        $request->validate([
            'name' => 'required|max:255',
            'comment' => 'required',
        ]);

        $postComment = new PostComments;

        if (auth()->check()) {
            $postComment->name =  auth()->user()->name;
        }else{
            $postComment->name =  $request->name;
        } 

        $postComment->post_id =  $request->post_id;
        $postComment->content =  $request->comment;
        $postComment->save();  
        
        return back();

    }
}
