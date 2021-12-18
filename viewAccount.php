<?php
session_start();
require 'utils.php';
require 'databaseHandler.php';
if(!isset($_SESSION['id'])){
  header("location:login.php");
}
$user = getUser($_SESSION['name']);
?>
<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
  <header>
        <nav class="navbar navbar-expand-md navbar-light fixed-top bg-light py-4">
            <div class="container-fluid">
                <a class="nav-item nav-link" href="./index.php"><i class="fab fa-asymmetrik"></i> MetaForum</a>
                <a href="" class="navbar-toggler" data-toggle="collapse" data-target="#navbar-menu"><i class="navbar-toggler-icon"></i></a>
            <div class="navbar-collapse collapse" id="navbar-menu">
                <div class="navbar-nav ml-auto">
                <?php 
                
                  if(isset($_SESSION['role'])){
                    if($_SESSION['role']==="Mod"){
                      // echo '<a class="nav-item nav-link"href="">User Management</a>';
                    }
                    echo '<a class="nav-item nav-link"href="./viewAccount.php">Account</a>
                    <a class="nav-item nav-link"href="logoutHandler.php">Log out</a>';
                  }else{
                    echo '<a class="nav-item nav-link"href="./signup.php"><i class="fas fa-user-plus"></i> Sign up</a>
                    <a class="nav-item nav-link"href="./login.php"><i class="fas fa-sign-in-alt"></i> Log in</a>';
                  }
                ?>
                
            </div>
            </div>
            </div>
            
        </nav>
    </header> 
    <nav class="pt-5">
    <span class="nav-item pt-5 profile"type='button' > Profile</span>    
    <!-- <span class="nav-item pt-5 pl-4 account"type='button'> Account Management</span> -->
    </nav>
    <main class="w-100 ">
      <p class="bg-info w-100 p-2 pl-3 "><?= $user['Username'];?>'s Profile</p>
      <section class="d-flex w-100 flex-row">
        <div class="user d-flex flex-column align-items-center w-25 border-right">
        <img src=<?= $user["ProfileImage"]; ?> class="w-25" alt="">
        <p><?= $user['Username']; ?></p>
        <p><?= ($user['Online']) ? 'Online':'Offline'; ?></p>
        <p><?= $user['Role']; ?></p>
        <p><?= $user['Post']; ?> Post(s)</p>
        <p><?= getDiff($user['DiffLog']).' ago'; ?></p>
        <p><?= $user['ModStat']; ?></p>
      </div>
      <div class="d-flex w-100 flex-column">
            <div class="about pb-5">
                  <h1> About </h1>
                  <p> <?= $user['About']; ?></p>
            </div>
            <div class="info d-flex w-100 flex-row p-3">
              <div class="add">
                  <p>Username         : <?= $user['Username']; ?></p>
                  <p>E-mail           : <?= $user['Email']; ?></p>
                  <p>Most Active in   : <?= getMostActive(intval($user['ID'])); ?></p>
                  <p>Number of Hearts : <?= getHeart(intval($user['ID'])); ?></p>
              </div>
              <div class="recent">
                  <p class="text-muted"> Recent Posts On</p>
                  <ul>
                    <?php $posts = getRecentPost(intval($user['ID'])); foreach($posts as $post): $forum = getForum(intval($post['ForumID']))[0]; ?>
                        <li> <p class="list"> <a href="" class=<?='"'.$post['ID'].'"' ?> id=<?='"'.$post['ForumID'].'"'?> value=<?='"'.$post['Category'].'"'?>><?=$forum['Title']?></a> <?=' by '.$forum['Username'].' '.getDiff($post['TimeDiff']).' ago'?> </p> </li>
                      <?php endforeach; ?>
                  </ul>
              </div>
            </div>
      </div>
      </section>
    
    </main>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
      $(function(){
        $('.list a').on('click',function(e){
          e.preventDefault();
          let a = $(this).attr('id');
          let p = $(this).attr('value');
          let loc = $(this).attr('class');
          
          window.location.replace("index.php?a=".concat(a).concat('&p=').concat(p).concat('&loc=').concat(loc));
        });
          $('nav p.account').on('click',function(){
            $.ajax({
              type:post,
              url:'./EditProfile.php',
              data: {
                submit:true
              },
              success: function(response){

              }

            })
          })
      });
    </script>
  </body>
  
</html>