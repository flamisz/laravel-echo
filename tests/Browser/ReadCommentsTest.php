<?php

namespace Tests\Browser;

use App\Article;
use App\Comment;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;

class ReadCommentsTest extends DuskTestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_user_can_view_the_comments_on_article_page()
    {
        $article = factory(Article::class)->create();

        $comment = factory(Comment::class)->create([
            'article_id' => $article->id
        ]);

        $this->browse(function ($browser) use ($comment, $article) {
            $browser->visit("/articles/{$article->slug}")
                    ->waitUntil('app.__vue__._isMounted')
                    ->assertSee($comment->body);
        });
    }
}
