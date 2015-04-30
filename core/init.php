<?php
session_start();
error_reporting(E_ALL);

require_once 'database/connect.php'; 
require_once 'functions/general.php';
require_once 'functions/users.php';
    if (logged_in() ===true) {
    $session_user_id = $_SESSION['user_id'];
    $user_data = user_data($session_user_id, 'userid', 'username', 'email', 'password', 'aktywny');
    if(user_active($user_data['username']) === false) {
    session_destroy();
    header('Location: index.php');
    echo 'zamykam sesje';
    exit();
    }
    }
    
    
$errors = array();

?>