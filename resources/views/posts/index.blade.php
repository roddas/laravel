<x-layout >
    @auth
        <h1>Logged User</h1>
         
    @endauth
    @guest
        <h1>Guest User</h1>
    @endguest
</x-layout>