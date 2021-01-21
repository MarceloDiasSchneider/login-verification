<?php 
    session_start();
    echo 'Value of session: '.$_SESSION['started'].'<br>';

    $_SESSION['started'] = 2;
    
    echo 'Value im setted session: '.$_SESSION['started'].'<br>';
?>