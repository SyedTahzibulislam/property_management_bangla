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

      <b><u>ক্রয়/ ক্রয় ফেরত  রিপোর্ট :</u></b>

	</div>




  </div>


    <div style="height:10px;" id="two" >
    <div style="width:40%; float:left;" >
      <b>কোম্পানি নেম  :  {{$company}}    </b> 
    </div>

	


	


  </div>
     


  
 <b> ট্রাঞ্জেশন   <?php echo convertToBangla(date('d/m/Y ', strtotime($start))); ?> থেকে  <?php echo convertToBangla (date('d/m/Y ', strtotime($e))); ?> </b><p>

  
  
  
 <br> 


<b>  ক্রয় রিপোর্ট  </b>

<table>

<thead>
  <tr>
     
	
 <th style="width:40px;" >	প্রডাক্ট </th>
  
    <th style="width:100px;" >
	
ইউনিট  
    
	 </th>
	  <th style="width:100px;"  > পরিমাণ .  </th>
    <th style="width:100px;"  >পরিমাণ .(বেস ইউনিটে ) </th>
	<th style="width:100px;"  > গ্রোস প্রাইস . </th>
<th style="width:100px;"  > ডিস্কাউন্ট . </th>
<th style="width:100px;"  > পে-এবল প্রাইস . </th>
  </tr>
  </thead>
 @foreach ( $producttransition as $p )
 <tr>
 <td>{{$p->Product->name}} </td>
 <td>{{$p->unitcoversion->name}} </td>
   <td><?php echo convertToBangla( round($p->quantity,2)); ?> </td>
   <td><?php echo convertToBangla(round($p->quantityinbase,2)); ?> </td>
    <td><?php echo convertToBangla(round($p->amount,2)); ?> </td>  
    <td><?php echo convertToBangla(round($p->discount,2)); ?> </td>
    <td><?php echo convertToBangla(round($p->finalamountafterdiscount,2)); ?> </td>
	 
	 
  </tr>

@endforeach 
</table>
	
	
	
	
	<p>
	
<b> ক্রয় ফেরত রিপোর্ট </b> 


<table>






<thead>
  <tr>
     
	
 <th style="width:40px;" >	প্রডাক্ট </th>
  
    <th style="width:100px;" >
	
ইউনিট  
    
	 </th>
	  <th style="width:100px;"  > পরিমাণ .  </th>
    <th style="width:100px;"  >পরিমাণ .(বেস ইউনিটে ) </th>
	<th style="width:100px;"  > গ্রোস প্রাইস  </th>
<th style="width:100px;"  > ডিস্কাউন্ট . </th>
<th style="width:100px;"  > রিসিভেবল প্রাইস . </th>
  </tr>
  </thead>
 @foreach ( $returnproduct as $p )
 <tr>
 <td>{{$p->Product->name}} </td>
 <td>{{$p->unitcoversion->name}} </td>
   <td><?php echo convertToBangla(round($p->quantity,2)); ?> </td>
   <td><?php echo convertToBangla(round($p->quantityinbase,2)); ?> </td>
    <td><?php echo convertToBangla(round($p->amount,2)); ?> </td>  
    <td><?php echo convertToBangla(round($p->discount,2)); ?> </td>
    <td><?php echo convertToBangla(round($p->finalamountafterdiscount,2)); ?> </td>
	 
	 
  </tr>

@endforeach 
</table>	
	
	
	
	
	
	
	
	
	
	
	
	<p>
	
	
	
	
{{-- 	
	
	<b> Product Stock </b>
	
	
	
	
	<table>






<thead>	
  <tr>
     
	
 
  
    <th style="width:150px;" >
	
	  Product Name
    
	 </th>
	  <th style="width:100px;"  >Go-Down</th>
    <th style="width:100px;"  >For Sale</th>
  <th style="width:100px;"  >Total</th>

  </tr>
  </thead>	
 @foreach ( $product as $p )



  <tr>
 
 
 
 
 
 
  <td> {{$p->name  }} </td>
 
  <td><?php   $s = $p->stock; echo round($p->stock ,2); ?> </td>
 
 
 
    <td> 

<table>
  <thead>
  <tr>
    <th style="width:100px;" >Unit Name </th>
    <th>Qun.</th>
	<th>KG/Piece </th>
    
  </tr>
    </thead>

 
 @foreach ( $p->productpriceaccunit as $t )
  <tr>

 <td> {{ $t->unitcoversion->name }} </td>

   <td>{{ $t->stock }}     </td> 
   <td> <?php $amnt=  $t->stock * $t->unitcoversion->coversionamount ; $s= $s+$amnt;  ?> {{ $amnt }}    </td> 
	 

	 
	 
  </tr>
@endforeach 




</table>

</td>
  
  <td><?php echo round($s ,2); ?> </td>







	 
	 
  </tr>

@endforeach 
</table>
	
	
	
	
	
	 --}}
	
	
	
	
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



</body>
</html>