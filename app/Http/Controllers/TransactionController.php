<?php

namespace App\Http\Controllers;

use App\Models\Shipment;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function update_payment_status(Int $id)
    {
        $transaction = Transaction::where('id', $id)->first();
        $transaction->status = "done";
        $transaction->save();

        $shipment = Shipment::where('id', $transaction->order->shipment->id)->first();
        $shipment->status = "preparation for shipping";
        $shipment->save();

        return redirect()->back()->with("order", "Your payment has been paid successfully!");
    }
}
