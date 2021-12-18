<?php
function getDiff($seconds){

    if($seconds<60){
        return 'Moments';
    }else if($seconds<3600){
        return strval((int)($seconds/60)) . ' Minute(s)';
    }else if($seconds<86400){
        return strval((int)($seconds/3600)) . ' Hour(s)';
    }else{
        return strval((int)($seconds/86400)) . ' Day(s)';
    }

}



?>