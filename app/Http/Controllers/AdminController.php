<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Shipment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view("admin.dashboard");
    }

    public function users()
    {
        $users = User::with('order')->get();
        return view("admin.users.users", compact("users"));
    }
    
    public function store_users(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:250',
            'email' => 'required|email|max:250|unique:users',
            'password' => 'required|min:8|confirmed',
        ]);

        $user = new User($data);
        $user->role = $request->role;
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->back()->with('users', 'Users has been registered successfully!');
    }

    public function update_users(Request $request, Int $id)
    {
        $user = User::where('id', $id)->first();

        if(isset($request->role)){  
            $user->role = $request->role;
            $user->save();
        }

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

        return redirect()->back()->with('users', 'Users has been updated successfully!');
    }

    public function delete_user(Int $id)
    {
        $user = User::where('id', $id)->first();
        $user->delete();
        return redirect()->back()->with('users', 'Users has been deleted successfully!');
    }

    public function user_orders(Int $id)
    {
        $user = User::with('order.product', 'order.shipment', 'order.transaction')->where('id', $id)->first();
        return view("admin.users.user_order", compact("user"));
    }

    public function detail_user_order(Int $userId, Int $orderId)
    {
        $order = Order::with('shipment')->where('id', $orderId)->first();
        $user = User::where('id', $userId)->first();
        return view("admin.users.detail_user_order", compact("order", "user"));
    }

    public function edit_user_order(Int $userId, Int $orderId)
    {
        $order = Order::with('shipment')->where('id', $orderId)->first();
        $user = User::where('id', $userId)->first();
        return view("admin.users.edit_user_order", compact("order", "user"));
    }

    public function update_user_order(Request $request, Int $userId, Int $orderId)
    {
        DB::beginTransaction();

        try {
            $user = User::where('id', $userId)->first();
            $order = Order::where('id', $orderId)->first();
            $shipment = Shipment::where('order_id', $order->id)->first();

            $order->customer_name = $request->customer_name;
            $order->customer_email = $request->customer_email;
            $order->customer_phone = $request->customer_phone;
            $order->save();

            $shipment->place_name = $request->place_name;
            $shipment->city = $request->city;
            $shipment->province = $request->province;
            $shipment->postal_code = $request->postal_code;
            $shipment->address = $request->address;
            $shipment->save();

            DB::commit();
            return redirect()->route('user_orders', $user->id)->with('order', 'The order has been updated successfully!');
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->route('user_orders', $user->id)->with('failed_order', 'Failed update the order!');
        }
    }

    public function delete_order(Int $id)
    {
        $order = Order::where('id', $id)->first();
        $order->delete();
        return redirect()->back()->with('order', 'The order has been deleted successfully!');
    }

    public function delete_shipment(Int $id)
    {
        DB::beginTransaction();

        try {
            $order = Order::where('id', $id)->first();
            $shipment = Shipment::where('order_id', $order->id)->first();
            $shipment->delete();

            $order->is_created_shipment = false;
            $order->save();

            DB::commit();
            return redirect()->back()->with('order', 'The shipment has been deleted successfully!');
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->with('failed_order', 'Failed delete the shipment!');
        }
       
    }
}
