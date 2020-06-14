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
    <a class="element active" href="allProjects.php">All Projects</a>  
  </div>
   <div class="row">
    <a class="element" href="ModifyProject.php">Modify Projects</a>  
  </div>
</aside>

<main>

<div class="container">
      <form class="form-horizontal row" action="allProjects.php" method="post">
      <select name="search" class="form-control col-2" id="SearchOption" onchange="changeSearch()">
        <option value="client_name">Client Name</option>
        <option value="client_domain">Domain</option>
      </select>
    <input type="text"id="nameSearch" name="nameSearch" class="col-8"> 
      <select name="domain" class="form-control col-8" id="domain" style="display: none;">
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
      <input type="submit" class="button col-2" name="submit" value="Search" />
      <div class="col-5"></div><input type="submit" class="button col-2" name="Reset" value="Reset" /><div class="col-5"></div>
    </form>
</div>
<script type="text/javascript">
  function changeSearch() {
    var x = document.getElementById("SearchOption").value;
    if(x == "client_name"){
      document.getElementById("domain").style.display = 'none';
      document.getElementById("nameSearch").style.display = 'block';
    }
    else {
      document.getElementById("domain").style.display = 'block';
      document.getElementById("nameSearch").style.display = 'none';
    }
  }
</script>
<br>

<?php
  if(isset($_POST['submit'])){
    if($_POST['search'] == "client_name"){
      $s = $_POST['nameSearch'];
      $query = "SELECT project_id,client_name,project_name,client_domain,end_date FROM projects WHERE client_name = '$s'";
    }
    else {
      $s = $_POST['domain'];
      $query = "SELECT project_id,client_name,project_name,client_domain,end_date FROM projects WHERE client_domain = '$s'";
    }
  }
  else{
    $query = "SELECT project_id,client_name,project_name,client_domain,end_date FROM projects ORDER BY client_name ASC";
  }
    $result = mysqli_query($db,$query);
    echo "<table class='table table-striped' id='searchTable'>
      <tr>
      <th style='width:20%'>Client Name</th>
      <th style='width:20%'>Project Name</th>
      <th style='width:20%'>Domain</th>
      <th style='width:20%'>Status</th>
      <th style='width:20%'>Consultants ID</th>
      </tr>
    ";
    while($row = mysqli_fetch_array($result)){
      if($row['end_date'] == null)
        $pStatus = "ongoing";
      else $pStatus = "finished";
      $pID = $row['project_id'];
      echo "<tr>";
      echo "<td> <a href='freeConsultants.php?project_id=".$pID."'>" . $row['client_name'] . "</a></td>";
      echo "<td>" . $row['project_name'] . "</td>";
      echo "<td>" . $row['client_domain'] . "</td>";
      echo "<td>" . $pStatus . "</td>";
      $qc = "SELECT consultant_id FROM projectConsultant WHERE project_id = '$pID'";
      $res = mysqli_query($db,$qc);
      $count = 0;
      $consultants = "";
      while($i = mysqli_fetch_array($res)){
        $count++;
        if($count == 1){
          $consultants = $i['consultant_id'];
        }
        else{
          $consultants = $consultants . ", " . $i['consultant_id'];
        }
      }
      echo "<td>" . $consultants . "<td>";
      echo "</tr>";
    }
    echo "</table>";
?>
</main>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>

