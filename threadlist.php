<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <script src="https://kit.fontawesome.com/3e7d60019e.js" crossorigin="anonymous"></script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <title>CodeQuery - Coding Forum</title>
</head>

<body>
    <?php include 'partials\_dbconnect.php'; ?>
    <?php include 'partials\_header.php'; ?>
    <?php    
    $id = $_GET['catid'];
    $sql = "SELECT * FROM `categories` WHERE category_id=$id";
    $result = mysqli_query($conn, $sql);
    // use a for loop to iteraate through category
    while($row = mysqli_fetch_assoc($result)){

      $catname = $row['category_name'];
      $catdesc = $row['category_description'];
    }
    ?>

    <?php   
    $showAlert=false;

    $method = $_SERVER['REQUEST_METHOD'];
    if($method == 'POST'){
    // insert thread into db
    $th_title = $_POST['title'];
    $th_desc = $_POST['desc'];

    $th_title = str_replace("<", "&lt;", $th_title);
    $th_title = str_replace(">", "&gt;", $th_title);

    $th_desc = str_replace("<", "&lt;", $th_desc);
    $th_desc = str_replace(">", "&gt;", $th_desc);

    $sno = $_POST['sno'];

    $sql="INSERT INTO `threads` (`thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `timestamp`) VALUES ('$th_title', '$th_desc', '$id', '$sno', current_timestamp())";
    $result = mysqli_query($conn, $sql);
    $showAlert=true;

    if($showAlert){
      echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
      <strong>Success!</strong> Your thread has been added,Please wait for someone's response.
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
      </button>
    </div>";
    }
    }
    ?>


    <div class="container my-4">
        <div class="jumbotron">
            <h1 class="display-4">Welcome to <?php  echo $catname; ?> Forum</h1>
            <p class="lead"><?php  echo $catdesc; ?> </p>
            <hr class="my-4">
            <p>This is perr to peer forum,
                No Spam / Advertising / Self-promote in the forums is not allowed.
                <br>
                Do not post copyright-infringing material.
                Do not post “offensive” posts, links or images.<br>
                Do not cross post questions.
                Remain respectful of other members at all times
            </p>
            <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
        </div>
    </div>

    <?php
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
        echo '<div class="container">
            <form action="'.$_SERVER["REQUEST_URI"].'" method="post">
        <h1 class="py-2">Start a Discussion</h1>
        <div class="form-group">
            <label for="exampleInputEmail1">Problem title</label>
            <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
            <small id="emailHelp" class="form-text text-muted">Keep your title as short and crisp as
                possible</small>
            <input type="hidden" name="sno" value="'.$_SESSION["sno"].'">
            
        </div>
        <div class="form-group">
            <label for="exampleFormControlTextarea1">Elaborate your problem</label>
            <textarea class="form-control" name="desc" id="desc" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        </div>';
    }
    else{
        echo '<div class="container">
        <h1 class="py-2">Start a Discussion</h1>
        <p class="lead">
        You are not logged in. Please Login to be able to start a Discussion</p></div>';
    }
    ?>


    <div class="container" id="ques">
        <h1 class="py-2">Browse Question</h1>
        <?php    
        $id = $_GET['catid'];
        $sql = "SELECT * FROM `threads` WHERE thread_cat_id=$id";
        $result = mysqli_query($conn, $sql);
        $noresult = true;
        // use a for loop to iteraate through category
        while($row = mysqli_fetch_assoc($result)){
        $noresult=false;
        $id = $row['thread_id'];
        $title = $row['thread_title'];
        $desc = $row['thread_desc'];
        $thread_time = $row['timestamp'];
        $thread_user_id = $row['thread_user_id'];
        $sql2 ="SELECT * FROM `users` WHERE sno=$thread_user_id";
        $result2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_assoc($result2);




        echo '<div class="media my-3">
                <img src="img/userdefault.png" width="54px" class="mr-3" alt="...">
                <div class="media-body">
                    <h5 class="mt-0"><a href="thread.php?threadid='.$id.'">'.$title.'</a></h5>
                    '.$desc.'
                </div>
                <p class="font-weight-bold my-0">Asked by: '.$row2['user_name'].' <small> at '.$thread_time.'</small> </p>

                </div>';
        }
        if($noresult){
            echo '<div class="jumbotron jumbotron-fluid">
                <div class="container">
                    <p class="display-4">No Thread found</p>
                    <p>Be the first person to ask a problem</p>
                </div>
                </div>';
        }
        ?>
    </div>





    <?php include 'partials\_footer.php'; ?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
        integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
    </script>
</body>

</html>