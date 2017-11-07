<?php

namespace App\Http\Controllers;

use App\Model\DailyInput;
use App\Model\Designation;
use App\Model\StaffDetail;
use Illuminate\Http\Request;

class StaffDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $staffDetails = StaffDetail::all();
        $designations = Designation::all();
        return View('staffDetail/staffDetail')->with("staffDetails",$staffDetails)->with('designations',$designations);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $designations = Designation::all();

        return View("staffDetail/createStaffDetail")->with('designations',$designations);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $staffDetail = ['name'=>$request->input('inputName'),
            'email'=>$request->input('inputEmail'),
            'password'=>$request->input('inputPassword'),
            'designation_id'=>$request->input('inputDesignation'),
            'joiningDate'=>$request->input('inputJoiningDate'),
            'leavingDate'=>$request->input('inputLeavingDate')];

        StaffDetail::InsertGetID($staffDetail);
        return redirect('/staffDetail');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\StaffDetail  $staffDetail
     * @return \Illuminate\Http\Response
     */
    public function show(StaffDetail $staffDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\StaffDetail  $staffDetail
     * @return \Illuminate\Http\Response
     */
    public function edit($staffDetail)
    {
//        return View("staffDetail/staffDetailEdit")->with('staffDetail',$staffDetail)->with('designations',Designation::all());
        $data = StaffDetail::find($staffDetail);

        echo json_encode($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\StaffDetail  $staffDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $staffDetaildb = StaffDetail::find($request->input('id'));
        $staffDetaildb->name = $request->input('inputName');
        $staffDetaildb->email =$request->input('inputEmail');
        $staffDetaildb->password =$request->input('inputPassword');
        $staffDetaildb->joiningDate =$request->input('inputJoiningDate');
        $staffDetaildb->leavingDate =$request->input('inputLeavingDate');
        $staffDetaildb->designation_id =$request->input('inputDesignation');
        $staffDetaildb->save();
        return redirect('/staffDetail');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\StaffDetail  $staffDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(StaffDetail $staffDetail)
    {
        if($staffDetail->dailyInput == null){
            $staffDetail->delete();
        }else{
            $dailyInput = $staffDetail->dailyInput;
            foreach($dailyInput as $dailyInput){
                $dailyInput->delete();
            }
            $staffDetail->delete();
        }

        return redirect('/staffDetail');
    }

    public function delete($id)
    {
        $staffDetail = StaffDetail::find($id);
        if($staffDetail->dailyInput == null){
            StaffDetail::destroy($staffDetail->id);
        }else{
            $dailyInput = $staffDetail->dailyInput;
            foreach($dailyInput as $dailyInput){
                DailyInput::destroy($dailyInput->id);
            }
            StaffDetail::destroy($staffDetail->id);
        }

        return redirect('/staffDetail');
    }

    public function updateStaffDetail(Request $request)
    {
        $staffDetaildb = StaffDetail::find($request->input('id'));
        $staffDetaildb->name = $request->input('inputName');
        $staffDetaildb->email =$request->input('inputEmail');
        $staffDetaildb->password =$request->input('inputPassword');
        $staffDetaildb->joiningDate =$request->input('inputJoiningDate');
        $staffDetaildb->leavingDate =$request->input('inputLeavingDate');
        $staffDetaildb->designation_id =$request->input('inputDesignation');
        $staffDetaildb->save();
        return redirect('/staffDetail');
    }
}
