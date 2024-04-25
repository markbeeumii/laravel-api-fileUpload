<?php

namespace App\Http\Controllers\Api;

use App\Interface\Api\Auth\AuthControllerInteface;
use App\Models\User;
use App\Requests\Api\Auth\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Exception;
use Throwable;

class AuthController extends BaseAPIController implements AuthControllerInteface{
    public function login(LoginRequest $request){
      $credentials = $request->only(['email', 'password']);
          if(!Auth::attempt($credentials))
          {
              return response()->json([
                  'message' => 'Unauthorized'
              ], 401);
          }
          $token = Auth::user()->createToken('personal-access-token', ['*'] , Carbon::now()->addWeeks(1))->plainTextToken;
          $user = $request->user();
          //$res = User::where('id',$user['id'])->first();
          // $tokenResult = $user->createToken('aaaa-personal');
          //echo $tokenResult;
          // $token = $tokenResult->plainTextToken;
          // die($token);
        //echo $user."aaaaaaaaaaaaa".$tokenResult;
        // $tokenResult;
        return response()->json([
            'access_token' => $token,
            'user_id' => $user->id,
            'token_type' => 'Bearer'
        ]);
    
  } 
  public function register(LoginRequest $request)
  {
    try{

      $user = $request->all();
      $res = User::create($user);
      echo $res;
      // if(!$user){
      //   return response()->json([
      //     'message' => 'Fail to register'
      //   ], 502);
      // }
      // return response()->json([
      //   'message' => 'successfully'
      // ], 200);
    }catch(\Exception $e){
      report($e);
    }
  }
  public function logout()
  {
    auth()->user()->tokens()->delete();
        
    return response()->json([
        'message' => 'Successfully logged out'
    ]);
  }
}
