

@extends('layout.main')

@section('content')




 <style>
.modal-lg {
    max-width: 90% !important;

}


</style>
 






</head>

  
 






<body>



<div class="container" style="background-color:#EEE8AA; "          >

 
           <form method="post"  action="{{ route('externalincometransition.store') }}"   id="sample_form" class="form-horizontal  sample_form" enctype="multipart/form-data">
          @csrf
		  
		  
		  		<div  class="container" style="background-color:#EEE8AA; "  >
		<h2>Input Extenral Income </h2>
  <span id="form_result"></span>
	

		   
		   

			 

			 
<p>



</div>
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		   <div class="row">

    <div class="col-6">
Income Source   :  <select id="income_source"  class="form-control income_source"  name="income_source"  required   style="width:170px;">
    </select>
    </div>
 



    <div class="col-6">
Customer  :  <select id="income_provider"  class="form-control income_provider"  name="income_provider"  required   style="width:170px;">
    </select>
    </div>
	</div>
	<p>
	<div class="row">
	
    <div class="col-6">
Project  :  <select id="project"  class="form-control project"  name="project"     style="width:170px;">
    </select>
    </div>	
	

	
	

	  </div>
	  <p>
	        <div class="row">
            <div class="col-6">
	   Accountant Name  :    <select id="accountant"  class="form-control "  name="accountant"  required  style="width:170px;">  
           
			
			</select>
             </div>
			 
			 
            <div class="col-6">
	  Supervisor Name  :    <select id="supervisor"  class="form-control "  name="supervisor"  required  style="width:170px;">  
           
			
			</select>
             </div>			 
			 
	 
			 </div>	
<p>			 
	  
	<div class="row">

				 			 <div class="col-6">Adjust with<br>
			 <input type="radio"  name="adjusttype" value="1"  required >
<label for="html">  Owner's fund  </label><br>
<input type="radio"  name="adjusttype" value="2"   required >
<label for="css">  Accountant's fund  </label><br>
<input type="radio"  name="adjusttype" value="3"   required >
<label for="css">  Project's fund  </label><br>
			    
			 </div>	
			 
			 
    <div class="col-6">
 Total Paid   : 	<input type="text" value="0"  autocomplete="off"  name="amount" id="amount" class="form-control amount" required  />
    </div>			 

			 

</div>		  
	  
	  
	  
	  
	  
	  
	  
	  
	
<div class="row">


    <div class="col-6">
 Due  : 	<input type="text" value="0"  autocomplete="off"  name="due" id="due_amount" class="form-control due_amount" required  />
    </div>

<div class="col-6">
Date:  <input type="date"  required id="datePicker" name="Date_of_Transition" class="form-control" />
</div>	
 </div>
<p> 
	  
	  
           <div class="form-group" align="center">
            <input type="hidden" name="action" id="action"    value="Add"  />
            <input type="hidden" name="hidden_id" id="hidden_id" />
			 <span id="form_resultfooter"></span>
            <input type="submit" name="action_button" id="action_button" class="btn btn-warning" value="Add" />
           </div>
         </form>	
	
	
	

</div>















<b> Income Transition </b>
<input type="hidden" id="balance" name="balance" value="{{$balance->balance}}">
<div class="container">
  <div class="row">
    <div class="col-md-12 col-sm-6" >
    <h6 style="color:red;"> প্রতিষ্ঠানের জন্য ক্রয়কৃত সেবা / পণ্যের চালানের তথ্য নিচে টেবিলে দেয়া আছে। নতুন করে কোন পণ্য বা সেবা কিনতে ADD Record বাটনে ক্লিক করুন </h6>
  
	
	
	<div class="table-responsive">
    <table id="patient_table"  class="table  table-success table-striped data-tablem">
        <thead>
            <tr>
<th>নং </th>
			<th>product/sevice </th>
			
			<th> Customer  </th>
			<th> Entry by  </th>
			
			<th>Price  </th>
			<th> Due  </th>
			
			<th> Date  </th>
			<th>Action </th>
			<th>Project </th>	
			<th>Supervisor </th>	
			<th>Accountant </th>
			<th>Adjusted with </th>			
			
				
    
				
				
			     
             
                
            </tr>
        </thead>
        <tbody   >
        
        </tbody>
    </table>
	</div>
</div>
</div>
</div>





<div id="confirmModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2 class="modal-title">Confirmation</h2>
            </div>
            <div class="modal-body">
                <h4 align="center" style="margin:0;">Are you sure you want to remove this data?</h4>
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
	
	
	Date.prototype.toDateInputValue = (function() {
    var local = new Date(this);
    local.setMinutes(this.getMinutes() - this.getTimezoneOffset());
    return local.toJSON().slice(0,10);
});
$('#datePicker').val(new Date().toDateInputValue());
	
  $("#income_source").select2();   
 $("#income_provider").select2();   
$("#supervisor").select2();    
 $("#accountant").select2();
 
 $("#project").select2();   


///////////////////////////////







////////////////////////////////////////////////////// 



   













     $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
    });
	



    var table = $('#patient_table').DataTable({
		
	
		
        processing: true,
        serverSide: true,
		responsive: true,
	
        ajax: "{{ route('externalincometransition.index') }}",
	
        columns: [
		
		 
		 
		  {data: 'DT_RowIndex', name: 'DT_RowIndex'},
	
			
			   
			   {data: 'incomer_name', name: 'externalincomesource.name'},
			  {data: 'incomer_provider', name: 'externalincomeprovider.name'},
{data: 'entryby', name: 'User.name'},
			   
			  
			 
			  {data: 'amount', name: 'amount'},
			 
			  {data: 'due', name: 'due'},
			 
		
           {data: 'created_at', name: 'created_at'},
	
			   {data: 'action', name: 'action', orderable: false, searchable: false},

 						 {data: 'project', name: 'project'}, 
				 {data: 'superviser', name: 'superviser'},	
				 {data: 'accountant', name: 'accountant'},
{data: 'adjustby', name: 'adjustby'},
			    
           
        ]
    });


   fetchdata();
   

 
 
 
 

 
 
 
 

 
 
 
 
 
 
 
 
 
 
 
 
 
 function fetchdata(){
	 
	   $.ajax({
   url:"externalincometransition/dropdown_list",
   dataType:"json",
   
   ////////////////////fetch data for dropdown menu 
success:function (response) {
	
 	
	 $("#income_provider").html("");
	 $("#income_source").html("");
	 $("#project").html("");
	

                       
    
					
					
						var optionforsupplier = "<option ></option>"; 
					   $("#income_provider").append(optionforsupplier);
					
					
					
					                    var len = 0;
                    if (response.income_provider != null) {
                        len = response.income_provider.length;
                    }

                    if (len>0) {
                        for (var i = 0; i<len; i++) {
                             var id = response.income_provider[i].id;
                             var name = response.income_provider[i].name;
						

                             var optionforsupplier = "<option     value='"+id+"'>"+name+"</option>"; 
							

                             $("#income_provider").append(optionforsupplier);
                        }
                    } 






						var optionforsupplier = "<option ></option>"; 
					   $("#income_source").append(optionforsupplier);
					
					
					
					                    var len = 0;
                    if (response.income_source != null) {
                        len = response.income_source.length;
                    }

                    if (len>0) {
                        for (var i = 0; i<len; i++) {
                             var id = response.income_source[i].id;
                             var name = response.income_source[i].name;
						

                             var optionforsupplier = "<option     value='"+id+"'>"+name+"</option>"; 
							

                             $("#income_source").append(optionforsupplier);
                        }
                    } 



						var optionforsupplier = "<option ></option>"; 
					   $("#project").append(optionforsupplier);
					
					
					
					                    var len = 0;
                    if (response.project != null) {
                        len = response.project.length;
                    }

                    if (len>0) {
                        for (var i = 0; i<len; i++) {
                             var id = response.project[i].id;
                             var name = response.project[i].name;
						

                             var optionforsupplier = "<option     value='"+id+"'>"+name+"</option>"; 
							

                             $("#project").append(optionforsupplier);
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









 }	//////////////////////////////////////////////////////////////////////////////
  })
 
 }
 
 fetchcate();
 function fetchcate()
{

 $.ajax({
   url:"externalincomesource/dropdownlist",
   dataType:"json",
   
   ////////////////////fetch data for dropdown menu 
success:function (response) {
	
	
					

					///////////////////////   set first option value ///////////////////
					
						  $("#medicine_name").html("");
					
					var optionformedicine = "<option  ></option>"; 
               	$("#medicine_name").append(optionformedicine);
					
					
					///////////////////////   set dynamic select option values from Database ///////////////////
					
					
					                    var len = 0;
                    if (response.incomeproviderlist != null) {
                        len = response.incomeproviderlist.length;
                    }

                    if (len>0) {
                        for (var i = 0; i<len; i++) {
                             var id = response.incomeproviderlist[i].id;
                             var name = response.incomeproviderlist[i].name;
							 
					        
                             
				//////////////////////////////////// Set user dfeined atribute data-price//////			 
							 var optionformedicine = "<option     value='"+id+"'>"+name+"</option>"; 
							 /////////////////////////////////////////////////////////////
							 
					


							   

                             $("#medicine_name").append(optionformedicine);
							  
                        }
                    }
               





					



			   }
				
				
	//////////////////////////////////////////////////////////////////////////////
  })

 	
	
}
 
















	









 
 
 

 


 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
   
   
  /////////////////////////////////ADD Data //////////////////////////// 
   
   

$('#sample_form').on('submit', function(event){
  event.preventDefault();
  if($('#action').val() == 'Add')
  {
  
   $.ajax({
    url:"{{ route('externalincometransition.store') }}",
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
		 
	$('#sample_form')[0].reset();
      $('#patient_table').DataTable().ajax.reload();
	  fetchdata();
	  
	       html = '<div class="alert alert-success">' + data.success + '</div>';

	
      $('#patient_table').DataTable().ajax.reload();
 $('#datePicker').val(new Date().toDateInputValue());
     }
     $('#form_result').html(html);
	 	 $(".medicine_name").prop("disabled",false);
	  $('#form_resultfooter').html(html);
	 	$("#form_result").show().delay(5000).fadeOut();
			$("#form_resultfooter").show().delay(5000).fadeOut();
			 $("#products_table tr:gt(1)").remove();
	 fetchcate();
	  //remover por select2 dite hobe 
 $('.medicine_name').select2();
    }
   })
  
  
  
  }

  if($('#action').val() == "Edit")
  {
   $.ajax({
    url:"{{ route('khorochtransition.update') }}",
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
	   $('#datePicker').val(new Date().toDateInputValue());
     }
     $('#form_result').html(html);
	  $('#form_resultfooter').html(html);
	 	$("#form_result").show().delay(5000).fadeOut();
			$("#form_resultfooter").show().delay(5000).fadeOut();
	      $('#action').val("Add");
		   $('#action_button').val("Add");  
		  
	 	     $("#khorocer_khad").select2();   
 $("#supplier").select2(); 
       fetchdata();
	
    }
   });
  }
 });
   
   $(document).on('click', '.edit', function(){
	  
  var id = $(this).attr('id');
  $('#form_result').html('');
  $.ajax({
   url:"/khorochtransition/"+id+"/edit",
   dataType:"json",
   success:function(html){
	   
	 	 $("#khorocer_khad").html("");  
	$("#supplier").html("");   
	   
	
	var len = html.khorocer_khad.length;
	console.log(len);
	var presentkhoroc = html.khoroch_transition.khorocer_khad_id;

	
	
		                        for (var i = 0; i<len; i++) {
								
								if ( presentkhoroc == html.khorocer_khad[i].id  ) 
								{
									var id = html.khorocer_khad[i].id;
                             var name = html.khorocer_khad[i].name;

                             var option = "<option value='"+id+"'>"+name+"</option>"; 

                             $("#khorocer_khad").append(option);
								}
                             
                        }
						
						
							                        for (var i = 0; i<len; i++) {
								
								if ( presentkhoroc != html.khorocer_khad[i].id ) 
								{
			                 var id = html.khorocer_khad[i].id;
                             var name = html.khorocer_khad[i].name;

                             var option = "<option value='"+id+"'>"+name+"</option>"; 

                             $("#khorocer_khad").append(option);
								}
                             
                        }
						
				


		/////////////////////////  fetch for patientlist 				
		
						var len = html.supplier.length;
	
	var presentsupplier = html.khoroch_transition.supplier_id;

	
	
		                        for (var i = 0; i<len; i++) {
								console.log('A' );
								if ( presentsupplier == html.supplier[i].id  ) 
								{
									var id = html.supplier[i].id;
                             var name = html.supplier[i].name;

                             var optionforsupplier = "<option value='"+id+"'>"+name+"</option>"; 
                              console.log(option);
                             $("#supplier").append(optionforsupplier);
								}
                             
                        }
						
						
							                        for (var i = 0; i<len; i++) {
								
								if ( presentsupplier != html.supplier[i].id  ) 
								{
									var id = html.supplier[i].id;
                             var name = html.supplier[i].name;

                             var optionforsupplier = "<option value='"+id+"'>"+name+"</option>"; 

                             $("#supplier").append(optionforsupplier);
								}
                             
                        }
	                        
	
	




$('#unit').val(html.khoroch_transition.unit);						
$('#unit_price').val(html.khoroch_transition.unit_price);						
$('#amount').val(html.khoroch_transition.amount);						
$('#due').val(html.khoroch_transition.due);												
$('#datePicker').val(html.khoroch_transition.created_at);	

   
	$('#hidden_id').val(html.khoroch_transition.id);
    $('.modal-title').text("Edit New Record");
    $('#action_button').val("Edit");
    $('#action').val("Edit");
   
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
   url:"externalincometransition/destroy/"+user_id,
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
	     $("#khorocer_khad").select2();   
 $("#supplier").select2(); 
       fetchdata(); 	 
   }

  })
 });

   
   
   



   
   
   
   
   
   
   
   
   
   
   
   
   
  
	 
	 
	 
	 
	 
	 

	 
	 






 
 $(document).on('click', '#close', function(){
$('#formModal').modal('hide');

 });


});
</script>
	  


@stop