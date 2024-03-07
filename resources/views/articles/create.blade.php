<!-- resources/views/articles/create.blade.php -->

@extends('articles.master')

@section('content1')
    <div class="container">
        <h1>Create New Article</h1>

        <form action="{{ route('articles.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Enter title" required>
            </div>

            <div class="form-group">
                <label for="body">Body</label>
                <textarea class="form-control" id="body" name="body" rows="5" placeholder="Enter body" required></textarea>
            </div>

            <div class="form-group">
                <label for="category">Category</label>
                <select class="form-control" id="category" name="category_id" required>
                    <option value="">Select category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="hashtags">Hashtags</label>
                <select id="hashtags" class="form-control" name="hashtags[]" multiple required>
                    @foreach ($hashtags as $hashtag)
                        <option value="{{ $hashtag->id }}">{{ $hashtag->name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
