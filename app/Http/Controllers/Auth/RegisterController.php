<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Socialite;
use Mail;
use App\Rules\ReCaptcha;

class RegisterController extends Controller
{

    use RegistersUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function signUp(Request $request)
    {
        return view('auth.register');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'mobile' => 'required',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|confirmed',
            'g-recaptcha-response' => ['required', new ReCaptcha]
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $input = $request->all();
        $viewps = $input['password'];
        
        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'view_pass' => $input['password'],
            'mobile' => $input['mobile'],
            'type' => $input['type'],
            'status' => 0,
            'joined' => date('Y-m-d'),
        ]);

        $this->emailTemp(2, $user->name, $user->email, $user->view_pass);

        return redirect('login')->with('danger-reg', 'Your account has been created and waiting for admin approval. Thanks');

        /*$credentials = array(
            "email" => $input['email'],
            "password" => $viewps,

        );

        if(Auth::attempt($credentials))
        {
            if($input['type'] == 2)
            {
                session()->put('user_type', 2);
            }
            else
            {
                session()->put('user_type', 1);
            }
            return redirect('home')->with('success', 'Your account has been created! Thanks');
        }*/
    }

    public function redirect($provider, Request $request)
    {
        return Socialite::driver($provider)->redirect();
    }
     
    public function callback($provider)
    {

        try 
        {
            $getInfo = Socialite::driver($provider)->stateless()->user();

            $user = User::where('provider_id', $getInfo->id)->first();

            if($user)
            {

                if($user->status == 0)
                {
                    return redirect('login')->with('danger-reg', 'You are not approved/deactivated by Admin, Please contact on help line!');
                }
                else
                {
                    Auth::login($user, true);
                    return redirect()->intended('home');
                }

            }
            else
            {

                $usrEmail = User::where('email', $getInfo->email)->first();

                if($usrEmail)
                {
                    $userDetail = User::find($usrEmail->id);
                    $userDetail->provider = $provider;
                    $userDetail->provider_id = $getInfo->id;
                    $userDetail->save();

                    Auth::login($usrEmail, true);

                    return redirect()->intended('home');
                }
                else
                {
                    $user = User::create([
                        'name' => $getInfo->name,
                        'email' => $getInfo->email,
                        'password' => Hash::make('123456'),
                        'view_pass' => '123456',
                        'mobile' => '',
                        'provider' => $provider,
                        'provider_id' => $getInfo->id,
                        'type' => 2,//Traveller
                        'status' => 0,
                        'joined' => date('Y-m-d'),
                    ]);

                    return redirect('login')->with('danger-reg', 'Your account has been created and waiting for admin approval. Thanks');
                }

                

            }

        }
        catch (Exception $e) 
        {
            return redirect()->back()->withErrors($e->getMessage())->withInput();
        }
     
    }

    public function emailTemp($type = null, $name = null, $email, $view_pass) 
    {
        if($email)
        {
            try {

                $data = array('type' => $type, 'name' => $name, 'email' => $email,'password' => $view_pass);

                $subject = 'Registration Details';

                Mail::send('emails/registration', $data, function($message) use ($email, $subject) {
                  $message->from('info@propertystays.com', 'PropertyStays.com');
                  $message->to($email)->subject($subject);
                });

            }
            catch (Exception $e)
            {
                
            }
        }
    }

}
