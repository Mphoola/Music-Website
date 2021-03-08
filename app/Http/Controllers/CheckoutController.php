<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Services\Zachangu;

class CheckoutController extends Controller
{
    public function index(Zachangu $zachangu){

        return view('shop.checkout')
            ->with('zachangu', $zachangu);
    }

    public function zachanguError(Request $request, Zachangu $zachangu){
        
        $data = $request->all();
        
        if (isset($data['status'])) {
            dd($zachangu->paymentStatus('qAs34cGtEQHWxuE0Mnst'));
            if ($data['status'] === "failed") {
                
                $payonline = new Zachangu();
                
                $response = $payonline->paymentStatus($data['identifier']);
                dd($response);
                if ($response['type'] === "Cancelled") {
                    return 'good, you cancelled';
                }
            }
        }
    }
        

    public function zachanguSuccess(Request $request, Zachangu $zachangu){
        $data = $request->all();
        if (isset($data['status'])) {
            if ($data['status'] === "Paid") {
                
                $payonline = new Zachangu();
                
                $response = $payonline->paymentStatus($data['identifier']);
                dd($response);
                if ($response['type'] === "success") {
                    return 'good';
                }
            }
        }
    }
    
}
