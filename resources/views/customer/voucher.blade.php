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



<bodY>


  <div id="head" >
    <div id="logo"> <img width="500px;"   src="img/logo.jpg" > </div>

  
  </div>
  <br>


<?php $i=1;?>


<b> Customer List </b>

<table>
    
<thead>	
  <tr>
  <th> No.</th>

 <th style="width:40px;" >Customer Name</th>
  <th style="width:40px;" > Mobile </th> 
    <th style="width:40px;" > Address </th> 
	   <th style="width:40px;" > Opening Due </th>
	       <th style="width:100px;"  >Current Due</th>
    <th style="width:150px;" >
	
	  Plots
    
	 </th>



	   
  </tr>
  </thead>
 @foreach ( $customer as $c )


  <tr>
  
<td> {{$i}}</td>
 <td> {{$c->name}} </td>
 <td> {{$c->mobile}} </td> 
 <td> {{$c->address}} </td>
<td> {{$c->openingbalance}} </td>
 <td> {{$c->presentduebalance}} </td>

    <td> 

<table>
  <tr>
    <th style="width:100px;" >Plot Name </th>
	    <th>Decimal</th>
    <th>Gross Price</th>
	<th>Discount</th>
	<th>Receiveable Amnt.</th>
    <th>Paid</th>
	<th>Due</th>
  </tr>
  

 
 @foreach($c->plotsell as $m  )
  <tr>
<?php if ($m->type == 1) { ?>
    <td> {{ $m->plot->name }}</td>
      <td> {{ $m->plot->amount }}</td>
   <td><?php echo round($m->amount,2); ?> </td>
<td> <?php echo round($m->discount,2); ?>  </td>
 <td> <?php echo round($m->amountafterdiscount	,2); ?>  </td>  
 <td> <?php echo round(($m->amountafterdiscount - $m->due)	,2); ?>  </td>  
  <td> <?php echo round($m->due	,2); ?>  </td>  
<?php } ?>    
 
  </tr>
@endforeach 




</table>

</td>
  




 
  </tr>

@endforeach 


  <tr>
  <th style="width:40px;" > Total</th>
   <th  >NA</th>
    <th  >NA</th>
 <th style="width:40px;" >NA</th>
  
    <th style="width:150px;" >
	
	 NA
    
	 </th>

    <th style="width:100px;"  >NA</th>

 <th style="width:100px;"  >NA</th>
  </tr>


</table>


<p>









</body>
</html>