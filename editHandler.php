<?php

if($_POST['submit']){
    require 'databaseHandler.php';
session_start();
$_POST['ID'] = intval($_POST['ID']);
if(isset($_POST['type'])){
    if($_POST['type']=='edit' && authorof($_SESSION['id'],$_POST['ID'])){
        editPost($_POST['ID'],$_POST['Content']);
    }else if($_POST['type']=='delete' && authorof($_SESSION['id'],$_POST['ID'])){
        echo deletePost($_POST['ID']);
    }else if($_POST['type']=='heart' && !authorof($_SESSION['id'],$_POST['ID']) && !favourites($_SESSION['id'],$_POST['ID'])){
        // var_dump($_POST['ID']);
        addFavourite($_SESSION['id'],$_POST['ID']);
    }else if($_POST['type']=='heart' && !authorof($_SESSION['id'],$_POST['ID']) && favourites($_SESSION['id'],$_POST['ID'])){
        // var_dump($_POST['ID']);
        unFavourite($_SESSION['id'],$_POST['ID']);
    }else if($_POST['type']=='unlock'){
        unLockThread($_POST['ID']);
    }
}
}

?>
