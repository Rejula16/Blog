<?php

namespace App\Http\Controllers;

use App\Models\{Article,Category,HashTag };


class ArticleService
{
    public function getAllArticles()
    {
        return Article::all();
    }

    public function getAllCategories()
    {
        return Category::all();
    }

    public function getAllHashTags()
    {
        return HashTag::all();
    }


    public function getArticleById($id)
    {
        return Article::findOrFail($id);
    }

    public function createArticle(array $data)
    {
        $data['user_id']=auth()->id();
        return Article::create($data);
    }

    public function updateArticle($id, array $data)
    {
        
        $article = Article::findOrFail($id);

        
        $article->update($data);
        return $article;
    }

    public function deleteArticle($id)
    {
        $article = Article::findOrFail($id);
        $article->delete();
    }

    public function syncHashtags(Article $article, $hashtags)
    {
        if ($hashtags) {
            $article->hashTags()->sync($hashtags);
        } else {
            $article->hashTags()->detach();
        }
    }
}
