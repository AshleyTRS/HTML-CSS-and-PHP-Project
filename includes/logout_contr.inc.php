<?php

declare(strict_types=1);

function confirmSessionEnd(){
   if (outputMessageSessionEnd()){
    return true;
   } else {
    return false;
   }
}