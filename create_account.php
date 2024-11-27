<?php
require_once 'includes/config_session.inc.php';
require_once 'includes/signup_view.inc.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <!-- <link rel="stylesheet" href="css/reset.css"> -->
    <link rel="stylesheet" href="css/form.css">
    <style>
        .img-txt {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: 100%;
        }

        .img-txt img {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <?php include("includes_style/header_session_start.php") ?>

    <main class="container">
        <div class="box form-box">
            <div class="img-txt">
                    <img src="icons/register.png" alt="Admin">
                    <header>Registro</header>
            </div>
            
            <form id="signupForm" action="includes/signup.inc.php" method="post" autocomplete="off">
                <?php
                signup_inputs();
                ?>

                <div class="field submit">
                    <div class="button-submit">
                        <button type="submit" class="btn" name="btnRegistrar" value="ok"><img src="icons/document.png" alt="Registar Usuario"><p>Registrar Usuario</p></button>
                    </div>
                </div>
            </form>
            <div class="links">
                ¿Ya tiene una cuenta? <a href="index.php">Inicie sesión</a>
            </div>
            <div class="signup-status">
                <?php
                    check_signup_errors();
                ?>
            </div>
            <!-- JS to check -->
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                const passwordInput = document.getElementById('pass1');
                const lengthReq = document.getElementById('lengthReq');
                const lowerReq = document.getElementById('lowerReq');
                const upperReq = document.getElementById('upperReq');
                const specialReq = document.getElementById('specialReq');
                const digitReq = document.getElementById('digitReq');

                passwordInput.addEventListener('input', function() {
                    const password = passwordInput.value;

                    // Check password length
                    if (password.length >= 10 && password.length <= 15) {
                        lengthReq.textContent = '✔ entre 10 y 15 caracteres';
                        lengthReq.classList.add('valid');
                        lengthReq.classList.remove('invalid');
                    } else {
                        lengthReq.textContent = '❌ entre 10 y 15 caracteres';
                        lengthReq.classList.add('invalid');
                        lengthReq.classList.remove('valid');
                    }

                    // Check for lowercase letters
                    if (/[a-z]/.test(password)) {
                        lowerReq.textContent = '✔ al menos una letra minúscula';
                        lowerReq.classList.add('valid');
                        lowerReq.classList.remove('invalid');
                    } else {
                        lowerReq.textContent = '❌ al menos una letra minúscula';
                        lowerReq.classList.add('invalid');
                        lowerReq.classList.remove('valid');
                    }

                    // Check for uppercase letters
                    if (/[A-Z]/.test(password)) {
                        upperReq.textContent = '✔ al menos una letra mayúscula';
                        upperReq.classList.add('valid');
                        upperReq.classList.remove('invalid');
                    } else {
                        upperReq.textContent = '❌ al menos una letra mayúscula';
                        upperReq.classList.add('invalid');
                        upperReq.classList.remove('valid');
                    }

                    // Check for special characters
                    if (/[^a-zA-Z0-9]/.test(password)) {
                        specialReq.textContent = '✔ al menos un carácter especial';
                        specialReq.classList.add('valid');
                        specialReq.classList.remove('invalid');
                    } else {
                        specialReq.textContent = '❌ al menos un carácter especial';
                        specialReq.classList.add('invalid');
                        specialReq.classList.remove('valid');
                    }

                    // Check for digits
                    if (/\d/.test(password)) {
                        digitReq.textContent = '✔ al menos un dígito (0-9)';
                        digitReq.classList.add('valid');
                        digitReq.classList.remove('invalid');
                    } else {
                        digitReq.textContent = '❌ al menos un dígito (0-9)';
                        digitReq.classList.add('invalid');
                        digitReq.classList.remove('valid');
                    }
                });
            });

            function togglePassword(id, btn) {
                const passwordField = document.getElementById(id);
                const eyeIcon = btn.querySelector('img');
                if (passwordField.type === 'password') {
                    passwordField.type = 'text';
                    eyeIcon.src = 'icons/hidden.png'; // Change to the closed eye icon
                    eyeIcon.alt = 'hide';
                } else {
                    passwordField.type = 'password';
                    eyeIcon.src = 'icons/eye.png'; // Change back to the open eye icon
                    eyeIcon.alt = 'view';
                }
            }

            </script>


        </div>
    </main>

    <?php include("includes_style/footer.php") ;?>    

</body>
</html>