<?php
require_once 'includes/config_session.inc.php';
require_once 'includes/login_view.inc.php';
?>

<!DOCTYPE html>
<html lang="es"> <!--opening tag -->
<head> <!--head element provides the browser information about the website -->
    <meta charset="UTF-8">
    <!-- the below meta tag is used to scale the website, shows the website in different devices -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in</title>
  
    
    <!-- link to stylesheet, attributes (stylesheet type, path to link) -->
    <link rel="stylesheet" href="css/form.css">
    <style>
        .clock {
            width: 30px;
            height: 30px;
            position: relative;
            border: 2px solid black;
            border-radius: 50%;
            margin-right: 10px;
            display: inline-block;
            background-color: #eee6e6;
        }

        .clock .hand {
            width: 50%;
            height: 2px;
            background: black;
            position: absolute;
            top: 50%;
            left: 50%;
            transform-origin: left;
            animation: rotate 60s linear infinite;
        }

        @keyframes rotate {
            from {
                transform: rotate(0deg);
            }
            to {
                transform: rotate(360deg);
            }
        }

        .img-txt {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .img-txt img {
            margin-bottom: 10px;
        }
    </style>

</head>
<body> <!-- elements inside the body tags are shown in the website -->

    <?php
    if(!isset($_SESSION["user_id"])) { //if not logged in ?>

    <?php include("includes_style/header_session_start.php") ?>
    
    <main class="container">
        <div class="box form-box"> 
            <?php if(isset($_GET['tipo']) && $_GET['tipo'] === 'administrador') {?>
                <div class="img-txt">
                    <img src="icons/account.png" alt="Admin">
                    <header>Inicio de Sesión: Administrador</header>
                </div>
                
            <?php } else if(isset($_GET['tipo']) && $_GET['tipo'] === 'usuario') { ?>
                <div class="img-txt">
                    <img src="icons/user (2).png" alt="User">
                    <header>Inicio de Sesión: Usuario</header>
                </div>
            <?php } 
                $tipo = isset($_GET['tipo']) ? htmlspecialchars($_GET['tipo']) : '';
            ?>
            <form action="includes/login.inc.php?tipo=<?php echo $tipo; ?>" method="post" autocomplete="off" >
                <div class="field input">
                    <label for="usuario" class="field input">Usuario:</label>
                    <input type="text" name="usuario" id="Usuario">
                </div>
                
                <div class="field input">
                    <label for="password" class="field input">Contraseña:</label>
                    <input type="password" name="pwd" id="Password">  
                </div>

                <div class="field submit">
                    <div class="button-submit">
                        <button type="submit" class="btn" name="btnIniciarSesion" value="ok"><img src="icons/log-in.png" alt="Iniciar sesión"><p>Iniciar sesión</p></button>
                    </div>
                </div>


            </form>
            <div class="links">
                ¿No tiene una cuenta? <a href="create_account.php">Registrese aquí</a>
            </div>
            <div class="login-status">
                <?php
                    //call function to check for log in errors, if there are user cannot log in and erros will be outputed
                    if (isset($_SESSION["login_attempts"])) {
                        if ($_SESSION["login_attempts"] <= 3) {
                            check_login_errors();
                        } else {
                            maxAttemptsReached();
                        }
                        wrongAccessPage();
                        unauthorizedUser();
                    }
                ?>
            </div>

        </div>
    </main>    
    <?php include("includes_style/footer.php") ;?>
    <?php } else {
            header("Location: ../home.php?login=success");
    } ?>
</body>

</html> <!-- closing tag -->