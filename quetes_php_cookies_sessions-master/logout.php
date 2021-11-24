<?php require 'inc/head.php'; ?>
<?php
// Suppression de la session
session_unset();
session_destroy();

// Redirection vers la page de login
header('Location: http://localhost:8000/quetes_php_cookies_sessions-master/login.php');
?>
<?php require 'inc/foot.php'; ?>
