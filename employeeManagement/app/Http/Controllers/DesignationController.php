<?php

namespace App\Http\Controllers;

use App\Model\Designation;
use Illuminate\Http\Request;

class DesignationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $designations = Designation::all();
        return View('designation/designation')->with("designations",$designations);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View("designation/createDesignation");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $designation = ['title'=>$request->input('inputTitle')];
        Designation::InsertGetID($designation);
        return redirect('/designation');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Designation  $designation
     * @return \Illuminate\Http\Response
     */
    public function show(Designation $designation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Designation  $designation
     * @return \Illuminate\Http\Response
     */
    public function edit(Designation $designation)
    {
        return View("designation/designationEdit")->with('designation',$designation);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Designation  $designation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $designationdb = Designation::find($request->input('id'));
        $designationdb->title = $request->input('inputTitle');
        $designationdb->save();
        return redirect('/designation');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Designation  $designation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Designation $designation)
    {
        if($designation->staffDetail != null){
            $staffDetails = $designation->staffDetail;
            foreach($staffDetails as $staffDetail){
                if($staffDetail->dailyInput == null){
                    $s = $staffDetail->id;
                    $staffDetail->delete();
                    dd('sd:1:'.$s);
                }else{
                    $dailyInput = $staffDetail->dailyInput;
                    foreach($dailyInput as $dailyInput){
                        $s = $dailyInput->id;
                        $dailyInput->delete();
                        dd('di:'.$s);
                    }
                    $s = $staffDetail->id;
                    $staffDetail->delete();
                    dd('sd:2:'.$s);
                }
            }
        }
        if($designation->charge != null){
            $charges = $designation->charge;
            foreach($charges as $charge){
                $charge->delete();
            }
        }
        $designation->delete();
        return redirect('/designation');
    }
}
