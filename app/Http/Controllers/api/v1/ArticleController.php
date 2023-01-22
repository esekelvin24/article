<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\ArticleComments;
use DB;

class ArticleController extends Controller
{
    //
    //
    public function index()
    {
        return Article::all();
    }

    public function show($id)
    {
       $articleCollections = Article::find($id)->orderBy('created_at','desc'); //LIFO

       if($articleCollections)
       {
            return response()->json([
                'success'=>true,
                'message'=>'successful',
                'data'=>$articleCollections
            ], 200);
       }else
       {
            return response()->json([
                'success'=>false,
                'message'=>'Article not found',

            ], 200);
       }

       return $articleCollections;
    }

    public function show_comments($id)
    {


       $articleCollections = DB::table('article_comment')
       ->where('article_comment.article_id',$id)->get();


       if($articleCollections)
       {
            return response()->json([
                'success'=>true,
                'message'=>'successful',
                'data'=>$articleCollections
            ], 200);
       }else
       {
            return response()->json([
                'success'=>false,
                'message'=>'product does not exist',

            ], 200);
       }

       return $articleCollections;
    }

    public function update($id, Request $request)
    {
        $article = Article::find($id);

        if($article)
        {
            $article->title = $request->title;
            $article->images = $request->images;
            $article->update();

            return response()->json([
                'success'=>true,
                'message'=>'Article has been updated',
            ], 201);

        }else
        {
            return response()->json([
                'success'=>false,
                'message'=>'Product not found',
            ], 201);
        }
    }

    public function destroy($id)
    {
        $product = Product::find($id);


        if ($product)
        {
            $product->delete();

             return response()->json([
                'success'=>true,
                'message'=>'Your product has been deleted',
                'data'=>$product
            ], 202);
        }else
        {
            return response()->json([
                'success'=>false,
                'message'=>'Invalid product ID',
            ], 200);
        }


    }

    public function store(Request $request)
    {
        $article = new Article;

        $article->full_text = $request->full_text;
        $article->cover = $request->cover;
        $article->created_at = NOW();
        $article->save();

        return response()->json([
            'success'=>true,
            'message'=>'Your article has been created',
            'data'=>$article
        ], 201);
    }

    public function store_comments($id,Request $request)
    {
        $articleComments = new ArticleComments;

        $articleComments->article_id = $id;
        $articleComments->comments = $request->comments;
        $articleComments->created_at = NOW();
        $articleComments->updated_at = NOW();
        $articleComments->save();


        return response()->json([
            'success'=>true,
            'message'=>'Your comments have been added to this article',
            'data'=>$articleComments
        ], 201);
    }

    public function likes_article($id)
    {
        $article = Article::find($id);

        $article->likes += 1;
        $article->save();


        return response()->json([
            'success'=>true,
            'message'=>'You just like this article',
            'data'=>$article
        ], 201);
    }

    public function view_article($id)
    {
        $article = Article::find($id);

        $article->views += 1;
        $article->save();


        return response()->json([
            'success'=>true,
            'message'=>'You just view this article',
            'data'=>$article
        ], 201);
    }

    public function show_likes($id)
    {
        $article = Article::where('id',$id)->select('likes')->get();


        return response()->json([
            'success'=>true,
            'message'=>'Total Like counts',
            'data'=>$article[0]->likes
        ], 201);
    }

    public function show_views($id)
    {
        $article = Article::where('id',$id)->select('views')->get();


        return response()->json([
            'success'=>true,
            'message'=>'Total Views counts',
            'data'=>$article[0]->likes
        ], 201);
    }


}
