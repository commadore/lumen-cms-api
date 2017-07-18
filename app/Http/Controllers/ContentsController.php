<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContentRequest;
use App\Layout;
use App\Content;
use Illuminate\Http\Request;

/**
 * Class probably not required as Page covers content?
 * @package App\Http\Controllers
 */
class ContentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        //
        $contents = Content::all();
        return response()->json($contents);
    }

    /**
     * Get the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $contentid)
    {
        //
        $content = Content::findOrfail($contentid);

        return response()->json($content);

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
        $content = Content::where('route', $route)->where('site', $request->header('site'))->get();

        return response()->json($content);

    }

    /**
     * Store a single or batch of content.
     *
     * @param  ContentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContentRequest $request, $id)
    {
        $page = Page::findOrfail($id);
        $zones = $page->layout()->get()->zones()->get();
        dd($page,$zones);
        $contents = $request->json()->get('content');
        //
        $content = new Content();
        $content->name = $request->json()->get('name');
        $content->content = $request->json()->get('content');
        $content->save();

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
        $content = Content::findOrfail($id);
        $content->name = $request->json()->get('name');
        $content->save();
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
        if(Content::destroy($id)){
             return response()->json(['status' => 'success']);
        }
    }
}