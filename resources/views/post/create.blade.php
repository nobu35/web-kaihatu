<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('ホーム') }}
        </h2>
    </x-slot>
    <div>

    <div>
        <form action="{{route('post.search')}}" method="GET">
            <input type="text" name="keyword">
            <input type="submit" value="検索">
        </form>
    </div>

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

    <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
        <div>
            コメント：
            <textarea name="content" placeholder="内容の入力"></textarea>
        </div>
        <div>
            タグ
            <textarea name="tag" placeholder="内容の入力"></textarea>
        </div>
        <input type="file" name="img_path">
        <button>送信</button>
    </form>

</x-app-layout>

