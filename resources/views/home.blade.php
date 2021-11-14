@extends('frontend.layouts.app')

@section('content')
<div class="container" style="padding-top:48px">

  <div class="row">
    <div class="col-md-4">
      <form id="distance_form">



      <div class="form-group">
        <label for="origin">Pickup Address</label>
        <input type="text" class="form-control" id="origin" name="origin" aria-describedby="origin" placeholder="Pickup Location?" required>
      </div>

      <div class="form-group">
        <label for="destination">Dropoff Address</label>
        <input type="text" class="form-control" id="destination" name="destination" aria-describedby="destination" placeholder="Dropoff location?" required>
      </div>

      <div class="form-group">
        <label for="ride_type">Ride type</label>
        <select type="text" class="form-control" id="ride_type" name="ride_type" aria-describedby="ride_type" required>
          <option>Please select</option>

          <option value="car">Car</option>
          <option value="microbus">Microbus</option>
          <option value="bike">Bike</option>
          <option value="cng">CNG</option>
        </select>
      </div>

      <div class="row">
        <div class="col-md-6 col-6">

          <div class="form-group">
            <label for="time">Pickup date</label>
            <input type="date" class="form-control" id="date" name="date" aria-describedby="date" required>
          </div>

        </div>

        <div class="col-md-6 col-6">

          <div class="form-group">
            <label for="time">Pickup time</label>
            <input type="time" class="form-control" id="time" name="time" aria-describedby="time" required>
          </div>

        </div>
      </div>




    <br>
    <input class="btn btn-primary form-control" type="submit" value="Calculate Fair" />

    </form>
    <br>

    </div>

    <div class="col-md-8 cover" style="padding-top:64px;">
      <img src="cover2.png" alt="cholo" width="100%">
    </div>
  </div>
  <div id="result"> </div>
</div>


<script>
   var input = document.getElementById('origin');
   var autocomplete = new google.maps.places.Autocomplete(input);
 </script>
 <script>
   var input = document.getElementById('destination');
   var autocomplete = new google.maps.places.Autocomplete(input);
 </script>

<script type="text/javascript">
   $(function() {

       function calculateDistance() {
           var origin = $('#origin').val();
           var destination = $('#destination').val();

           var service = new google.maps.DistanceMatrixService();
           service.getDistanceMatrix(
               {
                   origins: [origin],
                   destinations: [destination],
                   travelMode: 'DRIVING',
                   unitSystem: google.maps.UnitSystem.IMPERIAL, // miles and feet.
                   // unitSystem: google.maps.UnitSystem.metric, // kilometers and meters.
                   avoidHighways: false,
                   avoidTolls: false
               }, callback);

       }
       // get distance results
       function callback(response, status) {
           if (status != google.maps.DistanceMatrixStatus.OK) {
               $('#result').html(err);
           } else {
               var origin = response.originAddresses[0];
               var destination = response.destinationAddresses[0];
               if (response.rows[0].elements[0].status === "ZERO_RESULTS") {
                   $('#result').html("Better get on a plane. There are no roads between "  + origin + " and " + destination);
               } else {
                   var distance = response.rows[0].elements[0].distance;
                   var duration = response.rows[0].elements[0].duration;
                   console.log(response.rows[0].elements[0].distance);
                   var distance_in_kilo = distance.value / 1000; // the kilom
                   var distance_in_mile = distance.value / 1609.34; // the mile
                   var duration_text = duration.text;
                   var duration_value = duration.value;
                   $('#in_mile').text(distance_in_mile.toFixed(2));
                   $('#in_kilo').text(distance_in_kilo.toFixed(2));
                   $('#duration_text').text(duration_text);
                   $('#duration_value').text(duration_value);
                   $('#from').text(origin);
                   $('#to').text(destination);
        //alert(distance_in_kilo + " KM");

        var ride_type = $('#ride_type').val();
        var date = $('#date').val();
        var time = $('#time').val();


        if(ride_type=='car'){
          var cost = distance_in_kilo * 25 + 700;
        }else if(ride_type=='microbus'){
          var cost = distance_in_kilo * 30 + 1000;
        }else if(ride_type=='bike'){
            var cost = distance_in_kilo * 9 + 80;
        }else if(ride_type=='cng'){
            var cost = distance_in_kilo * 13 + 120;
        }else{
          alert('Please select Ride type');
        }

        $('#result').html("<div class='well'><h5>Distance between <b>"  + origin + "</b> and <b>" + destination + "</b> is <b>" + distance_in_kilo + "</b> km <br><br>Cost will be:<b>" + cost.toFixed(2) + "/-</b> taka (Excluding all road toll)</h5><br><a href='book?from="  + origin + "&to="  + destination + "&distance="  + distance_in_kilo + "&fair=" + cost.toFixed(2) + "&date="  + date + "&time="  + time + "&ride_type="  + ride_type + "' class='btn btn-lg btn-primary text-white'>Continue Booking</a></div>");
               }
           }
       }
       // print results on submit the form
       $('#distance_form').submit(function(e){
           e.preventDefault();
           calculateDistance();
       });

   });
  </script>


@endsection
