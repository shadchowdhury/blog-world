@props(['post' , 'full'=>false])

<div class="card mb-3">
    {{-- Post title --}}
    <p class="font-bold text-xl">{{ $post->title }}</p>

    {{-- Author and Date --}}
    <div class="text-xs mb-4">
        <span><i>Posted {{ $post->created_at->diffforHumans() }} by</i></span>
    <a href="{{ route('user.posts', $post->user) }}" class="text-blue-500 font-medium">{{ $post->user->username }}</a>
    </div>

    {{-- Post Body --}}
    <div class="text-sm text-justify">
        @if ($full)
            <span>{{ $post->body }}</span>
        @else
            <span>{{ Str::words($post->body, 35, '...') }}</span>
            <a href="{{ route('posts.show', $post) }}" class="text-blue-500">Read more</a>
        @endif
    </div>
    <div class="flex items-center justify-end gap-4 mt-6">
        {{ $slot }}
    </div>

</div>
