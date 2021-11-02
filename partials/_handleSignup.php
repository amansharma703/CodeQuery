<?php
$showerror = "false";
if($_SERVER["REQUEST_METHOD"]=="POST"){

    include '_dbconnect.php'; 
    $user_name= $_POST['signupEmail'];
    $pass= $_POST['signupPassword'];
    $cpass= $_POST['signupcPassword'];

    //Check whether this email exist
    $existSql = "SELECT * FROM `users` WHERE user_name = '$user_name'";
    $result = mysqli_query($conn, $existSql);
    $numRows = mysqli_num_rows($result);
    if($numRows>0){
        $showerror = "usedEmail";       
    }
    else{
        if($pass==$cpass){
            $hash = password_hash($pass, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `users` (`user_name`, `user_pass`, `timestamp`) VALUES ('$user_name', '$hash', current_timestamp())";
            $result = mysqli_query($conn, $sql);
            // echo $result;
            if($result){
                $showAlert = true;
                header("Location: /forum/index.php?signupsuccess=true");
                exit();
            }
        }
        else{
            $showerror = "notMatched";       
        }
    }
    header("Location: /forum/index.php?signupsuccess=false&error=$showerror");
}

?>