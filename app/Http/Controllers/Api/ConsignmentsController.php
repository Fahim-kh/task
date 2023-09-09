<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ConsignmentModel;
use App\Http\Controllers\Api\BaseController;
use Auth;

class ConsignmentsController extends BaseController
{
    public function index(){
        try {
            if(Auth::check()){
                $consignmentData = ConsignmentModel::latest()->get();
                $consignment['code'] = 200;
                $consignment['consignments'] = $consignmentData;
                return $this->sendResponse($consignment, 'consignments list');
            } else{
                $data['code'] = 200;
                $data['response'] = 'Unauthorised';
                return $this->sendError($data, ['error'=>'Unauthorised']);
            }
            
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function consignment_store(Request $request){
        ConsignmentModel::create([
            'company' => $request->company,
            'contact' => $request->contact,
            'addressline1' => $request->addressline1,
            'addressline2' => $request->addressline2,
            'addressline3' => $request->addressline3,
            'country' => $request->country,
            'city' => $request->city,
        ]);
        $consignment['code'] = 200;
        $consignment['response'] = 'success';
        return $this->sendResponse($consignment, 'consignment Added Successfully');
    }
}
