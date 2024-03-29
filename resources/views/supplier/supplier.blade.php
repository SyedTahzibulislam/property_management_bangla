

@extends('layout.main')

@section('content')




 
 






</head>






<body>

<div class="container">
  <div class="row">
    <div class="col-md-12 col-sm-6" >
    <h6 style="color:red;">আপনার প্রতিষ্টানে বিভিন্ন পণ্য বা সেবা সরবারাহকারী প্রতিষ্ঠান বা ব্যাক্তি মূলত সাপ্লাইয়ার। আপনি চাইলে নতুন সাপ্লাইয়ার যুক্ত করতে পারেন এড বাটন চেপে। নিচের টেবিল থেকে কোন সাপ্লাইয়ারের কাছে কত টাকার দেনা আছেন বা কত টাকা তাকে এডভান্স দিয়েছেন সেটা দেখতে পারবেন।  </h6>
    <a style="float:right; margin-bottom:20px;" class="btn btn-success" href="javascript:void(0)" id="create_record"> Add New </a>
	<h2 style="color:green;">সাপ্লাইয়ার এর তালিকা </h2>
	
	<div class="table-responsive">
    <table id="patient_table"  class="table  table-success table-striped data-tablem">
        <thead>
            <tr>
	
			
			<th>No</th>
		
                <th>নাম</th> 
				<th>মোবাইল :</th>
				<th>ঠিকানা </th>
				<th> সাপ্লাইয়ের  কাছে আপনার দেনার পরিমাণ </th>
				<th> সাপ্লাইয়ের কাছে এডভান্স দেয়া থাকলে সেই পাওনার পরিমাণ</th>
              
				
				
			     
             
                <th width="300px">একশন </th>
            </tr>
        </thead>
        <tbody   >

        </tbody>
    </table>
	</div>
</div>
</div>
</div>



<div id="formModal" class="modal fade" role="dialog">
 <div class="modal-dialog">
  <div class="modal-content">
   <div class="modal-header">
          <button type="button" id="close" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add New Record</h4>
        </div>
        <div class="modal-body">
         <span id="form_result"></span>
         <form method="post" id="sample_form" class="form-horizontal" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
            <label class="control-label col-md-4" > নাম * : </label>
            <div class="col-md-8">
             <input type="text" autocomplete="off" name="name" id="name" class="form-control" />
            </div>
           </div>
           <div id="address_div" class="form-group">
            <label class="control-label col-md-4">এড্রেস  : </label>
            <div class="col-md-8">
             <input type="text"  autocomplete="off" name="address" id="address" class="form-control" />
            </div>
           </div>
		   
		             <div id="mobile_div" class="form-group">
            <label class="control-label col-md-4">মোবাইল  : </label>
            <div class="col-md-8">
             <input type="text" autocomplete="off" name="mobile" id="mobile" class="form-control" />
            </div>
           </div>
		   
		             <div id="mobile_div" class="form-group">
            <label class="control-label col-md-4">শুরুর বাকি  : </label>
            <div class="col-md-8">
             <input type="text" name="due" autocomplete="off" id="due" class="form-control" />
            </div>
           </div>		   

   
           <br />
           <div class="form-group" align="center">
            <input type="hidden" name="action" id="action" />
            <input type="hidden" name="hidden_id" id="hidden_id" />
            <input type="submit" name="action_button" id="action_button" class="btn btn-warning" value="Add" />
           </div>
         </form>
        </div>
     </div>
    </div>
</div>













<div id="confirmModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2 class="modal-title">কনফার্মশন </h2>
            </div>
            <div class="modal-body">
                <h4 align="center" style="margin:0;"> আপনি কি ডিলিট করতে চান ?</h4>
            </div>
            <div class="modal-footer">
             <button type="button" name="ok_button" id="ok_button" class="btn btn-danger">OK</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>





 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>  


<script type="text/javascript">


$(document).ready(function(){

$('#formModal').on('hidden.bs.modal', function () {
    $(this).find('form').trigger('reset');
})


     $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
    });
	



    var table = $('#patient_table').DataTable({
		
	
		
        processing: true,
        serverSide: true,
		responsive: true,
	
        ajax: "{{ route('supplier.index') }}",
        columns: [
		
		 {data: 'id', name: 'id'},
		 
		 
		
            
			
			
			
            {data: 'name', name: 'name'},
			 {data: 'mobile', name: 'mobile'},
			  {data: 'address', name: 'address'},
			 {data: 'due', name: 'due'},
			 {data: 'advance', name: 'advance'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });





























 $('#create_record').click(function(){
  $('.modal-title').text("Add New Record");
     $('#action_button').val("Add");
     $('#action').val("Add");
	 
	
	 
     $('#formModal').modal('show');
 });



$('#sample_form').on('submit', function(event){
  event.preventDefault();
  if($('#action').val() == 'Add')
  {
   $.ajax({
    url:"{{ route('supplier.store') }}",
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
      $('#sample_form')[0].reset();
      $('#patient_table').DataTable().ajax.reload();
     }
     $('#form_result').html(html);
    }
   })
  }

  if($('#action').val() == "Edit")
  {
	  console.log("A");
   $.ajax({
    url:"{{ route('supplier.update') }}",
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
      $('#patient_table').DataTable().ajax.reload();
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
   url:"/supplier/"+id+"/edit",
   dataType:"json",
   success:function(html){
    $('#name').val(html.data.name);
    
	$('#mobile').val(html.data.mobile);

	$('#address').val(html.data.address);
	
	$('#age').val(html.data.age);
   
    $('#sex').val(html.data.sex);
   	 
	  $('#due').val(html.data.due);  
	$('#hidden_id').val(html.data.id);
    $('.modal-title').text("Edit New Record");
    $('#action_button').val("Edit");
    $('#action').val("Edit");
    $('#formModal').modal('show');
   }
  })
 });
 
 
 
 
 
 
 
 
 
 
 
 

 




























 
 
 var user_id;

 $(document).on('click', '.delete', function(){
  user_id = $(this).attr('id');
  $('#confirmModal').modal('show');
 });

 $('#ok_button').click(function(){
  $.ajax({
   url:"supplier/destroy/"+user_id,
   beforeSend:function(){
    $('#ok_button').text('Deleting...');
   },
   success:function(data)
   {
    setTimeout(function(){
     $('#confirmModal').modal('hide');
     $('#user_table').DataTable().ajax.reload();
    }, 2000);
	
	      $('#patient_table').DataTable().ajax.reload();
		   $('#ok_button').text('Delete');
   }
  })
 });

 
 $(document).on('click', '#close', function(){
$('#formModal').modal('hide');

 });


});
</script>
	  


@stop