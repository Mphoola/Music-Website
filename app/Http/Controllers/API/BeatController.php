<?php

namespace App\Http\Controllers\API;

use App\Beat;
use App\Http\Controllers\Controller;
use App\Http\Resources\Beat as ResourcesBeat;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;

class BeatController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $beats = Beat::latest()->paginate(12);        
        return ResourcesBeat::collection($beats);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $beat = Beat::findOrFail($id);
        if(is_null($beat)){
            return $this->sendError('Music not found');
        }
        return $this->sendResponse(new ResourcesBeat($beat), '');
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
}
