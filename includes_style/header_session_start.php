<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Art Log</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Fira+Code&display=swap">
    <link rel="stylesheet" href="css/nav_style.css">
    <link rel="stylesheet" href="css/header_home.css">
</head>
<body>
    <header class="header">
        <!-- logo and title -->
        <div class="logo">
            <img src="icons/artlog.png" alt="Logo">
            <div class="title">ArtLog</div>
        </div>
        
        <!-- navigation bar -->
        <?php if(isset($_GET['tipo'])) {?>
        <nav class="nav-bar">
            <ul>
                <li>
                <div class="title-icon"> 
                    <a href="index.php">
                        <img src="icons/accessibility.png" alt="Home">
                        <p>Acceso General</p>
                    </a> 
                </div>
                </li>
            </ul>
        </nav>

        <?php } ?>
    </header>
</body>
</html>
