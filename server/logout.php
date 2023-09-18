<?php

session_start();
if(isset($_SESSION['id'])){
    session_unset();
    session_destroy();

    echo 1;
}
else{
    echo 0;
}



?>