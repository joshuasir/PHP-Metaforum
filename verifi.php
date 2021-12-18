<!doctype html>
<html lang="en">
  <head>
    <title> Home</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/e2902e5e81.js" crossorigin="anonymous"></script>
</head>
  <body>
    <header>
        <nav class="navbar navbar-expand-md navbar-light fixed-top bg-light py-4">
            <div class="container-fluid">
                <a class="nav-item nav-link" href="./index.php"><i class="fab fa-asymmetrik"></i> MetaForum</a>
                <a href="" class="navbar-toggler" data-toggle="collapse" data-target="#navbar-menu"><i class="navbar-toggler-icon"></i></a>
            <div class="navbar-collapse collapse" id="navbar-menu">
                <div class="navbar-nav ml-auto">
                <a class="nav-item nav-link"href="./index.php" ><i class="fas fa-home"></i> Home</a>
                <a class="nav-item nav-link"href=""><i class="fas fa-comment-dots"></i> Forum Thread</a>
                <a class="nav-item nav-link"href="./signup.php"><i class="fas fa-user-plus"></i> Sign up</a>
                <a class="nav-item nav-link"href="./login.php"><i class="fas fa-sign-in-alt"></i> Log in</a>
            </div>
            </div>
            </div>
            
        </nav>
    </header>  
    <main class="d-flex text-center flex-column align-items-center">
    <?php
        require './databaseHandler.php';
        if(isset($_GET['a']) && !empty($_GET['a'])){
            verifyEmail($_GET['a']);
            echo '<p class="container-fluid text-center text-muted pt-5 mt-5">Successfully Verified</p>';
            echo '<a href="Login.php"  class="btn btn-primary mb-2 w-25 ">Go to Log in Page</a>';
            // header("location:login.php");
        }else{
            header("location:login.php");
        }
    ?>
    </main>
    <footer class="container-fluid text-center">
        <!-- Joshua S &copy; 2021 -->
    </footer>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>

