<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


#Models
use App\Models\User;

#Services
use App\Services\UserService;

#Requests
use App\Http\Requests\StoreUserRequest;


class UserController extends Controller
{
    public function __construct(private UserService $userService){}


    public function register(StoreUserRequest $request){

        try{


            return response()->json([
                "success" => true,
                "message" => "test"
            ],201);
            
            

        }catch(Exception $e){
            

            return response()->json([
                "success" => false,
                "message" => "test"
            ],201);
        }
    }
}
