

@extends('layout.main')

@section('content')



<style>
.modal-lg {
    max-width: 80% !important;

}



tr:nth-child(even) {background-color: #f2f2f2;}
</style>
 
 






</head>

  
 






<body>




		<div  class="container" style="background-color:#EEE8AA; "  >
		<h2>Due Payment / Refund</h2>
  <span id="form_result"></span>
	
	




		 <form method="post"  action="{{ route('plotsellduepayment.store') }}"   id="sample_form" class="form-horizontal  sample_form_for_doctorappointment" enctype="multipart/form-data">
          @csrf



<div class="container">
  <div class="row">
<!-- test_name -->
    <div class="col-6">
	Project Name:
 <select id="project_name"  class="form-control project_name"  name="project_name"     style='width: 170px;'>
    </select>
    </div>
 
 
 
 
     <div class="col-6">
	Customer Name:
 <select id="customer"  class="form-control customer"  name="customer"     style='width: 170px;'>
    </select>
    </div>

  </div>
  <p>
  
   <div class="row">
<!-- test_name -->
    <div class="col-6">
	Plot Name:
 <select id="plot_name"  class="form-control plot_name"  name="plot_name"     style='width: 170px;'>
    </select>
    </div>
 


    <div class="col-6">
	Accountant Name:
 <select id="accountant"  class="form-control accountant"  name="accountant"     style='width: 170px;'>
    </select>
    </div>


  </div> 
  <p>
 


  <div class="row">
  
 
	
	
	
      <div class="col-6">
      
Customer This Plot's due :  <input type="text" name="plotdue" autocomplete="off" id="plotdue"  value="0"  class="form-control  plotdue"  />
		  
    </div> 	
	
      <div class="col-6">
      
Customer Due :  <input type="text" autocomplete="off" name="customerdue" id="customerdue"  value="0"  class="form-control  customerdue"  />
		  
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
			 
			 
			 
			   				 			 <div class="col-6">Type<br>
	
<input type="radio"  name="type" value="2"   required >
<label for="css">  Due Payment  </label><br>
<input type="radio"  name="type" value="3"   required >
<label for="css">  Refund </label><br>
			    
			 </div>	
  
  </div>
  
  <div class="row">
  
      <div class="col-6">
      
 Gross Amount :  <input type="text" autocomplete="off" name="grossamount" id="grossamount"  value="0"  class="form-control  grossamount"  />
		  
    </div> 
	
	
	
      <div class="col-6">
      
 Discount :  <input type="text" name="discount" autocomplete="off" id="discount"  value="0"  class="form-control  discount"  />
		  
    </div> 	
	

  
  </div>
  
  <div class="row">
         <div class="col-6">
      
 Receiveable Amount :  <input type="text" autocomplete="off" name="receiveableamount" id="receiveableamount"  value="0"  class="form-control  receiveableamount"  />
		  
    </div>  
	

	
  
  
  </div>
  
  
  <p>
  
  
  <div class="row">
  <div class="col-6">
Date:  <input type="date"  required id="datePicker" name="Date_of_Transition" class="form-control" />
</div>
  
      <div class="col-6">

    <label for="history">Comment:</label>
    <textarea class="form-control" id="comment"  name="comment" rows="3"></textarea>
</div>
  </div>
  
  
  
  
</div>



<input type="hidden"   name="doctor" id="doctor" class="form-control  doctor"  />		
	




		   

		   

			 
			 
			 
			 
			 
			 
			

		   
  
           <br />
		   
	
           <div class="form-group" align="center">
            <input type="hidden" name="action" id="action"  value="Add"  />
            <input type="hidden" name="hidden_id" id="hidden_id" />
            <input type="submit" name="action_button" id="action_button" class="btn btn-warning" value="Submit" />
           </div>
         </form>		 
		 
		 
		 
		 
		 
		 
		 
		 
	</div>
			   <span id="form_result_footer"></span>  
<p>




















<div class="container">
  <div class="row">
    <div class="col-md-12 col-sm-6" >

	
	<div class="table-responsive">
	<h4> Transition </h4>
    <table id="patient_table"  class="table  table-success table-striped data-tablem">
        <thead>
            <tr>
<th>No</th>
			
			
		    
			<th>Plot Name</th>
			<th>Project Name</th>
			<th>Customer Name</th>
			<th> Gross Amount</th>
			<th>Discount</th>
			<th>Receiveable Amount </th>
			<th>Paid</th>
			<th>Type</th>
			<th>Comment</th>
			<th>Entity by</th>
			<th>Action</th>
				
			
				
    
				
				
			     
             
                
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
	
    
 $(".test_component_class").select2();   
  $("#order_no").select2();   
  $("#project_name").select2();  
  $("#customer").select2();
  $("#plot_name").select2();
$("#accountant").select2();

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
	
        ajax: "{{ route('plotsellduepayment.index') }}",
	
        columns: [
		
		 
		 
		  {data: 'DT_RowIndex', name: 'DT_RowIndex'},

			  {data: 'plotname', name: 'plotname'},
			 {data: 'projectname', name: 'projectname'},
			 {data: 'customer', name: 'customer'},
			 
			  {data: 'amount', name: 'amount'},
			  {data: 'discount', name: 'discount'},
			  {data: 'amountafterdiscount', name: 'amountafterdiscount'},
			  {data: 'paid', name: 'paid'},
			  {data: 'type', name: 'type'},
            {data: 'comment', name: 'comment'},
			   {data: 'entryby', name: 'entryby'},
	
			 {data: 'action', name: 'action', orderable: false, searchable: false},

 

			    
           
        ]
    });


   fetch(); 
   
  ///////// show the modal//////////////////////////////////////////////////////////////////////////////// 
    $(document).on('click', '.create_record', function(){
		
		
		  $('#form_result').html('');
    $('.modal-title').text("Add New Record");
     $('#action_button').val("Add");
     $('#action').val("Add");
       $('#formModal').modal('show');

 
 });
 
 
 
 
 function fetchtestcomponent( id , customer_id )
 {
	   $.ajax({
   url:"plotsellduepayment/dropdownlist_fetch/"+id+"/"+ customer_id,
   dataType:"json",
   
   ////////////////////fetch data for dropdown menu 
success:function (response) {
		$("#plot_name").html("");
		var optionfortest = "<option  value='' >select one</option>"; 
						
					   $("#plot_name").append(optionfortest);
					
					
					
					
					                    var len = 0;
                    if (response.plot != null) {
                        len = response.plot.length;
						
                    }

                    if (len>0) {
                        for (var i = 0; i<len; i++) {
                             var id = response.plot[i].id;
                             var name = response.plot[i].plot.name;
					var due = response.plot[i].due;

                             var optionfortest = "<option  data-due='"+due+"'   value='"+id+"'>"+name+"</option>"; 
							

                             $("#plot_name").append(optionfortest);
                        }
                    }
}
	   });					
	 
	 
 }
 
 
 
 
 
 
 
 function fetch()
 {
	 
  $.ajax({
   url:"plotsellduepayment/dropdownlistgeneral",
   dataType:"json",
   
   ////////////////////fetch data for dropdown menu 
success:function (response) {
	
	

	  $("#customer").html("");
	$("#project_name").html("");  
 $("#accountant").html("");  
	  
	

	  	  		var accountant = "<option  value='99999999999' >NA</option>"; 
						
					   $("#accountant").append(accountant);
					
					
					
					                    var len = 0;
                    if (response.accountant != null) {
                        len = response.accountant.length;
                    }

                    if (len>0) {
                        for (var i = 0; i<len; i++) {
                             var id = response.accountant[i].id;
                             var name = response.accountant[i].name;
							
							

                             var accountant = "<option     data-name='"+name+"'   data-id='"+id+"'  value='"+id+"'>"+name+"</option>"; 
							

                             $("#accountant").append(accountant);
                        }
                    }
















	

	  
	  
	  	  		var customer = "<option  value='' ></option>"; 
						
					   $("#customer").append(customer);
					
					
					
					                    var len = 0;
                    if (response.customer != null) {
                        len = response.customer.length;
                    }

                    if (len>0) {
                        for (var i = 0; i<len; i++) {
                             var id = response.customer[i].id;
                             var name = response.customer[i].name;
							var due = response.customer[i].presentduebalance;
							

                             var customer = "<option  data-due='"+due+"'    data-name='"+name+"'   data-id='"+id+"'  value='"+id+"'>"+name+"</option>"; 
							

                             $("#customer").append(customer);
                        }
                    }
	  
	  
	  
	  
	  
	  
	  
	  		var project = "<option  value='' >select one</option>"; 
						
					   $("#project_name").append(project);
					
					
					
					                    var len = 0;
                    if (response.project != null) {
                        len = response.project.length;
                    }

                    if (len>0) {
                        for (var i = 0; i<len; i++) {
                             var id = response.project[i].id;
                             var name = response.project[i].name;
						

							
							
                             var project = "<option        data-id='"+id+"'  value='"+id+"'>"+name+"</option>"; 
							

                             $("#project_name").append(project);
                        }
                    }
	  
	  
	  

	

	

					
                }
				
				
	//////////////////////////////////////////////////////////////////////////////
  })
	 
	 
 }
 
 
 

 
 
 
 
 
 
 
 
 
 
  ///////////////////////////////// insert value related to the patient dynamically  /////////////////////

$('.sample_form_for_doctorappointment').delegate('.customer , .project_name','change',function(){
  

var id = $('.project_name option:selected').attr("data-id");
	
var customer_due = $('.customer option:selected').attr("data-due");	
var customer_id = $('.customer option:selected').attr("data-id");
	
	
	
	console.log(id, customer_id);
	
$("#customerdue").val(customer_due);	
fetchtestcomponent(id,customer_id );

});
 
 

 
 $('.sample_form_for_doctorappointment').delegate('.plot_name','change',function(){
  

	 var plot_due = $('.plot_name option:selected').attr("data-due");
	$('#plotdue').val(plot_due); 

});
 
 
 
 

 
 
  ///////////////////////////////// insert value related to the Test_Component  /////////////////////Test Name




$('.sample_form_for_doctorappointment').delegate('#grossamount,#discount','change',function(){
	
	
	
var grossamount =  $("#grossamount").val();

var discount = $("#discount").val();

var receiveableamount = grossamount - 	discount;





$("#receiveableamount").val(receiveableamount);





});
 
 
 
 


 
 

 



 
 
 
 
 
 
 
 
   
   
  /////////////////////////////////ADD Data //////////////////////////// 
   
   

$('#sample_form').on('submit', function(event){
  event.preventDefault();
  if($('#action').val() == 'Add')
  {
  
  

  
   $.ajax({
    url:"{{ route('plotsellduepayment.store') }}",
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
	  $('#form_resultfooter').html(html);
	  $('#form_result').fadeIn();
	    $('#form_resultfooter').fadeIn();
	  $('#form_result').delay(1500).fadeOut();
	  $('#form_resultfooter').delay(1500).fadeOut();
	  fetch();
   $("#products_table tr:gt(1)").remove(); // remove all row whose index is greater than 1
    $(".test_component_class").select2();
    }
   })
  
  
  
  }

  if($('#action').val() == "Edit")
  {
   $.ajax({
    url:"{{ route('plotsellduepayment.updateduepayment') }}",
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
   url:"/plotsell/"+id+"/edit",
   dataType:"json",
   success:function(html){
	   
	   
	   
    $('#Startdate').val(html.data.starting);
    $('#releasedata').val(html.data.ending);

	
	var len = html.cabinedata.length;
	console.log(len);
	var presentcabinedata = html.data.cabinelist_id;

	
	
		                        for (var i = 0; i<len; i++) {
								
								if ( presentcabinedata == html.cabinedata[i].id  ) 
								{
									var id = html.cabinedata[i].id;
                             var name = html.cabinedata[i].serial_no;

                             var option = "<option value='"+id+"'>"+name+"</option>"; 

                             $("#cabine_list").append(option);
								}
                             
                        }
						
						
							                        for (var i = 0; i<len; i++) {
								
								if ( presentcabinedata != html.cabinedata[i].id  ) 
								{
									var id = html.cabinedata[i].id;
                             var name = html.cabinedata[i].serial_no;

                             var option = "<option value='"+id+"'>"+name+"</option>"; 

                             $("#cabine_list").append(option);
								}
                             
                        }
						
				
		/////////////////////////  fetch for patientlist 				
		
						var len = html.patientdata.length;
	
	var presentpatientdata = html.data.patient_id;

	
	
		                        for (var i = 0; i<len; i++) {
								console.log('A' );
								if ( presentpatientdata == html.patientdata[i].id  ) 
								{
									var id = html.patientdata[i].id;
                             var name = html.patientdata[i].name;

                             var optionforpatient = "<option value='"+id+"'>"+id+"</option>"; 
                              console.log(option);
                             $("#patientlist").append(optionforpatient);
								}
                             
                        }
						
						
							                        for (var i = 0; i<len; i++) {
								
								if ( presentpatientdata != html.patientdata[i].id  ) 
								{
									var id = html.patientdata[i].id;
                             var name = html.patientdata[i].name;

                             var optionforpatient = "<option value='"+id+"'>"+id+"</option>"; 

                             $("#patientlist").append(optionforpatient);
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
   url:"plotsellduepayment/destroy/"+user_id,
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