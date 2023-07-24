<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ActiveUserController extends Controller
{
    public function AllUser(){
        $users = User::where('role_id','2')->latest()->get();
        return view('admin.user.user_all_data',compact('users'));

    } // End Method

    public function AllVendor(){
        $vendors = User::where('role_id','3')->latest()->get();
        return view('admin.user.vendor_all_data',compact('vendors'));

    } // End Method
}
