<?php
    
?>
<head>
 <meta charset="utf-8">
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="css/dashboard.css">
</head>
<body>

<header>
  <h1>Chinese Wall Visualization</h1>
</header>
<div class="sidebar_back"></div>
<aside>
  <div class="row">
  	<a class="element" href="dashboard.php">Dashboard</a>	
  </div>		
  <div class="row">
  	<a class="element active" href="addProject.php">Add Projects </a>	
  </div>		
  <div class="row">
  	<a class="element" href="addConsultant.php">Add Consultants</a>	
  </div>
  
</aside>

<main>
  <div class="container-fluid bg">
  <form action='addProject.php' method="post" class="form-container" enctype="multipart/form-data">
  <h1>Add Project</h1>
  <div class="row">
    <div class="col-6">
    <div class="form-group">
      <label for="client_name">Client Name</label>
      <input type="text" class="form-control" id="clientName" name="clientName" placeholder="Name" 
      required>
    </div>
    <div>
      <label for="domain">Domain</label>    
      <select name="domain" class="form-control" id="domain">
         <option value="oilAndGas">Oil & Gas production</option>
         <option value="broadcastingAndEntertainment">Broadcasting & entertainment</option>
         <option value="buildingMaterialsAndFixtures">Building materials & fixtures</option>
         <option value="computerServices">Computer services</option>
         <option value="airlines">Airlines</option>
         <option value="banks">Banks</option>
         <option value="apparelRetailers">Apparel retailers</option>
         <option value="pharmaceuticals">Pharmaceuticals</option>
         <option value="foodProducts">Food products</option>
         <option value="healthCareProviders">Health care providers</option>
         <option value="electronicEquipment">Electronic equipment</option>
         <option value="automobiles">Automobiles</option>
         <option value="aerospaceAndDefense">Aerospace & defense</option>
         <option value="fixedLineTelecommunications">Fixed line telecommunications</option>
         <option value="clothingAndAccessories">Clothing & accessories</option>
         <option value="specialtyChemicals">Specialty chemicals</option>
         <option value="travelAndTourism">Travel & tourism</option>
         <option value="realEstate">Real estate holding & development</option>
         <option value="durableHouseholdProducts">Durable household products</option>
         <option value="lifeInsurance">Life insurance</option>
         <option value="generalMining">General mining</option>
         <option value="onlineShopping">Online Shopping</option>
         <option value="onlineFoodDelivery">Online Food Delivery</option>
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
      <input type="number" class="form-control" id="priorityLevel" name="priorityLevel" placeholder="Priority of the client" required>
    </div>  
    <div class="form-group">
      <label for="startDate">Project Start Date</label>
      <input type="date" class="form-control" id="startDate" name="startDate" placeholder="Start Date of Project" required>
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
       $clientDomain = mysqli_escape_string($db,$_POST['domain']);
       $projectName = mysqli_escape_string($db,$_POST['projectName']);
       $priorityLevel = mysqli_escape_string($db,$_POST['priorityLevel']);
       $startDate = mysqli_escape_string($db,$_POST['startDate']);

       //echo "<script type='text/javascript'>alert('$startDate');</script>";

       

       //print_r($fileTmpName);

      

     
          $query = "INSERT into projects (client_name,client_domain,project_name,priority_level,project_startDate) VALUES ('$clientName','$clientDomain','$projectName','$priorityLevel','$startDate')";
          
          if(mysqli_query($db,$query)){
              echo "<script type='text/javascript'>alert('success');</script>";
          }
          else{
            echo "<script type='text/javascript'>alert('Failed to upload');</script>";
          }  
      
    }

?>