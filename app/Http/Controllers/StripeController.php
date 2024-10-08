<?php
namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Stripe\Charge;
use Stripe\Checkout\Session as StripeSession;
use Stripe\Exception\CardException;
use Stripe\Stripe;

class StripeController extends Controller
{
    public function createCheckoutSession(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));
    
        $user = $request->input('user');
        $cartItems = $request->input('cartItems');
        $totalPrice = $request->input('totalPrice'); 
    
        try {
            $lineItems = [];
            
            foreach ($cartItems as $item) {
                $lineItems[] = [
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => $item['product']['name'],
                        ],
                        'unit_amount' => intval($item['product']['price'] * 100), 
                    ],
                    'quantity' => $item['quantity'],
                ];
            }
    
            $session = StripeSession::create([
                'payment_method_types' => ['card'],
                'line_items' => $lineItems, 
                'mode' => 'payment',
                'success_url' => url('/stripe/success'), 
                'cancel_url' => url('/stripe/cancel'),   
            ]);
    
            return response()->json(['id' => $session->id]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    

    public function success()
    {
        return view('payment-success');
    }

    public function cancel()
    {
        return view('payment-cancelled');
    }
}
