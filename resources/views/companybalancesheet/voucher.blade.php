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
 <?php for ($i=0; $i<3; $i++){ ?>
</head>
<body style="font-family: nikosh;">
<div id="c" >
<div id="head" >
<img width="500px;"   src="img/logo.jpg" >
<hr>
</div>



    <div style="height:10px;" id="one" >
    <div style="width:30%; float:left;" >
	<?php if( $i == 0) { ?>
      <b><u> ব্যালেন্স সিট  </u></b>
    <?php } if ( $i == 1){ ?>
	  <b> অফিস কপি   </b>
	  <?php } if ( $i == 2){ ?>
	 <b> একাউন্টস কপি   </b>
	  <?php } ?>
	</div>
    <div style="width:40%;float:left;" >
 <b>কোম্পানি আইডি :</b> {{$data->id}}
    </div>



  </div>


    <div style="height:10px;" id="two" >
    <div style="width:40%; float:left;" >
      <b> কোম্পানি নাম :</b> {{$data->name}}
    </div>

	


	
	
	    <div style="width:34%;float:left;" >
<b> মোবাইল .</b> {{$data->mobile}} 
    </div>

  </div>
     

    <div style="height:10px;" id="two" >
    <div style="width:30%; float:left;" >
      <b> শুরুর বাকি  : {{$data->openingbalance}} টাকা </b>
    </div>
    <div style="width:30%; float:left;" >
      <b>  বর্তমান বাকি  : {{$data->due}} টাকা </b>
    </div>

    <div style="width:30%; float:left;" >
      <b> প্রদেয় ডেটের পূর্বে বাকি   : {{$obtillfirstdate}} টাকা </b>
    </div>
  </div>  
  
  তারিখ : <?php echo convertToBangla(date('d/m/Y ', strtotime($start))); ?>  থেকে  <?php echo convertToBangla(date('d/m/Y ', strtotime($lastday))); ?> 
  
  <?php  $b= $obtillfirstdate;  ?>
  
  
  
 <br> 




<table>








     
<thead>	
  <tr>
 <th style="width:40px;" >	তারিখ </th>
  
    <th style="width:150px;" >
	
	  প্রডাক্ট 
    
	 </th>
	  <th style="width:100px;"  >কমেন্ট </th>
    <th style="width:100px;"  >টাকার পরিমাণ </th>
	    <th style="width:100px;"  >ডিস্কাউন্ট </th>
	 <th style="width:100px;"  >ডেবিট  </th>
	 
	 <th style="width:100px;"   >ক্রেডিট </th> 
	  <th style="width:100px;"   > ডিউ ব্যালেন্স </th> 
  </tr>
  </thead>
 @foreach ( $order as $o )

 <?php 

if ($o->type == 1)
{
$b = $b+ $o->debit;

}	

if ($o->type == 2)
{
$b = $b- $o->credit;

}

if ($o->type == 3)
{
$b = $b- $o->credit;

}

if ($o->type == 4)
{
	
$b = $b+ $o->debit;
	
}


?> 


  <tr>
    <?php  //$myDateTime = DateTime::createFromFormat('Y-m-d', $o->created_at);  echo  $myDateTime->format('d/m/Y'); ?> 
  <td> <?php echo convertToBangla(date('d/m/Y', strtotime($o->created_at))); ?> </td>
    <td> 
<?php  if($o->type == 2) { ?>

টাকা প্রদান 
<?php } if($o->type == 4) {  ?>

কোম্পানি/ সাপ্লাইয়ার থেকে টাকা গ্রহণ 
<?php  }  if( ($o->type == 1) || ($o->type == 3)  )  { ?>
<table>
  <tr>
    <th style="width:100px;" >প্রডাক্ট নাম </th>
    <th>পরিমাণ </th>
	<th>ইউনিট প্রাইস </th>
    <th>ইউনিট </th>
  </tr>
  

 
 @foreach ( $o->productcompanytransition as $t )
  <tr>
    <td> {{$t->Product->name}}</td>
   <td><?php echo convertToBangla(round($t->quantity,2)); ?> </td>
   <td><?php echo convertToBangla(round($t->unirprice,2)); ?> </td>
<td> {{$t->unitname}} </td>
   

	 

	 
	 
  </tr>
@endforeach 




</table>
<?php } ?>
</td>
  
<td> টাইপ : <?php   if ($o->type ==1) { ?> ক্রয়  : 

<?php } if ($o->type ==2) { ?> কোম্পানিকে/ সাপ্লাইয়ারকে  টাকা প্রদান :  <?php } if ($o->type ==3) { ?>

কোম্পানিকে/ সাপ্লাইয়ারকে  পণ্য ফেরত :  <?php } if ($o->type ==4) { ?>

কোম্পানি/ সাপ্লাইয়ার থেকে টাকা ফেরত পাওয়া  :  <?php } ?>


    {!! nl2br(e($o->comment)) !!}   





 </td>




 <td><?php echo convertToBangla(round($o->amount,2)); ?> </td>
 <td><?php echo convertToBangla(round($o->discount,2)); ?> </td>

	 <td><?php echo convertToBangla(round($o->debit,2)); ?></td>
	 
	 <td><?php echo convertToBangla(round($o->credit,2)); ?></td>
	  <td><?php echo convertToBangla(round($b,2)); ?></td>

	 
	 
  </tr>

@endforeach 
</table>
	
	<div  style="height:10px;" id="btwo" >
    <div style="width:50%;float:left;" >
 <b>তারিখ  :</b><?php echo convertToBangla(date("d/m/y")) ;  ?>
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