<?php


namespace App\Repositories;


use App\Models\User;

class UserRepository{


    public function store($data){

        $create = User::create($data);

        return $create;
    }
    
}