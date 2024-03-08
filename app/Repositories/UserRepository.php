<?php


namespace App\Repositories;


use App\Models\User;

class UserRepository{


    public function store($data,$voucher){

        $create = User::create($data);

        $voucher_data = $create->vouchers()->create([
            'voucher' => $voucher,
        ]);

        
        return $create;
    }
    
}