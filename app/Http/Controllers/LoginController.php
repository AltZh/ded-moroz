<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
    public function login(){

        if(Auth::check()){
            //потенциально можно сделать logout и потом отоброжать login
            return redirect()->route('home');
        }

        return view('login');
    }

    public function auth( Request $request ){
        $validatedData = $request->validate([
            'email' => 'required|email|max:150|min:3',
            'password' => 'required|min:6|max:10' //regex:([0-9a-zA-Z\-])
        ]);

        if( Auth::attempt($validatedData, true) ){

            $request->session()->regenerate();

            $role = Auth::user()->role;

            switch($role) {
                case 'admin':
                        return redirect()->route('letters.list');
                    break;
                default:
                    return redirect()->intended();
                    break;
            }

        }

        return back()->withErrors(['auth_error'=>'Такого пользователя не существует']);

    }

    public function register(Request $request){
        $validatedData = $request->validate([
            'name' => 'bail|required',
            'email' => 'bail|required|email',
            'password' => 'required|min:6|max:10',
            'password_2' => 'required|min:6|max:10'
        ]);

        if( $validatedData['password'] == $validatedData['password_2'] ){

            $n_user = User::where('email', $validatedData['email'])->count();
            if($n_user == 1){ return back()->withErrors('Такой пользователь уже зарегистрирован'); }

            $user = new User;
            $user->name = $validatedData['name'];
            $user->email = $validatedData['email'];
            $user->password = Hash::make($validatedData['password']);
            $user->save();


            if( Auth::attempt($validatedData, true) ){
                $request->session()->regenerate();
            }

            return redirect()->intended();
            //return redirect()->route('home');
            
        } else {
            return back()->withErrors('пароли не совпадают');
        }

    }

    public function logout( Request $request ){

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
