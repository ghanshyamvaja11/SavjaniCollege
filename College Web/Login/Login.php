<?php
session_start();
$_SESSION['Login_type'] = $_SESSION['Username'] = $_SESSION['Password'] = '';
include '../php files/db_connection.php';
    
$Login_type = $Username = $Password = "";
 if(isset($_POST['Login'])){
$Login_type = $_POST['Login_type'];
$Username = $_POST['Username'];
$Password = $_POST['Password'];
$Count = 1;

   if($Login_type == "Principal")
   {
       //Login Validation for Principal
    $sql = "SELECT *FROM `Login` WHERE Login_type='Principal'";
    
    $check = mysqli_query($conn, $sql);
    while($Match = $check->fetch_assoc())
    {
        if($Login_type == $Match['Login_type'] && $Username == $Match['Username'] && $Password == $Match['Password']){
     $_SESSION['Login_Type'] = $Match['Login_type'];
     $_SESSION['Username'] = $Match['Username'];
     $_SESSION['Password'] = $Match['Password'];

    header("location: ../Principal/Welcome.php", true, 301);
    $Count = 0;
    exit();
    
}
else{
    if($Count == 1){
       echo "<center><h4 style='color: red; display: block-inline;'>Enter Valid Username and Password</h4></center>";
       break;
   }
}
        }
   }
  else if($Login_type == "Clerk")
  {
        //Login Validation for Clerk
    $sql = "SELECT *FROM `Login` WHERE Login_type='Clerk'";
    
    $check = mysqli_query($conn, $sql);
    while($Match = $check->fetch_assoc())
    {
        if($Login_type == $Match['Login_type'] && $Username == $Match['Username'] && $Password == $Match['Password']){
            
            $_SESSION['Username'] = $Match['Username'];
            $_SESSION['Password'] = $Match['Password'];
            $_SESSION['Login_type'] = $_POST['Login_type'];
    
            header("location: ../Clerk/Welcome.php", true, 301);
            exit();
}
else{
    echo "<center><h4 style='color: red; display: block-inline;'>Enter Valid Username and Password</h4></center>";
}
        }
  }
//   else if($Login_type == "Libraian"){
//         //Login Validation for Librarian
//     $sql = "SELECT *FROM `Login` WHERE Login_type='Librarian'";
    
//     $check = mysqli_query($conn, $sql);
//     while($Match = $check->fetch_assoc())
//     {
//         if($Login_type == $Match['Login_type'] && $Username == $Match['Username'] && $Password == $Match['Password']){
//          $_SESSION['Username'] = $Match['Username'];
//          $_SESSION['Password'] = $Match['Password'];
//     header("location: ../Librarian/Welcome.php", true, 301);
//     exit();
// }
// else{
//     echo "<center><h4 style='color: red; display: block-inline;'>
//     Enter Valid Username and Password</h4></center>";
// }
//         }
//     }
   
   //Login Validation for Faculties
   if($Login_type == "Faculty")
   {
       $sql = "SELECT *FROM `Faculties` WHERE Endorsement_No='$Username'";
    
    $check = mysqli_query($conn, $sql);
    while($Match = $check->fetch_assoc())
    {
        if($Username == $Match['Endorsement_No'] && $Password == $Match['Password']){
    
     $_SESSION['Username'] = $Match['Endorsement_No'];
     $_SESSION['Password'] = $Match['Password'];
     $_SESSION['Login_type'] = $_POST['Login_type'];


    echo "<script>window.location = '../Faculties/Welcome.php'</script>";
    $Count = 0;
    exit();
    
}
else{
    if($Count == 1){
       echo "<center><h4 style='color: red; display: block-inline;'>Enter Valid Username and Password</h4></center>";
       break;
   }
}
        }
   }
   
   if($Login_type == "Student"){
   //Login Validation for Student
    $sql = "SELECT *FROM `Student Registration` WHERE SPU_ID =$Username";
    $check = mysqli_query($conn, $sql);
   if($Login_type == "Student" && mysqli_num_rows($check) > 0)
   {
    while($Match = $check->fetch_assoc())
    {
        if($Username == $Match['SPU_ID'] && $Password == $Match['Password']){
    
     $_SESSION['Username'] = $Match['SPU_ID'];
     $_SESSION['Password'] = $Match['Password'];
     $_SESSION['Login_type'] = $_POST['Login_type'];


    header("location: ../Student Corner/Welcome_User.php", true, 301);
    $Count = 0;
    exit();
    
}else{
if($Count == 1){
       echo "<center><h4 style='color: red; display: block-inline;'>Enter Valid Username and Password</h4></center>";
       break;
   }
}
        }
   }
}else{
     $_SESSION['Username'] = "";
     $_SESSION['Password'] = "";
     $_SESSION['Login_type'] = "";
   }
 }
 mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Savjani College</title>
<link rel="icon" type="image/x-icon" href="../../Images/Header&Footer/favicon.jpg">
    
    <link rel="stylesheet" href="../CSS Files/headerNmenuNfooter.css">
    <link rel="stylesheet" href="../CSS Files/Login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .disclaimer{
            display: none;
        }
        #Login1{
    cursor: pointer;
    color: black;
    background-color: white;
    font-weight: bolder;
}

    #Login1:hover{
    cursor: pointer;
    color: white;
    background-color: red;
}
    </style>
</head>
<body>
    <header id="header">
        <center>
            <img src="../../Images/Header&Footer/savjaniclg.png" alt="img"> 
        </center>
        </header>
<nav class="navbar">
    <a href="/index.php">HOME</a>
    <a href="../php files/Courses.php">Courses</a>
    <a href="../Student Corner/Welcome.php">Student Corner</a>
    <a href="../php files/Infrastructure.php">Infrastructure</a>
    <a href="../php files/Events.php">Events</a>
    <a href="../php files/About us.php">About us</a>
    <a href="../php files/Downloads.php">Downloads</a>
    <a href="../php files/Contact us.php">Contact us</a>
</nav>
<main>
    <section>
         <br>
         <center>
             <hr>
             <br>
             <hr>
        <form action="" method="POST">
            <fieldset>
            <legend>Login</legend>
<center><img src="../../Images/Login/Logged_in.jpg" style='background-color: white; height: 96px; width: 95px; border-radius: 59px;'></center>
                <p>
            <select name="Login_type" id="Login_type" required>
                <option value="" selected>Select Login Type</option>
                <option value="Principal">Principal</option>
                <option value="Clerk">Clerk</option>
                <!--<option value="Librarian">Librarian</option>-->
                <option value="Faculty">Faculty</option>
                <option value="Student">Student</option>
            </select><p>
            <input type="text" name="Username" id="Username" placeholder="Enter Username *" required><br><br>
            <input type="password" name="Password" id="Password" placeholder="Enter Password *" required><br><br>
            <center><input type="submit" name="Login" value="Login" id="Login1" style="font-size: 19.9px; border-radius: 29px; font-weight: bolder;"></center>
            <center><h2 style='color: red;'>OR</h2></center>
            <center><a href="Login_with_OTP.php"><input type="button" id="Login2" value="Login with OTP"></a></center>
            
            </fieldset>
            <a href="Forgot_Password.php"><center><h5 style='color: blue;'>Forgot Password?</h5></center></a>
             <p>
        </form>
         <center>
                 </center>
    </section>
<hr>
</main>

  <footer>
    <div id="Quick-Links">
        <h1>Quick Links</h1>
        <a target="_blank" href="https://www.bknmu.edu.in"><img src="../../Images/Header&Footer/Bknmu.png" alt="bknmu" style="background-color: transparent;"></a>
        <a target="_blank" href="https://www.veravaleducationsociety.org/index.php"><img src="../../Images/Header&Footer/veravaledu.png" alt="veravaleducationsociety" style="background-color: transparent;"></a>
        &nbsp;&nbsp;
        <a target="_blank" href="https://www.ugc.ac.in/"><img src="../../Images/Header&Footer/ugc_logo.png" alt="ugc_logo"></a>
    </div>
    <br>
    <div id="Contact">
        <center>
        <strong><span>Available @</span>&nbsp;Phone: 02876-246144</strong>
        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
        <a href="https://www.youtube.com/channel/UC-81pH34mh1PNSgynAGskzQ/videos?view=0&sort=p&flow=grid" class="fa fa-youtube"></a>
        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
        <a href="https://www.facebook.com/Kmsavjani-collage-585457021515265/" class="fa fa-facebook"></a> 
    </center>
        </div>
        <div id="headerNav">
            <a href="#header" style= "text-decoration:none;"><img src="../../Images/Header&Footer/Up-Arrow.png" alt="">
            <strong id="top">Top</strong>
            </a>
            </div>
        <center>
         <h1 id="copyright">&copy;&nbsp;2022-<script>document.write(new Date().getFullYear())</script> Savjani College and GHANSHYAM VAJA. All Rights Reserved</h1>
        </center>
</footer>
</body>
</html>