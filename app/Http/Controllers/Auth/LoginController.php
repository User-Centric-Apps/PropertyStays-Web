<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
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

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function postLogin(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $credentials = array(
            "email" => request("email"),
            "password" => request("password"),

        );
        $user  = User::where('email', '=', request("email"))->first();
        if($user)
        {
            if($user->status == 0)
            {
                return redirect('login')->with('danger', 'You are not approved/deactivated by Admin, Please contact on help line!');
            }
            else
            {
                if(Auth::attempt($credentials))
                {
                    if($user->type == 2)
                    {
                        session()->put('user_type', 2);
                    }
                    else
                    {
                        session()->put('user_type', 1);
                    }
                    return redirect()->intended('home');
                }
                return redirect('login')->with('danger', 'Oppes! You have entered invalid credentials');
            }
            
        }
        else
        {
           return redirect('login')->with('danger', 'Oppes! You have entered invalid credentials');
        }
        
    }

    public function logout()
    {
        Auth::logout();
        return redirect('login');
    }
}
