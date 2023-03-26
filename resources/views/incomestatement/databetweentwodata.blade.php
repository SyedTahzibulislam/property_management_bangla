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
  font-weight: normal;
}

td, th {
  border: 1px solid black;
  text-align: left;
  padding: 2px;
   font-weight: normal; 
}



 </style>
 
</head>

<body>
  <?php  
$total_expenses_amount=0;
$total_expenses_paid=0;
$total_expenses_due=0;
$total_salary_amount=0;
$total_due_paymet=0;
$total_invest_project=0;
$total_withdrawl_bank=0;
$total_withdrawl_owner=0;
$total_company_amount = 0;
$total_company_due = 0;
$total_company_paid=0;
$total_due_paymet_company=0;
$money_return_back_from_project_expenses=0;





$money_back_company=0;
$total_paid_income = 0;
$total_due_income = 0;
$total_amount_income=0;
$total_investment=0;
$money_return_back_from_project=0;
$total_come_from_bank=0;
$total_due_collection =0;
$total_invest_project_income=0;



$total_plot_sell =0;
$customer_due_paymentt=0;
$customer_refundt=0;


  ?>
  
  <div id="h" >
<img width="500px;"   src="img/logo.jpg" >
<hr>
</div>
তারিখ :   {{convertToBangla($start)}} to {{convertToBangla($end)}} <br>

নগদ হিসাব শুধুমাত্রঃ 
<div  class="container">
<H2> খরচ  </h2>
  
 <?php if (!$externalcost->isEmpty())  { ?>
<h5 style="color:red">   বিবধ খরচ  </h5>

  <table class="table">
  <thead> 
    <tr>
    
      <th scope="col"> খরচের নাম  </th>
      <th scope="col"> মোট টাকা   </th>
     <th scope="col">পেইড   </th>
	  <th scope="col">বাকি   </th>
    </tr>
  </thead>
  <tbody>
    	
	@foreach($externalcost as $e)
	<?php  
	$total_expenses_amount = $total_expenses_amount + $e->total_amount;
	$total_expenses_due = $total_expenses_due + $e->total_due;
	$total_expenses_paid = $total_expenses_paid + ($e->total_amount - $e->total_due );
	
	?>
	
	<tr>
      <th >{{$e->khorocer_khad->name}}</th>
      <td> <?php echo  convertToBangla(round($e->total_amount,2));   $paid = $e->total_amount - $e->total_due ;    ?></td>
      <td> <?php echo convertToBangla(round($paid,2)) ?> </td>	  
       <td><?php echo convertToBangla(round($e->total_due,2)) ?></td>	     
    </tr>
@endforeach


	<tr>
      <th >মোট </th>
      <td> <?php echo convertToBangla(round($total_expenses_amount,2));      ?></td>
      <td> <?php echo convertToBangla(round($total_expenses_paid,2)) ?> </td>	  
       <td><?php echo convertToBangla(round($total_expenses_due,2)) ?></td>	     
    </tr>
  </tbody>
</table>
  


  <?php } ?>
  



 <?php if (!$company_cost->isEmpty())  { ?>
<h5 style="color:red">   সাপ্লাইয়ার থেকে পণ্য ক্রয়   </h5>

  <table class="table">
  <thead>
    <tr>
    
      <th scope="col"> সাপ্লাইয়ারের নাম   </th>
	 
	     <th scope="col"> প্রজেক্টের নাম  </th>
      <th scope="col"> মোট টাকা   </th>
     <th scope="col">পেইড   </th>
	  <th scope="col">বাকি   </th>
    </tr>
  </thead>
  <tbody>
    	
	@foreach($company_cost as $e)
	<?php  
	$total_company_amount = $total_company_amount + $e->total_amount;
	$total_company_due = $total_company_due + $e->total_due;
	$total_company_paid = $total_company_paid + $e->paid;
	
	?>
	
	<tr>
      <th >{{$e->productcompany->name}}</th>
	      <th >{{$e->project->name}}</th>
      <td> <?php echo  convertToBangla(round($e->total_amount,2));   $paid = $e->total_amount - $e->total_due ;    ?></td>
      <td> <?php echo convertToBangla(round($e->paid,2)) ?> </td>	  
       <td><?php echo convertToBangla(round($e->total_due,2)) ?></td>	     
    </tr>
@endforeach


	<tr>
	<th>NA</th>
      <th >মোট </th>
      <td> <?php echo  convertToBangla(round($total_company_amount,2));      ?></td>
      <td> <?php echo convertToBangla(round($total_company_paid,2)) ?> </td>	  
       <td><?php echo convertToBangla(round($total_company_due,2)) ?></td>	     
    </tr>
  </tbody>
</table>
  


  <?php } ?>



 <?php if (!$company_due_payment->isEmpty())  { ?>
<h5 style="color:red">   সাপ্লাইয়ারকে বাকি/ এডভান্স বাবদ টাকা প্রদান   </h5>

  <table class="table">
  <thead>
    <tr>
    
      <th scope="col"> সাপ্লাইয়ার নাম   </th>
<th> প্রজেক্ট নাম  </th>
      <th scope="col"> মোট টাকা   </th>

    </tr>
  </thead>
  <tbody>
    	
	@foreach($company_due_payment as $e)
	<?php  
	$total_due_paymet_company = $total_due_paymet_company + $e->total_amount;

	
	?>
	
	<tr>
      <th >{{$e->productcompany->name}}</th>
	      <th >{{$e->project->name}}</th>
      <td> <?php echo  convertToBangla(round($e->total_amount,2));      ?></td>
      
    </tr>
@endforeach


	<tr>
	<th>NA</th>
      <th >মোট </th>
      <td> <?php echo  convertToBangla(round($total_due_paymet_company,2));      ?></td>
	     
    </tr>
  </tbody>
</table>
  


  <?php } ?>





 <?php if (!$customer_refund->isEmpty())  { ?>
<h5 style="color:red">   ক্রেতাকে  রিফান্ড   </h5>

  <table class="table">
  <thead>
    <tr>
    
      <th scope="col"> ক্রেতার নাম   </th>
<th> প্রজেক্ট  </th>
      <th scope="col">প্লট   </th>
<th scope="col">টাকার পরিমাণ   </th>
    </tr>
  </thead>
  <tbody>
    	
	@foreach($customer_refund as $e)
	<?php  
	$customer_refundt = $customer_refundt + $e->paid;

	
	?>
	
	<tr>
      <th >{{$e->customer->name}}</th>
	      <th >{{$e->project->name}}</th>
		  	      <th >{{$e->plot->name}}</th>
      <td> <?php echo  convertToBangla(round($e->paid,2));      ?></td>
      
    </tr>
@endforeach


	<tr>
	<th>NA</th>
      <th >মোট </th>
	  <th>NA</th>
      <td> <?php echo  convertToBangla(round($customer_refundt,2));      ?></td>
	     
    </tr>
  </tbody>
</table>
  


  <?php } ?>




























<!---------------------------------- employee transition. chechk if threre any transition in the daterange. 
if yes then exexute  -->


<?php if (!$employee_salary->isEmpty())  { ?>
<h5 style="color:red">   বেতন বাবদ খরচ  </h5>

  <table class="table">
  <thead>
    <tr>
    
      <th scope="col"> কর্মচারী নাম   </th>
      <th scope="col">টাকার পরিমাণ   </th>
  
    </tr>
  </thead>
  <tbody>
    	
	@foreach($employee_salary as $e)
	<?php  
	$total_salary_amount = $total_salary_amount + $e->total_salary;
	
	
	?>
	
	<tr>
      <th >{{$e->employeedetails->name}}</th>
      <td> <?php echo  convertToBangla(round($e->total_salary,2));      ?></td>
    
    </tr>
@endforeach


	<tr>
      <th >মোট </th>
      <td> <?php echo  convertToBangla(round($total_salary_amount,2));      ?></td>
    
    </tr>
  </tbody>
</table>
  
 
  
 

  <?php } ?>
  
  
 


 

<?php if (!$dharshod->isEmpty())  { ?>
<h5 style="color:red"> অন্যান্য বাকি বাবদ টাকা প্রদান  </h5>

  <table class="table">
  <thead>
    <tr>
    
      <th scope="col"> সাপ্লাইয়ার   </th>
      <th scope="col">টাকা   </th>
  
    </tr>
  </thead>
  <tbody>
    	
	@foreach($dharshod as $e)
	<?php  
	$total_due_paymet = $total_due_paymet + $e->total_baki_shod;
	
	
	?>
	
	<tr>
      <th >{{$e->supplier->name}}</th>
      <td> <?php echo  convertToBangla(round($e->total_baki_shod,2)) ;      ?></td>
    
    </tr>
@endforeach


	<tr>
      <th >মোট </th>
      <td> <?php echo  convertToBangla(round($total_due_paymet,2));      ?></td>
    
    </tr>
  </tbody>
</table>


  <?php } ?> 
  
  

<?php if (!$money_given_to_project->isEmpty())  { ?>
<h5 style="color:red">   প্রজেক্ট সুপারভাইজার কে টাকা প্রদান   </h5>

  <table class="table">
  <thead>
    <tr>
    
      <th scope="col"> প্রজেক্ট  </th>
      <th scope="col">মোট টাকার পরিমাণ   </th>
  
    </tr>
  </thead>
  <tbody>
    	
	@foreach($money_given_to_project as $e)
	<?php  
	$total_invest_project = $total_invest_project + $e->total;
	
	
	?>
	
	<tr>
 	  	  <?php if($e->project_id){ ?>
	  
	   <th >{{$e->project->name}}</th>
	   
	  <?php } else { ?>
	  
	  <th> NA</th>
	  <?php } ?>
      <td> <?php echo  convertToBangla(round($e->total,2));       ?></td>
    
    </tr>
@endforeach


	<tr>
      <th >Total</th>
      <td> <?php echo  convertToBangla(round($total_invest_project,2));      ?></td>
    
    </tr>
  </tbody>
</table>


  <?php } ?> 
 

  
<?php if (!$money_given_to_bank->isEmpty())  { ?>
<h5 style="color:red">  ব্যাংকে টাকা জমা  </h5>

  <table class="table">
  <thead>
    <tr>
    
      <th scope="col"> ব্যাংক   </th>
      <th scope="col">মোট পরিমাণ   </th>
  
    </tr>
  </thead>
  <tbody>
    	
	@foreach($money_given_to_bank as $e)
	<?php  
	$total_withdrawl_bank = $total_withdrawl_bank + $e->total;
	
	
	?>
	
	<tr>
      <th >
	  <?php 
  
	 
$b_name = App\Models\Bankname::findOrFail($e->Bankname_id)->name;	 
	  
	  ?>
	  
	  {{$b_name}}</th>
      <td> <?php echo  convertToBangla(round($e->total,2));      ?></td>
    
    </tr>
@endforeach


	<tr>
      <th >মোট </th>
      <td> <?php echo  convertToBangla(round($total_withdrawl_bank,2));      ?></td>
    
    </tr>
  </tbody>
</table>


  <?php } ?> 



 <?php if (!$money_withdrawl->isEmpty())  { ?>
<h5 style="color:red">   মালিক পক্ষ থেকে উত্তোলন </h5>
 <table class="table">
  <thead>
    <tr>
    
      <th scope="col"> পার্টনারের  নাম   </th>
      <th scope="col"> মোট  <th>
  
    </tr>
  </thead>
  <tbody>
    	
	@foreach($money_withdrawl as $e)
	<?php  
	$total_withdrawl_owner = $total_withdrawl_owner + $e->total;
	
	
	?>
	
	<tr>
      <th >{{$e->sharepartner->name}}</th>
      <td> <?php echo  convertToBangla(round($e->total,2));      ?></td>
    
    </tr>
@endforeach


	<tr>
      <th >Total</th>
      <td> <?php echo  convertToBangla(round($total_withdrawl_owner,2));      ?></td>
    
    </tr>
  </tbody>
</table>


  <?php } ?>



  <?php if (!$money_taken_from_project->isEmpty())  { ?>
<h5 style="color:red">   প্রজেক্ট থেকে টাকা উত্তোলন   </h5>

  <table class="table">
  <thead>
    <tr>
    
      <th scope="col"> প্রজেক্ট   </th>
      <th scope="col">মোট   </th>
  
    </tr>
  </thead>
  <tbody>
    	
	@foreach($money_taken_from_project as $e)
	<?php  
	$money_return_back_from_project_expenses = $money_return_back_from_project_expenses + $e->total;
	
	
	?>
	
	<tr>
	  	  <?php if($e->project_id){ ?>
	  
	   <th >{{$e->project->name}}</th>
	   
	  <?php } else { ?>
	  
	  <th> NA</th>
	  <?php } ?>
      <td> <?php echo convertToBangla(round($e->total,2));      ?></td>
    
    </tr>
@endforeach


	<tr>
      <th >মোট </th>
      <td> <?php echo convertToBangla(round($money_return_back_from_project_expenses,2));      ?></td>
    
    </tr>
  </tbody>
</table>


  <?php } ?>
  
  
    </div>


</div>
      
	
	

	
	
	
	
<div  style=" margin-left:5px;" class="col-sm">
<h2 >      আয়  </h2>
<hr>







 <?php if (!$customer_due_payment->isEmpty())  { ?>
<h5 style="color:red">    ক্রেতার বাকি প্রদান  </h5>

  <table class="table">
  <thead>
    <tr>
    
      <th scope="col"> ক্রেতার নাম  </th>
<th> প্রজেক্ট  </th>
      <th scope="col">প্লট/ ফ্লাট    </th>
<th scope="col">টাকার পরিমাণ   </th>
    </tr>
  </thead>
  <tbody>
    	
	@foreach($customer_due_payment as $e)
	<?php  
	$customer_due_paymentt = $customer_due_paymentt + $e->paid;

	
	?>
	
	<tr>
      <th >{{$e->customer->name}}</th>
	      <th >{{$e->project->name}}</th>
		  	      <th >{{$e->plot->name}}</th>
      <td> <?php echo  convertToBangla(round($e->paid,2));      ?></td>
      
    </tr>
@endforeach


	<tr>
	<th>NA</th>
      <th >মোট </th>
	  <th>NA</th>
      <td> <?php echo  convertToBangla(round($customer_due_paymentt,2));      ?></td>
	     
    </tr>
  </tbody>
</table>
  


  <?php } ?>




 <?php if (!$plotsell->isEmpty())  { ?>
<h5 style="color:red">   প্লট/ফ্লাট বিক্রি  </h5>

  <table class="table">
  <thead>
    <tr>
    
      <th scope="col"> ক্রেতার নাম   </th>
<th> প্রজেক্ট  </th>
      <th scope="col">প্লট/ ফ্লাট   </th>
<th scope="col">টাকার পরিমাণ   </th>
    </tr>
  </thead>
  <tbody>
    	
	@foreach($plotsell as $e)
	<?php  
	$total_plot_sell = $total_plot_sell + $e->paid;

	
	?>
	
	<tr>
      <th >{{$e->customer->name}}</th>
	      <th >{{$e->project->name}}</th>
		  	      <th >{{$e->plot->name}}</th>
      <td> <?php echo convertToBangla(round($e->paid,2));      ?></td>
      
    </tr>
@endforeach


	<tr>
	<th>NA</th>
      <th >মোট </th>
	  <th>NA</th>
      <td> <?php echo  convertToBangla(round($total_plot_sell,2));      ?></td>
	     
    </tr>
  </tbody>
</table>
  


  <?php } ?>











 
 <?php if (!$money_given_to_project->isEmpty())  { ?>
<h5 style="color:red">   প্রজেক্ট সুপার ভাইজারকে টাকা প্রদান  </h5>

  <table class="table">
  <thead>
    <tr>
    
      <th scope="col"> প্রজেক্ট   </th>
      <th scope="col">মোট   </th>
  
    </tr>
  </thead>
  <tbody>
    	
	@foreach($money_given_to_project as $e)
	<?php  
	$total_invest_project_income = $total_invest_project_income + $e->total;
	
	
	?>
	
	<tr>
 	  	  <?php if($e->project_id){ ?>
	  
	   <th >{{$e->project->name}}</th>
	   
	  <?php } else { ?>
	  
	  <th> NA</th>
	  <?php } ?>
      <td> <?php echo  convertToBangla(round($e->total,2));      ?></td>
    
    </tr>
@endforeach


	<tr>
      <th >মোট </th>
      <td> <?php echo convertToBangla(round($total_invest_project_income,2));      ?></td>
    
    </tr>
  </tbody>
</table>


  <?php } ?> 
 
 
 
 
 
 
 
 
 
 
 
 
	

 <?php if (!$money_back_from_company->isEmpty())  { ?>
<h5 style="color:red">  সাপ্লাইয়ার থেকে টাকা ফেরত   </h5>

  <table class="table">
  <thead>
    <tr>
    
      <th scope="col"> সাপ্লাইয়ার   </th>
<th> প্রজেক্ট  </th>
      <th scope="col"> মোট টাকা   </th>

    </tr>
  </thead>
  <tbody>
    	
	@foreach($money_back_from_company as $e)
	<?php  
	$money_back_company = $money_back_company + $e->total_amount;

	
	?>
	
	<tr>
      <th >{{$e->productcompany->name}}</th>
	      <th >{{$e->project->name}}</th>
      <td> <?php echo  convertToBangla(round($e->total_amount,2));      ?></td>
      
    </tr>
@endforeach


	<tr>
	<th>NA</th>
      <th >মোট </th>
      <td> <?php echo  convertToBangla(round($money_back_company,2));      ?></td>
	     
    </tr>
  </tbody>
</table>
  


  <?php } ?>	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
  <?php if (!$income->isEmpty())  { ?>
<h5 style="color:red">   Incomes from various fields  </h5>

  <table class="table">
  <thead>
    <tr>
    
      <th scope="col"> Source  </th>
	
	   <th scope="col"> Project  </th>
      <th scope="col">Total  </th>
     <th scope="col">Paid  </th>
	  <th scope="col">Due  </th>
    </tr>
  </thead>
  <tbody>
    	
	@foreach($income as $e)
	<?php  
$total_paid_income = $total_paid_income + $e->income_in_cash;
$total_due_income = $total_due_income + $e->total_due;
$total_amount_income = $total_amount_income + $e->income_in_cash + $e->total_due;
	//$i_name = App\Models\externalincomesource::findOrFail($e->externalincomesource_id)->name;
	?>
	
	<tr>
      <th >{{$e->externalincomeprovider->name}}</th>
	  
	  	  <?php if($e->project_id){ ?>
	  
	   <th >{{$e->project->name}}</th>
	   
	  <?php } else { ?>
	  
	  <th> NA</th>
	  <?php } ?>
      <td> <?php $amount =$e->income_in_cash + $e->total_due;  echo  round($amount,2);      ?></td>
      <td> <?php echo round($e->income_in_cash,2) ?> </td>	  
       <td><?php echo round($e->total_due,2) ?></td>	     
    </tr>
@endforeach


	<tr>
	<th >NA</th>
      <th >Total</th>
      <td> <?php echo  round($total_amount_income,2);      ?></td>
      <td> <?php echo round($total_paid_income,2) ?> </td>	  
       <td><?php echo round($total_due_income,2) ?></td>	     
    </tr>
  </tbody>
</table>
  


  <?php } ?> 




 <?php if (!$money_deposit->isEmpty())  { ?>
<h5 style="color:red">   পার্টনার থেকে ইনভেস্টমেন্ট  </h5>
 <table class="table">
  <thead>
    <tr>
    
      <th scope="col"> পার্টনার   </th>
      <th scope="col">মোট   </th>
  
    </tr>
  </thead>
  <tbody>
    	
	@foreach($money_deposit as $e)
	<?php  
	$total_investment = $total_investment + $e->total;
	
	
	?>
	
	<tr>
      <th >{{$e->sharepartner->name}}</th>
      <td> <?php echo convertToBangla(round($e->total,2));      ?></td>
    
    </tr>
@endforeach


	<tr>
      <th >মোট </th>
      <td> <?php echo  convertToBangla(round($total_investment,2));      ?></td>
    
    </tr>
  </tbody>
</table>


  <?php } ?>


<?php if (!$money_taken_from_project->isEmpty())  { ?>
<h5 style="color:red">   প্রজেক্ট থেকে টাকা ফেরত   </h5>

  <table class="table">
  <thead>
    <tr>
    
      <th scope="col"> প্রজেক্ট  </th>
      <th scope="col">মোট   </th>
  
    </tr>
  </thead>
  <tbody>
    	
	@foreach($money_taken_from_project as $e)
	<?php  
	$money_return_back_from_project = $money_return_back_from_project + $e->total;
	
	
	?>
	
	<tr>
	  	  <?php if($e->project_id){ ?>
	  
	   <th >{{$e->project->name}}</th>
	   
	  <?php } else { ?>
	  
	  <th> NA</th>
	  <?php } ?>
      <td> <?php echo convertToBangla(round($e->total,2));      ?></td>
    
    </tr>
@endforeach


	<tr>
      <th >Total</th>
      <td> <?php echo convertToBangla (round($money_return_back_from_project,2));      ?></td>
    
    </tr>
  </tbody>
</table>


  <?php } ?> 


<?php if (!$money_come_from_bank->isEmpty())  { ?>
<h5 style="color:red">   ব্যাংক থেকে ব্যবসায় টাকা আনায়ন   </h5>

  <table class="table">
  <thead>
    <tr>
    
      <th scope="col"> ব্যাংক   </th>
      <th scope="col">মোট   </th>
  
    </tr>
  </thead>
  <tbody>
    	
	@foreach($money_come_from_bank as $e)
	<?php  
	$total_come_from_bank = $total_come_from_bank + $e->total;
	
	
	?>
	
	<tr>
      <th >
	  <?php 
  
	 
$b_name = App\Models\Bankname::findOrFail($e->Bankname_id)->name;	 
	  
	  ?>
	  
	  {{$b_name}}</th>
      <td> <?php echo convertToBangla(round($e->total,2));      ?></td>
    
    </tr>
@endforeach


	<tr>
      <th >Total</th>
      <td> <?php echo convertToBangla(round($total_come_from_bank,2));      ?></td>
    
    </tr>
  </tbody>
</table>


  <?php } ?> 


  <?php  if (!$due_collection->isEmpty())  { ?>
<h5 style="color:red">   Due Collection from External Income Provider</h5>
 <table class="table">
  <thead>
    <tr>
	<th>Source </th>
     <th scope="col"> Project Name  </th>
      
      <th scope="col">Total  </th>
  
    </tr>
  </thead>
  <tbody>
    	
	@foreach($due_collection as $e)
	<?php  
	$total_due_collection = $total_due_collection + $e->total_due_collection;
	
	
	?>
	
	<tr>
      <th >{{$e->externalincomeprovider->name}}</th>
	       
<?php if($e->project_id){?>
		   <th >{{$e->project->name}}</th>
<?php } else{ ?>
<th> NA</th> <?php } ?>

      <td> <?php echo  round($e->total_due_collection,2);      ?></td>
    
    </tr>
@endforeach


	<tr>
	   <th >NA</th>
      <th >Total</th>
      <td> <?php echo  round($total_due_collection,2);      ?></td>
    
    </tr>
  </tbody>
</table>


  <?php } ?> 
  
 <?php 
$total_expenses = $total_expenses_paid+$total_salary_amount+$total_due_paymet+$total_invest_project+$total_withdrawl_bank+$total_withdrawl_owner+$total_company_paid + $total_due_paymet_company+$money_return_back_from_project_expenses+ $customer_refundt;

$total_earn =$total_paid_income+$total_investment+$money_return_back_from_project+$total_come_from_bank
+$total_due_collection+ $money_back_company+$total_invest_project_income+ $total_plot_sell + $customer_due_paymentt;


 ?>
 <p>
  <b>মোট নগদ খরচ :</b> {{convertToBangla($total_expenses)}}টাকা  <br> 
  <b>মোট নগদ আয় </b> {{$total_earn}} TK<br>
  
  <b>নেট আয় :</b> {{convertToBangla($total_earn - $total_expenses)}}টাকা .



 






</div>


    
</body>
</html>
