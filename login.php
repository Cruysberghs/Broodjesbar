<?php
session_start(); // Start de sessie

include('app\business\userService.php');
include('app\presentation\header.php');

$users = new Users();

// Verwerk het inlogverzoek als het formulier is ingediend
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['email']) && isset($_POST['wachtwoord'])) {
    $melding = $users->login($_POST['email'], $_POST['wachtwoord']);

    // Als het inloggen succesvol is, sla de gebruikersgegevens op in de sessie en cookie
    if ($melding === "Inloggen succesvol!") {
        $_SESSION['logged_in'] = true;
        $_SESSION['email'] = $_POST['email'];
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Inloggen</title>
    <link rel="stylesheet" type="text/css" href="app/presentation/stijlen.css">
</head>
<body>

<h2>Inloggen</h2>

<div class="melding">
<?php
// Toon eventuele meldingen van het inloggen
if (isset($melding)) {
    echo $melding;
    var_dump($_POST);
}
?>
</div>

<div class="form">
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="email">E-mailadres:</label><br>
    <input type="email" id="email" name="email" value="<?php echo isset($_SESSION['email']) ? $_SESSION['email'] : ''; ?>"><br>
    <label for="wachtwoord">Wachtwoord:</label><br>
    <input type="password" id="wachtwoord" name="wachtwoord"><br><br>
    <input type="submit" value="Inloggen">
</form>
</div>

</body>
</html>