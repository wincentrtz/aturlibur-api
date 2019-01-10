<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Trip;
use Auth;

class TripController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trips = Trip::where('user_id',Auth::user()->id)->get();
        return response()->json([
            'status' => 200,
            'data' => $trips
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $trip = new Trip();
        $trip->trip_name = $request->trip_name;
        $trip->user_id = Auth::user()->id;
        $trip->trip_start_date = $request->trip_start_date;
        $trip->trip_end_date = $request->trip_end_date;
        $trip->trip_location = $request->trip_location;
        $trip->save();
        return response()->json([
            'status' => 201,
            'data' => $trip
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Trip  $trip
     * @return \Illuminate\Http\Response
     */
    public function show($name)
    {
        $trip = Trip::where('trip_name',$name)->first();
        $trip['range'] =( strtotime($trip['trip_end_date']) - strtotime($trip['trip_start_date'])) / (60 * 60 * 24);
        return response()->json([
            'status' => 200,
            'data' => $trip
        ]);
    }

    public function showDetail($date)
    {
        $tripDetails = TripDetail::where('date',$date)->get();
        dd($tripDetails);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Trip  $trip
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Trip $trip)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Trip  $trip
     * @return \Illuminate\Http\Response
     */
    public function destroy(Trip $trip)
    {
        //
    }
}
