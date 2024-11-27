<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Art Log</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Fira+Code&display=swap">
    <link rel="stylesheet" href="css/nav_style.css">
    <link rel="stylesheet" href="css/header_admin.css">
</head>
<body>
    <header class="header">
        <!-- logo and title -->
        <div class="logo">
            <img src="icons/artlog.png" alt="Logo">
            <div class="title">ArtLog</div>
        </div>
        
        <!-- navigation bar -->
        <nav class="nav-bar">
            <ul>
                <li>
                    <div class="title-icon"> 
                        <a href="home.php">
                            <img src="icons/home.png" alt="Home">
                            <p>Página principal</p>
                        </a> 
                    </div>
                </li>

                <li class="dropdown">
                    <div class="title-icon">
                        <a href="javascript:void(0)" class="dropbtn"><img src="icons/edit.png" alt="Form">
                        <p>Inventarios</p>
                        </a>
                    </div>
                    <div class="dropdown-content">
                        <a href="proveedores.php">Proveedores</a>
                        <a href="productos.php">Productos</a>
                        <a href="transacciones.php">Transacciones</a>
                        <a href="clientes.php">Clientes</a>
                    </div>
                    
                </li>

                <li>
                    <div class="title-icon"> 
                        <a href="administrar_usuarios.php">
                            <img src="icons/admin.png" alt="Home">
                            <p>Administrar usuarios</p>
                        </a> 
                    </div>
                </li>
                
                <li class="dropdown">
                    <div class="title-icon">
                        <a href="#home" class="dropbtn"><img src="icons/user.png" alt="Home">
                        <p>Perfil</p>
                        </a>
                    </div>
                    <div class="dropdown-content">
                        <a href="includes/logout.inc.php">Cerrar Sesión</a>
                    </div>
                </li>
            </ul>
        </nav>
    </header>
</body>
</html>
