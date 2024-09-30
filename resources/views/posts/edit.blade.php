<x-layout>
    <div class="card">
        <a href="{{ route('dashboard') }}" class="text-blue-500 block mb-2 text-xs"> &larr;  Go back to your dashboard</a>
        <h2 class="font-bold mb-4">Update your post</h2>
        <form action="{{ route('posts.update',$post) }}" method="post">
            @csrf
            @method('PUT')

            {{-- Title --}}
            <div class="mb-4">
                <label for="title">Post title</label>
                <input type="text" name="title" value="{{ $post->title }}" id="title" class="input"
                    placeholder="a new title">
                @error('title')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            {{-- Body --}}
            <div class="mb-4">
                <label for="body">Post body</label>
                <textarea name="body" id="body" class="input" rows="5">{{ $post->body }}</textarea>
                @error('body')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>
            <button class="btn">Save</button>
        </form>
    </div>
</x-layout>
