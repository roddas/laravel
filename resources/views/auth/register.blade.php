<x-layout >
    <h1 class="title">Register a new account</h1>
    <div class="mx-auto max-w-screen-sm card">
        <form action="{{ route('register')}}" method="post">
            @csrf
            {{-- name --}}
            <div class="mb-4">
                <label for="name">Name</label>
                <input  type="text" name="name" value="{{ old('name') }}" id="name" class="input" placeholder="name">
                @error('name')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>
            
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

            {{-- Confirm Password --}}
            <div class="mb-4">
                <label for="password_confirmation">Confirm password</label>
                <input  type="password" name="password_confirmation" id="password_confirmation" class="input" placeholder="*****************">
                
            </div>

            {{-- Submit button --}}
            <button class="btn">Register</button>

        </form>
    </div>
</x-layout>