<?php

session_start();

if(isset($_SESSION['id']) && $_SESSION['admin'] == 1){
    echo true;
}
else{
    echo false;
}


?>