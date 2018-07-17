<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\user; 
use JWTAuth;
use Auth;
  use Tymon\JWTAuth\Exceptions\JWTException;
class AuthController extends Controller
{
    //
    public function register(Request $request)
{
    $name=$request->input('name');
    $email=$request->input('email');
    $password=sha1($request->input('password'));
    $mobile=$request->input('mobile');
    echo "name=".$name."&email=".$email."&password=".$password."";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,"http://apidev.ipengen.com/user/register");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS,"name=".$name."&email=".$email."&password=".$password."&mobile=".$mobile."");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $server_output = curl_exec ($ch);
    curl_close ($ch);
    
   // die();
    
    /*$notification_id=$request->input('notification_id');
    $giveaway_id=$request->input('giveaway_id');
    $giveaway_product_id=$request->input('giveaway_product_id');*/



    /*$user = new User;
    $user->email = $request->email;
    $user->name = $request->name;
    $user->password = sha1($request->password);
    $user->save();*/
    return response([
        'status' => 'success',
        'data' => $server_output
       ], 200);
 }

public function user(Request $request)
{
    /*$user = User::find(Auth::user()->id);
    return response([
            'status' => 'success',
            'data' => $user
        ]);*/
}
public function refresh()
{
    return response([
            'status' => 'success'
        ]);
}
 public function login(Request $request)
{
    //die("***");

  //  name:souravemail:sourav.mataiubja@gmaudedfff.compassword:1234168465
    //$name=$request->input('name');
    $email=$request->input('email');
    $password=sha1($request->input('password'));

    $ch = curl_init();
   // echo "email=".$email."&password=".$password."";
    curl_setopt($ch, CURLOPT_URL,"http://apidev.ipengen.com/user/login");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS,"email=".$email."&password=".$password."");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $server_output = curl_exec ($ch);
    curl_close ($ch);
    if($server_output['status']==200){
        echo "fhff";
    }
    else{
        echo "dnfnf";

    }
   //echo json_decode($server_output);
   //die();
    //$credentials = $request->only('email', 'password');
    /*if ( ! $token = JWTAuth::attempt($credentials)) {
            return response([
                'status' => 'error',
                'error' => 'invalid.credentials',
                'msg' => 'Invalid Credentials.'
            ], 400);
    }
    return response([
            'status' => 'success',
            
        ]) ->header('Authorization', $token);;*/
}
public function logout()
{
    JWTAuth::invalidate();
    return response([
            'status' => 'success',
            'msg' => 'Logged out Successfully.'
        ], 200);
}
}
