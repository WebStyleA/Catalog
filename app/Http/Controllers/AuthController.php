<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use App\Servise\IsAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    private $secretKeys = [
        'fas0fas9vaas' => true,
        '09jfasf9j9fn891f' => true,
        'd12r2rsrfasf1267r' => true,
        '*77e9hDASH&uF9821hd' => true
        ];


    public function loginAdmin(Request $request){

        $validator = Validator::make($request->all(), ['login' => 'required', 'password' =>'required']);
        if($validator->fails()) return response()->json(['error' => 'Заповніть всі поля']);



        if(isAdmin::attempt(['login' => $request->login, 'password' => $request->password])){
            return response()->json(['success' => 'Перенаправлення....']);
        }

        return response()->json(['error' => 'Невірні данні']);

    }


    public function registrateAdmin(Request $request){
        $validator = Validator::make($request->all(), ['login' => 'required', 'password' =>'required','secretKey' => 'required']);
        if($validator->fails()) return response()->json(['error' => 'Заповніть всі поля']);

        if(array_key_exists($request->secretKey,$this->secretKeys)){
            $admin = Admin::where("login", $request->login)->first();
            if(empty($admin)){
                $admin = new Admin();
                $admin->login = $request->login;
                $admin->password = Hash::make($request->password);
                $admin->secretKey = $request->secretKey;
                $admin->save();

                if(isAdmin::attempt(['login' => $request->login, 'password' => $request->password])){
                    return response()->json(['success' => 'Перенаправлення....']);
                } else
                    return response()->json(['error' => 'Щось пішло не так! Звяжіться з адміністратором']);


            } else
                return response()->json(['error' => "Ім'я ". $request->login . ' вже існує']);

        }


        return response()->json(['error' => "Невірний ключ"]);

    }


    public function loginUser(Request $request){

        if(Validator::make($request->all(), [
            'login' => 'required',
            'password' => 'required'
        ])->fails())
            return response()->json(['error' => 'Не всі поля заповненні']);

        if(Auth::attempt(['name' => $request->login, 'password' => $request->password])){
            return response()->json(['success' => 'Перенаправлення....']);
        }

        return response()->json(['error'=> 'Невірні логін або пароль']);


    }

    public function registerUser(Request $request){
        if(Validator::make($request->all(), [
            'login' => 'required',
            'password' => 'required',
            'email' => 'required|email'
        ])->fails())
            return response()->json(['error' => 'Не всі поля заповненні']);

        $user1 = User::where('name' ,$request->login)->first();
        $user2 = User::where('email',$request->email)->first();





        if(!empty($user1)) return response()->json(['error' => "Такий логін вже існує"]);
        if(!empty($user2)) return response()->json(['error' => "Такий е-маіл вже існує"]);



        $user = new User();
        $user->name = $request->login;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();


        Auth::login($user);

        return response()->json(['success' => 'Успішна реєстрація ']);
    }






}
