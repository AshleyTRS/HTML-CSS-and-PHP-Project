<?php
/*
view file shows information in the website
*/
declare(strict_types=1); //type declarations
function productoInputs(object $pdo) {
    $idProducto = (int)(htmlspecialchars(strval(assignID($pdo))));
    echo '<div class="section-inputs">';
        echo '
        <div class="field input inputMargin">
            <label for="id_producto" class="field input">ID de Producto:</label>
            <input type="number" name="id_producto" min="1" id="id_producto" value="'. $idProducto .'" readonly>
        </div>';
        if(isset($_SESSION['producto_data']['nombre_producto'])) { //retrieve data that user inputed
            echo '
            <div class="field input extend-field">
                    <label for="nombre_producto" class="field input">Nombre:</label>
                    <input type="text" name="nombre_producto" id="nombre_producto" value="'. $_SESSION['producto_data']['nombre_producto'] .'">
            </div>';
        } else { //show blank input
            echo '
            <div class="field input extend-field">
                    <label for="nombre_producto" class="field input">Nombre:</label>
                    <input type="text" name="nombre_producto" id="nombre_producto">
            </div>';
        }
    echo '</div>';


    if(isset($_SESSION['producto_data']['descripccion_producto'])) {
        echo '
        <div class="field input">
                <label for="descripccion_producto">Descripción:</label>
                <input type="text" name="descripccion_producto" id="descripccion_producto" value="'. $_SESSION['producto_data']['descripccion_producto'] .'">
        </div>';
    } else {
        echo '
        <div class="field input">
                <label for="descripccion_producto">Descripción:</label>
                <input type="text" name="descripccion_producto" id="descripccion_producto">
        </div>';
    }
    if(isset($_SESSION['producto_data']['material_producto'])) {
        echo '
        <div class="field input">
                <label for="material_producto">Material:</label>
                <input type="text" name="material_producto" id="material_producto" value="'. $_SESSION['producto_data']['material_producto'] .'">
        </div>';
    } else {
        echo '
        <div class="field input">
                <label for="material_producto">Material:</label>
                <input type="text" name="material_producto" id="material_producto">
        </div>';
    }
    if(isset($_SESSION['producto_data']['categoria_producto'])) {
        echo '
        <div class="field input">
            <label for="categoria_producto">Categoría:</label>
                <div class="category-btn">
                    <div class="input-label">
                        <input type="radio" name="categoria_producto" id="macetas" value="macetas"'. ($_SESSION['producto_data']['categoria_producto'] === 'macetas' ? 'checked' : '') .'>
                        <label for="macetas">macetas</label>
                        <input type="radio" name="categoria_producto" id="tazas" value="tazas"'. ($_SESSION['producto_data']['categoria_producto'] === 'tazas' ? 'checked' : '').'>
                        <label for="tazas">tazas</label>
                        <input type="radio" name="categoria_producto" id="figuras" value="figuras"'. ($_SESSION['producto_data']['categoria_producto'] === 'figuras' ? 'checked' : '') .'>
                        <label for="figuras">figuras</label>
                    </div>
                    <div class="input-label">
                        <input type="radio" name="categoria_producto" id="jarros" value="jarros" '. ($_SESSION['producto_data']['categoria_producto'] === 'jarros' ? 'checked' : '') .'>
                        <label for="jarros">jarros</label>
                        <input type="radio" name="categoria_producto" id="platos" value="platos"'. ($_SESSION['producto_data']['categoria_producto'] === 'platos' ? 'checked' : '') .'>
                        <label for="platos">platos</label>
                    </div>
                    <div class="input-label">
                        <input type="radio" name="categoria_producto" id="decoInteriores" value="decoraciones de interiores"'. ($_SESSION['producto_data']['categoria_producto'] === 'decoraciones de interiores' ? 'checked' : '') .'>
                        <label for="decoInteriores">decoraciones de interiores</label>
                        <input type="radio" name="categoria_producto" id="decoJardin" value="decoraciones de jardin"'. ($_SESSION['producto_data']['categoria_producto'] === 'decoraciones de jardin' ? 'checked' : '') .'>
                        <label for="decoJardin">decoraciones de jardin</label>
                    </div>    
                </div>
        </div>
    ';
    } else {
        echo '
        <div class="field input">
                <label for="categoria_producto">Categoría:</label>
                <div class="category-btn">
                    <div class="input-label">
                        <input type="radio" name="categoria_producto" id="macetas" value="macetas">
                        <label for="macetas">macetas</label>
                        <input type="radio" name="categoria_producto" id="tazas" value="tazas">
                        <label for="tazas">tazas</label>
                        <input type="radio" name="categoria_producto" id="figuras" value="figuras">
                        <label for="figuras">figuras</label>
                    </div>
                    <div class="input-label">
                        <input type="radio" name="categoria_producto" id="jarros" value="jarros">
                        <label for="jarros">jarros</label>
                        <input type="radio" name="categoria_producto" id="platos" value="platos">
                        <label for="platos">platos</label>
                    </div>
                    <div class="input-label">
                        <input type="radio" name="categoria_producto" id="decoInteriores" value="decoraciones de interiores">
                        <label for="decoInteriores">decoraciones de interiores</label>
                        <input type="radio" name="categoria_producto" id="decoJardin" value="decoraciones de jardin">
                        <label for="decoJardin">decoraciones de jardin</label>
                    </div>    
            </div>
        </div>';
    }
    if(isset($_SESSION['producto_data']['cantidad_producto']) && !isset($_SESSION['producto_errors']['incorrect_type_Q'])) {
        echo '
        <div class="field input">
                <h3>Ingrese la cantidad de producto que quiera agregar al inventario.</h3>
                <label for="cantidad_inventario">Cantidad:</label>
                <input type="number" name="cantidad_inventario" min="0" id="cantidad_inventario" title="La cantidad debe ser igual o mayor que 0."  value="'. $_SESSION['producto_data']['cantidad_producto'] .'">
        </div>';
    } else {
        echo '
        <div class="field input">
                <h3>Ingrese la cantidad de producto que quiera agregar al inventario.</h3>
                <label for="cantidad_inventario">Cantidad:</label>
                <input type="number" name="cantidad_inventario" min="0" title="La cantidad debe ser igual o mayor que 0." id="cantidad_inventario">
        </div>';
    }
    if(isset($_SESSION['producto_data']['precio_unitario_tienda']) && !isset($_SESSION['producto_errors']['incorrect_type_P'])) {
        echo '
        <div class="field input">
                <h3>Ingrese el precio de venta unitario.</h3>
                <label for="precio_unitario_tienda">Precio:</label>
                <input type="text" name="precio_unitario_tienda" id="precio_unitario_tienda" value="'. $_SESSION['producto_data']['precio_unitario_tienda'] .'">
        </div>';
    } else {
        echo '
        <div class="field input">
                <h3>Ingrese el precio de venta unitario.</h3>
                <label for="precio_unitario_tienda">Precio:</label>
                <input type="text" name="precio_unitario_tienda" id="precio_unitario_tienda">
        </div>';
    }
    $result = getProveedores($pdo);
    if(isset($_SESSION['producto_data']['idProveedor']) && $result){
        echo '<div class="field input">
        <h3>Seleccione el proveedor del producto</h3>
        <label for="proveedor_id">Proveedor:</label>
        <select name="proveedor_id" id="proveedor_id">
        <option value="">Seleccione un proveedor</option>';
            foreach($result as $row) {
                $id = htmlspecialchars(strval($row['id_proveedor']));
                $name = htmlspecialchars($row['nombre_proveedor']);
                echo '<option value="' . $id . '" ' . ($_SESSION['producto_data']['idProveedor'] === (int)$id ? 'selected' : '') . '>' . $name . '</option>';
            }
        echo '</select>
        </div>';
    } else{
        echo '<div class="field input">
        <h3>Seleccione el proveedor del producto</h3>
        <label for="proveedor_id">Proveedor:</label>
        <select name="proveedor_id" id="proveedor_id">
        <option value="">Seleccione un proveedor</option>';
            foreach($result as $row) {
                $id = $row['id_proveedor'];
                $name = htmlspecialchars($row['nombre_proveedor']);
                echo '<option value="'. $id .'">'. $name .'</option>';
            }
        echo '</select>
        </div>';
    }
    unset($_SESSION["producto_data"]);
}

function refillFormProducto(object $pdo) {
    if(isset($_GET['id_producto'])) {
        //get product id from global variable
        $id_producto = $_GET["id_producto"];
        //get the rest of the data from DB and sanitize
        $productData = getProductId($pdo, intval($id_producto)); //associative array, key is name of column
        //if data exists then repopulate form
        if($productData != false && !isset($_SESSION['producto_data'])) {
            echo '
                <div class="field input">
                        <label for="id_producto">ID:</label>
                        <input type="text" name="id_producto" id="id_producto" value="'. htmlspecialchars(strval($productData['id_producto'])) .'" readonly>
                </div>';
            echo '
                <div class="field input">
                    <label for="nombre_producto">Nombre:</label>
                    <input type="text" name="nombre_producto" id="nombre_producto" value="' . htmlspecialchars($productData['nombre_producto']) . '">
                </div>';
            echo '<div class="field input">
                    <label for="descripccion_producto">Descripción:</label>
                    <input type="text" name="descripccion_producto" id="descripccion_producto" value="'. htmlspecialchars($productData['descripccion']) . '">
                    </div>';
            echo '
                <div class="field input">
                    <label for="material_producto">Material:</label>
                    <input type="text" name="material_producto" id="material_producto" value="'. htmlspecialchars($productData['material_producto']) .'">
                </div>';
            echo '
                <div class="field input">
                    <label for="categoria_producto">Categoria:</label>
                        <div class="category-btn">
                            <div class="input-label">
                                <input type="radio" name="categoria_producto" id="macetas" value="macetas"'. ($productData['categoria_producto'] === 'macetas' ? 'checked' : '') .'>
                                <label for="macetas">macetas</label>
                                <input type="radio" name="categoria_producto" id="tazas" value="tazas"'. ($productData['categoria_producto'] === 'tazas' ? 'checked' : '').'>
                                <label for="tazas">tazas</label>
                                <input type="radio" name="categoria_producto" id="figuras" value="figuras"'. ($productData['categoria_producto'] === 'figuras' ? 'checked' : '') .'>
                                <label for="figuras">figuras</label>
                            </div>
                            <div class="input-label">
                                <input type="radio" name="categoria_producto" id="jarros" value="jarros" '. ($productData['categoria_producto'] === 'jarros' ? 'checked' : '') .'>
                                <label for="jarros">jarros</label>
                                <input type="radio" name="categoria_producto" id="platos" value="platos"'. ($productData['categoria_producto'] === 'platos' ? 'checked' : '') .'>
                                <label for="platos">platos</label>
                            </div>
                            <div class="input-label">
                                <input type="radio" name="categoria_producto" id="decoInteriores" value="decoraciones de interiores"'. ($productData['categoria_producto'] === 'decoraciones de interiores' ? 'checked' : '') .'>
                                <label for="decoInteriores">decoraciones de interiores</label>
                                <input type="radio" name="categoria_producto" id="decoJardin" value="decoraciones de jardin"'. ($productData['categoria_producto'] === 'decoraciones de jardin' ? 'checked' : '') .'>
                                <label for="decoJardin">decoraciones de jardin</label>
                            </div>    
                        </div>
                </div>
            ';
            echo '
                <div class="field input">
                    <h3>Ingrese la cantidad de producto que quiera agregar al inventario.</h3>
                    <label for="cantidad_inventario">Cantidad:</label>
                    <input type="number" name="cantidad_inventario" min="0" id="cantidad_inventario" value="'. htmlspecialchars(strval($productData['cantidad_invetario'])) .'">
                </div>';
            echo '<div class="field input">
                <h3>Ingrese el precio de venta unitario.</h3>
                <label for="precio_unitario_tienda">Precio:</label>
                <input type="text" name="precio_unitario_tienda" id="precio_unitario_tienda" value="'. htmlspecialchars(strval($productData['precio_unitario_tienda'])) .'">
            </div>';
           
            $result = getProveedores($pdo);

            echo '<div class="field input">
            <h3>Seleccione el proveedor del producto</h3>
            <label for="proveedor_id">Proveedor:</label>
            <select name="proveedor_id" id="proveedor_id">
            <option value="">Seleccione un proveedor</option>';
                foreach($result as $row) {
                    $id = htmlspecialchars(strval($row['id_proveedor']));
                    $name = htmlspecialchars($row['nombre_proveedor']);
                    echo '<option value="' . $id . '" ' . ($productData['id_proveedor'] === (int)$id ? 'selected' : '') . '>' . $name . '</option>';
                }
            echo '</select>
            </div>';
        } else if($productData = false && !isset($_SESSION['producto_data'])){
            //display a message error that tells user that the data doesn't exist
        } else if(isset($_SESSION['producto_data'])) {
            //always show product ID
            echo ' 
                <div class="field input">
                        <label for="id_producto">ID:</label>
                        <input type="text" name="id_producto" id="id_producto" value="'. $_GET['id_producto'] .'" readonly>
                </div>';
            if(isset($_SESSION['producto_data']['nombre_producto'])) { //retrieve data that user inputed
                echo '
                <div class="field input">
                        <label for="nombre_producto">Nombre:</label>
                        <input type="text" name="nombre_producto" id="nombre_producto" value="'. $_SESSION['producto_data']['nombre_producto'] .'">
                </div>';
            } else { //show blank input
                echo '
                <div class="field input">
                        <label for="nombre_producto">Nombre:</label>
                        <input type="text" name="nombre_producto" id="nombre_producto">
                </div>';
            }
            if(isset($_SESSION['producto_data']['descripccion_producto'])) {
                echo '
                <div class="field input">
                        <label for="descripccion_producto">Descripción:</label>
                        <input type="text" name="descripccion_producto" id="descripccion_producto" value="'. $_SESSION['producto_data']['descripccion_producto'] .'">
                </div>';
            } else {
                echo '
                <div class="field input">
                        <label for="descripccion_producto">Descripción:</label>
                        <input type="text" name="descripccion_producto" id="descripccion_producto">
                </div>';
            }
            if(isset($_SESSION['producto_data']['material_producto'])) {
                echo '
                <div class="field input">
                        <label for="material_producto">Material:</label>
                        <input type="text" name="material_producto" id="material_producto" value="'. $_SESSION['producto_data']['material_producto'] .'">
                </div>';
            } else {
                echo '
                <div class="field input">
                        <label for="material_producto">Material:</label>
                        <input type="text" name="material_producto" id="material_producto">
                </div>';
            }
            if(isset($_SESSION['producto_data']['categoria_producto'])) {
                echo '
                <div class="field input">
                    <label for="categoria_producto">Categoria:</label>
                        <div class="category-btn">
                            <div class="input-label">
                                <input type="radio" name="categoria_producto" id="macetas" value="macetas"'. ($_SESSION['producto_data']['categoria_producto'] === 'macetas' ? 'checked' : '') .'>
                                <label for="macetas">macetas</label>
                                <input type="radio" name="categoria_producto" id="tazas" value="tazas"'. ($_SESSION['producto_data']['categoria_producto'] === 'tazas' ? 'checked' : '').'>
                                <label for="tazas">tazas</label>
                                <input type="radio" name="categoria_producto" id="figuras" value="figuras"'. ($_SESSION['producto_data']['categoria_producto'] === 'figuras' ? 'checked' : '') .'>
                                <label for="figuras">figuras</label>
                            </div>
                            <div class="input-label">
                                <input type="radio" name="categoria_producto" id="jarros" value="jarros" '. ($_SESSION['producto_data']['categoria_producto'] === 'jarros' ? 'checked' : '') .'>
                                <label for="jarros">jarros</label>
                                <input type="radio" name="categoria_producto" id="platos" value="platos"'. ($_SESSION['producto_data']['categoria_producto'] === 'platos' ? 'checked' : '') .'>
                                <label for="platos">platos</label>
                            </div>
                            <div class="input-label">
                                <input type="radio" name="categoria_producto" id="decoInteriores" value="decoraciones de interiores"'. ($_SESSION['producto_data']['categoria_producto'] === 'decoraciones de interiores' ? 'checked' : '') .'>
                                <label for="decoInteriores">decoraciones de interiores</label>
                                <input type="radio" name="categoria_producto" id="decoJardin" value="decoraciones de jardin"'. ($_SESSION['producto_data']['categoria_producto'] === 'decoraciones de jardin' ? 'checked' : '') .'>
                                <label for="decoJardin">decoraciones de jardin</label>
                            </div>    
                        </div>
                </div>
            ';
            } else {
                echo '
                <div class="field input">
                        <label for="categoria_producto">Categoria:</label>
                        <div class="category-btn">
                            <div class="input-label">
                                <input type="radio" name="categoria_producto" id="macetas" value="macetas">
                                <label for="macetas">macetas</label>
                                <input type="radio" name="categoria_producto" id="tazas" value="tazas">
                                <label for="tazas">tazas</label>
                                <input type="radio" name="categoria_producto" id="figuras" value="figuras">
                                <label for="figuras">figuras</label>
                            </div>
                            <div class="input-label">
                                <input type="radio" name="categoria_producto" id="jarros" value="jarros">
                                <label for="jarros">jarros</label>
                                <input type="radio" name="categoria_producto" id="platos" value="platos">
                                <label for="platos">platos</label>
                            </div>
                            <div class="input-label">
                                <input type="radio" name="categoria_producto" id="decoInteriores" value="decoraciones de interiores">
                                <label for="decoInteriores">decoraciones de interiores</label>
                                <input type="radio" name="categoria_producto" id="decoJardin" value="decoraciones de jardin">
                                <label for="decoJardin">decoraciones de jardin</label>
                            </div>    
                    </div>
                </div>';
            }
            if(isset($_SESSION['producto_data']['cantidad_producto']) && !isset($_SESSION['producto_errors']['incorrect_type_Q'])) {
                echo '
                <div class="field input">
                        <h3>Ingrese la cantidad de producto que quiera agregar al inventario.</h3>
                        <label for="cantidad_inventario">Cantidad:</label>
                        <input type="number" name="cantidad_inventario" min="0" id="cantidad_inventario" value="'. $_SESSION['producto_data']['cantidad_producto'] .'">
                </div>';
            } else {
                echo '
                <div class="field input">
                        <h3>Ingrese la cantidad de producto que quiera agregar al inventario.</h3>
                        <label for="cantidad_inventario">Cantidad:</label>
                        <input type="number" name="cantidad_inventario" min="0" id="cantidad_inventario">
                </div>';
            }
            if(isset($_SESSION['producto_data']['precio_unitario_tienda']) && !isset($_SESSION['producto_errors']['incorrect_type_P'])) {
                echo '
                <div class="field input">
                        <h3>Ingrese el precio de venta unitario.</h3>
                        <label for="precio_unitario_tienda">Precio:</label>
                        <input type="text" name="precio_unitario_tienda" id="precio_unitario_tienda" value="'. $_SESSION['producto_data']['precio_unitario_tienda'] .'">
                </div>';
            } else {
                echo '
                <div class="field input">
                        <h3>Ingrese el precio de venta unitario.</h3>
                        <label for="precio_unitario_tienda">Precio:</label>
                        <input type="text" name="precio_unitario_tienda" id="precio_unitario_tienda">
                </div>';
            }
            $result = getProveedores($pdo);
            if(isset($_SESSION['producto_data']['idProveedor']) && $result){
                echo '<div class="field input">
                <h3>Seleccione el proveedor del producto</h3>
                <label for="proveedor_id">Proveedor:</label>
                <select name="proveedor_id" id="proveedor_id">
                <option value="">Seleccione un proveedor</option>';
                    foreach($result as $row) {
                        $id = htmlspecialchars(strval($row['id_proveedor']));
                        $name = htmlspecialchars($row['nombre_proveedor']);
                        echo '<option value=\"$id\" '. ($_SESSION['producto_data']['idProveedor'] === $id ? 'selected' : '') .'>$name</option>';
                    }
                echo '</select>
                </div>';
            } else if ($result){
                echo '<div class="field input">
                <h3>Seleccione el proveedor del producto</h3>
                <label for="proveedor_id">Proveedor:</label>
                <select name="proveedor_id" id="proveedor_id">
                <option value="">Seleccione un proveedor</option>';
                    foreach($result as $row) {
                        $id = htmlspecialchars(strval($row['id_proveedor']));
                        $name = htmlspecialchars($row['nombre_proveedor']);
                        echo "<option value=\"$id\">$name</option>";
                    }
                echo '</select>
                </div>';
            }
        }

    }
    unset($_SESSION["producto_data"]);
}

function checkErrorsProductos(){
    if(isset($_SESSION["producto_errors"])){
        $errors = $_SESSION["producto_errors"];
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
        unset($_SESSION["producto_errors"]); //unset global variable, more data entries
    } else if (isset($_GET["status"]) && $_GET["status"] === "success") {
            echo '<div class="msg-box">';
            echo '<div class="message-box box-success">';
            echo '<img src="icons/ok.png" alt="Success">';
            echo '<p class="form-success">¡Inventario actualizado!</p>';
            echo '</div>';
            echo '</div>';
    }
    unset($_SESSION["producto_errors"]);
    unset($_GET["status"]);
}

function checkProdSearchErrors() {
    if(isset($_SESSION["prodSearchErrors"])){
        $errors = $_SESSION["prodSearchErrors"];
        echo '<div class="msg-box">';
        foreach ($errors as $e){
            //show errors to users
            echo '<div class="message-box box-error">';
            echo '<img src="icons/error.png" alt="MsgError">';
            echo '<p class="form-error">' . $e .'</p>';
            echo '</div>';
        }
        echo '</div>';
        unset($_SESSION["prodSearchErrors"]); //unset global variable, more data entries
    } else if (isset($_GET["result"])) {
        // Check the value of $_GET["result"] and display corresponding messages
        if ($_GET["result"] === "found") {
            echo '<div class="msg-box">';
            echo '<div class="message-box box-success">';
            echo '<img src="icons/ok.png" alt="Success">';
            echo '<p class="form-success">¡Se encontró el producto!</p>';
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
            echo '</div>';
        } else if ($_GET["result"] === "categoryNOTfound") {
            echo '<div class="msg-box">';
            echo '<div class="message-box box-warning">';
            echo '<img src="icons/warning.png" alt="Warning">';
            echo '<p class="form-error">¡No existe esa categoría!</p>';
            echo '</div>';
            echo '</div>';
        }
    }
}


function searchInputs() {
    if(isset($_SESSION['busqueda']['criteria']) && isset($_GET['result']) && (($_GET['result'] === 'found') || $_GET['result'] === 'idNOTfound' || $_GET['result'] === 'keywordsNOTfound' || $_GET['result'] === 'categoryNOTfound')){
            echo' <select id="searchCriteria" name="searchCriteria">
                <option value="id" '. ($_SESSION['busqueda']['criteria'] === 'id' ? 'selected' : '') .'>ID Poducto</option>
                <option value="keywords" '. ($_SESSION['busqueda']['criteria'] === 'keywords' ? 'selected' : '') .'>Nombre</option>
                <option value="category" '. ($_SESSION['busqueda']['criteria'] === 'category' ? 'selected' : '') .'>Categoria</option>
            </select>';
    } else {
        echo' <select id="searchCriteria" name="searchCriteria">
            <option value="id">ID Poducto</option>
            <option value="keywords">Nombre</option>
            <option value="category">Categoria</option>
            </select>';
    }

    if(isset($_SESSION['busqueda']['query']) && isset($_GET['result']) && (($_GET['result'] === 'found') || $_GET['result'] === 'idNOTfound' || $_GET['result'] === 'keywordsNOTfound' || $_GET['result'] === 'categoryNOTfound')){
        echo '<input type="text" id="searchQuery" name="searchQuery" placeholder="Buscar..." value="'. htmlspecialchars((string)$_SESSION['busqueda']['query']) .'">';
    } else {
        echo '<input type="text" id="searchQuery" name="searchQuery" placeholder="Buscar...">';
    }
}


function showProductosTable(object $pdo) {
    if(!isset($_GET["result"])) {    
        $result = productosSelect($pdo);

        foreach($result as $row) {
            echo '<tr>';

            echo '<td>';
            // link to refill form with this row's data
            echo '<a href="editar_producto.php?id_producto='.htmlspecialchars(strval($row['id_producto'])).'">
                <img src="icons/pen.png" alt="Edit" />
            </a>';
            echo '</td>';
            echo '<td>';
            echo '<a href="includes/eliminar_producto.inc.php?id_producto='.htmlspecialchars(strval($row['id_producto'])).'">
                <img src="icons/bin.png" alt="Delete" />
            </a>';
            echo '</td>';

            echo '<td>' . htmlspecialchars(strval($row['id_producto'])) . '</td>';
            echo '<td>' . htmlspecialchars($row['nombre_producto']) . '</td>';
            echo '<td>' . htmlspecialchars($row['descripccion']) . '</td>';
            echo '<td>' . htmlspecialchars($row['material_producto']) . '</td>';
            echo '<td>' . htmlspecialchars($row['categoria_producto']) . '</td>';
            echo '<td>' . htmlspecialchars(strval($row['cantidad_invetario'])) . '</td>';
            echo '<td>' . htmlspecialchars(strval($row['precio_unitario_tienda'])) . '</td>';
            echo '<td>' . htmlspecialchars(strval($row['id_proveedor'])) . '</td>';
            echo '<td>' . htmlspecialchars(strval($row['nombre_proveedor'])) . '</td>';

            echo '</tr>';
        }
    } else if((isset($_GET['result'])) && ($_GET['result'] === 'found') && isset($_SESSION['busqueda'])) {

        $userInput = $_SESSION['busqueda']['query'];

        if($_GET['criteria'] === 'category') {
            $result = searchProductCategory($pdo, $userInput);
        }
        
        if($_GET['criteria'] === 'keywords') {
            $result = searchProductKeywords($pdo, $userInput);
        }

        if($_GET['criteria'] === 'category' || $_GET['criteria'] === 'keywords') {
            foreach($result as $row) {
                echo '<tr>';

                echo '<td>';
                // link to refill form with this row's data
                echo '<a href="editar_producto.php?id_producto='.$row['id_producto'].'">
                    <img src="icons/pen.png" alt="Edit" />
                </a>';
                echo '</td>';
                echo '<td>';
                echo '<a href="includes/eliminar_producto.inc.php?id_producto='.$row['id_producto'].'">
                    <img src="icons/bin.png" alt="Delete" />
                </a>';
                echo '</td>';

                echo '<td>' . htmlspecialchars(strval($row['id_producto'])) . '</td>';
                echo '<td>' . htmlspecialchars($row['nombre_producto']) . '</td>';
                echo '<td>' . htmlspecialchars($row['descripccion']) . '</td>';
                echo '<td>' . htmlspecialchars($row['material_producto']) . '</td>';
                echo '<td>' . htmlspecialchars($row['categoria_producto']) . '</td>';
                echo '<td>' . htmlspecialchars(strval($row['cantidad_invetario'])) . '</td>';
                echo '<td>' . htmlspecialchars(strval($row['precio_unitario_tienda'])) . '</td>';
                echo '<td>' . htmlspecialchars(strval($row['id_proveedor'])) . '</td>';
                echo '<td>' . htmlspecialchars(strval($row['nombre_proveedor'])) . '</td>';
               
                echo '</tr>';
            }
        } else if ($_GET['criteria'] === 'id'){
            $result = searchProductoID($pdo, $userInput);
            echo '<tr>';
            echo '<td>';
                // link to refill form with this row's data
                echo '<a href="editar_producto.php?id_producto='.$result['id_producto'].'">
                    <img src="icons/pen.png" alt="Edit" />
                </a>';
                echo '</td>';
                echo '<td>';
                echo '<a href="includes/eliminar_producto.inc.php?id_producto='.$result['id_producto'].'">
                    <img src="icons/bin.png" alt="Delete" />
                </a>';
            echo '</td>';

            echo '<td>' . htmlspecialchars(strval($result['id_producto'])) . '</td>';
            echo '<td>' . htmlspecialchars($result['nombre_producto']) . '</td>';
            echo '<td>' . htmlspecialchars($result['descripccion']) . '</td>';
            echo '<td>' . htmlspecialchars($result['material_producto']) . '</td>';
            echo '<td>' . htmlspecialchars($result['categoria_producto']) . '</td>';
            echo '<td>' . htmlspecialchars(strval($result['cantidad_invetario'])) . '</td>';
            echo '<td>' . htmlspecialchars(strval($result['precio_unitario_tienda'])) . '</td>';
            echo '<td>' . htmlspecialchars(strval($result['id_proveedor'])) . '</td>';
            echo '<td>' . htmlspecialchars(strval($result['nombre_proveedor'])) . '</td>';

            echo '</tr>';
        }
    }
    unset($_SESSION['busqueda']);
    unset($_GET['result']);
    unset($_GET['criteria']);
}

function productDeleteSuccess() {
    // Check if the deletion message exists in the session
    if (isset($_GET['id_producto']) && isset($_GET['productDeleted'])) {
        echo '<div class="msg-box">';
            echo '<div class="message-box box-success">';
                echo '<img src="icons/ok.png" alt="Success">';
                echo '<p class="form-success">'. '¡El producto con el ID #'. htmlspecialchars($_GET['id_producto']) .' fue eliminado!' .'</p>';
            echo '</div>';
        echo '</div>';
    }
    unset($_GET['id_producto']);
    unset($_SESSION['message']);
    unset($_GET['confirm_delete']);
}

function confirmDeleteProductOperation() {
    if(isset($_GET['id_producto']) && isset($_GET['confirm_delete'])) {
        echo '<div class="msg-box">';
            echo '<div class="message-box-delete box-delete">';
                echo '<div class="msg-buttons">';
                    echo '<div class="icon-msg">';
                        echo '<img src="icons/warning.png" alt="Warning">';
                        echo '<p class="form-error">¿Está seguro de que desea eliminar el producto con el ID #'. $_GET['id_producto'] .' y su historial en transacciones?</p>';
                    echo '</div>';

                    echo '<div class="button-container-yes-no">';

                        echo '<div class="btnYes">';
                        echo '<button type="button" id="yesDelete">
                        <a href="includes/confirm_delete.inc.php?id_producto='.$_GET['id_producto'].'">Sí</a>
                        </button>';
                        echo '</div>';
                        
                        echo '<div class="btnNo">';
                        echo '<button type="button" id="yesDelete">
                            <a href="productos.php" class="btn-no">No</a>
                        </button>';
                    echo '</div>';

                echo '</div>';
            echo '</div>';
        echo '</div>';
    }
}
