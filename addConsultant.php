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
  	<a class="element" href="addClient.php">Add Projects </a>	
  </div>		
  <div class="row">
  	<a class="element active" href="addConsultant.php">Add Consultants</a>	
  </div>
  
</aside>

<main>
   <div class="container-fluid bg">
  <form action='addConsultant.php' method="post" class="form-container" enctype="multipart/form-data">
  <h1>Add Consultant</h1>
  <div class="row">
    <div class="col-6">
    <div class="form-group">
      <label for="consultant_id">Consultant ID</label>
      <input type="int" class="form-control" id="consultantId" name="consultantId" placeholder="ID" 
      required>
    </div>
    <div class="form-group">
      <label for="consultant_name">Consultant Name</label>
      <input type="text" class="form-control" id="consultantName" name="consultantName" placeholder="Consultant Name" required>
    </div>
    </div>
    <div class="form-group">
      <label for="doj">Date of Joining</label>
      <input type="date" class="form-control" id="doj" name="doj" placeholder="Date of Joining" required>
    </div>
  </div>
  </div>  
  <br>
  <input type="submit" id="submit" name="submit" value="Submit" class="btn btn-success btn-block" style="width: 20%;">
  <br>
</form>
</div>
</main>

<!--<div class="row">
  <div class="col-2">
    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical" style="height: 100%;background-color: black">
      <label class="nav-link" href="#v-pills-home" style="color: white">Chinese Wall Visualization</label>
      <br>	
      <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true" style="color: white">Dashboard</a>
      <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false" style="color: white">Add Client</a>
      <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false" style="color: white">Add Consultant</a>
    </div>
  </div>
  <div class="col-10">
    <div class="tab-content" id="v-pills-tabContent">
      <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
      	Hello



      </div>
      <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">...</div>
      <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">...</div>
      <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">...</div>
    </div>
  </div>
</div>-->

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
<?php

    require('inc/config.php');
    if(isset($_POST['submit'])){
	   $consultantId = mysqli_escape_string($db,$_POST['consultantId']);
       $consultantName = mysqli_escape_string($db,$_POST['consultantName']);
       $doj = mysqli_escape_string($db,$_POST['doj']);

       //echo "<script type='text/javascript'>alert('$startDate');</script>";

       

       //print_r($fileTmpName);

      

     
          $query = "INSERT into consultants (id,name,doj) VALUES ('$consultantId','$consultantName','$doj')";
          
          if(mysqli_query($db,$query)){
              echo "<script type='text/javascript'>alert('success');</script>";
          }
          else{
            echo "<script type='text/javascript'>alert('Failed to upload');</script>";
          }  
      
    }

?>