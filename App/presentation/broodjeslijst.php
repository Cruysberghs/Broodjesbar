<?php
include_once('../business/broodjeService.php');
include_once('../business/bestelService.php');
include_once('header.php');

$broodjeService = new BroodjeService();
$bestellingen = new Bestellingen();

// Haal broodjes op
$broodjes = $broodjeService->toonAlleBroodjes();

// Verwerk het bestelverzoek als de bestelknop is ingedrukt
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['bestel_btn'])) {
    // Controleer of broodje ID is ingesteld
    if (isset($_POST['broodje_id'])) {
        $broodje_id = $_POST['broodje_id'];
        // Controleer of de klant is ingelogd
        session_start();
        if (isset($_SESSION['logged_in'])) {
            // Haal de KlantID op uit de sessie
            $klant_id = $_SESSION['klantID'];
            // Voeg de bestelling toe aan de database
            $succesmelding = $bestellingen->plaatsBestelling($broodje_id, $klant_id);
            echo $succesmelding;
        } else {
            // Toon een foutmelding als de klant niet is ingelogd
            $melding = "U moet ingelogd zijn om een bestelling te plaatsen.";
        }
    } else {
        // Toon een foutmelding als broodje ID niet is ingesteld
        $melding = "Fout bij het bestellen van het broodje.";
    }
}

?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lijst met broodjes</title>
    <link rel="stylesheet" href="stijlen.css">
<body>

<main>
    <h2>Lijst met broodjes:</h2>
    <!-- Toon eventuele meldingen -->
    <?php if (isset($melding)) : ?>
        <p><?php echo $melding; ?></p>
    <?php endif; ?>
    <table>
        <thead>
            <tr>
                <th>Naam</th>
                <th>Omschrijving</th>
                <th>Prijs (euro)</th>
                <th>Bestel</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($broodjes as $broodje): ?>
                <tr>
                    <td><?php echo $broodje->getBroodjeNaam(); ?></td>
                    <td><?php echo $broodje->getOmschrijving(); ?></td>
                    <td><?php echo $broodje->getPrijs(); ?></td>
                    <td>
                        <form method="post">
                            <input type="hidden" name="broodje_id" value="<?php echo $broodje->getId(); ?>">
                            <input type="submit" name="bestel_btn" value="Bestel">
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>

</body>
</html>