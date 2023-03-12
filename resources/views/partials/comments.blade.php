<div class="col-md-8">
    <div class="card">
        <div class="card-body">
            <h4>Display Comments</h4>
            @include('partials.comments-display', ['comments' => $post->comments])
            <hr />
            <h4>Add comment</h4>
            <form method="post" action="{{ route('store.comment') }}">
                @csrf
                <div class="control-group col-12 mb-4">
                    <label for="title">Name</label>

                    @guest
					    <input type="text" id="name" class="form-control" name="name" placeholder="Enter Your Name">
					@endguest

					@auth
					    <input type="text" id="name" class="form-control" name="name" placeholder="Enter Your Name" value="{{ auth()->user()->name }}" readonly>
					@endauth

                    @error('name')
	                    <div class="alert alert-danger mt-2" role="alert">
						 	{{ $message }}
						</div>
	                @enderror

                </div>
                <div class="control-group col-12 mb-4">
                    <label for="commnet">Commnet</label>
                    <textarea class="form-control" name="comment"></textarea>
                    @error('comment')
	                    <div class="alert alert-danger mt-2" role="alert">
						 	{{ $message }}
						</div>
	                @enderror

                </div>
                <div class="control-group col-12 mb-4">
                    <input type="hidden" name="post_id" value="{{ $post->id }}" />
                </div>
                <div class="control-group col-12 mb-4">
                    <input type="submit" class="btn btn-success" value="Add Comment" />
                </div>
            </form>
        </div>
    </div>
</div>