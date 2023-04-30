@extends('layouts.app')
@section('content')
    <div class="container">
        
        @if(session("info"))
        <div class="alert alert-info">
            {{ session("info") }}
        </div>
        @endif

        <div class="card mb-2 border-primary">
            <div class="card-body">
                <h3 class="card-title">{{$article->title}}</h3>
                <div>
                    <b class="text-success">
                        {{ $article->user->name }}
                    </b>
                    <small class="text-muted"> {{$article->created_at}} 
                        Comments: ({{ count($article->comments) }}),
                        Category: <b>{{ $article->category->name }}</b>
                    
                    </small>
                </div>
                <div> {{$article->body}} </div>
                <div class="mt-2">
                    @auth
                        @can('article-delete', $article)
                            <div class="mt2">
                                <a href="{{ url("/articles/delete/$article->id") }}"
                                class="btn btn-danger">Delete</a>
                                <a href="{{ url("/articles/edit/$article->id") }}" class="btn btn-warning">Edit</a>
                            </div>
                        @endcan
                    @endauth
                </div>
            </div>
        </div>
        <hr>
        <ul class="list-group">
            <li class="list-group-item active">
                <b>Comments ({{ count($article->comments) }})</b>
            </li>
            @foreach($article->comments as $comment)
                <li class="list-group-item">
                    @auth
                        @can ('comment-delete', $comment)
                            <div class="mt-2">
                                <a href="{{ url("/comments/delete/$comment->id") }}"
                                    class="btn-close float-end"></a>
                            </div>
                        @endcan
                    @endauth

                    <b class="text-success">
                        {{ $comment->user->name }}
                    </b> -
                    {{ $comment->content }}
                </li>
                @endforeach
        </ul>
        @auth
            <form action="{{ url("/comments/add") }}" method="post" class="mt-2">
                @csrf
                <input type="hidden" name="article_id" value="{{ $article->id}}">
                <textarea name="content" class="mb-2 form-control"></textarea>
                <button class="btn btn-secondary">Add Comment</button>
            
            </form>
        @endauth
    </div>
@endsection