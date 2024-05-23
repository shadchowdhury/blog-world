<x-layout>
    <h1 class="title">Latest Posts</h1>

    <div class="grid grid-cols-2 gap-5">
        @foreach ($posts as $post)
            <div class="card mb-3">
                {{-- Title --}}
                <p class="font-bold text-xl">{{ $post->title }}</p>

                {{-- Author & Date --}}
                <div class="text-xs mb-4">
                    <span class=""><i>Posted {{ $post->created_at->diffForHumans() }} by</i></span>
                    <a href="" class="text-blue-500 font-medium">Username</a>
                </div>

                {{-- Body --}}
                <div class="text-sm">
                    <p>{{ Str::words($post->body, 40, '...') }}</p>
                </div>
            </div>
        @endforeach
    </div>

    <div>
        {{ $posts->links() }}
    </div>

</x-layout>
