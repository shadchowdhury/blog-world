<x-layout>
    @auth
        <h1 class="text-4xl">You'r Logedin!</h1>
    @endauth

    @guest
        <h1 class="text-4xl">Welcome to Our Website!</h1>
    @endguest

</x-layout>
