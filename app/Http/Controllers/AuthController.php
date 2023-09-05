<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index(){
        return view('pages.contents.auth.login');
    }
    public function auth(Request $request){
        $url  = 'localhost:8080/api/login';
        $post = '{"email":"'.$request->email.'","password":"'.$request->password.'"}';
        $respon = $this->send($url,$post);
        if ($respon){
            $request->session()->put([
                'token' => $respon->token_type." ".$respon->access_token,
                'id_user' => $respon->user->id,
                'name' => $respon->user->name,
                'email' => $respon->user->email,
            ]);
           return redirect('/home');
        }
       
    }
    public function send($url,$post){       
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => $url,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS => $post,
          CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
          ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        return json_decode($response);
    }
}
