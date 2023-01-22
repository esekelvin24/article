<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Article;
use DB;

class ArticleTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $article_collections = Article::all();
        $insert = array();

        foreach( $article_collections as $val)
        {
           $random_tag = DB::table('tag')->inRandomOrder()->limit(1)->get();

           $insert[] =
           [
              'article_id' => $val->id,
              'tag_id' => $random_tag[0]->id
           ];
        }

        DB::table('article_tag')->insert($insert);

    }
}
