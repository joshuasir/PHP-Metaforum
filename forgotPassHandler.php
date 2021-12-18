<?php
      require 'databaseHandler.php';
      require 'validator.php';
      $flag = array("sent" => true);
      if(isset($_POST['submit']) && validEmail($_POST['Email'])){
        $token = bin2hex(random_bytes(20));
        // var_dump($token);
        resetToken($_POST["Email"],$token);
        $to      = $_POST['Email']; // Send email to our user
        $subject = 'Account Password Reset'; // Give the email a subject 
        $message = '
        
        Your account password has been reset.
        
        Please click this link to create your new password:
        www.localhost/newPass.php?a='.$token.''; 
                            
        $headers = 'From:noreply@metaforum.com' . "\r\n";
        // $res
        if(checkEmail($to)){
          mail($to, $subject, $message, $headers);
        }
        
        
      }else{
        $flag["sent"]=false;
      }
      echo json_encode($flag);
    //   echo "lala";
    ?>