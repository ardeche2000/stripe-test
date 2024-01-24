<?php

namespace App\Http\Controllers;

use Exception;

use Illuminate\Http\Request;
use Stripe\Exception\CardException;
use Stripe\StripeClient;
use Stripe;
use Session;



class StripeController extends Controller
{
    public function store(Request $request){
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
    
        Stripe\Charge::create ([
                "amount" => 100 * 1,
                "currency" => "eur",
                "source" => $request->stripeToken,
                "description" => "Test payment from msavoir" 
        ]);
      //ardeche
        Session::flash('success', 'Payment successful!');
              
        return back();
    
    }
    
}
