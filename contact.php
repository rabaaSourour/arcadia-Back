<?php
// contact_submit.php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $email = $_POST['email'];

    $to = "zoo.arcadia1960@example.com"; 
    $subject = "Contact Form: $title";
    $message = "Vous avez reçu un nouveau message de contact.\n\n".
                "Détails:\n".
                "Titre: $title\n".
                "Description: $description\n".
                "Email: $email";
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";

    if (mail($to, $subject, $message, $headers)) {
        echo "Message envoyé avec succès.";
    } else {
        echo "Échec de l'envoi du message.";
    }
} else {
    echo "Méthode de requête non valide.";
}
