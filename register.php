<?php 
include 'core/init.php';
logged_in_redirect();
include 'includes/overall/overall_header.php'; 

if (empty($_POST) === false) {
   $required_fields = array('username', 'password', 'repeatpassword', 'email');
   foreach($_POST as $key=>$value) {
       if (empty($value) && in_array($key, $required_fields) === true) {
         $errors[] = 'wypełnij wszystkie pola rejestracji';  
         break 1;
       }
   }
   if (empty($errors) === true) {
        if(user_exists($_POST['username']) === true) {
           $errors[] = 'takiego użytkownika już mamy'; 
        }
        if (preg_match('/\\s/', $_POST['username']) ===true) {
            $errors[] = 'żadnych spacji w nazwie użykownika';
        }
        if ((strlen($_POST['password']) < 6) || (strlen($_POST['password']) > 32)) {
            $errors[] = 'nieodpowiednia długość hasła';
        }
        if ($_POST['password'] !== $_POST['repeatpassword']) {
            $errors[] = 'hasła nie pasują';
        }
        if (email_in_db($_POST['email']) == true) {
            $errors[] = 'email jest zajęty';
        }
        
   }
}

?>        
<h1>Rejestracja</h1>
<?php
if (isset($_GET['succes']) && empty($_GET['succes'])) {
    echo 'rejestracja pomyślna';
} else {
    if(empty($_POST) === false && empty($errors) === true) {
    $register_data = array(
    'username' => $_POST['username'],
    'password' => $_POST['password'],
    'email'    => $_POST['email']
    );
    register_user($register_data);
    header('Location: register.php?succes');
    exit();
} else if (empty($errors) === false) {
    echo output_errors($errors);
    }

?>
<form action='register.php' method='post'>
<ul>
    <li>
    Nazwa użytkownika:<br>
    <input type='text' name='username'>
    </li>
    <li>
    Hasło:<br>
    <input type='password' name='password'>
    </li>
    <li>
    Powtórz hasło:<br>
    <input type='password' name='repeatpassword'>
    </li>
    <li>
    Email:<br>
    <input type='text' name='email'>
    </li>
    <li>
    <input type='submit' value='Zarejestruj się'>
    </li>
</ul>
</form>
<?php 
}
include 'includes/overall/overall_footer.php'; ?>



