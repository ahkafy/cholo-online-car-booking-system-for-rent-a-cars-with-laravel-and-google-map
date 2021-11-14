<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Frontend\Booking;
use Mail;
use DB;
use Auth;

class BookingsController extends Controller
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


    public function index()
    {

        $pending=DB::table('bookings')->where('user_id', auth()->user()->id)->where('status', 'pending')->count();
        return view('frontend.booking', compact('pending'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $request->validate([
             'from'=>'required',
             'to'=>'required',
             'date'=>'required',
             'time'=>'required',
             'distance'=>'required',
             'fair'=>'required',
             'payment_method'=>'required'
         ]);


         $booking = new Booking([
            'user_id' => auth()->user()->id,
            'ride_type' => $request->get('ride_type'),
            'from' => $request->get('from'),
            'to' => $request->get('to'),
            'pickup_date' => $request->get('date'),
            'pickup_time' => $request->get('time'),
            'distance' => $request->get('distance'),
            'fair_amount' => $request->get('fair'),
            'payment_method' => $request->get('payment_method'),
            'waiting' => $request->get('waiting'),
            'remarks' => $request->get('remarks'),
            'status' => 'pending',
            'ride_id' => '-',
        ]);
        $booking->save();

        $html = '<html><p>Phone Number: ' .auth()->user()->phone. '</p><br><p>From: ' .$request->get('from'). '</p><br><p>To: ' .$request->get('to'). '</p><br> <p>Date: ' .$request->get('date'). '</p><br> <p>Time: ' .$request->get('time'). '</p><br> <p>Ride Type: ' .$request->get('ride_type'). '</p><br> <p>Distance: ' .$request->get('distance'). '</p><br>  <p>Fair: ' .$request->get('fair'). '</p><br> <p>Go get it now !</p></html>';

        Mail::send(array(), array(), function ($message) use ($html) {
          $message->to('info@cholo.com.bd')
            ->subject('New booking in Cholo.com.bd')
            ->from('info@cholo.com.bd')
            ->setBody($html, 'text/html');
        });



        return redirect('/myaccount')->with('success', 'We have received your booking!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('frontend/mybooking');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
