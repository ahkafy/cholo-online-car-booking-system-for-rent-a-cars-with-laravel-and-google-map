@extends('frontend.layouts.app')
       @section('content')
<div class="container">
  <div class="container mt-4 mb-4">
      <h2>We have received your booking request. Please expect a call from us.<br>
        You can call <strong> <a href="tel:+8801716903902">01716 903 902</a> </strong> for faster response. </h2>

  </div>
  <h3>History:</h3>
       <table id="user_table" class="table table-bordered table-striped table-hover table-responsive">
        <thead class="">
         <tr>
           <th>From</th>
           <th>To</th>
           <th>Pickup Date</th>
           <th>Pickup Time</th>
           <th>Payment Method</th>
           <th>Distance</th>
           <th>Fair</th>
           <th>Remarks</th>
           <th>Status</th>
           <th>Created at</th>
           <th>Updated at</th>

         </tr>
        </thead>
        <tbody>
          @foreach ($mybookings as $data)
          <tr>
            <td>{{$data->from}}</td>
            <td>{{$data->to}}</td>
            <td>{{$data->pickup_date}}</td>
            <td>{{$data->pickup_time}}</td>
            <td>{{$data->payment_method}}</td>
            <td>{{$data->distance}}</td>
            <td>{{$data->fair_amount}}</td>
            <td>{{$data->remarks}}</td>
            <td>{{$data->status}}</td>
            <td>{{$data->created_at}}</td>
            <td>{{$data->updated_at}}</td>

          </tr>

          @endforeach
        </tbody>


       </table>



     </div>

       @endsection
