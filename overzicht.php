<?php
include_once('app/database/connectie.php');
include_once('app/business/bestelService.php');
include('app/presentation/header.php');

$bestelService = new Bestellingen();

session_start();
if (isset($_SESSION['klantID'])) {
    $klant_id = $_SESSION['klantID'];
} else {
    echo "Klant-id is niet ingesteld.";
    exit;
}

$bestellingen = $bestelService->toonAlleBestellingen($klant_id);

?>
<!DOCTYPE html>
<html>
<head>
    <title>Besteloverzicht</title>
    <link rel="stylesheet" type="text/css" href="app/presentation/stijlen.css">
</head>
<body>
<h2>Overzicht bestellingen:</h2>
<ul>
    <?php foreach ($bestellingen as $bestelling): ?>
        <li>
            <strong>Bestel ID:</strong> <?php echo $bestelling->getBestelID(); ?><br>
            <strong>Klant:</strong> <?php echo $bestelling->getUser(); ?><br>
            <strong>Broodje:</strong> <?php echo $bestelling->getBroodje(); ?><br>
        </li>
    <?php endforeach; ?>
</ul>
</body>
</html>
