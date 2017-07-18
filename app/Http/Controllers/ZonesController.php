<?php

namespace App\Http\Controllers;

use App\Http\Requests\ZoneRequest;
use App\Layout;
use App\Zone;
use Illuminate\Http\Request;

class ZonesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        //
        $zones = Zone::all()->where('layout_id', $id);
        return response()->json($zones);
    }

    /**
     * Get the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $zoneid)
    {
        //
        $zone = Zone::findOrfail($zoneid);

        return response()->json($zone);

    }

    /**
     * Get the specified resource from storage.
     *
     * @param  string  $route
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function showByName($route, Request $request)
    {
        //
        $zone = Zone::where('route', $route)->where('site', $request->header('site'))->get();

        return response()->json($zone);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ZoneRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ZoneRequest $request, $id)
    {
        $layout = Layout::findOrfail($id);
        //
        $zone = new Zone();
        $zone->name = $request->json()->get('name');
        $zone->layout_id = $id;
        $zone->save();
        return response()->json(['status' => 'success']);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param integer $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $zone = Zone::findOrfail($id);
        $zone->name = $request->json()->get('name');
        $zone->save();
        return response()->json(['status' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        if(Zone::destroy($id)){
             return response()->json(['status' => 'success']);
        }
    }
}