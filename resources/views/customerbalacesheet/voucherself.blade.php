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
 <?php for ($i=0; $i<1; $i++){ ?>
</head>
<body style="font-family:nikosh;">
<div id="c" >
<div id="head" >
<img width="500px;"   src="img/logo.jpg" >
<hr>
</div>



    <div style="height:10px;" id="one" >
    <div style="width:30%; float:left;" >
	<?php if( $i == 0) { ?>
      <b><u>Balancei Sheet</u></b>
    <?php } if ( $i == 1){ ?>
	  <b>office's Copy  </b>
	  <?php } if ( $i == 2){ ?>
	 <b> Accountant's Copy  </b>
	  <?php } ?>
	</div>
    <div style="width:40%;float:left;" >
 <b>Customer ID:</b> {{$data->id}}
    </div>



  </div>


    <div style="height:10px;" id="two" >
    <div style="width:40%; float:left;" >
      <b>Name :</b> {{$data->name}}
    </div>

	
	    <div style="width:26%;float:left;" >
 <b>code:</b> {{$data->customercode}}
    </div>

	
	
	    <div style="width:34%;float:left;" >
<b>Mobile No.</b> {{$data->mobile}} 
    </div>

  </div>
     

    <div style="height:10px;" id="two" >
    <div style="width:30%; float:left;" >
      <b>Opening Balance :</b> {{$data->openingbalance}}TK
    </div>
    <div style="width:30%; float:left;" >
      <b>Current Due Balance :</b> {{$data->presentduebalance}}TK
    </div>

    <div style="width:30%; float:left;" >
      <b>Previous Due Balance  :</b> {{$obtillfirstdate}}TK
    </div>
  </div>  
  
  
Balance Sheet from date: <?php echo date('d/m/Y ', strtotime($start)); ?>  to <?php echo date('d/m/Y ', strtotime($lastday)); ?> 
  
  <?php  $b= $obtillfirstdate;  ?>
  
  
  
 <br> 




<table>






<thead>	
  <tr>
     
	
 <th style="width:40px;" >	Date</th>
  
    <th style="width:100px;" >
	
	  Project Name
    
	 </th>
	  <th style="width:100px;"  >Plot</th>
	  <th style="width:100px;"  >Comment</th>
    <th style="width:100px;"  >Amount(TK)</th>
	<th style="width:100px;"  >Disount(TK)</th>
    <th  style="width:100px;" >Receiveable Amount(TK)</th>
	 <th style="width:100px;"  >Debit(Due) </th>
	 
	 <th style="width:100px;"   >Credit(Paid)</th> 
	  <th style="width:100px;"   > Due Balance</th> 
  </tr>
  </thead>	
 @foreach ( $order as $o )

 <?php 

if ($o->type == 1)
{
$b = $b+ $o->due_first;

}	

if ($o->type == 2)
{
$b = $b- $o->amount;

}




?> 


  <tr>
    <?php  //$myDateTime = DateTime::createFromFormat('Y-m-d', $o->created_at);  echo  $myDateTime->format('d/m/Y'); ?> 
  <td> <?php echo date('d/m/Y h:i:s A', strtotime($o->created_at));; ?> </td>
<td>  {{$o->project->name}}    </td>
<td>  {{$o->plot->name}}   </td>  
<td> Type: <?php   if ($o->type ==1) { ?> Buying/Booking : 

<?php } if ($o->type ==2) { ?> Due Payment by Customer:  <?php } if ($o->type ==3) { ?>

Refund to Customer:  <?php } ?>


    {!! nl2br(e($o->comment)) !!}   





 </td>




 <td><?php echo round($o->amount,2); ?> </td>
   <td><?php echo round($o->discount,2); ?> </td>

   
    <td><?php echo round($o->amountafterdiscount,2); ?></td>
	 <td><?php echo round($o->due_first,2); ?></td>
	 
	 <td><?php echo round($o->paid,2); ?></td>
	  <td>        <?php echo round($b,2); ?>   </td>

	 
	 
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