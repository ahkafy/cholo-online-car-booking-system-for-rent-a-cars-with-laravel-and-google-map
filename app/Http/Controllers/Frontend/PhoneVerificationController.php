<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use Cookie;
use Illuminate\Validation\ValidationException;

class PhoneVerificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct()
     {
         $this->middleware(['auth']);
     }


    public function index(Request $request)
    {
        if(auth()->user()->phone_verification_code == NULL){
            $code=rand(1000,999999);
            DB::table('users')->where('id', auth()->user()->id)->update(['phone_verification_code' => $code]);
          }else{
            $code = auth()->user()->phone_verification_code;
          }

        /*  $to = auth()->user()->phone;
          $token = "c216d1ddab2209e46a5c426712a136df";
          $message = "Cholo account verification code is $code";

          $url = "http://api.greenweb.com.bd/api.php";


          $data= array(
          'to'=>"$to",
          'message'=>"$message",
          'token'=>"$token"
          ); // Add parameters in key value
          $ch = curl_init(); // Initialize cURL
          curl_setopt($ch, CURLOPT_URL,$url);
          curl_setopt($ch, CURLOPT_ENCODING, '');
          curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
          $smsresult = curl_exec($ch);
          //Result
          echo $smsresult;
          //Error Display
          echo curl_error($ch); */

          if($request->cookie('SMS')!==auth()->user()->phone){
          $url = "http://66.45.237.70/api.php";
          $number=auth()->user()->phone;
          $text="Cholo account verification code is $code";
          $data= array(
          'username'=>"ahkafy",
          'password'=>"4C9NKSH6",
          'number'=>"$number",
          'message'=>"$text"
          );

          $ch = curl_init(); // Initialize cURL
          curl_setopt($ch, CURLOPT_URL,$url);
          curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
          $smsresult = curl_exec($ch);
          $p = explode("|",$smsresult);
          $sendstatus = $p[0];
          Cookie::queue('SMS', auth()->user()->phone, 15);
        }



        return view('frontend.verify');
    }

    public function verify(Request $request)
   {
       if ($request->user()->phone_verification_code !== $request->code) {
           throw ValidationException::withMessages([
               'code' => ['The code your provided is wrong.'],
           ]);
       }

       if ($request->user()->hasVerifiedPhone()) {
           return redirect()->route('home');
       }

       $request->user()->markPhoneAsVerified();


       return redirect()->route('home')->with('status', 'Your phone was successfully verified!');


   }


}
