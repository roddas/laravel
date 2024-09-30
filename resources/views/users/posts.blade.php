<x-layout>
    <h1 class="title">{{ $user->name }}' Posts {{ $posts->total() }}</h1>

    {{-- User's post --}}
     <div class="grid grid-cols-2 gap-6">
        @foreach ($posts as $post)
            <x-postCard :post="$post" />
        @endforeach
    </div>
    <div class="a">
        {{ $posts->links() }}
    </div>
</x-layout>