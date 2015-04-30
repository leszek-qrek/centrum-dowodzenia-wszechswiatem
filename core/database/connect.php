<?php
$connect_error = 'nie udalo sie polaczyc z serwerem.';

$myConnection = new mysqli('localhost', 'root', '', 'cdw');
//echo $myConnection->connect_errno;
/*
if($myConnection->connect_errno) {
    die('$connect_error');
} else {
    echo "connection to db succesful";
}*/
?>