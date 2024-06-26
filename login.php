<?php


session_start();

// Vérifier si l'utilisateur est déjà connecté, rediriger vers la page d'accueil si c'est le cas
if (isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

// Vérifier si le formulaire de connexion a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validation minimale 
    if (!empty($email) && !empty($password)) {
        // Connexion à la base de données
        try {
            $pdo = new PDO('mysql:host=localhost;dbname=votre_base_de_donnees', 'votre_utilisateur', 'votre_mot_de_passe');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Requête pour récupérer l'utilisateur par son email (username)
            $stmt = $pdo->prepare('SELECT id, password, role_id FROM users WHERE email = :email');
            $stmt->execute(['email' => $email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // Vérifier si l'utilisateur existe et le mot de passe correspond
            if ($user && password_verify($password, $user['password'])) {
                // Récupérer le rôle de l'utilisateur
                $role_id = $user['role_id'];

                // Vérifier si le rôle permet la connexion (administrateur, vétérinaire, employé)
                if (in_array($role_id, [1, 2, 3])) { // Exemple : 1 = administrateur, 2 = vétérinaire, 3 = employé
                    // Authentification réussie, enregistrer l'ID de l'utilisateur en session
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['role_id'] = $role_id;

                    // Redirection vers la page d'accueil après la connexion réussie
                    header('Location: index.php');
                    exit;
                } else {
                    // Rôle non autorisé à se connecter
                    $error = "Vous n'avez pas les droits nécessaires pour vous connecter.";
                }
            } else {
                // Identifiants incorrects
                $error = "Adresse email ou mot de passe incorrect.";
            }
        } catch (PDOException $e) {
            $error = 'Erreur de connexion à la base de données : ' . $e->getMessage();
        }
    } else {
        // Champ(s) manquant(s)
        $error = "Veuillez remplir tous les champs.";
    }
}
