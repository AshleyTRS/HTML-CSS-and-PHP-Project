<?php
declare(strict_types=1);

function proveedorInputs(object $pdo){
    $idProveedor = (int)(htmlspecialchars(strval(assignID($pdo))));
    echo '<div class="section-inputs">';
    echo '<div class="field input inputMargin">
                <label for="id_proveedor">ID de Proveedor:</label>
                <input type="number" name="id_proveedor" id="id_proveedor" value="'. $idProveedor .'" readonly>
            </div>';

    if(isset($_SESSION['proveedor_data']['provNombre']) && !isset($_SESSION["proveedor_errors"]['invalid_name'])) { //proveedor name
        echo '<div class="field input">
        <label for="nombre_proveedor">Nombre del Proveedor:</label>
        <input type="text" name="nombre_proveedor" id="nombre_proveedor" value="'. $_SESSION['proveedor_data']['provNombre'] .'">
        </div>';
    } else {
        echo '<div class="field input">
        <label for="nombre_proveedor">Nombre del Proveedor:</label>
        <input type="text" name="nombre_proveedor" id="nombre_proveedor">
        </div>';
    }
    echo '</div>';

    //address related data

    if(isset($_SESSION['proveedor_data']['calle']) && !isset($_SESSION["proveedor_errors"]['invalid_calle'])) { //street
        echo '<div class="field input">
        <h3>Dirección del Proveedor</h3>
        <label for="calle_p">Calle:</label>
        <input type="text" name="calle_p" id="calle_p" value="'. $_SESSION['proveedor_data']['calle'] .'">
        </div>';
    } else {
        echo '<div class="field input">
        <h3>Direccion del Proveedor</h3>
        <label for="calle_p">Calle:</label>
        <input type="text" name="calle_p" id="calle_p">
        </div>';
    }

    if(isset($_SESSION['proveedor_data']['no']) && !isset($_SESSION["proveedor_errors"]['invalid_no'])) { //buildingNo
        echo '<div class="field input">
        <label for="num_p">Número:</label>
        <input type="number" name="num_p" id="num_p" value="'. $_SESSION['proveedor_data']['no'] .'">
        </div>';
    } else {
        echo '<div class="field input">
        <label for="num_p">Número:</label>
        <input type="number" name="num_p" id="num_p">
        </div>';
    }

    if(isset($_SESSION['proveedor_data']['colonia']) && !isset($_SESSION["proveedor_errors"]['invalid_colonia'])) {  //colony
        echo '<div class="field input">
        <label for="colonia_p">Colonia:</label>
        <input type="text" name="colonia_p" id="colonia_p" value="'. $_SESSION['proveedor_data']['colonia'] .'">
        </div>';
    } else {
        echo '<div class="field input">
        <label for="colonia_p">Colonia:</label>
        <input type="text" name="colonia_p" id="colonia_p">
        </div>';
    }

    if(isset($_SESSION['proveedor_data']['cuidad']) && !isset($_SESSION["proveedor_errors"]['invalid_ciudad'])) { //city
        echo '<div class="field input">
        <label for="cuidad_p">Cuidad:</label>
        <input type="text" name="cuidad_p" id="cuidad_p" value="'. $_SESSION['proveedor_data']['cuidad'] .'">
        </div>';
    } else {
        echo '<div class="field input">
        <label for="cuidad_p">Cuidad:</label>
        <input type="text" name="cuidad_p" id="cuidad_p">
        </div>';
    }

    if(isset($_SESSION['proveedor_data']['estado']) && !isset($_SESSION["proveedor_errors"]['invalid_estado'])) { //state
        echo '<div class="field input">
        <label for="estado_p">Estado:</label>
        <input type="text" name="estado_p" id="estado_p" value="'.  $_SESSION['proveedor_data']['estado'].'">
        </div>';
    } else {
        echo '<div class="field input">
        <label for="estado_p">Estado:</label>
        <input type="text" name="estado_p" id="estado_p">
        </div>';
    }

    if(isset($_SESSION['proveedor_data']['cp']) && !isset($_SESSION["proveedor_errors"]['invalid_cp'])) { //areaCode
        echo '<div class="field input">
        <label for="CP_p">Código Postal:</label>
        <input type="number" name="CP_p" id="CP_p" value="'. $_SESSION['proveedor_data']['cp'].'">
        </div>';
    } else {
        echo '<div class="field input">
        <label for="CP_p">Código Postal:</label>
        <input type="number" name="CP_p" id="CP_p">
        </div>';
    }

    if(isset($_SESSION['proveedor_data']['des'])) { //description
        echo '<div class="field input">
        <label for="descripccion">Descripción:</label>
        <input type="text" name="descripccion" id="descripccion" value="'. $_SESSION['proveedor_data']['des'] .'">
        </div>';
    } else {
        echo '<div class="field input">
        <label for="descripccion">Descripción:</label>
        <input type="text" name="descripccion" id="descripccion">
        </div>';
    }

    if(isset($_SESSION['proveedor_data']['telefono']) && !isset($_SESSION["proveedor_errors"]['invalid_tel'])) { //contact number
        echo '<div class="field input">
        <label for="telefono">Número de teléfono:</label>
        <input type="number" name="telefono" id="telefono" value="'. $_SESSION['proveedor_data']['telefono'] .'">
        </div>';
    } else {
        echo '<div class="field input">
        <label for="telefono">Número de teléfono:</label>
        <input type="number" name="telefono" id="telefono">
        </div>';
    }

    if(isset($_SESSION['proveedor_data']['email']) && (!isset($_SESSION["proveedor_errors"]['invalid_email']) || !isset($_SESSION["proveedor_errors"]['email_used']))) { //email
        echo ' <div class="field input">
        <label for="email">Correo electrónico:</label>
        <input type="text" name="email" id="email" value="'. $_SESSION['proveedor_data']['email'] .'">
        </div>';
    } else {
        echo ' <div class="field input">
        <label for="email">Correo electrónico:</label>
        <input type="text" name="email" id="email">
        </div>';
    }
    unset($_SESSION['proveedor_data']);
}

function checkErrorsProveedores(){
    if(isset($_SESSION["proveedor_errors"])){
        $errors = $_SESSION["proveedor_errors"];
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
        unset($_SESSION["proveedor_errors"]); //unset global variable, more data entries
    } else if(isset($_GET["status"]) && $_GET["status"] === "success" && isset($_GET["id_proveedor"])){
            echo '<div class="msg-box">';
            echo '<div class="message-box box-success">';
            echo '<img src="icons/ok.png" alt="Success">';
            echo '<p class="form-success">¡Proveedor actualizado!</p>';
            echo '</div>';
            echo '</div>';
    } else if (isset($_GET["status"]) && $_GET["status"] === "success") {
        //Proveedor agregado!
            echo '<div class="msg-box">';
            echo '<div class="message-box box-success">';
            echo '<img src="icons/ok.png" alt="Success">';
            echo '<p class="form-success">¡Proveedor agregado!</p>';
            echo '</div>';
            echo '</div>';
    }
    //unset global variables
    unset($_SESSION["proveedor_errors"]);
    unset($_GET["status"]);
}

function searchInputsProv(){
    if(isset($_SESSION['busquedaProv']['criteria']) && isset($_GET['result']) && (($_GET['result'] === 'found') || $_GET['result'] === 'idNOTfound' || $_GET['result'] === 'keywordsNOTfound')){
        echo' <select id="searchCriteria" name="searchCriteria">
            <option value="id" '. ($_SESSION['busquedaProv']['criteria'] === 'id' ? 'selected' : '') .'>ID Proveedor</option>
            <option value="keywords" '. ($_SESSION['busquedaProv']['criteria'] === 'keywords' ? 'selected' : '') .'>Nombre</option>
        </select>';
    } else {
        echo' <select id="searchCriteria" name="searchCriteria">
            <option value="id">ID Proveedor</option>
            <option value="keywords">Nombre</option>
            </select>';
    }

    if(isset($_SESSION['busquedaProv']['query']) && isset($_GET['result']) && ($_GET['result'] === 'found' || $_GET['result'] === 'idNOTfound' || $_GET['result'] === 'keywordsNOTfound')){
        echo '<input type="text" id="searchQuery" name="searchQuery" placeholder="Buscar..." value="'. htmlspecialchars((string)$_SESSION['busquedaProv']['query']) .'">';
    } else {
        echo '<input type="text" id="searchQuery" name="searchQuery" placeholder="Buscar...">';
    }
}

function refillFormProveedor(object $pdo) {
    if(isset($_GET['id_proveedor'])) {
        $id_proveedor = $_GET['id_proveedor'];
        $provData = getProveedorId($pdo, intval($id_proveedor));

        if($provData != false && !isset($_SESSION['proveedor_data'])) {
            echo '<div class="field input">
                <label for="id_proveedor">ID de proveedor:</label>
                <input type="number" name="id_proveedor" id="id_proveedor" value="'. htmlspecialchars(strval($provData['id_proveedor'])) .'" readonly>
            </div>';

            echo '<div class="field input">
            <label for="nombre_proveedor">Nombre del Proveedor:</label>
            <input type="text" name="nombre_proveedor" id="nombre_proveedor" value="'. htmlspecialchars($provData['nombre_proveedor']) .'">
            </div>';

            echo '<div class="field input">
            <h3>Direccion del Proveedor</h3>
            <label for="calle_p">Calle:</label>
            <input type="text" name="calle_p" id="calle_p" value="'. htmlspecialchars($provData['calle_p']) .'">
            </div>';

            echo '<div class="field input">
            <label for="num_p">Número:</label>
            <input type="number" name="num_p" id="num_p" value="'. htmlspecialchars(strval($provData['num_p'])) .'">
            </div>';

            echo '<div class="field input">
            <label for="colonia_p">Colonia:</label>
            <input type="text" name="colonia_p" id="colonia_p" value="'. htmlspecialchars($provData['colonia_p']) .'">
            </div>';

            echo '<div class="field input">
            <label for="cuidad_p">Cuidad:</label>
            <input type="text" name="cuidad_p" id="cuidad_p" value="'. htmlspecialchars($provData['cuidad_p']) .'">
            </div>';

            echo '<div class="field input">
            <label for="estado_p">Estado:</label>
            <input type="text" name="estado_p" id="estado_p" value="'.  htmlspecialchars($provData['estado_p']).'">
            </div>';

            echo '<div class="field input">
            <label for="CP_p">Código Postal:</label>
            <input type="number" name="CP_p" id="CP_p" value="'. htmlspecialchars(strval($provData['CP_p'])).'">
            </div>';

            echo '<div class="field input">
            <label for="descripccion">Descripción:</label>
            <input type="text" name="descripccion" id="descripccion" value="'. htmlspecialchars($provData['descripccion']) .'">
            </div>';

            echo '<div class="field input">
            <label for="telefono">Número de teléfono:</label>
            <input type="number" name="telefono" id="telefono" value="'. htmlspecialchars(strval($provData['telefono'])) .'">
            </div>';

            echo ' <div class="field input">
            <label for="email">Correo electrónico:</label>
            <input type="text" name="email" id="email" value="'. htmlspecialchars($provData['correo_electronico']) .'">
            </div>';
        } else if($provData = false && !isset($_SESSION['proveedor_data'])) {
            //display a message error that tells user that the data doesn't exist
        } else if(isset($_SESSION['proveedor_data'])) {
            echo '<div class="field input">
                <label for="id_proveedor">ID de proveedor:</label>
                <input type="number" name="id_proveedor" id="id_proveedor" value="'. $_GET['id_proveedor'] .'" readonly>
            </div>';
            if(isset($_SESSION['proveedor_data']['provNombre']) && !isset($_SESSION["proveedor_errors"]['invalid_name'])) { //proveedor name
                echo '<div class="field input">
                <label for="nombre_proveedor">Nombre del Proveedor:</label>
                <input type="text" name="nombre_proveedor" id="nombre_proveedor" value="'. $_SESSION['proveedor_data']['provNombre'] .'">
                </div>';
            } else {
                echo '<div class="field input">
                <label for="nombre_proveedor">Nombre del Proveedor:</label>
                <input type="text" name="nombre_proveedor" id="nombre_proveedor">
                </div>';
            }
        
            //address related data
        
            if(isset($_SESSION['proveedor_data']['calle']) && !isset($_SESSION["proveedor_errors"]['invalid_calle'])) { //street
                echo '<div class="field input">
                <h3>Direccion del Proveedor</h3>
                <label for="calle_p">Calle:</label>
                <input type="text" name="calle_p" id="calle_p" value="'. $_SESSION['proveedor_data']['calle'] .'">
                </div>';
            } else {
                echo '<div class="field input">
                <h3>Direccion del Proveedor</h3>
                <label for="calle_p">Calle:</label>
                <input type="text" name="calle_p" id="calle_p">
                </div>';
            }
        
            if(isset($_SESSION['proveedor_data']['no']) && !isset($_SESSION["proveedor_errors"]['invalid_no'])) { //buildingNo
                echo '<div class="field input">
                <label for="num_p">Número:</label>
                <input type="number" name="num_p" id="num_p" value="'. $_SESSION['proveedor_data']['no'] .'">
                </div>';
            } else {
                echo '<div class="field input">
                <label for="num_p">Número:</label>
                <input type="number" name="num_p" id="num_p">
                </div>';
            }
        
            if(isset($_SESSION['proveedor_data']['colonia']) && !isset($_SESSION["proveedor_errors"]['invalid_colonia'])) {  //colony
                echo '<div class="field input">
                <label for="colonia_p">Colonia:</label>
                <input type="text" name="colonia_p" id="colonia_p" value="'. $_SESSION['proveedor_data']['colonia'] .'">
                </div>';
            } else {
                echo '<div class="field input">
                <label for="colonia_p">Colonia:</label>
                <input type="text" name="colonia_p" id="colonia_p">
                </div>';
            }
        
            if(isset($_SESSION['proveedor_data']['cuidad']) && !isset($_SESSION["proveedor_errors"]['invalid_ciudad'])) { //city
                echo '<div class="field input">
                <label for="cuidad_p">Cuidad:</label>
                <input type="text" name="cuidad_p" id="cuidad_p" value="'. $_SESSION['proveedor_data']['cuidad'] .'">
                </div>';
            } else {
                echo '<div class="field input">
                <label for="cuidad_p">Cuidad:</label>
                <input type="text" name="cuidad_p" id="cuidad_p">
                </div>';
            }
        
            if(isset($_SESSION['proveedor_data']['estado']) && !isset($_SESSION["proveedor_errors"]['invalid_estado'])) { //state
                echo '<div class="field input">
                <label for="estado_p">Estado:</label>
                <input type="text" name="estado_p" id="estado_p" value="'.  $_SESSION['proveedor_data']['estado'].'">
                </div>';
            } else {
                echo '<div class="field input">
                <label for="estado_p">Estado:</label>
                <input type="text" name="estado_p" id="estado_p">
                </div>';
            }
        
            if(isset($_SESSION['proveedor_data']['cp']) && !isset($_SESSION["proveedor_errors"]['invalid_cp'])) { //areaCode
                echo '<div class="field input">
                <label for="CP_p">Código Postal:</label>
                <input type="number" name="CP_p" id="CP_p" value="'. $_SESSION['proveedor_data']['cp'].'">
                </div>';
            } else {
                echo '<div class="field input">
                <label for="CP_p">Código Postal:</label>
                <input type="number" name="CP_p" id="CP_p">
                </div>';
            }
        
            if(isset($_SESSION['proveedor_data']['des'])) { //description
                echo '<div class="field input">
                <label for="descripccion">Descripción:</label>
                <input type="text" name="descripccion" id="descripccion" value="'. $_SESSION['proveedor_data']['des'] .'">
                </div>';
            } else {
                echo '<div class="field input">
                <label for="descripccion">Descripción:</label>
                <input type="text" name="descripccion" id="descripccion">
                </div>';
            }
        
            if(isset($_SESSION['proveedor_data']['telefono']) && !isset($_SESSION["proveedor_errors"]['invalid_tel'])) { //contact number
                echo '<div class="field input">
                <label for="telefono">Número de teléfono:</label>
                <input type="number" name="telefono" id="telefono" value="'. $_SESSION['proveedor_data']['telefono'] .'">
                </div>';
            } else {
                echo '<div class="field input">
                <label for="telefono">Número de teléfono:</label>
                <input type="number" name="telefono" id="telefono">
                </div>';
            }
        
            if(isset($_SESSION['proveedor_data']['email']) && (!isset($_SESSION["proveedor_errors"]['invalid_email']) || !isset($_SESSION["proveedor_errors"]['email_used']))) { //email
                echo ' <div class="field input">
                <label for="email">Correo electrónico:</label>
                <input type="text" name="email" id="email" value="'. $_SESSION['proveedor_data']['email'] .'">
                </div>';
            } else {
                echo ' <div class="field input">
                <label for="email">Correo electrónico:</label>
                <input type="text" name="email" id="email">
                </div>';
            }
            unset($_SESSION['proveedor_data']);
            

        }
    }
}

function checkProveSearchErrors() {
    if(isset($_SESSION["provSearchErrors"])){
        $errors = $_SESSION["provSearchErrors"];
        echo '<div class="msg-box">';
        foreach ($errors as $e){
            //show errors to users
            echo '<div class="message-box box-error">';
            echo '<img src="icons/error.png" alt="MsgError">';
            echo '<p class="form-error">' . $e .'</p>';
            echo '</div>';
        }
        echo '</div>';
        unset($_SESSION["provSearchErrors"]); //unset global variable, more data entries
    } else if (isset($_GET["result"])) {
        // Check the value of $_GET["result"] and display corresponding messages
        
        if ($_GET["result"] === "found") {
            //¡Se encontró el proveedor!
            echo '<div class="msg-box">';
            echo '<div class="message-box box-success">';
            echo '<img src="icons/ok.png" alt="Success">';
            echo '<p class="form-success">¡Se encontró el proveedor!</p>';
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
            echo '<p class="form-error">¡No se encontró el producto!</p>';
            echo '</div>';
        }
    }
}

function showProveedorTable(object $pdo) {
    if(!isset($_GET["result"])) {
        $result = proveedoresSelect($pdo);

        foreach ($result as $row) {
            echo '<tr>';

            echo '<td>';
            // link to refill form with this row's data
            echo '<a href="editar_proveedor.php?id_proveedor='. htmlspecialchars(strval($row['id_proveedor'])).'">
                <img src="icons/pen.png" alt="Edit" />
            </a>';
            echo '</td>';

            echo '<td>';
            echo '<a href="includes/eliminar_proveedor.inc.php?id_proveedor='.htmlspecialchars(strval($row['id_proveedor'])).'">
                <img src="icons/bin.png" alt="Delete" />
            </a>';
            echo '</td>';

            echo '<td>' . htmlspecialchars(strval($row['id_proveedor'])) . '</td>';

            echo '<td>' . htmlspecialchars($row['nombre_proveedor']) . '</td>';

            $address = htmlspecialchars($row['calle_p']) .' '.    htmlspecialchars(strval($row['num_p'])) .', '. htmlspecialchars($row['colonia_p']) . ', ' . htmlspecialchars($row['cuidad_p']) . ', ' . htmlspecialchars($row['estado_p']) . ', '. htmlspecialchars(strval($row['CP_p']));
            echo '<td>'. $address .
            '</td>';

            echo '<td>' . htmlspecialchars($row['descripccion']) . '</td>';

            echo '<td>' . htmlspecialchars(strval($row['telefono'])) . '</td>';

            echo '<td>' . htmlspecialchars($row['correo_electronico']) . '</td>';

            echo '</tr>';
        }
    } else if((isset($_GET['result'])) && ($_GET['result'] === 'found') && isset($_SESSION['busquedaProv'])){
        $userInput = $_SESSION['busquedaProv']['query'];

        if($_GET['criteria'] === 'keywords') {
            $result = searchProveedorKeywords($pdo, $userInput);
            foreach ($result as $row) {
                echo '<tr>';

                echo '<td>';
                // link to refill form with this row's data
                echo '<a href="editar_proveedor.php?id_proveedor='. htmlspecialchars(strval($row['id_proveedor'])).'">
                    <img src="icons/pen.png" alt="Edit" />
                </a>';
                echo '</td>';
    
                echo '<td>';
                echo '<a href="includes/eliminar_proveedor.inc.php?id_proveedor='.htmlspecialchars(strval($row['id_proveedor'])).'">
                    <img src="icons/bin.png" alt="Delete" />
                </a>';
                echo '</td>';

                echo '<td>' . htmlspecialchars(strval($row['id_proveedor'])) . '</td>';
    
                echo '<td>' . htmlspecialchars($row['nombre_proveedor']) . '</td>';
    
                $address = htmlspecialchars($row['calle_p']) .' '.    htmlspecialchars(strval($row['num_p'])) .', '. htmlspecialchars($row['colonia_p']) . ', ' . htmlspecialchars($row['cuidad_p']) . ', ' . htmlspecialchars($row['estado_p']) . ', '. htmlspecialchars(strval($row['CP_p']));
                echo '<td>'. $address .
                '</td>';
    
                echo '<td>' . htmlspecialchars($row['descripccion']) . '</td>';
    
                echo '<td>' . htmlspecialchars(strval($row['telefono'])) . '</td>';
    
                echo '<td>' . htmlspecialchars($row['correo_electronico']) . '</td>';
    
                echo '</tr>';
            }
        } else if ($_GET['criteria'] === 'id') {
            $result = getProveedorId($pdo, $userInput);
            echo '<tr>';

            echo '<td>';
            // link to refill form with this row's data
            echo '<a href="editar_proveedor.php?id_proveedor='. htmlspecialchars(strval($result['id_proveedor'])).'">
                <img src="icons/pen.png" alt="Edit" />
            </a>';
            echo '</td>';

            echo '<td>';
            echo '<a href="includes/eliminar_proveedor.inc.php?id_proveedor='.htmlspecialchars(strval($result['id_proveedor'])).'">
                <img src="icons/bin.png" alt="Delete" />
            </a>';
            echo '</td>';

            echo '<td>' . htmlspecialchars(strval($result['id_proveedor'])) . '</td>';
            
            echo '<td>' . htmlspecialchars($result['nombre_proveedor']) . '</td>';
            
            $address = htmlspecialchars($result['calle_p']) .' '.    htmlspecialchars(strval($result['num_p'])) .', '. htmlspecialchars($result['colonia_p']) . ', ' . htmlspecialchars($result['cuidad_p']) . ', ' . htmlspecialchars($result['estado_p']) . ', '. htmlspecialchars(strval($result['CP_p']));
            echo '<td>'. $address .
            '</td>';
            
            echo '<td>' . htmlspecialchars($result['descripccion']) . '</td>';
            
            echo '<td>' . htmlspecialchars(strval($result['telefono'])) . '</td>';
            
            echo '<td>' . htmlspecialchars($result['correo_electronico']) . '</td>';
            
            echo '</tr>';            
        }
    }
    unset($_SESSION['busquedaProv']);
    unset($_GET['result']);
    unset($_GET['criteria']);
}

function proveedorDeleteSuccess() {
    if (isset($_GET['id_proveedor']) && isset($_GET['proveedorDeleted'])) {
        // Display the deletion message
        echo '<div class="msg-box">';
            echo '<div class="message-box box-success">';
                echo '<img src="icons/ok.png" alt="Success">';
                echo '<p class="form-success">'. '¡El proveedor con el ID #'. htmlspecialchars($_GET['id_proveedor']) .' fue eliminado!' .'</p>';
            echo '</div>';
        echo '</div>';
    }
    unset($_GET['id_proveedor']);
    unset($_GET['status']);
}

function confirmDeleteProveedorOperation() {
    if(isset($_GET['id_proveedor']) && isset($_GET['confirm_delete'])) {
        echo '<div class="msg-box">';
            echo '<div class="message-box-delete box-delete">';
                echo '<div class="msg-buttons">';
                    echo '<div class="icon-msg">';
                        echo '<img src="icons/warning.png" alt="Warning">';
                        echo '<p class="form-error">¿Está seguro de que desea eliminar el proveedor con el ID #'. $_GET['id_proveedor'] .' y productos y transacciones relacionados?</p>';
                    echo '</div>';

                    echo '<div class="button-container-yes-no">';

                        echo '<div class="btnYes">';
                        echo '<button type="button" id="yesDelete">
                        <a href="includes/confirm_delete_proveedor.inc.php?id_proveedor='.$_GET['id_proveedor'].'">Sí</a>
                        </button>';
                        echo '</div>';
                        
                        echo '<div class="btnNo">';
                        echo '<button type="button" id="yesDelete">
                            <a href="proveedores.php" class="btn-no">No</a>
                        </button>';
                    echo '</div>';

                echo '</div>';
            echo '</div>';
        echo '</div>';
    }
}