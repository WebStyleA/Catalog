<?php

namespace App\Servise;

use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;
use Illuminate\Support\Facades\Session;


class IsAdmin
{

    private static function validator($name,$pass){

        $admin = Admin::where("login", $name)->first();
        if(!empty($admin)){
            $isValid = Hash::check($pass,$admin->password);
            if($isValid) return true;
            else return false;
        }

        return false;

    }


    public static function attempt($args){

            if(IsAdmin::validator($args['login'],$args['password'])){
                Session::put('admin_password', $args['password']);
                Session::put('admin_login', $args['login']);
                return true;
            }

            return false;


    }


    public static function check(){

        $ses_login = Session::get('admin_login');
        $ses_pass  = Session::get('admin_password');

        if(!empty($ses_login) && !empty($ses_pass))
            if(IsAdmin::validator($ses_login,$ses_pass)) return true;

        return false;

    }

    public static function user()
    {

        if (IsAdmin::check())
            return Admin::where('login', Session::get('admin_login'));

        return false;


    }


    public function logout(){
        if(IsAdmin::check()){
            Session::forget('admin_login');
            Session::forget('admin_password');
            if(!IsAdmin::check())
                return true;
        }

        return false;
    }
}
