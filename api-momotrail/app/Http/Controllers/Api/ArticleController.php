<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ArticleResource;
use App\Models\Article;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::query()
            ->with('user:id,name')
            ->whereNotNull('published_at')
            ->latest('published_at')
            ->paginate(10);

        return ArticleResource::collection($articles);
    }

    public function show(Article $article): ArticleResource
    {
        abort_if(!$article->published_at, 404);

        return new ArticleResource($article->load('user:id,name'));
    }
}