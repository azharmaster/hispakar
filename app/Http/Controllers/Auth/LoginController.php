<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    protected function redirectTo(){
        if(Auth()->user()->usertype == 1){
            return route('admin.contents.dashboard');
        }
        elseif(Auth()->user()->usertype == 2)
        {
            return route('doctor.contents.dashboard');
        }
        elseif(Auth()->user()->usertype == 3)
        {
            return route('nurse.contents.dashboard');
        }
        elseif(Auth()->user()->usertype == 4)
        {
            return route('patient.contents.dashboard');
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login (Request $request)
    {
        $input = $request->all();
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (auth()->attempt(['email' => $input["email"], 'password'=>$input["password"]]))
        {
            if(auth()->user()->usertype == 1)
            {
                return redirect()->route('admin.contents.dashboard');
            }

            else if(auth()->user()->usertype == 2)
            {
                return redirect()->route('doctor.contents.dashboard');
            }

            else if(auth()->user()->usertype == 3)
            {
                return redirect()->route('nurse.contents.dashboard');
            }

            else if(auth()->user()->usertype == 4)
            {
                return redirect()->route('patient.contents.dashboard');
            }
        }

        else
        {
            return redirect()->route('login')->with("error", 'Incorrect email or password');
        }
        
    }
}
