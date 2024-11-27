<?php
/*
view file shows information in the website
*/
declare(strict_types=1); //type declarations

function clienteInputs(object $pdo){
    $idCliente = (int)(htmlspecialchars(strval(assignID($pdo))));
    echo '
        <div class="field input">
            <label for="id_cliente" class="field input">ID de Cliente:</label>
            <input type="number" name="id_cliente" min="1" id="id_cliente" value="'. $idCliente .'" readonly>
        </div>
        ';
    // Check for 'Nombre(s)' field
    if(isset($_SESSION['cliente_data']['name']) && !isset($_SESSION["cliente_errors"]['invalid_name'])) {
        echo '<div class="field input">
                <label for="primer_nom_clie">Nombre(s):</label>
                <input type="text" name="primer_nom_clie" id="primer_nom_clie" value="'. $_SESSION['cliente_data']['name'] .'">
            </div>';
    } else {
        echo '<div class="field input">
                <label for="primer_nom_clie">Nombre(s):</label>
                <input type="text" name="primer_nom_clie" id="primer_nom_clie">
            </div>';
    }

    // Check for 'Apellido Paterno' field
    if(isset($_SESSION['cliente_data']['lastName']) && !isset($_SESSION["cliente_errors"]['invalid_lastN'])) {
        echo '<div class="field input">
                <label for="apellido_p_clie">Apellido Paterno:</label>
                <input type="text" name="apellido_p_clie" id="apellido_p_clie" value="'. $_SESSION['cliente_data']['lastName'] .'">
            </div>';
    } else {
        echo '<div class="field input">
                <label for="apellido_p_clie">Apellido Paterno:</label>
                <input type="text" name="apellido_p_clie" id="apellido_p_clie">
            </div>';
    }

    // Check for 'Apellido Materno' field
    if(isset($_SESSION['cliente_data']['maidenName'])  && !isset($_SESSION["cliente_errors"]['invalid_maidenN'])) {
        echo '<div class="field input">
                <label for="apellido_m_clie">Apellido Materno:</label>
                <input type="text" name="apellido_m_clie" id="apellido_m_clie" value="'. $_SESSION['cliente_data']['maidenName'] .'">
            </div>';
    } else {
        echo '<div class="field input">
                <label for="apellido_m_clie">Apellido Materno:</label>
                <input type="text" name="apellido_m_clie" id="apellido_m_clie">
            </div>';
    }

    // Check for 'Teléfono móvil' field
    if(isset($_SESSION['cliente_data']['movil']) && !isset($_SESSION["cliente_errors"]['invalid_phoneNoM'])) {
        echo '<div class="field input">
                <label for="movil_cliente">Teléfono móvil:</label>
                <input type="text" name="movil_cliente" id="movil_cliente" value="'. $_SESSION['cliente_data']['movil'] .'">
            </div>';
    } else {
        echo '<div class="field input">
                <label for="movil_cliente">Teléfono móvil:</label>
                <input type="text" name="movil_cliente" id="movil_cliente">
            </div>';
    }

    // Check for 'Teléfono fijo' field
    if(isset($_SESSION['cliente_data']['fijo']) && !isset($_SESSION["cliente_errors"]['invalid_phoneNoF'])) {
        echo '<div class="field input">
                <label for="fijo_cliente">Teléfono fijo:</label>
                <input type="text" name="fijo_cliente" id="fijo_cliente" value="'. $_SESSION['cliente_data']['fijo'] .'">
            </div>';
    } else {
        echo '<div class="field input">
                <label for="fijo_cliente">Teléfono fijo:</label>
                <input type="text" name="fijo_cliente" id="fijo_cliente">
            </div>';
    }
    unset($_SESSION['cliente_data']);
}

function clienteErrors(){
    if(isset($_SESSION["cliente_errors"])){
        $errors = $_SESSION["cliente_errors"];
        echo "<br>";
        echo '<div class="msg-box">';
        foreach ($errors as $e){
            //show errors to users
            echo '<div class="message-box box-error">';
            echo '<img src="icons/error.png" alt="MsgError">';
            echo '<p class="form-error">' . $e .'</p>';
            echo '</div>';
        }
        echo '</div>';
        unset($_SESSION["cliente_errors"]); //unset global variable, more data entries
    } else if(isset($_GET["status"]) && $_GET["status"] === "success" && isset($_GET["id_cliente"])){

        echo '<div class="msg-box">';
            echo '<div class="message-box box-success">';
            echo '<img src="icons/ok.png" alt="Success">';
            echo '<p class="form-success">¡Cliente Actualizado!</p>';
            echo '</div>';
            echo '</div>';
    } else if (isset($_GET["status"]) && $_GET["status"] === "success") {
        //Cliente Registrado!
        echo '<div class="msg-box">';
            echo '<div class="message-box box-success">';
            echo '<img src="icons/ok.png" alt="Success">';
            echo '<p class="form-success">¡Cliente Registrado!</p>';
            echo '</div>';
            echo '</div>';
    }
    unset($_SESSION["cliente_errors"]);
    unset($_GET["status"]);
}


function searchInputsCliente(){
    if(isset($_SESSION['busquedaCliente']['criteria']) && isset($_GET['result']) && ($_GET['result'] === 'found')){
        echo' <select id="searchCriteria" name="searchCriteria">
            <option value="id" '. ($_SESSION['busquedaCliente']['criteria'] === 'id' ? 'selected' : '') .'>ID Cliente</option>
            <option value="keywords" '. ($_SESSION['busquedaCliente']['criteria'] === 'keywords' ? 'selected' : '') .'>Nombre</option>
        </select>';
    } else {
        echo' <select id="searchCriteria" name="searchCriteria">
            <option value="id">ID Cliente</option>
            <option value="keywords">Nombre</option>
            </select>';
    }

    if(isset($_SESSION['busquedaCliente']['query']) && isset($_GET['result']) && ($_GET['result'] === 'found')){
        echo '<input type="text" id="searchQuery" name="searchQuery" placeholder="Buscar..." value="'. htmlspecialchars((string)$_SESSION['busquedaCliente']['query']) .'">';
    } else {
        echo '<input type="text" id="searchQuery" name="searchQuery" placeholder="Buscar...">';
    }
}

function checkClieSearchErrors() {
    if(isset($_SESSION["clienteSearchErrors"])){
        $errors = $_SESSION["clienteSearchErrors"];
        echo '<div class="msg-box">';
        foreach ($errors as $e){
            //show errors to users
            echo '<div class="message-box box-error">';
            echo '<img src="icons/error.png" alt="MsgError">';
            echo '<p class="form-error">' . $e .'</p>';
            echo '</div>';
        }
        echo '</div>';
        unset($_SESSION["clienteSearchErrors"]); //unset global variable, more data entries
    } else if (isset($_GET["result"])) {
        // Check the value of $_GET["result"] and display corresponding messages
        
        if ($_GET["result"] === "found") {
            echo '<div class="msg-box">';
            echo '<div class="message-box box-success">';
            echo '<img src="icons/ok.png" alt="Success">';
            echo '<p class="form-success">¡Se encontró el cliente!</p>';
            echo '</div>';
            echo '</div>';
        } else if ($_GET["result"] === "idNOTfound") {
            echo '<div class="msg-box">';
            echo '<div class="message-box box-warning">';
            echo '<img src="icons/warning.png" alt="Warning">';
            echo '<p class="form-error">¡No se encontró ese ID!</p>';
            echo '</div>';
            echo '</div>';
        } else if ($_GET["result"] === "keywordsNOTfound") {
            echo '<div class="msg-box">';
            echo '<div class="message-box box-warning">';
            echo '<img src="icons/warning.png" alt="Warning">';
            echo '<p class="form-error">¡No se encontró el cliente!</p>';
            echo '</div>';
        }
    }
}

function showClientesTable($pdo) { //function called from the model file might return a false if there is no stored data in the cliente table
    if(!isset($_GET["result"])){
        $clientesRow = clientesSelect($pdo);

        //assign array of associative arrays to a session global variable
        $_SESSION["cliente_table"] = $clientesRow;
        
        foreach($clientesRow as $row) {
            echo '<tr>';

            echo '<td>';
            // link to refill form with this row's data
            echo '<a href="editar_cliente.php?id_cliente='.htmlspecialchars(strval($row['id_cliente'])).'">
                <img src="icons/pen.png" alt="Edit" />
            </a>';
            echo '</td>';

            echo '<td>';
            // link to refill form with this row's data
            echo '<a href="includes/eliminar_cliente.inc.php?id_cliente='.htmlspecialchars(strval($row['id_cliente'])).'">
                <img src="icons/bin.png" alt="Delete" />
            </a>';
            echo '</td>';

            // Output each cell (column) of the table row
            echo '<td>' . htmlspecialchars(strval($row['id_cliente'])) . '</td>';
            echo '<td>' . htmlspecialchars($row['primer_nom_clie']) . '</td>';
            echo '<td>' . htmlspecialchars($row['apellido_p_clie']) . '</td>';
            echo '<td>' . htmlspecialchars($row['apellido_m_clie']) . '</td>';
            echo '<td>' . htmlspecialchars(strval($row['movil_cliente'])) . '</td>';
            echo '<td>' . htmlspecialchars(strval($row['fijo_cliente'])) . '</td>';
            
            echo '</tr>';
        }
    } else if((isset($_GET['result'])) && ($_GET['result'] === 'found') && isset($_SESSION['busquedaCliente'])){
        $userInput = $_SESSION['busquedaCliente']['query'];
        if($_GET['criteria'] === 'keywords') {
            $result = searchClienteKeywords($pdo, $userInput);
            foreach($result as $row) {
                echo '<tr>';

                echo '<td>';
                // link to refill form with this row's data
                echo '<a href="editar_cliente.php?id_cliente='.htmlspecialchars(strval($row['id_cliente'])).'">
                    <img src="icons/pen.png" alt="Edit" />
                </a>';
                echo '</td>';

                echo '<td>';
                // link to refill form with this row's data
                echo '<a href="includes/eliminar_cliente.inc.php?id_cliente='.htmlspecialchars(strval($row['id_cliente'])).'">
                    <img src="icons/bin.png" alt="Delete" />
                </a>';
                echo '</td>';

                // Output each cell (column) of the table row
                echo '<td>' . htmlspecialchars(strval($row['id_cliente'])) . '</td>';
                echo '<td>' . htmlspecialchars($row['primer_nom_clie']) . '</td>';
                echo '<td>' . htmlspecialchars($row['apellido_p_clie']) . '</td>';
                echo '<td>' . htmlspecialchars($row['apellido_m_clie']) . '</td>';
                echo '<td>' . htmlspecialchars(strval($row['movil_cliente'])) . '</td>';
                echo '<td>' . htmlspecialchars(strval($row['fijo_cliente'])) . '</td>';
                
                echo '</tr>';
            }
        } else if($_GET['criteria'] === 'id') {
            $result = getClienteID($pdo, $userInput);
            echo '<tr>';

                echo '<td>';
                // link to refill form with this row's data
                echo '<a href="editar_cliente.php?id_cliente='.htmlspecialchars(strval($result['id_cliente'])).'">
                    <img src="icons/pen.png" alt="Edit" />
                </a>';
                echo '</td>';

                echo '<td>';
                // link to refill form with this row's data
                echo '<a href="includes/eliminar_cliente.inc.php?id_cliente='.htmlspecialchars(strval($result['id_cliente'])).'">
                    <img src="icons/bin.png" alt="Delete" />
                </a>';
                echo '</td>';

            // Output each cell (column) of the table row
            echo '<td>' . htmlspecialchars(strval($result['id_cliente'])) . '</td>';
            echo '<td>' . htmlspecialchars($result['primer_nom_clie']) . '</td>';
            echo '<td>' . htmlspecialchars($result['apellido_p_clie']) . '</td>';
            echo '<td>' . htmlspecialchars($result['apellido_m_clie']) . '</td>';
            echo '<td>' . htmlspecialchars(strval($result['movil_cliente'])) . '</td>';
            echo '<td>' . htmlspecialchars(strval($result['fijo_cliente'])) . '</td>';
            
            echo '</tr>';
        }
    }
    unset($_SESSION['busquedaCliente']);
    unset($_GET['result']);
    unset($_GET['criteria']);
}

function refillFormCliente(object $pdo) {
    if(isset($_GET['id_cliente'])) {
        //get product id from global variable
        $id_cliente = $_GET["id_cliente"];
        //get the rest of the data from DB and sanitize
        $clienteData = getClienteID($pdo, intval($id_cliente)); //associative array, key is name of column
        //if data exists then repopulate form
        if($clienteData != false && !isset($_SESSION['cliente_data'])) {
            echo '<div class="field input">
                <label for="id_cliente" class="field input">ID de Cliente:</label>
                <input type="number" name="id_cliente" min="1" id="id_cliente" value="'. htmlspecialchars(strval($clienteData['id_cliente'])) .'" readonly>
            </div>
            ';
            echo '<div class="field input">
                <label for="primer_nom_clie">Nombre(s):</label>
                <input type="text" name="primer_nom_clie" id="primer_nom_clie" value="'. htmlspecialchars($clienteData['primer_nom_clie']) .'">
            </div>';
            echo '<div class="field input">
                <label for="apellido_p_clie">Apellido Paterno:</label>
                <input type="text" name="apellido_p_clie" id="apellido_p_clie" value="'. htmlspecialchars($clienteData['apellido_p_clie']) .'">
            </div>';
            echo '<div class="field input">
                <label for="apellido_m_clie">Apellido Materno:</label>
                <input type="text" name="apellido_m_clie" id="apellido_m_clie" value="'. htmlspecialchars($clienteData['apellido_m_clie']) .'">
            </div>';
            echo '<div class="field input">
                <label for="movil_cliente">Teléfono móvil:</label>
                <input type="text" name="movil_cliente" id="movil_cliente" value="'.  htmlspecialchars(strval($clienteData['movil_cliente'])) .'">
            </div>';
            echo '<div class="field input">
                <label for="fijo_cliente">Teléfono fijo:</label>
                <input type="text" name="fijo_cliente" id="fijo_cliente" value="'. htmlspecialchars(strval($clienteData['fijo_cliente'])) .'">
            </div>';
        } else if($clienteData = false && !isset($_SESSION['cliente_data'])){
            //display a message error that tells user that the data doesn't exist
        } else if(isset($_SESSION['cliente_data'])) {
            echo '<div class="field input">
                <label for="id_cliente" class="field input">ID de Cliente:</label>
                <input type="number" name="id_cliente" min="1" id="id_cliente" value="'. $_GET['id_cliente'] .'" readonly>
            </div>
            ';
            if(isset($_SESSION['cliente_data']['name']) && !isset($_SESSION["cliente_errors"]['invalid_name'])) {
                echo '<div class="field input">
                        <label for="primer_nom_clie">Nombre(s):</label>
                        <input type="text" name="primer_nom_clie" id="primer_nom_clie" value="'. $_SESSION['cliente_data']['name'] .'">
                    </div>';
            } else {
                echo '<div class="field input">
                        <label for="primer_nom_clie">Nombre(s):</label>
                        <input type="text" name="primer_nom_clie" id="primer_nom_clie">
                    </div>';
            }
        
            // Check for 'Apellido Paterno' field
            if(isset($_SESSION['cliente_data']['lastName']) && !isset($_SESSION["cliente_errors"]['invalid_lastN'])) {
                echo '<div class="field input">
                        <label for="apellido_p_clie">Apellido Paterno:</label>
                        <input type="text" name="apellido_p_clie" id="apellido_p_clie" value="'. $_SESSION['cliente_data']['lastName'] .'">
                    </div>';
            } else {
                echo '<div class="field input">
                        <label for="apellido_p_clie">Apellido Paterno:</label>
                        <input type="text" name="apellido_p_clie" id="apellido_p_clie">
                    </div>';
            }
        
            // Check for 'Apellido Materno' field
            if(isset($_SESSION['cliente_data']['maidenName'])  && !isset($_SESSION["cliente_errors"]['invalid_maidenN'])) {
                echo '<div class="field input">
                        <label for="apellido_m_clie">Apellido Materno:</label>
                        <input type="text" name="apellido_m_clie" id="apellido_m_clie" value="'. $_SESSION['cliente_data']['maidenName'] .'">
                    </div>';
            } else {
                echo '<div class="field input">
                        <label for="apellido_m_clie">Apellido Materno:</label>
                        <input type="text" name="apellido_m_clie" id="apellido_m_clie">
                    </div>';
            }
        
            // Check for 'Teléfono móvil' field
            if(isset($_SESSION['cliente_data']['movil']) && !isset($_SESSION["cliente_errors"]['invalid_phoneNoM'])) {
                echo '<div class="field input">
                        <label for="movil_cliente">Teléfono móvil:</label>
                        <input type="text" name="movil_cliente" id="movil_cliente" value="'. $_SESSION['cliente_data']['movil'] .'">
                    </div>';
            } else {
                echo '<div class="field input">
                        <label for="movil_cliente">Teléfono móvil:</label>
                        <input type="text" name="movil_cliente" id="movil_cliente">
                    </div>';
            }
        
            // Check for 'Teléfono fijo' field
            if(isset($_SESSION['cliente_data']['fijo']) && !isset($_SESSION["cliente_errors"]['invalid_phoneNoF'])) {
                echo '<div class="field input">
                        <label for="fijo_cliente">Teléfono fijo:</label>
                        <input type="text" name="fijo_cliente" id="fijo_cliente" value="'. $_SESSION['cliente_data']['fijo'] .'">
                    </div>';
            } else {
                echo '<div class="field input">
                        <label for="fijo_cliente">Teléfono fijo:</label>
                        <input type="text" name="fijo_cliente" id="fijo_cliente">
                    </div>';
            }
        }
    }
    unset($_SESSION["producto_data"]);
}

function clienteDeleteSuccess() {
    if (isset($_GET['id_cliente']) && isset($_GET['clienteDeleted'])) {
        // Display the deletion message
        echo '<div class="msg-box">';
            echo '<div class="message-box box-success">';
                echo '<img src="icons/ok.png" alt="Success">';
                echo '<p class="form-success">'. '¡El cliente con el ID #'. htmlspecialchars($_GET['id_cliente']) .' fue eliminado!' .'</p>';
            echo '</div>';
        echo '</div>';
    }
    unset($_GET['id_cliente']);
    unset($_GET['status']);
}

function confirmDeleteProveedorOperation() {
    if(isset($_GET['id_cliente']) && isset($_GET['confirm_delete'])) {
        echo '<div class="msg-box">';
            echo '<div class="message-box-delete box-delete">';
                echo '<div class="msg-buttons">';
                    echo '<div class="icon-msg">';
                        echo '<img src="icons/warning.png" alt="Warning">';
                        echo '<p class="form-error">¿Está seguro de que desea eliminar el cliente con el ID #'. $_GET['id_cliente'] .' y su historial relacionado?</p>';
                    echo '</div>';

                    echo '<div class="button-container-yes-no">';

                        echo '<div class="btnYes">';
                        echo '<button type="button" id="yesDelete">
                        <a href="includes/confirm_delete_cliente.inc.php?id_cliente='.$_GET['id_cliente'].'">Sí</a>
                        </button>';
                        echo '</div>';
                        
                        echo '<div class="btnNo">';
                        echo '<button type="button" id="yesDelete">
                            <a href="clientes.php" class="btn-no">No</a>
                        </button>';
                    echo '</div>';

                echo '</div>';
            echo '</div>';
        echo '</div>';
    }
}
