<?php

namespace App\Http\Controllers;

use App\Models\Manufactures;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ManufacturesController extends Controller
{
    public function saveManufacture(Request $request){

        $validator  = Validator::make($request->all(), ['name' => 'required', 'description' => 'required']);

        if($validator->fails()){
            return response()->json(['error' => 'Пусті поля']);
        }

        $category = new Manufactures();
        $category->name = $request->name;
        $category->description = $request->description;
        $category->save();

        return response() ->json(['success' => 'Виробника '. $request->name . ' успішно збережено']);

    }


    public function getManufactures(){
        return response()->json(Manufactures::all());
    }

    public function deleteManufacture($id){

        $category = Manufactures::find($id);
        $category->delete();


        return response()->json(['success' => 'Виробник ' . $category -> name . ' успішно видалений']);
    }

}
