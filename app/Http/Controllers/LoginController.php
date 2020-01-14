<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Login;


class LoginController extends Controller
{
    public function dologin(Request $request)
    {
        $post = $request -> except('_token');

        $post['pwd'] = md5($post['pwd']);

        $user =Login::where($post) -> first();

        if($user){

            session(['admin'=>$user]);

            request() -> session() -> save();

           return redirect('/goods');
            //return redirect('/brand');

        }
        return redirect('/login') -> with('msg','没有此用户！请联系管理员');
    }

    public function logout()
    {
        session(['admin'=>null]);

        request() -> session() -> save();

        return redirect('/login');
    }
}
