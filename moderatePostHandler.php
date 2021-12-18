<?php
session_start();
require 'databaseHandler.php';
function mailUser($content,$to){
    $subject = 'Restriction on Your Account'; // Give the email a subject 
    $message = '
    
    You have been notified regarding a Restriction made by Mods on Your Account Regarding a Post.
    Cause of Restriction : 
    '.$content.'
    
    '; 
                        
    $headers = 'From:noreply@metaforum.com' . "\r\n";

    mail($to, $subject, $message, $headers);
    
}
if($_POST['submit'] && $_SESSION['role']!='Guest' ){
    $level = '';
    $forum = getForum(intval($_POST["ID"]))[0];
    if($_POST['level'] =='ThreadLock'){
        lockThread(intval($forum["ForumID"]));
        exit();
    }

    switch($_POST['level']){
        case 'Banning':
            $level = 'Ban';
        break;
        case 'Silencing':
            $level = 'Silence';
        break;
        case 'Pardoning':
            $level = 'Pardon';
        break;
    }
    mailUser($_POST['content'],$forum['Email']);
    addList($forum,$level,$_POST['time']);
}


?>