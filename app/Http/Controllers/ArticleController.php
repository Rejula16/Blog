<?php

namespace App\Http\Controllers;

use App\Http\Requests\Article\Store;
use App\Http\Requests\Article\Update;
use App\Models\{Article, Category, HashTag};

use Illuminate\Http\Request;

class ArticleController extends Controller
{
    
    public function index()
    {
        // print("abc");
        $articles = Article::all();
        return view('articles.index', compact('articles'));
    }
    // public function test(){
    //     return "haaaai";
    // }

    public function create()
    {
       
        $categories = Category::all(); 
        return view('articles.create', compact('categories'));
    }

    public function store(Store $request)
    {
        $article = Article::create([
            'title' => $request->title,
            'body' => $request->body,
            'category_id' => $request->category_id,
            'user_id' => auth()->id(), 
            'slug'=> $request->user_id,
        ]);

        // Attach hashtags to the article if provided
        if ($request->has('hashtags')) {
            $article->hashTags()->sync($request->hashtags);
        }

        return redirect()->route('articles.index')->with('success', 'Article created successfully!');
    }

    public function show(Article $article)
    {
        return view('articles.show', compact('article'));
    }

    public function edit(Article $article)
    {
        $this->authorize('update', $article);
        $hashtags=HashTag::all();
        $categories = Category::all(); 
        return view('articles.edit', compact('article','categories','hashtags'));
    }

    public function update(Update $request, Article $article)
    {
        $this->authorize('update', $article);
        $article->update([
            'title' => $request->title,
            'body' => $request->body,
            'category_id' => $request->category_id,
        ]);

        // Sync hashtags
        if ($request->has('hashtags')) {
            $article->hashTags()->sync($request->hashtags);
        } else {
            $article->hashTags()->detach();
        }

        return redirect()->route('articles.index')->with('success', 'Article updated successfully!');
    }

    public function destroy(Article $article)
    {
        $this->authorize('delete', $article);
        $article->delete();
        return redirect()->route('articles.index')->with('success', 'Article deleted successfully!');
    }

}
