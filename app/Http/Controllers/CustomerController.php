<?php

namespace App\Http\Controllers;

use App\Models\Order_summary;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function customer(){
        return view('frontend.customer.register');
    }
    public function customerlogin(){
        return view('frontend.customer.login');
    }
    public function customerregister(Request $request)
    {
        // Validation //
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|min:8',
            'password_confirmation' => 'same:password',
            'captcha' => 'required|captcha'],[
                'email.unique' => 'This email is already Registered!',
                'password.min' => 'Password Musst be 8 Character long!',
                'password_confirmation.same' => 'Confirm Password does not match with Password!',
                'captcha.captcha' => 'Invalid Captcha code!',
            ]);
        // End Validation

        User::insert([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'customer',
            'created_at' => Carbon::now(),
        ]);
        return redirect('customer/login')->with([
            'success' => 'Registration Successfull! Please Login!',
            'email'=> $request->email,
        ]);
    }
    public function customerdashboard ()
    {
        $orders = Order_summary::where('user_id', auth()->id())->get();
        return view('frontend.customer.dashboard', compact('orders'));
    }
    public function reloadcaptcha ()
    {
        return response()->json(['captcha'=> captcha_img()]);
    }
}

