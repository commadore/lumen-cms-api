<?php

namespace App\Http\Controllers;

use App\Content;
use App\Layout;
use App\Metadata;
use App\Site;
use Illuminate\Http\Request;
use App\Page;

class PagesController extends Controller
{
    /**
     * Display a listing of the Page.
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
     * Get the specified Page from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $page = Page::findOrfail($id);
        $content = Content::where('page_id', $page->id)->get();
        $metadata = Metadata::where('page_id', $page->id)->get();
        $page->content = $content;
        $page->metadata = $metadata;
        return response()->json($page, JSON_UNESCAPED_SLASHES);

    }

    /**
     * Get the specified Page from storage.
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
     * Store a newly created Page in storage.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $site = Site::where('code', $request->header('site'))->first();

        $page = new Page;
        $page->site_id = $site->id;
        $page->route = $request->json()->get('route');
        $page->name = $request->json()->get('name');
        $page->published = $request->json()->get('published');
        $page->save();

        return response()->json($page);
        
    }

    /**
     * Update the specified Page in storage.
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
     * Remove the specified Page from storage.
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