<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
#Facades
use Illuminate\Support\Facades\Hash;

#Models
use App\Models\User;
use App\Models\Voucher;

#Services
use App\Services\UserService;

#Requests
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\LoginPostRequest;

#Helpers
use App\Helpers\Helper;

#Jobs
use App\Jobs\WelcomeEmailJob;

class UserController extends Controller
{
    public function __construct(private UserService $userService){}


    public function register(StoreUserRequest $request){

        try{
            $user_data =[
                "username" =>$request->username,
                "first_name" =>$request->first_name,
                "email" =>$request->email,
                "password" =>Hash::make($request->password),

            ];

            #Generate Voucher Code
            
            $voucher = Helper::VoucherGenarator(5);
            $create_user = $this->userService->store($user_data,$voucher);
            
            WelcomeEmailJob::dispatch($request->email,$request->username,$voucher)->onQueue('welcome_email');
            
            return response()->json([
                "success" => true,
                "message" => "User Successfully Created",
                "data" => $create_user
            ],201);
            
            

        }catch(\Exception $e){

            return response()->json([
                "success" => false,
                "server_response" => $e->getMessage(),
            ],500);
        }
    }

    public function login(LoginPostRequest $request){

        try{


            $credentials=[
                "password" =>$request->password,
            
            ];
            $query = User::query();

            
            if(array_key_exists('email',$request->all())){
                $query->where("email",$request->email);

                $type="email";
                $credentials['email'] =$request->email;

            }else{
                $query->where("username",$request->username);

                $type="username";

                $credentials['username'] =$request->username;

            }

            $account = $query->first();

            if(!$account){

                return response()->json([
                    "success" => false,
                    "message" => $type. " doesn't exist"
                ],404);
            }

          

            if (Auth::attempt($credentials)) {

                $token = $account->createToken($account->email.'-AuthToken')->plainTextToken;


                return response()->json([
                    "success" => true,
                    "message" => "Login Succesfully",
                    "data" => [
                        "token" => $token
                    ]
                ],200);
            
                
            } else {

                return response()->json([
                    "success" => false,
                    "message" => "Invalid Credentials"
                ],404);

            }
           
        }catch(\Exception $e){

            return response()->json([
                "success" => false,
                "server_response" => $e->getMessage(),
            ],500);

        }
    }

    public function logout(){
        
        auth()->user()->tokens()->delete();
    
        return response()->json([
          "message"=>"logged out"
        ],200);
    }
}
