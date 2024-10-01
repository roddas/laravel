<h1> Hello {{ $user->name }}</h1>

<p>You created the post with {{ $post->title }} title</p>
<p> {{ $post->body }} </p>
<img src="{{ $message->embed('storage/'.$post->image) }}" alt="">