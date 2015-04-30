<?php

function logged_in_redirect() {
    if(logged_in() === true) {
        header('Location: index.php');
        exit();
    }
}

function protect_page() {
    if (logged_in() === false) {
        header('Location: protected.php');
        exit();
    }
}

function array_sanitize($item) {
    global $myConnection;
    $item = mysqli_real_escape_string($myConnection, $item);
}

function sanitize($data) {
   global $myConnection;
   return mysqli_real_escape_string($myConnection, $data); 
}

function output_errors($errors) {
    $output = array();
    foreach($errors as $error) {
        $output[] = '<li>'. $error . '</li>';
    }
    return '<ul>' . implode('', $output) . '</ul>';
}
?>