<x-layout>
    <h2 class="title">Latest posts</h2>
    <div class="grid grid-cols-2 gap-6">
        @foreach ($posts as $post)
            <x-postCard :post="$post" />
        @endforeach
    </div>
    <div class="a">
        {{ $posts->links() }}
    </div>
</x-layout>
