<x-layout>

    <a href="{{ route('dashboard') }}" class="text-blue-700">&larr; Go back to Dashboard</a>

    <div class="card mb-4">
        <h1 class="font-bold mb-4">Update post</h1>

        <form action="{{ route('posts.update', $post) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method("PUT")

            {{-- Post title --}}
            <div class="mb-4">
                <label for="title">Post Title</label>
                <input type="text" name="title" value="{{ $post->title }}"
                    class="input @error('title') ring-red-500 @enderror">
                @error('title')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            {{-- post body --}}
            <div class="mb-4">
                <label for="body">Post Content</label>
                <textarea name="body" rows="5" class="input @error('body') ring-red-500 @enderror">{{ $post->body }}</textarea>
                @error('body')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            {{-- Current cover photo if exist --}}
            @if ($post->image)
                <div class="mb-4 overflow-hidden">
                    <img src="{{ asset('storage/'. $post->image) }}" alt="" class="hover:scale-125 duration-1000 h-52 w-1/4 object-cover">
                </div>
            @endif

            <div class="mb-4">
                <label for="image">Cover Photo</label>
                <input type="file" name="image" id="image">

                @error('image')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            {{-- Submit Button --}}
            <button type="submit" class="btn">Update</button>
        </form>
    </div>

</x-layout>
