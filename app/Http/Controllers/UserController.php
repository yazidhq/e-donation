<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function profile(){
        return view("users.profile");
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
}
