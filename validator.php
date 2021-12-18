<?php
function validEmail($mail){
    if(empty(trim($mail))){
        return false;
    }

    if(!filter_var($mail,FILTER_VALIDATE_EMAIL)){
        return false;
    }

    return true;
}
function validPasswordLen($password){
    if(strlen(trim($password))<8){
        return false;
    }
    return true;
}
function valid2ndPassword($password,$password2){

    if($password===$password2){
        return true;
    }
    return false;
}

function validName($name){
    if(strlen(trim($name)) < 6 &&  strlen(trim($name)) > 20){
        return false;
    }

    if(!ctype_alnum($name)){
        return false;
    }
    return true;
}
?>