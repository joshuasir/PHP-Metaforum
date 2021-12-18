<!doctype html>
<html lang="en">
  <head>
    <title> Sign Up</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php
      // require 'registerHandler.php'
      session_start();
      if(isset($_SESSION['name'])){
        session_destroy();
      }
    ?>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/e2902e5e81.js" crossorigin="anonymous"></script>
    <style>
      #textError{
        display: none;
      }
    
    </style>
  </head>
  <body>
    <header>
        <nav class="navbar navbar-expand-md navbar-light fixed-top bg-light">
            <div class="container-fluid">
                <a class="nav-item nav-link" href="./index.php"><i class="fab fa-asymmetrik"></i> MetaForum</a>
                <a href="" class="navbar-toggler" data-toggle="collapse" data-target="#navbar-menu"><i class="navbar-toggler-icon"></i></a>
            <div class="navbar-collapse collapse" id="navbar-menu">
                <div class="navbar-nav ml-auto">
                <a class="nav-item nav-link"href="./signup.php"><i class="fas fa-user-plus"></i> Sign up</a>
                <a class="nav-item nav-link"href="./login.php"><i class="fas fa-sign-in-alt"></i> Log in</a>
            </div>
            </div>
            </div>
            
        </nav>
    </header>  
    <main class="container-fluid d-flex flex-column w-100 align-items-center">
        <form class="p-5 mt-5 w-25"  method="POST">
            <div class="form-group margin-xs">
              
              <input type="text" class="form-control" name="Email" id="Email" aria-describedby="emailHelp" placeholder="Email">
              <small id="textError" class="form-text text-danger erremail"> Invalid e-mail format </small>
            </div>
            <div class="form-group">
                
                <input type="text" class="form-control" name="Username" id="Username" aria-describedby="emailHelp" placeholder="Username">
                <small id="textError" class="form-text text-danger errname"> Username is already taken/Username must only contain alphanumeric characters/Username must be between 6 and 20 characters long </small>
              </div>
            <div class="form-group">
              
              <input type="password" class="form-control" name="Password" id="Password" placeholder="Password">
              <small id="textError" class="form-text text-danger errpass">  Password must be at least 8 characters long </small>
           </small>
            </div>
            <div class="form-group pb-4">
                
                <input type="password" class="form-control" name="ConfirmPassword" id="ConfirmPassword" placeholder="Confirm Password">
                <small id="textError" class="form-text text-danger errpass2">  Please correctly confirm the password </small>
              </div>
            <!-- <div class="form-check pb-2">
              <input type="checkbox" class="form-check-input" id="exampleCheck1">
              <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div> -->
            <div class="form-group pb-4 text-center">
                <button type="submit" class="btn btn-primary text-center d-flex w-100 justify-content-center">Sign Up</button>
                <small id="textError" class="form-text text-success success">  Account Successfully Created.\nPlease Validate Your Email! </small>
            </div>
            
            <?php
            if(isset($msg)){
              echo '<p class="text-center">$msg</p>';
            }
            ?>
          </form>
    </main>
    <footer class="container-fluid text-center">
        Joshua S &copy; 2021
    </footer>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
      $(function(){
        $("form button[type=submit]").on('click',function(e){
          e.preventDefault();
          // $('#textError:first').css('display','none');
          // $('.errname').css('display','none');
          // $('.errpass').css('display','none');
          // $('.errpass2').css('display','none');
          let name = $('#Username').val();
          let mail = $('#Email').val();
          let password = $('#Password').val();
          let password2 = $('#ConfirmPassword').val();

          $.ajax({
                type: "post",
                url: "./registerHandler.php",
                dataType:"json",
                data: { Username: name,
                        Email:mail,
                        Password:password,
                        ConfirmPassword:password2,
                        submit:true
                    },
                success: function (response) {
                  let flag=0;
                    if(response["mail"]){
                      $('#textError:first').css('display','initial');
                      flag=1;
                    }else{
                      $('#textError:first').css('display','none');
                    }
     
                    if(response["username"]){
                      $('.errname').css('display','initial');
                      flag=1;
                    }else{
                      $('.errname').css('display','none');
                    }

                    if(response["password"]){
                      $('.errpass').css('display','initial');
                      flag=1;
                
                    }else{
                      $('.errpass').css('display','none');
                    }

                    if(response["password2"]){
                      $('.errpass2').css('display','initial');
                      flag=1;
                    }else{
                      $('.errpass2').css('display','none');
                    }
                    if(!flag){
                      // $('.success').css('display','initial');
                      alert("Account Successfully Created!\nPlease Validate Your Email.");
                      window.location.replace("./login.php");
                    }else{
                      // $('.success').css('display','none');
                    }
                    
                      // $('#textError').css('display','none');
                        // window.location.replace("./login.php");
                    
         
                    // 
                    // $(reponse).insertAfter('form button[type=input]');
                }
          });
        });
      });
    </script>
  </body>
</html>