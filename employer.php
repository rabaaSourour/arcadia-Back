
<?php
session_start();

// Vérifiez si l'utilisateur est connecté et est un employé
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'employee') {
    header('Location: login.html');
    exit;
}

// Connexion à la base de données
require 'config.php';
$pdo = new PDO('mysql:host=localhost;dbname=arcadia', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Récupération des avis, services et animaux
$reviews = $pdo->query('SELECT * FROM reviews')->fetchAll(PDO::FETCH_ASSOC);
$services = $pdo->query('SELECT * FROM services')->fetchAll(PDO::FETCH_ASSOC);
$animals = $pdo->query('SELECT * FROM animals')->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Tableau de bord de l'employé</title>
</head>
<body>
    <h1>Tableau de bord de l'employé</h1>

    <h2>Gestion des avis</h2>
    <table>
        <tr>
            <th>Contenu</th>
            <th>Validé</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($reviews as $review): ?>
        <tr>
            <td><?= htmlspecialchars($review['content']) ?></td>
            <td><?= $review['is_validated'] ? 'Oui' : 'Non' ?></td>
            <td>
                <form action="update_review.php" method="POST">
                    <input type="hidden" name="id" value="<?= $review['id'] ?>">
                    <select name="is_validated">
                        <option value="1" <?= $review['is_validated'] ? 'selected' : '' ?>>Valider</option>
                        <option value="0" <?= !$review['is_validated'] ? 'selected' : '' ?>>Invalider</option>
                    </select>
                    <button type="submit">Mettre à jour</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

    <h2>Gestion des services</h2>
    <table>
        <tr>
            <th>Nom</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($services as $service): ?>
        <tr>
            <td><?= htmlspecialchars($service['name']) ?></td>
            <td><?= htmlspecialchars($service['description']) ?></td>
            <td>
                <form action="update_service.php" method="POST">
                    <input type="hidden" name="id" value="<?= $service['id'] ?>">
                    <input type="text" name="name" value="<?= htmlspecialchars($service['name']) ?>">
                    <textarea name="description"><?= htmlspecialchars($service['description']) ?></textarea>
                    <button type="submit">Mettre à jour</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

    <h2>Enregistrement de la consommation de nourriture</h2>
    <form action="add_food_record.php" method="POST">
        <label for="animal_id">Animal:</label>
        <select name="animal_id" id="animal_id">
            <?php foreach ($animals as $animal): ?>
            <option value="<?= $animal['id'] ?>"><?= htmlspecialchars($animal['name']) ?></option>
            <?php endforeach; ?>
        </select>
        <label for="date">Date:</label>
        <input type="date" name="date" id="date">
        <label for="time">Heure:</label>
        <input type="time" name="time" id="time">
        <label for="food">Nourriture:</label>
        <input type="text" name="food" id="food">
        <label for="quantity">Quantité:</label>
        <input type="number" step="0.01" name="quantity" id="quantity">
        <button type="submit">Enregistrer</button>
    </form>
</body>
</html>
