<?php
include_once('app/business/userService.php');
include('app/presentation/header.php');

$users = new Users();

// Verwerk het registratieverzoek als het formulier is ingediend
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $naam = $_POST['naam'];
    $voornaam = $_POST['voornaam']; 
    $email = $_POST['email'];
    $wachtwoord = $_POST['wachtwoord'];
    $herhaal_wachtwoord = $_POST['herhaal_wachtwoord'];

    if ($wachtwoord === $herhaal_wachtwoord) {
        // Controleer of de gebruiker al bestaat
        if ($users->gebruikerBestaat($email)) {
            // Gebruiker bestaat al, toon een melding
            $melding = "Gebruiker bestaat al.";
        } else {
            // Voeg de gebruiker toe
            $klant_id = $users->toevoegenOfBijwerkenKlant($naam, $voornaam, $email, $wachtwoord);
            if ($klant_id) {
                // Registratie succesvol
                $melding = "Registratie succesvol! Klant ID: " . $klant_id; // Toon het klant-ID
            } else {
                // Er is een fout opgetreden tijdens de registratie
                $melding = "Er is een fout opgetreden tijdens de registratie.";
            }
        }
    } else {
        // Wachtwoord en herhaalde wachtwoord komen niet overeen
        $melding = "Wachtwoord en herhaal wachtwoord komen niet overeen.";
    }

    // Toon de melding aan de gebruiker
    echo $melding;
    var_dump($_POST);
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Registratie</title>
    <link rel="stylesheet" type="text/css" href="app/presentation/stijlen.css">
</head>
<body>

<h2>Registratie</h2>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="naam">Achternaam:</label><br>
    <input type="text" id="naam" name="naam"><br>
    <label for="voornaam">Voornaam:</label><br>
    <input type="text" id="voornaam" name="voornaam"><br>
    <label for="email">E-mailadres:</label><br>
    <input type="email" id="email" name="email"><br>
    <label for="wachtwoord">Wachtwoord:</label><br>
    <input type="password" id="wachtwoord" name="wachtwoord"><br>
    <label for="herhaal_wachtwoord">Herhaal wachtwoord:</label><br>
    <input type="password" id="herhaal_wachtwoord" name="herhaal_wachtwoord"><br><br>
    <input type="submit" value="Registreren">
</form>

</body>
</html>