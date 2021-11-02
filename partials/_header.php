<?php
session_start();
$thisPage='Home'; 
echo '<nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
<a class="navbar-brand" href="index.php">CodeQuery</a>
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon"></span>
</button>

<div class="collapse navbar-collapse" id="navbarSupportedContent">
  <ul class="navbar-nav mr-auto">
    <li class="nav-item active">
      <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
    </li>
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Top Categories
      </a>
      <div class="dropdown-menu" aria-labelledby="navbarDropdown">';
        $sql = "SELECT category_name, category_id FROM `categories` LIMIT 3";
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($result)){
        echo '<a class="dropdown-item" href="threadlist.php?catid='.$row['category_id'].'">'.$row['category_name'].'</a>';
      }
  echo    '</div>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="contact.php" tabindex="-1" >Contact</a>
    </li>
  </ul>';
  if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
  echo '<form class="form-inline my-2 my-lg-0" action="search.php" method="get">
  <p class="text-light my-0 mx-2">
  Welcome ' .$_SESSION['useremail']. '
  </p>
  <a href="partials/_logout.php" class="btn btn-outline-success">Logout</a>
  </form>';
  }
  else{

    echo '
    <div class="mx-2">
    <button class="btn btn-success" data-toggle="modal" data-target="#loginModal">Login</button>
    <button class="btn btn-success" data-toggle="modal" data-target="#signupModal">SignUp</button>
    </div>';
  }
    echo '</div>
</nav> ';

include 'partials/_loginModal.php';
include 'partials/_signupModal.php';
if(isset($_GET['signupsuccess']) && $_GET['signupsuccess'] == "true"){
  echo "<div class='alert alert-success alert-dismissible fade show my-0' role='alert'>
      <strong>Success!</strong> You can now Login.
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
      </button>
    </div>";
}

if(isset($_GET['signupsuccess']) && $_GET['signupsuccess'] == "false" && $_GET['error'] == "usedEmail"){
  echo "<div class='alert alert-danger alert-dismissible fade show my-0' role='alert'>
  <strong>Signup Failed!</strong> Username already exists
  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </button>
</div>";
}
if(isset($_GET['signupsuccess']) && $_GET['signupsuccess'] == "false" && $_GET['error'] == "notMatched"){
  echo "<div class='alert alert-danger alert-dismissible fade show my-0' role='alert'>
  <strong>Signup Failed!</strong> Password don't Matched
  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </button>
</div>";
}
if(isset($_GET['loginsuccess']) && $_GET['loginsuccess'] == "true"){
  echo "<div class='alert alert-success alert-dismissible fade show my-0' role='alert'>
      <strong>Login Success!</strong>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
      </button>
    </div>";
}

if(isset($_GET['loginsuccess']) && $_GET['loginsuccess'] == "false" && $_GET['error'] == "true"){
  echo "<div class='alert alert-danger alert-dismissible fade show my-0' role='alert'>
  <strong>Login Failed!</strong> Invalid Credentials
  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </button>
</div>";
}

?>

