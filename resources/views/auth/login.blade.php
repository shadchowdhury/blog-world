<x-layout>
    <div class="mx-auto max-w-screen-sm text-center">
        <h1 class="title">Welcome Back to BlogWorld</h1>

        {{-- Session Messages --}}
        @if (session('status'))
        <div class="flasmsg">
            <x-flasmsg msg="{{ session('status') }}" />
        </div>
        @endif
    </div>



    <div class="mx-auto max-w-screen-sm card">
        <form action="{{ route('login') }}" method="post">
            @csrf

            {{-- Email --}}
            <div class="mb-4">
                <label for="email">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" class="input @error('email') ring-red-500 @enderror">
                @error('email')
                <p class="error">{{ $message }}</p>
                @enderror
            </div>
            {{-- Password --}}
            <div class="mb-4">
                <label for="password">Password</label>
                <input type="password" name="password" class="input @error('password') ring-red-500 @enderror">
                @error('password')
                <p class="error">{{ $message }}</p>
                @enderror
            </div>
            {{-- Remember Checkbox --}}
            <div class="mb-4 flex justify-between items-center">
                <div class="">
                    <input type="checkbox" name="remember" id="remember">
                    <label for="remember">Remember me</label>
                </div>

                <a href="{{ route('password.request') }}" class="text-blue-900">Forgot your password?</a>
            </div>
            <div class="mb-4">
                @error('failed')
                <p class="error">{{ $message }}</p>
                @enderror
            </div>


            {{-- Submit Button --}}
            <button type="submit" class="btn">Login</button>
        </form>
    </div>
</x-layout>
