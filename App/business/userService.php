<?php
include_once('app/database/connectie.php');

class Users {
    private $conn;

    public function __construct() {
        $this->conn = getDatabaseConnection();
    }

    public function toevoegenOfBijwerkenKlant($voornaam, $achternaam, $email, $wachtwoord) {
        // Voeg de gebruiker toe aan de database
        $insert_stmt = $this->conn->prepare("INSERT INTO klanten (voornaam, achternaam, email, wachtwoord) VALUES (?, ?, ?, ?)");
        $insert_stmt->bind_param("ssss", $voornaam, $achternaam, $email, $wachtwoord);
        $insert_stmt->execute();
    
        // Haal de ID van de ingevoegde klant op
        $klant_id = $insert_stmt->insert_id;
    
        return $klant_id;
    }

    public function gebruikerBestaat($email) {
        // Controleer of de gebruiker al bestaat in de database
        $stmt = $this->conn->prepare("SELECT klantID FROM klanten WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->num_rows > 0;
    }

    public function login($email, $wachtwoord) {
        // Controleer of de gebruiker bestaat in de database
        $stmt = $this->conn->prepare("SELECT klantID, email, wachtwoord FROM klanten WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
    
        // Als de gebruiker niet bestaat, geef een foutmelding terug
        if ($result->num_rows === 0) {
            $melding = "Ongeldige gebruikersnaam of wachtwoord";
        }
    
        // Haal de gebruikersgegevens op
        $user = $result->fetch_assoc();
    
        // Controleer of het wachtwoord overeenkomt
        if ($wachtwoord === $user['wachtwoord']) {
            // Het wachtwoord komt overeen, de gebruiker is ingelogd
            // Voeg KlantID toe aan de sessievariabelen
            $_SESSION['klantID'] = $user['klantID'];
    
            // Geef eventueel een succesmelding terug
            $melding = "Inloggen succesvol!";
            return $melding;
        } else {
            // Het wachtwoord komt niet overeen, geef een foutmelding terug
            $melding = "Ongeldig wachtwoord";
            return $melding;
        }
    }    

    public function getUser($klantID) {
        // Haal de gebruiker op basis van het klantID uit de database
        $stmt = $this->conn->prepare("SELECT * FROM klanten WHERE klantID = ?");
        $stmt->bind_param("i", $klantID); // 'i' staat voor integer
        $stmt->execute();
        $result = $stmt->get_result();
    
        // Controleer of de gebruiker is gevonden
        if ($result->num_rows === 1) {
            // Gebruiker gevonden, retourneer de gegevens als een associatieve array
            return $result->fetch_assoc();
        } else {
            // Gebruiker niet gevonden, retourneer false of een foutmelding
            return false;
        }
    }
    
}
?>
