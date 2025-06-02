<?php
namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class APIEmployeeController
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
        Employee::create($request->all());

        return response()->json($request->name . " " . $request->last_name . " has been created successfully.", 201);
    }

    public static function getAll($result_amount = 0, $sort_by = "name", $sort_order = "ASC")
    {
        return $employees = Employee::orderBy($sort_by, $sort_order)->paginate($result_amount);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public static function show($id)
    {
        return $employee = Employee::find($id);
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
        $employee       = Employee::find($id);
        $request->name  = ucfirst($request->name);
        $employee->update($request->all());

        return response()->json( $employee->name . " " . $employee->last_name . " has been successfully updated.", 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public static function destroy($id)
    {
        $employee = Employee::find($id);
        $employee->delete();
        return response()->json($employee->name . " " . $employee->last_name . " has been successfully updated.", 202);
    }
}
