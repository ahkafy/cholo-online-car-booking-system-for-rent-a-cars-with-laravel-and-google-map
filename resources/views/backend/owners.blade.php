@extends('backend.templates.table', ['title' => 'Owners'])
@section('content')

<div class="card-body">

  <button type="button" class="btn btn-md btn-primary float-left" data-toggle="modal" data-target="#formModal" style="margin-right:6px;border-radius:2px;"><span data-toggle="tooltip" data-placement="top" title="Add new record!"><i class="fas fa-plus"></i></span></button>
  <table id="user_table" class="table table-bordered table-striped table-hover">
   <thead class="">
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Phone</th>
      <th>Permanent Address</th>
      <th>Present Address</th>
      <th>NID</th>
      <th>NID Copy</th>
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
         <form method="post" id="form" class="form-horizontal" enctype="multipart/form-data">
          @csrf

           <div class="input-group mb-3">
              <div class="input-group-prepend"><span class="input-group-text">Name</span></div>
              <input type="text" name="name" id="name" class="form-control text-box" />
           </div>

           <div class="input-group mb-3">
              <div class="input-group-prepend"><span class="input-group-text">Phone Number</span></div>
              <input type="text" name="phone" id="phone" class="form-control text-box" />
           </div>

           <div class="input-group mb-3">
              <div class="input-group-prepend"><span class="input-group-text">Present Address</span></div>
              <input type="text" name="present_address" id="present_address" class="form-control text-box" />
           </div>

           <div class="input-group mb-3">
              <div class="input-group-prepend"><span class="input-group-text">Permanent Address</span></div>
              <input type="text" name="permanent_address" id="permanent_address" class="form-control text-box" />
           </div>

           <div class="input-group mb-3">
              <div class="input-group-prepend"><span class="input-group-text">National ID</span></div>
              <input type="text" name="nid" id="nid" class="form-control text-box" />
           </div>

           <div class="input-group mb-3">
              <div class="input-group-prepend"><span class="input-group-text">National File</span></div>
              <input type="file" name="nid_file" id="nid_file" class="form-control text-box" />
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
              <input type="file" name="photo" id="photo" class="form-control text-box" />
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
   url: "{{ url('admin/owners') }}",
  },
  columns: [
    {
     data: 'id',
     name: 'id'
   },
   {
    data: 'name',
    name: 'name'
   },
   {
    data: 'phone',
    name: 'phone'
   },
   {
    data: 'present_address',
    name: 'present_address'
   },
   {
    data: 'permanent_address',
    name: 'permanent_address'
   },
   {
    data: 'nid',
    name: 'nid'
   },
   {
    data: 'nid_file',
    name: 'nid_file',
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

 $('#create_record').click(function(){
  $('.modal-title').text('Add new rider');
  $('#action_button').val('Add');
  $('#action').val('Add');
  $('.text-box').val('');
  $('#form_result').html('');
  $('#formModal').modal('show');
 });


            $('#form').on('submit', function(event){
           event.preventDefault();
           if($('#action').val() == 'Add')
           {
           $.ajax({
           url:"{{ url('admin/owners/store') }}",
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
                                 url:"{{ url('admin/owners/update') }}",
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
   url :"{{url('admin/owners/') }}/"+id+"/edit",
   dataType:"json",
   success:function(data)
   {
     $('#name').val(data.result.name);
     $('#phone').val(data.result.phone);
     $('#present_address').val(data.result.present_address);
     $('#permanent_address').val(data.result.permanent_address);
     $('#nid').val(data.result.nid);
     //$('#nid_file').val(data.result.nid_file);
     $('#is_active').val(data.result.is_active);
    // $('#photo').val(data.result.photo);


    $('#hidden_id').val(id);
    $('.modal-title').text('Edit Record');
    $('#action_button').val('Edit');
    $('#action').val('Edit');
    $('#formModal').modal('show');
   }
  })
 });



 $(document).on('click', '.delete', function(){
  id = $(this).attr('id');
  $('#confirmModal').modal('show');
 });

 $('#ok_button').click(function(){
  $.ajax({
   url:"{{url('admin/owners/delete/')}}/"+id,
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
