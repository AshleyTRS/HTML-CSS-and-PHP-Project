<?php
require_once 'includes/config_session.inc.php';
require_once "includes/dbh.inc.php";
require_once "includes/administrar_usuarios_model.inc.php";
require_once 'includes/administrar_usuarios_view.inc.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrar Usuarios</title>
    <link rel="stylesheet" href="css/main.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <?php if(isset($_SESSION["user_id"]) && isset($_SESSION['admin_dashboard']) && $_SESSION['admin_dashboard'] === true) { 
        include("includes_style/header_admin.php");
        ?> 
            <!-- addd contents of body in here after linking the file to the home page -->
            <div class="container">
            <div class="head-title">
                <head>Administrar Usuarios</head>
            </div>
            <div class="container-form-table-searchBar">
                <div class="container-table-searchBar">
                    <div class="find-box">
                        <div class="search-box">
                            <!-- messages here -->
                            <?php 
                             confirmDeleteUser(); 
                             userDeleteSuccess(); ?>
                        </div>
                    </div>
                    <div class="table-container-three">

                        <div class="table-title">
                            <h2>
                                Usuarios Registrados
                            </h2>
                        </div>
                        
                        <!-- table -->
                        <div class="table-container-rows">
                            <table class="table" id="detalles-clieProd">
                                <thead>
                                    <tr>
                                        <th>Permiso de acceso</th>
                                        <th>Eliminar</th>
                                        <th>Tipo</th>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Usuario</th>
                                        <th>Email</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php showUsersTable($pdo); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include("includes_style/footer.php") ;?>
        <script>
            $(document).ready(function() {
                $('.toggle-access').on('click', function() {
                    var button = $(this);
                    var userId = button.data('id');
                    var currentAccess = button.data('access');
                    var newAccess = currentAccess ? 0 : 1;

                    $.ajax({
                        url: 'includes/toggle_access.inc.php',
                        method: 'POST',
                        data: { id_usuario: userId, access: newAccess },
                        success: function(response) {
                            if (response == 'success') {
                                if (newAccess) {
                                    button.text('Revoke Access').data('access', 1).removeClass('grant-access').addClass('revoke-access');
                                } else {
                                    button.text('Grant Access').data('access', 0).removeClass('revoke-access').addClass('grant-access');
                                }
                            } else {
                                alert('Failed to update access permission.');
                            }
                        }
                    });
                });

                $('.user-type').on('change', function() {
                    var select = $(this);
                    var userId = select.data('id');
                    var newType = select.val();

                    $.ajax({
                        url: 'includes/update_user_type.inc.php',
                        method: 'POST',
                        data: { id_usuario: userId, is_admin: newType },
                        success: function(response) {
                            if (response !== 'success') {
                                alert('Failed to update user type.');
                            }
                        }
                    });
                });
            });

        </script>
    <?php } ?>


</body>
</html>