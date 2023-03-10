<?php 
ob_start();
session_start();
require "DB_conn.php";
$row = "";
if(isset($_SESSION['changeusername']) && isset($_SESSION['isadmin']) && $_SESSION['isadmin']){
    $sql1 = "SELECT username,name,age,bgroup,place,phone,email,placeid,isadmin from users where username ='".$_SESSION['changeusername']."'";
    $query_run1 = mysqli_query($con,$sql1);
    if(mysqli_num_rows($query_run1)==1){
        $row = $query_run1->fetch_assoc();
    }
}
else{
    header("Location: ./index.php");
}
if(isset($_POST['name']) && isset($_POST['age']) && isset($_POST['bloodgroup']) && isset($_POST['phone']) && isset($_POST['email']) && isset($_POST['place'])){
        $name = mysqli_real_escape_string($con,$_POST['name']);
        $age = mysqli_real_escape_string($con,$_POST['age']);
        $bgroup = mysqli_real_escape_string($con,$_POST['bloodgroup']);
        $phone = mysqli_real_escape_string($con,$_POST['phone']);
        $email = mysqli_real_escape_string($con,$_POST['email']);
        $place = mysqli_real_escape_string($con,$_POST['place']);
        $placeid = mysqli_real_escape_string($con,$_POST['placeid']);
        $isadmin = mysqli_real_escape_string($con,$_POST['isadmin']);
        $sql2 = "update users set name ='".$name."' ,age ='".$age."' ,bgroup='".$bgroup."',place ='".$place."' ,phone ='".$phone."' ,email ='".$email."' ,placeid = '".$placeid."' ,isadmin = '".$isadmin."' where username ='".$_SESSION['changeusername']."'";
        $query_run2 = mysqli_query($con,$sql2);
        if($query_run2){
            header("Location: ./admin.php");
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

    <ul class="nav nav-pills ">
            <li class="nav-item"><a href="./index.php" class="nav-link " aria-current="page">Home</a></li>
           <?php 
            if(isset($_SESSION['username'])){
                echo '<li class="nav-item"><a href="./find.php" class="nav-link" aria-current="page">Find Donor</a></li>';
                if(isset($_SESSION['isadmin']) && $_SESSION['isadmin']) {
                    echo '<li class="nav-item"><a href="./admin.php" class="nav-link active" aria-current="page">Admin</a></li>';
                    echo '<li class="nav-item"><a href="./logs.php" class="nav-link" aria-current="page">Logs</a></li>';
                }
                  echo '<li class="nav-item"><a href="./change.php" class="nav-link" aria-current="page">Profile</a></li>';
                echo '<li class="nav-item"><a href="./logout.php" class="nav-link " aria-current="page">Logout</a></li>';
            }
            else{
                echo '<li class="nav-item"><a href="./AddUser.php" class="nav-link " aria-current="page">Register</a></li>';
                echo '<li class="nav-item"><a href="./login.php" class="nav-link " aria-current="page">Login</a></li>';
            }
            ?>
        </ul>
    </header>
    <div class="register">
    <div class="col-lg-4 mx-auto vertical-align">
        <form action="adminchange.php" method="post">
            <label for="username">Username</label>
            <input type="text" class="form-control mb-1" id="username" name="username"<?php echo "value ='".$row['username']."'" ?>required disabled>
            <label for="name">Name</label>
            <input type="text" class="form-control mb-1" id="name" name="name" <?php echo "value ='".$row['name']."'" ?> required>
            <label for="age">Age</label>
            <input type="text" class="form-control mb-1" id="age" name="age" <?php echo "value ='".$row['age']."'" ?> required>
            <label for="group">Blood Group</label>
            <select name="bloodgroup" id="group" class="form-select mb-1"  <?php echo "value ='".$row['bgroup']."'" ?> required>
                <?php 
                $groupoptions = array("A+","A-","B+","B-","O+","O-","AB+","AB-");
                for( $i=0;$i<count($groupoptions);$i++){
                    echo "<option value=".$groupoptions[$i]." ".($groupoptions[$i] == $row['bgroup']? "selected":"" ).">".$groupoptions[$i]."</option>";
                }
                ?>
            </select>
            <label for="place">District</label>
            <select name="place" id="place" class="form-select mb-1" <?php echo "value ='".$row['place']."'" ?> required>
            <?php 
            $placeOptions = array("Alappuzha","Ernakulam","Idukki","Kannur","Kasaragod","Kollam","Kottayam","Kozhikode","Malappuram","Palakkad","Pathanamthitta","Thiruvananthapuram","Thrissur","Wayanad");
            for( $i=0;$i<count($placeOptions);$i++){
                echo "<option value=".$placeOptions[$i]." ".($placeOptions[$i] == $row['place']? "selected":"" ).">".$placeOptions[$i]."</option>";
            }
            ?>                
            </select>
            <label for="phone">Phone</label>
            <input type="text" maxlength="10" class="form-control mb-1" id="phone" name="phone" <?php echo "value ='".$row['phone']."'" ?> required>
            <label for="email">Email</label>
            <input type="email" class="form-control mb-1" id="email" name="email" <?php echo "value ='".$row['email']."'" ?> required>
            <input type="text" hidden name = "placeid" <?php echo "value ='".$row['placeid']."'" ?> id="placeid">
            <label for="isadmin">Is Admin</label>
            <input type="checkbox" class="form-checkbox mb-1" id="isadmin" name="isadmin" value="1" <?php echo (($row['isadmin'] == 1)? 'checked':'');?>>
            <button type="submit" class="btn btn-lg btn-primary mx-auto form-control text-center">Save</button>
        </form>
        </div>
    </div>
    <script src ="./js/index.js"></script>
</body>

</html>