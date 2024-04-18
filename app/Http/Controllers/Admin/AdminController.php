<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
 

class AdminController extends Controller
{
    
    // admin dashboard
    public function admin_dashboard(){

        $showCategoryButton = false;
        return view('admin.admin_dashboard', compact('showCategoryButton'));

    }

    // admin login 
    public function admin_login(){

        return view('admin.admin_login');

    }

    // admin profile 
    public function admin_profile(){

        $admin_id = Auth::user()->id;
        $admin_info = DB::table('users')->where('id',$admin_id)->first();

        return view('admin.admin_profile', compact('admin_info'));

    }
    
    // admin profile update 
    public function admin_profile_update(Request $request){

        $admin_id = Auth::user()->id;
        $admin_info = DB::table('users')->where('id',$admin_id)->first();

        $new_image = $request->file('photo');

        if($new_image){

            $custom_image_name = uniqid() . '.' .$new_image->getClientOriginalExtension();
            @unlink(public_path('uploads/admin/images/' . $admin_info->photo));
            $new_image->move(public_path('uploads/admin/images/'), $custom_image_name);

        }

        else{

            $custom_image_name = $admin_info->photo;

        }

        DB::table('users')->where('id', $admin_id)->update([

            "name" => strtoupper($request->name),
            "email" => $request->email,
            "photo" => $custom_image_name,
            "phone" => $request->phone,
            "address" => $request->address,
            "updated_at" => now()

        ]);

        return redirect()->route('admin.profile')->with('message','Admin Profile Updated Successfully!');  

    }

    // admin change password 
    public function admin_change_password(){

        return view('admin.admin_change_password');

    }

    // admin update password 
    public function admin_update_password(Request $request){
        
        if(!Hash::check($request->old_password, Auth::user()->password)){
            return redirect()->route('admin.change.password')->with('error1', "Old password doesn't match!");
        }

        elseif($request->new_password == '' || $request->new_password == null){
            return redirect()->route('admin.change.password')->with('error2', "New password can't be null or blank!");
        }

        elseif($request->new_password != $request->confirm_password){
            return redirect()->route('admin.change.password')->with('error3', "New password and confirm password don't match!");
        }

        else{
            DB::table('users')->where('id', Auth::user()->id)->update([
                "password" => Hash::make($request->new_password)
            ]);
            return redirect()->route('admin.change.password')->with('success', "Admin password updated successfully.");
        }
    }

    // admin logout 
    public function admin_logout(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }

    // manage active vendor 
    public function vendor_active(){

        $active_vendor = DB::table('users')->where('role', '=', 'vendor')->where('status', '=', 'active')->get();
        return view('admin.vendor.active_vendor_list', compact('active_vendor'));

    }

    // manage inactive vendor 
    public function vendor_inactive(){

        $inactive_vendor = DB::table('users')->where('role', 'vendor')->where('status', 'inactive')->get();
        return view('admin.vendor.inactive_vendor_list', compact('inactive_vendor'));

    }

    // delete the active vendor 
    public function active_vendor_delete(string $id){

        DB::table('users')->where('id', $id)->delete();
        return redirect()->route('vendor.active')->with('message', 'Vendor Deleted Successfully!');

    }

     // delete the inactive vendor 
     public function inactive_vendor_delete(string $id){

        DB::table('users')->where('id', $id)->delete();
        return redirect()->route('vendor.inactive')->with('message', 'Vendor Deleted Successfully!');
        
    }

    // vendor active to inactive
    public function vendor_active_to_inactive(string $id){
        
        $vendor_status = DB::table('users')->where('id', $id)->first();
        
        if($vendor_status->status == 'active'){

            DB::table('users')->where('id', $id)->update([
                'status' => 'inactive'
            ]);

            return redirect()->back()->with('message', "Vendor has become inactive");

        }

    }

     // vendor inactive to active
     public function vendor_inactive_to_active(string $id){
        
        $inactive_vendor = DB::table('users')->where('id', '=', $id)->first();

        if($inactive_vendor->status == 'inactive'){

            DB::table('users')->where('id', '=', $id)->update([
                "status" => 'active'
            ]);
        
            return redirect()->back()->with('message', "Vendor has become active");

        }
    }

    // active vendor info update 
    public function active_vendor_info_update(Request $request, string $id){

        DB::table('users')->where('id', $id)->update([

            "name" => $request->name,
            "phone" => $request->phone,
            "address" => $request->address,
            "status" => $request->status,
            "updated_at" => now()

        ]);

        return redirect()->route('vendor.active')->with('message', "Vendor Info Updated Successfully!");
        

    }

     // inactive vendor info update 
     public function inactive_vendor_info_update(Request $request, string $id){

        DB::table('users')->where('id', $id)->update([

            "name" => $request->name,
            "phone" => $request->phone,
            "address" => $request->address,
            "status" => $request->status,
            "updated_at" => now()

        ]);

        return redirect()->route('vendor.inactive')->with('message', "Vendor Info Updated Successfully!");
        

     }

}
