<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\BeatFormRequest;
use App\Repositories\Admin\Implementations\BeatRepository;

class BeatsController extends Controller
{

    protected $beatRepository;

    public function __construct(BeatRepository $beatRepository)
    {
        $this->beatRepository = $beatRepository;
    }

    public function index(){
        $beats = $this->beatRepository->all();
        return view('management.beats.index')
            ->with('beats', $beats);
    }

    public function create(){
        $this->checkCategoriesCount();
        return view('management.beats.create')
            ->with('categories', Category::all());
    }

    public function upload(BeatFormRequest $request){
        
        $beat = $this->beatRepository->store($request->all());

        if($beat) {
            return redirect()->route('beats.index')->with('success', 'beat added nicely');
        }
    }

    public function show($id){
        $beat = $this->beatRepository->get($id);
        $size = $this->getFileSize($beat->location);
        return view('management.beats.show', compact('beat', 'size'));
    }
    
    public function edit($id){
        $beat = $this->beatRepository->get($id);
        $categories = Category::all();
        return view('management.beats.create', compact('beat','categories'));
    }

    public function update(BeatFormRequest $request, $id){
        
        $beat = $this->beatRepository->update($id, $request->all());

        if($beat) {
            return redirect()->route('beats.show', $beat->id)->with('success', 'beat updated success');
        }
    }

    public function delete($id){
        if($this->beatRepository->get($id)->delete()){
            return redirect()->route('beats.index')->with('success', 'Beat Deleted');
        }
    }
}
