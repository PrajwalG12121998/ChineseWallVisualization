<?php
  require('inc/config.php'); 
?>
<head>
 <meta charset="utf-8">
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="css/dashboard.css">
</head>
<body>

<header>
  <h1>Dravidzilla</h1>
</header>
<div class="sidebar_back"></div>
<aside>
  <div class="row">
  	<a class="element" href="dashboard.php">Dashboard</a>	
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
    <a class="element active" href="ModifyProject.php">Modify Projects</a>  
  </div>
</aside>

<main>
<div class="container-fluid bg">
  <form action='ModifyProject.php' method="post" class="form-container" enctype="multipart/form-data">
  <h1>Modify Project</h1>
  <div class="row">
    <div class="col-6">
    <div class="form-group">
      <label for="clientName">Client Name</label>
      <select name="clientName" class="form-control" id="clientName" >
	   <?php 
		$query="Select distinct client_name from projects order by client_name";
		$result = mysqli_query($db,$query);
		while($row = mysqli_fetch_array($result)){
				echo "<option value='$row[0]'>$row[0]</option>";
		}
	   ?>
	   </select>
    </div>
    <div class="form-group">
      <label for="project_name">Project Name</label>
      <input type="text" class="form-control" id="projectName" name="projectName" placeholder="Project Name" required>
    </div>
    </div>
    <div class="col-6">
    <div class="form-group">
      <label for="priority_level">Priority Level</label>
      <input type="number" class="form-control" id="priorityLevel" name="priorityLevel" placeholder="Priority of the client">
    </div>  
    <div class="form-group">
      <label for="startDate">No. of Consultants Required</label>
      <input type="number" class="form-control" id="required" name="required" placeholder="No. of clients required (Only Increase)">
    </div>
	<div class="form-group">
      <label for="startDate">Project End Date</label>
      <input type="date" class="form-control" id="endDate" name="endDate" placeholder="End Date of Project">
    </div>
  </div>
  </div>  
  <br>
  <input type="submit" id="submit" name="submit" value="Submit" class="btn btn-success btn-block" style="width: 20%;">
  <br>
</form>
</div>
</main>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
<?php

    require('inc/config.php');
    if(isset($_POST['submit'])){
			$clientName = mysqli_escape_string($db,$_POST['clientName']);
			 $projectName = mysqli_escape_string($db,$_POST['projectName']);
       $priorityLevel = mysqli_escape_string($db,$_POST['priorityLevel']);
       $endDate = mysqli_escape_string($db,$_POST['endDate']);
		$required=mysqli_escape_string($db,$_POST['required']);
		if($priorityLevel){
			$query="update projects set priority_level=$priorityLevel where client_name='$clientName' and project_name='$projectName'";
			if(!mysqli_query($db,$query)){
            echo "<script type='text/javascript'>alert('Failed to upload');</script>";   
			exit("Failed to upload");
          }
		}
		if($required){
			$query="select project_id from projects where client_name='$clientName' and project_name='$projectName'";
			$result=mysqli_query($db,$query);
			$row=mysqli_fetch_array($result);
			$projid=$row[0];
			$query="select count(*) from projectconsultant where project_id=$projid and end_date is NULL";
			$result=mysqli_query($db,$query);
			$row=mysqli_fetch_array($result);
			$consultants=$row[0];
			if($required<$consultants)
			{
				echo "<script type='text/javascript'>alert('Cannot decrease consultants');</script>"; 
			}
			else
			{
				$required=$required-$consultants;
				$query="update projects set consultantNo=$required where client_name='$clientName' and project_name='$projectName'";
			if(!mysqli_query($db,$query)){
            echo "<script type='text/javascript'>alert('Failed to upload');</script>";   
			exit("Failed to upload");
          }
			}
		}
		if($endDate){
			$query="select project_id from projects where client_name='$clientName' and project_name='$projectName'";
			$result=mysqli_query($db,$query);
			$row=mysqli_fetch_array($result);
			$projid=$row[0];
			$query="update projectconsultant set end_date='$endDate' where project_id=$projid";
			$result=mysqli_query($db,$query);
			$query="update projects set end_date='$endDate' where client_name='$clientName' and project_name='$projectName'";
			if(!mysqli_query($db,$query)){
            echo "<script type='text/javascript'>alert('Failed to upload');</script>";   
          }
		}
   }

?>
