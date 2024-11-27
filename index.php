<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in</title>  
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
    <?php include("includes_style/header_session_start.php") ?>

    <?php if(!isset($_SESSION["user_id"])) { ?>
    
    <main class="container">
        <div class="box form-box">
            <header>Acceso General</header>
            
            <div class="field submit">
                <a class="btn a-cont" href="login.php?tipo=administrador">
                    <div class="img-txt">
                        <img src="icons/account.png" alt="Admin">
                        <p>Administrador</p>
                    </div>
                </a>
                <a class="btn a-cont" href="login.php?tipo=usuario">
                    <div class="img-txt">
                        <img src="icons/user (2).png" alt="User">
                        <p>Usuario</p>
                    </div>
                </a>
            </div>

            <div class="links">
                ¿No tiene una cuenta? <a href="create_account.php">Registrese aquí</a>
            </div>

        </div>
    </main>    

    <?php } else { ?>
        <main class="container">
        <div class="box form-box">
            <header>Inicio de sesión</header>
            <div class="login-status">
                <!-- send message to user that tells them they are already logged in -->
            </div>
        </div>
    </main>
    <?php } ?>
    <?php include("includes_style/footer.php") ;?>
</body>
</html>
