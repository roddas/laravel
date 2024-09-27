<x-layout >
    <h1>Logged User {{auth()->user()->name}}</h1>
    {{-- Section messsages --}}
    @if (session('success'))
        <div class="text-green-900">
            <p>{{ session('success') }}</p>
        </div>
    @endif
    {{-- Create post form --}}
    <div class="card mb-4">
        <h2 class="font-bold mb-4"> Create a new post</h2>
        <form action="{{ route('posts.store') }}" method="post">
            @csrf

            {{-- Title --}}
            <div class="mb-4">
                <label for="title">Post title</label>
                <input  type="text" name="title" value="{{ old('title') }}"  id="title" class="input" placeholder="a new title">
                @error('title')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

             {{-- Body --}}
            <div class="mb-4">
                <label for="body">Post title</label>
                <textarea name="body" id="body" class="input"  rows="5"></textarea>
                @error('body')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>
            <button class="btn">Save</button>
        </form>

    </div>
   
</x-layout>