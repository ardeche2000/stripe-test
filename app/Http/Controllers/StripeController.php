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
    /*public function store(Request $request){
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create ([
                "amount" => 1 * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Binaryboxtuts Payment Test"
        ]);
        return back()->with('success', 'Payment Successful!');
    
    }*/
    public function store(Request $request){
    try {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        Stripe\Charge::create([
            "amount" => 1 * 100,
            "currency" => "usd",
            "source" => $request->stripeToken,
            "description" => "Binaryboxtuts Payment Test"
        ]);

        return back()->with('success', 'Payment Successful!');
    } catch (Stripe\Exception\CardException $e) {
        // Gérer les erreurs spécifiques liées aux cartes (par exemple, déclencher une alerte ou enregistrer dans les journaux)
        return back()->with('error', $e->getMessage());
    } catch (Stripe\Exception\InvalidRequestException $e) {
        // Gérer les erreurs d'appel API invalides (par exemple, déclencher une alerte ou enregistrer dans les journaux)
        return back()->with('error', $e->getMessage());
    } catch (Stripe\Exception\AuthenticationException $e) {
        // Gérer les erreurs d'authentification (par exemple, déclencher une alerte ou enregistrer dans les journaux)
        return back()->with('error', $e->getMessage());
    } catch (Stripe\Exception\ApiConnectionException $e) {
        // Gérer les erreurs de connexion API (par exemple, déclencher une alerte ou enregistrer dans les journaux)
        return back()->with('error', $e->getMessage());
    } catch (Stripe\Exception\BaseException $e) {
        // Gérer d'autres erreurs Stripe (par exemple, déclencher une alerte ou enregistrer dans les journaux)
        return back()->with('error', $e->getMessage());
    } catch (Exception $e) {
        // Gérer toutes les autres exceptions qui pourraient survenir
        return back()->with('error', 'Une erreur inattendue s\'est produite.');
    }
}
    
}
