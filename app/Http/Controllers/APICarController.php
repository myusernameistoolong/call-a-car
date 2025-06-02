<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use DB;

class APICarController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public static function store(Request $request)
    {
        $request->brand = ucfirst($request->brand);
        Car::create($request->all());

        return response()->json($request->brand . ": " . $request->type . " has been created successfully.", 201);
    }

    public static function getAll($result_amount = 0, $sort_by = "brand", $sort_order = "ASC")
    {
        return $cars = Car::orderBy($sort_by, $sort_order)->paginate($result_amount);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public static function show($id)
    {
        return $car = Car::find($id);
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
        $car = Car::find($id);
        $request->brand = ucfirst($request->brand);
        $car->update($request->all());

        return response()->json( $car->brand . ": " . $car->type . " has been successfully updated.", 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public static function destroy($id)
    {
        $car = Car::find($id);
        $car->delete();
        return response()->json($car->brand . ": " . $car->type . " has been successfully updated.", 202);
    }
}
