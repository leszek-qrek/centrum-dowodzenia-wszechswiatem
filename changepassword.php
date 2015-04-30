<?php 
include 'core/init.php';
protect_page();

if(empty($_POST) === false) {
     $required_fields = array('current_password', 'password', 'repeat_password');
     foreach($_POST as $key=>$value) {
         echo $key, $value. '<br>';
       if (empty($value) && in_array($key, $required_fields) === true) {
         $errors[] = 'należy wypełnić wszyskie pola rejestracji';  
         break 1;
       }
 } 
 echo md5($_POST['current_password']);
 echo '<br>';
 echo $user_data['password'];
if (password_match($_POST['current_password'], $user_data['password'])) {
    echo 'password match';
}   else {
    echo 'passwords dont match';
}
    if (password_match($_POST['current_password'], $user_data['password'])) {
        
        echo 'sprawdzone w bazie i sie zgadza';
        if (trim($_POST['password']) != trim($_POST["repeat_password"])) {
            echo 'hasła się nie zgadzają';
            $errors[] = 'hasło i powtórzone hasło nie zgadzają się';
        } else if(strlen($_POST['password']) < 6 || strlen($_POST['password']) > 32) {
            echo 'długość dodupy';
            $errors[] = 'hasło nie krótsze niż 6 znaków i nie dłuższe niż 32 znaki';    
        }
    } else {
        $errors[] = 'złe hasło';
    }
    print_r($errors);
    
} 

include 'includes/overall/overall_header.php'; 
?>       
<h1>Zmień hasło</h1>

<form action='' method='post'>
    <ul>
        <li>
            Aktualne hasło:<br>
            <input type='password' name='current_password'>
        </li>
        <li>
            Nowe hasło:<br>
            <input type='password' name='password'>
        </li>
        <li>
            Powtórz hasło:<br>
            <input type='password' name='repeat_password'>
        </li>
        <li>
            <input type='submit' value='zmień hasło'>
        </li>
    </ul>
</form>
<?php include 'includes/overall/overall_footer.php'; ?>
