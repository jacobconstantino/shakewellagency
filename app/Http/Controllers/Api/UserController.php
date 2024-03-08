<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


#Models
use App\Models\User;

#Services
use App\Service\UserService;

#Requests
use App\Requests\StoreUserRequest;


class UserController extends Controller
{
    public function __construct(private UserService $userService){}


    public function register(StoreUserRequest $request){

        try{

            
            

        }catch(Exception $e){
            
        }
    }
}
