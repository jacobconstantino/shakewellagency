<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

#Models
use App\Models\Voucher;

#Services
use App\Services\VoucherService;


#Helpers
use App\Helpers\Helper;

#Requests
use App\Http\Requests\DeleteVoucherRequest;

class VoucherController extends Controller
{

    public function __construct(protected VoucherService $voucherService){}


    public function index(Request $request){

        try{
           
            $list = $this->voucherService->index($request->all());

            return response()->json([
                "success" => true,
                "message" => "",
                "data" => $list
            ],200);
            
            

        }catch(\Exception $e){

            return response()->json([
                "success" => false,
                "server_response" => $e->getMessage(),
            ],500);
        }

    }

    public function store(Request $request){
        try{

            #Generate Voucher Code
          
            $voucher = Helper::VoucherGenerator(5);

            $user_id = auth()->user()->id;


            $counter = $this->voucherService->VoucherCounter($user_id);

            // This code snippet checks if the counter value exceeds the limit of 10 voucher generations.
            // allowing only up to 10 vouchers to be generated per user.

            if($counter >= 10){

                return response()->json([
                    "success" => false,
                    "message" => "Sorry, you have exceeded the maximum limit of voucher generation. You can only generate up to 10 vouchers."
                ],403);

            }

            $data =[
                "voucher" =>$voucher,
                "user_id" =>$user_id,
            ];


            $create = $this->voucherService->store($data);


            $response_data = [
                "voucher_code" => $voucher
            ];

            return response()->json([
                "success" => true,
                "message" => "Successfully Generated",
                "data" => $response_data
            ],201);
            
            

        }catch(\Exception $e){

            return response()->json([
                "success" => false,
                "server_response" => $e->getMessage(),
            ],500);
        }
    }

    

    public function delete(DeleteVoucherRequest $request){
        

        try{
           
            $count = $this->voucherService->delete($request->all());
            
            if($count == 0){
                return response()->json([
                    "success" => true,
                    "message" => "No Data was Deleted",
                    "data" => []
                ],403);
            }

            return response()->json([
                "success" => true,
                "message" => "Successfully Deleted",
                "data" => []
            ],200);
            
            

        }catch(\Exception $e){

            return response()->json([
                "success" => false,
                "server_response" => $e->getMessage(),
            ],500);
        }


    }
}
