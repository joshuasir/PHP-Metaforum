<?php
session_start();
require 'databaseHandler.php';
if(isset($_POST['submit']) ){
    var_dump($_POST);
    if($_POST['type']=='reply'){
        createReply($_POST,$_SESSION['id']);
    }else{
        createPost($_POST,$_SESSION['id']);
    }
    
}


?>