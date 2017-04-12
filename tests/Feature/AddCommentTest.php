<?php

namespace Tests\Feature;

use App\Article;
use App\Comment;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class AddCommentTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_logged_in_user_can_create_comment()
    {
        $user = factory(User::class)->create();
        $article = factory(Article::class)->create();

        $comment = factory(Comment::class)->make([
            'article_id' => $article->id
        ]);

        $this->actingAs($user);
        $this->post('/comments', [
            'article_id' => $article->id,
            'body' => $comment->body
        ]);

        $this->assertDatabaseHas('comments', [
            'body' => $comment->body
        ]);
    }

    /** @test */
    public function a_guest_user_can_not_create_comment()
    {
        $article = factory(Article::class)->create();

        $comment = factory(Comment::class)->make([
            'article_id' => $article->id
        ]);

        $this->post('/comments', [
            'article_id' => $article->id,
            'body' => $comment->body
        ])->assertRedirect('/login');
    }
}
