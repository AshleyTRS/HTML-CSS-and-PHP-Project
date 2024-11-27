<?php

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET['tipo'])) {
    // Check if the failed login attempts counter is set
    if (!isset($_SESSION["login_attempts"])) {
        $_SESSION["login_attempts"] = 0; // Initialize the counter
    }


    // Check if the maximum login attempts (3) is reached

    if ($_SESSION["login_attempts"] >= 3) {
        // Check if enough time has passed since the last failed attempt
        $timeout = 30 * 60; // 30 minutes in seconds
        if (isset($_SESSION["last_failed_attempt_time"]) && time() - $_SESSION["last_failed_attempt_time"] < $timeout) {
            // Redirect the user to a page indicating that they've exceeded login attempts and must wait
            header("Location: ../login.php?tipo=".$_GET['tipo']);
            die();
        }
    }
    
    
    $usuario = $_POST["usuario"];
    $pwd = $_POST["pwd"];

    require_once 'dbh.inc.php';
    require_once 'login_model.inc.php';
    require_once 'login_contr.inc.php';

    //ERROR HANDLERS
    $errors = []; //array used to save generated errors

    if(isInputEmpty($usuario, $pwd)){
        $errors["empty_input"] = "Llene todos los campos!"; //associative name for the key on the array
    }

    $result = getUsername($pdo, $usuario); //result stores a false or an associative array, keys = column's name and value = data

    if(isUsernameWrong($result) && !isInputEmpty($usuario, $pwd)) {
        $errors["wrong_data"] = "Los datos ingresados son incorrectos!";
    }

    if(!isUsernameWrong($result) && isPasswordWrong($pwd, $result["password_usuario"]) && !isInputEmpty($usuario, $pwd)) {
        $errors["wrong_data"] = "Los datos ingresados son incorrectos!";
    }

    var_dump($_SESSION["login_attempts"]);
    //link to config file b/c it has a session started
    require_once 'config_session.inc.php';

    var_dump($_SESSION["login_attempts"]);
    //check whether or not the errors array is empty
    if($errors && $_SESSION["login_attempts"] <= 3 && !isset($_SESSION['admin_dashboard'])){ //if the errors arrays has elements, then it is assigned to the session global variable
        
        // Increment the login attempts counter
        $_SESSION["login_attempts"]++;
        $_SESSION["last_failed_attempt_time"] = time();

        if ($_SESSION["login_attempts"] > 3) {
            $errors = [];
            $errors['not_authorized'] = "Usted alcanzó su número máximo de intentos para iniciar sesión. Vuelva a intentarlo más tarde.";
        } else {
            $errors["login_error"] = "Usuario o contraseña invalido. Intento " . $_SESSION["login_attempts"] . " de 3.";
        }

        $_SESSION["login_errors"] = $errors;
        
        header("Location: ../login.php?tipo=".$_GET['tipo']);
        die();

    } else if((!$errors && $_SESSION["login_attempts"] <= 3)) { ////if there are no errors then script continues
            var_dump($_SESSION["login_attempts"]);
            //first check is the user is even allowed to use the system
            if($result['permission_granted'] == 0) {
                $error = "No está autorizado a acceder al sistema. Póngase en contacto con su administrador.";
                $_SESSION["unauthorized_login"] = $error;
                header("Location: ../login.php?tipo=".$_GET['tipo']);
                die();
            }

            //check what kind of user they are
            if($result['is_admin'] == 1 && $_GET['tipo'] === 'administrador'){ //if they are an admin
                //set session variable
                $_SESSION['admin_dashboard'] = true;
            } else if($result['is_admin'] == 0 && $_GET['tipo'] === 'usuario') { //otherwise if they are a general user
                $_SESSION['admin_dashboard'] = false;
            } else if(($result['is_admin'] == 0 && $_GET['tipo'] === 'administrador') || ($result['is_admin'] == 1 && $_GET['tipo'] === 'usuario')){

                //wrong login page
                $errors = "Está en el portal de inicio de sesión equivocado. No es " . $_GET['tipo'] . ".";
                $_SESSION["incorrect_access_page"] = $errors;

                header("Location: ../login.php?tipo=".$_GET['tipo']);
                die();

            }


            //reset log in attempts to 0
            $_SESSION["login_attempts"] = 0;
        
            //security layer
            $newSessionId = session_create_id(); //creates a new ID without regenerating the session
            $sessionId = $newSessionId . "_" . $result["id_usuario"]; //concatenates the new session ID with the user's ID, creates unique session ID
            session_id($sessionId);
    
            $_SESSION["user_id"] = $result["id_usuario"];
            $_SESSION["user_username"] = htmlspecialchars($result["login_usuario"]);//convert data from DB to html to prevent XSS
    
            //reset timer to regenerate id every 30 mins
            $_SESSION["last_regeneration"] = time(); //sets a timestamp indicating when the session ID was last regenerated. This is useful for timing when to regenerate the session ID again to maintain security

            if($_SESSION['admin_dashboard']){ //admin is sent to admin dashboard
                header("Location: ../home.php?login=success");
            } else { //general user is sent to user dashboard
                header("Location: ../home.php?login=success");// and then user is left at the main page
            }
            
            die();
    } else {
        header("Location: ../login.php?tipo=".$_GET['tipo']);
        die();
    }
    
} else {
    header("Location: ../login.php?tipo=".$_GET['tipo']);
    die();
}