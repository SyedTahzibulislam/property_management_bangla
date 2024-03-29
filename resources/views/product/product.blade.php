

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
		<h2> প্রডাক্ট </h2>
  <span id="form_result"></span>
	
		<form method="post" action="{{ route('Product.store') }}"   id="sample_form" class="form-horizontal" enctype="multipart/form-data">
          @csrf
		   
		   
		 

	  <div class="row"> 
    <div class="col-4">
    ক্যাটাগরি * :  	<select id="category"  class="form-control "  name="category"  required   style='width: 270px;'>
  
   </select>
    </div>


	
	
		   <div class="col-4">
স্টক ইউনিট * : 	<select id="sellingunit"  class="form-control "  name="sellingunit"  required   style='width: 270px;'>
  
   </select>
    </div>
	

	
	
	
	    <div class="col-4">
প্রডাক্টের নাম * :      
			   <input type="text" class="form-control register_form " name="name" id="name" placeholder="name" autocomplete="off">
    </div>
    <div class="col-4">
          <input type="hidden" value="0" readonly  class="form-control register_form " name="stock" id="stock" placeholder="stock" required  autocomplete="off" >
        </div>
        <div class="col-4">
   প্রাইস * <input type="text" value="0" class="form-control register_form " name="unitprice" id="unitprice" placeholder="unitprice" required  autocomplete="off" >
        </div>
	
	</div>
	



<P>


        
   
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

			
				<th>ক্যাটাগরি </th>

             <th>প্রডাক্ট </th>
			

				
			     
       <th>একশন </th>	      
                
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
                <button type="button" class="closedelete" data-dismiss="modal">&times;</button>
                <h2 class="modal-title">কনফার্ম করেন </h2>
            </div>
            <div class="modal-body">
                <h4 align="center" style="margin:0;">আপনি কি ডিলিট করতে চান ?</h4>
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
	 $(".unit").select2();
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
	



    var table = $('#patient_table').DataTable({
		
	
		
        processing: true,
        serverSide: true,
		responsive: true,
	
        ajax: "{{ route('Product.index') }}",
	
        columns: [
		
		 

			 {data: 'productcategory', name: 'productcategory'},
			 {data: 'name', name: 'name'},


			
			 
			 
 {data: 'action', name: 'action', orderable: false, searchable: false},
			    
           
        ]
    });


 fetch();  
   

 
  function fetch()
  {

  $.ajax({
   url:"dropdownlist",
     url:"{{ route('Product.dropdownlist') }}",
   dataType:"json",
  
   ////////////////////fetch data for dropdown menu 
success:function (response) {
	 $("#category").html("");
                    var len = 0;
                    if (response.data != null) {
                        len = response.data.length;
                    }
                 var option = "<option value=''></option>"; 

                             $("#category").append(option);
                    if (len>0) {
                        for (var i = 0; i<len; i++) {
                             var id = response.data[i].id;
                             var name = response.data[i].name;

                             var option = "<option value='"+id+"'>"+name+"</option>"; 
							

                             $("#category").append(option);
                        }
                    }
					
			



$('.unit').html("");
                    var len = 0;
                    if (response.unit != null) {
                        len = response.unit.length;
                    }
                 var option = "<option value=''></option>"; 

                             $(".unit").append(option);
                    if (len>0) {
                        for (var i = 0; i<len; i++) {
                             var id = response.unit[i].id;
                             var name = response.unit[i].name;

                             var option = "<option value='"+id+"'>"+name+"</option>"; 
							

                             $(".unit").append(option);
                        }
                    }

















			
	 $("#company").html("");
                    var len = 0;
                    if (response.Productcompany != null) {
                        len = response.Productcompany.length;
                    }
                 var option = "<option value=''></option>"; 

                             $("#company").append(option);
                    if (len>0) {
                        for (var i = 0; i<len; i++) {
                             var id = response.Productcompany[i].id;
                             var name = response.Productcompany[i].name;

                             var option = "<option value='"+id+"'>"+name+"</option>"; 
							

                             $("#company").append(option);
                        }
                    }					
					
					
					
					
		 $("#stockunit").html("");
                    var len = 0;
                    if (response.unit != null) {
                        len = response.unit.length;
                    }
                 var option = "<option value=''></option>"; 

                             $("#stockunit").append(option);
                    if (len>0) {
                        for (var i = 0; i<len; i++) {
                             var id = response.unit[i].id;
                             var name = response.unit[i].name;

                             var option = "<option value='"+id+"'>"+name+"</option>"; 
							

                             $("#stockunit").append(option);
                        }
                    }
									
					
			

			$("#purchasingunit").html("");
                    var len = 0;
                    if (response.unit != null) {
                        len = response.unit.length;
                    }
                 var option = "<option value=''></option>"; 

                             $("#purchasingunit").append(option);
                    if (len>0) {
                        for (var i = 0; i<len; i++) {
                             var id = response.unit[i].id;
                             var name = response.unit[i].name;

                             var option = "<option value='"+id+"'>"+name+"</option>"; 
							

                             $("#purchasingunit").append(option);
                        }
                    }				
					
			


			$("#sellingunit").html("");
                    var len = 0;
                    if (response.unit != null) {
                        len = response.unit.length;
                    }
                 var option = "<option value=''></option>"; 

                             $("#sellingunit").append(option);
                    if (len>0) {
                        for (var i = 0; i<len; i++) {
                             var id = response.unit[i].id;
                             var name = response.unit[i].name;

                             var option = "<option value='"+id+"'>"+name+"</option>"; 
							

                             $("#sellingunit").append(option);
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
    url:"{{ route('Product.store') }}",
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
	  $('#form_result_footer').html(html);
    $('#form_result_footer').fadeIn();
	  $('#form_result_footer').delay(1500).fadeOut();
	  fetch();
	      $("#category").html("");
		   $("#products_table tr:gt(1)").remove();
		   $(".unit").select2();
		  
		  
    }
   })
  
  
  
  }

  if($('#action').val() == "Edit")
  {
   $.ajax({
    url:"{{ route('Product.update') }}",
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
	  $('#form_result_footer').html(html);
    $('#form_result_footer').fadeIn();
	  $('#form_result_footer').delay(1500).fadeOut();
	  fetch();
	         $('#action_button').val("Add");
    $('#action').val("Add");
		  
		  
		  
		  
		  
		  
    }
   });
  }
 });
   
   $(document).on('click', '.edit', function(){
  var id = $(this).attr('id');
  $('#form_result').html('');
  $.ajax({
   url:"/Product/"+id+"/edit",
   dataType:"json",
   success:function(html){
   
    $('#name').val(html.data.name);
	$('#productcode').val(html.data.productcode);
    $('#stock').val(html.stock);
    $('#unitprice').val(html.data.unitprice);

   
	
	var len = html.Productcompany.length;
	var presentcompany = html.data.Productcompany_id;

 $("#company").html("");
           


	
	
		                        for (var i = 0; i<len; i++) {
								
								if ( presentcompany == html.Productcompany[i].id  ) 
								{
									var id = html.Productcompany[i].id;
                             var name = html.Productcompany[i].name;

                             var option = "<option value='"+id+"'>"+name+"</option>"; 

                             $("#company").append(option);
								}
                             
                        }
						
						
							                        for (var i = 0; i<len; i++) {
								
								if ( presentcompany != html.Productcompany[i].id  ) 
								{
									var id = html.Productcompany[i].id;
                             var name = html.Productcompany[i].name;

                             var option = "<option value='"+id+"'>"+name+"</option>"; 

                             $("#company").append(option);
								}
                             
                        }
	                        
	
	var lencat = html.productcategory.length;
	var presentcategory = html.data.productcategory_id;

 $("#category").html("");
           

                            
	
	
		                        for (var i = 0; i<lencat; i++) {
								
								if ( presentcategory == html.productcategory[i].id  ) 
								{
									var id = html.productcategory[i].id;
                             var name = html.productcategory[i].name;

                             var optioncategory = "<option value='"+id+"'>"+name+"</option>"; 

                             $("#category").append(optioncategory);
								}
                             
                        }
						
						
							                        for (var i = 0; i<lencat; i++) {
								
								if ( presentcategory != html.productcategory[i].id  ) 
								{
									var id = html.productcategory[i].id;
                             var name = html.productcategory[i].name;

                             var optioncategory = "<option value='"+id+"'>"+name+"</option>"; 

                             $("#category").append(optioncategory);
								}
                             
                        }	

				



	var len = html.unit.length;
	var presentstockunit = html.data.stockunit;

 $("#stockunit").html("");
           


	
	
		                        for (var i = 0; i<len; i++) {
								
								if ( presentstockunit == html.unit[i].id  ) 
								{
									var id = html.unit[i].id;
                             var name = html.unit[i].name;

                             var option = "<option value='"+id+"'>"+name+"</option>"; 

                             $("#stockunit").append(option);
								}
                             
                        }
						
						
							                        for (var i = 0; i<len; i++) {
								
								if ( presentstockunit != html.unit[i].id  ) 
								{
									var id = html.unit[i].id;
                             var name = html.unit[i].name;

                             var option = "<option value='"+id+"'>"+name+"</option>"; 

                             $("#stockunit").append(option);
								}
                             
                        }





	var len = html.unit.length;
	var presentbuyingunit = html.data.buyingunit;

 $("#purchasingunit").html("");
           


	
	
		                        for (var i = 0; i<len; i++) {
								
								if ( presentbuyingunit == html.unit[i].id  ) 
								{
									var id = html.unit[i].id;
                             var name = html.unit[i].name;

                             var option = "<option value='"+id+"'>"+name+"</option>"; 

                             $("#purchasingunit").append(option);
								}
                             
                        }
						
						
							                        for (var i = 0; i<len; i++) {
								
								if ( presentbuyingunit != html.unit[i].id  ) 
								{
									var id = html.unit[i].id;
                             var name = html.unit[i].name;

                             var option = "<option value='"+id+"'>"+name+"</option>"; 

                             $("#purchasingunit").append(option);
								}
                             
                        }



	var len = html.unit.length;
	var presentsellingunit = html.data.sellingunit;

 $("#sellingunit").html("");
           


	
	
		                        for (var i = 0; i<len; i++) {
								
								if ( presentsellingunit == html.unit[i].id  ) 
								{
									var id = html.unit[i].id;
                             var name = html.unit[i].name;

                             var option = "<option value='"+id+"'>"+name+"</option>"; 

                             $("#sellingunit").append(option);
								}
                             
                        }
						
						
							                        for (var i = 0; i<len; i++) {
								
								if ( presentsellingunit != html.unit[i].id  ) 
								{
									var id = html.unit[i].id;
                             var name = html.unit[i].name;

                             var option = "<option value='"+id+"'>"+name+"</option>"; 

                             $("#sellingunit").append(option);
								}
                             
                        }



























				
						


   
	$('#hidden_id').val(html.data.id);
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
 
 	 

	 
	 






 
 $(document).on('click', '#close', function(){
$('#formModal').modal('hide');

 });


});
</script>
	  
</body>

@stop