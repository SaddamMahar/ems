<?php

namespace App\Http\Controllers;

//use App\Model\Client;
use App\Model\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::all();
        return View('client/client')->with("clients",$clients);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return View("client/clientRegistration");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function store(Request $request)
    {

        $insertClient = ['name'=>$request->input('inputName'),
            'address'=>$request->input('inputAddress'),
            'contact'=>$request->input('inputContact'),
            'contactPerson'=>$request->input('inputContactPerson'),
            'nic'=>$request->input('inputnic')];

        Client::InsertGetID($insertClient);
        return redirect('/client');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit($client)
    {
        $data = Client::find($client);
        echo json_encode($data);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $clientdb = Client::find($request->input('id'));
        $clientdb->name = $request->input('inputName');
        $clientdb->address =$request->input('inputAddress');
        $clientdb->contact =$request->input('inputContact');
        $clientdb->contactPerson =$request->input('inputContactPerson');
        $clientdb->nic =$request->input('inputnic');
        $clientdb->save();
        return redirect('/client');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        if($client->dailyInput != null){
            foreach($client->dailyInput as $dailyInput){
                $dailyInput->delete();
            }
        }
        $client->delete();
        return redirect('/client');
    }

    public function delete($id)
    {
        $client = Client::find($id);
        if($client->dailyInput != null){
            foreach($client->dailyInput as $dailyInput){
                $dailyInput->delete();
            }
        }
        Client::destroy($client->id);
        return redirect('/client');
    }


    public function updateClient(Request $request)
    {
        $clientdb = Client::find($request->input('id'));
        $clientdb->name = $request->input('inputName');
        $clientdb->address =$request->input('inputAddress');
        $clientdb->contact =$request->input('inputContact');
        $clientdb->contactPerson =$request->input('inputContactPerson');
        $clientdb->nic =$request->input('inputnic');
        $clientdb->save();
        return redirect('/client');

    }
}
