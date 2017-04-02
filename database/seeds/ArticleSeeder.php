<?php

use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Article::class, 25)->create()->each(function ($article) {
            factory(App\Comment::class, 5)->create(['article_id' => $article->id]);
        });
    }
}
