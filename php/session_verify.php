<?php
    session_start();

    if (isset($_SESSION['started'])){
        if($_SESSION['started'] == 'true'){
            $msg1 = '<h3>Keep working '.$_SESSION['name'].'</h3>';
            $msg2 = "<p>You are still logged in!</p>";
        } else {
            header("Location: session_close.php");
        }
    } else {  
        header("Location: session_close.php");
    }

?>  