
<!-- connected to mysql database,mysql i procceser oriented progrming languaue -->
 <!-- ways to connect to MYSQL Database 
 1 MYSQLi extension

 2 PDO
 
 -->

<?php
$insert = false;
// $not_insert = false;

// mera variable set hai ya nhi
 if(isset($_POST['name'])) {

    // set connection variable,ya by default hai agr server mein gya toh psswd dena hoga
$server = "localhost";
$username = "root";
$password = "";
$database = "trip";


// create a connection 
$con = mysqli_connect($server,$username,$password,$database);

// check for connection success
// die if connection was not successful
if(!$con){
  // yahi funct khtm die lgane se isliye else use nhi krte
    die("connection to this database failed due to" . 
    mysqli_connect_error());  
}

// echo "success connecting to the database"

// create a database
// $sql = "CREATE DATABASE trip";
// mysqli_query($conn,$sql);

$name = $_POST['name'];
$year = $_POST['year'];
$gender = $_POST['gender'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$desc = $_POST['desc'];

// Execut the querry
$sql ="INSERT INTO `trip`.`trip_detail` ( `Name`, `Year`, `Gender`, `Email`, `Phone number`, `desc`, `Date`) 
VALUES ('$name', '$year', '$gender', '$email', '$phone', '$desc', current_timestamp()); ";

// echo $sql;

// object operator
   if($con-> query($sql) == true){
    // echo "successfully inserted";

    // fag for true
    $insert = true;
    // echo "Thanks for submitting";
   }
   else{
    echo "ERROR: $sql <br> $con->error";
    //    $not_insert = true;
   }

//    close the database connection
   $con-> close();
 }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>college trip</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark ">
        <div class="container-fluid">
          <a class="navbar-brand" href="https://vnit.ac.in/student-activities/">Student Activity VNIT</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="home.html">Home</a>
              </li>
              
              <li class="nav-item">
                <a class="nav-link" href="/fproject/pay.html">Payment link </a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="index.html">Registration form </a>
              </li>
             
             
            </ul>
           
          </div>
        </div>
      </nav>

   <img class="bg"src="img_VNIT.jfif" alt="VNIT">

    <div class="containe">
    <?php
    if ($insert == true) {
        echo '<div class="alert alert-primary" role="alert">
        Congratulations! 🎉 Your form has been successfully submitted! Get ready to embark on an unforgettable adventure with us! 🌟
</div>';
    }
    ?>
        <h1>Welcome to  VNIT Nagpur Trip Form</h1>
        <p>Enter your details to confirm your participants in the trip</p>
        
    


        <form action="index.php" method="post" >
          <input type="text" name="name" id="name" placeholder="Enter your name" >
          <input type="text" name="year" id="year" placeholder="Enter your year" >
          <input type="text" name="gender" id="gender" placeholder="Enter your gender" >
          <input type="text" name="email" id="email" placeholder="Enter your email" >
          <input type="text" name="phone" id="phone" placeholder="Enter your phone number" >

          <textarea required name="desc" id="desc" cols="30" rows="10"  placeholder="Enter payment information like reference number"></textarea>

           <button type="submit" class="btn btn-primary">submit</button>
           

        </form>
    </div>
    <script src="index.js"></script>
</body>
</html>

 

<!-- INSERT INTO `trip_detail` (`S.NO`, `Name`, `Year`, `Gender`, `Email`, `Phone number`, `Other`, `Date`) 
VALUES ('1', 'Ankit Kumar', '4th', 'Male', 'ankitkumar20may2003@gmail.com', '8882703075', 'I am from HB-2 Hostel', current_timestamp()); 