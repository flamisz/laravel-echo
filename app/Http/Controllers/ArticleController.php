<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::all();

        return view('articles.index', compact('articles'));
    }

    public function show(Article $article)
    {
        // $article->load('comments.creator');
        $article->load(['comments' => function ($query) {
            $query->with('creator')->orderBy('created_at', 'desc');
        }]);
        return view('articles.show', compact('article'));
    }
}
