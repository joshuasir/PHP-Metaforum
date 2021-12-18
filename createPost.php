<?php
if($_POST['submit']){
  session_start();
  require 'databaseHandler.php';
  require 'utils.php';
}
?>
<section> 
  <?php 
  if(isset($_POST['ID'])){
    $forum = getReplyTo(intval($_POST['ID']));
  }
  
  if(isset($_POST['type']) && $_POST['type']!='create'){
    
     
      if(getForum(intval($_POST['ID']))[0]['Locked'] || isPardon(intval($_SESSION['id']),intval($forum['ForumID'])) || checkSilence(intval($_SESSION['id']),$_SESSION['category'])|| isBan(intval($_SESSION['id']),$_SESSION['category'])){
        exit('<p class="text-danger text-center"> You are not allowed to create a post/reply in this thread please contact our mod or admin for further notice</p>');
      }
    }else{
      if( isBan(intval($_SESSION['id']),$_SESSION['category'])||checkSilence(intval($_SESSION['id']),$_SESSION['category'])){
        exit('<p class="text-danger text-center"> You are not allowed to create a post/reply in this thread please contact our mod or admin for further notice</p>');
      }
    }
    ?>
  <p class="w-100 bg-warning status">  <?= ($_POST['type']!='mod') ? ($_POST['type']!='report') ? 'Creating'.((($_POST['type']=='reply' && isset($forum)) ? 'Reply to '.($forum['ReplyTo']=="None" ? "Main Post" : $forum['ReplyTo']) : 'Thread in '.$_SESSION['category']))  : 'Reporting Abuse' : 'Moderating'?>  </p>
  <div class="maincontent d-flex row justify-content-between" >
    <?php $user = getUser($_SESSION['name']) ?>
  <div class="user d-flex flex-column align-items-center w-25 border-right">
    <img src=<?= $user["ProfileImage"] ?> class="w-25" alt="">
    <p><?= $user['Username'] ?></p>
    <p><?= ($user['Online']) ? 'Online':'Offline' ?></p>
    <p><?= $user['Role'] ?></p>
    <p><?= $user['Post'] ?> Post(s)</p>
    <p><?= $user['Username'] ?></p>
    <p><?= getDiff($user['DiffLog']).' ago' ?></p>
    <p><?= $user['ModStat'] ?></p>
  </div>
  <div class="postcreate w-75 pl-2" name=<?='"'.((isset($_POST['ID'])) ? $forum["ForumID"]:'').'"'?>>
  <?= ($_POST['type']=='create') ?'<input type="text" class="titlecreate w-75">':'' ?>
  <!-- <input type="text"> -->
  <p class="text-muted"> Paragraph </p>
    <textarea name="" id="" cols="30" rows="10" class="w-75"></textarea>

  </div>
  </div>
  <div class="iconscreate border-top pl-3 d-flex row justify-content-end w-100" name=<?='"'.$_SESSION['category'].'"'?>>

  

  <div class="toolscreate border-left" >
  <?php if($_POST['type']=='mod'){
    echo '<select name="long" id="long">
    <option value="5 MINUTE">5 Minute</option>
    <option value="30 MINUTE">30 Minute</option>
    <option value="1 HOUR">1 Hour</option>
    <option value="2 HOUR">2 Hour</option>
    <option value="5 HOUR">5 Hour</option>
    <option value="12 HOUR">12 Hour</option>
    <option value="1 DAY">1 Day</option>
    <option value="1 WEEK">1 Week</option>
    <option value="1 MONTH">1 Month</option>
    <option value="1000 YEAR">Indefinite</option>
  </select>
  <select name="reason" id="reason">
  <option value="">-- Constraint --</option>
  <option value="Pardoning">Pardoning</option>
  <option value="Silencing">Silencing</option>
  <option value="Banning">Banning</option>
  <option value="ThreadLock">Thread Lock</option> 
</select>
  ';
  } ?>  
  
      

      
    
    <i type="button" class="fas fa-check checkcreate p-1" name=<?='"'.($user["Username"]).'"'?>></i>
    <i type="button" class="fas fa-times p-1"></i>
  
  </div>
  </div>
</section>