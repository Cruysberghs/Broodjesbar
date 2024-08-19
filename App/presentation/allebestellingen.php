<?php
include_once('../database/connectie.php');
include_once('../business/bestelService.php');
include_once('../entities/bestelling.php');
include_once('../entities/broodje.php');
include_once('../entities/user.php');

// Maak een instantie van Bestellingen
$bestelService = new Bestellingen();

// Haal alle bestellingen op
$bestellingen = $bestelService->toonAlleBestellingen();

?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alle bestellingen</title>
    <link rel="stylesheet" href="stijlen.css">
</head>
<body>
    <main>
        <h2>Alle bestellingen:</h2>
        <ul>
            <?php foreach ($bestellingen as $bestelling): ?>
                <li>
                    <strong>Bestel ID:</strong> <?php echo $bestelling->getBestelID(); ?><br>
                    <strong>Klant:</strong> <?php echo $bestelling->getUser(); ?><br>
                    <strong>Broodje:</strong> <?php echo $bestelling->getBroodje(); ?><br>
                </li>
            <?php endforeach; ?>
        </ul>
    </main>
</body>
</html>
