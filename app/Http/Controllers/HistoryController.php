<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use DataTables;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
     public function send($url,$data,$token){

        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => $url,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
          CURLOPT_HTTPHEADER => array('Content-Type: application/json','Authorization:'.$token),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return json_decode($response);
    }
    public function index(){
        $data['page'] = 'Data History Pinjam';
        return view('pages.contents.history.index',$data);
    }

    public function get_list_history(Request $request){
        $url        = 'localhost:8080/api/get-history';
        $token      = $request->session()->get('token');
        $history    = $this->send($url,'',$token);
        $data       = $history->data->history;
        return DataTables::of($data)->make(true);
    }
}
