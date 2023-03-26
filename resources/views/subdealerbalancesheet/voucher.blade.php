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
      <b><u>ব্যালেন্স সিট </u></b>
    <?php } if ( $i == 1){ ?>
	  <b> অফিস কপি   </b>
	  <?php } if ( $i == 2){ ?>
	 <b> একাউন্টস কপি   </b>
	  <?php } ?>
	</div>




  </div>


    <div style="height:10px;" id="two" >
    <div style="width:40%; float:left;" >
      <b>নাম  :</b> {{$data->shopname}}
    </div>

	


	


  </div>
     

    <div style="height:10px;" id="two" >
    <div style="width:30%; float:left;" >
      <b>ওপেনিং ব্যালেন্স  : {{convertToBangla($opening_balance)}} টাকা </b>
    </div>


    <div style="width:30%; float:left;" >
      <b> বর্তমান ব্যালেন্স   :  {{convertToBangla($obtillfirstdate)}} টাকা </b>
    </div>
  </div>  
  
 <b>তারিখ :   <?php echo convertToBangla(date('d/m/Y ', strtotime($start))); ?> থেকে  <?php echo convertToBangla(date('d/m/Y ', strtotime($end))); ?> </b><p>
  <?php  $b= $obtillfirstdate;  ?>
  
   
  
 <br> 




<table>






<thead>
  <tr>
     
 <th style="width:40px;" >আইডি </th>	
 <th  style="width:40px;" >প্রজেক্ট  </th>
  <th  style="width:40px;" >একাউন্ট  </th>
   <th  style="width:40px;" >সুপারভাইজার  </th>
    <th  style="width:40px;" >এডজাস্ট  </th>
 <th style="width:40px;" >	তারিখ </th>
  
    <th style="width:150px;" >
	
	বিবরণ 
    
	 </th>
	  <th style="width:100px;"  >জমা </th>
    <th style="width:100px;"  >উত্তোলন  </th>
	<th style="width:100px;"  >ব্যালেন্স  </th>
<th style="width:100px;"  > এন্ট্রি  </th>
  </tr>
  </thead>
 @foreach ( $order as $o )

 <?php 

if ($o->type == 1)
{
$b = $b+ $o->deposit;

}	

if ($o->type == 2)
{
$b = $b- $o->withdrwal;

}




?> 


  <tr>
    <?php  //$myDateTime = DateTime::createFromFormat('Y-m-d', $o->created_at);  echo  $myDateTime->format('d/m/Y'); ?> 
 

<td>

<?php  if($o->transtype == 1  ) { ?>

External Cost ID: {{$o->externalcost_id }}

<?php } if($o->transtype == 2 ) {            ?>

Cost ID: {{$o->khoroch_transition_id }}

<?php } if($o->transtype == 3 ) {            ?>
Supplier Due Payment ID:  {{$o->dhar_shod_othoba_advance_er_mal_buje_pawa_id }}
<?php } if($o->transtype == 4 ) {            ?>
Salary Trans ID: {{$o->employeesalarytransaction_id }}

<?php } if($o->transtype == 5 ) {            ?>
Partner's Money Trans ID: {{$o->Taka_uttolon_transition_id }}

<?php } if($o->transtype == 6 ) {            ?>

Bank Trans ID: {{$o->bankchalan_id }} 
<?php } if($o->transtype == 7 ) {            ?>

Customer Order ID: {{$o->productorder_id }} 
<?php } if($o->transtype == 8 ) {            ?>

Customer Order ID:  {{$o->productorder_id }}  
<?php } if($o->transtype == 9 ) {            ?>
Company Order ID: {{$o->productcompanyorder_id }}  

<?php } if($o->transtype == 10 ) {            ?>
Company Order ID: {{$o->productcompanyorder_id }}

<?php }          ?>

<?php  if($o->transtype == 11 ) {            ?>
Agent Trans. ID: {{$o->agenttransaction_id }}

<?php }    if($o->transtype == 14 ) {       ?>
Money Exchange Transition ID: {{$o->moneyexchange_id }}
<?php }   if($o->transtype == 12 ) {              ?>
Income Transition ID: {{$o->externalincometransition_id }}
<?php } ?>
</td>
 
 
 
 
 
 
 
    <td> 
	
	<?php if($o->project_id) { ?>
	
	{{ $o->project->name }}
	
	<?php } else { ?>
	
	NA <?php } ?>
	
	
</td>
 
 
 
     <td> 
	
	<?php if($o->account_id) { ?>
	
	{{ $o->account->name }}
	
	<?php } else { ?>
	
	NA <?php } ?>
	
	
</td>
 
 
      <td> 
	
	<?php if($o->superviser_id) { ?>
	
	{{ $o->superviser->name }}
	
	<?php } else { ?>
	
	NA <?php } ?>
	
	
</td>
 
 
       <td> 
	
	<?php if( ($o->adjusttype== 1) or ($o->adjusttype== null))  { ?>
	
	মালিক 
	
	<?php } else if ($o->adjusttype== 2) { ?>
	
	একাউন্টেন্ট  <?php } else if ($o->adjusttype== 3) { ?>
	সুপারভাইজার 
	<?php } ?>
</td>
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
  <td>


 {{ Carbon\Carbon::parse($o->created_at)->format('d/m/Y') }}

 </td>
   

   <td> 
	{{ $o->description }}
</td>
  
<td>    
{{   convertToBangla($o->deposit) }}
 </td>




 <td>       


{{ convertToBangla($o->withdrwal) }}


 </td>
   <td><?php echo convertToBangla(round($b,2)); ?> </td>

     <td>{{ $o->user->name}} </td> 


	 
	 
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