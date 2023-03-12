<?php

namespace App\Http\Controllers;

use App\Models\BlogPosts;
use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\Services\SlugService;
use File;
use Response;
use Illuminate\Support\Facades\Gate;

class BlogPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   

        $posts = BlogPosts::paginate(5);

        $message=null;
        if($posts->isEmpty())
            $message = "There are no blog posts yet.";

        return view('index', ['posts' => $posts, 'message' => $message]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {   
        return view('partials.create-post');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'slug' => 'required|unique:blog_posts',
            'image' => 'required|image|mimes:png,jpg,jpeg|max:2048'
        ]);


         $imageName = time().'.'.$request->image->extension();

         // Public Folder
        $request->image->move(public_path('blog-images'), $imageName);

        $newPost = BlogPosts::create([
            'user_id' => auth()->user()->id,
            'title' => $request->title,
            'content' => $request->content,
            'slug' =>  SlugService::createSlug(BlogPosts::class, 'slug', $request->slug),
            'image' => $imageName,
        ]);

        return redirect('/my-posts');
        
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {   
        try {
            $post = BlogPosts::where('slug', $slug)->firstOrFail();
        } catch (ModelNotFoundException $exception) {
            abort(404);
        }
        
        return view('post-full-view',['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($slug)
    {   
        $userID = auth()->user()->id;
        $post = BlogPosts::where('slug', $slug)->first();

        try {
            $post = BlogPosts::where('slug', $slug)->firstOrFail();
        } catch (ModelNotFoundException $exception) {
            abort(404);
        }

        $this->authorize('update', $post);

        return view('edit-post',['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $slug )
    {   
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'slug' => 'required',
            'image' => 'sometimes|image|mimes:png,jpg,jpeg|max:2048'
        ]);

        $post = BlogPosts::where('slug', $slug)->first();

        if($request->hasFile('image')){
            if(File::exists(public_path('blog-images/'.$post->image))){
                File::delete(public_path('blog-images/'.$post->image));
                $imageName = time().'.'.$request->image->extension();
                $request->image->move(public_path('blog-images'), $imageName);
                $post->image = $imageName;
            }
        }

        $post->title = $request->title;
        $post->content = $request->content;
        if($post->slug != $request->slug)
            $post->slug = SlugService::createSlug(BlogPosts::class, 'slug', $request->slug);

        $post->save();

        return view('post-full-view',['post' => $post]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $slug)
    {   
        $post = BlogPosts::where('slug', $slug)->first();
        $this->authorize('delete', $post);

        if(File::exists(public_path('blog-images/'.$post->image)))
            File::delete(public_path('blog-images/'.$post->image));

        $post->delete();

        return redirect('/');
    }

    public function search(Request $request)
    {      
        $searchString = $request->search;;
        $posts = BlogPosts::where('title', 'LIKE', "%{$searchString}%")->paginate(5);

        if($posts->isEmpty())
            return view('not-found');    

        return view('index', ['posts' => $posts]);
    }

    public function myposts(Request $request)
    { 
        $userID = auth()->user()->id;
        $posts = BlogPosts::where('user_id', 'LIKE', $userID)->paginate(5);

        $message=null;
        if($posts->isEmpty())
            $message = "You have no posts. Create one.";

        return view('index', ['posts' => $posts, 'message' => $message]);
        
    }
}
