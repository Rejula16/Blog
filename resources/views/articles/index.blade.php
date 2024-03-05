

@extends('articles.master')

@section('content1')
    <h1 style="font-size: 36px ;color:rgb(93, 0, 255)">Articles</h1>
    <br>
    <a  href="{{ route('articles.create') }}" class="btn btn-primary mb-3">Create New Article</a>

    @if ($articles->isEmpty())
        <p>No articles found.</p>
    @else
        <ul>
            @foreach ($articles as $article)
                <li>
                    <form method="post" action="{{ route('articles.destroy', $article->id) }}">
                        @csrf
                        @method('DELETE')
                    <a href="{{ route('articles.show', $article->id) }}">{{ $article->title }}</a><br>
                    <p>{{ $article->body }}</p>
                 
                        <a href="{{ route('articles.show', $article->id) }}" class="btn btn-primary btn-sm">View</a>
                        <a href="{{ route('articles.edit', $article->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <input type="submit" class=" btn-sm btn btn-outline-danger" value="Delete" />
                    </form>
                    
                </li>
                <br>
            @endforeach
        </ul>
    @endif
@endsection
