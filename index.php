<?php 
include 'core/init.php';
include 'includes/overall/overall_header.php';        
if (logged_in() === true) {
   echo 'jesteś zalogowany'; 
} else {
 echo "<h1>Home</h1>
<p>Zapraszamy do zalogowania się.</p>";
}

include 'includes/overall/overall_footer.php'; ?>






 