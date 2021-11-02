<?php
    $showerror = "false";
    if($_SERVER["REQUEST_METHOD"]== "POST"){

        include '_dbconnect.php'; 
        $email= $_POST['loginEmail'];
        $pass= $_POST['loginPass'];  
        // echo $pass;
        // echo $email;
        $sql="Select * from users Where user_name = '$email'";
        // echo $sql;
        $result = mysqli_query($conn, $sql);
        $numRows = mysqli_num_rows($result);
        if($numRows==1){
            $row = mysqli_fetch_assoc($result);
            if(password_verify($pass,$row['user_pass'])){
                session_start();
                $_SESSION['loggedin']=true;
                $_SESSION['sno']=$row['sno'];
                $_SESSION['useremail']=$email;

                // echo "logged in". $email;
                // echo $_SESSION['loggedin'];
                header("Location: /forum/index.php?loginsuccess=true");
                exit();   
            }
            else{
                $showError = "true";
                header("Location: /forum/index.php?loginsuccess=false&error=$showerror");
            }
        }
        $showerror = "true";
        header("Location: /forum/index.php?loginsuccess=false&error=$showerror");

    }
?>