<?php

namespace Tests\Browser;

use App\Article;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;

class CreateCommentTest extends DuskTestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_logged_in_user_can_see_create_comment_form_on_article_page()
    {
        $user = factory(User::class)->create();
        $article = factory(Article::class)->create();

        $this->browse(function ($browser) use ($article, $user) {
            $browser->loginAs($user)
                    ->visit("/articles/{$article->slug}")
                    ->assertVisible('input[name=body]');
        });
    }

    /** @test */
    public function a_guest_user_can_not_see_create_comment_form_on_article_page()
    {
        $article = factory(Article::class)->create();

        $this->browse(function ($browser) use ($article) {
            $browser->visit("/articles/{$article->slug}")
                    ->assertMissing('input[name=body]')
                    ->assertSeeLink('login');
        });
    }

    /** @test */
    public function after_create_comment_user_can_see_comment()
    {
        $user = factory(User::class)->create();
        $article = factory(Article::class)->create();

        $this->browse(function ($browser) use ($article, $user) {
            $browser->loginAs($user)
                    ->visit("/articles/{$article->slug}")
                    ->type('body', 'This is my comment')
                    ->press('Publish')
                    ->assertSee('This is my comment');
        });
    }

    /** @test */
    public function submit_create_comment_without_body_shows_error()
    {
        $user = factory(User::class)->create();
        $article = factory(Article::class)->create();

        $this->browse(function ($browser) use ($article, $user) {
            $browser->loginAs($user)
                    ->visit("/articles/{$article->slug}")
                    ->press('Publish')
                    ->waitForText('required')
                    ->assertSee('required');
        });
    }

    
    public function a_user_can_view_if_somebody_write_a_comment()
    {
        $userWriter = factory(User::class)->create();
        $userReader = factory(User::class)->create();
        $article = factory(Article::class)->create();

        $this->browse(function ($first, $second) use ($article, $userWriter, $userReader) {
            $first->loginAs($userReader)
                   ->visit("/articles/{$article->slug}")
                   ->waitForText('This is my comment')
                   ->assertSee($userWriter->name);

            $second->loginAs($userWriter)
                    ->visit("/articles/{$article->slug}")
                    ->type('body', 'This is my comment')
                    ->press('Publish');
        });
    }
}
