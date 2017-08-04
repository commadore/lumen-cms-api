<?php

namespace App\Http\Controllers;

use App\Metadata;
use App\Page;
use Illuminate\Http\Request;

/**
 * @package App\Http\Controllers
 */
class MetadatasController extends Controller
{
    /**
     * Display a listing of the Metadata.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $metadatas = Metadata::all();
        return response()->json($metadatas);
    }

    /**
     * Get the specified Metadata from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $metadataid)
    {
        $page = Page::findOrfail($id);
        //
        $metadata = Metadata::findOrfail($metadataid);

        return response()->json($metadata);
    }


    /**
     * Store a single or batch of metadata.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $page = Page::findOrfail($id);
        //
        $metadata = new Metadata();
        $metadata->page_id = $page->id;
        $metadata->key = $request->json()->get('key');
        $metadata->value = $request->json()->get('value');
        $metadata->save();

        return response()->json($metadata);
    }

    /**
     * Update the specified Metadata in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param integer $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $metadataid)
    {
        $page = Page::findOrfail($id);
        $metadata = Metadata::findOrfail($metadataid);
        $metadata->value = $request->json()->get('value');
        $metadata->save();
        return response()->json($metadata);
    }

    /**
     * Remove the specified Metadata from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Metadata::destroy($id)){
             return response()->json(['status' => 'success']);
        }
    }
}