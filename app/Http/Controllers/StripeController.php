<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Stripe\Exception\CardException;
use Stripe\StripeClient;
use Stripe;


class StripeController extends Controller
{
    public function store(Request $request){
        $request->validate([
            'card_number'=>"required",
            'date_expi'=>"required",
            'year_expi'=>"required",
            'csv'=>"required",
        ]);
        //dd($request->all());
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $data=Stripe\Charge::create ([
                "amount" => 100 * 100,
                "currency" => "EUR",
                "source" => $request->stripeToken,
                "description" => "Making test payment." 
        ]);
       
        return back()->with('success', 'Payment has been successfully processed.');
    }
    
}
