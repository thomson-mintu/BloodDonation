
<?php
ob_start();
session_start();
require "DB_conn.php";
if(isset($_SESSION['username'])){
  header("Location: ./find.php");
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

    <ul class="nav nav-pills ">
            <li class="nav-item"><a href="./index.php" class="nav-link " aria-current="page">Home</a></li>

            <?php 
            if(isset($_SESSION['username'])){
                echo '<li class="nav-item"><a href="./find.php" class="nav-link" aria-current="page">Find Donor</a></li>';
                echo '<li class="nav-item"><a href="./change.php" class="nav-link " aria-current="page">Edit Details</a></li>';
                echo '<li class="nav-item"><a href="./logout.php" class="nav-link " aria-current="page">Logout</a></li>';
            }
            else{
                echo '<li class="nav-item"><a href="./AddUser.php" class="nav-link" aria-current="page">Register</a></li>';
                echo '<li class="nav-item"><a href="./login.php" class="nav-link active " aria-current="page">Login</a></li>';
            }
            ?>
        </ul>
    </header>
    <div class="login">
    <div class="col-lg-4 mx-auto vertical-align">
        <form action="./login.php" method="post">
            <label for="username">Username</label>
            <input type="text" class="form-control mb-3" id="username" name="username" required>
            <label for="password">Password</label>
            <input type="password" class="form-control mb-3" id="password" name="password" required>
            <button type="submit" class="btn btn-primary">Login</button>
            <a href ="adduser.php" class="nav-link">New User? Register here<a>
        </form>
        </div>
    </div>
</body>

</html>

<?php
if(isset($_POST['username']) && isset($_POST['password'])){
    $username=mysqli_real_escape_string($con,$_POST['username']);
    $password=mysqli_real_escape_string($con,md5($_POST['password']));
    $sql = "SELECT username,name,bgroup,place,phone,email,isadmin from users where username ='".$username."' and password = '".$password."'";
    $query_run = mysqli_query($con,$sql);
    if(mysqli_num_rows($query_run)==1){
        $row = $query_run->fetch_assoc();
        echo "<script>alert('Login Successful'".$row['isadmin'].");</script>";
    		session_regenerate_id();
    		$_SESSION['username'] = $row['username'];
        $_SESSION['isadmin'] = $row['isadmin'];
        header("Location: ./find.php");

    }
    else{
        echo "<script>alert('Invalid username or password!!!');</script>";
    }
}

    ?>