<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use DataTables;
use Illuminate\Http\Request;

class BukuController extends Controller
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
        $data['page'] = 'Data Buku';
        return view('pages.contents.buku.index',$data);
    }
    public function get_list_buku(Request $request){
        $url   = 'localhost:8080/api/get-buku';
        $token = $request->session()->get('token');
        $buku  = $this->send($url,'',$token);
        $data  = $buku->data->buku;
        return DataTables::of($data)
                        ->addIndexColumn()
                        ->addColumn('action', function($row){
                                $btn = '<a href="#" data-id="'.$row->id.'" class="btn btn-primary btn-sm edit-buku"><i class="bi bi-pen"></i></a>';
                                return $btn;
                            })
                        ->rawColumns(['action'])
                        ->make(true);
    }
    public function listbuku(Request $request){
        $url          = 'localhost:8080/api/get-buku';
        $token        = $request->session()->get('token');
        $buku         = $this->send($url,'',$token);
        $data         = $buku->data->buku;
        return DataTables::of($data)
                        ->addIndexColumn()
                        ->addColumn('action', function($row){
                                $btn = '<button class="btn btn-sm btn-primary add-list" data-id="'.$row->id.'" data-code ="'.$row->code.'" data-jenis_buku="'.$row->jenis_buku.'" data-judul_buku="'.$row->judul_buku.'" data-penerbit="'.$row->penerbit.'" data-rak="'.$row->no_rak.'"><i class="bi bi-check"></i></button>';
                                return $btn;
                            })
                        ->rawColumns(['action'])
                        ->make(true);
    }
    public function store_buku(Request $request){
        $url          = 'localhost:8080/api/create-buku';
        $token        = $request->session()->get('token');
        $data = '{"jenis_buku" : "'.$request->jenis_buku.'",
                    "judul_buku" : "'.$request->judul_buku.'",
                    "penerbit" : "'.$request->penerbit.'",
                    "no_rak" : "'.$request->no_rak.'",
                    "jumlah" :"'.$request->jumlah.'"}';
        $post = str_ireplace(array("\r\n"," "),"", $data);
        $respon = $this->post($url,$post,$token,"POST");
        return $respon;
    }
}
