@extends('backend.templates.table', ['title' => 'Rides'])
@section('content')

<div class="card-body">

  <button type="button" class="btn btn-md btn-primary float-left" data-toggle="modal" data-target="#formModal" style="margin-right:6px;border-radius:2px;"><span data-toggle="tooltip" data-placement="top" title="Add new record!"><i class="fas fa-plus"></i></span></button>
  <table id="user_table" class="table table-bordered table-striped table-hover">
   <thead class="">
    <tr>
      <th>ID</th>
      <th>Type</th>
      <th>Owner</th>
      <th>Rider</th>
      <th>Registration</th>
      <th>Reg. Expiry</th>
      <th>Reg. File</th>
      <th>Tax Token</th>
      <th>Tax Token Expiry</th>
      <th>Tax Token File</th>
      <th>Insurance</th>
      <th>Insurance Expiry</th>
      <th>Insurance File</th>
      <th>Fitness</th>
      <th>Fitness Expiry</th>
      <th>Fitness File</th>
      <th>Status</th>
      <th>Photo</th>
      <th>Created at</th>
      <th>Updated at</th>
      <th width="110px">#</th>
    </tr>
   </thead>
  </table>
</div>

<div id="formModal" class="modal fade" role="dialog">
 <div class="modal-dialog">
  <div class="modal-content">
   <div class="modal-header">
     <h4 class="modal-title">Add new rider</h4>
          <button type="button" id="create_record" class="close" data-dismiss="modal">&times;</button>

        </div>
        <div class="modal-body">
         <span id="form_result"></span>
         <form method="post" action="{{url('admin/rides/store')}}" id="form" class="form-horizontal" enctype="multipart/form-data">
          @csrf

           <div class="input-group mb-3">
              <div class="input-group-prepend"><span class="input-group-text">Ride Type</span></div>
              <select type="text" name="type" id="type" class="form-control text-box" />
                        <option value="car">Car</option>
                        <option value="microbus">Microbus</option>
                        <option value="bike">Bike</option>
                        <option value="cng">CNG</option>
              </select>
           </div>

           <div class="input-group mb-3">
              <div class="input-group-prepend"><span class="input-group-text">Owner</span></div>
              <input type="text" name="owner" id="owner" class="form-control text-box" />
           </div>

           <div class="input-group mb-3">
              <div class="input-group-prepend"><span class="input-group-text">Rider</span></div>
              <input type="text" name="rider" id="rider" class="form-control text-box" />
           </div>

           <div class="input-group mb-3">
              <div class="input-group-prepend"><span class="input-group-text">Registration</span></div>
              <input type="text" name="registration" id="registration" class="form-control text-box" />
           </div>

           <div class="input-group mb-3">
              <div class="input-group-prepend"><span class="input-group-text">Reg Expiry</span></div>
              <input type="date"  aria-describedby="date" name="registration_expiry_date" id="registration_expiry_date" class="form-control text-box" />
           </div>

           <div class="input-group mb-3">
              <div class="input-group-prepend"><span class="input-group-text">Reg File</span></div>
              <input type="file" name="registration_file" id="registration_file" class="form-control text-box" />
           </div>

           <div class="input-group mb-3">
              <div class="input-group-prepend"><span class="input-group-text">Tax Token</span></div>
              <input type="text" name="tax_token" id="tax_token" class="form-control text-box" />
           </div>

           <div class="input-group mb-3">
              <div class="input-group-prepend"><span class="input-group-text">Tax Token Expiry</span></div>
              <input type="date"  aria-describedby="date" name="tax_token_expiry_date" id="tax_token_expiry_date" class="form-control text-box" />
           </div>

           <div class="input-group mb-3">
              <div class="input-group-prepend"><span class="input-group-text">Tax Token File</span></div>
              <input type="file" name="tax_token_file" id="tax_token_file" class="form-control text-box" />
           </div>

           <div class="input-group mb-3">
              <div class="input-group-prepend"><span class="input-group-text">Insurance</span></div>
              <input type="text" name="insurance" id="insurance" class="form-control text-box" />
           </div>

           <div class="input-group mb-3">
              <div class="input-group-prepend"><span class="input-group-text">Insurace Expiry</span></div>
              <input type="date"  aria-describedby="date" name="insurance_expiry_date" id="insurance_expiry_date" class="form-control text-box" />
           </div>

           <div class="input-group mb-3">
              <div class="input-group-prepend"><span class="input-group-text">Insurance File</span></div>
              <input type="file" name="insurance_file" id="insurance_file" class="form-control text-box" />
           </div>

           <div class="input-group mb-3">
              <div class="input-group-prepend"><span class="input-group-text">Fitness</span></div>
              <input type="text" name="fitness" id="fitness" class="form-control text-box" />
           </div>

           <div class="input-group mb-3">
              <div class="input-group-prepend"><span class="input-group-text">Fitness Expiry</span></div>
              <input type="date"  aria-describedby="date" name="fitness_expiry_date" id="fitness_expiry_date" class="form-control text-box" />
           </div>

           <div class="input-group mb-3">
              <div class="input-group-prepend"><span class="input-group-text">Fitness File</span></div>
              <input type="file" name="fitness_file" id="fitness_file" class="form-control text-box" />
           </div>


           <div class="input-group mb-3">
              <div class="input-group-prepend"><span class="input-group-text">Status</span></div>
              <select type="text" name="is_active" id="is_active" class="form-control text-box" />
                <option value="1">Active</option>
                <option value="0">Inactive</option>
            </select>
           </div>

           <div class="input-group mb-3">
              <div class="input-group-prepend"><span class="input-group-text">Photo</span></div>
              <input type="file" name="photo_file" id="photo_fle" class="form-control text-box" />
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
   url: "{{ url('admin/rides') }}",
  },
  columns: [

   {
    data: 'id',
    name: 'id'
   },
   {
    data: 'type',
    name: 'type'
   },
   {
    data: 'owner',
    name: 'owner'
   },
   {
    data: 'rider',
    name: 'rider'
   },
   {
    data: 'registration',
    name: 'registration'
   },
   {
    data: 'registration_expiry_date',
    name: 'registration_expiry_date'
   },

   {
    data: 'registration_file',
    name: 'registration_file',
    render: function(data, type, full, meta){
    return "<img src={{ URL::to('/') }}/uploads/" + data + " width='70' class='img-thumbnail' />";
    },
   },

   {
    data: 'tax_token',
    name: 'tax_token'
   },
   {
    data: 'tax_token_expiry_date',
    name: 'tax_token_expiry_date'
   },

   {
    data: 'tax_token_file',
    name: 'tax_token_file',
    render: function(data, type, full, meta){
    return "<img src={{ URL::to('/') }}/uploads/" + data + " width='70' class='img-thumbnail' />";
    },
   },

   {
    data: 'insurance',
    name: 'insurance'
   },
   {
    data: 'insurance_expiry_date',
    name: 'insurance_expiry_date'
   },

   {
    data: 'insurance_file',
    name: 'insurance_file',
    render: function(data, type, full, meta){
    return "<img src={{ URL::to('/') }}/uploads/" + data + " width='70' class='img-thumbnail' />";
    },
   },

   {
    data: 'fitness',
    name: 'fitness'
   },
   {
    data: 'fitness_expiry_date',
    name: 'fitness_expiry_date'
   },

   {
    data: 'fitness_file',
    name: 'fitness_file',
    render: function(data, type, full, meta){
    return "<img src={{ URL::to('/') }}/uploads/" + data + " width='70' class='img-thumbnail' />";
    },
   },
   {
    data: 'is_active',
    name: 'is_active'
   },
   {
    data: 'photo',
    name: 'photo',
    render: function(data, type, full, meta){
    return "<img src={{ URL::to('/') }}/uploads/" + data + " width='70' class='img-thumbnail' />";
    },
   },
   {
    data: 'created_at',
    name: 'created_at'
   },
   {
    data: 'updated_at',
    name: 'updated_at'
   },
   {
    data: 'action',
    name: 'action',
    orderable: false
   }
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


            $('#form').on('submit', function(event){
           event.preventDefault();
           if($('#action').val() == 'Add')
           {
           $.ajax({
           url:"{{ url('admin/rides/store') }}",
           method:"POST",
           data: new FormData(this),
           contentType: false,
           cache:false,
           processData: false,
           dataType:"json",
           success:function(data)
           {
           var html = '';
           if(data.errors)
           {
           html = '<div class="alert alert-danger">';
           for(var count = 0; count < data.errors.length; count++)
           {
           html += '<p>' + data.errors[count] + '</p>';
           }
           html += '</div>';
           }
           if(data.success)
           {
           html = '<div class="alert alert-success">' + data.success + '</div>';
           $('#form')[0].reset();
           $('#user_table').DataTable().ajax.reload();
           }
           $('#form_result').html(html);
           }
           })
           }

                                 if($('#action').val() == "Edit")
                                 {
                                 $.ajax({
                                 url:"{{ url('admin/rides/update') }}",
                                 method:"POST",
                                 data:new FormData(this),
                                 contentType: false,
                                 cache: false,
                                 processData: false,
                                 dataType:"json",
                                 success:function(data)
                                 {
                                 var html = '';
                                 if(data.errors)
                                 {
                                 html = '<div class="alert alert-danger">';
                                 for(var count = 0; count < data.errors.length; count++)
                                 {
                                 html += '<p>' + data.errors[count] + '</p>';
                                 }
                                 html += '</div>';
                                 }
                                 if(data.success)
                                 {
                                 html = '<div class="alert alert-success">' + data.success + '</div>';
                                 $('#sample_form')[0].reset();
                                 $('#store_image').html('');
                                 $('#user_table').DataTable().ajax.reload();
                                 }
                                 $('#form_result').html(html);
                                 }
                                 });
                                 }
                                 });





 $(document).on('click', '.edit', function(){
  var id = $(this).attr('id');
  $('#form_result').html('');
  $.ajax({
   url :"{{url('admin/rides/') }}/"+id+"/edit",
   dataType:"json",
   success:function(data)
   {
     $('#rider').val(data.result.rider);
     $('#type').val(data.result.type);
     $('#registration').val(data.result.registration);
     $('#reg_expiry_date').val(data.result.reg_expiry_date);
     $('#insurance').val(data.result.insurance);
     $('#insurance_expiry_date').val(data.result.insurance_expiry_date);
     $('#is_active').val(data.result.is_active);
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
