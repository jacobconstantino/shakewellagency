<?php

namespace App\Helpers;

#Models
use App\Models\Voucher;

class Helper{

    public static function VoucherGenerator($length){

        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        $voucher = substr(str_shuffle($characters), 0, $length);


        #Checker if the voucher code is already exist.
        
        $validate_voucher = Voucher::where('voucher',$voucher)->exists();

        while($validate_voucher){

            #Generate Voucher code if already exist.
            
            $voucher = substr(str_shuffle($characters), 0, $length);
            $validate_voucher = Voucher::where('voucher','=',$voucher)->exists();
        }

        return $voucher;
    }
}