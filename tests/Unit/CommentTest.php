<?php

namespace Tests\Unit;

use App\Comment;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class CommentTest extends TestCase
{
    use DatabaseMigrations;

    protected $comment;

    public function setUp()
    {
        parent::setUp();

        $this->comment = factory(Comment::class)->create();
    }

    /** @test */
    public function a_comment_has_a_creator()
    {
        $this->assertInstanceOf('App\User', $this->comment->creator);
    }

    /** @test */
    public function a_comment_belongs_to_an_article()
    {
        $this->assertInstanceOf('App\Article', $this->comment->article);
    }
}
