<?php

namespace App\Http\Controllers\Cps;


use App\Http\Controllers\Controller;
use App\Components\Helpers;
use App\Http\Models\CpsUser;
use Illuminate\Http\Request;
use Response;
use Log;
use Cache;
use Auth;
use Hash;
use JWTAuth;

/**
 * cps 相关内容
 *
 * Class CpsController
 *
 * @package App\Http\Controllers\cps
 */
class CpsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:cps', ['except' => ['login', 'test_create']]);
    }

 

    /**
     * test create cps user
     */

    public function test_create(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:cps_users',
            'password' => 'required|min:6',
        ]);
        $email = $request->get('email');
        $password = $request->get('password');
        $name = $request->get('name', 'Newbee');
        
        $user = new CpsUser();
        $user->email = $email;
        $user->password = Hash::make($password);
        $user->name = $name;
        $user->roles = 'admin';
        $user->save();
        return Response::json(['status' => 'success', 'data' => $user]);
    }

    /**
     * 登陆接口, 返回一个token
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $jwt_token = null;

        if (! $jwt_token = Auth::guard('cps')->attempt($credentials)){
            return Response::json(['code' => 20001, 'message' => 'invalid user or password']);
        } else {

        } 
        return Response::json(['code' => 20000, 'data' => ['token' => $jwt_token], 'message' => 'ok']);
    }



    /**
     * 注销token
     */
    public function logout(Request $request)
    {
        try {
            Auth::invalidate();
            //auth('cps')->invalidate($request->token);

            return response()->json(['code' => 20000,
                'status' => 'success',
                'message' => 'User logged out successfully'
            ]);
        } catch (JWTException $exception) {
            return Response::json([ 'code' => 200001,
                'success' => false,
                'message' => 'Sorry, the user cannot be logged out'
            ]);
        }
    }

    public function user_info(Request $request)
    {   
        $user = Auth::user();
        $user->avatar = 'https://wpimg.wallstcn.com/f778738c-e4f8-4870-b634-56703b4acafe.gif';
        return response()->json(['code' => 20000, 'data' => $user]);
    }

}
