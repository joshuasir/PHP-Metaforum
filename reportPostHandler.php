<?php 
    require 'databaseHandler.php';
    session_start();
    function reportUser($level,$post){
        $person=[];
        $user = $_SESSION['name'];
        if($level=="Mod"){
            $person = getAdmin();
        }else{
            $person = getMod($post['Category']);
        }
        foreach ($person as $guy){
        $to      = $guy; // Send email to our user
        $subject = 'Report Abuse'; // Give the email a subject 
        $message = '
        
        You have been notified regarding an abuse report made by a User.
        
        The report is addressed to post '.$post['Content'].' by '.$post['Username'].',
        On Category '.$post['Category'].' made by '.$user.'
        
        '; 
                            
        $headers = 'From:noreply@metaforum.com' . "\r\n";

        mail($to, $subject, $message, $headers);
        }
    }


    if(isset($_POST['submit'])){
        $post = getForum(intval($_POST['ID']));
        if($post["Role"]=="Guest"){
            reportUser("Guest",$post);
        }else if($post["Role"]=="Mod"){
            reportUser("Mod",$post);
        }
    }
    
    
    
?>