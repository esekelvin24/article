<?php

namespace App\Http\Controllers\api\v1;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    //
    public function index()
    {
        return Product::all();
    }

    public function show($id)
    {
       $productCollections = Product::find($id);

       if($productCollections)
       {
            return response()->json([
                'success'=>true,
                'message'=>'successful',
                'data'=>$productCollections
            ], 200);
       }else
       {
            return response()->json([
                'success'=>false,
                'message'=>'Product not found',
                'data'=>$productCollections
            ], 200);
       }

       return $productCollections;
    }

    public function update($id, Request $request)
    {
        $product = Product::find($id);

        if($product)
        {
            $product->title = $request->title;
            $product->images = $request->images;
            $product->update();

            return response()->json([
                'success'=>true,
                'message'=>'Product has been updated',
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
        $product = new Product;

        $product->title = $request->title;
        $product->images = $request->images;
        $product->created_at = NOW();
        $product->save();

        return response()->json([
            'success'=>true,
            'message'=>'Your product has been created',
            'data'=>$product
        ], 201);
    }
}
