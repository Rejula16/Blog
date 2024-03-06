<?php

namespace App\Http\Controllers;

use App\Http\Requests\Article\{Store, Update};
use App\Http\Controllers\ArticleService;

// use Illuminate\Http\Request;

class ArticleController extends Controller
{

    protected $articleService;

    public function __construct(ArticleService $articleService)
    {
        $this->articleService = $articleService;
    }
    
    public function index()
    {
        $articles = $this->articleService->getAllArticles();
        return view('articles.index', compact('articles'));
    }

    public function create()
    {
        $categories = $this->articleService->getAllCategories();
        return view('articles.create', compact('categories'));
    }

    public function store(Store $request)
    {
        $article = $this->articleService->createArticle($request->validated());

        if ($article) {
            $this->articleService->syncHashtags($article, $request->input('hashtags'));
        } else {
            // Handle the case when the article is not created successfully
            return redirect()->route('articles.index')->with('error', 'Failed to create article!');
        }

        return redirect()->route('articles.index')->with('success', 'Article created successfully!');
    }

    public function show($id)
    {
        $article = $this->articleService->getArticleById($id);
        return view('articles.show', compact('article'));
    }

    public function edit($id)
    {
        
        $article = $this->articleService->getArticleById($id);
        $this->authorize('update', $article);
        $categories = $this->articleService->getAllCategories();
        $hashtags = $this->articleService->getAllHashTags();
        return view('articles.edit', compact('article', 'categories','hashtags'));
    }

    public function update(Update $request, $id)
    {
        $this->articleService->updateArticle($id, $request->validated());

        $article = $this->articleService->getArticleById($id);
        if ($article) {
            if ($request->has('hashtags')) {
                $this->articleService->syncHashtags($article, $request->input('hashtags'));
            } else {
                $article->hashTags()->detach();
            }
        } else {
            // Handle the case when the article is not found
            return redirect()->route('articles.index')->with('error', 'Article not found!');
        }

        return redirect()->route('articles.index')->with('success', 'Article updated successfully!');
    }

    public function destroy($id)
    {
        $article = $this->articleService->getArticleById($id);
        $this->authorize('delete', $article);
        $this->articleService->deleteArticle($id);
        return redirect()->route('articles.index')->with('success', 'Article deleted successfully!');
    }
    
    // public function index()
    // {
    //     $articles = Article::all();
    //     return view('articles.index', compact('articles'));
    // }
    

    // public function create()
    // {
       
    //     $categories = Category::all(); 
    //     return view('articles.create', compact('categories'));
    // }

    // public function store(Store $request)
    // {
    //     $article = Article::create([
    //         'title' => $request->title,
    //         'body' => $request->body,
    //         'category_id' => $request->category_id,
    //         'user_id' => auth()->id(), 
    //         'slug'=> $request->user_id,
    //     ]);

    //     // Attach hashtags to the article if provided
    //     if ($request->has('hashtags')) {
    //         $article->hashTags()->sync($request->hashtags);
    //     }

    //     return redirect()->route('articles.index')->with('success', 'Article created successfully!');
    // }

    // public function show(Article $article)
    // {
    //     return view('articles.show', compact('article'));
    // }

    // public function edit(Article $article)
    // {
    //     $this->authorize('update', $article);
    //     $hashtags=HashTag::all();
    //     $categories = Category::all(); 
    //     return view('articles.edit', compact('article','categories','hashtags'));
    // }

    // public function update(Update $request, Article $article)
    // {
    //     $this->authorize('update', $article);
    //     $article->update([
    //         'title' => $request->title,
    //         'body' => $request->body,
    //         'category_id' => $request->category_id,
    //     ]);

    //     // Sync hashtags
    //     if ($request->has('hashtags')) {
    //         $article->hashTags()->sync($request->hashtags);
    //     } else {
    //         $article->hashTags()->detach();
    //     }

    //     return redirect()->route('articles.index')->with('success', 'Article updated successfully!');
    // }

    // public function destroy(Article $article)
    // {
    //     $this->authorize('delete', $article);
    //     $article->delete();
    //     return redirect()->route('articles.index')->with('success', 'Article deleted successfully!');
    // }

}
