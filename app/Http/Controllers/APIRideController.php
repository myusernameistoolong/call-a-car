<?php

namespace App\Http\Controllers;

use App\Models\Ride;
use Illuminate\Http\Request;
use DB;

class APIRideController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public static function store(Request $request)
    {
        Ride::create($request->all());
        return response()->json("Ride #" . $request->id . " has been created successfully.", 201);
    }

    public static function getAll($result_amount = 0, $sort_by = "id", $sort_order = "ASC", $user_id = "")
    {
        if($user_id != "")
            return $rides = Ride::orderBy($sort_by, $sort_order)->where('user_id', $user_id)->paginate($result_amount);

        return $rides = Ride::orderBy($sort_by, $sort_order)->paginate($result_amount);
    }

    public static function getLastRideOfUser($id)
    {
        return $lastRide = Ride::latest()->where('user_id', $id)->first();
    }

    public static function getAllByUserId($id)
    {
        return $rides = Ride::all()->where('user_id', $id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public static function show($id)
    {
        return $ride = Ride::find($id);
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
        $ride = Ride::find($id);
        $ride->update($request->all());

        return response()->json( "Ride #" . $ride->id . " has been successfully updated.", 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public static function destroy($id)
    {
        $ride = Ride::find($id);
        $ride->delete();
        return response()->json("Ride #" . $ride->id . " has been successfully updated.", 202);
    }
}
