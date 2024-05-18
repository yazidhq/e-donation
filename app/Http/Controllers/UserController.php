<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Shipment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function profile(){
        $orders = Order::with('product', 'transaction', 'shipment')->where('user_id', auth()->user()->id)->get();
        return view("users.profile", compact('orders'));
    }

    public function update_profile(Request $request, Int $id){
        $user = User::where('id', $id)->first();

        if(isset($request->name)){
            $user->name = $request->name;
            $user->save();
        }

        if(isset($request->email)){
            $user->email = $request->email;
            $user->save();
        }

        if(isset($request->password)){
            $user->password = Hash::make($request->password);
            $user->save();
        }
        
        return redirect()->back()->with('profile', 'Your profile has been updated successfully!');
    }

    public function store_shipment(Request $request){
        $order = Order::where('id', $request->order_id)->first();
        $order->is_created_shipment = true;
        $order->save();

        $shipment = new Shipment();
        $shipment->order_id  = $request->order_id ;
        $shipment->place_name = $request->place_name;
        $shipment->city = $request->city;
        $shipment->province = $request->province;
        $shipment->postal_code = $request->postal_code;
        $shipment->address = $request->address;
        $shipment->save();

        return redirect()->back()->with('order', 'Your shipment has been created successfully!');
    }

    public function update_shipment(Request $request, Int $id){
        $shipment = Shipment::where('id', $id)->first();

        $shipment->update($request->all());

        return redirect()->back()->with('order', 'Your shipment has been updated successfully!');
    }
}
