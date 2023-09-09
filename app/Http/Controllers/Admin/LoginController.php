<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Auth;

class LoginController extends Controller
{
    public function index(){
        return view('login');
    }
    public function registration(){
        return view('register');
    }
    public function create_user(Request $request){
        $validator = Validator::make($request->all(), [
            'password' => 'required|min:8',
            'retype_password' => 'required|same:password|min:8',
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator);
        } else{
            $curl = curl_init();
            $userData = [
                "name"=> $request->name,
                "username"=>  $request->username,
                "email"=>  $request->email,
                "password"=>  $request->password
            ];
            curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://localhost/task/public/api/register_user',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>json_encode($userData),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
            ));
            $response = curl_exec($curl);
            $info = json_decode($response);
            curl_close($curl);
            if($info->success == 'true'){
                return redirect()->route('login')->with('success',"User registered successfully!");
            } else{
                return redirect()->back();
            }
        }
        
    }
    public function login_post(Request $request){
        $curl = curl_init();
        $requestData = [
            "username" => $request->input('username'), 
            "password" => $request->input('password'), 
        ];
        curl_setopt_array($curl, array(
        CURLOPT_URL => 'http://localhost/task/public/api/login_api',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => json_encode($requestData),
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
        ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        $info = json_decode($response);
        if($info->success =='true'){
            $userInfo = $info->data->userInfo;
            $token = $info->data->token;
            session(['api_response' => $info,'userInfo' =>$userInfo,'token' => $token]);
            return redirect()->route('consignment_view');
        } else{
            return redirect()->route('login')->with('error',$info->message->error);
        }
       
    }
}
