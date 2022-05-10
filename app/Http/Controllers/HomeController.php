<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Color;
use App\Models\Country;
use App\Models\Order_summary;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Shipping;
use App\Models\Size;
use App\Models\Subcategory;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Image;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('checkrole');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        if(session('mhp')){
            return redirect(session('mhp'));
        }

        $total_active_categories = Category::count();
        $total_active_subcategories = Subcategory::count();
        $total_users = User::count();
        $total_admins = User::where('role', 'admin')->count();
        $total_customers = User::where('role', 'customer')->count();
        $total_products = Product::count();
        $total_colors = Color::count();
        $total_sizes = Size::count();
        $paid_order =  Order_summary::where('payment_status', 'paid')->get('payment_status')->count();
        $pending_order =  Order_summary::where('payment_status', 'pending')->get('payment_status')->count();
        $total_paid_sale =  Order_summary::where('payment_status', 'paid')->get('grand_total')->sum('grand_total');
        $total_pending_sale =  Order_summary::where('payment_status', 'pending')->get('grand_total')->sum('grand_total');
        $total_pickup_order =  Order_summary::where('delivery_status', 'pickup')->count();
        $total_processing_order =  Order_summary::where('delivery_status', 'processing')->count();
        $total_delivered_order =  Order_summary::where('delivery_status', 'delivered')->count();

        return view('home', compact('total_active_categories', 'total_active_subcategories', 'total_users', 'total_products','total_colors', 'total_sizes', 'total_admins', 'total_customers', 'pending_order', 'paid_order', 'total_pending_sale','total_paid_sale', 'total_pickup_order', 'total_processing_order','total_delivered_order'));
    }
    public function profile()
    {
        return view('profile.index');
    }
    public function changename(Request $request)
    {
        User::find(auth()->id())->update([
            'name' => $request->name,
            'phone_number' => $request->phone_number
        ]);
        if($request->hasFile('profile_photo')){
            // Image Upload Str //
            $new_name = auth()->id().".".$request->file('profile_photo')->getClientOriginalExtension();
            Image::make($request->file('profile_photo'))->resize(196,196)->save(base_path('public/uploads/profile/'.$new_name));
            // Image Upload End //
            User::find(auth()->id())->update([
                'profile_photo' => $new_name
            ]);

        }
        return back()->with('success', 'Changed Successfully!');
    }
    public function changepassword(Request $request){
        if(Hash::check($request->current_password, auth()->user()->password)){
            if($request->password != $request->password_confirmation){
                return back()->with('error', 'New Password Does not match with Confirm Password!');
            }
            else{
                User::find(auth()->id())->update([
                    'password' => bcrypt($request->password)
                ]);
                return back()->with('success', 'Password Changed Successfully!');
            }
        }
        else{
            return back()->with('error', 'Current Password Does not match with our records!');
        }

    }
    public function shipping()
    {
        $countries = Country::all();
        $shippings = Shipping::all();
        return view('shipping.shipping', compact('countries','shippings'));
    }
    public function addshipping(Request $request)
    {
        // Validation //
        $request->validate([
            'country_id' => 'required',
            'city_name' => 'required',
            'delivery_days' => 'required',
            'shipping_charge' => 'required'],[
                'country_id.required' => 'Please choose a Country Name!',
                'city_name.required' => 'Please give a Valid City Name!',
        ]);
        // End Validation //

        Shipping::insert($request->except('_token') + [
            'created_at' => Carbon::now(),
        ]);
        return back()->with('success', 'Shipping Charge Added Sucessfully!');
    }
    public function coupon(Request $request)
    {
        return view('coupon.create');
    }
    public function order()
    {
        $order_details = Order_summary::all();
        return view('order', compact('order_details'));
    }

    public function orderchangestatus(Order_summary $order_id, $delivery_status)
    {
        if ($delivery_status == 'delivered') {
            $order_id->payment_status = 'paid';
        }else{
            $order_id->payment_status = 'pending';
        }

        $order_id->delivery_status = $delivery_status;
        $order_id->save();

        return back()->with('success', 'Delivery Status has been Changed Successfully!');
    }
    public function add_settings()
    {
        return view('settings.add');
    }
    public function post_settings(Request $request)
    {
        Setting::insert($request->except('_token') + [
            'created_at' => Carbon::now(),
        ]);

        return back()->with('success', 'Setting Added Succesfully!');
    }
    public function change_settings()
    {
        $settings = Setting::all();
        return view('settings.change', compact('settings'));
    }
    public function settings_update(Request $request)
    {
        foreach ($request->except('_token') as $setting_name => $setting_value) {
            Setting::where('setting_name', $setting_name)->update([
                'setting_value' => $setting_value,
            ]);
        }
        return back()->with('success', 'Setting Updated Succesfully!');

    }

}
