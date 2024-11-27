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
    <title>Registro de Clientes</title>
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
                            <header>Registro de Clientes</header>
                            <form id="clientesForm" action="includes/cliente.inc.php" method="post" autocomplete="off">
                                <!-- ID Cliente auto increments -->
                                <?php clienteInputs($pdo); ?>
                                <div class="field submit">
                                    <div class="button-submit">
                                        <button type="submit" class="btn" name="btnRegister" value="ok"><img src="icons/written-paper.png" alt="AddIventario"><p>Registrar Cliente</p></button>
                                    </div>
                                </div>
                                <?php clienteErrors() ?>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="container-table-searchBar">
                    <!-- Search for Cliente -->
                    <div class="find-box">
                            <div class="search-box">

                                <form id="searchFormProd" action="includes/buscar_cliente.inc.php" method="post">
                                    <?php searchInputsCliente() ?>
                                    <button type="submit" class="btn" id="btnProd"><img src="icons/search.png" alt="Search"></button>
                                </form>

                                <?php
                                    checkClieSearchErrors();
                                    confirmDeleteProveedorOperation();
                                    clienteDeleteSuccess(); 
                                ?>
                            </div>
                    </div>
                    <div class="table-container">
                        <div class="table-title">
                            <h2>Clientes
                                <form action="includes/refresh_tableClie.inc.php">
                                    <button id="refreshButton">&#x21BB;</button> <!-- Refresh button -->
                                </form>
                            </h2>
                        </div>
                            
                        <!-- table begins here -->
                        <div class="table-container-rows">
                            <table class="table" id="cliente_table">
                                <thead>
                                    <tr>
                                        <th>Editar</th>  
                                        <th>Eliminar</th>
                                        <th>ID cliente</th>
                                        <th>Nombre</th>
                                        <th>Apellido Paterno</th>
                                        <th>Apellido Materno</th>
                                        <th>Telefono movil</th>
                                        <th>Telefono fijo</th>                              
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php showClientesTable($pdo); ?>
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
