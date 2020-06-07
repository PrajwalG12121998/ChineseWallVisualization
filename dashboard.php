<?php
    
?>
<head>
 <meta charset="utf-8">
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="css/dashboard.css">
<link rel="stylesheet" type="text/css" href="css/clientButton.css">
</head>
<body>

<header>
  <h1>Chinese Wall Visualization</h1>
</header>
<div class="sidebar_back"></div>
<aside>
  <div class="row">
  	<a class="element active" href="dashboard.php">Dashboard</a>	
  </div>		
  <div class="row">
  	<a class="element" href="addClient.php">Add Clients </a>	
  </div>		
  <div class="row">
  	<a class="element" href="addConsultant.php">Add Consultants</a>	
  </div>
  
</aside>

<main>
  <div id="clientBar">

  </div>	
</main>



<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>


<?php
	require('inc/config.php');
	$query = "SELECT client_name,priority_level FROM Clients WHERE isAssigned = '0' ORDER BY priority_level DESC";
	$result = mysqli_query($db,$query);

	//echo $result;
	//console.log('$result');
	//echo "<script type='text/javascript'>alert('$result[0]');</script>";

	while($row = mysqli_fetch_array($result)){
		echo "<script type='text/javascript'>

			var button = document.createElement('button');
			button.innerHTML = '$row[0]';
			if('$row[1]'>7){
				button.setAttribute('class','blueC clientButton')				
			}
			else if('$row[1]'<=7 && '$row[1]'>4){
				button.setAttribute('class','orangeC clientButton')
			}
			else{
				button.setAttribute('class','yellowC clientButton')
			}

			var body = document.getElementById('clientBar');
			body.appendChild(button);	

		</script>";		
	}


?>
