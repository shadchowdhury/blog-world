<x-layout>
    <div class="text-center">
        {{-- Session Messages --}}
        @if (session('message'))
            <div class="flasmsg">
                <x-flasmsg msg="{{ session('message') }}" />
            </div>
        @endif

        {{-- @if (session('message'))
            <p class="text-green-700">{{ session('message') }}</p>
        @endif --}}
    </div>

    <div class="card text-center ">
        <h1 class="mb-4 title">Verify your email</h1>
        <p>Use the link to verify your email that we've sent you through the email and enjoy the BlogWorld</p>

        <span class="text-xs">Didn't get the email?</span>
        <form action="{{ route('verification.send') }}" method="post">
            @csrf
            <button class="btn-verify">Send Again</button>
        </form>
    </div>
</x-layout>
