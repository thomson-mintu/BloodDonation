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
            <li class="nav-item"><a href="#" class="nav-link active" aria-current="page">Home</a></li>
            <li class="nav-item"><a href="./AddUser.php" class="nav-link " aria-current="page">Add Donor</a></li>
        </ul>
    </header>
    <form action="index.php" method="post">
        <div class="row">
            <div class="col-lg-4 ms-auto">
                <label for="group">Blood Group</label>
                <select name="bloodgroup" id="group" class="form-select">
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
            </div>
            <div class="col-lg-4">
                <label for="place">District</label>
                <select name="place" id="place" class="form-select">
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
            </div>
            <div class="col-lg-1 me-auto mt-4">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </div>
    </form>

    <div class="row output">
        <div class="col-lg-8 mx-auto">
            <?php

require "DB_conn.php";
if(isset($_POST['bloodgroup']) && isset($_POST['place'])){
    $bgroup=$_POST['bloodgroup'];
    $place=$_POST['place'];
    $sql = "SELECT name,bgroup,place,phone,email from users where bgroup ='".$bgroup."' and place = '".$place."'";
    $query_run = mysqli_query($con,$sql);
    echo "<table style=' width: 100%;' class='table table-success table-striped'>";
    echo "<tr>";
    echo "<th style='text-align:center;'>Name</th>";
    echo "<th style='text-align:center;'>Blood Group</th>";
    echo "<th style='text-align:center;'>Place</th>";
    echo "<th style='text-align:center;'>Phone</th>";
    echo "<th style='text-align:center;'>Email</th>";
    echo "</tr>";
    while($row = $query_run->fetch_assoc()){
        echo "<tr>";
        echo "<td style='text-align:center;'>".$row['name']."</td>";
        echo "<td style='text-align:center;'>".$row['bgroup']."</td>";
        echo "<td style='text-align:center;'>".$row['place']."</td>";
        echo "<td style='text-align:center;'>".$row['phone']."</td>";
        echo "<td style='text-align:center;'>".$row['email']."</td>";
        echo "</tr>";
    }
    echo "</table>";
}
?>
        </div>
    </div>
    </div>
</body>

</html>