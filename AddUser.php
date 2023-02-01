<?php 
require "DB_conn.php";
if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['name']) && isset($_POST['age']) && isset($_POST['bloodgroup']) && isset($_POST['phone']) && isset($_POST['email']) && isset($_POST['place'])){
$user = $_POST['username'];
$pw = md5($_POST['password']);
$name = $_POST['name'];
$age = $_POST['age'];
$bgroup = $_POST['bloodgroup'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$place = $_POST['place'];
$sql = "INSERT INTO users (username, password,name,age,bgroup,place,phone,email) VALUES ('".$user."', '".$pw."', '".$name."', '".$age."', '".$bgroup."','".$place."', '".$phone."', '".$email."')";
$query_run = mysqli_query($con,$sql);
if($query_run){
    echo "<script>alert('Success')</script>";
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
    <link rel="stylesheet" href="style.css">
    <title>Blood Donation Management</title>
</head>

<body>
    <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
        <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
            <img src="./images/icon.png" alt="" srcset="" class="icon">
            <span class="fs-4">Blood Donation Management</span>
        </a>

        <ul class="nav nav-pills">
            <li class="nav-item"><a href="./index.php" class="nav-link " aria-current="page">Home</a></li>
            <li class="nav-item"><a href="./AddUser.php" class="nav-link active" aria-current="page">Add Donor</a></li>
        </ul>
    </header>
    <div class="col-lg-4 mx-auto">
        <form action="./AddUser.php" method="post">
            <label for="username">Username</label>
            <input type="text" class="form-control mb-3" id="username" name="username" required>
            <label for="password">Password</label>
            <input type="password" class="form-control mb-3" id="password" name="password" required>
            <label for="name">Name</label>
            <input type="text" class="form-control mb-3" id="name" name="name" required>
            <label for="age">Age</label>
            <input type="text" class="form-control mb-3" id="age" name="age" required>
            <label for="group">Blood Group</label>
            <select name="bloodgroup" id="group" class="form-select mb-3"  required>
                <option value="">Select Blood Group</option>
                <option value="A pos">A+</option>
                <option value="A neg">A-</option>
                <option value="B pos">B+</option>
                <option value="B neg">B-</option>
                <option value="O pos">O+</option>
                <option value="O neg">O-</option>
                <option value="AB pos">AB+</option>
                <option value="AB neg">AB-</option>
            </select>
            <label for="place">District</label>
            <select name="place" id="place" class="form-select mb-3" required>
                <option value="">Select District</option>
                <option value="Alappuzha">Alappuzha</option>
                <option value="Ernakulam">Ernakulam</option>
                <option value="Idukki">Idukki</option>
                <option value="Kannur">Kannur</option>
                <option value="Kasaragod">Kasaragod</option>
                <option value="Kollam">Kollam</option>
                <option value="Kottayam">Kottayam</option>
                <option value="Kozhikode">Kozhikode</option>
                <option value="Malappuram">Malappuram</option>
                <option value="Palakkad"> Palakkad</option>
                <option value="Pathanamthitta">Pathanamthitta</option>
                <option value="Thiruvananthapuram">Thiruvananthapuram</option>
                <option value="Thrissur">Thrissur</option>
                <option value="Wayanad">Wayanad</option>
            </select>
            <label for="phone">Phone</label>
            <input type="text" maxlength="10" class="form-control mb-3" id="phone" name="phone" required>
            <label for="email">Email</label>
            <input type="email" class="form-control mb-3" id="email" name="email" required>

            <button type="submit" class="btn btn-lg btn-primary mx-auto form-control text-center">Save</button>
        </form>
    </div>
</body>

</html>