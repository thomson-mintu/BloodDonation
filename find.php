
<?php
ob_start();
session_start();
require "DB_conn.php";
if(isset($_SESSION['username'])){
    $sql1 = "SELECT username,name,age,bgroup,place,phone,email from users where username ='".$_SESSION['username']."'";
    $query_run1 = mysqli_query($con,$sql1);
    if(mysqli_num_rows($query_run1)==1){
        $row = $query_run1->fetch_assoc();
    }
}
else{
    header("Location: ./index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
    crossorigin="anonymous"></script>
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,1,0" />
  <link rel="stylesheet" href="style.css">
  <link rel="shortcut icon" href="./images/icon.png" type="image/x-icon">
  <title>Blood Donation Management</title>
</head>

<body>
  <header class="d-flex flex-wrap justify-content-center  border-bottom">
    <a href="/blooddonation" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
      <img src="./images/icon.png" alt="" srcset="" class="icon">
      <span class="fs-4">Blood Donation Management</span>
    </a>

    <ul class="nav nav-pills">
            <li class="nav-item"><a href="./index.php" class="nav-link" aria-current="page">Home</a></li>
            <?php 
            if(isset($_SESSION['username'])){
                echo '<li class="nav-item"><a href="./find.php" class="nav-link active" aria-current="page">Find Donor</a></li>';
                if(isset($_SESSION['isadmin']) && $_SESSION['isadmin']) {
                    echo '<li class="nav-item"><a href="./admin.php" class="nav-link " aria-current="page">Admin</a></li>';
                  }
                  echo '<li class="nav-item"><a href="./change.php" class="nav-link " aria-current="page">Profile</a></li>';
                echo '<li class="nav-item"><a href="./logout.php" class="nav-link " aria-current="page">Logout</a></li>';
            }
            else{
                echo '<li class="nav-item"><a href="./AddUser.php" class="nav-link " aria-current="page">Register</a></li>';
                echo '<li class="nav-item"><a href="./login.php" class="nav-link " aria-current="page">Login</a></li>';
            }
            ?>
        </ul>
    </header>
    <div class = "find">
    <div class = "vertical-align admin-width">
    <?php echo '<div class="text-center"><h1>Hai '.$row["name"].'</h1></div>' ?>
    <form action="find.php" method="post">
        <div class="row">
            <div class="col-lg-4 ms-auto">
                <label for="group">Blood Group</label>
                <select name="bloodgroup" id="group" class="form-select">
                    <option value="">Select Blood Group</option>
                    <?php 
                $groupoptions = array("A+","A-","B+","B-","O+","O-","AB+","AB-");
                for( $i=0;$i<count($groupoptions);$i++){
                    echo "<option value=".$groupoptions[$i].">".$groupoptions[$i]."</option>";
                }
                ?>
                </select>
            </div>
            <div class="col-lg-4">
                <label for="place">District</label>
                <select name="place" id="place" class="form-select">
                    <option value="">Select District</option>
                    <?php 
            $placeOptions = array("Alappuzha","Ernakulam","Idukki","Kannur","Kasaragod","Kollam","Kottayam","Kozhikode","Malappuram","Palakkad","Pathanamthitta","Thiruvananthapuram","Thrissur","Wayanad");
            for( $i=0;$i<count($placeOptions);$i++){
                echo "<option value=".$placeOptions[$i].">".$placeOptions[$i]."</option>";
            }
            ?>   
                </select>
            </div>
            <div class="col-lg-1 me-auto mt-4">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </div>
        
    </form>

    <div class="row output">
        <div class=" mx-auto">
            <?php

if(isset($_POST['bloodgroup']) && isset($_POST['place'])){
    $bgroup=mysqli_real_escape_string($con,$_POST['bloodgroup']);
    $place=mysqli_real_escape_string($con,$_POST['place']);
    $sql = "SELECT username,name,bgroup,place,phone,email from users where bgroup ='".$bgroup."' and place = '".$place."'";
    $query_run = mysqli_query($con,$sql);
    if(mysqli_num_rows($query_run)==0){
        echo "<h2 class='text-center'>No results found</h2>";
    }
    else{
    echo "<table style=' width: 100%;' class='table table-striped'>";
    echo "<tr>";
    echo "<th style='text-align:center;'>Name</th>";
    echo "<th style='text-align:center;'>Blood Group</th>";
    echo "<th style='text-align:center;'>Place</th>";
    echo "<th style='text-align:center;'>Phone</th>";
    echo "<th style='text-align:center;'>Email</th>";
    echo "</tr>";
    while($row = $query_run->fetch_assoc()){
        if($row['username'] === $_SESSION['username']){

        }
        else{
        echo "<tr>";
        echo "<td style='text-align:center;'>".$row['name']."</td>";
        echo "<td style='text-align:center;'>".$row['bgroup']."</td>";
        echo "<td style='text-align:center;'>".$row['place']."</td>";
        echo "<td style='text-align:center;'>".$row['phone']."</td>";
        echo "<td style='text-align:center;'>".$row['email']."</td>";
        echo "</tr>";
    }}
    echo "</table>";
}
}
?>
</div>
        </div>
        </div>
    </div>
    </div>
</body>

</html>