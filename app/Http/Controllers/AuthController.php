<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\registerUserRequest;

class AuthController extends Controller
{
    public function index()
    {
        return view('Auth.login');
    }

    public function login(Request $request)
    {
        //Validate data
        $request->validate([
            "email"     =>  ["required","email"],
            "password"  =>  ["required",Rules\Password::defaults()]
        ]);

        //Login code
        if(!Auth::attempt($request->only("email","password"))){            
            //return redirect()->back()->withError('Error');
            //$request->session()->flush('error','Error Occured.');
            // return redirect(request()->headers->get('referer'))->with('xxx');
            //  $errors = "No Error";
            //  return redirect()->back()->withInput()->withError(['error' => $errors]);
            return redirect()->back()->withInput()->with('error', 'Invalid login credentials');
        }

        return redirect()->route('home')->with('success', 'Loggedin successfully.');
    }
    public function registerView()
    {
        return view('Auth.register');
    }
    public function register(registerUserRequest $request)
    {
        //Validate data
        $request->validated($request->all());

        //Create a new user in User table
        $user = User::create([
            "name"  =>  $request->name,
            "email"  =>  $request->email,
            "password"  =>  Hash::make($request->password),
        ]);

        //Login code
        if(!Auth::attempt($request->only("email","password"))){            
            //return redirect('register')->withError('error');
            return redirect('register')->with('error', 'Invalid login credentials');
        }

        return redirect("/");        
    }

    public function logout(){
        Session::flush();
        Auth::logout();
        return redirect()->route('home')->withSuccess('Reomved successfully');        
    }
}
