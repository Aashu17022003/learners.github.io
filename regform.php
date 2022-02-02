<?php
$showAlert = false;
$showError = false;
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include 'db.php';
    $username = $_POST["username"];
    $stuname = $_POST["stuname"];
    $stu_email = $_POST["stuemail"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];
    $existSql = "SELECT * FROM `student` WHERE stu_username = '$username'";
    $result = mysqli_query($conn, $existSql);
    $numExistRows = mysqli_num_rows($result);
    if($numExistRows > 0){
        
        $showError = "Username Already Exists";
    }
    else{

        if(($password == $cpassword)){
            $sql = "INSERT INTO `student` ( `stu_username`,`stu_name`,`stu_email`, `stu_pass`, `dt`) VALUES ('$username', '$stuname','$stu_email','$password', current_timestamp())";
            $result = mysqli_query($conn, $sql);
            if ($result){
                $showAlert = true;
            }
        }
        else{
            $showError = "Passwords do not match";
        }
    }
}
    
?>

<?php include 'head.php' ;
include 'navlogout.php';
?>
<title>Sign Up</title>
</head>
<body>
    <div class="container my-4" >
     <h1 class="text-center" style="margin-top:150px;">Signup to our website</h1>
     <form action="regform.php" method="post">
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp">
            
        </div>
        <div class="form-group">
            <label for="stuname">Name</label>
            <input type="text" class="form-control" id="stuname" name="stuname" >
            
        </div>
        <div class="form-group">
            <label for="stuemail">Email</label>
            <input type="email" class="form-control" id="stuemail" name="stuemail" >
            
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        <div class="form-group">
            <label for="cpassword">Confirm Password</label>
            <input type="password" class="form-control" id="cpassword" name="cpassword">
            <small id="emailHelp" class="form-text text-muted">Make sure to type the same password</small>
        </div>
         <br>
        <button type="submit" class="btn btn-primary">SignUp</button>
     </form>
    </div>
    <?php
    if($showAlert){
    echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Your account is now created and you can login
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true"></span>
        </button>
    </div> ';
    }
    if($showError){
    echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> '. $showError.'
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true"></span>
        </button>
    </div> ';
    }
    ?>

    <?php require 'footer.php' ?>
