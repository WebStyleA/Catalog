<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
     public function saveProduct(Request $request){

         $validator = Validator::make($request->all(), [
             'name' => 'required',
             'cost' => 'required',
             'description' => 'required',
             'photo' => 'required|mimes:png,jpg,gif',
             'category_id' =>'required',
             'manufactures_id' => 'required'
         ]);



         if($validator->fails()) return response()->json(['error' => 'Щось пішло не так, перевірте паравильність введених данних!']);

         $file = $request->file('photo');

         $path = $file->store('public/products');
         $path = str_replace("public","/storage",$path);

         $product = new Product();
         $product->name = $request->name;
         $product->cost = $request->cost;
         $product->description = $request->description;
         $product->photo = $path;
         $product->category_id = $request->category_id;
         $product->manufactures_id = $request->manufactures_id;
         $product->save();

         return response()->json(['success' => 'Товар '. $product->name . ' успішно збережений', 'path' => $path]);


     }

     public function filter(Request $request){

         $products = Product::query()->categoryId($request->category_id)->name($request->name)
             ->manufactureId($request->get("manufacture_id"))->get();



        foreach ($products as $item){
            $item->category_id = $item->category->name;
            $item->manufactures_id = $item->manufactures->name;
        }


         return response()->json(['products' => $products , 'success' => 'Знайдено '. count($products) . ' товарів по вашому запиту']);

     }

     public function getProduct(){

         return response()->json(Product::all());
    }




    public function deleteProduct($id){

         $product = Product::find($id);
         $product->delete();
         return response()->json(['success' => "Товар ". $product->name . " успішно видалено!" ]);
    }
}
