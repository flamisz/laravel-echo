<?php

namespace App\Http\Controllers;

use App\Article;
use App\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $comment = Comment::create([
            'user_id' => auth()->id(),
            'article_id' => request('article_id'),
            'body' => request('body')
        ]);
        
        return redirect("/articles/{$comment->article->slug}");
    }

    public function index(Article $article)
    {
        return $article->comments;
    }
}
