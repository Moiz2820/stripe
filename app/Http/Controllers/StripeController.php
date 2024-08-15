<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\StripeClient;

class StripeController extends Controller
{
    //
    public function index()
    {
        $stripe = new StripeClient(env('STRIPE_SECRET'));
        $customer = $stripe->customers->create([
            'name' => 'Jenny Rosen',
            'email' => 'jennyrosen@example.com',
          ]);
       $intent =  $stripe->paymentIntents->create([
        'customer' => $customer->id,
            'amount' => 5000000,
            'currency' => 'gbp',

            'automatic_payment_methods' => ['enabled' => true],
            // 'payment_method_types' => ['card', 'paypal'],
            'payment_method_configuration' => 'pmc_1Po2tF07aoOfuPyvEQlinbiK',

        ]);
        // dd($intent->client_secret);

        return view('stripe')->with('clientSecret',$intent->client_secret);

    }
}
