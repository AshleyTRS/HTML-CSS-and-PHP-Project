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
    <title>Manejo de Inventario de Productos</title>
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
                <head>Manejo de Inventario de Productos</head>
            </div>
            <div class="container-form-table-searchBar">
                <div class="section">
                    <div class="container-form">
                        <div class="box form-box">
                            <header>Registro de Productos</header> <!--Gestion del Inventario de Productos -->
                            <form id="productosForm" action="includes/producto.inc.php" method="post">
                                <?php productoInputs($pdo);?>
                                <div class="field submit">
                                    <div class="button-submit">
                                        <button type="submit" class="btn" name="btnAgregarProd" value="ok"><img src="icons/written-paper.png" alt="AddIventario"><p>Agregar Producto</p></button>
                                    </div>
                                </div>
                                <?php
                                checkErrorsProductos();
                                ?> 

                            </form>
                        </div>
                    </div>
                </div>
                <div class="container-table-searchBar">
                        <!-- Search for Product -->
                        <div class="find-box">
                            <div class="search-box">

                                <form id="searchFormProd" action="includes/buscar_producto.inc.php" method="post">
                                    <?php searchInputs() ?>
                                    <button type="submit" class="btn" id="btnProd"><img src="icons/search.png" alt="Search"></button>
                                </form>

                                <?php
                                    checkProdSearchErrors();
                                    confirmDeleteProductOperation();
                                    productDeleteSuccess();
                                ?>
                            </div>
                        </div>
                        <div class="table-container">
                            <div class="table-title">
                                <h2>
                                        Productos
                                        <form action="includes/refresh_tableProd.inc.php">
                                            <button id="refreshButton">&#x21BB;</button> <!-- Refresh button -->
                                        </form>
                                    
                                </h2>
                            </div>
                        
                            <!-- table begins here -->
                            <div class="table-container-rows">
                                <table class="table">
                                    <!-- style="width:200%" -->
                                    <thead>
                                        <tr>
                                            <th>Editar</th>     
                                            <th>Borrar</th>
                                            <th>ID</th>
                                            <th>Nombre</th>
                                            <th>Descripción</th>
                                            <th>Material</th>
                                            <th>Categoria</th>
                                            <th>Cantidad</th>
                                            <th>Precio Unitario</th>
                                            <th>ID Proveedor</th>
                                            <th>Nombre Proveedor</th> 
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