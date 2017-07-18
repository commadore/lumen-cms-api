<?php

namespace App\Http\Controllers;

use App\Content;
use App\Http\Requests\PageRequest;
use App\Layout;
use App\Metadata;
use Illuminate\Http\Request;
use App\Page;

class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $Page = Page::all();
        return response()->json($Page);
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
        $page = Page::findOrfail($id);

        return response()->json($page);

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
        $page = Page::where('route', $route)->where('site', $request->header('site'))->get();

        return response()->json($page);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  PageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $site = Site::where('code', 'slotto')->first();
        $layout = Layout::where('name', $request->json()->get('layout'))
            ->where('site_id', $request->header('site'))->get();

        $page = new Page;
        $page->site_id = $request->header('site');
        $page->route = $request->json()->get('route');
        $page->name = $request->json()->get('name');
        $page->layout_id = $layout->id;
        $page->save();

        return response()->json(['status' => 'success']);
        
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

        $page = new Page();
        $page->site = $request->header('site');
        $page->route = $request->json()->get('route');
        $page->name = $request->json()->get('name');
        $page->published = $request->json()->get('published');
        $page->save();
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
        if(Page::destroy($id)){
             return response()->json(['status' => 'success']);
        }
    }
}