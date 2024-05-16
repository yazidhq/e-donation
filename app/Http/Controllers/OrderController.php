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
        
        return redirect()->back()->with('product', 'Product has been created successfully!');
    }
}
