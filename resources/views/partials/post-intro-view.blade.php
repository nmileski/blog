<div class="card mb-4">
	<div class="card-header justify-content-between align-items-center d-flex">
		<div class="container">
			<div class="row">
				<div class="col-md-10">
					<a class="fs-3" href="{{URL::route('show.post', ['slug'=>$post->slug])}}">
						{{$post->title}}
					</a>
				</div>
				@can('update', $post)
					<div class="col-md-2 d-flex justify-content-end align-items-center">
						<a href="{{URL::route('edit.post', ['slug'=>$post->slug])}}"><i class="fas fa-edit"></i></a>
						<a class="ms-2" href="{{URL::route('delete.post', ['slug'=>$post->slug])}}"><i class="fas fa-trash"></i></a>
					</div>
				@endcan
			</div>
		</div>
	</div>
	<div class="card-body">
		<div class="row">
			<div class="col-md-4">
				 <img class="img-fluid" src="{{ asset('blog-images/'.$post->image) }}" alt="Homes" />
			</div>
			<div class="col-md-8">
				{{ Str::limit($post->content, 200) }}
			</div>
		</div>
	</div>
</div>
