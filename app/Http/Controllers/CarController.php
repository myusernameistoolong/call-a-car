<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Redirect;

class CarController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:employee', ['except' => ['index', 'show']]);
        $this->middleware('auth', ['only' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cookie_objects = "cars";
        include "cookies.php";

        $cars = APICarController::getAll($result_amount, $sort_by, $sort_order);
        return view('cars/index')->with('cars', $cars)->with('result_amounts', $result_amounts)->with('sorting', $sorting);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cars       =  APICarController::getAll();
        $categories = APICategoryController::getAll();
        return view('cars/create')->with('cars', $cars)->with('categories', $categories);
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
            'brand'      => 'required|string|min:2|max:191',
            'type'      => 'required|string|min:2|max:191',
            'license'   => 'required',
            'allow_wheel_chair' => 'bool',
            'capacity' => 'required',
            'category_id' => 'required'
        ]);

        $car = APICarController::store($request);

        if($car)
            Session::flash("success", "Een nieuwe auto is succesvol aangemaakt!");
        else
            Session::flash("failed", "Fout");

        $cars = APICarController::getAll(10);
        return redirect('cars')->with('cars', $cars);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $car        = APICarController::show($id);
        $category   = APICategoryController::show($car->category_id);
        return view('cars/show')->with('car', $car)->with('category', $category);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $car = APICarController::show($id);
        $categories = APICategoryController::getAll();
        return view('cars/edit')->with('car', $car)->with('categories', $categories);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'brand'      => 'string|min:2|max:191',
            'type'      => 'string|min:2|max:191',
            //'allow_wheel_chair' => 'required',
            //'capacity' => 'required'
            //'category_id' => 'required'
        ]);

        $car = APICarController::update($request, $id);

        if($car)
            Session::flash("success", "Auto " . $request->brand . ": " . $request->type . " is succesvol gewijzigd!");
        else
            Session::flash("failed", "Fout");

        $cars = APICarController::getAll(10);
        return redirect('cars')->with('cars', $cars);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $car = APIRideController::show($id);
        APICarController::destroy($id);

        if($car)
            Session::flash("error", "Auto " . $car->brand . ": " . $car->type . " is succesvol verwijderd!");
        else
            Session::flash("failed", "Fout");

        $cars = APICarController::getAll(10);
        return redirect('cars')->with('cars', $cars);
    }
}
