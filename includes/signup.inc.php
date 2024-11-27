<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") { //usign the post method, grab the data inputed by the user
    $nombre = $_POST["nombre"];
    $apellidoP = $_POST["apellidoP"];
    $apellidoM = $_POST["apellidoM"];
    $usuario = $_POST["usuario"];
    $pwd = $_POST["pwd"];
    $pwdR = $_POST["pwdR"];
    $email = $_POST["email"];

    //limit number of times user can input data, 3 tries maximum

    require_once "dbh.inc.php";
    //model first and then control
    require_once "signup_model.inc.php";
    //require_once "signup_view.inc.php";
    require_once "signup_contr.inc.php";

    /*error handlers, prevention for errors, 
    make sure user submitted all required data
    */
    $errors = []; //array used to save generated errors
    if(isInputEmpty($nombre, $apellidoP, $apellidoM, $usuario, $pwd, $email)){
        $errors["empty_input"] = "Llene todos los campos."; //associative name for the key on the array
    }

    if (usernameValidLength($usuario)) {
        $errors["invalid_username"] = "El usuario no puede tener más de 18 caracteres.";     
    }

    if (findInvalidCharName($nombre) || nameExceedsLength($nombre)) {
        $errors["invalid_name"] = "El nombre es invalido."; 
    }

    if (findInvalidCharLast($apellidoP) || lastNameExceedsLength($apellidoP)) {
        $errors["invalid_lastN"] = "El apellido paterno es invalido.";
    }

    if(findInvalidCharMaiden($apellidoM) || maidenNameExceedsLength($apellidoM)){
        $errors["invalid_maidenN"] = "El apellido materno es invalido.";
    }

    if(isEmailInvalid($email) || emailExceedsLength($email)){
        $errors["invalid_email"] = "El correo electronico es invalido.";
    }            

    if(isUsernameTaken($pdo, $usuario)){
        $errors["username_taken"] = "El usuario ingresado ya esta registrado.";
    }

    if(isEmailRegistered($pdo, $email)){
        $errors["email_used"] = "El correo electronico ingresado ya esta registrado.";
    }

    if(passwordsDontMatch($pwd, $pwdR)){
        $errors["pwd_dont_match"] = "Las contraseñas no coinciden.";
    }

    if(invalidPassword($pwd)) {
        $errors["invalid_pwd"] = "La contraseña es invalida.";
    }
    
    //link to config file b/c it has a session started
    require_once 'config_session.inc.php';

    //check whether or not the errors array is empty
    if($errors){ //if the errors arrays has alements, then it is assigned to the session global variable
        $_SESSION["signup_errors"] = $errors;
        
        //associative array to store data user submitted and send it back to main page
        $signupData = [
            "name" => $nombre,
            "lastName" => $apellidoP,
            "maidenName" => $apellidoM,
            "username" => $usuario,
            "email" => $email
        ];

        //assign array to a session global variable
        $_SESSION["signup_data"] = $signupData;


        header("Location: ../create_account.php");// and then user is left at the main page
        die(); //exit the script if there are errors
    } 
    //before inserting in DB, strip data of any beggining or ending white spaces
    $strippedData = stripSpaces($nombre, $apellidoP, $apellidoM);
    createUser($pdo, $strippedData[0], $strippedData[1], $strippedData[2], $usuario, $pwd, $email);
    unset($_SESSION["signup_data"]); //if there are no more errors and user is added to DB then unset signup_data
    header("Location: ../create_account.php?signup=success");// and then user is left at the main page
    die();
}
else{
    header("Location: ../create_account.php");
    die();
}