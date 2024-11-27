<?php

declare(strict_types=1);

function outputMessageSessionEnd() {
    /*using html
    echo '
    <div class="warningMsg">
        <header>¡Atención!</header>
        ¿Estás seguro de que quiere cerrar su sesión?
        <button class="btnYes">Yes</button>
        <button class="btnNo">No</button>
    </form>
    </div>
    ';*/
    //js
    echo '<script>
    if(window.confirm("¿Está seguro de que quiere cerrar su sesión?"){
        return true; //user want to end session 
    } else {
        return false; //user does not want to end session
    }
    </script>';
}