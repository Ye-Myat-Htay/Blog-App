{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Article List</title>
</head>
<body>
    <h1>Article List</h1>
    <ul>
        @foreach($articles as $article)
            <li>{{ $article['title'] }}</li>
        @endforeach
</body>
</html> --}}

@extends("layouts.app")
@section("content")
    <div class="container">
        {{ $articles->links()}}

        @if(session("info"))
            <div class="alert alert-info">
                {{ session("info") }}
            </div>
        @endif
        
        @foreach($articles as $article)
            <div class="card mb-2">
                <div class="card-body">
                    <h3 class="card-title">{{$article->title}}</h3>
                    <div>
                        <b class="text-success">
                            {{ $article->user->name }}
                        </b>,
                        <small class="text-muted"> 
                            Comments: ({{ count($article->comments) }}),
                            Category: <b>{{ $article->category->name }}</b>
                            
                            {{$article->created_at}} 
                        </small>
                        <div> {{$article->body}} </div>
                        <div class="mt-2">
                            <a href="{{ url("/articles/detail/$article->id") }}"
                                class="card-link">View Detail</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
