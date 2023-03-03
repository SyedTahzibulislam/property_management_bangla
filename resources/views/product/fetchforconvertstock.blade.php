

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
		<b> Product </b>: {{$product->name}}
		<br>
		<b> Stockk </b>: {{$product->stock}} KG/ Pieces
		
  <span id="form_result"></span>
	
		<form method="post" action="{{ route('producttransition.changegodowntosalepoint') }}"   id="sample_form" class="form-horizontal" enctype="multipart/form-data">
          @csrf
		   
		   
	


	
				 			 <div class="col-6">
			 <input type="radio"  name="type" value="1"  required >
<label for="html"> ক্রয় ইউনিট থেকে বিক্রয়  / ইউসেবল  ইউনিটে </label><br>
<input type="radio"  name="type" value="3"   required >
<label for="css"> বিক্রয়  / ইউসেবল ইউনিটকে ক্রয় ইউনিটে কনভার্ট করেন   </label><br>

			    
			 </div>

	




	   
	
			 <div id="formhide" class="table-responsive">
			
			 <table   class="table" id="products_table">
                <thead>
                    <tr>
                      
						<th>From Unit</th>
						<th>Stock</th>
						
                       <th> Transfering Quantity</th>
					<th>To Unit</th>
						
                    </tr>
                </thead>
                <tbody class="addmoreproduct">
                    <tr id="product0">

						
	
			 <td>
       <select id="unit"  class="form-control unit"  name="unit[]"  required   > 
<option value=""></option>	   
  @foreach($productpriceaccunit as $p)
  <option data-fromname="{{$p->unitcoversion->name}}" data-unitratefrom= "{{$p->unitcoversion->coversionamount}}"  data-stock="{{$p->stock}}" value="{{$p->unitcoversion_id}}">{{$p->unitcoversion->name}}</option>
 @endforeach
		</select>
                        </td>			
						
		 <input type="hidden"  name="productid" value="{{$product->id}}" required />				


						<td>
						  <input type="text" style="width:150px;" name="stock[]" autocomplete="off"  class="form-control  stock" required />
						</td>








						<td>
						  <input type="text" style="width:150px;" name="quan[]" autocomplete="off" id="quan" class="form-control numbers quan" required />
						</td>
						
					 <td>
       <select id="tounit"  class="form-control tounit"  name="tounit[]"  required   > 
<option value=""></option>	   
  @foreach($productpriceaccunit_sell as $ps)
  <option     data-toname="{{$ps->unitcoversion->name}}" data-unitrateto= "{{$ps->unitcoversion->coversionamount}}"   value="{{$ps->unitcoversion_id}}">{{$ps->unitcoversion->name}}</option>
 @endforeach
		</select>
                        </td>					
						
						

						<td>
						
						<a class="remove"  style="font-size:30px; color:red;"  href="#">  ×</a> 
						
						</td> 

					
	
						
						
                    </tr>
                    <tr id="product1"></tr>
                </tbody>
            </table>
			 
			 
			 
			 
			 
			 
			
		   <div id="child"> 
		   
		   </div>
		   
		   
		   <button type="button" id="add_row" class="btn btn-primary">ADD More Unit</button>
		   	


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

	

	

	
	








	
	
	</div>
</div>




<div id="confirmModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="closedelete" data-dismiss="modal">&times;</button>
                <h2 class="modal-title">Confirmation</h2>
            </div>
            <div class="modal-body">
                <h4 align="center" style="margin:0;">Are you sure you want to remove this data?</h4>
            </div>
            <div class="modal-footer">
             <button type="button" name="ok_button" id="ok_button" class="btn btn-danger">OK</button>
                <button type="button" class="btn btn-default closedelete" data-dismiss="modal">Cancel</button>
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
	
  $("#category").select2();
 $("#company").select2();
  $("#sellingunit").select2();
   $("#purchasingunit").select2();
    $("#stockunit").select2();
///// clear modal data after close it 
$(".modal").on("hidden.bs.modal", function(){
    $("#areacode").html("");
});



 $(window).keydown(function(event){
    if(event.keyCode == 13) {
      event.preventDefault();
      return false;
    }
  });

var $check = $(document).find('input[type="text"]');
jQuery("input").on('keyup', function(event) {
  
  
  if (  (event.keyCode === 13) || (event.keyCode === 40) ) {
   $check.eq($check.index(this) + 1).focus();
  }

               if (event.keyCode === 38) {
                    
           $check.eq($check.index(this) - 1).focus();
                }





});


     $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
    });
	










 $('.unit').select2();	



 $('.tounit').select2();


///////////////////////////////// insert value in unit price /////////////////////

$('.addmoreproduct').delegate('.unit, .tounit,  .quan','change',function(){
	
	var tr= $(this).parent().parent();
	

	
	
	var id= tr.find('.unit option:selected').val();
	var stock= tr.find('.unit option:selected').attr("data-stock");
	var fromunitrate = tr.find('.unit option:selected').attr("data-unitratefrom");

	var tounitrate = tr.find('.tounit option:selected').attr("data-unitrateto");

var to_name = tr.find('.tounit option:selected').attr("data-toname");

var from_name =  tr.find('.unit option:selected').attr("data-fromname");


tr.find('.stock').val(stock);
var qun = tr.find('.quan').val();

console.log(qun);
var remaining = ( qun * fromunitrate) % tounitrate;

if ( remaining > 0  )
{
	
alert("If "+qun+  " Unit of Product:"+from_name+ " change to the Product "+to_name+" then reminder is: "+ remaining );	
	
}







});

































 

 
 
 var user_id;

 $(document).on('click', '.delete', function(){
  user_id = $(this).attr('id');
  $('#confirmModal').modal('show');
 });

 $('#ok_button').click(function(){
  $.ajax({
   url:"Product/destroy/"+user_id,
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

   
   
   
   
   
     $(document).on('click', '.closedelete', function(){
$('#confirmModal').modal('hide');

 });
   
   
   
   
    /////////////////////////////////////// Dynamically Add New row and Add New select2 for dynamically added new medicine name  ////////////////////////
 

  let row_number = 1;
    $("#add_row").click(function(e){
		
		
		      e.preventDefault();
      let new_row_number = row_number - 1;
	  
	  	   $latest_tr  = $('#product0');
   

	
	     $latest_tr.find(".unit").each(function(index)
    {
        $(this).select2('destroy');
    }); 
	  
	 	     $latest_tr.find(".tounit").each(function(index)
    {
        $(this).select2('destroy');
    });  
	  
	  
	  
	  
	  
	  
	  
	  
      $('#product' + row_number).html($('#product0' ).html()).find('td:first-child');
	  
	   

	  
      $('.addmoreproduct').append('<tr id="product' + (row_number + 1) + '"></tr>');
      row_number++;
     

 
     
    

 
    $('.unit').select2();   
	
    $('.tounit').select2();   	
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

 
	 
	 
	 
	 

	 
	 






 
 $(document).on('click', '#close', function(){
$('#formModal').modal('hide');

 });


});
</script>
	  
</body>

@stop