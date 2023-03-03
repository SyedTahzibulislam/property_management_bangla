

@extends('layout.main')

@section('content')



<style>
.modal-lg {
    max-width: 90% !important;

}



tr:nth-child(even) {background-color: #f2f2f2;}
</style>
 
 






</head>






<body id="bodysellcorner">


    @if ($message = Session::get('success'))
        <div style="background-color:red;" class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
	
	
	
	
	
	
		<div  class="container" style="background-color:#EEE8AA; "  >
		<h2>Money is Given/ returned back to/from Project </h2>
  <span id="form_result"></span>
	
		<form method="post" action="{{ route('moneyexchangeacc.store') }}"   id="sample_form" class="form-horizontal" enctype="multipart/form-data">
          @csrf
		   
		   <div class="row">
		
           

			 
			 
			 
			 
	           
            <div class="col-4">
	       Accountant Name  :   <select id="accountant"  class="form-control "  name="accountant"     style='width: 270px;'>  
           
			
			</select>
             </div>		 
			 
			 
			 
			 
			 

			 
			 </div>
			
			 
			 

			 
			 <div id="formhide">


			 
			 
			 
			 
			
	
		   
		   

		   
	
		   
		  
   
	
	 <input type="hidden" id="statusvalue" name="statusvalue" class="statusvalue" >
	

		   
	<p>	   
  <div class="row">
 				     <div class="col-6">
      
  Amount :  <input type="text" name="amount" id="amount" autocomplete="off"    class="form-control  amount" required />
		  
    </div>
	


	
	
	    <div class="col-6">
       
comment:  <textarea class="form-control"  name="comment" rows="3"></textarea>
		  
    </div>
	

  </div>
  
  <p>
 <div class="row">


	    <div class="col-6">
       
<input type="radio" id="MOney_given" name="MOney_given_taken" value="1">
<label for="html">Money is given to the Accountant </label><br>
<input type="radio" id="Money_taken" name="MOney_given_taken" value="2">
<label for="css">Money is returned back from the Accountant </label><br>

		  
    </div>




<div class="col-6">

Date:  <input type="date"   required id="datePicker" name="Date_of_Transition" class="form-control" />

</div>







</div> 

		   
		   
	
		   	
			
	
        
   
           <br />
           <div class="form-group" align="center">
            <input type="hidden" name="action" id="action"  value="Add" />
            <input type="hidden" name="hidden_id" id="hidden_id" />
            <input type="submit" name="action_button" id="action_button" class="btn btn-warning" value="Add" />
           </div>
         </form>
	</div>
			   <span id="form_result_footer"></span>  
<p>



</div>	

	

	<b>Money Exchange Transition: </b>
		<div class="table-responsive">
    <table id="patient_table"  class="table  table-success table-striped data-tablem">
        <thead>
            <tr>
	
			<th>Serial NO.</th>
			<th>Accountant.</th>
		
              
				
				<th>Amount</th>
			
				
			<th>Type</th>
		

<th>Entryby</th>			

<th>Date</th>		
		     
 <th>Action</th>            
               
            </tr>
        </thead>
        <tbody   >

        </tbody>
    </table>
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








 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>  


<script type="text/javascript">





$(document).ready(function(){
	
	
	
	//////////////////////////// Show record 

    var table = $('#patient_table').DataTable({
		
	
		
        processing: true,
        serverSide: true,
		responsive: true,
	
        ajax: "{{ route('moneyexchangeacc.index') }}",
        columns: [
		
		 {data: 'DT_RowIndex', name: 'DT_RowIndex'},
		 
		 
		
            
			
			
			{data: 'id', name: 'id'},
            {data: 'account', name: 'account'},

			  {data: 'amount', name: 'amount'},
 
	  {data: 'type', name: 'type'},

		
               {data: 'created', name: 'created'}, 
			  
			    {data: 'action', name: 'action'}, 
        ]
    });


	
	
	
	
	
 $("#project").select2();	
 
 
 
 	Date.prototype.toDateInputValue = (function() {
    var local = new Date(this);
    local.setMinutes(this.getMinutes() - this.getTimezoneOffset());
    return local.toJSON().slice(0,10);
});
	$('#datePicker').val(new Date().toDateInputValue());
	
	
	
/////////////////////////////// Replace non deimal number 
/////////////////////////////// Replace non deimal number 
$('.addmoreproduct').delegate('.numbers','change',function(){


    this.value = this.value.replace(/[^0-9\.]/g,'');
});	
	
fetch();





 $(window).keydown(function(event){
    if(event.keyCode == 13) {
      event.preventDefault();
      return false;
    }
  });

        var allFields = document.querySelectorAll(".form-control");

        for (var i = 0; i < allFields.length; i++) {

            allFields[i].addEventListener("keyup", function(event) {

                if (  (event.keyCode === 13) || (event.keyCode === 40) ) {
                    console.log('Enter clicked')
                    event.preventDefault();
                    if (this.parentElement.nextElementSibling.querySelector('input')) {
                        this.parentElement.nextElementSibling.querySelector('input').focus();
                    }
                }
				
				
				                if (event.keyCode === 38) {
                    
                    event.preventDefault();
                    if (this.parentElement.previousElementSibling.querySelector('input')) {
                        this.parentElement.previousElementSibling.querySelector('input').focus();
                    }
                }
				
            });

        }










///////////////////////////////
	

	
	
  $("#accountant").select2();
  

	  $("#supplier_id").select2();
	    $('.medicine_name').select2();
		 

       $("#cusname").hide();
	  $("#cusmobile").hide();


  
  
  
 
  
  
  





    $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
    });
	
                     

function fetch()
{

 $.ajax({
   url:"{{ route('moneyexchangeacc.dropdownlist') }}",
   dataType:"json",
   
   ////////////////////fetch data for dropdown menu 
success:function (response) {
	
	   ////////////////////fetch data for Customer dropdown menu ////////////////////////////
	   
	      $("#accountant").html("");

					
		




var optionforcustomer = "<option value=''></option>";                   
  $("#accountant").append(optionforcustomer);

				   var len = 0;
                    if (response.account != null) {
                        len = response.account.length;
                    }

                    if (len>0) {
                        for (var i = 0; i<len; i++) {
                             var id = response.account[i].id;
                             var name = response.account[i].name;

                              
                           
							
							  
							  
							  var optionforcustomer = "<option          value='"+id+"'>"+name+"</option>"; 
							  

							

                            
							  $("#accountant").append(optionforcustomer);
                        }
                    }




		
					
			

               





			   }
				
				
	//////////////////////////////////////////////////////////////////////////////
  })

 	
	
}





 

// // if patient is admitted patient then no discount from here 

$('#sample_form').delegate('#supplier_id','change',function(){


 var presentdue = $('#supplier_id option:selected').attr("data-presentduebalance");
 
 var val = $('#supplier_id option:selected').attr("data-val");

console.log(presentdue);
	
		$('#balance').val(presentdue);
		
totalamount();

});


























$('#sample_form').delegate('#percentofdicountontaotal, #grossamount','change',function(){





totalamount();




});


/////////////////////////////////////////////////// calculate total amount  /////////////////////////////////////////

function totalamount(){
	

	var percentageofdiscount= parseFloat($('#percentofdicountontaotal').val());
var grossamount= 	parseFloat($('#grossamount').val());

var discount = grossamount *(percentageofdiscount/100);
var receiveableamount = grossamount - discount;

$('#discountatend').val(discount);
$('#paid').val(receiveableamount);	  
	
	  
	  

	
}




















  $("#percentofdicountontaotal").change(function(){
     this.value = this.value.replace(/[^0-9\.]/g,'');
	 totalamount();


  });













  /////////////////////////////////ADD Data //////////////////////////// 
   
   

$('#sample_form').on('submit', function(event){
  event.preventDefault();
  if($('#action').val() == 'Add')
  {
	    $('#action_button').attr("disabled", true);
   $.ajax({
    url:"{{ route('moneyexchangeacc.store') }}",
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
	    $('#action_button').attr("disabled", false);
		$('#datePicker').val(new Date().toDateInputValue());
     }
	 
	      if(data.error)
     {
      html = '<div class="alert alert-danger">' + data.error + '</div>';
      $('#sample_form')[0].reset();
      $('#patient_table').DataTable().ajax.reload();
     }
	 
$('#form_result').html(html);

$('#form_result').fadeIn();
$('#form_result').delay(3000).fadeOut();

$('#form_result_footer').html(html);

$('#form_result_footer').fadeIn();
$('#form_result_footer').delay(3000).fadeOut();



fetch();


 $("#products_table tr:gt(1)").remove();
 
 //remover por select2 dite hobe 
 $('.medicine_name').select2();
	
	 
	 
	 
	 
    }
   })
  }

 
 
 
 
 });
 







 


 var user_id;

 $(document).on('click', '.delete', function(){
  user_id = $(this).attr('id');
  $('#confirmModal').modal('show');
 });

 $('#ok_button').click(function(){
  $.ajax({

	  url:"moneyexchangeacc/destroy/"+user_id,
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
		   fetch();
   }
  })
 });





});
</script>
	  
</body>

@stop