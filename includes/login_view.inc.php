<?php

declare(strict_types=1);

function output_username(){
    if(isset($_SESSION["user_id"])) { //checks if there exists a username
        echo '<section class="container">
        <div class="box form-box">
        You are logged in as ' . $_SESSION["user_username"] . 
        '</div>
        </section>'; //get username from session
    } else {
        echo "You are not logged in.";
    }
}

function check_login_errors(){
    if (isset($_SESSION["login_errors"])) {
        $errors = $_SESSION["login_errors"];
        echo '<br>';
        echo '<div class="msg-box">';
        foreach($errors as $e) {
            echo '<div class="message-box box-error">';
            echo '<img src="icons/error.png" alt="MsgError">';
            echo '<p class="form-error">' . $e .'</p>';
            echo '</div>';
        }
        echo '</div>';
        unset($_SESSION["login_errors"]); // Unset errors after displaying them
    } else if (isset($_GET['login']) && $_GET['login'] === "success") {
        echo '<div class="msg-box">';
        echo '<div class="message-box box-success">';
        echo '<img src="icons/ok.png" alt="Success">';
        echo '<p class="form-success">¡Login exitoso!</p>';
        echo '</div>';
        echo '</div>';
    }
}

function wrongAccessPage() {
    if (isset($_SESSION["incorrect_access_page"])) {
        echo '<div class="msg-box">';
            echo '<div class="message-box box-error">';
            echo '<img src="icons/error.png" alt="MsgError">';
            echo '<p class="form-error">' . $_SESSION["incorrect_access_page"] .' Será redirigido en 10 segundos.</p>';
            echo '</div>';
        echo '</div>';
        
        // JavaScript for redirection
        echo '<script>
                setTimeout(function() {
                    window.location.href = "index.php";
                }, 10000); // 10 seconds delay (10000 milliseconds)
              </script>';
    }
    unset($_SESSION["incorrect_access_page"]);
}

function unauthorizedUser() {
    if(isset($_SESSION["unauthorized_login"])) {
        echo '<div class="msg-box">';
            echo '<div class="message-box box-error">';
            echo '<img src="icons/banned.png" alt="Unathorized">';
            echo '<p class="form-error">' . $_SESSION["unauthorized_login"] .'</p>';
            echo '</div>';
        echo '</div>';
    }
    unset($_SESSION["unauthorized_login"]);
}

function maxAttemptsReached(){
    if (isset($_SESSION["login_attempts"]) && $_SESSION["login_attempts"] >= 3 ){
        $timeout = 30 * 60; // 30 minutes in seconds
        $remainingTime = $timeout - (time() - $_SESSION["last_failed_attempt_time"]);

        echo '<div class="msg-box">';
        echo '<div class="message-box box-error">';
        echo '<img src="icons/error.png" alt="MsgError">';
        echo '<p class="form-error">'. $_SESSION["login_errors"]["not_authorized"] .'</p>';
        echo '</div>';
        echo '</div>';

        echo '<div class="msg-box">';
        echo '<div class="message-box box-error">';
        // echo '<img src="icons/hourglass.png" alt="MsgError">';
        echo '<div class="clock"><div class="hand"></div></div>';
        echo '<p class="form-error">Por favor espere <span id="countdown"></span> antes de intentarlo otra vez.</p>';
        echo '</div>';
        echo '</div>';

        //JS to show a timer that update every second
        echo '<script>
                var remainingTime = ' . $remainingTime . ';
                var countdownElement = document.getElementById("countdown");

                function updateCountdown() {
                    var minutes = Math.floor(remainingTime / 60);
                    var seconds = remainingTime % 60;

                    countdownElement.textContent = minutes + "m " + seconds + "s ";

                    if (remainingTime > 0) {
                        remainingTime--;
                    } else {
                        clearInterval(countdownInterval);
                        countdownElement.textContent = "You can try logging in again now.";
                    }
                }

                var countdownInterval = setInterval(updateCountdown, 1000);
                updateCountdown(); // Initialize countdown immediately
              </script>';
    }
}


?>
