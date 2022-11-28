<?php
namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Models\User;
use URL;
   
class AuthController extends BaseController
{

    public function signin(Request $request)
    {
        $credentials = array(
            "email" => request("email"),
            "password" => request("password"),

        );
            header("Access-Control-Allow-Origin: *");
        if(Auth::attempt($credentials))
        {
            $authUser = Auth::user();
            $success['status'] =  1;
            $success['id'] =  $authUser->createToken('MyAuthApp')->plainTextToken; 
            $success['token'] =  $authUser->id;
            $success['user_display_name'] =  $authUser->name;
            $success['email'] =  $authUser->email;
            if($authUser->profile_pic)
            {
                $success['profile_pic'] =  URL::asset('storage/app/public/uploads/customers/'.$authUser->profile_pic);
            }
            else
            {
                $success['profile_pic'] =  URL::asset('storage/app/public/uploads/customers/rahim-haji_1639699533.JPG');
            }

            $progress = '0.3';

            if($authUser->name != '')
            {
                $progress = '0.4';
            }
            if($authUser->name != '' && $authUser->surname != '')
            {
                $progress = '0.5';
            }
            if($authUser->st_phone != '' && $authUser->name != '' && $authUser->surname != '')
            {
                $progress = '0.6';
            }
            if($authUser->st_phone != '' && $authUser->name != '' && $authUser->surname != '' && $authUser->address != '')
            {
                $progress = '0.7';
            }
            if($authUser->st_phone != '' && $authUser->name != '' && $authUser->surname != '' && $authUser->address != '' && $authUser->city != '')
            {
                $progress = '0.8';
            }
            if($authUser->st_phone != '' && $authUser->name != '' && $authUser->surname != '' && $authUser->address != '' && $authUser->city != '' && $authUser->country != '')
            {
                $progress = '1';
            }
            $success['progress'] =  $progress;
            
            echo json_encode($success);
        } 
        else{ 
            $json = array("status" => 0, "msg" => "Error in username and password");
            header('Content-type: application/json; charset=utf-8');
            echo json_encode($json);
        } 
    }

    public function signup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);
   
        if($validator->fails()){
            $result = array("status" => 0, "msg" => "Error validation ".$validator->errors()); 
            return response()->json($result, 200);
        }
   
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('MyAuthApp')->plainTextToken;
        $success['name'] =  $user->name;
        $success['profile_pic'] =  URL::asset('storage/app/public/uploads/customers/'.$user->profile_pic);;

        $result = array("status" => 1, "msg" => "registered successfully");
   
        return response()->json($result, 200);
    }

    

    public function forgetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Error validation', $validator->errors());       
        }
   
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('MyAuthApp')->plainTextToken;
        $success['name'] =  $user->name;
   
        return $this->sendResponse($success, 'User created successfully.');
    }

    public function getUDID(Request $request)
    {

        $userDetail = User::select('email', 'view_pass')
                        ->where('user_udid', '=', request('user_udid'))
                        ->first();

        if($userDetail)
        {
            $credentials = array(
                "email" => $userDetail->email,
                "password" => $userDetail->view_pass,

            );
            header("Access-Control-Allow-Origin: *");
            if(Auth::attempt($credentials))
            {
                $authUser = Auth::user(); 
                $success['id'] =  $authUser->createToken('MyAuthApp')->plainTextToken; 
                $success['token'] =  $authUser->id;
                $success['user_display_name'] =  $authUser->name;
                $success['email'] =  $authUser->email;
                
                if($authUser->profile_pic)
                {
                    $success['profile_pic'] =  URL::asset('storage/app/public/uploads/customers/'.$authUser->profile_pic);
                }
                else
                {
                    $success['profile_pic'] =  URL::asset('storage/app/public/uploads/customers/rahim-haji_1639699533.JPG');
                }

                $progress = '0.3';

                if($authUser->name != '')
                {
                    $progress = '0.4';
                }
                if($authUser->name != '' && $authUser->surname != '')
                {
                    $progress = '0.5';
                }
                if($authUser->st_phone != '' && $authUser->name != '' && $authUser->surname != '')
                {
                    $progress = '0.6';
                }
                if($authUser->st_phone != '' && $authUser->name != '' && $authUser->surname != '' && $authUser->address != '')
                {
                    $progress = '0.7';
                }
                if($authUser->st_phone != '' && $authUser->name != '' && $authUser->surname != '' && $authUser->address != '' && $authUser->city != '')
                {
                    $progress = '0.8';
                }
                if($authUser->st_phone != '' && $authUser->name != '' && $authUser->surname != '' && $authUser->address != '' && $authUser->city != '' && $authUser->country != '')
                {
                    $progress = '1';
                }
                $success['progress'] =  $progress;
                
                echo json_encode($success);
            }
            else{ 
                $json = array("status" => 0, "msg" => "Error in username and password");
                header('Content-type: application/json; charset=utf-8');
                echo json_encode($json);
            }
        }
        else
        {
            $json = array("status" => 0, "msg" => "Error in username and password");
            header('Content-type: application/json; charset=utf-8');
            echo json_encode($json);
        }

        
    }
   
}