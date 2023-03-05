

@extends('layout.main')

@section('content')




 
 






</head>

  
 






<body>

<div class="container">
  <div class="row">
    <div class="col-md-12 col-sm-6" >
    <h1>বেতন দেন </h1>
    <a style="float:right; margin-bottom:20px;" class="btn btn-success  create_record" href="javascript:void(0)" id="create_record"> এড করেন  </a>
	
	
	<div class="table-responsive">
    <table id="patient_table"  class="table  table-success table-striped data-tablem">
        <thead>
            <tr>
<th> নং  </th>
			
				<th> নাম </th>
		  <th> টাকার পরিমাণ </th>
				<th>একশন </th>
    
				
				
			     
             
                
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
          <h4 class="modal-title">নতুন রেকর্ড যুক্ত </h4>
        </div>
        <div class="modal-body">
         <span id="form_result"></span>
         <form method="post"  action="{{ route('employeetransactioncon.store') }}"   id="sample_form" class="form-horizontal" enctype="multipart/form-data">
          @csrf
		  
		  <div class="form-group">
            <label class="control-label col-md-4">কর্মচারীদের তালিকা *  : </label>
            <div class="col-md-8">
	
	<select id="employeelist"  class="form-control "  name="employeelist"  required   style='width: 270px;'>
  
   </select>
             </div>
			 </div>
			 
			 
			 
			 
		  <div class="form-group">
            <label class="control-label col-md-4">প্রজেক্ট *  : </label>
            <div class="col-md-8">
	
	<select id="project"  class="form-control "  name="project"  required   style='width: 270px;'>
  
   </select>
             </div>
			 </div>			 
			 
			 
			 
			 
			 
			 
			 
			 
			 
			 		             <div class="form-group">
            <label class="control-label col-md-4" >বেতনের পরিমাণ * : </label>
            <div class="col-md-8">
             <input type="text" autocomplete="off" name="salary" id="salary" class="form-control" />
            </div>
           </div>
			 
			 
			 
		
  
  
  		    <div class="form-group">
	
            <label class="control-label col-md-4"> যে তারিখে বেতন দেয়া হচ্ছে * : </label>
            <div class="col-md-8">
             <input type="date" id="Startdate" name="Startdate" class="form-control" />
            </div>
           </div>
  
		 		  <div class="form-group">
            <label class="control-label col-md-4">যে মাসের বেতন দেয়া হচ্ছে * : </label>
            <div class="col-md-8">
	
	<select id="month"  class="form-control "  name="month"  required   style='width: 270px;'>
	<option value=""></option>
   <option   value="1">Jan</option>
  <option     value="2">Feb</option>
  <option     value="3">March</option>
     <option     value="4">April</option>
  <option   value="5">May</option>
  <option     value="6">June</option>
     <option     value="7">July</option>
  <option     value="8">Aug</option>
  <option     value="9">Spet</option>
     <option     value="10">Oct</option>
  <option    value="11">Nov</option>
  <option      value="12">Dec</option>
 
   </select>
             </div>
			 </div>  

		 		  <div class="form-group">
            <label class="control-label col-md-4">যে বছরের বেতন দেয়া হচ্ছে * : </label>
            <div class="col-md-8">
	
	<select id="year"  class="form-control " type="reset"  name="year"  required   style='width: 270px;'>
	<option value=""></option> 
	
	
	<?php for($i=2021; $i<2050; $i++) { ?> 
   <option value="{{$i}}">{{$i}}</option>
	<?php  } ?>
 
 
   </select>
             </div>
			 </div>  



	<div class="row">

				 			 <div class="col-6">এডজাস্ট *<br>
			 <input type="radio"  name="adjusttype" value="1"  required >
<label for="html">  মালিকের ফান্ড   </label><br>
<input type="radio"  name="adjusttype" value="2"   required >
<label for="css"> একাউন্টেন্ট ফান্ড   </label><br>
<input type="radio"  name="adjusttype" value="3"   required >
<label for="css">  প্রজেক্ট ফান্ড   </label><br>
			    
			 </div>	
			 
			</div>

<div class="row">			
		

          <div class="col-4">
	  একাউন্টেন্ট   :    <select id="accountant"  class="form-control "  name="accountant"  required  style="width:170px;">  
           
			
			</select>
             </div>
			 
			 
            <div class="col-4">
	  সুপারভাইজার   :    <select id="supervisor"  class="form-control "  name="supervisor"  required  style="width:170px;">  
           
			
			</select>
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
                <h2 class="modal-title">কনফার্মসন </h2>
            </div>
            <div class="modal-body">
                <h4 align="center" style="margin:0;">আপনি কি ডিলিট করতে চান ?</h4>
            </div>
            <div class="modal-footer">
             <button type="button" name="ok_button" id="ok_button" class="btn btn-danger">OK</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>





 




<script type="text/javascript">


$(document).ready(function(){
	
  $("#employeelist").select2();   
 $("#cabine_list").select2();  
 $("#month").select2();  
 $("#year").select2(); 
 $("#accountant").select2(); 
 $("#supervisor").select2(); 
 $("#project").select2();

///// clear modal data after close it 
$('#formModal').on('hidden.bs.modal', function () {
    $(this).find('form').trigger('reset');
	  $("#employeelist").html('');  
})
///////////////////////////////


     $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
    });
	



    var table = $('#patient_table').DataTable({
		
	
		
        processing: true,
        serverSide: true,
		responsive: true,
	
        ajax: "{{ route('employeetransactioncon.index') }}",
	
        columns: [
		
		 
		 
		  {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            
			 {data: 'employee_name', name: 'employeedetails.name'},
			
			 
        
			 
			 {data: 'totalsalary', name: 'totalsalary'},
			
 {data: 'action', name: 'action', orderable: false, searchable: false},
			    
           
        ],

        order: [
        [0, 'desc']
    ] 


    });


   
   
   
   
   
   function fetch(){

	
  $("#employeelist").html('');   


 $.ajax({
   url:"employeetransactioncon/dropdown_list",
   dataType:"json",
   
   ////////////////////fetch data for dropdown menu 
success:function (response) {
	
	$("#employeelist").html("");

	var option = "<option >select one</option>"; 
					   $("#employeelist").append(option);
	
	
                    var len = 0;
                    if (response.employeedetails != null) {
                        len = response.employeedetails.length;
                    }
                       
                    if (len>0) {
                        for (var i = 0; i<len; i++) {
                             var id = response.employeedetails[i].id;
                             var name = response.employeedetails[i].name;

                             var option = "<option value='"+id+"'>"+name+"</option>"; 
							

                             $("#employeelist").append(option);
                        }
                    }
					
	







	$("#project").html("");

	var option = "<option >select one</option>"; 
					   $("#project").append(option);
	
	
                    var len = 0;
                    if (response.project != null) {
                        len = response.project.length;
                    }
                       
                    if (len>0) {
                        for (var i = 0; i<len; i++) {
                             var id = response.project[i].id;
                             var name = response.project[i].name;

                             var option = "<option value='"+id+"'>"+name+"</option>"; 
							

                             $("#project").append(option);
                        }
                    }














	
	


			 $("#accountant").html("");			
					
		var optionforcustomer = "<option value='99999999999'>NA</option>";			
	$("#accountant").append(optionforcustomer);	
	
			
				   var len = 0;
                    if (response.accountant != null) {
                        len = response.accountant.length;
                    }

                    if (len>0) {
                        for (var i = 0; i<len; i++) {
                             var id = response.accountant[i].id;
                             var name = response.accountant[i].name;
							
							  
							  
							  var optionforcustomer = "<option  data-val='"+id+"'     value='"+id+"'>"+name+"</option>"; 
							  

							

                            
							  $("#accountant").append(optionforcustomer);
                        }
                    }







			 $("#supervisor").html("");			
					
		var optionforcustomer = "<option value='99999999999'>NA</option>";			
	$("#supervisor").append(optionforcustomer);
	
				   var len = 0;
                    if (response.project_supervisor != null) {
                        len = response.project_supervisor.length;
                    }

                    if (len>0) {
                        for (var i = 0; i<len; i++) {
                             var id = response.project_supervisor[i].id;
                             var name = response.project_supervisor[i].name;
							
							  
							  
							  var optionforcustomer = "<option  data-val='"+id+"'     value='"+id+"'>"+name+"</option>"; 
							  

							

                            
							  $("#supervisor").append(optionforcustomer);
                        }
                    }




						
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
                }
				
				
	//////////////////////////////////////////////////////////////////////////////
  })












   }	   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
  ///////// show the modal//////////////////////////////////////////////////////////////////////////////// 
    $(document).on('click', '.create_record', function(){
		  $('#form_result').html('');
    $('.modal-title').text("Add New Record");
     $('#action_button').val("Add");
     $('#action').val("Add");
       $('#formModal').modal('show');
 



fetch();
 
 
 });
 
   
   
  /////////////////////////////////ADD Data //////////////////////////// 
   
   

$('#sample_form').on('submit', function(event){
  event.preventDefault();
  if($('#action').val() == 'Add')
  {
  
   $.ajax({
    url:"{{ route('employeetransactioncon.store') }}",
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
       $('#sample_form')[0].reset();
$('#form_result').fadeIn();
$('#form_result').delay(1500).fadeOut();
fetch();
    }
   })
  
  
  
  }

  if($('#action').val() == "Edit")
  {
   $.ajax({
    url:"{{ route('employeetransactioncon.update') }}",
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

$('#form_result').fadeIn();
$('#form_result').delay(1500).fadeOut();
fetch();
    }
   });
  }
 });
   
   $(document).on('click', '.edit', function(){
  var id = $(this).attr('id');
  $('#form_result').html('');
  $.ajax({
   url:"/employeetransactioncon/"+id+"/edit",
   dataType:"json",
   success:function(html){
	   
	   
	   
    $('#Startdate').val(html.data.starting);    
    $('#releasedata').val(html.data.ending);
	   $('#salary').val(html.data.totalsalary);

	
	var len = html.employeedetails.length;
	console.log(len);
	var presentemployeedetails_id = html.data.employeedetails_id;

	
	
		                        for (var i = 0; i<len; i++) {
								
								if ( presentemployeedetails_id == html.employeedetails[i].id  ) 
								{
									var id = html.employeedetails[i].id;
                             var name = html.employeedetails[i].name;

                             var option = "<option value='"+id+"'>"+name+"</option>"; 

                             $("#employeelist").append(option);
								}
                             
                        }
						
						
							                        for (var i = 0; i<len; i++) {
								
								if ( presentemployeedetails_id != html.employeedetails[i].id  ) 
								{
									var id = html.employeedetails[i].id;
                             var name = html.employeedetails[i].name; 

                             var option = "<option value='"+id+"'>"+name+"</option>"; 

                             $("#employeelist").append(option);
								}
                             
                        }
						
				
	
	                        
	
	

						
						


   
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
   url:"employeetransactioncon/destroy/"+user_id,
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