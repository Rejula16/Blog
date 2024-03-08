<x-app-layout>
    <x-blog-layout>

        <h2 style="font-size: 24px ;color:rgb(47, 21, 93); padding-bottom:5px; ;margin:auto;">{{ $article->title }}</h2>
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
    </x-blog-layout>
</x-app-layout>
