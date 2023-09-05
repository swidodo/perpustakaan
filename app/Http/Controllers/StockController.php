<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use PDF;

class StockController extends Controller
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
        $data['page'] = 'Data Stock Buku';
        return view('pages.contents.stock.index',$data);
    }
    public function get_list_stock(Request $request){
        $url    = 'localhost:8080/api/get-stock';
        $token  = $request->session()->get('token');
        $stock  = $this->send($url,'',$token);
        $data   = $stock->data->stock;
        return DataTables::of($data)
                        ->addIndexColumn()
                        ->addColumn('ready', function($row){
                                $ready = (int)$row->stock - (int)$row->stock_out;
                                return $ready;
                            })
                        ->rawColumns(['ready'])
                        ->make(true);
    }

    public function report_stock(Request $request){
        $url    = 'localhost:8080/api/get-stock';
        $token  = $request->session()->get('token');
        $stock  = $this->send($url,'',$token);
        $data   = $stock->data->stock;
        if(!$data){
            return redirect()->route('/');
        }
        $pdf = PDF::loadview('pages.contents.stock.stock_pdf',['data'=>$data]);
        return $pdf->stream();
    }

   
}
