<x-layout>
    <div class="mx-auto max-w-screen-sm text-center">
        <h1 class="title">Request A Password Reset Email</h1>

        {{-- Session Messages --}}
        @if (session('status'))
        <div class="flasmsg">
            <x-flasmsg msg="{{ session('status') }}" />
        </div>
        @endif
    </div>

    <div class="mx-auto max-w-screen-sm card">
        <form action="{{ route('password.request') }}" method="post" x-data="formSubmit" @submit.prevent="submit">
            @csrf

            {{-- Email --}}
            <div class="mb-4">
                <label for="email">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" class="input @error('email') ring-red-500 @enderror">
                @error('email')
                <p class="error">{{ $message }}</p>
                @enderror
            </div>

            {{-- Submit Button --}}
            <button  type="submit" x-ref="btn" class="btn">Send Request</button>
        </form>
    </div>
</x-layout>
