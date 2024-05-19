<x-layout>
    <div class="mx-auto max-w-screen-sm text-center">
        <h1 class="title">Register for a new account</h1>
    </div>

    <div class="mx-auto max-w-screen-sm card">
        <form action="{{ route('register') }}" method="post">
            @csrf
            {{-- Username --}}
            <div class="mb-4">
                <label for="usename">Username</label>
                <input type="text" name="username" class="input">
            </div>
            {{-- Email --}}
            <div class="mb-4">
                <label for="email">Email</label>
                <input type="email" name="email" class="input">
            </div>
            {{-- Password --}}
            <div class="mb-4">
                <label for="password">Password</label>
                <input type="password" name="password" class="input">
            </div>
            {{-- Cofirm Password --}}
            <div class="mb-8">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" name="password_confirmation" class="input">
            </div>
            {{-- Submit Button --}}
            <button type="submit" class="btn">Register</button>
        </form>
    </div>
</x-layout>
