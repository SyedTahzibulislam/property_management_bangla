<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<style>

table {
  font-family: arial, sans-serif;
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
 $total_company_amount = 0 ;

$total_company_due = 0;

$total_caopnay_paid = 0;
$total_company_duepayment=0;
$money_return_back_from_project_expenses=0;







$total_paid_income = 0;
$total_due_income = 0;
$total_amount_income=0;
$total_investment=0;
$money_return_back_from_project=0;
$total_come_from_bank=0;
$total_due_collection =0;
$total_company_refund=0;
$total_invest_project_income=0;




$total_plot_sell =0;
$customer_due_paymentt=0;
$customer_refundt=0;

// total_investment
  ?>
  
  <div id="h" >
<img width="500px;"   src="img/logo.jpg" >
<hr>
</div>
Date: {{$start}} to {{$end}}
<div  class="container">
<H2> Expenses </h2>
  
  
  
  
  <?php if (!$company_cost->isEmpty())  { ?> 
  
  Product Purchase from Company/Dealer
<table>
    
<thead>	
  <tr>
 <th style="width:40px;" >	Date</th>
   <th style="width:40px;" >	project Name</th>
      <th style="width:40px;" >	Company Name</th>
    <th style="width:150px;" >
	
	  Product Name
    
	 </th>
	  <th style="width:100px;"  >Comment</th>
    <th style="width:100px;"  >Amount(TK)</th>
	 
	 <th style="width:100px;"  >Due </th>
	 
	 <th style="width:100px;"   >Paid</th> 
	
<th style="width:100px;"   >Entry By</th> 	
  </tr>
  </thead>
 @foreach ( $company_cost as $o )



  <tr>

  <td> <?php echo date('d/m/Y', strtotime($o->created_at));; ?> </td>
   <td> {{$o->project->name}}</td>
   <td> {{$o->productcompany->name}}</td>
    <td> 

<table>
  <tr>
    <th style="width:100px;" >Product Name </th>
    <th>Qun.</th>
	<th>Unit Pr.</th>
    <th>Unit</th>
  </tr>
  

 
 @foreach ( $o->productcompanytransition as $t )
  <tr>
    <td> {{$t->Productcompany->name}}</td>
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


<?php $total_company_amount = $total_company_amount + $o->amount ;

$total_company_due = $total_company_due + $o->debit;

$total_caopnay_paid = $total_caopnay_paid+ $o->credit; ?>

 <td><?php echo round($o->amount,2); ?> </td>


	 <td><?php echo round($o->debit,2); ?></td>
	 
	 <td><?php echo round($o->credit,2); ?></td>

  <td> {{$o->user->name}} </td>
	 
	 
  </tr>

@endforeach 

<tr>

<td>Total </td>
<td>NA</td>
<td>NA</td>
<td>NA</td>
<td>NA</td>
<td> <?php echo round($total_company_amount,2); ?></td>
<td> <?php echo round($total_company_due,2); ?></td>
<td> <?php echo round($total_caopnay_paid,2); ?></td>
<td>NA</td>




</td>
</table>
	 
  <?php } ?>
  
  
  
  
  <p>
  
   <?php if (!$customer_refund->isEmpty())  { ?>
<h5 style="color:red">   Refund to Customer  </h5>

  <table class="table">
  <thead>
    <tr>
    
      <th scope="col"> Customer Name  </th>
<th> Project Name </th>
      <th scope="col">Plot Name  </th>
<th scope="col">Amount  </th>
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
      <td> <?php echo  round($e->paid,2);      ?></td>
      
    </tr>
@endforeach


	<tr>
	<th>NA</th>
      <th >Total</th>
	  <th>NA</th>
      <td> <?php echo  round($customer_refundt,2);      ?></td>
	     
    </tr>
  </tbody>
</table>
  


  <?php } ?>
  
  <p>
  
    <?php if (!$company_due_payment->isEmpty())  { ?> 
  
  Due Payment for the  Company/Dealer
<table>
    
<thead>	
  <tr>
 <th style="width:40px;" >	Date</th>
    
   <th style="width:40px;" >	project Name</th>
<th style="width:40px;" >	Company Name</th>
	  <th style="width:100px;"  >Comment</th>
    <th style="width:100px;"  >Amount(TK)</th>
	<th style="width:100px;"  >Entry By</th> 
 
	 
  </tr>
  </thead>
 @foreach ( $company_due_payment as $o )



  <tr>

  <td> <?php echo date('d/m/Y', strtotime($o->created_at));; ?> </td>
   <td> {{$o->project->name}}</td>
 <td> {{$o->productcompany->name}}</td>
  
<td> 


    {!! nl2br(e($o->comment)) !!}   





 </td>


<?php 

$total_company_duepayment = $total_company_duepayment + $o->amountafterdiscount	;

 ?>

 <td><?php echo round($o->amountafterdiscount,2); ?> </td>

<td> {{ $o->user->name }}</td>


	 
	 
  </tr>

@endforeach 

<tr>

<td>Total </td>
<td>NA</td>
<td>NA</td>
<td>NA</td>

<td> <?php echo round($total_company_duepayment,2); ?></td>
<td>NA</td>





</td>
</table>
	 
  <?php } ?>
 
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
 <?php if (!$externalcost->isEmpty())  { ?>
<h5 style="color:red">   Various Expenses  </h5>

  <table class="table">
  <thead>
    <tr>
     <th scope="col"> Date  </th>
      <th scope="col"> Expenses Name  </th>
	  <th scope="col"> Source Name  </th>
	   <th scope="col"> Project Name  </th>
      <th scope="col">Total  </th>
     <th scope="col">Paid  </th>
	  <th scope="col">Due  </th>
	  <th scope="col">Entry By  </th>
    </tr>
  </thead>
  <tbody>
    	
	@foreach($externalcost as $e)
	<?php  
	$total_expenses_amount = $total_expenses_amount + $e->amount;
	$total_expenses_due = $total_expenses_due + $e->due;
	$total_expenses_paid = $total_expenses_paid + ($e->amount - $e->due );
	
	?>
	
	<tr>
	<td> <?php echo date('d/m/Y', strtotime($e->created_at));; ?> </td>
      <th >{{$e->khorocer_khad->name}}</th>
	  <th >{{$e->supplier->name}}</th>
	
	  
	  
	  
	  	  <?php if($e->project_id){ ?>
	  
	   <th >{{$e->project->name}}</th>
	   
	  <?php } else { ?>
	  
	  <th> NA</th>
	  <?php } ?>
	  
	  
	  
      <td> <?php echo  round($e->amount,2);   $paid = $e->amount - $e->due ;    ?></td>
      <td> <?php echo round($paid,2) ?> </td>	  
       <td><?php echo round($e->due,2) ?></td>	  
<td> {{ $e->user->name }} </td>	   
    </tr>
@endforeach


	<tr>
	<th>NA</th>
	<th>NA</th>
	<th>NA</th>
      <th >Total</th>
      <td> <?php echo  round($total_expenses_amount,2);      ?></td>
      <td> <?php echo round($total_expenses_paid,2) ?> </td>	  
       <td><?php echo round($total_expenses_due,2) ?></td>	
	   <th>NA</th>
    </tr>
  </tbody>
</table>
  


  <?php } ?>
  



















<!---------------------------------- employee transition. chechk if threre any transition in the daterange. 
if yes then exexute  -->


<?php if (!$employee_salary->isEmpty())  { ?>
<h5 style="color:red">   Salary Expenses </h5>

  <table class="table">
  <thead>
    <tr>
     <th scope="col"> Date  </th>
      <th scope="col"> Employee Name  </th>
	  <th scope="col"> Project Name  </th>
      <th scope="col">Total  </th>
    
    </tr>
  </thead>
  <tbody>
    	
	@foreach($employee_salary as $e)
	<?php  
	$total_salary_amount = $total_salary_amount + $e->totalsalary;
	
	
	?>
	
	<tr>
	<td> <?php echo date('d/m/Y', strtotime($e->created_at));; ?> </td>
      <th >{{$e->employeedetails->name}}</th>
	  <?php if($e->project_id){ ?>
	  
	   <th >{{$e->project->name}}</th>
	   
	  <?php } else { ?>
	  
	  <th> NA</th>
	  <?php } ?>
	   
      <td> <?php echo  round($e->totalsalary,2);      ?></td>
   
    </tr>
@endforeach


	<tr>
	<th >Total</th>
	  <th >NA</th>
      <th >NA</th>
      <td> <?php echo  round($total_salary_amount,2);      ?></td>
    <th >NA</th>
    </tr>
  </tbody>
</table>
  
 
  
 

  <?php } ?>
  
  
 


 

<?php if (!$dharshod->isEmpty())  { ?>
<h5 style="color:red">   Due Payment Expenses </h5>

  <table class="table">
  <thead>
    <tr>
     <th scope="col"> Date </th>
      <th scope="col"> Supplier Name  </th>
	  <th> Project Name</th>
      <th scope="col">Total  </th>
  <th scope="col">Entry By  </th>
    </tr>
  </thead>
  <tbody>
    	
	@foreach($dharshod as $e)
	<?php  
	$total_due_paymet = $total_due_paymet + $e->amount;
	
	
	?>
	
	<tr>
	<td> <?php echo date('d/m/Y', strtotime($e->created_at));; ?> </td>
      <th >{{$e->supplier->name}}</th>
	  
	  
	  	  <?php if($e->project_id){ ?>
	  
	   <th >{{$e->project->name}}</th>
	   
	  <?php } else { ?>
	  
	  <th> NA</th>
	  <?php } ?>
	  
	  
	  
	  
      <td> <?php echo  round($e->amount,2);      ?></td>
     <td> {{$e->user->name}}</td>
    </tr>
@endforeach


	<tr>
      <th >Total</th>
	   <th >NA</th>
	    <th >NA</th>
      <td> <?php echo  round($total_due_paymet,2);      ?></td>
    <th >NA</th>
    </tr>
  </tbody>
</table>


  <?php } ?> 
  
  

<?php if (!$money_given_to_project->isEmpty())  { ?>
<h5 style="color:red">   Money given to Project Supervisors  </h5>

  <table class="table">
  <thead>
    <tr>
     <th scope="col"> Date </th>
      <th scope="col"> Project Name  </th>
      <th scope="col">Total  </th>
  <th scope="col">Entry By  </th>
    </tr>
  </thead>
  <tbody>
    	
	@foreach($money_given_to_project as $e)
	<?php  
	$total_invest_project = $total_invest_project + $e->amount;
	
	
	?>
	
	<tr>
	<td> <?php echo date('d/m/Y', strtotime($e->created_at));; ?> </td>
      <th >{{$e->project->name}}</th>
      <td> <?php echo  round($e->amount,2);      ?></td>
    <td> {{$e->user->name}}</td>
    </tr>
@endforeach


	<tr>
      <th >Total</th>
	   <th >NA</th>
      <td> <?php echo  round($total_invest_project,2);      ?></td>
     <th >NA</th>
    </tr>
  </tbody>
</table>


  <?php } ?> 
 

  
<?php if (!$money_given_to_bank->isEmpty())  { ?>
<h5 style="color:red">   Money Withdrwal to deposit in Bank </h5>

  <table class="table">
  <thead>
    <tr>
    <th scope="col"> Date  </th>
      <th scope="col"> Bank Name  </th>
      <th scope="col">Total  </th>
   <th scope="col">Entry By  </th>
    </tr>
  </thead>
  <tbody>
    	
	@foreach($money_given_to_bank as $e)
	<?php  
	$total_withdrawl_bank = $total_withdrawl_bank + $e->amount;
	
	
	?>
	
	<tr>
	
	<td> <?php echo date('d/m/Y', strtotime($e->created_at));; ?> </td>
      <th >
	  <?php 
  
	 
$b_name = App\Models\Bankname::findOrFail($e->Bankname_id)->name;	 
	  
	  ?>
	  
	  {{$b_name}}</th>
      <td> <?php echo  round($e->amount,2);      ?></td>
    <td> {{ $e->user->name }}
    </tr>
@endforeach


	<tr>
      <th >Total</th>
	  <th >NA</th>
      <td> <?php echo  round($total_withdrawl_bank,2);      ?></td>
     <th >NA</th>
    </tr>
  </tbody>
</table>


  <?php } ?> 



 <?php if (!$money_withdrawl->isEmpty())  { ?>
<h5 style="color:red">   Money Withdrwal by owners </h5>
 <table class="table">
  <thead>
    <tr>
     <th scope="col"> Date  </th>
      <th scope="col"> Owner Name  </th>
      <th scope="col">Total  </th>
  <th scope="col">Entry By  </th>
    </tr>
  </thead>
  <tbody>
    	
	@foreach($money_withdrawl as $e)
	<?php  
	$total_withdrawl_owner = $total_withdrawl_owner + $e->amount;
	
	
	?>
	
	<tr>
	<td> <?php echo date('d/m/Y', strtotime($e->created_at));; ?> </td>
      <th >{{$e->sharepartner->name}}</th>
      <td> <?php echo  round($e->amount,2);      ?></td>
    <td> {{$e->user->name}}</td>
    </tr>
@endforeach


	<tr>
      <th >Total</th>
	    <th >NA</th>
      <td> <?php echo  round($total_withdrawl_owner,2);      ?></td>
    <th >NA</th>
    </tr>
  </tbody>
</table>


  <?php } ?>



  
  
  
    </div>


</div>
      
	
	<?php if (!$money_taken_from_project->isEmpty())  { ?>
<h5 style="color:red">   Money Return Back from Project Supervisors  </h5>

  <table class="table">
  <thead>
    <tr>
    <th scope="col"> Date </th>
      <th scope="col"> Project Name  </th>
      <th scope="col">Total  </th>
  <th scope="col">Entry By  </th>
    </tr>
  </thead>
  <tbody>
    	
	@foreach($money_taken_from_project as $e)
	<?php  
	$money_return_back_from_project_expenses = $money_return_back_from_project_expenses + $e->amount;
	
	
	?>
	
	<tr>
	<td> <?php echo date('d/m/Y', strtotime($e->created_at));; ?> </td>
      <th >{{$e->project->name}}</th>
      <td> <?php echo  round($e->amount,2);      ?></td>
    <td >{{$e->user->name}}</td>
    </tr>
@endforeach


	<tr>
	 <th >NA</th>
      <th >Total</th>
      <td> <?php echo  round($money_return_back_from_project_expenses,2);      ?></td>
    <th >NA</th>
    </tr>
  </tbody>
</table>


  <?php } ?> 

	
	
	
	
<div  style=" margin-left:5px;" class="col-sm">
<h2 >      Income in business </h2>
<hr>


<!---------------------------------- pathology transition . chechk if threre any transition in the daterange. 
if yes then exexute  -->
 
 
 
 <?php if (!$money_given_to_project->isEmpty())  { ?>
<h5 style="color:red">   Money given to Project Supervisors  </h5>

  <table class="table">
  <thead>
    <tr>
     <th scope="col"> Date </th>
      <th scope="col"> Project Name  </th>
      <th scope="col">Total  </th>
  <th scope="col">Entry By  </th>
    </tr>
  </thead>
  <tbody>
    	
	@foreach($money_given_to_project as $e)
	<?php  
	$total_invest_project_income = $total_invest_project_income + $e->amount;
	
	
	?>
	
	<tr>
	<td> <?php echo date('d/m/Y', strtotime($e->created_at));; ?> </td>
      <td >{{$e->project->name}}</td>
      <td> <?php echo  round($e->amount,2);      ?></td>
       <td >{{$e->user->name}}</td>
    </tr>
@endforeach


	<tr>
      <th >Total</th>
	   <th >NA</th>
      <td> <?php echo  round($total_invest_project_income,2);      ?></td>
       <th >NA</th>
    </tr>
  </tbody>
</table>


  <?php } ?>
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
     <?php if (!$money_back_from_company->isEmpty())  { ?> 
  
Refund By Company/Dealer
<table>
    
<thead>	
  <tr>
 <th style="width:40px;" >	Date</th>
    
   <th style="width:40px;" >	project Name</th>
<th style="width:40px;" >	Company Name</th>
	  <th style="width:100px;"  >Comment</th>
    <th style="width:100px;"  >Amount(TK)</th>
	<th style="width:100px;"  >Entry By</th> 
 
	 
  </tr>
  </thead>
 @foreach ( $money_back_from_company as $o )



  <tr>

  <td> <?php echo date('d/m/Y', strtotime($o->created_at));; ?> </td>
   <td> {{$o->project->name}}</td>
 <td> {{$o->productcompany->name}}</td>
  
<td> 


    {!! nl2br(e($o->comment)) !!}   





 </td>


<?php 

$total_company_refund = $total_company_refund + $o->debit	;

 ?>

 <td><?php echo round($o->debit,2); ?> </td>

 <td>{{$o->user->name}}</td>


	 
	 
  </tr>

@endforeach 

<tr>

<td>Total </td>
<td>NA</td>
<td>NA</td>
<td>NA</td>

<td> <?php echo round($total_company_refund,2); ?></td>
<td>NA</td>





</td>
</table>
	 
  <?php } ?>
 
 
 
   
 <?php if (!$customer_due_payment->isEmpty())  { ?>
<h5 style="color:red">    Customer Due Payment </h5>

  <table class="table">
  <thead>
    <tr>
    
      <th scope="col"> Customer Name  </th>
<th> Project Name </th>
      <th scope="col">Plot Name  </th>
<th scope="col">Amount  </th>
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
      <td> <?php echo  round($e->paid,2);      ?></td>
      
    </tr>
@endforeach


	<tr>
	<th>NA</th>
      <th >Total</th>
	  <th>NA</th>
      <td> <?php echo  round($customer_due_paymentt,2);      ?></td>
	     
    </tr>
  </tbody>
</table>
  


  <?php } ?>  
  
  
  
  
  
 <?php if (!$plotsell->isEmpty())  { ?>
<h5 style="color:red">   Income from Plot sale </h5>

  <table class="table">
  <thead>
    <tr>
    
      <th scope="col"> Customer Name  </th>
<th> Project Name </th>
      <th scope="col">Plot Name  </th>
<th scope="col">Amount  </th>
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
      <td> <?php echo  round($e->paid,2);      ?></td>
      
    </tr>
@endforeach


	<tr>
	<th>NA</th>
      <th >Total</th>
	  <th>NA</th>
      <td> <?php echo  round($total_plot_sell,2);      ?></td>
	     
    </tr>
  </tbody>
</table>
  


  <?php } ?>  
 
 
 
 
 
 
 
 
	
	
  <?php if (!$income->isEmpty())  { ?>
<h5 style="color:red">   Incomes from various fields  </h5>

  <table class="table">
  <thead>
    <tr>
    <th scope="col"> Date  </th>
      <th scope="col"> Source  </th>
	   <th scope="col"> Income  </th>
	   <th scope="col"> Project  </th>
      <th scope="col">Total  </th>
     <th scope="col">Paid  </th>
	  <th scope="col">Due  </th>
	   <th scope="col">Entry By  </th>
    </tr>
  </thead>
  <tbody>
    	
	@foreach($income as $e)
	<?php  
$total_paid_income = $total_paid_income + $e->amount;
$total_due_income = $total_due_income + $e->due;
$total_amount_income = $total_amount_income + $e->amount + $e->due;
	
	?>
	
	<tr>
	<td> <?php echo date('d/m/Y', strtotime($e->created_at));; ?> </td>
      <th >{{$e->externalincomeprovider->name}}</th>
	   <th >{{$e->externalincomesource->name}}</th>
	  	  <?php if($e->project_id){ ?>
	  
	   <th >{{$e->project->name}}</th>
	   
	  <?php } else { ?>
	  
	  <th> NA</th>
	  <?php } ?>
      <td> <?php $amount =$e->amount + $e->due;  echo  round($amount,2);      ?></td>
      <td> <?php echo round($e->amount,2) ?> </td>	  
       <td><?php echo round($e->due,2) ?></td>	    
<th >{{$e->user->name}}</th>	   
    </tr>
@endforeach


	<tr>
	<th> NA</th>
	<th> NA</th>
	<th >NA</th>
      <th >Total</th>
      <td> <?php echo  round($total_amount_income,2);      ?></td>
      <td> <?php echo round($total_paid_income,2) ?> </td>	  
       <td><?php echo round($total_due_income,2) ?></td>
	<th >NA</th>	   
    </tr>
  </tbody>
</table>
  


  <?php } ?> 




 <?php if (!$money_deposit->isEmpty())  { ?>
<h5 style="color:red">   Investment by owners in business </h5>
 <table class="table">
  <thead>
    <tr>
    <th scope="col"> Date </th>
      <th scope="col"> Owner Name  </th>
      <th scope="col">Total  </th>
 
    </tr>
  </thead>
  <tbody>
    	
	@foreach($money_deposit as $e)
	<?php  
	$total_investment = $total_investment + $e->amount;
	
	
	?>
	
	<tr>
	<td> <?php echo date('d/m/Y', strtotime($e->created_at));; ?> </td>
      <th >{{$e->sharepartner->name}}</th>
      <td> <?php echo  round($e->amount,2);      ?></td>
 
    </tr>
@endforeach


	<tr>
	 <th >NA</th>
      <th >Total</th>
      <td> <?php echo  round($total_investment,2);      ?></td>

    </tr>
  </tbody>
</table>


  <?php } ?>


<?php if (!$money_taken_from_project->isEmpty())  { ?>
<h5 style="color:red">   Money Return Back from Project Supervisors  </h5>

  <table class="table">
  <thead>
    <tr>
    <th scope="col"> Date </th>
      <th scope="col"> Project Name  </th>
      <th scope="col">Total  </th>
   <th scope="col"> Entry </th>
    </tr>
  </thead>
  <tbody>
    	
	@foreach($money_taken_from_project as $e)
	<?php  
	$money_return_back_from_project = $money_return_back_from_project + $e->amount;
	
	
	?>
	
	<tr>
	<td> <?php echo date('d/m/Y', strtotime($e->created_at));; ?> </td>
      <th >{{$e->project->name}}</th>
      <td> <?php echo  round($e->amount,2);      ?></td>
    <th >{{$e->user->name}}</th>
    </tr>
@endforeach


	<tr>
	 <th >NA</th>
      <th >Total</th>
      <td> <?php echo  round($money_return_back_from_project,2);      ?></td>
    <th >NA</th>
    </tr>
  </tbody>
</table>


  <?php } ?> 


<?php if (!$money_come_from_bank->isEmpty())  { ?>
<h5 style="color:red">   Money brought from Bank to Business  </h5>

  <table class="table">
  <thead>
    <tr>
     <th scope="col"> Date </th>
      <th scope="col"> Bank Name  </th>
      <th scope="col">Total  </th>
  <th scope="col">Entry By  </th>
    </tr>
  </thead>
  <tbody>
    	
	@foreach($money_come_from_bank as $e)
	<?php  
	$total_come_from_bank = $total_come_from_bank + $e->amount;
	
	
	?>
	
	<tr>
	<td> <?php echo date('d/m/Y', strtotime($e->created_at));; ?> </td>
      <th >
	  <?php 
  
	 
$b_name = App\Models\Bankname::findOrFail($e->Bankname_id)->name;	 
	  
	  ?>
	  
	  {{$b_name}}</th>
      <td> <?php echo  round($e->amount,2);      ?></td>
<td> {{$e->user->name}}</td>
    </tr>
@endforeach


	<tr>
	<th >NA</th>
      <th >Total</th>
      <td> <?php echo  round($total_come_from_bank,2);      ?></td>
    <th >NA</th>
    </tr>
  </tbody>
</table>


  <?php } ?> 


  <?php  if (!$due_collection->isEmpty())  { ?>
<h5 style="color:red">   Due Collection from External Income Providers </h5>
 <table class="table">
  <thead>
    <tr>
	<th>Date </th>
	<th>Source </th>
     <th scope="col"> Project Name  </th>
      
      <th scope="col">Total  </th>
   <th scope="col">Entry By  </th>
    </tr>
  </thead>
  <tbody>
    	
	@foreach($due_collection as $e)
	<?php  
	$total_due_collection = $total_due_collection + $e->amount;
	
	
	?>
	
	<tr>
	<td> <?php echo date('d/m/Y', strtotime($e->created_at));; ?> </td>
      <th >{{$e->externalincomeprovider->name}}</th>
	       
<?php if($e->project_id){?>
		   <th >{{$e->project->name}}</th>
<?php } else{ ?>
<th> NA</th> <?php } ?>

      <td> <?php echo  round($e->amount,2);      ?></td>
    <td>{{ $e->user->name}} </td>
    </tr>
@endforeach


	<tr>
	 <th >NA</th>
	   <th >NA</th>
      <th >Total</th>
      <td> <?php echo  round($total_due_collection,2);      ?></td>
    <th >NA</th>
    </tr>
  </tbody>
</table>


  <?php } ?> 
  
 <?php 
$total_expenses = $total_expenses_paid+$total_salary_amount+$total_due_paymet+$total_invest_project+$total_withdrawl_bank+$total_withdrawl_owner+$total_caopnay_paid+$total_company_duepayment+$money_return_back_from_project_expenses + $customer_refundt;

$total_earn =$total_paid_income+$total_investment+$money_return_back_from_project+$total_come_from_bank
+$total_due_collection+$total_company_refund+ $total_invest_project_income+ $customer_due_paymentt+ $total_plot_sell;


 ?>
 <p>
  <b>Total Expenses in Cash :</b>{{$total_expenses}}TK <br>
  <b>Total Earning in Business:</b> {{$total_earn}} TK<br>
  
  <b>Net Income:</b> {{$total_earn - $total_expenses}}TK.


<P>

NB: When Money is given to Project Manager or return back from Project Manager that doesn't change anything in Balance sheet. That way, these will entry two times.Once in Expenses sheet and once in Income sheet. 





</div>


    
</body>
</html>
