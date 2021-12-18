<?php 
  require 'databaseHandler.php';
  require 'utils.php';
  session_start();
  clearBanList();
  $forum = getForum(intval($_POST["ID"]))[0];
  // var_dump($forum);
  if(!$forum||!isset($_SESSION['id']) ){
    exit('<div class="mt-5 mb-5 w-100 d-flex justify-content-center"><a href="login.php" type="submit" class="btn btn-primary mb-2 w-25 text-center">Log in to Join our Discussion</a></div>');
  }else if(isBan(intval($_SESSION['id']),$forum['Category'])){
    exit('<p class="text-danger text-center"> You are not allowed to access this thread please contact our mod or admin for further notice</p>');
  }else{
    incrementView(intval($_POST["ID"]));
  }
?>
<div class="header pl-4 pt-5">
<p>Thread in : <?= $forum['Category'] ?> <hr></p>

<h1>
  <?= $forum['Title'] ?>
</h1>
<p class="text-muted" >Posted on <?= $forum['Created'] ?> by <?= $forum['Username'] ?></p>
</div>
<section class=<?='"sec'.$forum["ID"].'"'?>> 
  <p class="w-100 bg-info status"> Main Post </p>
  <div class="maincontent d-flex row justify-content-between">
    <?php refreshUserStatus(intval($forum['UserID'])); $user = getUser($forum['Username']);  ?>
  <div class="user d-flex flex-column align-items-center w-25 border-right">
    <img src=<?= $user["ProfileImage"] ?> class="w-25 prof" alt="">
    <p class="prof"><?= $user['Username'] ?></p>
    <p><?= ($user['Online']) ? 'Online':'Offline' ?></p>
    <p><?= $user['Role'] ?></p>
    <p><?= $user['Post'] ?> Post(s)</p>
    <p><?= $user['Username'] ?></p>
    <p><?= getDiff($user['DiffLog']).' ago' ?></p>
    <p><?= $user['ModStat'] ?></p>
  </div>
  <div class="post w-75 pl-2">
  <p value=<?= $forum["ID"] ?>>
    <?= 
      $forum["Content"];
    ?>
  </p>
  </div>
  </div>
  <div class="icons border-top pl-3 d-flex row justify-content-between w-100">

  <p>
  <?php 
  
    if(isset($_SESSION['id']) && $_SESSION['id'] != $forum['UserID'] && !$forum['Locked']){
    echo '<i type="button" class="far fa-heart p-1" value='.$forum["ID"].' style="color:'.((favourites($_SESSION['id'],$forum['ID'])) ? 'red' : 'muted').'" ></i>';
   
  }  
  ?>
  
  <?= $forum["Favourite"] ?> user(s) favorited this post</p>
  <div class="tools border-left">
  
  <?php
    if(isset($_SESSION['id'])&& !$forum['Locked'] && $_SESSION['act'] && $_SESSION['canReport'] && ($_SESSION['role']!='Mod'||($_SESSION['role']=='Mod' && getAsg(intval($_SESSION['id']))!=$forum['Category']))){
      echo '<i type="button" class="fas fa-info-circle p-1" value='.$forum["ID"].'></i>';
    }
    if(isset($_SESSION['id'])&& !$forum['Locked'] && ($_SESSION['role']=='Admin' ||($_SESSION['role']=='Mod' && getAsg(intval($_SESSION['id'])) == $forum['Category'] && $user['Assignment']!=$forum['Category']))){
      echo '<i type="button" id="reply" class="fas fa-bolt p-1" value='.$forum["ID"].' ></i>';
    }
    if(isset($_SESSION['id'])&& !$forum['Locked'] && !isSilenced($_SESSION['name']) && $forum['Locked']==0){
      echo '<i type="button" id="reply" class="fas fa-reply p-1" value='.$forum["ID"].' ></i>';
    }

    if(isset($_SESSION['id'])&& !$forum['Locked'] && $_SESSION['id'] == $forum['UserID'] /* && $forum['Editable']*/){
    echo '<i type="button" class="far fa-edit p-1" value='.$forum["ID"].' ></i>';
    echo '<i type="button" class="fas fa-trash-alt p-1" value='.$forum["ID"].'></i>';
    
  }
  ?>
  </div>
  </div>
  
</section>
<?php $replies = getReply(intval($_POST["ID"])); 
if($replies):
  // var_dump($replies);
?>
<?php foreach ($replies as $reply) : refreshUserStatus(intval($reply['UserID'])); ?>
  <section class=<?='"sec'.$reply["ID"].'"'?>> 
  <p class="w-100 bg-info status"> Reply to <?= $reply['ReplyTo'] ?> </p>
  <div class="replymain d-flex row justify-content-between">
  <div class="user d-flex flex-column align-items-center w-25 border-right">
    <img src=<?= $reply["ProfileImage"] ?> class="w-25 prof" alt="">
    <p class="prof"><?= $reply['Username'] ?></p>
    <p><?= ($reply['Online']) ? 'Online':'Offline' ?></p>
    <p><?= $reply['Role'] ?></p>
    <p><?= $reply['Post'] ?> Post(s)</p>
    <p><?= $reply['Username'] ?></p>
    <p><?= getDiff($reply['DiffLog']).' ago' ?></p>
    <p><?= $reply['ModStat'] ?></p>
  </div>
  <div class="post w-75 pl-2">
  <p value=<?= $reply["ID"] ?>>
    <?= 
      $reply["Content"];
    ?>
  </p>
  </div>
  </div>
  <div class="icons border-top pl-3 d-flex row justify-content-between w-100">

  <p>
  <?php 
  
    if(isset($_SESSION['id']) && $_SESSION['id'] != $reply['UserID']){
    echo '<i type="button" class="far fa-heart p-1" value='.$reply["ID"].' style="color:'.((favourites($_SESSION['id'],$reply['ID'])) ? 'red' : 'muted').'" ></i>';
   
  }  
  ?>
  
  <?= $reply["Favourite"] ?> user(s) favorited this post</p>
  <div class="tools border-left">
  
  <?php 
    if(isset($_SESSION['id'])&& !$forum['Locked'] && $_SESSION['canReport'] && $_SESSION['act'] && ($_SESSION['role']!='Mod'||($_SESSION['role']=='Mod' && getAsg(intval($_SESSION['id']))!=$forum['Category']))){
      echo '<i type="button" class="fas fa-info-circle p-1" value='.$reply["ID"].'></i>';
    }
    // var_dump($_SESSION['role']);
    if(isset($_SESSION['id'])&& !$forum['Locked'] && ($_SESSION['role']=='Admin' ||($_SESSION['role']=='Mod' && getAsg(intval($_SESSION['id'])) == $reply['Category'] && $reply['Assignment']!=$reply['Category']))){
      echo '<i type="button" id="reply" class="fas fa-bolt p-1" value='.$reply["ID"].' ></i>';
    }


    if(isset($_SESSION['id'])&& !$forum['Locked'] && !isSilenced($_SESSION['name']) && $reply['Locked']==0){
      echo '<i type="button" id="reply" class="fas fa-reply p-1" value='.$reply["ID"].' ></i>';
    }

    if(isset($_SESSION['id'])&& !$forum['Locked'] && $_SESSION['id'] == $reply['UserID'] && $reply['Editable']){
    echo '<i type="button" class="far fa-edit p-1" value='.$reply["ID"].' ></i>
    <i type="button" class="fas fa-trash-alt p-1" value='.$reply["ID"].' ></i>';
    
  }
  ?>
  </div>
  </div>
  </section>
    
<?php endforeach ?>
<?php 
      if($forum['Locked']){
        if($_SESSION['role']=='Guest'){
          echo '<p class="text-white bg-danger w-100 text-center"> This thread has been locked for indefinite amount of time.</p>';
        }else{
          echo '<div class="mt-5 mb-5 w-100 d-flex justify-content-center"><p type="submit" class="btn btn-primary mb-2 w-25 text-center enable" value='.$forum["ID"].'>Unlock Thread</p></div>';
        }
      }
    ?>

<?php endif;?>