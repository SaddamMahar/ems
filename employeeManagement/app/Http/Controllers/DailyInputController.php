<?php

namespace App\Http\Controllers;

use App\Model\DailyInput;
use App\Model\StaffDetail;
use App\Model\Client;
use Illuminate\Http\Request;

class DailyInputController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dailyInputs = DailyInput::all();
        return View('dailyInput/dailyInputs')->with("dailyInputs",$dailyInputs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View("dailyInput/createDailyInput")->with('staffDetails',StaffDetail::all())->with('clients',Client::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $staff_detail_id = $request->input('inputStaffDetail');
        $client_id = $request->input('inputClient');
        $timeFrom = $request->input('inputTimeFrom');
        $timeUpto = $request->input('inputTimeUpto');
        $reportDate = $request->input('inputReportDate');

        if($request->input('inputTimeTotal') == null){
            $timeTotal = date('H:i:s', strtotime($request->input('inputTimeUpto')) - strtotime($request->input('inputTimeFrom')));
        }else{
            $timeTotal = $request->input('inputTimeTotal');

            if(strpos($timeTotal,':') === false  ){//&& is_numeric($timeTotal)
                $timeTotal = $timeTotal.':00' ;
            }
        }

        $dailyInput = ['staff_detail_id'=>$staff_detail_id,
            'client_id'=>$client_id,
            'timeFrom'=>$timeFrom,
            'timeUpto'=>$timeUpto,
            'reportDate'=>$reportDate,
            'timeTotal'=>$timeTotal
        ];
        DailyInput::InsertGetID($dailyInput);
        return redirect('/dailyInput');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\DailyInput  $dailyInput
     * @return \Illuminate\Http\Response
     */
    public function show(DailyInput $dailyInput)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\DailyInput  $dailyInput
     * @return \Illuminate\Http\Response
     */
    public function edit(DailyInput $dailyInput)
    {
        return View("dailyInput/dailyInputEdit")->with('dailyInput',$dailyInput)
            ->with('staffDetails',StaffDetail::all())->with('clients',Client::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\DailyInput  $dailyInput
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DailyInput $dailyInput)
    {
        $dailyInput = DailyInput::find($request->input('id'));
        $dailyInput->staff_detail_id = $request->input('inputStaffDetail');
        $dailyInput->client_id = $request->input('inputClient');
        $dailyInput->timeFrom = $request->input('inputTimeFrom');
        $dailyInput->timeUpto = $request->input('inputTimeUpto');
        $dailyInput->reportDate = $request->input('inputReportDate');
        $dailyInput->timeTotal =date('H:i:s', strtotime($request->input('inputTimeUpto')) - strtotime($request->input('inputTimeFrom')));
        $dailyInput->save();
        return redirect('/dailyInput');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\DailyInput  $dailyInput
     * @return \Illuminate\Http\Response
     */
    public function destroy(DailyInput $dailyInput)
    {
        $dailyInput->delete();
        return redirect('/dailyInput');
    }
}
