<?php


try {
    $pdo = new PDO('mysql:host=localhost;dbname=arcadia', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->query('SELECT nom_auteur, texte, chemin_image FROM rewiews');
    $avis = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo 'Erreur de connexion : ' . $e->getMessage();
}
