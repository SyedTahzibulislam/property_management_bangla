

@extends('layout.main')

@section('content')


<h6 style="color:red;">আপনি যে ডিলারের স্টক দেখতে চান সেটা সিলেক্ট করেন </h6>
<br>


<form      method="post"  action="{{route('Product.fetch_Productstock')}}"   >
 @csrf


Dealer Name:<select style="width:300px;" required name="business" id="business">
<option value=""></option>
 <option value="99999999999999">Owner's Stock</option>
@foreach($project as $c)
  <option value="{{$c->id}}">{{$c->name}}</option>
 @endforeach
</select>


  <button   type="submit"   target="_blank" class="btn btn-primary">Submit</button>
</form>





 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>  


<script type="text/javascript">


$(document).ready(function(){

 $(document).on('change', '#startdate , #enddate', function(){
 
  var start = $('#startdate').val();
    var end= $('#enddate').val();
	var date1 = new Date(start);
	var date2 = new Date(end);
 if (date1 > date2 )
 {
	alert("শেষের তারিখ অব্যশ্যই শুরুর তারিখ থেকে পেছনে হবে। পুনরায় ইনপুট দিন।"); 
	$('#enddate').val('');
 }
  
 });


$("#business").select2();


});
</script>
	  


@stop