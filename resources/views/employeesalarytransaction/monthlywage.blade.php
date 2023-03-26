<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<style>

    body {
    font-family: nikosh, sans-serif;"   
    }
table {
  font-family: nikosh, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid black;
  text-align: left;
  padding: 2px;
}



#c{




margin: 0 auto;
position:relative;

}





#c img {
width:100%;
}

#c::before {
content:'';
position:absolute;
top:50px;
left:0;
background-image: url("img/watermark.jpg");
background-position:center;
background-repeat:no-repeat;
width: 100%;
height: 100%;;
opacity: .1;
}

#m{
  
 background-color:red;;

}


</style>

</head>
<body style="font-family: nikosh;">
<div id="c" >
<div id="head" >
<img width="500px;"   src="img/logo.jpg" >
<hr>
</div>







	 	   <h2> বেতন খরচ :
	   
	   <?php 
	     
	    $myDateTime = DateTime::createFromFormat('Y-m-d', $start);  echo  convertToBangla($myDateTime->format('d/m/Y')); ?> 
    
	   

	   থেকে  
	   	   <?php 
   $myDateTime = DateTime::createFromFormat('Y-m-d', $e);  echo  convertToBangla($myDateTime->format('d/m/Y'));
	   ?>
	   
	    </h2>
	









<?php $totalbeton=0; if (!$employee_salary->isEmpty())  { ?>
<h5 >   বেতন খরচ    </h5>
  <hr>
  <table class="table">
  <thead>
    <tr>
    
      <th scope="col"> কর্মচারী   </th>
      <th scope="col">বেতনের পরিমাণ .  </th>
     <th scope="col">মাস   </th>
	
    </tr>
  </thead>
  <tbody>
    
	
	
	
	
	
	
	@foreach($employee_salary as $ems)
	<?php  
	$totalbeton = $totalbeton + $ems->totalsalary;
	
	?>
	
	<tr>
      <th >{{$ems->employeedetails->name}}</th>
      
  <td> <?php echo  convertToBangla(number_format($ems->totalsalary, 2, '.', ','));?>	 </td>  
  <td> {{$ems->month_year}}	 </td> 



  
    </tr>
@endforeach
  </tbody>
</table>

<span > মোট প্রদেয় বেতন :  </span> <?php echo convertToBangla($totalbeton)  ?> টাকা  

  

  
  <br>
 













  <?php } ?>




</body>
</html>