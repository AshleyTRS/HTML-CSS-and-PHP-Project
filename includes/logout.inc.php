<?php
    require_once 'logout_contr.inc.php';
    require_once 'logout_view.inc.php';
    if(!confirmSessionEnd()){ //sends a message to the user asking then to confirm their decision to log out

      session_start(); //start session
      session_unset(); //unset session
      session_destroy(); //destroy session

      header("Location: ../index.php"); //return user to login page
      die(); //stops script
    } else {
      header("Location: ../create_account.php");
    }

