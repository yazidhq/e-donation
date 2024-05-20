<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
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
        return view("admin.users", compact("users"));
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
        dd($id);
    }
}
