<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier les horaires d'ouverture du Zoo</title>
    <link rel="stylesheet" href="../arcadia-front/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h1 class="mt-5">Modifier les horaires d'ouverture du Zoo</h1>
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $updated_hours = $_POST['hours'];
        file_put_contents('hours.json', json_encode($updated_hours));
        header('Location:../arcadia-front/pages/home.html ');
        exit;
    }

    $hours = json_decode(file_get_contents('hours.json'), true);
    ?>
    <form action="edit_hours.php" method="post" class="mt-3">
        <?php foreach ($hours as $day => $hour): ?>
            <div class="form-group">
                <label for="<?= $day ?>"><?= ucfirst($day) ?></label>
                <input type="text" class="form-control" id="<?= $day ?>" name="hours[<?= $day ?>]" value="<?= $hour ?>">
            </div>
        <?php endforeach; ?>
        <button type="submit" class="btn btn-primary">Enregistrer</button>
        <a href="../arcadia-front/pages/home.html" class="btn btn-secondary">Annuler</a>
    </form>
</div>
</body>
</html>
