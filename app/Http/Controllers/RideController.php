<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use Redirect;

class RideController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cookie_objects = "rides";
        include "cookies.php";

        $user_id = null;

        if(!Auth::guard('employee')->check())
            $user_id = Auth::user()->id;

        $rides = APIRideController::getAll($result_amount, $sort_by, $sort_order, $user_id);
        return view('rides/index')->with('rides', $rides)->with('result_amounts', $result_amounts)->with('sorting', $sorting);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rides  =  APIRideController::getAll();
        $cars   =  APICarController::getAll();

        session(['_old_input.car_id'        => '']);
        session(['_old_input.start_country' => '']);
        session(['_old_input.start_city'    => '']);
        session(['_old_input.start_street'  => '']);
        session(['_old_input.dest_country'  => '']);
        session(['_old_input.dest_city'     => '']);
        session(['_old_input.dest_street'   => '']);
        session(['_old_input.arrive_date'   => '']);
        session(['_old_input.arrive_time'   => '']);
        return view('rides/create')->with('rides', $rides)->with('cars', $cars);
    }

    public function createHome()
    {
        $rides  =  APIRideController::getAll();
        $cars   =  APICarController::getAll();

        session(['_old_input.car_id' => '']);
        session(['_old_input.start_country' => '']);
        session(['_old_input.start_city' => '']);
        session(['_old_input.start_street' => '']);
        session(['_old_input.dest_country' => Auth::user()->country]);
        session(['_old_input.dest_city' => Auth::user()->city]);
        session(['_old_input.dest_street' => Auth::user()->street]);
        session(['_old_input.arrive_date'   => '']);
        session(['_old_input.arrive_time'   => '']);
        return view('rides/create')->with('rides', $rides)->with('cars', $cars);
    }

    public function createLastRoute()
    {
        $rides  =  APIRideController::getAll();
        $cars   =  APICarController::getAll();

        $lastRide = APIRideController::getLastRideOfUser(Auth::user()->id);

        if($lastRide) {
            session(['_old_input.car_id'        => $lastRide->car_id]);
            session(['_old_input.start_country' => $lastRide->start_country]);
            session(['_old_input.start_city'    => $lastRide->start_city]);
            session(['_old_input.start_street'  => $lastRide->start_street]);
            session(['_old_input.dest_country'  => $lastRide->dest_country]);
            session(['_old_input.dest_city'     => $lastRide->dest_city]);
            session(['_old_input.dest_street'   => $lastRide->dest_street]);
            session(['_old_input.arrive_date'   => $lastRide->arrive_date]);
            session(['_old_input.arrive_time'   => $lastRide->arrive_time]);
        } else {
            session(['_old_input.car_id'        => '']);
            session(['_old_input.start_country' => '']);
            session(['_old_input.start_city'    => '']);
            session(['_old_input.start_street'  => '']);
            session(['_old_input.dest_country'  => '']);
            session(['_old_input.dest_city'     => '']);
            session(['_old_input.dest_street'   => '']);
            session(['_old_input.arrive_date'   => '']);
            session(['_old_input.arrive_time'   => '']);
        }


        return view('rides/create')->with('rides', $rides)->with('cars', $cars);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request['user_id'] = Auth::user()->id;
        $origin             = $request->start_country . "," . $request->start_city . "," . $request->start_street;
        $destination        = $request->dest_country . "," . $request->dest_city . "," . $request->dest_street;

        $distance_data = file_get_contents(
            'https://maps.googleapis.com/maps/api/distancematrix/json?&origins='.urlencode($origin).'&destinations='.urlencode($destination).'&alternatives=false&key=<SECRET_KEY_HERE>'
        );

        $location_info = json_decode($distance_data);

        if($distance_data) {
            $request['distance'] = $location_info->rows[0]->elements[0]->distance->text;
            $request['duration'] = $location_info->rows[0]->elements[0]->duration->text;

            $car        = APICarController::show($request->car_id);
            $category   = APICategoryController::show($car->category_id);
            $rides      = APIRideController::getAllByUserId($request['user_id']);
            $discount   = 0;

            if(count($rides) >= 10)
                $discount = 1;

            $final_price = (($location_info->rows[0]->elements[0]->duration->value * $category->price_per_km) / 100) - $discount;
            $request['costs'] = $final_price;
        }

        $this->validate($request, [
            'user_id'       => 'required|string',
            'car_id'        => 'required|string',
            'arrive_date'   => 'required|date',
            'arrive_time'   => 'required|string',
            'dest_country'  => 'required|string|min:2|max:191',
            'dest_city'     => 'required|string|min:2|max:191',
            'dest_street'   => 'required|string|min:2|max:191',
            'start_country' => 'required|string|min:2|max:191',
            'start_city'    => 'required|string|min:2|max:191',
            'start_street'  => 'required|string|min:2|max:191',
            'distance'      => 'required|string',
            'costs'         => 'required|numeric',
            'duration'      => 'required|string'
        ]);

        $ride = APIRideController::store($request);

        if($ride)
            Session::flash("success", "Een nieuwe rit is succesvol aangemaakt!");
        else
            Session::flash("failed", "Fout");

        $rides = APIRideController::getAll(10);
        return redirect('rides')->with('rides', $rides);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ride   = APIRideController::show($id);
        $user   = Auth::user($ride->user_id);
        $car    = APICarController::show($ride->car_id);
        return view('rides/show')->with('ride', $ride)->with('user', $user)->with('car', $car);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ride   = APIRideController::show($id);
        $cars   = APICarController::getAll();
        return view('rides/edit')->with('ride', $ride)->with('cars', $cars);
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
        $request['user_id'] = Auth::user()->id;

        if($request->start_country && $request->start_city && $request->start_street && $request->dest_country && $request->dest_city && $request->dest_street) {
            $origin = $request->start_country . "," . $request->start_city . "," . $request->start_street;
            $destination = $request->dest_country . "," . $request->dest_city . "," . $request->dest_street;

            $distance_data = file_get_contents(
                'https://maps.googleapis.com/maps/api/distancematrix/json?&origins='.urlencode($origin).'&destinations='.urlencode($destination).'&alternatives=false&key=<SECRET_KEY_HERE>'
            );

            $location_info = json_decode($distance_data);

            if($distance_data) {
                $request['distance'] = $location_info->rows[0]->elements[0]->distance->text;
                $request['duration'] = $location_info->rows[0]->elements[0]->duration->text;

                $car        = APICarController::show($request->car_id);
                $category   = APICategoryController::show($car->category_id);
                $rides      = APIRideController::getAllByUserId($request['user_id']);
                $discount   = 0;

                if(count($rides) >= 10)
                    $discount = 1;

                $final_price = (($location_info->rows[0]->elements[0]->duration->value * $category->price_per_km) / 100) - $discount;
                $request['costs'] = $final_price;
            }
        }

        $this->validate($request, [
            'user_id'       => 'string',
            'car_id'        => 'string',
            'arrive_date'   => 'string|date',
            'arrive_time'   => 'string|string',
            'destination_time'   => 'string|min:2|max:191',
            'dest_country'  => 'string|min:2|max:191',
            'dest_city'     => 'string|min:2|max:191',
            'dest_street'   => 'string|min:2|max:191',
            'start_country' => 'string|min:2|max:191',
            'start_city'    => 'string|min:2|max:191',
            'start_street'  => 'string|min:2|max:191',
            'distance'      => 'string',
            'costs'         => 'numeric',
            'duration'      => 'string',
        ]);

        $ride = APIRideController::update($request, $id);

        if($ride)
            Session::flash("success", "Rit van " . $request->start_city . " naar " . $request->dest_city . " is succesvol gewijzigd!");
        else
            Session::flash("failed", "Fout");

        $rides = APIRideController::getAll(10);
        return redirect('rides')->with('rides', $rides);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ride = APIRideController::show($id);
        APIRideController::destroy($id);

        if($ride)
            Session::flash("error", "Rit van " . $ride->start_city . " naar " . $ride->dest_city . " is succesvol verwijderd!");
        else
            Session::flash("failed", "Fout");

        $rides = APIRideController::getAll(10);
        return redirect('rides')->with('rides', $rides);
    }
}
