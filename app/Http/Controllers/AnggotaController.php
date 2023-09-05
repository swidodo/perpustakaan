<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use DataTables;
use Illuminate\Http\Request;

class AnggotaController extends Controller
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
    public function post($url,$post,$token,$method){  
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => $url,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => $method,
          CURLOPT_POSTFIELDS => $post,
          CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json','Authorization:'.$token,
          ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        return json_decode($response);
    }
    public function index(){
        $data['page'] = 'Data Anggota';
        return view('pages.contents.anggota.index',$data);
    }
    public function get_list_anggota(Request $request){
        $url        = 'localhost:8080/api/get-anggota';
        $token      = $request->session()->get('token');
        $anggota    = $this->send($url,'',$token);
        $data       = $anggota->data->anggota;
        return DataTables::of($data)
                        ->addIndexColumn()
                        ->addColumn('action', function($row){
                                $btn = '<a href="#" data-id="'.$row->id.'" class="btn btn-primary btn-sm edit-buku"><i class="bi bi-pen"></i></a>';
                                return $btn;
                            })
                        ->rawColumns(['action'])
                        ->make(true);
    }
    public function store_anggota(Request $request){
        $url          = 'localhost:8080/api/create-anggota';
        $token        = $request->session()->get('token');
        $data = '{"nama_lengkap" : "'.$request->nama_lengkap.'",
                    "jenis_kelamin" : "'.$request->jenis_kelamin.'",
                    "no_hp" : "'.$request->no_hp.'",
                    "email" : "'.$request->email.'",
                    "alamat" :"'.$request->alamat.'"}';
        $post = str_ireplace(array("\r\n"," "),"", $data);
        $respon = $this->post($url,$post,$token,"POST");
        if(!$respon){
            return return redirect()->route('/');
        }
        return $respon;
    }
}
