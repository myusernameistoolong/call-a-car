<?php

namespace App\Http\Controllers;

use App\Employee;
use Carbon\Carbon;
use Session;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:employee');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cookie_objects = "employees";
        include "cookies.php";

        $employees = APIEmployeeController::getAll($result_amount, $sort_by, $sort_order);
        return view('employees/index')->with('employees', $employees)->with('result_amounts', $result_amounts)->with('sorting', $sorting);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employees = APIEmployeeController::getAll();
        return view('employees/create')->with('employees', $employees);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'      => 'required|string|min:2|max:191',
            'insertion' => 'required|string|min:2|max:191',
            'last_name' => 'required|string|min:2|max:191',
            'initials'  => 'required|string|min:2|max:191',
            'residence' => 'required|string|min:2|max:191',
            'username'  => 'required|string|min:2|max:191',
            'email'     => 'required|string|min:2|max:191',
            'password'  => 'required|string|min:6|max:191',
        ]);

        $employee = APIEmployeeController::store($request);

        if($employee)
            Session::flash("success", "Een nieuwe medewerker is succesvol aangemaakt!");
        else
            Session::flash("failed", "Fout");

        $employees = APIEmployeeController::getAll(10);
        return redirect('employees')->with('employees', $employees);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = APIEmployeeController::show($id);
        return view('employees/show')->with('employee', $employee);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee = APIEmployeeController::show($id);
        return view('employees/edit')->with('employee', $employee);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *@param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(isset($request->password) && $request->password)
        {
            $this->validate($request, ['password'  => 'required|string|min:6|max:191']);
            $request->password = Hash::make(($request->password));
        }

        $this->validate($request, [
            'name'      => 'string|min:2|max:191',
            'password'  => 'string|min:2|max:191',
            'insertion' => 'string|min:2|max:191',
            'last_name' => 'string|min:2|max:191',
            'initials'  => 'string|min:2|max:191',
            'residence' => 'string|min:2|max:191',
            'username'  => 'string|min:2|max:191',
            'email'     => 'string|min:2|max:191',
        ]);

        $employee = APIEmployeeController::update($request, $id);

        if($employee)
            Session::flash("error", "Medewerker " . $employee->name . " " . $employee->lastName . " is succesvol gewijzigd!");
        else
            Session::flash("failed", "Fout");

        $employees = APIEmployeeController::getAll(10);
        return redirect('employees')->with('employees', $employees);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = APIRideController::show($id);
        APIEmployeeController::destroy($id);

        if($employee)
            Session::flash("error", "Medewerker " . $employee->name . " " . $employee->lastName . " is succesvol verwijderd!");
        else
            Session::flash("failed", "Fout");

        $employees = APIEmployeeController::getAll(10);
        return redirect('employees')->with('employees', $employees);
    }
}
