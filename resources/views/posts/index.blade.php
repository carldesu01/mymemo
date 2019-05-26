@extends('layouts.layout')

@section('content')

    
    <!-- tagsの表示 -->
    
    <div>
    タグでソート：
        @foreach($taglists as $post)
            <a href="{{ route('tags',['tags' => $post->tags ])}}">{{ $post->tags }}</a>
        @endforeach        
    </div>


    <div class="container mt-4">
        @if(0 == count($posts))
            <div>投稿がありません</div>
        @endif
                 
        @foreach ($posts as $post)
            <div class="card border-info mb-4">
                <div class="card-header">
                    {{ $post->title }}
                    @if ($post->tags)
                        <span class="badge badge-primary">
                             {{ $post->tags }}
                        </span>
                    @endif
                </div>
                <div class="card-body">
                    <p class="card-text">
                        {!! nl2br(e(str_limit($post->body, 200))) !!}
                    </p>
                    
                    <a class="card-link" href="{{ route('posts.show', ['post' => $post]) }}">
                        続きを読む
                    </a>
                </div>
                <div class="card-footer">
                    <span class="mr-2">
                        投稿日時 {{ $post->created_at->format('Y.m.d') }}
                    </span>
                </div>
            </div>
        @endforeach
        
             
        
        <div class="d-flex justify-content-conter mb-5">
            {{ $posts->links() }}
        </div>
    </div>
@endsection

