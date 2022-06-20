<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

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
}

?>