<?php

namespace App\Http\Controllers;

use App\Client;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Session;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class ClientController extends Controller
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
        $cookie_objects = "clients";
        include "cookies.php";

        $clients = APIClientController::getAll($result_amount, $sort_by, $sort_order);
        return view('clients/index')->with('clients', $clients)->with('result_amounts', $result_amounts)->with('sorting', $sorting);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clients = APIClientController::getAll();
        return view('clients/create')->with('clients', $clients);
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

        $client = APIClientController::store($request);

        if($client)
            Session::flash("success", "Een nieuwe gebruiker is succesvol aangemaakt!");
        else
            Session::flash("failed", "Fout");

        $clients = APIClientController::getAll(10);
        return redirect('clients')->with('clients', $clients);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $client = APIClientController::show($id);
        $rides = null;

        if(Auth::user()->id == $client->id || (Auth::guard('employee')->check() && $client->privacy_permission))
            $rides  = APIRideController::getAllByUserId($id);

        return view('clients/show')->with('client', $client)->with('rides', $rides);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $client = APIClientController::show($id);
        return view('clients/edit')->with('client', $client);
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
        if(isset($request->password) && $request->password)
        {
            $this->validate($request, ['password'  => 'required|string|min:6|max:191']);
            $request->password = Hash::make($request->password);
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

        $client = APIClientController::update($request, $id);

        if($client)
            Session::flash("error", "Gebruiker " . $client->name . " " . $client->lastName . " is succesvol gewijzigd!");
        else
            Session::flash("failed", "Fout");

        $clients = APIClientController::getAll(10);
        return redirect('clients')->with('clients', $clients);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $client = APIClientController::show($id);
        APIClientController::destroy($id);

        if($client)
            Session::flash("error", "Gebruiker " . $client->name . " " . $client->lastName . " is succesvol verwijderd!");
        else
            Session::flash("failed", "Fout");

        $clients = APIClientController::getAll(10);
        return redirect('clients')->with('clients', $clients);
    }
}
