<!-- resources/views/articles/show.blade.php -->

@extends('articles.master')

@section('content1')
    <h1>{{ $article->title }}</h1>
    <p><strong>Category:</strong> {{ $article->category->name }}</p>
    <p><strong>Author:</strong> {{ $article->user->name }}</p>

    <div>
        <strong>Body:</strong>
        <p>{{ $article->body }}</p>
    </div>

    <div>
        <strong>HashTags:</strong>
        @if ($article->hashTags->isEmpty())
            <p>No hashtags.</p>
        @else
            <ul>
                @foreach ($article->hashTags as $hashTag)
                    <li>{{ $hashTag->name }}</li>
                @endforeach
            </ul>
        @endif
    </div>
@endsection
