<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use PDF;

class DashboardController extends Controller
{
    public function index(){
        $curl = curl_init();
        $token = session('token');
        curl_setopt_array($curl, array(
        CURLOPT_URL => 'http://localhost/task/public/api/consignment_records',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer ' . $token, 
            'Content-Type: application/json',
        ),
        ));
        $response = curl_exec($curl);
        $getrecords = json_decode($response);
        curl_close($curl);
        $consignmentData =$getrecords->data->consignments;
        return view('admin.dashboard',compact('consignmentData'));
    }
    public function create(){
        return view('admin.create');
    }
    public function store(Request $request){
        $curl = curl_init();
        $record = [
            "company" => $request->input('company'),
            "contact" => $request->input('contact'),
            "addressline1" => $request->input('addressline1'),
            "addressline2" => $request->input('addressline2'),
            "addressline3" => $request->input('addressline3'),
            "country" => $request->input('country'),
            "city" => $request->input('city')
        ]; 
        $consignmentData = json_encode($record);
        curl_setopt_array($curl, array(
        CURLOPT_URL => 'http://localhost/task/public/api/consignment_store',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>$consignmentData,
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Authorization: Bearer 7|0Bp4tW1LBuH5LQ0EgTqlQ21UeNN5JYZfs5I8E4e5',
            'Cookie: XSRF-TOKEN=eyJpdiI6IkxhcXFZY3FrNlAyQlpCZXhJZXNHR3c9PSIsInZhbHVlIjoiL2pxaDcyRmluTzQyeE9OTVRsVDgxejRFd0p6ZDl3WHpPTzBPWGxTZm5jS0FmUXhsRURzWmtEZXZGc2JMOWlTVERrYjlDZ1lkN2tHMEVIQnBKSlhndy9UMjlPVWdrYzl6cWV4dUw3MGhUeWZRbkFBZFV5UHVVWWd0eXlzd0xpaksiLCJtYWMiOiJjZTQ3ZjI2NTgzMGIzMzg2ZDYwY2U4Mjg5NTFiNjE1ZjVlMjllNTgyZWY5Yzg0MzI4YjQzZTg0MjRjNGZmMjExIiwidGFnIjoiIn0%3D; laravel_session=eyJpdiI6Im9MZWlwM3FBSVB6bXkveEQxYkdnMmc9PSIsInZhbHVlIjoicEZuZWFKeVdFa28rSzhPVnRFTUtxWHZUWFpVUG1OWnRjTHRPTC9UMXRCUmxjbUs4QVZyU240ZGhOQnZzMGQwbWZLWlAzWWp5RWZjY1RrK3gwVm5rS0o3WWJmeWU2L3oxVUhDREtQY1VYWnVrVzJ6REhMMXcreko2Q0I1eHRhZTYiLCJtYWMiOiI1Njk0Y2RhNjMzZGY1NWU0ZWM1ZjkxNmU2MjllM2U3MzU2OTI2NmEwZDFiMTFkMjBhNjFkNTFhMmNhMWM0NTdmIiwidGFnIjoiIn0%3D'
        ),
        ));
        $response = curl_exec($curl);

        curl_close($curl);
        $resp = json_decode($response);
        if($resp->success =='true'){
           return redirect()->route('consignment_view')->with('success',"Consignment Added successfully");
        } else{
            return redirect()->route('consignment_view')->with('error',"Consignemnt add failed");
        }
    }
    public function export_pdf(){
        $curl = curl_init();
        $token = session('token');
        curl_setopt_array($curl, array(
        CURLOPT_URL => 'http://localhost/task/public/api/consignment_records',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer ' . $token, 
            'Content-Type: application/json',
        ),
        ));
        $response = curl_exec($curl);
        $getrecords = json_decode($response);
        curl_close($curl);
        $consignmentData =$getrecords->data->consignments; 
        $data= [
          "consignmentData" => $consignmentData  
        ];
        $pdf = PDF::loadView('pdf.consignment_pdf', $data);
        $pdfname = md5(date('d-m-y')."_".time())."_consignment".".pdf";
        return $pdf->download($pdfname);
    }
}
