<?php

namespace App\Http\Controllers;

use App\Content;
use App\Page;
use Illuminate\Http\Request;

/**
 * @package App\Http\Controllers
 */
class ContentsController extends Controller
{
    /**
     * Display a listing of the Content.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $contents = Content::all();
        return response()->json($contents);
    }

    /**
     * Get the specified Content from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $contentid)
    {
        $page = Page::findOrfail($id);
        //
        $content = Content::findOrfail($contentid);

        return response()->json($content);
    }

    /**
     * Get the specified Content from storage.
     *
     * @param  string  $route
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function showByName($name, Request $request)
    {
        $content = Content::where('name', $name)->where('site', $request->header('site'))->get();
        return response()->json($content);
    }

    /**
     * Store a single or batch of content.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $page = Page::findOrfail($id);
        //
        $content = new Content();
        $content->page_id = $page->id;
        $content->name = $request->json()->get('name');
        $content->content = $request->json()->get('content');
        $content->save();

        return response()->json($content);
    }

    /**
     * Update the specified Content in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param integer $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $contentid)
    {
        $page = Page::findOrfail($id);
        $content = Content::findOrfail($contentid);
        $content->name = $request->json()->get('name');
        $content->save();
        return response()->json($content);
    }

    /**
     * Remove the specified Content from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Content::destroy($id)){
             return response()->json(['status' => 'success']);
        }
    }
}