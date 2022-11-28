<?php

namespace App\Http\Controllers\admin\Auth;

use Validator;
use Session;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Admin;
use Auth;

class LoginController extends Controller
{

    use AuthenticatesUsers;

    protected $redirectTo = '/home';
    
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
        $this->middleware('guest:admin', ['except' => 'logout']);
    }

    public function getLogin()
    {
        return view('admin.auth.login');
    }

   public function postLogin(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);

        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {
            return redirect('admin/dashboard');
            
        } else {
            return back()->with('danger','your username and password are wrong.');
        }

        //return back()->withInput($request->only('email', 'remember'));

    }

    /**
     * Show the application logout.
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        Auth::guard('admin')->logout();    
        return redirect('admin/login');
    }
}
