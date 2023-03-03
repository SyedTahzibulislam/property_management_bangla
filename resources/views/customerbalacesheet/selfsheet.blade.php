
<style>
  .navbar-nav{
    display:none;
  }
      </style>
@extends('layout.main')


@section('content')
<style>
 .calender {
  background-color: #f2f2f2;
  padding: 20px;
  border-radius: 10px;
  margin: 20px 0;
  width:50%;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
} 







.calender h2 {
  font-size: 24px;
  font-weight: bold;
  margin-bottom: 10px;
}

.form-group {
  margin-bottom: 15px;
}

.form-group label {
  font-size: 18px;
  display: block;
  margin-bottom: 5px;
}

.form-group input[type="date"] {
  font-size: 16px;
  padding: 8px;
  border: none;
  border-radius: 5px;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
  width: 100%;
  box-sizing: border-box;
}

.error {
  margin-top: 5px;
}

.error h2 {
  font-size: 16px;
}
@media (max-width: 767px) {
  /* styles for screens smaller than 768px (i.e. mobile) */
  .calender {
    width: 90%; /* set width to 90% for mobile screens */
  }}
</style>
<script>
  $(document).ready(function(){
    $(".navbar-nav").hide();
  });
  
  </script>
<div class="calender">
<h2> ব্যালেন্স সিট দেখুন </h2>
<form      method="post"  action="{{route('selfbalance.fetch')}}"   >
 @csrf
  <div class="form-group">
   <label for="birthday">শুরুর তারিখ :</label><br>
  <input type="date" id="startdate" name="startdate" required ><br>
  @if($errors->has('startdate'))
    <div class="error"><h2 style="font-size:15px;color:red;">{{ $errors->first('startdate') }}</h2></div>
@endif
  
  
  </div>
  <div class="form-group">
    <label for="birthday">শেষের  তারিখ :</label><br>
  <input type="date" id="enddate" name="enddate"><br>
    @if($errors->has('enddate'))
    <div   class="error"><h2 style="font-size:20px;color:red;"> {{ $errors->first('enddate') }}</h2></div>
@endif
  </div>
  <button   type="submit"   target="_blank" class="btn btn-primary">Submit</button>
</form>
</div>

<p>











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


$("#customer_id").select2();


});
</script>
	  


@stop