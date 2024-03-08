<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

#Models
use App\Models\User;

#Services
use App\Service\UserService;

#Requests
use App\Requests\StoreUserRequest;


class ApiUserController extends Controller
{
    
    public function __construct(private UserService $userService){}


    public function register(StoreUserRequest $request){

        try{

            
            

        }catch(Exception $e){
            
        }
    }
}
