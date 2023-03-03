

<head> 

<style>

body{
margin-top:20px;	
margin-left:100px;	
margin-right:100px;
}

.form-group{
	
	width:300px;
	font-size: 30px;
	
}

input[type="date"]
{
	
	width:300px;
	font-size: 30px;	
}
.btn
{
	
padding:15px;
border-radius:5px;
font-size:20px;
font-weight:800;
background-color: skyblue;	

}

a{
	
text-decoration:none;	
padding:20px;
font-weight:800;
background-color:skyblue;
border-radius:3px;
	
}

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">



</style>



</head>


<body>

	<nav class="navbar navbar-expand-lg bg-light">
  <div class="container-fluid">
  
                                    <a  style="width:200px; color:red; flow:right;"     class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
  
  </div>
</nav>


<h6 style="color:red;">আপনি যে দুই তারিখসহ ও দুই তারিখের মধ্যবর্তী সকল ডেটের মোট  সিট দেখতে চান তা নিচের ইনপুট ফিল্ডে লিখুন। 
ধরুন আপনি ১ আগষ্ট ২০২১  হতে ৭ আগষ্ট ২০২১ পর্যন্ত হওয়া বিক্রি ও খরচের ব্যালেন্স সিট দেখতে চাচ্ছেন। 
সেই ক্ষেত্রে <b style="color:green">শুরুর তারিখ</b> এর স্থলে ১ আগষ্ট ২০২১ হবে ও<b style="color:green"> শেষের তারিখ</b> এর স্থলে  ৭ আগষ্ট ২০২১ হবে।     </h6>


<form      method="post"  action="{{route('balancesheetforCustomer.customerbalanceself')}}"   >
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



<p>





  <button   type="submit"   target="_blank" class="btn btn-primary">Submit</button>
</form>



                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>

 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>  

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
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
	  
</body>

