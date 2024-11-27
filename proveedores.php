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
    <title>Registro de Proveedores</title>
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
                <head>Manejo de Registro de Proveedores</head>
            </div>
            <div class="container-form-table-searchBar">
                <div class="section">
                    <div class="container-form">
                        <div class="box form-box">
                            <header>Registro de Proveedores</header>
                            <form id="proveedoresForm" action="includes/proveedor.inc.php" method="post">
                                <?php proveedorInputs($pdo); ?>
                                <div class="field submit">
                                    <div class="button-submit">
                                        <button type="submit" class="btn" name="btnAgregarProv" value="ok"><img src="icons/written-paper.png" alt="AddIventario"><p>Agregar Proveedor</p></button>
                                    </div>
                                </div>
                                
                                <?php
                                    checkErrorsProveedores();
                                ?>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="container-table-searchBar">
                    <div class="cont">
                        <!-- SEARCH BAR FOR PROVEEDORES -->
                        <div class="find-box">
                            <div class="search-box">

                                <form id="searchFormProv" action="includes/buscar_proveedor.inc.php" method="post">
                                    <?php searchInputsProv(); ?>
                                    <button type="submit" class="btn" id="btnProv"><img src="icons/search.png" alt="Search"></button>
                                </form>
                                
                                <?php 
                                    checkProveSearchErrors();
                                    confirmDeleteProveedorOperation();  
                                    proveedorDeleteSuccess();
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="table-container">
                        <div class="table-title">
                            <h2>
                                Proveedores
                                <form action="includes/refresh_tableProv.inc.php" method="post">
                                    <button id="refreshButton">&#x21BB;</button> <!-- Refresh button -->
                                </form>
                            </h2>
                        </div>
                        <!-- table -->
                        <div class="table-container-rows">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Editar</th>
                                        <th>Eliminar</th>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Dirección</th>
                                        <th>Descripción</th>
                                        <th>Telefono</th>
                                        <th>Email</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php showProveedorTable($pdo); ?>
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