<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MyauthController extends Controller
{
    public function loginView(){
        return view('new.login');
    }

    public function login(){
       //Validation Code

       //Login Code
    }

    public function registerView(){
        return view('new.register');
    }

    public function register(){
        //Validation Code

        //Login Code
    }

    public function logout(){
        
    }
}
