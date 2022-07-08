<?php

namespace App\Http\Controllers;

use App\Post;
use App\Http\Requests\PostRequest; //useする
use App\Category;

class PostController extends Controller
{
    /**
     * Post一覧を表示する
     * 
     * @param Post Postモデル
     * @return array Postモデルリスト
     */
    public function index(Post $post)
    {
        return view('posts/index') -> with(['posts' => $post -> getPaginateBylimit()]);
    }
    
    /**
     * 特定IDのpostを表示する
     * 
     * @params Object Post //引数の$postはid=1のPostインスタンス
     * @return Response post view
     */
    public function show(Post $post)
    {
        return view('posts/show') -> with(['post' => $post]);
    }
    
    public function create(Category $category)
    {
        return view('posts/create')->with(['categories' => $category->get()]);
    }
    
    public function store(Post $post, PostRequest $request) //引数をRequest->PostRequestにする
    {
        $input = $request['post'];
        $input += ['user_id' => $request -> user() -> id];
        $post -> fill($input) -> save();
        return redirect('/posts/' . $post -> id);
    }
    
    public function edit(Post $post)
    {
        return view('posts/edit') -> with(['post' => $post]);
    }
    
    public function update(PostRequest $request, Post $post)
    {
        $input_post = $request['post'];
        $input_post += ['user_id' => $request -> user() -> id];
        $post -> fill($input_post) -> save();
        return redirect('/posts/' . $post -> id);
    }
    
    public function delete(Post $post)
    {
        $post -> delete();
        return redirect('/');
    }
}

?>