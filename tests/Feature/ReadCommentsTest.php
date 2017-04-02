<?php

namespace Tests\Feature;

use App\Article;
use App\Comment;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class ReadCommentsTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_user_can_view_the_comments_on_article_page()
    {
        $article = factory(Article::class)->create();

        $comment = factory(Comment::class)->create([
            'article_id' => $article->id
        ]);

        $this->get("/articles/{$article->slug}")
             ->assertSee($comment->body);
    }
}
