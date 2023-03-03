<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<style>

table {
  font-family: arial, sans-serif;
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
<body style="font-family: Times New Roman;">
<div id="c" >
<div id="head" >
<img width="500px;"   src="img/logo.jpg" >
<hr>
</div>



    <div style="height:10px;" id="one" >
    <div style="width:30%; float:left;" >
	<?php if( $i == 0) { ?>
      <b><u>Balance Sheet</u></b>
    <?php } if ( $i == 1){ ?>
	  <b>office's Copy  </b>
	  <?php } if ( $i == 2){ ?>
	 <b> Accountant's Copy  </b>
	  <?php } ?>
	</div>
    <div style="width:40%;float:left;" >
 <b>Project Name:</b> {{$project_name}}
    </div>



  </div>





     

  
  
  Balance Sheet from date: <?php echo date('d/m/Y ', strtotime($start)); ?>  to <?php echo date('d/m/Y ', strtotime($end)); ?> 
  

  
  
  
 <br> 




<table>








     
<thead>	
  <tr>
 <th style="width:40px;" >	Date</th>
  
    <th style="width:150px;" >
	
	  Product Name
    
	 </th>
	  <th style="width:100px;"  >Comment</th>
    <th style="width:100px;"  >Amount(TK)</th>
 
  </tr>
  </thead>
 @foreach ( $useproduct as $o )




  <tr>

  <td> <?php echo date('d/m/Y', strtotime($o->created_at));; ?> </td>
    <td> 

<table>
  <tr>
    <th style="width:100px;" >Product Name </th>
    <th>Qun.</th>
	<th>Unit Pr.</th>
    <th>Unit</th>
  </tr>
  

 
 @foreach ( $o->useproducttransition as $t )
  <tr>
    <td> {{$t->product->name}}</td>
   <td><?php echo round($t->quantity,2); ?> </td>
   <td><?php echo round($t->unirprice,2); ?> </td>
<td> {{$t->unitname}} </td>
   

	 

	 
	 
  </tr>
@endforeach 




</table>

</td>
  
<td> 

    {!! nl2br(e($o->comment)) !!}   





 </td>




 <td><?php echo round($o->amount,2); ?> </td>
 <

	 
	 
  </tr>

@endforeach 
</table>
	
	<div  style="height:10px;" id="btwo" >
    <div style="width:50%;float:left;" >
 <b>Date :</b><?php echo date("d/m/y") ;  ?>
    </div>

	    <div style="width:50%;float:left;" >
		<b>Print By:{{Auth()->user()->name}}</b>

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