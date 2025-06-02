<?php
namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class APIClientController
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public static function store(Request $request)
    {
        $request->name = ucfirst($request->name);
        Client::create($request->all());

        return response()->json($request->name . " " . $request->last_name . " has been created successfully.", 201);
    }

    public static function getAll($result_amount = 0, $sort_by = "name", $sort_order = "ASC")
    {
        return $clients = Client::orderBy($sort_by, $sort_order)->paginate($result_amount);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public static function show($id)
    {
        return $client = Client::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public static function update(Request $request, $id)
    {
        $client         = Client::find($id);
        $request->name  = ucfirst($request->name);
        $client->update($request->all());

        return response()->json( $client->name . " " . $client->last_name . " has been successfully updated.", 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public static function destroy($id)
    {
        $client = Client::find($id);
        $client->delete();
        return response()->json($client->name . " " . $client->last_name . " has been successfully updated.", 202);
    }
}
