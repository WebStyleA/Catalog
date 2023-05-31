<?php

namespace App\Servise;

use App\Models\Product;

class productFilter
{

    public static function getProducts($request){

        if(!empty($request->name) && empty($request->category_id) && empty($request->manufactury_id)){
            return Product::where('name', 'like', "{$request->name}%")->get();
        } elseif (!empty($request->name) && !empty($request->category_id) && empty($request->manufactury_id)){
            return Product::where('name', 'like', "{$request->name}%")->where('category_id', $request->category_id)->get();
        } elseif (!empty($request->name) && !empty($request->category_id) && !empty($request->manufactury_id)){
            return Product::where('name', 'like', "{$request->name}%")->where('category_id', $request->category_id)->where('manufactures_id', $request->manufactury_id)->get();
        } elseif (empty($request->name) && !empty($request->category_id)&& empty($request->manufactury_id)){
            return Product::where('category_id',$request->category_id)->get();
        } elseif (empty($request->name) && !empty($request->category_id) && !empty($request->manufactury_id)){
            return Product::where('category_id',$request->category_id)->Product::where('manufactures_id',$request->category_id)->get();
        } else {
            return Product::all();
        }



    }

}
