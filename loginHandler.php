<?php
require 'validator.php';
require 'databaseHandler.php';
if(isset($_POST["submit"])){
$mail = $_POST["Email"];
$password = $_POST["Password"];

$flag=array(
    "mail"=>false,
    "username"=>false,
    "password"=>false,
);
if(!checkEmail($mail)){
    if(validEmail($mail)){
        $flag["mail"]=true;
    }else if(!checkUser($mail)){
        $flag["username"]=true;
        
    }else{
        if(!checkPassword($mail,$password)){
            $flag["password"]=true;
        }
    }
}else{
    if(!checkPassword($mail,$password)){
        $flag["password"]=true;
    }
}



$user;
if(!$flag["mail"] && !$flag["username"] && !$flag["password"]){
    if($user=LogUser($mail,$password)){
        // setUser($user);
        session_set_cookie_params(0);
        session_start();
        $_SESSION["name"] = $user["Username"];
        $_SESSION["role"] = $user["Role"];
        $_SESSION["act"] = $user["Active"];
        $_SESSION["ModStat"] = $user["ModStat"];
        $_SESSION["id"] = $user["ID"];
        $_SESSION["category"] = "Announcement";
        $_SESSION["asg"] = $user["Assignment"];
        $_SESSION["canReport"] = intval($user['LastReport']) > 0;
    }}
    echo json_encode($flag);
}


?>