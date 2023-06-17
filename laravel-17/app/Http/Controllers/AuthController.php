<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    use ApiResponse;
    public function login(Request $request){
        $rules = [
            'email' => 'required|string|email|exists:users,email',
            'password' => 'required|string',
        ];

        $message = [
            'required' =>  $this->MISSING_FIELD(),
            'string'=> $this->WROND_DATA_TYPE(),
            'email' => $this->WROND_DATA_TYPE(),
            'exists' => $this->INVALID_LOGIN(),
        ];

        $validator = Validator::make($request->all(),$rules,$message);
        if($validator->fails()){
            return $this->validationFails($validator);
        }

        $data = $validator->validated();
        $user = User::where(['email' => $data['email']])->first();
        if(!$user){
            return $this->INVALID_LOGIN();
        }

        $access_token = hash_hmac('sha256',$user->email,'1234');
        $user->access_token = $access_token;
        $user->save();
        $data = $user->only([
            'id',
            'email',
            'nickname',
            'access_token',
            'profile_image',
            'type'
        ]);
        return $this->success($data);

    }
    public function register(Request $request){
        $rules = [
            'email'=>'string|required|unique:users|email',
            'nickname'=>'required|string',
            'password'=>'required|string|min:4',
            'profile_image'=>'required|file|mimes:jpg,png'
        ];

        $message = [
            'required' => $this->MISSING_FIELD(),
            'min'=> $this->PASSWORD_NOT_SECURE(),
            'string'=> $this->WROND_DATA_TYPE(),
            'mimes'=> $this->WROND_DATA_TYPE(),
            'file'=> $this->WROND_DATA_TYPE(),
            'email'=> $this->WROND_DATA_TYPE(),
            'unique'=> $this->USER_EXISTS(),
        ];

        $validator = Validator::make($request->all(),$rules,$message);

        if($validator->fails()){
            return $this->fails();
        }

        $data = $validator->validated();
        $path = $request->file('profile_image')->store('public/profile_images');
        $data['profile_image'] = asset(Storage::url($path));
        $data['password'] = Hash::make($data['password']);
        $data['type'] = 'user';
        $user = User::create($data);
        return  $this->success($user);
    }
    public function logout(Request $request){
        $request->currentUser->access_token = null;
        $request->currentUser->save();
        return $this->success();
    }
}
