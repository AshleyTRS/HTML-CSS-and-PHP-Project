<?php
require_once 'includes/config_session.inc.php';
require_once "includes/dbh.inc.php";
require_once "includes/proveedor_model.inc.php";
require_once 'includes/proveedor_view.inc.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Registro de Producto</title>
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
            <head>Editar Datos de Proveedor #<?php echo $_GET['id_proveedor']; ?></head>
        </div>
        <div class="container-form-table-searchBar">
            <div class="section">
                <div class="container-form">
                    <div class="box form-box">
                        <header>Editar Proveedor</header>
                            <form id="proveedoresForm" action="includes/editar_proveedores.inc.php?id_proveedor=<?php echo $_GET['id_proveedor'];?>" method="post">
                                <!-- call function to populate form using DB -->
                                <?php refillFormProveedor($pdo); ?>
                                <div class="field submit">
                                    <div class="button-submit">
                                        <button type="submit" class="btn" name="btnUpdate" value="ok">Actualizar</button>
                                    </div>
                                    
                                </div>
                                <?php
                                checkErrorsProveedores();
                                ?>
                            </form>
                            <div class="links">
                                <a href="proveedores.php">Regresar a "Registro de Proveedores"</a>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include("includes_style/footer.php") ;?>
    <?php } ?>
</body>
</html>