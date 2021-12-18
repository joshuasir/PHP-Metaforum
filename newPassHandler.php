<?php
       require 'databaseHandler.php';
       require 'validator.php';
       
      if(isset($_POST['submit'])){
        $flag = array("password"=>false,"password2"=>false);
        $password = $_POST['Password'];
        $password2 = $_POST['Password2'];
      
        if(!validPasswordLen($password)){
            $flag["password"]=true;
        }if(!valid2ndPassword($password,$password2)){
            $flag["password2"]=true;
        }
        if(!$flag["password"] && !$flag["password2"]){
            updatePassword($_POST["Token"],password_hash($password, PASSWORD_BCRYPT));
            // var_dump($_POST);
        }
        
        echo json_encode($flag);
    }
    
    ?>