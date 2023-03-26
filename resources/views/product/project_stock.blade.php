<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<style>

    body {
        font-family: nikosh, sans-serif;
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



    <div style="height:10px;" id="one" >
    <div style="width:30%; float:left;" >

	</div>
 



  </div>


<b> স্টক রিপোর্ট  </b><br>
     
<b>প্রজেক্ট :</b> {{ $project_name }} <br>

<b> তারিখ   :</b> {{ convertToBangla(date("d-m-y H:i:s")) }} <P>
 <P>


  
 <br> 




<table>






<thead>	
  <tr>
     
	

  
    <th style="width:150px;" >
	
	  প্রডাক্টের নাম 
    
	 </th>
	  <th style="width:100px;"  >স্টক </th>
  
  <th style="width:100px;"  >মোট </th>

  </tr>
  </thead>	
 @foreach ( $product as $p )

 <?php $total_amount =0;
$total_amount_sale_point =0;
 $s=0; 
 ?>

  <tr>
 
 
 
 
 
 
  <td> {{$p->name  }} </td>
 

 
 
 
 
     <td> 

<table>
  <thead>
  <tr>
    <th style="width:100px;" >ইউনিট এর নাম  </th>
    <th>পরিমাণ .</th>
	<th> বেসিক ইউনিট ( কেজি / পিস  / শতক /  </th>
    
  </tr>
    </thead>

 
 @foreach ( $p->projectstock as $g )
  <tr>

 <td> {{ $g->unitcoversion->name }} </td>

   <td>{{ convertToBangla($g->stock) }}     </td> 
   <td> <?php         $amnt=  $g->stock * $g->unitcoversion->coversionamount ; $s= $s+$amnt; $total_amount = $total_amount + $amnt ;  ?> {{ convertToBangla($amnt) }}   </td> 
	 

	 
	 
  </tr>
@endforeach 

  <tr>

 <td> মোট  </td>

   <td>NA      </td> 
   <td> {{ convertToBangla($total_amount) }}    </td> 
	 

	 
	 
  </tr>













</table>

</td>
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 

  <td><?php echo round($s ,2); ?> </td>







	 
	 
  </tr>

@endforeach 
</table>
	
	<div  style="height:10px;" id="btwo" >


	    <div style="width:50%;float:left;" >
		<b>প্রিন্ট :{{Auth()->user()->name}}</b>

    </div>

  </div>



</div>
<p>

</div>



</body>
</html>