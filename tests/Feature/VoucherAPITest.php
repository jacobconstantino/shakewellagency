<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class VoucherAPITest extends TestCase
{
    /**
     * A basic feature test example.
     */



    public function test_register_api(){
        $userData = 
            [
                "username" => "johnsovereign",
                "first_name" => "John Sovereign",
                "email" => "constantino.johnsovereign22@gmail.com",
                "password" => "constantino.johnsovereign22@gmail.com",
        ];
        
        $response = $this->post('/api/register',$userData);

        
        $response->assertStatus(201);

    }
    
    public function test_login_api(){
        $userData = 
        [
                "email" => "constantino.johnsovereign22@gmail.com",
                "password" => "constantino.johnsovereign22@gmail.com",
        ];
        
        $response = $this->post('/api/login',$userData);

        $content = (array) $response->getContent();
        $array = json_decode($content[0], true);


        $response->assertStatus(200);

        return $array['data']['token'];

    }


    
    /**
      * @depends test_login_api
      */

    public function test_get_voucher_api($token){

        $data = [
            "paginate" => 5,
            "page" => 1,
        ];
        $headers = [
            "Accept" => "application/json",
            "Authorization" => "Bearer ". $token
        ];
        $response = $this->withHeaders($headers)->get('/api/voucher',$data,$headers);

        
        $response->assertStatus(200);

        return $token;

    }


    /**
      * @depends test_get_voucher_api
      */

    public function test_create_voucher_api($token){
        $data = [];

        $headers = [
            "Accept" => "application/json",
            "Authorization" => "Bearer ". $token
        ];
        $response = $this->withHeaders($headers)->post('/api/voucher/create',$data,$headers);

        
        $content = (array) $response->getContent();
        $array = json_decode($content[0], true);

        $response->assertStatus(201);
        
        $data_response =[
            "token"=> $token,
            "voucher" => $array['data']['voucher_code']
        ];
        return $data_response;

    }


     /**
      * @depends test_create_voucher_api
      */


    public function test_delete_voucher_api($data_response){
        $data = [
            "voucher"=>$data_response['voucher']
        ];

        $headers = [
            "Accept" => "application/json",
            "Authorization" => "Bearer ". $data_response['token']
        ];
        $response = $this->withHeaders($headers)->delete('/api/voucher/delete',$data,$headers);

        
        $response->assertStatus(200);

        return $data_response['token'];

    }
 /**
      * @depends test_delete_voucher_api
      */

    public function test_logout_api($token){
        $data = [];

        $headers = [
            "Accept" => "application/json",
            "Authorization" => "Bearer ". $token
        ];
        $response = $this->withHeaders($headers)->post('/api/logout',$data,$headers);

        
        $response->assertStatus(200);

        return $token;

    }



}
