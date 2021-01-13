<?php

namespace App\Http\Controllers\Admin;

use App\Advert;
use App\AdvertCategory;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdvertFormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdvertController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('management.adverts.ads.index')
            ->with('adverts', Advert::orderBy('created_at', 'desc')->paginate(10))
            ->with('categories', AdvertCategory::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //return view('management.adverts.ads.create')->with('categories', AdvertCategory::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdvertFormRequest $request)
    {
        $ad = Advert::make($request->all());
        if($ad){
            return redirect()->route('advert.index')->with('success', 'The advert has been placed');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
    }

    public function redirect($advert_id){
        $advert = Advert::findOrFail($advert_id);
        DB::table('adverts')
            ->where('id', $advert->id)
            ->update(['clicks' => $advert->clicks+1]);
        
        return redirect()->away($advert->url);
    }
}
