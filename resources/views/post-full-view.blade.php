@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
        	<div class="card">
				<div class="card-header">
					{{$post->title}}
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-md-4">
							<img class="img-fluid" src="{{ asset('blog-images/'.$post->image) }}" alt="Homes" />
						</div>
						<div class="col-md-8">
							{{ $post->content }}
						</div>
					</div>
				</div>
			</div>
        </div>
    </div>
     <div class="row justify-content-center mt-4">	
     	@include('partials.comments')
     </div>
</div>
@endsection

