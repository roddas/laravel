<x-layout >
    <h1 class="title">Wellcome back</h1>
    <div class="mx-auto max-w-screen-sm card">
        <form action="{{ route('login')}}" method="post">

            @csrf

            {{-- Email --}}
            <div class="mb-4">
                <label for="email">Email</label>
                <input  type="email" name="email" value="{{ old('email') }}"  id="email" class="input" placeholder="email@domain.com">
                @error('email')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            {{-- Password --}}
            <div class="mb-4">
                <label for="password">Password</label>
                <input  type="password" name="password" id="password" class="input" placeholder="*****************">
                @error('password')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

             @error('failed')
                    <p class="error">{{ $message }}</p>
                @enderror

            {{-- Remember checkbox --}}
            <div class="mb-4">
                <input type="checkbox" name="remember" id="remember">
                <label for="remember">Remember me</label>
            </div>

            {{-- Submit button --}}
            <button class="btn">Login</button>

        </form>
    </div>
</x-layout>