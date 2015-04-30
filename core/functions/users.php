<?php
include_once 'core/database/connect.php';

function password_match($browser_password, $database_password){
    $browser_password = md5($browser_password);
    return ($browser_password == $database_password) ? true : false;
}

function register_user($register_data) {
    global $myConnection;
    array_walk($register_data, 'array_sanitize');
    $register_data['password'] = md5($register_data['password']);
    $fields = '`' . implode('`, `', array_keys($register_data)) . '`';
    
    $data = '\'' . implode('\', \' ', $register_data) . '\'';
    //echo "INSERT INTO `users` ($fields) VALUES ($data)";
    //die();
    $query = $myConnection->query("INSERT INTO `users` ($fields) VALUES ($data)");
}

function email_in_db($email) {
    global $myConnection;
    $email = sanitize($email);
    $query = $myConnection->query("SELECT * FROM users WHERE email = '$email'");
    $row = mysqli_num_rows($query);
    return ($row != 0) ? true : false;
    
}

function user_count() {
    global $myConnection;
    $data = $myConnection->query("SELECT COUNT('userid') FROM users WHERE aktywny = '1'");
    $result = mysqli_fetch_assoc($data);
    $count = $result["COUNT('userid')"];
    return $count;
}

function user_data($user_id) {
   global $myConnection;
   $data = array();
$user_id = (int)$user_id;   
$func_num_args = func_num_args();
$func_get_args = func_get_args();

    if($func_num_args > 1) {
        unset($func_get_args[0]);
        $fields = '`' . implode('`, `', $func_get_args) . '`';
        $data = $myConnection->query("SELECT $fields FROM users WHERE userid = '$user_id'");
        $result = mysqli_fetch_assoc($data);
        return $result;
    }
    
}

function user_exists($username) {
    global $myConnection;
    $username = sanitize($username);
	$query = $myConnection->query("SELECT * FROM users WHERE Username = '$username'");
    $row = mysqli_num_rows($query);
    return ($row != 0) ? true : false;
    
}

function user_active($username) {
    global $myConnection;
    $username = sanitize($username);
	$result = $myConnection->query("SELECT COUNT(*) FROM `users` WHERE Username = '$username' AND Aktywny = 1");
    $row = mysqli_fetch_assoc($result);
    if ($row["COUNT(*)"]==1) {
        return true;
    }else{
    return false;
    }
}

function user_id_from_username($username) {
    echo 'got to user id';
    $username = sanitize($username);
    global $myConnection;
    $result = $myConnection->query("SELECT userid from users where username = '$username'");
    $user_id = mysqli_fetch_assoc($result);
    echo 'userid', $user_id['userid'];
    return $user_id['userid'];
}
function login($username, $password) {
    echo 'got to login function';
    $user_id = user_id_from_username($username);
    $password = md5($password);
    global $myConnection;
    $result = $myConnection->query("select COUNT('userid') from users where username = '$username' and password = '$password'");
    $row = mysqli_fetch_row($result);
    return (!$row == 0) ? $user_id : false;
    }
    
function logged_in() {
    return (isset($_SESSION['user_id'])) ? true : false;
}


?> 

