@props(['post'])

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
        <p>{{ Str::words($post->body, 40, '...') }}</p>
    </div>
</div>
