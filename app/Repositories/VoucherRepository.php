<?php


namespace App\Repositories;


use App\Models\Voucher;

class VoucherRepository{



    public function index($data){

        $query = Voucher::query();

        if(array_key_exists('id', $data)) {
            $query->where('id', '=', $data['id']);
        }


        if(array_key_exists('user_id', $data)) {
            $query->where('user_id', '=', $data['user_id']);
        }


        if(array_key_exists('voucher', $data)) {
            $query->where('voucher', '=', $data['voucher']);
        }

        // $data = Flight::paginate(5, ['*'], 'page', 1);

        return $query->paginate(array_key_exists('paginate', $data) ? $data['paginate'] : 10 , ['*'] ,'page', array_key_exists('page', $data) ? $data['page'] : 1) ;

    }

    public function VoucherCounter($user_id){

        $counter = Voucher::where("user_id",$user_id)->count();

        return $counter;
    }
    public function store($data){

        $create = Voucher::create($data);

        return $create;
    }

    public function delete($data){


        $query = Voucher::query();

        if(array_key_exists('id', $data)) {
            $query->where('id', '=', $data['id']);
        }

        if(array_key_exists('voucher', $data)) {
            $query->where('voucher', '=', $data['voucher']);
        }

        $query->delete();

        return $query;
    }

    
}