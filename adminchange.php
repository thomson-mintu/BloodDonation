<?php 
ob_start();
session_start();
require "DB_conn.php";
$row = "";
if(isset($_SESSION['username'])){
    $_SESSION['changeusername'] = $_POST['user'];
    $sql1 = "SELECT username,name,age,bgroup,place,phone,email,placeid from users where username ='".$_POST['user']."'";
    $query_run1 = mysqli_query($con,$sql1);
    if(mysqli_num_rows($query_run1)==1){
        $row = $query_run1->fetch_assoc();
    }
}
else{
    header("Location: ./index.php");
}
if(isset($_POST['username']) &&isset($_POST['name']) && isset($_POST['age']) && isset($_POST['bloodgroup']) && isset($_POST['phone']) && isset($_POST['email']) && isset($_POST['place'])){
       $username =  mysqli_real_escape_string($con,$_POST['username']);
    $name = mysqli_real_escape_string($con,$_POST['name']);
        $age = mysqli_real_escape_string($con,$_POST['age']);
        $bgroup = mysqli_real_escape_string($con,$_POST['bloodgroup']);
        $phone = mysqli_real_escape_string($con,$_POST['phone']);
        $email = mysqli_real_escape_string($con,$_POST['email']);
        $place = mysqli_real_escape_string($con,$_POST['place']);
        $placeid = mysqli_real_escape_string($con,$_POST['placeid']);
        $sql2 = "update users set name ='".$name."' ,age ='".$age."' ,bgroup='".$bgroup."',place ='".$place."' ,phone ='".$phone."' ,email ='".$email."' ,placeid = '".$placeid."' where username ='".$username."'";
        $query_run2 = mysqli_query($con,$sql2);
        if($query_run2){
            header("Location: ./adminchange.php");
        }
        else{
            echo "<script>alret('Failed to update')</script>";
        }
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
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

    <ul class="nav nav-pills py-3">
            <li class="nav-item"><a href="./index.php" class="nav-link " aria-current="page">Home</a></li>
           <?php 
            if(isset($_SESSION['username'])){
                echo '<li class="nav-item"><a href="./find.php" class="nav-link" aria-current="page">Find Donor</a></li>';
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
    

    <script src ="./js/index.js"></script>
</body>

</html>