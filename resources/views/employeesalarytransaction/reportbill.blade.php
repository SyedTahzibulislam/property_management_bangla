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



<div style="font-size:2.5 px;"  >
    <div style="height:10px;" id="one" >
    <div style="width:33%; float:left;" >
	<b> বেতন ট্রাঞ্জাকশন  </b>
	</div>



  </div>
 

    <div style="height:10px;" id="two" >
    <div style="width:35%; float:left;" >
      <b> কর্মচারী  :</b> {{  $employeedetails->name }}

	


  </div>
     
    <div style="width:30%; float:left;" >
      <b>পদবি  :</b> {{  $employeedetails->designation }}
  </div>



      <div style="width:30%; float:left;" >
      <b>মোবাইল  </b> {{  $employeedetails->mobile }}
  </div>

  
  </div>

<br>
<table>
<thead>
  <tr>
  <th >বছর   </th>
    <th > যে মাসে দেয়া হয়েছে  </th>
  <th >তারিখ   </th>
  
    <th > যে মাসের জন্য দেয়া হয়েছে   </th>
    <th >টাকার পরিমাণ   </th>
    <th> মোট   </th>


  </tr>
  </thead>
<?php $sum=0; $sign0=0; $sign1=1; ?>
 
 @foreach ( $employeesalarytransaction as $e )
 
 
 <?php
$date = $e->starting;
$pieces = explode("-", $date);


if( ($sign0 == $pieces[0] ) and ($sign1 == $pieces[1] ))
{
	$s= 0;
$sum = $sum+ $e->totalsalary;

}
else
{
$s= 1;	
$sum =  $e->totalsalary;	
}


?> 
 
 
 
  <tr>
  <td> {{ $pieces[0] }} </td>
    <td> <?php  
	
	if( $pieces[1] == 1 )
	{
	echo "January";	
	}
		if( $pieces[1] == 2 )
	{
	echo "February";	
	}
	
	
		if( $pieces[1] == 3 )
	{
	echo "March";	
	}
		if( $pieces[1] == 4 )
	{
	echo "April";	
	}
		if( $pieces[1] == 5 )
	{
	echo "May";	
	}
		if( $pieces[1] == 6 )
	{
	echo "June";	
	}
	
		if( $pieces[1] == 7 )
	{
	echo "July";	
	}
		if( $pieces[1] == 8 )
	{
	echo "August";	
	}
		if( $pieces[1] == 9 )
	{
	echo "September";	
	}
		if( $pieces[1] == 10 )
	{
	echo "October";	
	}
		if( $pieces[1] == 11 )
	{
	echo "November";	
	}
		if( $pieces[1] == 12 )
	{
	echo "December";	
	}
	
	
	
	
	
	
	
	
	?>
	
	
	
	
	
	
	
	
	
	
	
	
	
	</td>
   <td>
    <?php $sign0 = $pieces[0]; $sign1 = $pieces[1];    $myDateTime = DateTime::createFromFormat('Y-m-d', $e->starting);  echo  $myDateTime->format('d/m/Y'); ?> 
     </td>
	 
	 
	 <td> {{$e->month_year}}</td> 
	 
	 
	 
	 
	 
    <td> {{ convertToBangla($e->totalsalary)}}</td>
      <td>  <?php 
if ($s == 1)
{
?>

	<span color="red">  {{convertToBangla($sum)}} </span>
	  
	  
<?php } else { ?>

 {{convertToBangla($sum)}} 

<?php } ?>
	  </td>
  </tr>
@endforeach 








</table>



<P> 

</div>



</body>
</html>