@props(['post', 'full' => false])

<div class="card">
    {{-- Image --}}
    <div class="h-64 rounded-md mb-4 w-1/4 object-cover overflow-hidden">
        <img src="{{ asset('storage/' . $post->image) }}" alt="dsfsf">
    </div>

    {{-- Title --}}
    <h2 class="font-bold text-xl">{{ $post->title }}</h2>

    {{-- Author and date --}}
    <div class="text-xs font-light mb-4">
        <span>Posted {{ $post->created_at->diffForHumans() }} by </span>
        <a href="{{ route('posts.user', $post->user) }}" class="text-blue-500 font-medium">{{ $post->user->name }}</a>
    </div>

    {{-- Body --}}
    @if ($full)
        <div class="text-sm text-justify">
            <span>{{ $post->body }}</span>
        </div>
    @else
        <div class="text-sm text-justify">
            <span>{{ Str::words($post->body, 15) }}</span>
            <a class="text-blue-500 font-medium" href="{{ route('posts.show', $post) }}">Read more &rarr;</a>
        </div>
    @endif
    <div class="flex items-center justify-end gap-4 mt-6">
        {{ $slot }}
    </div>
    <hr class="my-2">

</div>
