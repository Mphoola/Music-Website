<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Services\zachangu;

class CheckoutController extends Controller
{
    public function index(zachangu $zachangu){

        return view('shop.checkout')
            ->with('zachangu', $zachangu);
    }

    public function zachanguError(Request $request, zachangu $zachangu){
        $invoice = $zachangu->paid($request->identifier);
        $zachangu->dump($invoice);
    }

    public function zachanguSuccess(Request $request, zachangu $zachangu){
        $invoice = $zachangu->paid($request->identifier);
        $zachangu->dump($invoice);
    }

    public function pay(){
        
    }
}
