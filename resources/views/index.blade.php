@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            @auth
                @if(Request::url() == url('/my-posts'))
                    @include('partials.add-post')
                @endif
            @endauth

            @foreach ($posts as $post)
                @include('partials.post-intro-view')
            @endforeach

            @isset($message)
                <p>{{ $message }}</p>
            @endisset($message)

            {!! $posts->withQueryString()->links('pagination::bootstrap-5') !!}

        </div>
    </div>
</div>
@endsection