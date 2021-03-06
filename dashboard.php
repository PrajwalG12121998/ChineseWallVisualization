<?php
    
?>
<head>
 <meta charset="utf-8">
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="css/dashboard.css">
<link rel="stylesheet" type="text/css" href="css/clientButton.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>

<header>
  <div class="row">		
  		<h1 style="padding-left: 20px;" >Dravidzilla</h1>
  		<img src="images/rahul_dravid.jpeg" style="height: 80px;width: 200px; padding-left: 40px;">
  		<img src="images/greatWall.jpg" style="height: 80px;width: 180px; margin-left: 550px;">
</div>
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

  <div class="row">
  	<a class="element" href="allProjects.php">All Projects</a>	
  </div>
   <div class="row">
    <a class="element" href="ModifyProject.php">Modify Projects</a>  
  </div>
</aside>

<main>
  <div id="clientBar" class="row" style="padding-left: 20px;">

  </div>
  <hr style="border: 2px solid black;">
  <div class="row">
  	<div class="col-3">
  		<div id="ConsultantList">
  		</div>	
  	</div>	
  	<div class="col-6" id="imageSection" style="display: none;">
  		<img src="images/jonSnow.jpg" style="height: 200px;width: 350px; margin: 0px 0px 30px 40px;">
  		<img src="images/wall.jpg" style="height: 200px;width: 350px; margin: 0px 0px 30px 40px;">
  		<img src="images/whiteWalker.jpg" style="height: 200px;width: 350px; margin: 0px 0px 0px 40px;">
  	</div>
  </div>
  </div>

  <div class="modal" tabindex="-1" role="dialog" id="confirmAssignment">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Confirm Assignment</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p id="modalText"></p>
      </div>
      <div class="modal-footer">
      	<form action="dashboard.php" method="post">
        	<button type="submit" class="btn btn-primary" id="fConfirm" name="finalConfirm">Save changes</button>
    	</form>
        
      </div>
    </div>
  </div>
</div>


</main>



<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
<script type="text/javascript">
	function Refresh(){
		window.location.href = "dashboard.php";
	}

	function showImage(){
       var a = document.getElementById('imageSection');
       a.style.display = 'block';
	}
</script>

<?php
	require('inc/config.php');

	$query = "SELECT client_name,priority_level,client_domain,project_id,project_name,consultantNo FROM projects WHERE end_date IS NULL and consultantNo>0 ORDER BY priority_level DESC";
	$result = mysqli_query($db,$query);
	
	$clientsYetTobeAssigned = [];
	$priorityClients = [];
	$clientDomain = [];
	$projectId = [];
	//echo $result;
	//console.log('$result');
	
	$i = 0;
	while($row = mysqli_fetch_array($result)){
		$clientsYetTobeAssigned[$i] = $row[0];
		$priorityClients[$i] = $row[1];
		$clientDomain[$i] = $row[2];
		$projectId[$i] = $row[3];
		$i++;
		echo "<script type='text/javascript'>
			var body = document.getElementById('clientBar');
			

			var form = document.createElement('form')
			form.setAttribute('action','dashboard.php')
			form.setAttribute('method','post')
			body.appendChild(form);

			var button = document.createElement('button');
			button.setAttribute('type','submit')
			button.setAttribute('value','$row[0]'+','+'$row[2]'+','+'$row[1]'+','+'$row[3]')
			button.setAttribute('name','client')
			button.innerHTML = '$row[0]'+'-'+'$row[4]'+'-'+'$row[5]';
			if('$row[1]'>7){
				button.setAttribute('class','blueC clientButton')
								
			}
			else if('$row[1]'<=7 && '$row[1]'>4){
				button.setAttribute('class','orangeC clientButton')
			}
			else{
				button.setAttribute('class','violetC clientButton')
			}
			form.appendChild(button)
				

		</script>";		
	}

	if(isset($_POST['client'])){
		$clientAndDomain = $_POST['client'];
		$cAndD = explode(',', $clientAndDomain);
		$client = $cAndD[0];
		$domain = $cAndD[1];
		$priority = $cAndD[2];
		$projectId = $cAndD[3];
			//echo "<script type='text/javascript'>alert('$projectId');</script>";
			loadConsultants($clientDomain,$domain,$client,$priority,$projectId,$db);		
	}

	if(isset($_POST['setConsultant'])){
		
		$consultantInfo = explode(',', $_POST['setConsultant']);	
		//echo "<script type='text/javascript'>alert('$consultantInfo[1]');</script>";
		echo "<script type='text/javascript'>
				modal = document.getElementById('confirmAssignment')
				modal.style.display = 'block';

				document.getElementById('close').onclick = function() {
				  modal.style.display = 'none';
				};
				var text = document.getElementById('modalText');
				text.innerHTML = 'Confirm Assigning project to Consultant ID: '+'$consultantInfo[0]'

				var confirm = document.getElementById('fConfirm');
				confirm.setAttribute('value','$consultantInfo[0]'+','+'$consultantInfo[1]');

			  </script>";


	}

	if(isset($_POST['finalConfirm'])){
		$consultantInfo = explode(',', $_POST['finalConfirm']);
		//echo "<script type='text/javascript'>alert('$consultantInfo[1]');</script>";
		$consultantId = $consultantInfo[0];
		$projectId = $consultantInfo[1];

		$query1 = "SELECT project_startDate FROM projects WHERE project_id='$projectId'";
		$result = mysqli_query($db,$query1);
		$row = mysqli_fetch_array($result);
		$startDate = $row[0];
		//echo "<script type='text/javascript'>alert('$row[0]');</script>";	
		
	
		$query = "INSERT INTO projectConsultant (project_id, consultant_id,start_date)
				  VALUES ('$projectId','$consultantId','$startDate')";
		$result = mysqli_query($db,$query);
	
		$query = "SELECT consultantNo FROM projects WHERE project_id='$projectId'";
		$result = mysqli_query($db,$query);
		$row = mysqli_fetch_array($result); 
		$NumOfConsultant= $row[0];

		//echo "<script type='text/javascript'>alert('$row[0]');</script>";
		$query = "UPDATE projects SET consultantNo = '$NumOfConsultant'-1 WHERE project_id ='$projectId'";
		$result = mysqli_query($db,$query);
		if($result){
			echo "<script type='text/javascript'>alert('Consultant Assigned'); 
					Refresh()</script>";	
		}

	}

	function loadConsultants($clientDomainArray,$clientDomain,$client,$priority,$projectId,$db){

	//echo "<script type='text/javascript'>alert('$clientDomainArray[1]');</script>";
	//Select all Consultants
	$query = "SELECT * FROM consultants";
	$result = mysqli_query($db,$query);
	$allConsultantsName =[];$allConsultantsId = [];$consultantsColor = [];$consultantsTempColor = [];
	$i=0;
	while($row = mysqli_fetch_array($result)){
		$allConsultantsName[$i] = $row[1];
		$allConsultantsId[$i] = $row[0];
		$i++;
	}

	//red consultants 
	//These are consultants which are assigned to an ongoing project
	$query = "SELECT consultant_id FROM projectConsultant WHERE end_date IS NULL";
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
	$query = "SELECT consultant_id FROM projectConsultant 
			  INNER JOIN projects ON projectConsultant.project_id = projects.project_id 
			  WHERE datediff(curdate(),projectConsultant.end_date)<365 and 
			  client_domain='$clientDomain' and projects.client_name!='$client';";
	$result = mysqli_query($db,$query);
	while($row = mysqli_fetch_array($result)){
		if($row[0]!=''){
			$redConsultants[$i] = $row[0];
			$i++;	
		}	
	}	

	//echo "<script type='text/javascript'>alert('$redConsultants[1]');</script>";

	//assign red color to the consultants
	for($i=0;$i<count($allConsultantsId);$i++){
		if(in_array($allConsultantsId[$i], $redConsultants)){
			$consultantsColor[$i] = 1;
			$consultantsTempColor[$i] = 1;
		}
		else{
			$consultantsColor[$i] = 0;
			$consultantsTempColor[$i] = 0;
		}
	}

	

	//echo "<script type='text/javascript'>alert('$consultantsColor[6]');</script>";
	
	//Green Consultant
	for($i=0;$i<count($allConsultantsId);$i++){
		if(in_array($allConsultantsId[$i], $redConsultants)!=1){
			$count = 0;
			for($j=0;$j<count($clientDomainArray);$j++){
				//$c = count($clientDomain);
				$check = canWorkFor($clientDomainArray[$j],$allConsultantsId[$i],$db);
				//echo "<script type='text/javascript'>alert('$c');</script>";

				if($check==1){
					$count++;
				}
			}			
			if($count>1){
				$consultantsColor[$i] = 2; //green
				$consultantsTempColor[$i] = 2;
			}

			if($count==1){
				$consultantsColor[$i] = 3; //yellow
				$consultantsTempColor[$i] = 2;
			}
		}
	}
	
	//Ordering of the consultants
	$totalExperience = [];
	$query = "SELECT datediff(curdate(),DOJ) FROM consultants;";
	$result = mysqli_query($db,$query);$i=0;
	while($row = mysqli_fetch_array($result)){
		if($row[0]!=''){
			$totalExperience[$i] = $row[0];
			$i++;	
		}	
	}	

	//Getting consultants based on domain expertise
	$domainExpertise = [];
	for($i=0;$i<count($allConsultantsId);$i++){
		$query = "SELECT sum(datediff(projectConsultant.end_date,projectConsultant.start_date)) FROM projectConsultant INNER JOIN projects ON projectConsultant.project_id = projects.project_id 
			WHERE client_domain='$clientDomain' and projectConsultant.consultant_id='$allConsultantsId[$i]'";
		$result = mysqli_query($db,$query);
		while($row = mysqli_fetch_array($result)){
			if($row[0]!=''){
				$domainExpertise[$i] = $row[0];
			}
			else{
				$domainExpertise[$i] = 0;
			}
		}	
	}
	
	//echo "<script type='text/javascript'>alert('$domainExpertise[2]');</script>";


	if($priority>7){
		array_multisort($consultantsTempColor,SORT_DESC,$domainExpertise,SORT_DESC,$totalExperience,SORT_DESC,$consultantsColor,SORT_DESC,$allConsultantsId,$allConsultantsName,$consultantsColor);	
	}
	else if($priority<=7 && $priority>4){
		array_multisort($consultantsTempColor,SORT_DESC,$totalExperience,SORT_DESC,$consultantsColor,SORT_DESC,$allConsultantsName,$allConsultantsId,$consultantsColor);
	}
	else{
		array_multisort($consultantsTempColor,SORT_DESC,$totalExperience,SORT_ASC,$consultantsColor,SORT_DESC,$allConsultantsName,$allConsultantsId,$consultantsColor);	
	}

	

	//array_multisort($totalExperience,SORT_DESC,$allConsultantsName,$allConsultantsId,$consultantsColor);

	//echo "<script type='text/javascript'>alert('$consultantsColor[0]');</script>";
	
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
			var body = document.getElementById('ConsultantList');
			

			var form = document.createElement('form')
			form.setAttribute('action','dashboard.php')
			form.setAttribute('method','post')
			body.appendChild(form);

			var button = document.createElement('button');
			button.setAttribute('type','submit')
			button.setAttribute('value','$allConsultantsId[$i]'+','+'$projectId')
			button.setAttribute('name','setConsultant')
			button.innerHTML = '$allConsultantsName[$i]'+'-'+'$allConsultantsId[$i]';
			if('$consultantsColor[$i]'==1){
				button.setAttribute('class','redC clientButton')
				button.disabled = true;				
			}
			else if('$consultantsColor[$i]'==2){
				button.setAttribute('class','greenC clientButton')
			}
			else{
				button.setAttribute('class','yellowC clientButton')	
			}

			var a = document.getElementById('imageSection');
       		a.style.display = 'block';

			var body = document.getElementById('ConsultantList');
			form.appendChild(button);	
		</script>";		
	}

}  //loadConsultants function end

    function canWorkFor($cDomain,$consultantId,$db){

		$query = "SELECT consultant_id FROM projectConsultant 
			  INNER JOIN projects ON projectConsultant.project_id = projects.project_id 
			  WHERE datediff(curdate(),projectConsultant.end_date)<365 and 
			  client_domain='$cDomain'";
			$result = mysqli_query($db,$query);
			
			while($row = mysqli_fetch_array($result)){				
				if($row[0]==$consultantId){
					return 0;	
				}	
			}
			return 1;			
	}

	


?>


