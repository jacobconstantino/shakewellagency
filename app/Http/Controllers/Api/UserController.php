<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

#Facades
use Illuminate\Support\Facades\Hash;

#Models
use App\Models\User;
use App\Models\Voucher;

#Services
use App\Services\UserService;

#Requests
use App\Http\Requests\StoreUserRequest;

#Helpers
use App\Helpers\Helper;

class UserController extends Controller
{
    public function __construct(private UserService $userService){}


    public function register(StoreUserRequest $request){

        try{
            
            $data =[
                "username" =>$request->username,
                "first_name" =>$request->first_name,
                "email" =>$request->email,
                "password" =>Hash::make($request->password),

            ];

            #Generate Voucher Code
            
            $voucher = Helper::VoucherGenarator(5);

            $create = $this->userService->store($data);

            return response()->json([
                "success" => true,
                "message" => "User Successfully Created",
                "data" => $create
            ],201);
            
            

        }catch(\Exception $e){

            return response()->json([
                "success" => false,
                "server_response" => $e->getMessage(),
            ],500);
        }
    }
}
