<?php

namespace App\Http\Controllers;

use App\Models\Order_detail;
use App\Models\Country;
use App\Models\Cart;
use App\Models\Inventory;
use App\Models\Order_summary;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    public function checkout(){
        if(session('s_total_ammount')){
            return view('frontend.checkout');
        }else{
            return redirect('cart');
        }
    }
    public function checkoutpost(Request $request){
        // Step 1 : Insert into Order_summaries
        $order_summary_id = Order_summary::insertGetId([
            'user_id' => auth()->id(),
            'customer_name' => $request->customer_name,
            'customer_email' => $request->customer_email,
            'customer_phone_number' => $request->customer_phone_number,
            'customer_country' => Country::find(session('s_country_id'))->name,
            'customer_city' => session('s_city_name'),
            'customer_address' => $request->customer_address,
            'customer_notes' => $request->customer_notes,
            'payment_method' => $request->payment_method,
            'payment_status' => 'pending',
            'total_ammount' => session('s_total_ammount'),
            'discount_amount' => session('s_discount_amount'),
            'shipping_charge' => session('s_shipping_charge'),
            'grand_total' => session('s_grand_total'),
            'coupon_name' => session('s_coupon_name'),
            'created_at' => Carbon::now()
        ]);

        // Step 2: Insert into Order Details
        foreach (Cart::where('user_id', auth()->id())->get() as $cart) {
            Order_detail::insert([
                'order_summary_id'=> $order_summary_id,
                'product_id' => $cart->product_id,
                'color_id' => $cart->color_id,
                'size_id' => $cart->size_id,
                'amount' => $cart->user_stock_ammount,
                'created_at' => Carbon::now()
            ]);

            // Step 3: Decrement From Inventory
            Inventory::where([
                'product_id' => $cart->product_id,
                'color_id' => $cart->color_id,
                'size_id' => $cart->size_id,
            ])->decrement('quantity', $cart->user_stock_ammount);

            // Step 4: Delete From Cart
            $cart->delete();
        }

        if( $request->payment_method == 'online'){
            Session::put('s_order_summary_id', $order_summary_id);
            return redirect('pay');
        }else{
            Session::forget('s_total_ammount');
            Session::forget('s_discount_amount');
            Session::forget('s_shipping_charge');
            Session::forget('s_grand_total');
            Session::forget('s_country_id');
            Session::forget('s_city_name');
            Session::forget('s_coupon_name');

            return redirect('cart')->with('success', 'Order Placed Successfully!');
        }
    }
}
