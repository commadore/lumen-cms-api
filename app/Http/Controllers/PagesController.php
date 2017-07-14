<?php

namespace App\Http\Controllers;

use App\Http\Requests\PageRequest;
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
     * Store a newly created resource in storage.
     *
     * @param  PageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PageRequest $request)
    {
        //
        $page = new Page();
        $page->site = $request->json()->get('site');
        $page->route = $request->json()->get('route');
        $page->name = $request->json()->get('name');
        $page->title = $request->json()->get('title');
        $page->content = $request->json()->get('content');
        $page->footer = $request->json()->get('footer');
        $page->published = $request->json()->get('published');

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
        //
        $this->validate($request, [
            'site' => 'required',
            'route' => 'required',
            'name' => 'required',
            'title' => 'required',
            'content' => 'required',
            'footer' => 'required',
            'published' => 'required'
         ]);

        $page = new Page();
        $page->site = $request->site;
        $page->name = $request->name;
        $page->title = $request->title;
        $page->content = $request->contents;
        $page->footer = $request->footer;
        $page->published = $request->published;
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