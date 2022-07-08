@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app() -> getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Blog</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        {{Auth::user()->name}}
        <h1>Blog Name</h1>
        <p class='create'>[<a href='/posts/create'>create</a>]</p>
        <div class='own_posts'>
            @foreach ($own_posts as $post)
                <div class='own_post'>
                    <h2 class='own_title'>
                        <a href="/posts/{{ $post -> id }}">{{ $post -> title }}</a>
                    </h2>
                    <small>{{ $post -> user -> name }}</small>
                    <a href="/categories/{{ $post -> category -> id }}">{{ $post -> category -> name }}</a>
                    <p class='own_body'>{{ $post -> body }}</p>
                </div>
                <form action="/posts/{{ $post -> id }}" id="form_delete_{{ $post -> id }}" method="post">
                    @csrf
                    @method('DELETE')
                    <input type="submit" style="display:none">
                    <p class='delete'>[<span onclick="return deletePost(this, {{ $post -> id }});">delete</span>]</p>
                </form>
            @endforeach
        </div>
        <div class='footer'>[<a href='/'>back</a>]</div>
        <div class='paginate'>
            {{ $own_posts -> links() }}
        </div>
        <script>
            function deletePost(e, id)
            {
                'use strict';
                if (confirm('削除すると復元できません。\n本当に削除しますか？'))
                {
                    document.getElementById('form_delete_' + id).submit();
                }
            }
        </script>
    </body>
</html>
@endsection