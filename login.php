<?php
include_once 'core/init.php';
logged_in_redirect();
include_once 'core/functions/users.php';


if (empty($_POST) === false) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    if (empty($username) === true || empty($password) === true) {
       $errors[] = 'login error'; 
    } else if (user_exists($username) === false) {
       $errors[] = 'no such user';   
    } else if (user_active($username) === false) {
       $errors[] = 'user not active';
    } else {
       $login = login($username, $password);
        if ($login === false) {
           $errors[] = 'wrong password';
       } else {
           $_SESSION['user_id'] = $login;
           header('Location: index.php');
           echo 'przekierowanie do index';
           exit();
           }
            
    }
} else {
$errors[]= 'no data received';
}    
include_once 'includes/overall/overall_header.php';    
echo output_errors($errors);
include_once 'includes/overall/overall_footer.php';   
?>