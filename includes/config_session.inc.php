<?php

ini_set('session.use_only_cookies', 1); //session ids are passed to cookies and not URL parameters
ini_set('session.use_strict_mode', 1); //refuse to accept uninitialized session IDs

session_set_cookie_params([
    'lifetime' => 3600, //cookie expires after 1 hour minutes 
    'domain' => 'localhost', //cookie is restricted to localhost domain
    'path' => '/', //Makes the cookie available across the entire domain
    'secure' => true, //cookie is only sent over HTTPS connections
    'httponly' => true // cookie cannot be accessed with JS
]);

session_start();

if (isset($_SESSION["user_id"])) { //user is logged in to the website
    if (!isset($_SESSION["last_regeneration"])) { //regenerates a new session id
        regenerate_session_id_loggedin(); //for logged in users
    } else { //updates session id every 30 minutes
        $interval = 60*60; //*30
        if (time() - $_SESSION["last_regeneration"] >= $interval) {
            regenerate_session_id_loggedin();
        }
    }
} else { //user is not logged in to the website
    if (!isset($_SESSION["last_regeneration"])) {
        regenerate_session_id();
    } else { //updates session id every 30 minutes
        $interval = 60*30; //*30
        if (time() - $_SESSION["last_regeneration"] >= $interval) {
            regenerate_session_id();
            //$_SESSION["last_regeneration"] = time();       
        }
    }
}


function regenerate_session_id(){
    session_regenerate_id(true);
    $_SESSION["last_regeneration"] = time();
}

function regenerate_session_id_loggedin() {
    session_regenerate_id(true);

    $userId = $_SESSION["user_id"]; //grabbing session id, if logged in
    $newSessionId = session_create_id(); //creates a new id instead of regenerating an existing id
    $sessionId = $newSessionId . "_" . $userId;
    session_id($sessionId); //concatenates user id to new session id to create a unique session id
    $_SESSION["last_regeneration"] = time();
}