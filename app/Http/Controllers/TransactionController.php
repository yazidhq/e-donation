<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Product;
use App\Models\Shipment;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function update_payment_status(Int $id)
    {
        DB::beginTransaction();

        try {
            $transaction = Transaction::where('id', $id)->first();
            $transaction->status = "done";
            $transaction->save();

            $shipment = Shipment::where('id', $transaction->order->shipment->id)->first();
            $shipment->status = "preparation for shipping";
            $shipment->save();

            $product = Product::where("id", $transaction->order->product->id)->first();
            $product->stock -= $transaction->order->amount;
            $product->save();

            DB::commit();
            return redirect()->back()->with("order", "Your payment has been paid successfully!");
        } catch(Exception) {
            DB::rollback();
            return redirect()->back()->with('server_error', '500: Server error');
        }
    }
}
