@extends('backend.templates.table', ['title' => 'complete Bookings'])
@section('content')

<div class="card-body">

  <button type="button" class="btn btn-md btn-primary float-left" data-toggle="modal" data-target="#formModal" style="display: none; margin-right:6px;border-radius:2px;"><span data-toggle="tooltip" data-placement="top" title="Add new record!"><i class="fas fa-plus"></i></span></button>
  <table id="user_table" class="table table-bordered table-striped table-hover table-responsive">
   <thead class="">
    <tr>
      <th>Customer</th>
      <th>From</th>
      <th>To</th>
      <th>Pickup Date</th>
      <th>Pickup Time</th>
      <th>Ride Type</th>
      <th>Payment Method</th>
      <th>Distance</th>
      <th>Fair</th>
      <th>Remarks</th>
      <th>Status</th>
      <th>Ride</th>
      <th>Created at</th>
      <th>Updated at</th>
    </tr>
   </thead>
  </table>
</div>

<div id="formModal" class="modal fade" role="dialog">
 <div class="modal-dialog">
  <div class="modal-content">
   <div class="modal-header">
     <h4 class="modal-title">Confirm a trip</h4>
          <button type="button" id="create_record" class="close" data-dismiss="modal">&times;</button>

        </div>
        <div class="modal-body">
         <span id="form_result"></span>
         <form method="post" id="form" class="form-horizontal">
          @csrf

           <div class="input-group mb-3">
              <div class="input-group-prepend"><span class="input-group-text">From</span></div>
              <input type="text" name="from" id="from" class="form-control text-box" readonly />
           </div>


           <div class="input-group mb-3">
              <div class="input-group-prepend"><span class="input-group-text">To</span></div>
              <input type="text" name="to" id="to" class="form-control text-box" readonly />
           </div>

           <div class="input-group mb-3">
              <div class="input-group-prepend"><span class="input-group-text">Pickup Date</span></div>
              <input type="date" aria-describedby="date" name="pickup_date" id="pickup_date" class="form-control text-box" readonly />
           </div>

           <div class="input-group mb-3">
              <div class="input-group-prepend"><span class="input-group-text">Pickup Time</span></div>
              <input type="text" aria-describedby="time" name="pickup_time" id="pickup_time" class="form-control text-box" readonly />
           </div>

           <div class="input-group mb-3">
              <div class="input-group-prepend"><span class="input-group-text">Ride Type</span></div>
              <input type="text"  name="ride_type" id="ride_type" class="form-control text-box" readonly />
           </div>


           <div class="input-group mb-3">
              <div class="input-group-prepend"><span class="input-group-text">Payment Method</span></div>
              <input type="text"  name="payment_method" id="payment_method" class="form-control text-box" readonly />
           </div>

		   <div class="input-group mb-3">
              <div class="input-group-prepend"><span class="input-group-text">Distance</span></div>
              <input type="text"  name="distance" id="distance" class="form-control text-box" readonly />
           </div>

		   <div class="input-group mb-3">
              <div class="input-group-prepend"><span class="input-group-text">Fair</span></div>
              <input type="text"  name="fair_amount" id="fair_amount" class="form-control text-box" readonly />
           </div>

		   <div class="input-group mb-3">
              <div class="input-group-prepend"><span class="input-group-text">Remarks</span></div>
              <input type="text"  name="remarks" id="remarks" class="form-control text-box" readonly />
           </div>

		   <div class="input-group mb-3">
              <div class="input-group-prepend"><span class="input-group-text">Status</span></div>
              <input type="text" name="status" id="status" class="form-control text-box" readonly />
           </div>

			<div class="input-group mb-3">
              <div class="input-group-prepend"><span class="input-group-text">Ride ID</span></div>
              <input type="text"  name="ride_id" id="ride_id" class="form-control text-box" readonly />
           </div>



                <br />
                <div class="form-group" align="center">
                 <input type="hidden" name="action" id="action" value="Add" />
                 <input type="hidden" name="hidden_id" id="hidden_id" />
                 <input type="submit" name="action_button" id="action_button" class="btn btn-primary float-right" value="Add" />
                </div>
         </form>
        </div>
     </div>
    </div>
</div>

<div id="confirmModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" align="center">
              <h2 class="modal-title" style="color:red;"><i class="far fa-question-circle"></i> Confirmation</h2>
                <button type="button" class="close" data-dismiss="modal">&times;</button>

            </div>
            <div class="modal-body">
                <h4 align="center" style="margin:0;color:#343a40;font-weight:600;">You are about to delete a data. Do you wish to proceed?</h4>
            </div>
            <div class="modal-footer">
             <button type="button" name="ok_button" id="ok_button" class="btn btn-danger">OK</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('ajax')

<script>
$(document).ready(function(){

 $('#user_table').DataTable({
  processing: true,
  serverSide: true,
  responsive: true,
  ajax: {
   url: "{{ url('admin/trips/all') }}",
  },
  columns: [
    {
     data: 'user_id',
     name: 'user_id'
    },
    {
     data: 'from',
     name: 'from'
    },
   {
    data: 'to',
    name: 'to'
   },
   {
    data: 'pickup_date',
    name: 'pickup_date'
   },
   {
    data: 'pickup_time',
    name: 'pickup_time'
   },
   {
    data: 'ride_type',
    name: 'ride_type'
   },
   {
    data: 'payment_method',
    name: 'payment_method'
   },
   {
    data: 'distance',
    name: 'distance'
   },
   {
    data: 'fair_amount',
    name: 'fair_amount'
   },
   {
    data: 'remarks',
    name: 'remarks'
   },
   {
    data: 'status',
    name: 'status'
   },
   {
    data: 'ride_id',
    name: 'ride_id'
   },
   {
    data: 'created_at',
    name: 'created_at'
   },
   {
    data: 'updated_at',
    name: 'updated_at'
   },

 ],
 dom: 'lBfrtip',
 buttons: [
        {
          extend: 'copy',
          exportOptions: { columns: ':not(:last-child)', },
          text: '<i class="far fa-copy"></i> Copy',
        },

        {
          extend: 'csv',
          exportOptions: { columns: ':not(:last-child)', },
          text: '<i class="fas fa-file-csv" style="color:green"v></i> CSV',
        },

        {
          extend: 'excel',
          exportOptions: { columns: ':not(:last-child)', },
          text: '<i class="fas fa-file-excel" style="color:green"></i> Excel',
        },

        {
          extend: 'print',
          exportOptions: { columns: ':not(:last-child)',  },
          text: '<i class="fas fa-print"></i> Print',
        },

        {
          extend: 'pdfHtml5',
          customize: function (doc) { doc.content[1].table.widths =Array(doc.content[1].table.body[0].length + 1).join('*').split(''); },
          exportOptions: { columns: ':not(:last-child)', },
          text: '<i class="fas fa-file-pdf" style="color:red"></i> PDF',
        },
      ]
 });

 $('#create_record').click(function(){
  $('.modal-title').text('Add new Ride');
  $('#action_button').val('Add');
  $('#action').val('Add');
  $('.text-box').val('');
  $('#form_result').html('');
  $('#formModal').modal('show');
 });

 $('#form').on('submit', function(event){
  event.preventDefault();
  var action_url = '';

  if($('#action').val() == 'Add')
  {
   action_url = "{{ url('admin/trips/complete/store') }}";
  }

  if($('#action').val() == 'Edit')
  {
   action_url = "{{ url('admin/trips/complete/update') }}";
  }

  $.ajax({
   url: action_url,
   method:"POST",
   data:$(this).serialize(),
   dataType:"json",
   success:function(data)
   {
    var html = '';
    if(data.errors)
    {
     html = '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
     for(var count = 0; count < data.errors.length; count++)
     {
      html += '<p>' + data.errors[count] + '</p>';
     }
     html += '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
     $('#form_result').html(html);
    }
    if(data.success)
    {
     html = '<div class="alert alert-success alert-dismissible fade show" role="alert">' + data.success + '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
     $('#form')[0].reset();
     $('#formModal').modal('hide');
     $('#action_button').val('Add');
     $('#action').val('Add');
     $('.text-box').val('');
     $('#form_result').html('');
     $('#user_table').DataTable().ajax.reload();
     $.alert({
          title: '<i class="far fa-check-circle"></i> Success!',
          content: 'Data updated successfully!',
          theme: 'dark'
      });
    }

   }
  });
 });

 $(document).on('click', '.edit', function(){
  var id = $(this).attr('id');
  $('#form_result').html('');
  $.ajax({
   url :"{{url('admin/trips/complete/') }}/"+id+"/edit",
   dataType:"json",
   success:function(data)
   {
     $('#from').val(data.result.from);
     $('#to').val(data.result.to);
     $('#pickup_date').val(data.result.pickup_date);
     $('#pickup_time').val(data.result.pickup_time);
     $('#ride_type').val(data.result.ride_type);
	 $('#payment_method').val(data.result.payment_method);
     $('#distance').val(data.result.distance);
     $('#fair_amount').val(data.result.fair_amount);
	 $('#remarks').val(data.result.remarks);
	 $('#status').val(data.result.status);
     $('#ride_id').val(data.result.ride_id);
    $('#hidden_id').val(id);
    $('.modal-title').text('Edit Record');
    $('#action_button').val('Edit');
    $('#action').val('Edit');
    $('#formModal').modal('show');
   }
  })
 });

 var user_id;

 $(document).on('click', '.delete', function(){
  id = $(this).attr('id');
  $('#confirmModal').modal('show');
 });

 $('#ok_button').click(function(){
  $.ajax({
   url:"{{url('admin/rides/delete/')}}/"+id,
   beforeSend:function(){
    $('#ok_button').text('Deleting...');
   },
   success:function(data)
   {
    setTimeout(function(){
     $('#confirmModal').modal('hide');
     $('#user_table').DataTable().ajax.reload();
     $.alert({
          title: '<i class="far fa-check-circle"></i> Success!',
          content: 'Data deleted successfully!',
          theme: 'dark'
      });
     $('#ok_button').text('Ok');
   });
   }
  })
 });

});
</script>

<script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
});
</script>
@endsection
