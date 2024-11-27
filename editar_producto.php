<?php
require_once 'includes/config_session.inc.php';
require_once "includes/dbh.inc.php";
require_once "includes/producto_model.inc.php";
require_once 'includes/producto_view.inc.php';
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
            <head>Editar Datos de Proveedor #<?php echo $_GET['id_producto']; ?></head>
        </div>
        <div class="container-form-table-searchBar">
            <div class="section">
                <div class="container-form">
                    <div class="box form-box">
                        <header>Editar Producto</header>
                        <form id="productosForm" action="includes/editar_productos.inc.php?id_producto=<?php echo $_GET['id_producto'];?>" method="post">
                        <!-- call function to populate form using DB -->
                        <?php refillFormProducto($pdo); ?>
                            <div class="field submit">
                                <div class="button-submit">
                                    <button type="submit" class="btn" name="btnUpdate" value="ok">Actualizar</button>
                                </div>
                            </div>
                            <?php
                            checkErrorsProductos();
                            ?>
                        </form>
                        <div class="links">
                            <a href="productos.php">Regresar a "Registro de Productos"</a>
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