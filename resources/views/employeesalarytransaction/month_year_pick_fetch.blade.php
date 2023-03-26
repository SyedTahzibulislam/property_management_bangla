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







	 	   <h6> বেতন খরচ স্টেট্মেন্ট  :<br>
	   
মাস : {{$month}} <br> বছর : {{$year}}
	   
	    </h6>
	









<?php $totalbeton=0; if (!$employee_salary->isEmpty())  { ?>
<h5 >   বেতন খরচ   </h5>
  <hr>
  <table class="table">
  <thead>
    <tr>
    
      <th scope="col"> কর্মচারী   </th>
      <th scope="col"> টাকার পরিমাণ .  </th>
	  <th scope="col"> বেতন প্রদানের তারিখ   </th>
     <th scope="col">মোট   </th>
	
    </tr>
  </thead>
  <tbody>
    
	
	
	
	<?php $i=0; $j=0; $sum=0; ?>
	
	
	@foreach($employee_salary as $ems)
	<?php  
	$totalbeton = $totalbeton + $ems->totalsalary;
	
	
	
	if ( ($i == 0) or ( $i == $ems->employeedetails_id))
	{
		
		$sum = $sum + $ems->totalsalary;
		$i = $ems->employeedetails_id;
		
		
	}else{
	$sum=0;	
	$sum = $sum + $ems->totalsalary;
		$i = $ems->employeedetails_id;	
		
	}
	
	
	
	
	
	?>
	
	<tr>
      <td >{{$ems->employeedetails->name}}</td>
      
  <td> <?php echo  convertToBangla(number_format($ems->totalsalary, 2, '.', ','));?>	 </td>  


   <td>
    <?php    $myDateTime = DateTime::createFromFormat('Y-m-d', $ems->starting);  echo  $myDateTime->format('d/m/Y'); ?> 
     </td>
  <td> <?php echo  convertToBangla(number_format($sum, 2, '.', ','));?>	     	 </td> 
  
    </tr>
@endforeach
  </tbody>
</table>

<span > মোট প্রদেয় বেতন :  </span> <?php echo convertToBangla($totalbeton)  ?> টাকা . 

  

  
  <br>
 













  <?php } ?>




</body>
</html>