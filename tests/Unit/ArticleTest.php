<?php

namespace Tests\Unit;

use App\Article;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ArticleTest extends TestCase
{
    use DatabaseMigrations;

    protected $article;

    public function setUp()
    {
        parent::setUp();
        $this->article = factory(Article::class)->create();
    }

    /** @test */
    public function an_article_has_comments()
    {
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->article->comments);
    }
}
