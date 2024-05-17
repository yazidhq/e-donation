<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Transaction;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        DB::beginTransaction(); // Memulai transaksi database

        try {
            $order = new Order();
            $order->user_id = $request->user_id;
            $order->product_id = $request->product_id;
            $order->customer_name = $request->customer_name;
            $order->customer_email = $request->customer_email;
            $order->customer_phone = $request->customer_phone;
            $order->amount = $request->amount;
            $order->save();

            $order_id = $order->id;
            $transaction = new Transaction();
            $transaction->order_id = $order_id;
            $transaction->save();

            \Midtrans\Config::$serverKey = config('midtrans.serverKey');
            \Midtrans\Config::$isProduction = false;
            \Midtrans\Config::$isSanitized = true;
            \Midtrans\Config::$is3ds = true;

            $params = array(
                'transaction_details' => array(
                    'order_id' => rand(),
                    'gross_amount' => ($request->amount * $order->product->price),
                )
            );

            $snapToken = \Midtrans\Snap::getSnapToken($params);
            $transaction->snapToken = $snapToken;
            $transaction->save();

            DB::commit();

            return redirect()->route('profile')->with('order', 'Order has been added successfully, create Shipping now!');
        } catch (\Exception $e) {
            DB::rollBack();
            echo '<script>alert(' + $e + ')</script>';
        }
    }

    public function update(Request $request, Int $id){
        $order = Order::where('id', $id)->first();
        $order->update($request->all());

        return redirect()->back()->with('order', 'Your order has been updated successfully!');
    }

    public function add_quantity(Request $request, Int $id){
        $order = Order::where('id', $id)->first();
        $order->amount += $request->amount;
        $order->save();

        $order_id = $order->id;
        $transaction = Transaction::where('order_id', $order_id)->first();

        \Midtrans\Config::$serverKey = config('midtrans.serverKey');
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => rand(),
                'gross_amount' => ($order->amount * $order->product->price),
            )
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        $transaction->snapToken = $snapToken;
        $transaction->save();

        return redirect()->back()->with('order', 'Your quantity order has been added successfully!');
    }

    public function subtract_quantity(Request $request, Int $id){
        $order = Order::where('id', $id)->first();
        if($order->amount == "1"){
            return redirect()->back()->with('order', 'Failed subtract quantity, your quantity is a minimum!');
        } else{
            $order->amount -= $request->amount;
            $order->save();

            $order_id = $order->id;
            $transaction = Transaction::where('order_id', $order_id)->first();

            \Midtrans\Config::$serverKey = config('midtrans.serverKey');
            \Midtrans\Config::$isProduction = false;
            \Midtrans\Config::$isSanitized = true;
            \Midtrans\Config::$is3ds = true;

            $params = array(
                'transaction_details' => array(
                    'order_id' => rand(),
                    'gross_amount' => ($order->amount * $order->product->price),
                )
            );

            $snapToken = \Midtrans\Snap::getSnapToken($params);

            $transaction->snapToken = $snapToken;
            $transaction->save();

            return redirect()->back()->with('order', 'Your quantity order has been subtract successfully!');
        }
    }

    public function cancel_order(Int $id){
        Order::where('id', $id)->delete();
        return redirect()->back()->with('order', 'Your order has been deleted successfully!');
    }
}
