<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $order = new Order();
        $order->user_id = $request->user_id;
        $order->product_id  = $request->product_id ;
        $order->customer_name = $request->customer_name;
        $order->customer_email = $request->customer_email;
        $order->customer_phone = $request->customer_phone;
        $order->amount = $request->amount;
        $order->save();
        
        return redirect()->route('profile')->with('order', 'Order has been addedd successfully, create Shipment now!');
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
        return redirect()->back()->with('order', 'Your quantity order has been added successfully!');
    }

    public function subtract_quantity(Request $request, Int $id){
        $order = Order::where('id', $id)->first();
        if($order->amount == "1"){
            return redirect()->back()->with('order', 'Failed subtract quantity, your quantity is a minimum!');
        } else{
            $order->amount -= $request->amount;
            $order->save();
            return redirect()->back()->with('order', 'Your quantity order has been subtract successfully!');
        }
    }
}
