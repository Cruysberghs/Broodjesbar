<?php
include_once(__DIR__ . '/../database/connectie.php');
include_once(__DIR__ . '/../entities/Bestelling.php');
include_once(__DIR__ . '/../presentation/header.php');

class Bestellingen {
    private $conn;

    public function __construct() {
        $this->conn = getDatabaseConnection();
    }

    public function plaatsBestelling($broodje_id, $klant_id) {
        // Voeg de bestelling toe aan de database
        $stmt = $this->conn->prepare("INSERT INTO bestellingen (broodjeID, klantID) VALUES (?, ?)");
        $stmt->bind_param("ii", $broodje_id, $klant_id);
        $stmt->execute();

        // Controleer of de bestelling succesvol is toegevoegd
        if ($stmt->affected_rows > 0) {
            return "Broodje is succesvol besteld! Smakelijk.";
        } else {
            return "Fout bij het bestellen van het broodje: " . $this->conn->error;
        }
    }
    
    public function toonAlleBestellingen() {
        $bestellingen = [];
    
        // Query om alle bestellingen uit de database te halen
        $sql = "SELECT bestellingen.bestelID, bestellingen.broodjeID, klanten.voornaam, klanten.achternaam, broodjes.Naam AS broodje_naam
        FROM bestellingen
        LEFT JOIN klanten ON bestellingen.klantID = klanten.klantID
        LEFT JOIN broodjes ON bestellingen.broodjeID = broodjes.ID";
        $result = $this->conn->query($sql);
    
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $klantNaam = $row["voornaam"] . " " . $row["achternaam"];
                $broodjeNaam = $row["broodje_naam"];
                $bestelling = new Bestelling($row["bestelID"], $broodjeNaam, $klantNaam);
                $bestellingen[] = $bestelling;
            }
        }
    
        return $bestellingen;
    }
    
    public function haalAlleBestellingenOp() {
        $alleBestellingen = [];

        // Query om alle bestellingen uit de database te halen
        $sql = "SELECT * FROM bestellingen";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            // Loop door de resultaten en voeg elke bestelling toe aan de array
            while ($row = $result->fetch_assoc()) {
                $alleBestellingen[] = $row;
            }
        }

        // Retourneer de array met bestellingen
        return $alleBestellingen;
    }
}

?>