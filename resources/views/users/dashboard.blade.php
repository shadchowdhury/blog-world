<x-layout>
    <div class="justify-between flex">
        <h2 class="title">Hello! {{ auth()->user()->username }}</h1>
        <h2 class="title">Total Post: {{ $posts->total() }}</h2>
    </div>


    {{-- create post form --}}
    <div class="card mb-4">
        <h1 class="font-bold mb-4">Create a new post</h1>

        {{-- Session Messages --}}
        @if (session('success'))
            <div class="flasmsg">
                <x-flasmsg msg="{{ session('success') }}" />
                {{-- <p class="text-green-700">{{ session('success') }}</p> --}}
            </div>
        @elseif (session('delete'))
            <div class="flasmsg">
                <x-flasmsg msg="{{ session('delete') }}" color="text-red-600"  />
            </div>
        @endif

        <form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            {{-- Post title --}}
            <div class="mb-4">
                <label for="title">Post Title</label>
                <input type="text" name="title" value="{{ old('title') }}"
                    class="input @error('title') ring-red-500 @enderror">
                @error('title')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            {{-- post body --}}
            <div class="mb-4">
                <label for="body">Post Content</label>
                <textarea name="body" rows="5" class="input @error('body') ring-red-500 @enderror">{{ old('body') }}</textarea>
                @error('body')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            {{-- post image --}}
            <div class="mb-4">
                <label for="image">Cover Photo</label>
                <input type="file" name="image" id="image">

                @error('image')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            {{-- Submit Button --}}
            <button type="submit" class="btn">Create</button>
        </form>
    </div>


    {{-- Latest post of User Section --}}

    <h2 class="font-bold mb-4">Your Latest Posts</h2>

    <div class="grid grid-cols-2 gap-4">
        @foreach ($posts as $post)
            <x-postCard :post="$post">

                {{-- Update Post --}}
                <a href="{{ route('posts.edit', $post) }}" class="bg-green-600 text-white px-2 py-1 text-xs rounded-md">Update</a>

                {{-- Delete Post --}}
                <form action="{{ route('posts.destroy', $post) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button class="bg-red-600 text-white px-2 py-1 text-xs rounded-md">Delete</button>
                </form>

            </x-postCard>
        @endforeach
    </div>
    <div>
        {{ $posts->links() }}
    </div>
</x-layout>
