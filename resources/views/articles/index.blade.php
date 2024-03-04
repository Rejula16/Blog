

@extends('articles.master')

@section('content')
    <h1>Articles</h1>
    <a href="{{ route('articles.create') }}" class="btn btn-primary mb-3">Create New Article</a>

    @if ($articles->isEmpty())
        <p>No articles found.</p>
    @else
        <ul>
            @foreach ($articles as $article)
                <li>
                    <a href="{{ route('articles.show', $article->id) }}">{{ $article->title }}</a><br>
                    <p>{{ $article->body }}</p>
                    
                </li>
                <br>
            @endforeach
        </ul>
    @endif
@endsection
