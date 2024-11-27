<?php

declare(strict_types=1);

function showUsersTable(object $pdo) {
    $result = getUsers($pdo);
    foreach ($result as $row) {
        echo '<tr>';

            echo '<td>';
                if ($row['permission_granted']) {
                    echo '<button class="toggle-access revoke-access" data-id="' . htmlspecialchars(strval($row['id_usuario'])) . '" data-access="1">Revocar Acceso</button>';
                } else {
                    echo '<button class="toggle-access grant-access" data-id="' . htmlspecialchars(strval($row['id_usuario'])) . '" data-access="0">Autorizar Acceso</button>';
                }
            echo '</td>';
            

            echo '<td>';
            echo '<a href="includes/eliminar_usuario.inc.php?id_usuario='. htmlspecialchars(strval($row['id_usuario'])) .'">
                <img src="icons/bin.png" alt="Delete" />
            </a>';
            echo '</td>';

            echo '<td>';
                echo '<select class="user-type" data-id="' . htmlspecialchars(strval($row['id_usuario'])) . '">';
                    echo '<option value="1"' . ($row['is_admin'] === 1 ? ' selected' : '') . '>administrador</option>';
                    echo '<option value="0"' . ($row['is_admin'] === 0 ? ' selected' : '') . '>usuario</option>';
                    echo '<option value=""' . (is_null($row['is_admin']) ? ' selected' : '') . '>estatus pendiente</option>';
                echo '</select>';
        echo '</td>';
            
            echo '<td>' . htmlspecialchars(strval($row['id_usuario'])) . '</td>';

            echo '<td>' . htmlspecialchars($row['nombre']) . '</td>';

            echo '<td>' . htmlspecialchars($row['login_usuario']) . '</td>';

            echo '<td>' . htmlspecialchars($row['email_usuario']) . '</td>';

        echo '</tr>';
    }
}

function userDeleteSuccess() {
    if (isset($_GET['id_usuario']) && isset($_GET['userDeleted'])) {
        // Display the deletion message
        echo '<div class="msg-box">';
            echo '<div class="message-box box-success">';
                echo '<img src="icons/ok.png" alt="Success">';
                echo '<p class="form-success">'. '¡El usuario con el ID #'. htmlspecialchars($_GET['id_usuario']) .' fue eliminado!' .'</p>';
            echo '</div>';
        echo '</div>';
    }
    unset($_GET['id_usuario']);
    unset($_GET['userDeleted']);
}

function confirmDeleteUser() {
    if(isset($_GET['id_usuario']) && isset($_GET['confirm_delete'])) {
        echo '<div class="msg-box">';
            echo '<div class="message-box-delete box-delete">';
                echo '<div class="msg-buttons">';
                    echo '<div class="icon-msg">';
                        echo '<img src="icons/warning.png" alt="Warning">';
                        echo '<p class="form-error">¿Está seguro de que desea eliminar el usuario con el ID #'. $_GET['id_usuario']. '?</p>';
                    echo '</div>';

                    echo '<div class="button-container-yes-no">';

                        echo '<div class="btnYes">';
                        echo '<button type="button" id="yesDelete">
                        <a href="includes/confirm_delete_usuario.inc.php?id_usuario='.$_GET['id_usuario'].'">Sí</a>
                        </button>';
                        echo '</div>';
                        
                        echo '<div class="btnNo">';
                        echo '<button type="button" id="yesDelete">
                            <a href="administrar_usuarios.php" class="btn-no">No</a>
                        </button>';
                    echo '</div>';

                echo '</div>';
            echo '</div>';
        echo '</div>';
    }
}