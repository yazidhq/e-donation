<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Transaction;

class OrderController extends Controller
{
    private function transaction($transaction, $amount_price)
    {
        \Midtrans\Config::$serverKey = config('midtrans.serverKey');
        \Midtrans\Config::$isProduction = config('midtrans.isProduction');
        \Midtrans\Config::$isSanitized = config('midtrans.isSanitized');
        \Midtrans\Config::$is3ds = config('midtrans.is3ds');

        $params = array(
            'transaction_details' => array(
                'order_id' => rand(),
                'gross_amount' => $amount_price,
            )
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        $transaction->snapToken = $snapToken;
        $transaction->save();
    }

    public function store(Request $request)
    {
        DB::beginTransaction(); 

        try {
            $order = new Order();
            $order->user_id = $request->user_id;
            $order->product_id = $request->product_id;
            $order->customer_name = $request->customer_name;
            $order->customer_email = $request->customer_email;
            $order->customer_phone = $request->customer_phone;
            $order->amount = $request->amount;
            $order->save();

            $transaction = new Transaction();
            $transaction->order_id = $order->id;
            $transaction->save();

            $amount_price = $request->amount * $order->product->price;
            $this->transaction($transaction, $amount_price);

            DB::commit();
            return redirect()->route('profile')->with('order', 'Order has been added successfully, create Shipping now!');
        } catch (\Exception) {
            DB::rollBack();
            return redirect()->back()->with('server_error', '500: Server error');
        }
    }

    public function update(Request $request, Int $id){
        $order = Order::with('product')->where('id', $id)->first();
        $order->update($request->all());

        return redirect()->back()->with('order', 'Your order has been updated successfully!');
    }

    public function add_quantity(Request $request, Int $id)
    {
        DB::beginTransaction(); 

        try {
            $order = Order::with('product', 'transaction')->where('id', $id)->first();
            $order->amount += $request->amount;
            $order->save();

            $transaction = Transaction::where('order_id', $order->id)->first();
            $amount_price = $order->amount * $order->product->price;
            $this->transaction($transaction, $amount_price);

            DB::commit();
            return redirect()->back()->with('order', 'Your quantity order has been added successfully!');
        } catch (\Exception) {
            DB::rollBack();
            return redirect()->back()->with('server_error', '500: Server error');
        }
    }

    public function subtract_quantity(Request $request, Int $id)
    {
        DB::beginTransaction(); 

        try {
            $order = Order::with('product', 'transaction')->where('id', $id)->first();
            if($order->amount == "1"){
                return redirect()->back()->with('order', 'Failed subtract quantity, your quantity is a minimum!');
            } else{
                $order->amount -= $request->amount;
                $order->save();

                $transaction = Transaction::where('order_id', $order->id)->first();
                $amount_price = $order->amount * $order->product->price;
                $this->transaction($transaction, $amount_price);

                DB::commit();
                return redirect()->back()->with('order', 'Your quantity order has been subtract successfully!');
            }
        } catch (\Exception) {
            DB::rollBack();
            return redirect()->back()->with('server_error', '500: Server error');
        }
    }

    public function cancel_order(Int $id)
    {
        Order::where('id', $id)->delete();
        return redirect()->back()->with('order', 'Your order has been deleted successfully!');
    }
}
