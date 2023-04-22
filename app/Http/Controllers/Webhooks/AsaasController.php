<?php

namespace App\Http\Controllers\Webhooks;

use App\Http\Controllers\Controller;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AsaasController extends Controller
{
    /**
     * Handles an incoming request.
     *
     * @return Response
     */
    public function handle(Request $request)
    {
        switch ($request->event) {
            case 'PAYMENT_CREATED':
                $order = Order::where('gateway_payment_id', $request->payment['id'])
                    ->first();
                break;
            case 'PAYMENT_UPDATED':
                # code...
                break;
            case 'PAYMENT_CONFIRMED':
                # code...
                break;
            case 'PAYMENT_RECEIVED':
                $order = Order::where('gateway_payment_id', $request->payment['id'])
                    ->first();

                if($order) {
                    $order->payment_status = 'paid';
                    $order->save();

                    $order->status()->attach([3 => ['comment'=>'', 'user_id' => 1]]);
                }
                break;
        }
    }
}
