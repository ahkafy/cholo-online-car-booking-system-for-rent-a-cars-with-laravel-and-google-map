@extends('frontend.layouts.app')
       @section('content')
<div class="container">

  <h1>Overview: Please confirm your booking. </h1>
  <hr>
  <form class="mt-4" method="POST" action="{{ url('booking/confirm') }}">
    @CSRF
         <div class="form-group">
           <label for="from">From</label>
           <input type="text" class="form-control" name="from" id="from" placeholder="" value="{{request()->from}}" readonly>
         </div>

         <div class="form-group">
           <label for="from">To</label>
           <input type="text" class="form-control" name="to" id="to" placeholder="" value="{{request()->to}}" readonly>
         </div>

        <div class="row">
            <div class="col-6">
              <div class="form-group">
                <label for="from">Date</label>
                <input type="text" class="form-control" name="date" id="date" placeholder="" value="{{request()->date}}" readonly>
              </div>
            </div>

            <div class="col-6">
              <div class="form-group">
                <label for="from">Time (24hrs)</label>
                <input type="text" class="form-control" name="time" id="time" placeholder="" value="{{request()->time}}" readonly>
              </div>
            </div>
        </div>

        <div class="row">
            <div class="col-6">
              <div class="form-group">
                <label for="from">Distance (KM)</label>
                <input type="text" class="form-control" name="distance" id="distance" placeholder="" value="{{request()->distance}}" readonly>
              </div>
            </div>

            <div class="col-6">
              <div class="form-group">
                <label for="from">Fair (Excluding Road Toll) Taka</label>
                <input type="text" class="form-control" name="fair" id="fair" placeholder="" value="{{request()->fair}}" readonly>
              </div>
            </div>
        </div>

        <div class="row">
            <div class="col-6">
              <div class="form-group">
                <label for="from">Ride Type</label>
                <input type="text" class="form-control" name="ride_type" id="ride_type" placeholder="" value="{{request()->ride_type}}" readonly>
              </div>
            </div>

            <div class="col-6">
              <div class="form-group">
                <label for="from">Waiting Time (150 per Hour)</label>
                <input type="number" class="form-control" name="waiting" id="waiting" placeholder="Do you need driver to wait any where?" value="0">
              </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-6">
              <div class="form-group">
                <label for="from">Payment Method</label>
                <select type="text" class="form-control" name="payment_method" id="payment_method" placeholder="" >
                  <option value="cash">Cash</option>
                  <option value="cash">bKash</option>
                </select>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label for="from">Additional Note</label>
                <input type="text" class="form-control" name="remarks" id="remarks" placeholder="Additional notes">
              </div>
            </div>
        </div>

        @if ($pending > 0 )
          <h3>You Already have a pending request. Please go to <a href="{{url('myaccount')}}">My Account</a> to find it.<br> You can call <a href="tel:01716903902">01716903902</a> for more information. </h3>
        @else
         <button type="submit" class="btn btn-primary">Confirm Booking</button>
        @endif
   </form>
</div>

       @endsection
