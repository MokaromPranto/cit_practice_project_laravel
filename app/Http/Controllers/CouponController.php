<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('checkrole');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('coupon.create',[
            'coupons' => Coupon::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validation //
        $request->validate([
            'coupon_name' => 'required|unique:coupons',
            'coupon_amount' => 'required',
            'coupon_limit' => 'required',
            'coupon_type' => 'required',
            'coupon_validity' => 'required']
            ,[
                'coupon_name.unique' => 'Coupon Name Must be Unique!',
                'coupon_type.required' => 'Please Choose a Coupon Type!',
                'coupon_validity.required' => 'Please Choose a Valid Coupon Validity Date!',
        ]);
        // End Validation //





        if($request->coupon_type == 1){
            if($request->coupon_amount > 99){
                return back()->with('error', 'Coupon Percentage can not be more than 99');
            }
        }
        Coupon::insert($request->except('_token') + [
            'created_at' => Carbon::now()
        ]);
        return back()->with('success', 'Coupon Added Successfuly!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function show(Coupon $coupon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function edit(Coupon $coupon)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Coupon $coupon)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coupon $coupon)
    {
        //
    }
}
