<?php

namespace App\Http\Controllers;

use App\Article;
use App\Comment;
use App\Events\CommentCreated;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'article_id' => 'required|integer',
            'body' => 'required',
        ]);

        $comment = Comment::create([
            'user_id' => auth()->id(),
            'article_id' => request('article_id'),
            'body' => request('body')
        ]);

        event(new CommentCreated($comment));
        
        return $comment->load('creator');
    }

    public function index(Article $article)
    {
        return $article->comments()->with('creator')->orderBy('created_at', 'desc')->get();
    }
}
