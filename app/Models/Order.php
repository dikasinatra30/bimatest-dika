<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];

    const STATUSES = [
        1 => "Unpaid",
        2 => "Paid",
    ];

    public function InsertToDB($req)
    {
        $dateValue = explode(' ', $req['expired'])[0];
        $order = new Order;
        $order->amount = (int)$req['amount']+2500;
        $order->reff = $req['reff'];
        $order->expired_at = Carbon::parse($dateValue)->addDays(1);
        $order->name = $req['name'];
        $order->code = "8830" + $req['hp'] ?? 0;
        $order->save();

        return $order;
    }

    public function PaymentPaid()
    {
        $payment = $this;
        $payment->status = 2;
        $payment->paid_at = Carbon::now();
        $payment->save();

        return $payment;
    }

    public function getStatusLabelAttribute()
    {
        return isset(self::STATUSES[$this->status]) ? self::STATUSES[$this->status] : 'No Status';
    }
}
