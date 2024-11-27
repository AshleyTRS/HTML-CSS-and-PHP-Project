<?php

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $provName = trim($_POST["nombre_proveedor"]);
    //address related data
    $calle = trim($_POST["calle_p"]);
    $no = $_POST["num_p"];
    $colonia = trim($_POST["colonia_p"]);
    $cuidad = trim($_POST["cuidad_p"]);
    $estado = trim($_POST["estado_p"]);
    $cp = $_POST["CP_p"];
    $des = trim($_POST["descripccion"]);
    $telefono = $_POST["telefono"];
    $email = $_POST["email"];

     //DB connection
     require_once "dbh.inc.php";
     //model and control
     require_once "proveedor_model.inc.php";
     require_once "proveedor_contr.inc.php";
 
    //error handlers
    $errors = [];

    if(isInputEmpty($provName, $calle, $no, $colonia, $cuidad, $estado, $cp, $des, $telefono, $email)) { //numeric fields cannot be 0
        $errors["empty_input"] = "Llene todos los campos.";
    }
    
    if (findInvalidCharName($provName)) { //|| nameExceedsLength($provName)
        $errors["invalid_name"] = "El nombre es invalido."; 
    }
    if (findInvalidCharCalle($calle) || nameExceedsLength($calle)) {
        $errors["invalid_calle"] = "La calle es invalida."; 
    }

    //validate street number
    var_dump(invalidBuildingNo($no));
    if(!empty($no) && invalidBuildingNo($no)) {
        $errors["invalid_no"] = "El numero es invalido."; 
    }

    if (findInvalidCharColonia($colonia) || coloniaExceedsLength($colonia)) {
        $errors["invalid_colonia"] = "La colonia es invalido."; 
    }
    if (findInvalidCharCuidad($cuidad) || cuidadExceedsLength($cuidad)) {
        $errors["invalid_cuidad"] = "La cuidad es invalida."; 
    }

    //validate area code
    if(!empty($cp) && invalidAreaCode($cp)) {
        $errors["invalid_cp"] = "El codigo postal es invalido."; 
    }

    if (findInvalidCharEstado($estado) || estadoExceedsLength($estado)) {
        $errors["invalid_estado"] = "El estado es invalido."; 
    }

    //validate telefono
    if(!empty($telefono) && invalidTelephone($telefono)) {
        $errors["invalid_tel"] = "El numero de telefono es invalido."; 
    }

    //var_dump(telephoneInvalidLength($telefono));
    if(!empty($telefono) && telephoneInvalidLength($telefono)) {
        $errors["invalid_tel"] = "El numero de telefono es invalido."; 
    }

    if(isEmailInvalid($email) || emailExceedsLength($email)){
        $errors["invalid_email"] = "El correo electronico es invalido.";
    }
    if(isEmailRegistered($pdo, $email)){
        $errors["email_used"] = "El correo electronico ingresado ya esta registrado.";
    }

    //link to config file b/c it has a session started
    require_once 'config_session.inc.php';
    if($errors){
        $_SESSION["proveedor_errors"] = $errors;

        //associative array to store user data
        $proveedorData = [
            "provNombre" => $provName,
            "calle" => $calle,
            "no" => $no,
            "colonia" => $colonia,
            "cuidad" => $cuidad,
            "estado" => $estado,
            "cp" => $cp,
            "des" => $des,
            "telefono" => $telefono,
            "email" => $email
        ];

        $_SESSION["proveedor_data"] = $proveedorData;

        header("Location: ../proveedores.php");// and then user is left at the main page
        die();
    }
    //call function to perform sql query
    $num = intval($num);
    $cp = intval($cp);
    createProveedor($pdo, $calle, $no, $colonia, $cuidad, $estado, $cp, $des, $telefono, $email, $provName);
    unset($_SESSION["proveedor_data"]);
    header("Location: ../proveedores.php?status=success");// and then user is left at the main page
    die();
} else{
    header("Location: ../proveedores.php");
    die();
}