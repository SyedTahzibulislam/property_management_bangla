

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
		<h2>কোম্পানি/ সাপ্লাইয়ারে টাকা শোধ/ টাকা ফেরত নেয়া  </h2>
  <span id="form_result"></span>
	
		<form method="post" action="{{ route('productcompanduetra.store') }}"   id="sample_form" class="form-horizontal" enctype="multipart/form-data">
          @csrf
		   
		   <div class="row">
		
           
            <div class="col-6">
	   কোম্পানি/ সাপ্লাইয়ার * :       <select id="company_Id"  class="form-control "  name="company_Id"  required   style="width:170px;">  
           
			
			</select>
             </div>
			 
			
	            <div class="col-6">
	   প্রজেক্ট * :    <select id="project_id"  class="form-control "  name="project_id"  required   style="width:170px;">  
            
			
			</select>
             </div>		 
			 

			 
			 </div>
			
	<p>


	<div class="row">

				 			 <div class="col-6">এডজাস্ট *<br>
			 <input type="radio"  name="adjusttype" value="1"  required >
<label for="html"> মালিকের ফান্ড   </label><br>
<input type="radio"  name="adjusttype" value="2"   required >
<label for="css"> একাউন্টেণ্ট ফান্ড  </label><br>
<input type="radio"  name="adjusttype" value="3"   required >
<label for="css">  প্রজেক্ট ফান্ড   </label><br>
			    
			 </div>	
			 
			 
			 
			 			 <div class="col-6"> টাইপ * <br>
			 <input type="radio"  name="type" value="2"  required >
<label for="html"> টাকা প্রদান    </label><br>
<input type="radio"  name="type" value="4"   required >
<label for="css"> টাকা গ্রহণ   </label><br>

			    
			 </div>
			 

</div>	
<p>

        <div class="row">
            <div class="col-6">
	   একাউন্টেন্ট   :    <select id="accountant"  class="form-control "  name="accountant"  required  style="width:170px;">  
           
			
			</select>
             </div>
			 
			 
            <div class="col-6">
	 সুপারভাইজার   :    <select id="supervisor"  class="form-control "  name="supervisor"  required  style="width:170px;">  
           
			
			</select>
             </div>			 
			 
	 
			 </div>	





<p>


	
			 
<div class="row">

				 <div class="col-6">
ডেট * :  <input type="date"  required id="datePicker" name="Date_of_Transition" class="form-control" />
</div>	



			



</div>			 
			 
			 
			 
			 
			 
			 
			 
			 
			 
			 
			 
			 
			 
			 
			 

			 
			 <div id="formhide">


			 
			 
			 
			 
			
	
		   
		   

		   
	
		   
		  
   
	
	 <input type="hidden" id="statusvalue" name="statusvalue" class="statusvalue" >
	

		   
	<p>	   
  <div class="row">
 			 <div class="col-4" >
			বর্তমান বাকিঃ   <input type="text"  value="0" name="balance" id="balance" class="form-control numbers  balance" required readonly  />
			 </div>
	


	
	
	    <div class="col-4">
       
বিবরণ :  <textarea class="form-control"  name="comment" rows="3"></textarea>
		  
    </div>
	

  </div>
  
  
  
  		     <div class="row">
			     <div class="col-4">
      
গ্রোস প্রাইস * :  <input type="text" name="grossamount" autocomplete="off" id="grossamount"    class="form-control  grossamount" required />
		  
    </div>
			 
   
 <input type="hidden" name="percentofdicountontaotal" id="percentofdicountontaotal"  value="0"  class="form-control  percentofdicountontaotal"  />
		  


	
	
      
 <input type="hidden" name="discountatend" id="discountatend"  value="0"  class="form-control  discountatend" readonly  />
		  
  
	
	
	
  </div>
  
  	<p>	   
  <div class="row">

    <div class="col-4">
 	   <input type="hidden" name="paid" id="paid"  value="0" autocomplete="off"  class="form-control numbers totalamount"  />
		  
    </div>
  </div>
  
  
  
  
  
  
  
  
  
  
  

  

 <input type="hidden" name="percentofdicountontaotal" id="percentofdicountontaotal"  value="0"  class="form-control  percentofdicountontaotal"  />
	  <input type="hidden" name="totalamount" id="totalamount"  value="0" autocomplete="off"  class="form-control numbers totalamount"  />	  
  
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

	

	
		<div class="table-responsive">
    <table id="patient_table"  class="table  table-success table-striped data-tablem">
        <thead>
            <tr>
	
			
			<th>অর্ডার নং </th>
		
                <th>নাম </th>
				
				<th>টাকার পরিমাণ </th>
                <th>প্রদান </th>
                <th>গ্রহণ </th>

			<th>কমেন্ট</th>
		
			

<th>ডেট</th>
<th> এডজাস্ট </th>		
<th>এন্টি </th>

<th>প্রজেক্ট<th>	
  	


 <th>. </th> 
     
           
               
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








 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>  


<script type="text/javascript">





$(document).ready(function(){
	
			Date.prototype.toDateInputValue = (function() {
    var local = new Date(this);
    local.setMinutes(this.getMinutes() - this.getTimezoneOffset());
    return local.toJSON().slice(0,10);
});
$('#datePicker').val(new Date().toDateInputValue());	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	//////////////////////////// Show record 

    var table = $('#patient_table').DataTable({
		
	
		
        processing: true,
        serverSide: true,
		responsive: true,
	
        ajax: "{{ route('productcompanduetra.index') }}",
        columns: [
		

			
			
			{data: 'id', name: 'id'},
            {data: 'companyname', name: 'companyname'},

			  {data: 'amount', name: 'amount'},
              
		  	  {data: 'credit', name: 'credit'},
                {data: 'debit', name: 'debit'},
	  {data: 'comment', name: 'comment'},


			
               {data: 'created', name: 'created'}, 
			   
			     {data: 'adjustby', name: 'adjustby'},
			     {data: 'entryby', name: 'User.name'},
                 {data: 'project', name: 'project'}, 

			    {data: 'action', name: 'action'}, 
	
        ],
        order: [
        [0, 'desc']
    ]

    });


	
	
	
	
	
	
	
	
	
	
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
	

	
	
  $("#category").select2();
   $("#project_id").select2();

	  $("#company_Id").select2();
	    $('.medicine_name').select2();
		$("#supervisor").select2();	 
		$("#accountant").select2();	
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
   url:"productcompanduetra/dropdownlist",
   dataType:"json",
   
   ////////////////////fetch data for dropdown menu 
success:function (response) {
	
	   ////////////////////fetch data for Customer dropdown menu ////////////////////////////
	    $("#company_Id").html("");
	   
var optionforcustomer = "<option value=''></option>";                   
  $("#company_Id").append(optionforcustomer);

				   var len = 0;
                    if (response.Productcompany != null) {
                        len = response.Productcompany.length;
                    }

                    if (len>0) {
                        for (var i = 0; i<len; i++) {
                             var id = response.Productcompany[i].id;
                             var name = response.Productcompany[i].name;

                              
                            var presentduebalance = response.Productcompany[i].due;
							
							  
							  
							  var optionforcustomer = "<option data-presentduebalance='"+presentduebalance+"' data-val='"+id+"'        value='"+id+"'>"+name+"</option>"; 
							  

							

                            
							  $("#company_Id").append(optionforcustomer);
                        }
                    }
					
		  ////////////////////fetch data for Medicine  dropdown menu ////////////////////////////			
					
			
	
        	 $("#project_id").html("");			
					
		var optionforcustomer = "<option value=''></option>";			
	$("#project_id").append(optionforcustomer);

				   var len = 0;
                    if (response.project != null) {
                        len = response.project.length;
                    }

                    if (len>0) {
                        for (var i = 0; i<len; i++) {
                             var id = response.project[i].id;
                             var name = response.project[i].name;
							
							  
							  
							  var optionforcustomer = "<option  data-val='"+id+"'     value='"+id+"'>"+name+"</option>"; 
							  

							

                            
							  $("#project_id").append(optionforcustomer);
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





 

// // if patient is admitted patient then no discount from here 

$('#sample_form').delegate('#company_Id','change',function(){


 var presentdue = $('#company_Id option:selected').attr("data-presentduebalance");
 
 var val = $('#company_Id option:selected').attr("data-val");

console.log(presentdue);
	
		$('#balance').val(convertToBangla(presentdue));
		
totalamount();

});


























$('#sample_form').delegate('#percentofdicountontaotal, #grossamount','change',function(){





totalamount();




});


/////////////////////////////////////////////////// calculate total amount  /////////////////////////////////////////

function totalamount(){
	

	var percentageofdiscount= parseFloat(convertToEnglish($('#percentofdicountontaotal').val()));
var grossamount= 	parseFloat(convertToEnglish($('#grossamount').val()));

var discount = grossamount *(percentageofdiscount/100);
var receiveableamount = grossamount - discount;

$('#discountatend').val(discount);
$('#paid').val(receiveableamount);	  
	
	  
	  

	
}




$('#sample_form').delegate('#paid','change',function(){


var grossamount= 	parseFloat(convertToEnglish($('#grossamount').val()));
var paid = parseFloat(convertToEnglish($('#paid').val()));
 var discount = grossamount - paid;
 
 var percentage_dis = ((discount/grossamount)*100).toFixed(2);
 
 $('#discountatend').val(discount);
$('#percentofdicountontaotal').val(percentage_dis);




});

















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
    url:"{{ route('productcompanduetra.store') }}",
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
   url:"productcompanduetra/destroy/"+user_id,
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