<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="//unpkg.com/alpinejs" defer></script>
    <title>{{ env('APP_NAME') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-100 text-slate-900">
    <header class="bg-slate-800 shadow-lg">
        <nav>
            <a href="{{ route('home') }}" class="nav-link">HOME</a>

            {{-- Guest user --}}
            @guest
                <div class="flex items-center gap-4">
                    <a href="{{ route('login') }}" class="nav-link">Login</a>
                    <a href="{{ route('register') }}" class="nav-link">Register</a>
                </div>
            @endguest

            {{-- If the user is logged --}}
            @auth
                <div class="relative grid place-items-center" x-data="{ open: false }">
                    <button @click="open=!open" class="round-btn" type="button">
                        <img src="https://www.picsum.photos/200" alt="Profile photo">
                    </button>
                    <div x-show="open" @click.outside="open=false"
                        class="bg-white shadow-lg absolute top-10 right-0 rounded-lg overflow-hidden font-light">
                        <p class="username">{{ auth()->user()->name }}</p>
                        <a href="{{ route('dashboard') }}" class="block hover:bg-slate-100 pl-4 px-8 py-2">Dashboard</a>

                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <button class="block w-full text-left hover:bg-slate-100 pl-3 pr-8 py-2">Logout</button>
                        </form>
                    </div>
                </div>
            @endauth


        </nav>
    </header>
    <main class="py-8 px-4 mx-auto max-w-screen-lg">
        {{ $slot }}
    </main>
</body>

</html>
