<?php
require_once 'includes/config_session.inc.php';
require_once "includes/dbh.inc.php";
require_once "includes/transaccion_model.inc.php";
require_once 'includes/transaccion_view.inc.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles de Transacción #<?php echo htmlspecialchars($_GET['id_transaccion']) ?></title>
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
            <head>Detalles de Transacción #<?php echo htmlspecialchars($_GET["id_transaccion"]); ?></head>
            <a href="transacciones.php">Volver a la página "Transacciones"</a>
        </div>
        <div class="container-form-table-searchBar">
            <div class="container-table-searchBar">
                <div class="find-box">
                    <div class="search-box">
                        <?php confirmDeleteDetalle();
                        detalleDeleteSuccess(); ?>
                    </div>
                </div>
                <div class="table-container-two">
                    <div class="table-title">
                            <h2>
                                Detalles de la Transacción
                            </h2>
                        </div>
                    <div class="table-container-rows">
                        <table class="table" id="detalles">
                            <thead>
                                <tr>
                                    <th>ID Transacción</th>
                                    <th>Fecha</th>
                                    <th>Total</th>
                                    <th>Tipo</th>
                                    <th>ID Cliente</th>
                                    <th>Nombre Cliente</th>
                                    <th>ID Empleado</th>
                                    <th>Usuario del Empleado</th>
                                    <th>Nombre del Empleado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php showTransaccionTable($pdo); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="table-container-three">

                    <div class="table-title">
                        <h2>
                            Productos de la Transacción
                        </h2>
                    </div>
                    
                    <!-- table -->
                    <div class="table-container-rows">
                        <table class="table" id="detalles-clieProd">
                            <thead>
                                <tr>
                                    <th>Editar</th>
                                    <th>Eliminar</th>
                                    <th>ID del Producto</th>
                                    <th>Nombre del Producto</th>
                                    <th>Descripción del Producto</th>
                                    <th>Precio del Producto</th>
                                    <th>Cantidad</th>
                                    <th>Total</th>
                                    <!-- <th>Borrar</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php showProductosTable($pdo); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include("includes_style/footer.php") ;?>
    <?php } ?>

</body>
</html>