<x-app-layout>
    <x-blog-layout>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Edit Article</div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('articles.update', $article->id) }}">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input id="title" type="text" class="form-control" name="title"
                                        value="{{ $article->title }}" required autofocus>
                                </div>

                                <div class="form-group">
                                    <label for="body">Body</label>
                                    <textarea id="body" class="form-control" name="body" rows="10" required>{{ $article->body }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="category_id">Category</label>
                                    <select id="category_id" class="form-control" name="category_id" required>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ $article->category_id == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="hashtags">Hashtags</label>
                                    <select id="hashtags" class="form-control" name="hashtags[]" multiple required>
                                        @foreach ($hashtags as $hashtag)
                                            <option value="{{ $hashtag->id }}"
                                                {{ in_array($hashtag->id, $article->hashtags->pluck('id')->toArray()) ? 'selected' : '' }}>
                                                {{ $hashtag->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Add more input fields for other attributes as needed -->

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Update Article</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-blog-layout>
</x-app-layout>
