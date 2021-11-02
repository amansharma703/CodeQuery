<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">


    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <script src="https://kit.fontawesome.com/3e7d60019e.js" crossorigin="anonymous"></script>
    <style>
    body {
        background: -webkit-linear-gradient(left, #0072ff, #00c6ff);
    }

    .contact-form {
        background: #fff;
        margin-top: 7%;
        margin-bottom: 5%;
        width: 70%;
    }

    .contact-form .form-control {
        border-radius: 1rem;
    }

    .contact-image {
        text-align: center;
    }

    .contact-image img {
        border-radius: 6rem;
        width: 11%;
        margin-top: -3%;
        transform: rotate(29deg);
    }

    .contact-form form {
        padding: 14%;
        padding-top: 10% !important;
    }

    .contact-form form .row {
        margin-bottom: -7%;
    }

    .contact-form h2 {
        margin-bottom: 8%;
        margin-top: -10%;
        text-align: center;
        color: #0062cc;
    }

    .contact-form .btnContact {
        width: 50%;
        border: none;
        border-radius: 1rem;
        padding: 1.5%;
        background: #dc3545;
        font-weight: 600;
        color: #fff;
        cursor: pointer;
    }

    .btnContactSubmit {
        width: 50%;
        border-radius: 1rem;
        padding: 1.5%;
        color: #fff;
        background-color: #0062cc;
        border: none;
        cursor: pointer;
    }
    </style>
    <title>CodeQuery - Contact Us</title>
</head>

<body>
    <?php include 'partials\_dbconnect.php'; ?>
    <?php include 'partials\_header.php'; ?>

    <?php   
    $showAlert=false;

    $method = $_SERVER['REQUEST_METHOD'];
    if($method == 'POST'){
    // getting data from user
    $name = $_POST['name'];
    $email = $_POST['email'];
    $number = $_POST['number'];
    $text = $_POST['text'];

    // inserting data into database
    $sql="INSERT INTO `contact` (`contact_name`, `contact_email`, `contact_no`, `contact_text`, `timestamp`) VALUES ('$name', '$email', '$number', '$text', current_timestamp())";
    $result = mysqli_query($conn, $sql);
    $showAlert=true;

    if($showAlert){
      echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
      <strong>Success!</strong> Your request has been taken.
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
      </button>
    </div>";
    }
    }
    ?>

    <?php

    echo '<div class="container contact-form">
    <div class="contact-image">
        <img src="img/rocket_contact.png" alt="rocket_contact"/>
    </div>
    <form action="'.$_SERVER["REQUEST_URI"].'" method="post">
        <h2>Drop Us a Message</h2>
       <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <input type="text" name="name" class="form-control" placeholder="Your Name *" value="" />
                </div>
                <div class="form-group">
                    <input type="email" name="email" class="form-control" placeholder="Your Email *" value="" />
                </div>
                <div class="form-group">
                    <input type="number" name="number" class="form-control" placeholder="Your Phone Number *" value="" />
                </div>
                <div class="form-group">
                    <input type="submit" name="btnSubmit" class="btnContact" value="Send Message" />
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <textarea name="text" class="form-control" placeholder="Your Message *" style="width: 100%; height: 150px;"></textarea>
                </div>
            </div>
        </div>
    </form>
    </div>';

    ?>


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