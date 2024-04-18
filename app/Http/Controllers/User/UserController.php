<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    // user dashboard 
    public function user_dashboard(){

        $id = Auth::user()->id;
        $user_info = DB::table('users')->where('id', $id)->first();
       
        return view('dashboard', compact('user_info'));

    }

    // user accout update
    public function user_account_update(Request $request){

        $user_id = Auth::user()->id;
        $user_info = DB::table('users')->where('id', $user_id)->first();
        
        $new_image = $request->file('photo');
        
        if($new_image){
            
            $role = Auth::user()->role;

            $custom_image_name = uniqid() . '.' . $new_image->getClientOriginalExtension();
            @unlink(public_path('uploads/' . $role . '/images/' . $user_info->photo ));
            $new_image->move(public_path('uploads/' . $role . '/images/'), $custom_image_name);

        }

        else{

            $custom_image_name = $user_info->photo;

        }

        DB::table('users')->where('id', $user_id)->update([

            "name" => $request->name,
            "email" => $request->email,
            "photo" => $custom_image_name,
            "phone" => $request->phone,
            "address" => $request->address,
            "updated_at" => now()

        ]);

        return redirect()->route('dashboard')->with('success', "User Account Updated Successfully!");

    }

    // user password change 
    public function user_password_change(){

        return view('user.user_change_password');
        
    }

    // user password update 
    public function user_password_update(Request $request){

        if(!Hash::check($request->old_password, Auth::user()->password)){
            return redirect()->route('user.password.change')->with('error1', "Old password doesn't match!");
        }

        elseif($request->new_password == "" || $request->new_password == null){
            return redirect()->route('user.password.change')->with('error2', "New password can't be null or blank!");
        }

        elseif($request->new_password != $request->confirm_password){
            return redirect()->route('user.password.change')->with('error3', "New password and confirm password don't match!");
        }
        
        else{
            DB::table('users')->where('id', Auth::user()->id)->update([
                "password" => Hash::make($request->new_password)
            ]);
            return redirect()->route('user.password.change')->with('success', "User password updated successfully.");
        }
    }

    // user logout 
    public function user_logout(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
