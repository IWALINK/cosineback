<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Auth\AuthController;
use App\Models\Orders;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;


class CheckoutController extends Controller
{
    public function checkout(Request $request)
    {
        // Log::info('price_id_from_env', []);
        $validator = Validator::make(
            $request->all(),
            [
                'line_items' => ['required', 'array'],
                'line_items.*.price_id' => [
                    'required',
                    'string',
                    function ($attribute, $value, $fail) {
                        $validPriceIds = [
                            config('cashier.PRICE_ID')
                        ];

                        if (!in_array($value, $validPriceIds)) {
                            $fail('Invalid price ID.');
                        }
                    }
                ],
                'line_items.*.quantity' => ['required', 'integer', 'min:1'],
            ]
        );

        if ($validator->fails()) {
            return response(['errors' => $validator->errors()], 422);
        }

        $user = AuthController::get_user($request);
        $checkoutItems = [];

        // Calculate total amount
        $totalAmount = 0;
        foreach ($request->line_items as $item) {
            $checkoutItems[$item['price_id']] = $item['quantity'];
            // You'll need to get the actual price from your price list
            $price = $item['price_id'] === config('cashier.PRICE_ID') ? 60 : 525;
            $totalAmount += $price * $item['quantity'];
        }
        $locale = App::currentLocale();
        $stripeLink = $user->checkout($checkoutItems, [
            'payment_method_types' => ['card', 'paypal'], // 'twint'
            'success_url' => config('cashier.FRONT_END_URL') . '/' . $locale . '/account/orders',
            'cancel_url' => config('cashier.FRONT_END_URL') . '/' . $locale . '/account/orders',
            'invoice_creation' => ['enabled' => true],
        ]);

        // Create order record
        $order = Orders::create([
            'user_id' => $user->id,
            'stripe_session_id' => $stripeLink->id,
            'status' => 'pending',
            'total_amount' => $totalAmount,
            'currency' => 'CHF',
            'items' => json_encode($request->line_items),
            'payment_status' => 'incomplete'
        ]);

        return $stripeLink->url;
    }

    public function getUserOrders(Request $request)
    {
        $user = AuthController::get_user($request);

        $orders = Orders::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'orders' => $orders
        ]);
    }
}
