@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 pt-2">
            <a href="{{ route('my.posts') }}" class="btn btn-outline-primary btn-sm">Go back</a>
            <div class="border rounded border rounded mt-4 p-4">
                <h4 class="fw-bold">Create a New Post</h4>
                <hr>
                <form action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="control-group col-12">
                            <label for="title">Post Title</label>
                            <input type="text" id="title" class="form-control" name="title" placeholder="Enter Post Title">

                            @error('title')
			                    <div class="alert alert-danger mt-2" role="alert">
								 	{{ $message }}
								</div>
			                @enderror

                        </div>
                        <div class="control-group col-12 mt-2">
                            <label for="title">Post Content</label>
                            <textarea id="content" class="form-control" name="content" placeholder="Enter Post Content" rows=""></textarea>

                            @error('content')
			                    <div class="alert alert-danger mt-2" role="alert">
								 	{{ $message }}
								</div>
			                @enderror

                        </div>
                        <div class="control-group col-12 mt-2">
                            <label for="title">Post slug</label>
                            <input type="text" id="slug" class="form-control" name="slug" placeholder="Enter Post slug">

                            @error('slug')
			                    <div class="alert alert-danger mt-2" role="alert">
								 	{{ $message }}
								</div>
			                @enderror

                        </div>
                        <div class="control-group col-12 mt-2">
                            <label for="title">Post image</label>
                            <input type="file" class="form-control" name="image" />

                            @error('image')
			                    <div class="alert alert-danger mt-2" role="alert">
								 	{{ $message }}
								</div>
			                @enderror

                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="control-group col-12 text-center">
                            <button id="btn-submit" class="btn btn-primary">
                                Create Post
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection