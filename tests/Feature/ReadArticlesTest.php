<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ReadArticlesTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function a_user_can_view_all_articles()
    {
        $article = factory('App\Article')->create();
        $this->get('/articles')
            ->assertSee($article->title);
    }
}
