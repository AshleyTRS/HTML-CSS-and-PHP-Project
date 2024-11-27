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
    <title>Registro de Transacciones</title>
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
            <head>Historial de Transacciones</head>
        </div>
        <div class="container-form-table-searchBar">
            <div class="section">
                <div class="container-form">
                    <div class="box form-box">
                        <header>Registro de Transacciones</header>
                        <form id="proveedoresForm" action="includes/transaccion.inc.php"    method="post">
                            <?php transaccionInputs($pdo); ?>
                            <?php addProductButton(); ?>
                            
                            <!-- JS code to dynamically add products -->
                            <?php $products = getProducts($pdo); ?>
                            <script>
                                // to add a field
                                document.getElementById("add-product").addEventListener("click", function() {
                                    const productContainer = document.querySelector(".product-container"); //target container
                                    const newProductInput = document.createElement("div");
                                    newProductInput.className = "product-inputs"; // Ensure correct class
                                    newProductInput.innerHTML = `
                                        <div class="product-input">
                                            <label for="product[]">Nombre:</label>
                                            <select name="product[]" id="product[]">
                                                <option value="">Seleccione un producto</option>'
                                                <?php foreach($products as $row) {
                                                    $nombre = htmlspecialchars($row['nombre_producto']);
                                                    echo '<option value="' . $row['id_producto'] . '">' . $nombre . '</option>';
                                                } ?>
                                            '</select>
                                        </div>
                                        <div class="product-input">
                                            <label for="quantity[]">Cantidad:</label>
                                            <input type="number" name="quantity[]">
                                        </div>
                                    `;
                                    productContainer.appendChild(newProductInput); // Append to container
                                });

                                // to remove a field
                                document.getElementById("remove-product").addEventListener("click", function() {
                                    const productInputs = document.querySelectorAll(".product-inputs");
                                    // Check if there are more than one product inputs
                                    if (productInputs.length > 1) {
                                        // Remove the last product input
                                        const lastProductInput = productInputs[productInputs.length - 1];
                                        lastProductInput.remove();
                                    } else {
                                        // Display an alert or message indicating that there must be at least one product input
                                        alert("Debe haber al menos una entrada de producto.");
                                    }
                                });
                            </script>
                            
                            <div class="field submit">
                                <div class="button-submit">
                                    <button type="submit" class="btn" name="btnAgregarProv" value="ok"><img src="icons/written-paper.png" alt="AddIventario"><p>Registrar Transacción</p></button>
                                </div>
                            </div>
                            <?php checkErrorsTran(); ?>
                        </form>

                    </div>
                </div>
            </div>
            <div class="container-table-searchBar">
                <!-- SEARCH BAR FOR PROVEEDORES -->
                <div class="find-box">
                    <div class="search-box">

                        <form id="searchFormProv" action="includes/buscar_transaccion.inc.php" method="post">
                            <?php searchInputsTran(); ?>
                            <button type="submit" class="btn" id="btnProv"><img src="icons/search.png" alt="Search"></button>
                        </form>
                        
                        <?php checkClienteSearchErrors(); 
                            confirmDeleteTransaction(); 
                            transDeleteSuccess();
                        ?>
                    </div>
                </div>
                <div class="table-container">
                    <div class="table-title">
                        <h2>
                            Historial de Transacciones
                            <form action="includes/refresh_tableTran.inc.php" method="post">
                                <button id="refreshButton">&#x21BB;</button> <!-- Refresh button -->
                            </form>
                        </h2>
                    </div>
                    
                    <!-- table -->
                    <div class="table-container-rows">
                        <table class="table" id="transacciones_table">
                            <thead>
                                <tr>
                                    <th>Editar</th>
                                    <th>Eliminar</th>
                                    <th>Ver Detalles</th>
                                    <th>ID</th>
                                    <th>Fecha</th>
                                    <th>Total</th>
                                    <th>Tipo</th>
                                    <th>ID Cliente</th>
                                    <th>Nombre Cliente</th>
                                    <th>ID Empleado</th>
                                    <th>Usuario</th>
                                    <!-- <th>Borrar</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php showTransaccionesTable($pdo); ?>
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