<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>BICTSOFT Project Maintenance Software</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

<style>
.l:link, .l:visited {
  background-color: white;
  color: black;
  border: 2px solid green;
  padding: 10px 20px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
}

.l:hover, .l:active {
  background-color: green;
  color: white;
}
</style>
       
    </head>
    <body  style="margin-top:100px;"   >
      
		<div class="h-100 d-flex align-items-center justify-content-center" >
		<h2 style="color:red">BICTSOFT Project Maintenance Software</h2>
		</div     >
		
		<p><p><br>
		<div   class="h-100 d-flex align-items-center justify-content-center" >
            @if (Route::has('login'))
                <div >
                    @auth
					
					
					<?php 
					 if( auth()->user()->role == 1 ){ ?>
						 <a href="{{ url('admindashboard') }}" class="text-sm text-gray-700 underline">Home</a>
           
       <?php  }
        elseif( auth()->user()->role == 2 ){ ?>
			<a href="{{ url('/home') }}" class="text-sm text-gray-700 underline">Home</a>
            return redirect()->route('user.dashboard');
      <?php  }
		
		     elseif( auth()->user()->role == 3 ){  ?>
				 <a href="{{ url('Phermachydepdashboard') }}" class="text-sm text-gray-700 underline">Home</a>
            
     <?php    } 
		
		     elseif( auth()->user()->role == 4 ){  ?>
				 <a href="{{ url('accountdashboard') }}" class="text-sm text-gray-700 underline">Home</a>
           
    <?php     }
		
			     elseif( auth()->user()->role == 10 ){  ?>
					 <a href="{{ url('deleteduserdashboard') }}" class="text-sm text-gray-700 underline">Home</a>
            
   <?php      }
					
					?>
					
                       
                    @else
						
                        <a class="l" href="{{ route('login') }}" >Log in</a> <br><p>

                        @if (Route::has('register'))
                         <br><p>   <a class="l" href="{{ route('register') }}" >Register</a>
                        @endif
                    @endauth
                </div>
            @endif
</div>
          
    </body>
	
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>	
	
	
	
</html>
