<?php

namespace App\Http\Controllers;

use App\Http\Requests\LayoutRequest;
use App\Layout;
use App\Site;
use App\Zone;
use Illuminate\Http\Request;

class LayoutsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $layouts = Layout::with('zones')->get();
        return response()->json($layouts);
    }

    /**
     * Get the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $layout = Layout::findOrfail($id);
        $layout->zones = $layout->zones()->get();
        return response()->json($layout);

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
        $layout = Layout::where('route', $route)->where('site', $request->header('site'))->get();

        return response()->json($layout);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  LayoutRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $site = Site::where('code', 'slotto')->first();;

        $layout = new Layout();
        $layout->name = $request->json()->get('name');
        $layout->site_id = $site->id;
        $layout->save();
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
        $layout = Layout::findOrfail($id);
        $layout->name = $request->json()->get('name');
        $layout->save();
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
        if(Layout::destroy($id)){
             return response()->json(['status' => 'success']);
        }
    }
}