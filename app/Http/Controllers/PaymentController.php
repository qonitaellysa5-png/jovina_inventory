<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;

class PaymentController extends Controller
{
    public function index()
    {
        $total = 299900;
        return view('payment', compact('total'));
    }

    public function process()
    {
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = false;
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $params = [
            'transaction_details' => [
                'order_id' => 'JOVINA-'.rand(),
                'gross_amount' => 299900
            ],

            'customer_detailes' => [
                'first_name' => 'Pelanggan Jovina',
                'email' => 'pelanggan@example.com',
            ]
        ];

       try {
            $snapToken = Snap::getSnapToken($params);
            return response()->json([
                'snap_token' => $snapToken
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}