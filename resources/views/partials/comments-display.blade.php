@foreach($comments as $comment)
	
	<p>On {{ $comment->created_at }} <strong>{{ $comment->name }}</strong> wrote:</p>
	<p class="bg-info p-1 rounded">{{ $comment->content }}</p>

@endforeach 