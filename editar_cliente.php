<?php
require_once 'includes/config_session.inc.php';
require_once "includes/dbh.inc.php";
require_once "includes/cliente_model.inc.php";
require_once 'includes/cliente_view.inc.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Registro de Cliente</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
    <?php if(isset($_SESSION["user_id"])) { 
        if(isset($_SESSION['admin_dashboard']) && $_SESSION['admin_dashboard'] === true) { //check type of user and display the corresponfing dashboard
            include("includes_style/header_admin.php"); //for admin
        } else if(isset($_SESSION['admin_dashboard']) && $_SESSION['admin_dashboard'] === false){
            include("includes_style/header_home.php"); //for general user
        } ?>  
    <!-- addd contents of body in here after linking the file to the home page -->
    <div class="container">
        <div class="head-title">
            <head>Manejo de Registro de Clientes</head>
        </div>
        <div class="container-form-table-searchBar">
            <div class="section">
                <div class="container-form">
                    <div class="box form-box">
                        <header>Editar Cliente</header>
                        <form id="clientesForm" action="includes/editar_clientes.inc.php?id_cliente=<?php echo $_GET['id_cliente'];?>" method="post">
                            <!-- call function to populate form using DB -->
                            <?php refillFormCliente($pdo); ?>
                            <div class="field submit">
                                <div class="button-submit">
                                    <button type="submit" class="btn" name="btnRegister" value="ok"><img src="icons/written-paper.png" alt="AddIventario"><p>Registrar Cliente</p></button>
                                </div>
                            </div>
                            <?php
                            clienteErrors();
                            ?>
                        </form>
                        <div class="links">
                        <a href="clientes.php">Regresar a "Registro de Clientes"</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include("includes_style/footer.php") ; ?>
    <?php } ?>
</body>
</html>
