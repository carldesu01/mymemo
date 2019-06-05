<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostsController extends Controller
{
    public function index(Request $rq)
    {
        
        //サイドバー用に$listsにpostsテーブルのデータを格納
        $lists = Post::orderBy('created_at', 'desc') -> get();
        
        //タグ表示用に$tagsにタグ一覧を格納
        $taglists = Post::distinct()->select('tags') -> get();
        
        //検索用キーワード受け取り
        $keyword = $rq->input('keyword');
        
        //クエリ作成
        $query = Post::query();
        
        //検索キーワードがある場合
        if(!empty($keyword))
        {
            $query
                ->where('title','like','%'.$keyword.'%')
                ->orWhere('body','like','%'.$keyword.'%')
                ->orWhere('tags','like','%'.$keyword.'%');
        }
        
        
        
        
        $posts = $query->orderBy('created_at', 'desc')->paginate(10); //$posts テーブルから　Post(モデル)にorderByメソッドを使い、データを取り出し $postsに格納している
        
        return view('posts.index', [
            'posts' => $posts,
            'lists' => $lists,
            'taglists' => $taglists
        ]);
    }
    
    public function create()
    {
        $lists = Post::orderBy('created_at', 'desc') -> get();
        return view('posts.create', [
            'lists' => $lists
        ]);
    }
    
    public function store(Request $request)
    {
        $params = $request->validate([
            'title' => 'required|max:50',
            'body' => 'required|max:2000',
            'tags' => 'nullable',
        ]);
        
        
        Post::create($params);
        
        return redirect()->route('top');
    }
    
    public function show($post_id)
    {
    
        $lists = Post::orderBy('created_at', 'desc') -> get();
        
        $post = Post::findOrFail($post_id);
        
        return view('posts.show', [
            'post' => $post,
            'lists' => $lists
        ]);
    }
    
    
    public function edit($post_id)
    {
        $lists = Post::orderBy('created_at', 'desc') -> get();
        
        $post = Post::findOrFail($post_id);
        
        return view('posts.edit', [
            'post' => $post,
            'lists' => $lists
        ]);
        
    }
    
    public function update($post_id, Request $request)
    {
        $params = $request->validate([
            'title' => 'required|max:50',
            'body' => 'required|max:2000',
            'tags' => 'nullable',
        ]);
        
        $post = Post::findOrFail($post_id);
        $post->fill($params)->save();
        
        return redirect()->route('posts.show', ['post' => $post]);
    }
    
    public function destroy($post_id)
    {
        $post = Post::findOrFail($post_id);
        
        \DB::transaction(function ()use($post){
            $post->comments()->delete();
            $post->delete();
        });
        
        return redirect()->route('top');
    }
    
    
    public function tags($tags)
    {
        $lists = Post::orderBy('created_at', 'desc') -> get();
        $taglists = Post::distinct()->select('tags') -> get();
        
        $query = Post::query();
        $query->where('tags','like',$tags);
        
        $posts = $query->orderBy('created_at', 'desc')->paginate(10); 
        
        return view('posts.index',[
            'posts' => $posts,
            'lists' => $lists,
            'taglists' => $taglists
        ]);
    }
    
    
    
    
}
