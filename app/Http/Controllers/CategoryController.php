<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{

    public function saveCategory(Request $request){

                    $validator  = Validator::make($request->all(), ['name' => 'required', 'description' => 'required']);

                    if($validator->fails()){
                        return response()->json(['error' => 'Пусті поля']);
                    }

                    $category = new Category();
                    $category->name = $request->name;
                    $category->description = $request->description;
                    $category->save();

                    return response() ->json(['success' => 'Категорію '. $request->name . ' успішно збережено']);

            }


            public function getCategories(){
                return response()->json(Category::all());
            }

            public function deleteCategory($id){

               $category = Category::find($id);
               $category->delete();


                return response()->json(['success' => 'Категорія ' . $category -> name . ' успішно видалена']);
            }



}
