<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<style>
    body {
    style="font-family: nikosh;"   
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
 <?php for ($i=1; $i<3; $i++){ ?>
</head>
<body style="font-family: nikosh;">
<div id="c" >
<div id="head" >
<img width="500px;"   src="img/logo.jpg" >
<hr>
</div>


<h2>প্রডাক্ট ব্যবহার রিপোর্ট  </h2>
    <div style="height:10px;" id="one" >
    <div style="width:30%; float:left;" >
	<?php if( $i == 0) { ?>
      <b><u> ব্যালেন্স সিট </u></b>
    <?php } if ( $i == 1){ ?>
	  <b> অফিস কপি   </b>
	  <?php } if ( $i == 2){ ?>
	 <b> একাউন্টস কপি   </b>
	  <?php } ?>
	</div>
    <div style="width:40%;float:left;" >
 <b>প্রজেক্ট নাম :</b> {{$project_name}}
    </div>



  </div>





     

  
  
  তারিখ : <?php echo convertToBangla(date('d/m/Y ', strtotime($start))); ?>  থেকে  <?php echo convertToBangla(date('d/m/Y ', strtotime($end))); ?> 
  

  
  
  
 <br> 




<table>








     
<thead>	
  <tr>
 <th style="width:40px;" >	ডেট </th>
  
    <th style="width:150px;" >
	
	  প্রডাক্ট 
    
	 </th>
	  <th style="width:100px;"  >কমেন্ট </th>
    <th style="width:100px;"  >প্রাইস </th>
 
  </tr>
  </thead>
 @foreach ( $useproduct as $o )




  <tr>

  <td> <?php echo convertToBangla(date('d/m/Y', strtotime($o->created_at)));; ?> </td>
    <td> 

<table>
  <tr>
    <th style="width:100px;" >প্রডাক্টের নাম  </th>
    <th> পরিমাণ .</th>
	<th>ইউনিট প্রাইস .</th>
    <th>ইউনিট </th>
  </tr>
  

 
 @foreach ( $o->useproducttransition as $t )
  <tr>
    <td> {{$t->product->name}}</td>
   <td><?php echo convertToBangla(round($t->quantity,2)); ?> </td>
   <td><?php echo convertToBangla(round($t->unirprice,2)); ?> </td>
<td> {{$t->unitname}} </td>
   

	 

	 
	 
  </tr>
@endforeach 




</table>

</td>
  
<td> 

    {!! nl2br(e($o->comment)) !!}   





 </td>




 <td><?php echo convertToBangla(round($o->amount,2)); ?> </td>
 <

	 
	 
  </tr>

@endforeach 
</table>
	
	<div  style="height:10px;" id="btwo" >
    <div style="width:50%;float:left;" >
 <b>তারিখ  :</b><?php echo convertToBangla(date("d/m/y")) ;  ?>
    </div>

	    <div style="width:50%;float:left;" >
		<b> প্রিন্ট :{{Auth()->user()->name}}</b>

    </div>

  </div>



</div>
<p>

</div>


			<?php if( $i < 2) { ?>
	<p style="page-break-after:always" ></p>
 <?php } } ?>
</body>
</html>