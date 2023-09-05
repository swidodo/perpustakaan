<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use DataTables;
use Illuminate\Http\Request;

class PinjamController extends Controller
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
    public function index(Request $request){
        $data['page']   = 'Data Pinjaman Buku';
        return view('pages.contents.pinjam.index',$data);
    }
    public function get_transaction_pinjam(Request $request){
        $url            = 'localhost:8080/api/get-pinjam';
        $token          = $request->session()->get('token');
        $pinjam         = $this->send($url,'',$token);
        $data           = $pinjam->data->pinjam;
        return DataTables::of($data)
                        ->addIndexColumn()
                        ->addColumn('action', function($row){
                                $btn ='';
                                $btn .= '<div class="d-flex justify-content-center">
                                            <a href="/edit-transaction/'.$row->id.'" class="btn btn-primary btn-sm edit-pinjam-list me-1"><i class="bi bi-pen"></i></a>';
                                $btn .= '<a href="#" data-id ="'.$row->id.'" class="btn btn-primary btn-sm view-pinjaman"><i class="bi bi-eye"></i></a>
                                        </div>';
                                return $btn;
                            })
                        ->rawColumns(['action'])
                        ->make(true);
    }
    
    public function create_trans_pinjam(Request $request){
        $url1            = 'localhost:8080/api/get-buku';
        $url2            = 'localhost:8080/api/get-anggota';
        $token           = $request->session()->get('token');
        $buku            = $this->send($url1,'',$token);
        $anggota         = $this->send($url2,'',$token);
        $data['page']    = 'Create Pinjam Buku';
        $data['buku']    = $buku->data->buku;
        $data['anggota'] = $anggota->data->anggota;
        return view('pages.contents.pinjam.create',$data);
    }
    public function store_transaction(Request $request){
        $url      = 'localhost:8080/api/create-pinjam';
        $token   = $request->session()->get('token');
        $id_user  = $request->session()->get('id_user');
        $data = '{"id_anggota":"'.$request->id_anggota.'",
            "tanggal_pinjam":"'.$request->tanggal_pinjam.'",
            "tanggal_kembali":"'.$request->tanggal_kembali.'",
            "status": "'.$request->status.'",
            "create_by":"'.$id_user.'",
            "update_by":"'.$id_user.'",
            "id_buku":'.json_encode($request->id_buku,true).',
            "jumlah" :'.json_encode($request->jumlah,true).'}';
            $post = str_ireplace(array("\r\n"," "),"", $data);
       $respon = $this->post($url,$post,$token,"POST");
       if(!$respon){
            return redirect()->route('/');
        }else{
            return $respon;
        }
    }
    public function edit_trans_pinjam(Request $request,$id){
        $url1            = 'localhost:8080/api/get-buku';
        $url2            = 'localhost:8080/api/get-anggota';
        $master          = 'localhost:8080/api/edit-pinjam/'.$id;
        $token           = $request->session()->get('token');
        $buku            = $this->send($url1,'',$token);
        $anggota         = $this->send($url2,'',$token);
        $mdata           = $this->send($master,'',$token);
        $data['page']    = 'Edit Pinjam Buku';
        $data['buku']    = $buku->data->buku;
        $data['master']  = $mdata->data->pinjam;
        $data['detail']  = $mdata->data->detail;
        $data['anggota'] = $anggota->data->anggota;
        return view('pages.contents.pinjam.edit',$data);
    }
    public function update_trans_pinjam(Request $request){
        $url      = 'localhost:8080/api/update-pinjam/'.$request->id_master;
        $token   = $request->session()->get('token');
        $id_user  = $request->session()->get('id_user');
        $data = '{"status": "'.$request->status.'",
            "tanggal_perpanjang":"'.$request->tanggal_perpanjang.'",
            "tanggal_kembali":"'.$request->tanggal_kembali.'",
            "update_by":"'.$id_user.'",
            "id":'.json_encode($request->id,true).',
            "id_buku":'.json_encode($request->id_buku,true).',
            "jumlah" :'.json_encode($request->jumlah,true).'}';

            $post = str_ireplace(array("\r\n"," "),"", $data);
       $respon = $this->post($url,$post,$token,"PUT");
       if(!$respon){
            return redirect()->route('/');
        }else{
            return $respon;
        }
    }
    public function view_trans(Request $request){
        $master          = 'localhost:8080/api/edit-pinjam/'.$request->id;
        $token           = $request->session()->get('token');
        $mdata           = $this->send($master,'',$token);
        $data['master']  = $mdata->data->pinjam;
        $data['detail']  = $mdata->data->detail;
        return response()->json($data);
    }
    public function check_stock(Request $request){
        $url      = 'localhost:8080/api/check-stock';
        $token   = $request->session()->get('token');
        $data = '{"id_buku":"'.$request->id_buku.'",
                    "jumlah":"'.$request->jumlah.'"}';
        $post = str_ireplace(array("\r\n"," "),"", $data);
        $respon = $this->post($url,$post,$token,"POST");
        return $respon;
    }
}


