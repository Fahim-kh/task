<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Api\BaseController;
use Auth;
use Hash;

class AuthController extends BaseController
{
    public function register_user(Request $request){
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $user['code'] = 200;
        return $this->sendResponse($user, 'User created successfully');
    }
    public function auth_login(Request $request){
        try {
            $usernameValue = $request->input('username');
            $fieldType = filter_var($usernameValue, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
            $username = [$fieldType => $usernameValue];
            $password = $request->input('password');
            
            if (Auth::attempt(array_merge($username, ['password' => $password]))) {
                $user = Auth::user();
                $token =  $user->createToken('MyApp')->plainTextToken;
                $message = 'User authorized';
                $response = 'success';
                $userInfo = $user ;
                $data['code'] = 200;
                $data['token'] = $token;
                $data['message'] = $message;
                $data['userInfo'] = $userInfo;
                return $this->sendResponse($data, 'User login successfully.');
            } else {
                $data['code'] = 200;
                $data['response'] = 'Unauthorised';
                return $this->sendError($data, ['error'=>'Unauthorised']);
            }
        } catch (\Throwable $th) {
            $data['message'] = 'Something went wrong';
            return $this->sendError($th, $data);
        }
    }
    
    
}
