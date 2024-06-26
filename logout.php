<?php

session_start();
session_destroy();

// Redirection vers la page de connexion après déconnexion
header('Location: login.html');
exit;
?>
