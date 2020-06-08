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
  	<a class="element" href="addProject.php">Add Projects </a>	
  </div>		
  <div class="row">
  	<a class="element" href="addConsultant.php">Add Consultants</a>	
  </div>
  
</aside>

<main>
  <div id="clientBar">

  </div>	
  <div><div><div>
  <div id="ConsultantList">
  </div>
</main>



<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>


<?php
	require('inc/config.php');
	$query = "SELECT client_name,priority_level FROM Projects WHERE AssignedTo is NULL ORDER BY priority_level DESC";
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
	$query="select competitors from projects where projects.client_name='Zomato'";
	$result=mysqli_query($db,$query);
	$row=mysqli_fetch_array($result);
	$competitors=explode(",",$row[0]); 
	$query="select id,name from consultants, projects where projects.client_name='$competitors[0]' and projects.AssignedTo=consultants.ID and datediff(curdate(),projects.end_date)<365 ";
	for($i=1;$i<count($competitors);$i++)
	{
			$query .="union select id,name from consultants, projects where projects.client_name='$competitors[$i]' and projects.AssignedTo=consultants.ID and datediff(curdate(),projects.end_date)<365 ";
	}
	$query .="union select id,name from consultants, projects where projects.AssignedTo=consultants.ID and projects.end_date is NULL";
	$result=mysqli_query($db,$query);
	echo "<script type='text/javascript>$query</script>";
	while($row = mysqli_fetch_array($result)){
		echo "<script type='text/javascript'>
			var button = document.createElement('button');
			button.innerHTML = '$row[1]';
			button.setAttribute('class','blueC clientButton')				
			var body = document.getElementById('ConsultantList');
			body.appendChild(button);	
		</script>";		
	}
?>
