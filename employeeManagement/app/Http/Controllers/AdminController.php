<?php

namespace App\Http\Controllers;

use App\Model\Charge;
use App\Model\Client;
use App\Model\DailyInput;
use App\Model\Designation;
use App\Model\StaffDetail;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $charges = Charge::all();
        return View('admin/admin')->with("clients",Client::all())
            ->with('staffDetails',StaffDetail::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $designations = Designation::all();
        return View("charge/createCharge")->with('designations',$designations);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $charge = ['rate'=>$request->input('inputRate'),
            'upto'=>$request->input('inputUpto'),
            'designation_id'=>$request->input('inputDesignation')];

        Charge::InsertGetID($charge);
        return redirect('/charge');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Charge  $charge
     * @return \Illuminate\Http\Response
     */
    public function show(Charge $charge)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Charge  $charge
     * @return \Illuminate\Http\Response
     */
    public function edit(Charge $charge)
    {
        return View("charge/chargeEdit")->with('charge',$charge)->with('designations',Designation::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Charge  $charge
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $chargedb = Charge::find($request->input('id'));
        $chargedb->rate = $request->input('inputRate');
        $chargedb->upto =$request->input('inputUpto');
        $chargedb->designation_id =$request->input('inputDesignation');
        $chargedb->save();
        return redirect('/charge');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Charge  $charge
     * @return \Illuminate\Http\Response
     */
    public function destroy(Charge $charge)
    {
        $charge->delete();
        return redirect('/charge');
    }

    public function ajaxCall(Request $request){

        //echo 'ajaxCall';
        $staffID = Input::get('staffID');
        $clientID = Input::get('clientID');
        $dateInput = Input::get('datepicked');
        if($clientID != null){
            $client = Client::find($clientID);
            $dailyInputs = $client->dailyInput;

            $staffDetail = [];
            foreach($dailyInputs as $dailyInput){
                $staffDetail[] = array('staff_id' => $dailyInput->staffDetail->id,'staff_name' => $dailyInput->staffDetail->name,'designation_id' =>$dailyInput->staffDetail->designation_id,'rate'=>$dailyInput->staffDetail->designation->charge->last()->rate);
            }
            return json_encode($staffDetail);
        }elseif($staffID != null){
            $staffDetail = StaffDetail::find($staffID);
            $dailyInput = $staffDetail->dailyInput->last();
            return $dailyInput;
        }elseif($dateInput != null){
            $dailyInput = DailyInput::where('reportDate',$dateInput)->get();

            $clients = [];
            foreach($dailyInput as $dailyInput){
                $clients[] = array('client_id'=>$dailyInput->client->id,'client_name'=>$dailyInput->client->name);
            }
            return json_encode($clients);
        }

    }
}
