@extends('layouts.layout')

@section('content')
    <div class="container mt-4">
        <div class="border p-4">
            <h1 class="h5 mb-4">
                投稿の編集
            </h1>
            
            <form method="POST" action="{{ route('posts.update', ['post' => $post]) }}">
                @csrf
                @method('PUT')
            
                <fieldset class="mb-4">
                     <div class="form-group">
                        <label for="tags">
                            タグ
                        </label>
                        <input
                               id="tags"
                               name="tags"
                               class="form-control {{ $errors->has('tags') ? 'is-invalid' : '' }}"
                               value="{{ old('tags')?: $post->tags }}"
                               type="text"
                        >
                        @if ($errors->has('tags'))
                            <div class="invalid-feedback">
                                {{ $errors->first('tags') }}
                            </div>
                        @endif
                    </div>
                    
                    <div class="form-group">
                        <label for="title">
                            タイトル
                        </label>
                        <input
                               id="title"
                               name="title"
                               class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}"
                               value="{{ old('title')?: $post->title }}"
                               type="text"
                        >
                        @if ($errors->has('title'))
                            <div class="invalid-feedback">
                                {{ $errors->first('title') }}
                            </div>
                        @endif
                    </div>
                    
                    <div class="form-group">
                        <label for="body">
                            本文
                        </label>
                        
                        <textarea
                                  id="body"
                                  name="body"
                                  class="form-control {{ $errors->has('body')? 'is-invalid' : '' }}"
                                  rows="4"
                        >{{ old('body') ?: $post->body }}</textarea>
                        @if ($errors->has('body'))
                            <div class="invalid-feedback">
                                {{ $errors->first('body') }}
                            </div>
                        @endif
                    </div>
                    
                    <div class="mt-5">
                        <a class="btn btn-secondary" href="{{ route('posts.show', ['post' => $post]) }}">
                            キャンセル
                        </a>
                        
                        <button type="submit" class="btn btn-primary">
                            投稿する
                        </button>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>

@endsection