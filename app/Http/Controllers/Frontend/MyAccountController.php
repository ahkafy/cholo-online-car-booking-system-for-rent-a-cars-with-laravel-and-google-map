<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Frontend\Myaccount;
use App\Models\Frontend\Booking;
use Illuminate\Http\Request;
use DataTables;
use Validator;
use Auth;

class MyAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct()
     {
         $this->middleware(['auth', 'is_verified']);
     }


     public function index(Request $request)
     {

       $mybookings = Booking::where('user_id', auth()->user()->id)->orderBy('updated_at', 'desc')->get();

       return view('frontend.myaccount', compact('mybookings'));
     }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Frontend\Myaccount  $myaccount
     * @return \Illuminate\Http\Response
     */
    public function show(Myaccount $myaccount)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Frontend\Myaccount  $myaccount
     * @return \Illuminate\Http\Response
     */
    public function edit(Myaccount $myaccount)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Frontend\Myaccount  $myaccount
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Myaccount $myaccount)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Frontend\Myaccount  $myaccount
     * @return \Illuminate\Http\Response
     */
    public function destroy(Myaccount $myaccount)
    {
        //
    }
}
