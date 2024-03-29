

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
		<h2>প্রজেক্টে সুপারভাইজার এসাইন করেন :</h2>
  <span id="form_result"></span>
	
		<form method="post" action="{{ route('projectsupervisor.store') }}"   id="sample_form" class="form-horizontal" enctype="multipart/form-data">
          @csrf
		   
		   
		 
       
           
<div class="row">
		  <div class="col-6"> সুপার ভাইজার :
	        <select id="supervisor_Id"  class="form-control "  name="supervisor_Id"  required   style='width: 270px;'>  
           
			
			</select>
             </div>
			 


		   <div class="col-6"> প্রজেক্ট :
	        <select id="project_id"  class="form-control "  name="project_id"  required   style='width: 270px;'>  
           
			
			</select>
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

	

	
		<div class="table-responsive">
    <table id="patient_table"  class="table  table-success table-striped data-tablem">
        <thead>
            <tr>
	
		
			<th>অর্ডার নং .</th>
		
                <th> প্রজেক্ট  </th>
				
				<th>সুপার ভাইজার </th>
		     
 <th>একসন </th>            
               
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
	
	
	
	
	

	
	
	
	
	
	
	
	
	//////////////////////////// Show record 

    var table = $('#patient_table').DataTable({
		
	
		
        processing: true,
        serverSide: true,
		responsive: true,
	
        ajax: "{{ route('projectsupervisor.index') }}",
        columns: [
		

		 
		 
		
            
			
			
			{data: 'id', name: 'id'},
            {data: 'project_name', name: 'project_name'},

 {data: 'project_supervisor', name: 'project_supervisor'},


			    {data: 'action', name: 'action'}, 
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









	///// clear modal data after close it 
$(".modal").on("hidden.bs.modal", function(){
    $("#category").html("");
	
	  $(".medicine_name").val("");
	   $("#child").html("");

   $(".customer_id").html("");
   $(".unit_price").val(0);
  $(".quantity").val('');
  $(".vat").val(0);   
 $(".discount").val(0);   
  $(".paid").val(0); 
   $(".due").val(0); 
    $(".adjust").val(0); 
	$(".amount").val(0); 
	$(".totalamount").val(0); 
  



 $("#products_table tr:gt(1)").remove(); // remove all row whose index is greater than 1



 
 
  
	
 

	

});
///////////////////////////////
	

	
	
  $("#category").select2();
  
  $("#supervisor_Id").select2();
    $("#project_id").select2();
	


  
  
  
    $("#cid").click(function(){
     $("#cusname").hide();
	  $("#cusmobile").hide();
    $("#cusid").show();

  });
  
  
    $("#cname").click(function(){

	  $("#cusmobile").hide();
    $("#cusid").hide();
	$("#cusname").show();

  });
  
  
      $("#cmobile").click(function(){

    $("#cusid").hide();
	$("#cusname").hide();
	$("#cusmobile").show();

  });
  
  
  





    $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
    });
	
                     

function fetch()
{

 $.ajax({
   url:"projectsupervisor/dropdownlist",
   dataType:"json",
   
   ////////////////////fetch data for dropdown menu 
success:function (response) {
	
	   ////////////////////fetch data for Customer dropdown menu ////////////////////////////
	    $("#supervisor_Id").html("");
	   $("#project_id").html("");   
var optionforcustomer = "<option value=''></option>";                   
  $("#supervisor_Id").append(optionforcustomer);

				   var len = 0;
                    if (response.superviser != null) {
                        len = response.superviser.length;
                    }

                    if (len>0) {
						
						
                        for (var i = 0; i<len; i++) {
                             var id = response.superviser[i].id;
                             var name = response.superviser[i].name;

							
							  
							  
							  var optionforcustomer = "<option  data-val='"+id+"'    value='"+id+"'>"+name+"</option>"; 
							  

							

                            
							  $("#supervisor_Id").append(optionforcustomer);
                        }
                    }
					

	
	
	
	
	
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

							
							  
							  
							  var optionforcustomer = "<option  data-val='"+id+"'    value='"+id+"'>"+name+"</option>"; 
							  

							

                            
							  $("#project_id").append(optionforcustomer);
                        }
                    }	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	


			   }
				
				
	//////////////////////////////////////////////////////////////////////////////
  })

 	
	
}



function refresh(){
	
$('#sample_form')[0].reset();

fetch();
$("#products_table tr:gt(1)").remove();

 $('.medicine_name').select2();	
 $('.unit').select2();		
}


   ///////// show the modal//////////////////////////////////////////////////////////////////////////////// 
    $(document).on('click', '.create_record', function(){
		  $('#form_result').html('');
    $('.modal-title').text("Add New Record");
     $('#action_button').val("Add");
     $('#action').val("Add");
       $('#formModal').modal('show');
 

 



 

 
 
 
 
 
 
 
 
 
 
 
 
 
 });


// // if patient is admitted patient then no discount from here 

$('#sample_form').delegate('#customer_id','change',function(){

 var duelimit = $('#customer_id option:selected').attr("data-duelimit");
 var presentdue = $('#customer_id option:selected').attr("data-presentduebalance");
 var customercode = $('#customer_id option:selected').attr("data-customercode"); 
 var val = $('#customer_id option:selected').attr("data-val");


	$('#maximumduelimit').val(duelimit);
		$('#balance').val(presentdue);
		$('#customercode').val(customercode);
totalamount();

});















$('.addmoreproduct').delegate('.unit','change',function(){
	
	var tr= $(this).parent().parent();
	
	var id= tr.find('.unit option:selected').val();
	  
	var mid= tr.find('.medicine_name option:selected').val();
	


		   $.ajax({
   url:"producttransition/dropdowndynamic/"+id+"/"+mid,
   dataType:"json",
   
   ////////////////////fetch data for dropdown menu 
success:function (response) {
	
				var unitprice = response.unitprice; 
		
tr.find('.unit_price').val(unitprice);		
					
	
var stock= tr.find('.medicine_name option:selected').attr("data-stock");
	  

	
	

	tr.find('.stock').val(stock);
	
	
	var price = parseFloat(tr.find('.unit_price').val()); // 2y bar price neya hoyeche karon jodi pore user pirce poriboron kore



var qun = parseFloat(tr.find(".quantity").val());











var discount = tr.find(".discount").val();
var vat = tr.find(".vat").val();



var total = Number(price) * Number(qun);

//////////////////////// After Discount///////////////////////
var totaldiscount=(total * ( Number(discount)/100));
total= total- (total * ( Number(discount)/100));
tr.find('.totaldiscount').val(totaldiscount);

////////////////////////// After Adding Vat ////////////////////
var vattk = total * ( Number(vat)/100);
tr.find('.vattk').val(vattk);

total= total+ (total * ( Number(vat)/100));
	
		tr.find('.amount').val(total);
tr.find('.adjust').val(total);
	totalamount();




	

}
	   });








	


});















///////////////////////////////// insert value in unit price /////////////////////

$('.addmoreproduct').delegate('.medicine_name','change',function(){
	
	var tr= $(this).parent().parent();
	
	var stock= tr.find('.medicine_name option:selected').attr("data-stock");
	
	
	var id= tr.find('.medicine_name option:selected').val();
	console.log(id);

		   $.ajax({
   url:"producttransition/fetchunit/"+id,
   dataType:"json",
   
   ////////////////////fetch data for dropdown menu 
success:function (response) {
				tr.find('.unit').html("");
				console.log("AAA");	
					var optionforunit = "<option  ></option>"; 
               	tr.find('.unit').append(optionforunit);
					
					
					///////////////////////   set dynamic select option values from Database ///////////////////
					
					
					                    var len = 0;
                    if (response.unit != null) {
                        len = response.unit.length;
					
                    }

                    if (len>0) {
                        for (var i = 0; i<len; i++) {
                             var id = response.unit[i].unitcoversion.id;
                             var name = response.unit[i].unitcoversion.name;
							 

                             
				
							 var optionforunit = "<option    value='"+id+"'>"+name+"</option>"; 
							 /////////////////////////////////////////////////////////////
  

                             tr.find('.unit').append(optionforunit);
							  
                        }
                    }
	

}
	   });













		var price = parseFloat(tr.find('.unit_price').val());
	
	tr.find('.unit_price').val(price);
	tr.find('.stock').val(stock);
	
	
	var price = parseFloat(tr.find('.unit_price').val()); // 2y bar price neya hoyeche karon jodi pore user pirce poriboron kore
var qun = parseFloat(tr.find(".quantity").val());











var discount = tr.find(".discount").val();
var vat = tr.find(".vat").val();



var total = Number(price) * Number(qun);

//////////////////////// After Discount///////////////////////
var totaldiscount=(total * ( Number(discount)/100));
total= total- (total * ( Number(discount)/100));
tr.find('.totaldiscount').val(totaldiscount);

////////////////////////// After Adding Vat ////////////////////
var vattk = total * ( Number(vat)/100);
tr.find('.vattk').val(vattk);

total= total+ (total * ( Number(vat)/100));
	
		tr.find('.amount').val(total);
tr.find('.adjust').val(total);
	
	totalamount();
	







});


////////////////////////////////////////keyup//////////////////////////////





$('.addmoreproduct').delegate('.unit_price, .quantity, .discount ,.vat','change',function(){



	var tr= $(this).parent().parent();
	var price = parseFloat(tr.find('.unit_price').val());
var qun = parseFloat(tr.find(".quantity").val());

var discount = (tr.find(".discount").val());
var vat = (tr.find(".vat").val());

var adjust = (tr.find(".adjust").val());
var stock =parseFloat(tr.find('.stock').val());
var productname= tr.find('.medicine_name option:selected').html();



	
calculationforinputfield();	




function calculationforinputfield(){

qun = tr.find(".quantity").val();

var total = Number(price) * Number(qun);
var grossprice = total;
//////////////////
 var totaldiscount = ((total * ( Number(discount)/100)));
 tr.find('.totaldiscount').val(totaldiscount);
//////////////////////// After Discount///////////////////////
total= total- totaldiscount;


////////////////////////// After Adding Vat ////////////////////
var vattk = total * ( Number(vat)/100);
tr.find('.vattk').val(vattk);

total= total+ (total * ( Number(vat)/100));

total=total.toFixed(2);
	console.log(total);
	
		tr.find('.amount').val(grossprice);
		tr.find('.adjust').val(total);
totalamount();
}



});











//////////////////////////////////////////////// Adjusted Price //////////////////


$('.addmoreproduct').delegate('.adjust','change',function(){

var tr= $(this).parent().parent();
var adjust = parseFloat( tr.find(".adjust").val());

var total = parseFloat(tr.find('.amount').val());
var vat =parseFloat( tr.find(".vat").val());

var price = parseFloat(tr.find('.unit_price').val());
var qun = parseFloat(tr.find(".quantity").val());
var discount = parseFloat(tr.find(".discount").val());



var netprice_before_adding_vat_and_discount  = parseFloat(price*qun);

 var netprice_after_initial_discount = ( netprice_before_adding_vat_and_discount- (netprice_before_adding_vat_and_discount * (discount/100)))

var amount_discount = parseFloat(  netprice_before_adding_vat_and_discount *  (discount/100 ));



var adjust_minus_price_after_initial_discount_and_vat = parseFloat(total-adjust);




var hundr = 100; 
parseFloat(hundr);


var vat_that_taken_on_adjust = parseFloat((vat * adjust)/parseFloat ( hundr+vat ) ); //new vat 



tr.find('.vattk').val(vat_that_taken_on_adjust.toFixed(4));

var price_after_additional_discount_and_excluding_vat = parseFloat(adjust-vat_that_taken_on_adjust);




var amount_of_additional_discount = parseFloat( 
   netprice_after_initial_discount  - price_after_additional_discount_and_excluding_vat );
// new discount 



var amount_of_discount_that_means_addition_of_discount_that_was_given_in_two_stage = parseFloat( amount_discount + amount_of_additional_discount ); 





tr.find('.totaldiscount').val(amount_of_discount_that_means_addition_of_discount_that_was_given_in_two_stage.toFixed(4));



totalamount();







});

















$('.form-horizontal').delegate('.totalamount','keyup',function(){

var receiveableamount =  $(".totalamount").val();

var grossamount =  $(".grossamount").val();

var paid =  $(".paid").val();
var discount = grossamount - receiveableamount;

var discountpercentage = (100 * ( discount / grossamount  )).toFixed(2);

var due = receiveableamount - paid;



$(".percentofdicountontaotal").val(discountpercentage);

$(".due").val(due);

$(".discountatend").val(discount);



});























/////////////////////////////////////////////////// calculate total amount  /////////////////////////////////////////

function totalamount(){
	
	
	var percentage_discount_on_total = $('#percentofdicountontaotal').val();
	
		if ( (percentage_discount_on_total == 0 ) || (percentage_discount_on_total == '' ) )
	{
		$('#percentofdicountontaotal').val(0);
	var totalamount =0;
	$('.adjust').each(function(i,e){
		var amount = $(this).val()-0;
		totalamount+=amount;
		
	});
	
	var grosstotalamount=0
		$('.amount').each(function(i,e){
		var amountgross = $(this).val()-0;
		
		grosstotalamount+=amountgross;
	
	});
var a = grosstotalamount - totalamount;
	$("#discountatend").val(a);
	$("#grossamount").val(grosstotalamount);
	$("#totalamount").val(totalamount);
	$('#dicountontaotal').val(0);
}
else 
{
	
	var totalamount =0;
	$('.amount').each(function(i,e){
		var amount = $(this).val()-0;
		console.log(amount);
		totalamount+=amount;
	
	});	
	
	var b = totalamount;
		var a = (totalamount * (percentage_discount_on_total/100));
	  totalamount = totalamount - a ;
	  $('#dicountontaotal').val(a);
		$("#totalamount").val(totalamount);
	$("#grossamount").val(b);
	
	$("#discountatend").val(a);
}	
	

	  	var paid = $("#paid").val();
	var due = totalamount- Number(paid);
	
	var maxduelmt=	parseFloat($('#maximumduelimit').val());
	var presentdue= 	parseFloat($('#balance').val());
	
	var currentdue= presentdue + due;


 $("#due_at_the_time_of_selling").val(due);
	  
	  

	
}




















  $("#percentofdicountontaotal").change(function(){
     this.value = this.value.replace(/[^0-9\.]/g,'');
	 totalamount();


  });








          $("#paid").change(function(){
   

var receiveableamnt = $(".totalamount").val();
var paid = $("#paid").val();
var currentdue = receiveableamnt - paid;

$(".due").val(currentdue);




  });


/////////////////////////////////////// Remove row ////////////////////////


$('.addmoreproduct').delegate('.remove','click',function(){ 
var rowCount = $('table#products_table tr:last').index() + 1; // find out the length of the row 
console.log(rowCount);

 
 
   var rowindex = $(this).closest('tr').index();  // find out the index number of the row 
    
 if (rowindex > 0 )
 {
$(this).parent().parent().remove();
  totalamount();
 }

 });



 /////////////////////////////////ADD Data //////////////////////////// 
   
   

$('#sample_form').on('submit', function(event){
  event.preventDefault();
  if($('#action').val() == 'Add')
  {
   $.ajax({
    url:"{{ route('projectsupervisor.store') }}",
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
	 
	      if(data.error)
     {
      html = '<div class="alert alert-danger">' + data.error + '</div>';
      $('#sample_form')[0].reset();
      $('#patient_table').DataTable().ajax.reload();
     }
	 
$('#form_result').html(html);

$('#form_result').fadeIn();
$('#form_result').delay(1500).fadeOut();

$('#form_result_footer').html(html);

$('#form_result_footer').fadeIn();
$('#form_result_footer').delay(1500).fadeOut();



fetch();
refresh();

 $("#products_table tr:gt(1)").remove();
 
 //remover por select2 dite hobe 
 $('.medicine_name').select2();
	
	 
	 
	 
	 
    }
   })
  }

  if($('#action').val() == "Edit")
  {
   $.ajax({
    url:"{{ route('projectsupervisor.update') }}",
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
 









 /////////////////////////////////////// Dynamically Add New row and Add New select2 for dynamically added new medicine name  ////////////////////////
 

  let row_number = 1;
    $("#add_row").click(function(e){
		
		
		      e.preventDefault();
      let new_row_number = row_number - 1;
	  
	  	   $latest_tr  = $('#product0');
   
     $latest_tr.find(".medicine_name").each(function(index)
    {
        $(this).select2('destroy');
    }); 
	
	     $latest_tr.find(".unit").each(function(index)
    {
        $(this).select2('destroy');
    }); 
	  
      $('#product' + row_number).html($('#product0' ).html()).find('td:first-child');
	  
	   

	  
      $('.addmoreproduct').append('<tr id="product' + (row_number + 1) + '"></tr>');
      row_number++;
     

 
     
    
  $('.medicine_name').select2(); 
 
    $('.unit').select2();   
	
	
	});
 
 

//////////////////////////////////////// code to read selected table row cell data (values) to print invoice


    
    $("#patient_table").on('click','.btnSelect',function(){
		
	


		
		
         // get the current row
         var currentRow=$(this).closest("tr"); 
		 
		 
		 	var e= currentRow.find("td .n").text();
		console.log(e);
		 
		          var order_no =currentRow.find("td:eq(0)").text();
         
         var seller_name =currentRow.find("td:eq(1)").text();
		 // get current row 2nd  TD value
         var patient_name =currentRow.find("td:eq(2)").text(); 
		 var paid =currentRow.find("td:eq(3)").text(); 
		 var due =currentRow.find("td:eq(4)").text(); 
		 var date =currentRow.find("td:eq(5)").text();             
		   var totalinvoiceMPR =currentRow.find("td:eq(6)").text(); 
		  var totalinvoicediscount =currentRow.find("td:eq(7)").text(); 
		  var totalvoicevat =currentRow.find("td:eq(8)").text(); 
		   var totalinvoice_total_amount_including_vat_discount  =currentRow.find("td:eq(9)").text(); 
		 
		 
		
         var producttable=currentRow.find("td:eq(11)").html(); // get current row 8th TD
		          
		        
				 
				 
					
					
				
				
					
					
					
         
		 $('#invoicepatientname').html(patient_name);
		 $('#invoicepatientdue').html(due);
		 $('#invoicevat').html(totalvoicevat);
		 $('#invoicepatienttotal').html(totalinvoice_total_amount_including_vat_discount);
		 $('#invoicepatientdiscount').html(totalinvoicediscount);
		  $('#invoicepatientdate').html(date);
		  $('#invoicepatientorderno').html(order_no);
		   $('#invoicepatientseller').html(seller_name);
		     $('#invoicepatientmpr').html(totalinvoiceMPR);
		   
	  

		 $('#m').html(producttable);
       
    });


 var user_id;

 $(document).on('click', '.delete', function(){
  user_id = $(this).attr('id');
  $('#confirmModal').modal('show');
 });

 $('#ok_button').click(function(){
  $.ajax({
   url:"projectsupervisor/destroy/"+user_id,
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