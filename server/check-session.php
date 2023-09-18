<?php

session_start();

if(isset($_SESSION['id'])){
    if($_SESSION['admin'] == 1){
        $user = array(
            'auth' => true,
            'admin' => 1,
            'name' => $_SESSION['name']
        );

        echo json_encode($user);
    }
    else{
        $user = array(
            'auth' => true,
            'admin' => 0,
            'name' => $_SESSION['name']
        );

        echo json_encode($user);
    }
}
else{
    $user = array(
        'auth' => false,
        'admin' => 0,
        'name' => null
    );
    echo json_encode($user);
}

?>