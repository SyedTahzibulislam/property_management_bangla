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
 <?php for ($i=0; $i<3; $i++){ ?>
 
 
 
 
 <?php 

$sum=0;
$flag=0;
$due=0;
$totalsum=0;
$totaldue=0;
?>
</head>
<body style="font-family: nikosh;">
<div id="c" >
<div id="head" >
<img width="500px;"   src="img/logo.jpg" >
<hr>
</div>





	  <br> খরচ :
	   
	   <?php 
	     
	    $myDateTime = DateTime::createFromFormat('Y-m-d', $start);  echo  convertToBangla( $myDateTime->format('d/m/Y')); ?> 
    
	   

	   থেকে  
	   	   <?php 
   $myDateTime = DateTime::createFromFormat('Y-m-d', $datethatsentasenddatefromcust);  echo  convertToBangla( $myDateTime->format('d/m/Y'));
	   ?>
	   
	


     







 















<table>






<thead>
  <tr>
     



    <th style="width:150px;" >
	
খরচ 
    
	 </th>
	    <th style="width:150px;" >
	
প্রজেক্ট 
    
	 </th> 
	 
	  <th style="width:100px;"  >টাকার পরিমাণ  </th>
    <th style="width:100px;"  >পেইড  </th>
	 <th style="width:100px;"  >বাকি  </th>

		  <th style="width:100px;"  >তারিখ  </th>

  </tr>
  </thead>
 @foreach ( $khoroch as $khoroc )
<tr>
<td> {{$khoroc->khorocer_khad->name}} </td>
<td> {{$khoroc->project->name}} </td>
<td> {{   convertToBangla($khoroc->amount)}} </td>
<td> {{convertToBangla($khoroc->amount - $khoroc->due)}} </td>
<td> {{ convertToBangla($khoroc->due)}} </td>
<td > {{ convertToBangla(Carbon\Carbon::parse($khoroc->created_at)->format('d/m/Y')) }} </td>	 
	 
  </tr>


@endforeach 
</table>






</div>
<p>

</div>


			<?php if( $i < 2) { ?>
	<p style="page-break-after:always" ></p>
 <?php } } ?>
</body>
</html>