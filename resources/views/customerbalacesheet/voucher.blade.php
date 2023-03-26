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
 <?php for ($i=0; $i<3; $i++){ ?>
</head>
<body >
<div id="c" >
<div id="head" >
<img width="500px;"   src="img/logo.jpg" >
<hr>
</div>



    <div style="height:10px;" id="one" >
    <div style="width:30%; float:left;" >
	<?php if( $i == 0) { ?>
      <b><u>ব্যালেন্স সিট </u></b>
    <?php } if ( $i == 1){ ?>
	  <b>অফিস কপি  </b>
	  <?php } if ( $i == 2){ ?>
	 <b> একাউন্টস কপি   </b>
	  <?php } ?>
	</div>
    <div style="width:40%;float:left;" >
 <b>কাস্টমার আইডি :</b> {{$data->id}}
    </div>



  </div>


    <div style="height:10px;" id="two" >
    <div style="width:40%; float:left;" >
      <b>নাম :</b> {{$data->name}}
    </div>

	
	    <div style="width:26%;float:left;" >
 <b>কোড :</b> {{$data->customercode}}
    </div>

	
	
	    <div style="width:34%;float:left;" >
<b>মোবাইল .</b> {{$data->mobile}} 
    </div>

  </div>
     

    <div style="height:10px;" id="two" >
    <div style="width:30%; float:left;" >
      <b>শুরুর বাকি  :{{ convertToBangla($data->openingbalance)}} টাকা </b> 
    </div>
    <div style="width:30%; float:left;" >
      <b>বর্তমান বাকি  : {{convertToBangla($data->presentduebalance) }}টাকা </b>
    </div>

    <div style="width:30%; float:left;" >
      <b>প্রদেয় তারিখের আগের বাকি :</b> {{convertToBangla($obtillfirstdate)}}টাকা 
    </div>
  </div>  
  
  
প্রদেয় তারিখ : <?php echo convertToBangla(date('d/m/Y ', strtotime($start))); ?>  to <?php echo convertToBangla(date('d/m/Y ', strtotime($lastday))); ?> 
  
  <?php  $b= $obtillfirstdate;  ?>
  
  
  
 <br> 




<table>






<thead>	
  <tr>
     
	
 <th style="width:40px;" >	তারিখ </th>
  
    <th style="width:100px;" >
	
	  প্রজেক্ট 
    
	 </th>
	  <th style="width:100px;"  >প্লট </th>
	  <th style="width:100px;"  >কমেন্ট </th>
    <th style="width:100px;"  >টাকার পরিমাণ </th>
	<th style="width:100px;"  >ডিস্কাউন্ট </th>
    <th  style="width:100px;" >রিসিভেবল এমাউন্ট </th>
	 <th style="width:100px;"  >ডেবিট ( বাকি)  </th>
	 
	 <th style="width:100px;"   >ক্রেডিট (পেইড )</th> 
	  <th style="width:100px;"   > বাকির ব্যালেন্স </th> 
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
  <td> <?php echo convertToBangla(date('d/m/Y', strtotime($o->created_at)));; ?> </td>
<td>  {{$o->project->name}}    </td>
<td>  {{$o->plot->name}}   </td>  
<td> টাইপ : <?php   if ($o->type ==1) { ?> ক্রয়/ বুকিং  : 

<?php } if ($o->type ==2) { ?> ক্রেতা কর্তৃক বাকি শোধ :  <?php } if ($o->type ==3) { ?>

কাস্টমারকে টাকা ফেরত :  <?php } ?>


    {!! nl2br(e($o->comment)) !!}   





 </td>




 <td><?php echo (convertToBangla (round($o->amount,2))); ?> </td>
   <td><?php echo (convertToBangla (round($o->discount,2))); ?> </td>

   
    <td><?php echo (convertToBangla (round($o->amountafterdiscount,2))); ?></td>
	 <td><?php echo (convertToBangla (round($o->due_first,2))); ?></td>
	 
	 <td><?php echo (convertToBangla (round($o->paid,2))); ?></td>
	  <td>        <?php echo (convertToBangla (round($b,2))); ?>   </td>

	 
	 
  </tr>

@endforeach 
</table>
	
	<div  style="height:10px;" id="btwo" >
    <div style="width:50%;float:left;" >
 <b>তারিখ :</b><?php echo  convertToBangla(date("d/m/y"));  ?>
    </div>
 
	    <div style="width:50%;float:left;" >
		<b>প্রিন্ট :{{Auth()->user()->name}}</b>

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