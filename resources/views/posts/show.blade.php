@extends('layouts.layout')

@section('content')
    <div class="container mt-4">
        <div class="mb-4 text-right">
            <a class="btn btn-primary" href="{{ route('posts.edit', ['post' => $post]) }}">
                編集する
            </a>
            <form 
              style="display: inline-block;"
              method="POST"
              action="{{ route('posts.destroy', ['post' => $post]) }}"
            >
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-dell">削除する</button>
            </form>
        </div>
        
        <div class="border p-4">
            <h1 class="h5 mb-4">
                {{ $post->title }}
                
                @if ($post->tags)
                        <span class="badge badge-primary">
                             {{ $post->tags }}
                        </span>
                 @endif
            </h1>
            
            <p class="mb-5">
                {!! nl2br(e($post->body)) !!}
            </p>
            
            <section>
                
                               
                @forelse($post->comments as $comment)
                    <div class="border-top p-4">
                        <pre class="prittyprint">
                        <p class="mt-2">
                            {!! nl2br(e($comment->body)) !!}
                        </p>
                        </pre>
                        
                        <p>
                            @if ($comment->url)
                                参考：<a href="{{ $comment->url }}">{{ $comment->url }}</a>
                            @endif
                        </p>
                        <time class="text-secondary">
                            {{ $comment->created_at->format('Y.m.d H:i') }}
                        </time>
                        <form 
                              style="display: inline-block;"
                              method="POST"
                              action="{{ route('comments.destroy', ['comment' => $comment]) }}"
                              >
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-dell btn-sm">追記削除</button>
                        </form>
                        
                    </div>
                @empty
                    <p>追記事項はまだありません。</p>
                @endforelse
                
                <form class="mb-4" method="post" action="{{ route('comments.store') }}">
                    @csrf
                    
                    <input
                           name="post_id"
                           type="hidden"
                           value="{{ $post->id }}"
                    >
                    
                    <div class="form-group">
                        <textarea
                                  id="body"
                                  name="body"
                                  class="form-control {{ $errors->has('body') ? 'is-invlid' : '' }}"
                                  rows="4"
                                  placeholder="追記する"
                        >{{ old('body') }}</textarea>
                        
                        @if ($errors->has('body'))
                            <div class="invalid-feedback">
                                {{ $errors->first('body') }}
                            </div>
                        @endif
                        
                        <input 
                               type="text"
                               id="url"
                               name="url"
                               class="form-control {{ $errors->has('url') ? 'is-invlid' : '' }}"
                               rows="4"
                               placeholder="参考サイト"
                        >{{ old('url') }}
                        
                        @if ($errors->has('url'))
                            <div class="invalid-feedback">
                                {{ $errors->first('url') }}
                            </div>
                        @endif
                    </div>
                    
                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">
                            追記
                        </button>
                    </div>
                </form>
 
            </section>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(function(){
            $(".btn-dell").click(function(){
                if(confirm("本当に削除しますか？")){
                    //そのまま削除(submit)
                } else {
                    // cancell
                    return false;
                }
            });
        });
    </script>
@endsection