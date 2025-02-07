<?php
    session_start();

    //unsell all session variables
    session_unset();

    //destroy the session
    session_destroy();
    
    //redirect to the home page
    header("Location: login.php");
    exit();
?>