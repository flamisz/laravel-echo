<?php

use Illuminate\Database\Seeder;

class ArticlePhotoVideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Article::class, 25)->create();
        factory(App\Video::class, 25)->create();
        factory(App\PhotoCollection::class, 25)->create()->each(function ($photoCollection) {
            factory(App\Photo::class, 25)->create(['photo_collection_id' => $photoCollection->id]);
        });
    }
}
