<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Http\Resources\OrderResource;
use App\Http\Resources\PaymentResource;
use App\Http\Resources\StatusResource;

class OrderController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // if u need uncomment this syntax for first check auth
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $req)
    {
        if (count($req->all()) > 0) {
            if ($req->amount && $req->reff && $req->expired && $req->name && $req->hp && $req->amount > 0) {

                // Function To Insert in database order
                $order = Order::InsertToDB($req->all());

                return new OrderResource($order);
            }
        }

        return response()->json(['error' => 'Unauthenticated.'], 401);
    }

    public function payment(Request $req)
    {
        if ($req->reff) {
            $payment = Order::query()->where('reff', $req->reff);

            if($payment->count() == 1) {

                // Call function for update payment as a status 2 paid
                $payment = $payment->first()->PaymentPaid();

                return new PaymentResource($payment);
            }
        }

        return response()->json(['error' => 'Forbidden.'], 403);
    }

    public function status(Request $req)
    {
        $order = Order::where('reff', $req->reff)->first();

        if ($order) {
            return new StatusResource($order);
        } else {
            return response()->json(['error' => 'Forbidden.'], 403);
        }
    }
}
