<?php 
      session_start();
      
      $flag=0;
      require 'databaseHandler.php';
      require 'utils.php';
      clearBanList();
?>
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
    <main class="d-flex flex-column align-items-center ">
   
      
        <div class="d-flex flex-row justify-content-center mt-5 pt-5 w-50"><p >Forum Groups</p>
        <hr class="w-50 text-black">
        
        <?php if (isset($_SESSION['act']) && $_SESSION['act']==1): ?>
        <button class="btn btn-outline-secondary text-center d-flex w-5 justify-content-center create News"> Create Thread </button>
        <?php endif; ?>
      </div>
      <section id="forum-group" class="d-flex flex-row justify-content-between w-50">
      <section class="d-flex flex-column align-items-flex-start w-25 .col-md-12">
        
        <div   class="btn-group dropright w-25">
          <p type="button" id="General" class="text-muted dropdown-toggle "data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">GENERAL</p>
          <div class="dropdown-menu p-1">
            <p id="Announcement" type="button" class="category General">ANNOUNCEMENT</p>
          </div>
          </div>

          <div  class="btn-group dropright w-25">
          <p type="button" id="World" class="text-muted dropdown-toggle "data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">WORLD</p>
          <div class="dropdown-menu p-1">
            <p id="News" type="button" class="category World">NEWS</p>
            <p id="Covid" type="button" class="category World">COVID19</p>
            
          </div>
          </div>

          <div  class="btn-group dropright w-25">
          <p  type="button" id="Art" class="text-muted dropdown-toggle "data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">ART</p>
          <div class="dropdown-menu p-1">
            <p id="Paintings" type="button" class="category Art">PAINTINGS</p>
            <p id="Animation" type="button" class="category Art">ANIMATION</p>
            <p id="Anime" type="button" class="category Art">CHINESE CARTOON</p>
            <p id="NFT" type="button" class="category Art">NFT</p>
          </div>
          </div>

          <div  class="btn-group dropright w-25">
          <p type="button" id="Entertainment" class="text-muted dropdown-toggle "data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">ENTERTAINMENT</p>
          <div class="dropdown-menu p-1">
          <p id="Movie" type="button" class="category Entertainment">MOVIES</p>
          </div>
          </div>
          <div  class="btn-group dropright w-25">
          <p  type="button" id="VideoGames" class="text-muted dropdown-toggle "data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">VIDEO GAMES</p>
          <div class="dropdown-menu p-1">
            <p id="FPS" type="button" class="category VideoGames">FIRST-PERSON SHOOTER</p>
            <p id="RTS" type="button" class="category VideoGames">REAL-TIME STRATEGY</p>
            <p id="RPG" type="button" class="category VideoGames">RPG</p>
            <p id="MOBA" type="button" class="category VideoGames">MOBA</p>
            <p id="SoulsBorne" type="button" class="category VideoGames">SOULSBORNE</p>
            <p id="Horror" type="button" class="category VideoGames">HORROR</p>
            <p id="Survival" type="button" class="category VideoGames">SURVIVAL</p>
            <p id="Story" type="button" class="category VideoGames">STORY</p>
          </div>
          </div>
          <!-- <p type="button"class="text-muted dropright dropdown-toggle w-25">POLITICS</p>
          <p type="button"class="text-muted dropright dropdown-toggle w-25">OFF-TOPIC</p> -->
        </div>
        </section>
        <section class="d-flex flex-column align-items-center w-100">
        <table >
        <tr class="w-100 content" >
            <td> <p class="text-muted w-100"> Welcome
            <?= (isset($_SESSION['role'])) ? ', '.$_SESSION["name"].'!</p>' : '</p>'?>  
              </td>
              <!-- <a id=2 class="text-start" style="margin-left:-2em" href="index.php?a="> a </a>  -->
        </tr>
        </table>
        </section>
      </section>
      <section id="thread" class="w-100 ">
          
      </section>
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
        // $('html,body').on('scroll',function(){
        //   alert($(window).height());
        // })
        <?php
          if(isset($_GET['a'])&&isset($_GET['p'])){
              
              echo '
              let group = $("#'.$_GET['p'].'").attr("class").split(" ")[1];
              $("#".concat(group)).on("click",function(){
                
                setTimeout(
                  function() 
                  {
                    $("p#'.$_GET['p'].'")[0].click();
                  }, 100);
              });
              
              $("p#'.$_GET['p'].'").on("click",function(){
                setTimeout(
                  function() 
                  {
                    $("a#'.$_GET['a'].'")[0].click();
                  }, 400);
              });

              
              setTimeout(
                function() 
                {
                  $("#".concat(group))[0].click();
                }, 100);
              
              
              
              // 
            ';
          }
          
        ?>
        
        $(".create").on('click',function(e){
          // $(this).off('click');
          e.preventDefault();
          $.ajax({
            type: "post",
            url:"./createPost.php",
            data:{
              type:'create',
              submit:true
            },
            success: function(response){
              $('#thread').empty();
              $(response).appendTo('#thread');
              $('.fa-check').on('click',function(){
                let content = $('textarea').val().trim();
                let cat = $('.iconscreate').attr('name');
                let title = $('.titlecreate').val().trim();
         
                $.ajax({
                  type : "post",
                  url: "./createPostHandler.php",
                  data: {
                    content:content,
                    cat:cat,
                    title:title,
                    type:'create',
                    height:$('.titlecreate').offset().top,
                    submit:true
                  },
                  success: function(response){
                    $('p#'.concat(cat))[0].click();
                    $('#thread').empty();
                  }
                })
              });
              $('.fa-times').on('click',function(){
                $('#thread').empty();
                $('p#'.concat(cat))[0].click();
                
              })
            }     
        })
      });
        
        $(".category").on('click',function(e){
          e.preventDefault();
          // $(this).off('click');
          let cat = $(this).attr('id');
          let group = $('#'.concat(cat)).attr('class').split(' ')[1];
          $('.create').addClass(cat);
          // alert(cat);
          $.ajax({
                type: "post",
                url: "./ThreadHandler.php",
                // dataType:"json",
                data: { Cat:cat,
                        submit:true
                    },
                success: function (response) {
                  $('#thread').empty();
                  $('table').empty();
                  $(response).appendTo('table');
                  $("table a").on('click',function(e){
                      e.preventDefault();
                      // $(this).off('click');
                      e.stopPropagation();
                      let forumid = $(this).attr('id');
                      // alert(id);
                      $.ajax({
                            type: "post",
                            url: "./forumHandler.php",
                            // dataType:"json",
                            data: { ID:forumid,
                                    submit:true
                                },
                            success: function (response) {
                              // $('table').empty();
                              $('#thread').empty();
                              $(response).appendTo('#thread');
                  
                              <?php
                              if(isset($_GET['p']) && isset($_GET['a']) && !isset($_GET['stop'])){

                                  echo '$("html, body").animate({scrollTop: $(".sec'.$_GET['loc'].'").offset().top-100});';
                                  $_GET['stop']='set';
                                  
                              }
                              ?>
                              $('.prof').on('click',function(e){
                                let user = $('p.prof').text().trim();
                                window.location.replace('userProfile.php?a='.concat(user));
                              });
                              $('.fa-edit').on('click',function(){
                                let id = $(this).attr('value');
                                let toedit = 'p[value='.concat(id).concat(']');
                                let content = $(toedit).text().trim();
                                // alert(content);
                                $(toedit).replaceWith('<textarea name="" id="" cols="30" class="w-75" rows="10">'.concat(content).concat('</textarea>'));
                                $('.fa-edit').replaceWith('<i type="button" class="fas fa-check"></i>');
                                $('.fa-trash-alt').replaceWith('<i type="button" class="fas fa-times"></i>');
                                $('.fa-reply').css('display','none');
                                $('.fa-info-circle').css('display','none');
                                $('.fa-check').on('click',function(){
                                  let newcontent = $('textarea').val().trim();
                                  
                                  $.ajax({
                                    type:"post",
                                    url:"./editHandler.php",
                                    data: {
                                      ID:id,
                                      Content:newcontent,
                                      type:'edit',
                                      submit:true
                                    },
                                    success: function(response){
                                      // alert(newcontent);
                                      $('textarea').replaceWith('<p value="'.concat(id).concat('">').concat(newcontent).concat('</p>'));
                                      $('.fa-check').replaceWith('<i type="button" class="fas fa-edit p-1" value="'.concat(id).concat('"></i>'));
                                      $('.fa-times').replaceWith('<i type="button" class="fas fa-trash-alt p-1" value="'.concat(id).concat('"></i>'));
                                      $('.fa-reply').css('display','initial');
                                      $('.fa-info-circle').css('display','initial');
                                      $('a#'.concat(forumid))[0].click();
                                    }
                                  })
                                })

                                $('.fa-times').on('click',function(){
 
                                  $('textarea').replaceWith('<p value="'.concat(id).concat('">').concat(content).concat('</p>'));
                                  $('.fa-check').replaceWith('<i type="button" class="fas fa-edit p-1" value="'.concat(id).concat('"></i>'));
                                  $('.fa-times').replaceWith('<i type="button" class="fas fa-trash-alt p-1" value="'.concat(id).concat('"></i>'));
                                  $('.fa-reply').css('display','initial');
                                  $('a#'.concat(forumid))[0].click();
                                  
                                })
                                // $(toedit).text(content);
                              });
                              $('.enable').on('click',function(){
                                let id = $(this).attr('value');
                                // alert(id);
                                  $.ajax({
                                    type:"post",
                                    url:"./editHandler.php",
                                    data: {
                                      ID:id,
                                      type:'unlock',
                                      submit:true
                                    },
                                    success: function(response){
                                      $('a#'.concat(forumid))[0].click();
                                    }
                                  });
                              });
                              $('.fa-bolt').on('click',function(){
                                $('.fa-bolt').css('display','none');
                                $('.fa-reply').css('display','none');

                                let id = $(this).attr('value');
                                
                                $.ajax({
                                  type: "post",
                                  url: "./createPost.php",
                                  // dataType:"json",
                                  data: { ID:id,
                                          type:'mod',
                                          submit:true
                                      },
                                  success: function (response) {
                                    $('.sec'.concat(id)).after(response);
                                    
                                    $("html, body").animate({scrollTop:$('.sec'.concat(id)).offset().top+100});
                                    $( "#reason" ).change(function() {
                                        $( '#reason option[value="ThreadLock"]:selected' ).each(function() {
                                          $('#long').css('display','none');
                                        });
                                        $( '#reason option:not(option[value="ThreadLock"]):selected' ).each(function() {
                                          $('#long').css('display','initial');
                                        });
                                      })
                                      .trigger( "change" );
 
                                    $('.fa-times').on('click',function(){
                                      $('a#'.concat(forumid))[0].click();
                                      
                                    });
                                    $('.fa-check').on('click',function(){
                                      let content = $('textarea').val().trim();
                                      let time = $('#long').val();
                                      let level = $('#reason').val();
                                      // alert(forumID);
                                      $.ajax({
                                        type : "post",
                                        url: "./moderatePostHandler.php",
                                        data: {
                                          ID :id,
                                          time:time,
                                          level:level,
                                          content:content,
                                          submit:true
                                        },
                                        success: function(response){
                                          $('a#'.concat(forumid))[0].click();
                                        }
                                      })
                                    });
                                  }
                            })
                              })
                              $('.fa-info-circle').on('click',function(){
                                
                              $('.fa-info-circle').css('display','none');
                              $('.fa-reply').css('display','none');
                              // alert('act');
                              let id = $(this).attr('value');
                              $.ajax({
                                  type: "post",
                                  url: "./createPost.php",
                                  // dataType:"json",
                                  data: { ID:id,
                                          type:'report',
                                          submit:true
                                      },
                                  success: function (response) {
                                    $('.sec'.concat(id)).after(response);
                                    
                                    $("html, body").animate({scrollTop:$('.sec'.concat(id)).offset().top+100});
                                    $('.fa-times').on('click',function(){
                                      $('a#'.concat(forumid))[0].click();
                                      
                                    });
                                    $('.fa-check').on('click',function(){
                                      let content = $('textarea').val().trim();
                                     
                                      // alert(forumID);
                                      $.ajax({
                                        type : "post",
                                        url: "./reportPostHandler.php",
                                        data: {
                                          ID :id,
                                          content:content,
                                          submit:true
                                        },
                                        success: function(response){
                                          $('a#'.concat(forumid))[0].click();
                                        }
                                      })
                                    });
                                  }
                            })
                          });
                            $('.fa-trash-alt').on('click',function(){
                                let id = $(this).attr('value');
                                $.ajax({
                                  type: "post",
                                  url: "./editHandler.php",
                                  // dataType:"json",
                                  data: { ID:id,
                                          type:'delete',
                                          submit:true
                                      },
                                  success: function (response) {
                                    if(response){
                                      $('#thread').empty();
                                      $('p#'.concat(cat))[0].click();
                                    }else{
                                      $('a#'.concat(forumid))[0].click();
                                    }
                                    
                                  }
                              });
                            });
                            
                            $('.fa-reply').on('click',function(){
                                let id = $(this).attr('value');
                                $('.fa-info-circle').css('display','none');
                                $('.fa-reply').css('display','none');
                                $('.fa-bolt').css('display','none');
                                $.ajax({
                                  type: "post",
                                  url: "./createPost.php",
                                  // dataType:"json",
                                  data: { ID:id,
                                          type:'reply',
                                          submit:true
                                      },
                                  success: function (response) {
                                    $('#thread').append(response);
                                    $("html, body").animate({ scrollTop: $(document).height()-$(window).height() });
          
                                    $('.fa-times').on('click',function(){
                                      $('a#'.concat(forumid))[0].click();
                                    });

                                    $('.fa-check').on('click',function(){
                                      let content = $('textarea').val().trim();
                                      let forumID = $('.postcreate').attr('name');
                                      let replyto = $('.checkcreate').attr('name');
                                      let cat = $('.iconscreate').attr('name');
                                      let group
                                      // alert(forumID);
                                      $.ajax({
                                        type : "post",
                                        url: "./createPostHandler.php",
                                        data: {
                                          content:content,
                                          forumid:forumID,
                                          replyto:replyto,
                                          cat:cat,
                                          height:$('.postcreate').offset().top,
                                          type:'reply',
                                          submit:true
                                        },
                                        success: function(response){
                                          $('a#'.concat(forumid))[0].click();
                                        }
                                      })
                                    });
                                    // $('.fa-times').on('click',function(){
                                    //   $('a#'.concat(forumid))[0].click();
                                    // })
                                    // 
                                    // $('.okay').on('click',function(){
                                    //     let id = $(this).attr('id');
                                    //     $.ajax({
                                    //       type: "post",
                                    //       url: "./createPostHandler.php",
                                    //       // dataType:"json",
                                    //       data: { ID:id,
                                    //               type:'reply',
                                    //               submit:true
                                    //           },
                                    //       success: function (response) {
                                    //         $(response).appendTo('table');
                                    //       }
                                    //   });
                                    // });
                                  }
                              });
                            });

                            $('.fa-heart').on('click',function(){
                                let id = $(this).attr('value');
                                // alert(id);
                                $.ajax({
                                  type: "post",
                                  url: "./editHandler.php",
                                  // dataType:"json",
                                  data: { ID:id,
                                          type:'heart',
                                          submit:true
                                      },
                                  success: function (response) {
                                    $('a#'.concat(forumid))[0].click();
                                    $('.fa-heart').css('color','red');
                                    // style="color:red"
                                  }
                              });
                            });
                          }
                      });
                    });
                }
          });
        });
        // function submitForm(){
          
        // }
        
      });
    </script>
  </body>
</html>