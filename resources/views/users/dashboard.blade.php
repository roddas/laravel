<x-layout>
    <h1>Logged User {{ auth()->user()->name }}</h1>
    {{-- Section messsages --}}

    @if (session('success'))
        <div class="text-green-900">
            <x-flashMessage message="{{ session('success') }}" />
        </div>
    @elseif (session('delete'))
        <div>
            <x-flashMessage bg="bg-red-900" message="{{ session('delete') }}" />
        </div>
    @endif
    {{-- Create post form --}}
    <div class="card mb-4">
        <h2 class="font-bold mb-4"> Create a new post</h2>
        <form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            {{-- Title --}}
            <div class="mb-4">
                <label for="title">Post title</label>
                <input type="text" name="title" value="{{ old('title') }}" id="title" class="input"
                    placeholder="a new title">
                @error('title')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            {{-- Body --}}
            <div class="mb-4">
                <label for="body">Post title</label>
                <textarea name="body" id="body" class="input" rows="5"></textarea>
                @error('body')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>
            {{-- Post image --}}
            <div class="mb-4">
                <label for="image">Cover photo</label>
                <input type="file" name="image" id="image">
                @error('image')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>
            <button class="btn">Save</button>
        </form>
    </div>

    {{-- User posts --}}
    <h2 class="font-bold mb-4">Your latest posts</h2>
    <div class="grid grid-cols-2 gap-6">
        @foreach ($posts as $post)
            <x-postCard :post="$post">

                {{-- Update post --}}
                <a href="{{ route('posts.edit', $post) }}"
                    class="bg-green-500 text-white px-2 -y-1 text-xs rounded-md">Update</a>

                {{-- Delete post --}}
                <form action="{{ route('posts.destroy', $post) }}" method="post">
                    @csrf
                    @method('DELETE')

                    <button class="bg-red-500 text-white px-2 -y-1 text-xs rounded-md">Delete</button>
                </form>

            </x-postCard>
        @endforeach
    </div>
</x-layout>
