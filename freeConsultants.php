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
  <div class="row">   
      <h1 style="padding-left: 20px;" >Dravidzilla</h1>
      <img src="images/rahul_dravid.jpeg" style="height: 80px;width: 200px; padding-left: 40px;">
      <img src="images/greatWall.jpg" style="height: 80px;width: 180px; margin-left: 550px;">
</div>
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
  <div class="row">
  <?php
  $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
  $parts = parse_url($url);
  parse_str($parts['query'], $query);
  $pID =  $query['project_id'];
  ?>
  <div class="container col-5" style="margin-left: 50px;">
    <h3>Project ID: <?php echo "$pID"?></h3>
    <br>
    <h6>Consultants Currently Assigned are: </h6>
    <?php
      $qc = "SELECT consultant_id FROM projectConsultant WHERE project_id = '$pID' AND end_date IS NULL";
      $res = mysqli_query($db,$qc);      
      while($i = mysqli_fetch_array($res)){
        echo $i['consultant_id'] ."<br>";
      }
    ?>
    <?php echo "<form class='form-horizontal row' method='post'>"; ?>
      <input type="number" name="id" id='id' placeholder="Enter Client ID">
      <input type="submit" name="submit" value="Remove Consultant">
    </form>

    <?php 
      if(isset($_POST['submit'])){
        $cID = $_POST['id'];
        if($cID != ""){
          $date = date("Y-m-d");
          $q = "UPDATE projectConsultant SET end_date='$date' WHERE consultant_id = '$cID' and project_id='$pID'"; 
          if(mysqli_query($db,$q)){
            echo "<script type='text/javascript'>alert('success');</script>";
            echo "<meta http-equiv='refresh' content='0'>";
          }
          else {
            echo "<script type='text/javascript'>alert('Failed to upload');</script>";
          }
        }
      }
    ?>
  </div>
  <div class="col-6">
      <img src="images/donaldWall.jpg" style="height: 200px;width: 400px; margin: 0px 0px 0px 0px;" >    
  </div>
<img src="images/donaldThumbsUp.jpeg" style="height: 200px;width: 300px; margin: 20px 30% 0px 30%;" >
</div>
</main>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
