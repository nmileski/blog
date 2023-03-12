<x-mail::message>

<p>Hello,</p>
<p>There is a new comment on your post: {{ $post->title }}</p>
<p>Comment: {{ $comment->content }}</p>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
