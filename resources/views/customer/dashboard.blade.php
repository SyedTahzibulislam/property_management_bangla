
			<html>
			
			
			<head>
			<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">



			
			
			</head>
			
			
			<body>
			
			
	<nav class="navbar navbar-expand-lg bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="{{ url('self_balance') }}">Balance Sheet</a>
                                    <a  style="width:200px; color:red; flow:right;"     class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
  
  </div>
</nav>		
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
			</body>
			
			
			
			
			
			
			
			
			</html>					
								
								
								
								
								
								
								
								
								
								
								
								
								
								
								
								

                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                   


               


                


                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                

                </nav>