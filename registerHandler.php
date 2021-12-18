<?php 
    require 'validator.php';
    require 'databaseHandler.php';
    if(isset($_POST["submit"])){
    $mail = $_POST["Email"];
    $username = $_POST["Username"];
    $password = $_POST["Password"];
    $password2 = $_POST["ConfirmPassword"];

    $flag=array(
        "mail"=>false,
        "username"=>false,
        "password"=>false,
        "password2"=>false
    );
    if(!validEmail($mail) || checkEmail($mail)){
        $flag["mail"]=true;
    }if(!validName($username)||checkUser($username)){
        $flag["username"]=true;
    }if(!validPasswordLen($password)){
        $flag["password"]=true;
    }if(!valid2ndPassword($password,$password2)){
        $flag["password2"]=true;
    }

    if(!$flag["mail"] && !$flag["username"] && !$flag["password"] && !$flag["password2"]){
        $token = bin2hex(random_bytes(20));
        insertUser($username,$mail,$password2 = password_hash($password, PASSWORD_BCRYPT),$token);
        $id = getUser($username)["ID"];
        $to      = $mail; // Send email to our user
        $subject = 'Account Verification'; // Give the email a subject 
        $message = '
        
        Your account has been created.
        Welcome to Metaforum community we are looking foward seeing you in our forums.
        
        Please click this link to activate your account:
        www.localhost/verify.php?a='.$token.''; 
                            
        $headers = 'From:noreply@metaforum.com' . "\r\n";
        mail($to, $subject, $message, $headers);
        
    }
    // unset($_POST["submit"]);
    echo json_encode($flag);
    // return response()->json($msg, 200, $headers);
    // return response()->json($data, 200, $headers);
}
?>