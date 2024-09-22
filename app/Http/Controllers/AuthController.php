<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{

    public function login(Request $request)
    {
        $response = ["status" => false, "message" => ''];
        $rules = [
            'email' => 'required|email',
            'password' => 'required',
        ];
    
        $validator = Validator::make($request->all(), $rules);
    
        if ($validator->fails()) {
            $response['message'] = $validator->messages();
        } else {
            $credentials = $request->only('email', 'password');
    
            if (Auth::attempt($credentials)) {
                $user = Auth::user();
                $token = $user->createToken('AppName')->accessToken;
                $response = [
                    'status' => true,
                    'message' => 'Login Successfully',
                    'token' => $token,
                    'data' => $user
                ];
            } else {
                $response['message'] = 'Invalid email or password';
            }
        }
    
        return $response;
    }
    

    public function logout(Request $request)
 
{
  
    $user = Auth::guard('api')->user();
    if ($user) {

        $user->tokens()->delete();
        
    
    } else {
        dd('User not authenticated');
    }

       $response =  response()->json([
            'status' => true,
            'message' => 'Logout Successfully!',
        ]);
        return  $response;

    }

   
}


?>