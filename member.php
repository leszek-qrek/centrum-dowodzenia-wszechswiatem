<?php

session_start();

if (!isset($_SESSION['username']))
    echo "Nie jestes zalogowany. <a href='hello.html'>Zaloguj się</a>";
    else
    echo "Bienvenidos a la fiesta, ".$_SESSION['username']."
<br>witaj na stronie dla członków<br><a href='logout.php'>Wyloguj się</a>";


?>