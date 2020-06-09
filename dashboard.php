<?php
    
?>
<head>
 <meta charset="utf-8">
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="css/dashboard.css">
<link rel="stylesheet" type="text/css" href="css/clientButton.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>

<script type="text/javascript">
	/*function loadConsultants(){
		//alert("Hello world");
	$.post('dashboard.php',{postname:'Prajwal'},
		function(){

		});

	}*/

$('#loadConsultants').click(function(){
  $.ajax({
    url:'dashboard.php?call=true',
    type:'GET',
    success:function(data){
      body.append(data);
    }
  });
});
</script>

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
	global $db;
	$query = "SELECT client_name,priority_level,client_domain FROM projects WHERE AssignedTo is NULL ORDER BY priority_level DESC";
	$result = mysqli_query($db,$query);
	
	$clientsYetTobeAssigned = [];
	$priorityClients = [];
	$clientDomain = [];
	//echo $result;
	//console.log('$result');
	
	$i = 0;
	while($row = mysqli_fetch_array($result)){
		$clientsYetTobeAssigned[$i] = $row[0];
		$priorityClients[$i] = $row[1];
		$clientDomain[$i] = $row[2];
		$i++;
		echo "<script type='text/javascript'>
		
			var button = document.createElement('button');
			button.innerHTML = '$row[0]';
			if('$row[1]'>7){
				button.setAttribute('class','blueC clientButton')
				button.setAttribute('id','loadConsultants')
				button.setAttribute('value','click')
								
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

	//echo "<script type='text/javascript'>alert('$clientDomain[0]');</script>";
	//Select all Consultants
	$query = "SELECT * FROM consultants";
	$result = mysqli_query($db,$query);
	$allConsultantsName =[];$allConsultantsId = [];$consultantsColor = [];
	$i=0;
	while($row = mysqli_fetch_array($result)){
		$allConsultantsName[$i] = $row[1];
		$allConsultantsId[$i] = $row[0];
		$i++;
	}

	//red consultants 
	//These are consultants which are assigned to an ongoing project
	$query = "SELECT AssignedTo FROM projects WHERE project_status='ongoing'";
	$result = mysqli_query($db,$query);
	$redConsultants = [];$i=0;$alreadyAssigned = [];
	while($row = mysqli_fetch_array($result)){
		if($row[0]!=''){
			$redConsultants[$i] = $row[0];
			$alreadyAssigned[$i] = $row[0];
			$i++;	
		}	
	}

	//end date is only filled after the project status is finished
	//Those clients which are not assigned but have worked for competitors
	$query = "SELECT AssignedTo FROM projects WHERE datediff(curdate(),end_date)<365 and client_domain='$clientDomain[0]'";
	$result = mysqli_query($db,$query);
	while($row = mysqli_fetch_array($result)){
		if($row[0]!=''){
			$redConsultants[$i] = $row[0];
			$i++;	
		}	
	}	

	

	//assign red color to the consultants
	for($i=0;$i<count($allConsultantsId);$i++){
		if(in_array($allConsultantsId[$i], $redConsultants)){
			$consultantsColor[$i] = 1;
		}
		else{
			$consultantsColor[$i] = 0;
		}
	}

	function canWorkFor($cDomain,$consultantId,$db){

		$query = "SELECT AssignedTo FROM projects WHERE datediff(curdate(),end_date)<365 and client_domain='$cDomain'";
			$result = mysqli_query($db,$query);
			
			while($row = mysqli_fetch_array($result)){				
				if($row[0]==$consultantId){
					return 0;	
				}	
			}
			return 1;			
	}

	//echo "<script type='text/javascript'>alert('$consultantsColor[6]');</script>";
	
	//Green Consultant
	for($i=0;$i<count($allConsultantsId);$i++){
		if(in_array($allConsultantsId[$i], $redConsultants)!=1){
			$count = 0;
			for($j=0;$j<count($clientDomain);$j++){
				//$c = count($clientDomain);
				$check = canWorkFor($clientDomain[$j],$allConsultantsId[$i],$db);
				//echo "<script type='text/javascript'>alert('$c');</script>";

				if($check==1){
					$count++;
				}
			}			
			if($count>1){
				$consultantsColor[$i] = 2; //green
			}

			if($count==1){
				$consultantsColor[$i] = 3; //yellow
			}
		}
	}
	
//$check = canWorkFor('airlines','12345',$db);
//echo "<script type='text/javascript'>alert('$check');</script>";

	
	/*$query="SELECT competitors from projects where projects.client_name='Zomato'";
	$result=mysqli_query($db,$query);
	$row=mysqli_fetch_array($result);
	$competitors=explode(",",$row[0]);

	echo "<script type='text/javascript'>alert('$competitors[1]');</script>";

	$query="select id,name from consultants, projects where projects.client_name='$competitors[0]' and projects.AssignedTo=consultants.ID and datediff(curdate(),projects.end_date)<365 ";
	for($i=1;$i<count($competitors);$i++)
	{
			$query .="union select id,name from consultants, projects where projects.client_name='$competitors[$i]' and projects.AssignedTo=consultants.ID and datediff(curdate(),projects.end_date)<365 ";
	}
	$query .="union select id,name from consultants, projects where projects.AssignedTo=consultants.ID and projects.end_date is NULL";
	$result=mysqli_query($db,$query);
	echo "<script type='text/javascript>$query</script>";
	*/


	for($i=0;$i<count($allConsultantsName);$i++){
		echo "<script type='text/javascript'>
			var button = document.createElement('button');
			button.innerHTML = '$allConsultantsName[$i]';
			if('$consultantsColor[$i]'==1){
				button.setAttribute('class','redC clientButton')				
			}
			else if('$consultantsColor[$i]'==2){
				button.setAttribute('class','greenC clientButton')
			}
			else{
				button.setAttribute('class','yellowC clientButton')	
			}
							
			var body = document.getElementById('ConsultantList');
			body.appendChild(button);	
		</script>";		
	}


	if(isset($_GET['call'])){
			echo "<script type='text/javascript'>alert('Hello world');</script>";		
	}



?>

