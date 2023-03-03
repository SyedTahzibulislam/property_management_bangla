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
Date: {{$start}} to {{$end}}
<div  class="container">
<H2> Expenses </h2>
  
 <?php if (!$externalcost->isEmpty())  { ?>
<h5 style="color:red">   Various Expenses  </h5>

  <table class="table">
  <thead>
    <tr>
    
      <th scope="col"> Expenses Name  </th>
      <th scope="col">Total  </th>
     <th scope="col">Paid  </th>
	  <th scope="col">Due  </th>
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
      <td> <?php echo  round($e->total_amount,2);   $paid = $e->total_amount - $e->total_due ;    ?></td>
      <td> <?php echo round($paid,2) ?> </td>	  
       <td><?php echo round($e->total_due,2) ?></td>	     
    </tr>
@endforeach


	<tr>
      <th >Total</th>
      <td> <?php echo  round($total_expenses_amount,2);      ?></td>
      <td> <?php echo round($total_expenses_paid,2) ?> </td>	  
       <td><?php echo round($total_expenses_due,2) ?></td>	     
    </tr>
  </tbody>
</table>
  


  <?php } ?>
  



 <?php if (!$company_cost->isEmpty())  { ?>
<h5 style="color:red">   Product Puchasing From Company/Dealer  </h5>

  <table class="table">
  <thead>
    <tr>
    
      <th scope="col"> Company/Dealer Name  </th>
	 
	     <th scope="col"> Project Name  </th>
      <th scope="col">Total  </th>
     <th scope="col">Paid  </th>
	  <th scope="col">Due  </th>
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
      <td> <?php echo  round($e->total_amount,2);   $paid = $e->total_amount - $e->total_due ;    ?></td>
      <td> <?php echo round($e->paid,2) ?> </td>	  
       <td><?php echo round($e->total_due,2) ?></td>	     
    </tr>
@endforeach


	<tr>
	<th>NA</th>
      <th >Total</th>
      <td> <?php echo  round($total_company_amount,2);      ?></td>
      <td> <?php echo round($total_company_paid,2) ?> </td>	  
       <td><?php echo round($total_company_due,2) ?></td>	     
    </tr>
  </tbody>
</table>
  


  <?php } ?>



 <?php if (!$company_due_payment->isEmpty())  { ?>
<h5 style="color:red">   Due Payment from Company/Dealer  </h5>

  <table class="table">
  <thead>
    <tr>
    
      <th scope="col"> Company/Dealer Name  </th>
<th> Project Name </th>
      <th scope="col">Total Due_Payment  </th>

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
      <td> <?php echo  round($e->total_amount,2);      ?></td>
      
    </tr>
@endforeach


	<tr>
	<th>NA</th>
      <th >Total</th>
      <td> <?php echo  round($total_due_paymet_company,2);      ?></td>
	     
    </tr>
  </tbody>
</table>
  


  <?php } ?>





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




























<!---------------------------------- employee transition. chechk if threre any transition in the daterange. 
if yes then exexute  -->


<?php if (!$employee_salary->isEmpty())  { ?>
<h5 style="color:red">   Salary Expenses </h5>

  <table class="table">
  <thead>
    <tr>
    
      <th scope="col"> Employee Name  </th>
      <th scope="col">Total  </th>
  
    </tr>
  </thead>
  <tbody>
    	
	@foreach($employee_salary as $e)
	<?php  
	$total_salary_amount = $total_salary_amount + $e->total_salary;
	
	
	?>
	
	<tr>
      <th >{{$e->employeedetails->name}}</th>
      <td> <?php echo  round($e->total_salary,2);      ?></td>
    
    </tr>
@endforeach


	<tr>
      <th >Total</th>
      <td> <?php echo  round($total_salary_amount,2);      ?></td>
    
    </tr>
  </tbody>
</table>
  
 
  
 

  <?php } ?>
  
  
 


 

<?php if (!$dharshod->isEmpty())  { ?>
<h5 style="color:red"> Others  Due Payment Expenses </h5>

  <table class="table">
  <thead>
    <tr>
    
      <th scope="col"> Supplier Name  </th>
      <th scope="col">Total  </th>
  
    </tr>
  </thead>
  <tbody>
    	
	@foreach($dharshod as $e)
	<?php  
	$total_due_paymet = $total_due_paymet + $e->total_baki_shod;
	
	
	?>
	
	<tr>
      <th >{{$e->supplier->name}}</th>
      <td> <?php echo  round($e->total_baki_shod,2);      ?></td>
    
    </tr>
@endforeach


	<tr>
      <th >Total</th>
      <td> <?php echo  round($total_due_paymet,2);      ?></td>
    
    </tr>
  </tbody>
</table>


  <?php } ?> 
  
  

<?php if (!$money_given_to_project->isEmpty())  { ?>
<h5 style="color:red">   Money given to Project Supervisors  </h5>

  <table class="table">
  <thead>
    <tr>
    
      <th scope="col"> Project Name  </th>
      <th scope="col">Total  </th>
  
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
      <td> <?php echo  round($e->total,2);      ?></td>
    
    </tr>
@endforeach


	<tr>
      <th >Total</th>
      <td> <?php echo  round($total_invest_project,2);      ?></td>
    
    </tr>
  </tbody>
</table>


  <?php } ?> 
 

  
<?php if (!$money_given_to_bank->isEmpty())  { ?>
<h5 style="color:red">   Money Withdrwal to deposit in Bank </h5>

  <table class="table">
  <thead>
    <tr>
    
      <th scope="col"> Bank Name  </th>
      <th scope="col">Total  </th>
  
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
      <td> <?php echo  round($e->total,2);      ?></td>
    
    </tr>
@endforeach


	<tr>
      <th >Total</th>
      <td> <?php echo  round($total_withdrawl_bank,2);      ?></td>
    
    </tr>
  </tbody>
</table>


  <?php } ?> 



 <?php if (!$money_withdrawl->isEmpty())  { ?>
<h5 style="color:red">   Money Withdrwal by owners </h5>
 <table class="table">
  <thead>
    <tr>
    
      <th scope="col"> Owner Name  </th>
      <th scope="col">Total  </th>
  
    </tr>
  </thead>
  <tbody>
    	
	@foreach($money_withdrawl as $e)
	<?php  
	$total_withdrawl_owner = $total_withdrawl_owner + $e->total;
	
	
	?>
	
	<tr>
      <th >{{$e->sharepartner->name}}</th>
      <td> <?php echo  round($e->total,2);      ?></td>
    
    </tr>
@endforeach


	<tr>
      <th >Total</th>
      <td> <?php echo  round($total_withdrawl_owner,2);      ?></td>
    
    </tr>
  </tbody>
</table>


  <?php } ?>



  <?php if (!$money_taken_from_project->isEmpty())  { ?>
<h5 style="color:red">   Money Return Back from Project Supervisors  </h5>

  <table class="table">
  <thead>
    <tr>
    
      <th scope="col"> Project Name  </th>
      <th scope="col">Total  </th>
  
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
      <td> <?php echo  round($e->total,2);      ?></td>
    
    </tr>
@endforeach


	<tr>
      <th >Total</th>
      <td> <?php echo  round($money_return_back_from_project_expenses,2);      ?></td>
    
    </tr>
  </tbody>
</table>


  <?php } ?>
  
  
    </div>


</div>
      
	
	

	
	
	
	
<div  style=" margin-left:5px;" class="col-sm">
<h2 >      Income in business </h2>
<hr>







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











 
 <?php if (!$money_given_to_project->isEmpty())  { ?>
<h5 style="color:red">   Money given to Project Supervisors  </h5>

  <table class="table">
  <thead>
    <tr>
    
      <th scope="col"> Project Name  </th>
      <th scope="col">Total  </th>
  
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
      <td> <?php echo  round($e->total,2);      ?></td>
    
    </tr>
@endforeach


	<tr>
      <th >Total</th>
      <td> <?php echo  round($total_invest_project_income,2);      ?></td>
    
    </tr>
  </tbody>
</table>


  <?php } ?> 
 
 
 
 
 
 
 
 
 
 
 
 
	

 <?php if (!$money_back_from_company->isEmpty())  { ?>
<h5 style="color:red">   Money Back from Company/Dealer  </h5>

  <table class="table">
  <thead>
    <tr>
    
      <th scope="col"> Company/Dealer Name  </th>
<th> Project Name </th>
      <th scope="col">Total Refund by com.  </th>

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
      <td> <?php echo  round($e->total_amount,2);      ?></td>
      
    </tr>
@endforeach


	<tr>
	<th>NA</th>
      <th >Total</th>
      <td> <?php echo  round($money_back_company,2);      ?></td>
	     
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
<h5 style="color:red">   Investment by owners in business </h5>
 <table class="table">
  <thead>
    <tr>
    
      <th scope="col"> Owner Name  </th>
      <th scope="col">Total  </th>
  
    </tr>
  </thead>
  <tbody>
    	
	@foreach($money_deposit as $e)
	<?php  
	$total_investment = $total_investment + $e->total;
	
	
	?>
	
	<tr>
      <th >{{$e->sharepartner->name}}</th>
      <td> <?php echo  round($e->total,2);      ?></td>
    
    </tr>
@endforeach


	<tr>
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
    
      <th scope="col"> Project Name  </th>
      <th scope="col">Total  </th>
  
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
      <td> <?php echo  round($e->total,2);      ?></td>
    
    </tr>
@endforeach


	<tr>
      <th >Total</th>
      <td> <?php echo  round($money_return_back_from_project,2);      ?></td>
    
    </tr>
  </tbody>
</table>


  <?php } ?> 


<?php if (!$money_come_from_bank->isEmpty())  { ?>
<h5 style="color:red">   Money brought from Bank to Business  </h5>

  <table class="table">
  <thead>
    <tr>
    
      <th scope="col"> Bank Name  </th>
      <th scope="col">Total  </th>
  
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
      <td> <?php echo  round($e->total,2);      ?></td>
    
    </tr>
@endforeach


	<tr>
      <th >Total</th>
      <td> <?php echo  round($total_come_from_bank,2);      ?></td>
    
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
  <b>Total Expenses in Cash :</b>{{$total_expenses}}TK <br>
  <b>Total Earning in Business:</b> {{$total_earn}} TK<br>
  
  <b>Net Income:</b> {{$total_earn - $total_expenses}}TK.



NB: When Money is given to Project Manager or return back from Project Manager that doesn't change anything in Balance sheet. That way, these will entry two times.Once in Expenses sheet and once in Income sheet. 






</div>


    
</body>
</html>
