<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __($keyword.'検索一覧') }}
        </h2>
    </x-slot>
    <div>
    @foreach($posts as $post)
        @foreach($users as $user)
            @if($post->user_id == $user->id)
                {{ $user->name."さん"}}
            @endif
        @endforeach
        {{ $post->content }}
        {{ $post->tag }}
        <img src="{{asset('storage/'.$post->img_path)}}">
    @endforeach
</x-app-layout>
