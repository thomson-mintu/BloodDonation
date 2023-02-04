<?php
ob_start();
session_start();
require "DB_conn.php";
if(isset($_SESSION['username']) && isset($_SESSION['isadmin']) && $_SESSION['isadmin']){
    $sql = "SELECT username,name from users";
    $sql1 = "SELECT username,name,age,bgroup,place,phone,email,isadmin,placeid from users";
    $query_run = mysqli_query($con,$sql);
}
else{
    header("Location: ./index.php");
}

if(isset($_POST['user'])){
  $_SESSION['changeusername'] = $_POST['user'];
  header('Location: ./adminchange.php');
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <link rel="shortcut icon" href="./images/icon.png" type="image/x-icon">
  <title>Blood Donation Management</title>
</head>

<body>
  <header class="d-flex flex-wrap justify-content-center  border-bottom">
    <a href="/blooddonation" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
      <img src="./images/icon.png" alt="" srcset="" class="icon">
      <span class="fs-4">Blood Donation Management</span>
    </a>

    <ul class="nav nav-pills ">
      <li class="nav-item"><a href="./index.php" class="nav-link " aria-current="page">Home</a></li>

      <?php 
            if(isset($_SESSION['username'])){
                echo '<li class="nav-item"><a href="./find.php" class="nav-link" aria-current="page">Find Donor</a></li>';
                if(isset($_SESSION['isadmin']) && $_SESSION['isadmin']) {
                  echo '<li class="nav-item"><a href="./admin.php" class="nav-link active" aria-current="page">Admin</a></li>';
                }
                echo '<li class="nav-item"><a href="./change.php" class="nav-link " aria-current="page">Profile</a></li>';
                echo '<li class="nav-item"><a href="./logout.php" class="nav-link " aria-current="page">Logout</a></li>';
            }
            else{
                echo '<li class="nav-item"><a href="./AddUser.php" class="nav-link" aria-current="page">Register</a></li>';
                echo '<li class="nav-item"><a href="./login.php" class="nav-link " aria-current="page">Login</a></li>';
            }
            ?>
    </ul>
  </header>
  <div class="admin">
  <div class="row mx-auto vertical-align admin-width">
  <div class="col-lg-3 mx-auto my-4">
 <h3>Add User</h3>
 <form action="./adduser.php">
  <button class = "btn btn-primary my-6 link-button form-control" type="submit">Add</button>
 </form>

 </div>
 <div class="col-lg-3 mx-auto my-4">
 <h3>Edit User</h3>
  <form action="admin.php" method="post">
    <?php
    echo "<select name='user' id='user' class='form-select mb-3'  required>";
    echo "<option value= '' disabled selected>Select User</option>";
    $query_run = mysqli_query($con,$sql);
    while($row = $query_run->fetch_assoc()){
      echo "<option value=".$row['username'].">".$row['name']."</option>";

          }
          echo "</select>";      
          
          ?>
          <button type="submit" class="btn btn-primary form-control">Edit</button>
      </form>
 </div>
 <div class="col-lg-3 mx-auto my-4">
  <h3>Delete User</h3>
  <form action="deleteuser.php" method="post">
    <?php
    echo "<select name='user' id='user' class='form-select mb-3'  required>";
    echo "<option value= '' disabled selected>Select User</option>";
    $query_run = mysqli_query($con,$sql);
    while($row = $query_run->fetch_assoc()){
      echo "<option value=".$row['username'].">".$row['name']."</option>";

          }
          echo "</select>";      
          
          ?>
          <button type="submit" class="btn btn-primary form-control">Delete</button>
      </form>
 </div>
 
 </div>
 </div>
  <script src ="./js/index.js"></script>
</body>

</html>