<?php

namespace App\Http\Controllers;

use Exception;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Stripe;




class StripeController extends Controller
{
   
      /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create ([
                "amount" => 5 * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Binaryboxtuts Payment Test"
        ]);
        return back()->with('success', 'Payment Successful!');
    
    }
    
}
