<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\User\LoginRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\SignupRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Laravel\Sanctum\PersonalAccessToken;
use App\Repositories\UserRepository;
/*use Illuminate\Support\Facades\Mail;
 use App\Mail\EmailConfirmation;
 use Google_Client;
 use Google_Service_Gmail;
 use Google_Service_Gmail_Message;*/

class AuthController extends Controller
{
    
    
    public function register (SignupRequest $request)
    {
        $data = $request->validated();
        $data['password']=bcrypt($data['password']);
        $data['user_type_id']=4;
        $data['whatsapp']=$request->whatsapp;
        
        $user = User::create($data);
        $token = $user->createToken('main')->plainTextToken;
        
        return response(compact('user', 'token'));
    }
    
    public function login (LoginRequest $request)
    {
        $user = DB::table('users')
        ->where('email', '=', $request->email)
        ->first();
        if($user->user_type_id == 6)
            return response([
                'message' => 'You are not registered yet !!'
            ], 422);
        
        $credentials = $request->validated();
        
        if(!Auth::attempt($credentials)) {
            return response([
                'message' => 'Provided password or email address are not correct'
            ], 422);
        }
        
        $user = Auth::user();
            
        $token = $user->createToken('main')->plainTextToken;
        
        return response(compact('user', 'token'));
    }
    
    public function logout (Request $request) {
        
        $user = $request->user();
        $user->currentAccessToken()->delete();
        $user->tokens()->delete();
        
        return response('logged out successfully', 200);
    }
    
    public function confirmEmail (User $user)
    {
        //$user = User::where('email', $request->email)->first();
        
        
        if($user) {
            $confermationCode = Str::random(4);
            
            $user->update([
                'confirmation_code' => $confermationCode
            ]);
            
            
            return response(['success' => true, 'message' => 'Email sent successfully'], 200);
            
            
            
        }else{
            return response(['success' => false, 'message' => 'User not found'], 404);
        }
    }
    
    public function confirmCode (Request $request)
    {
        
    }
    
}
