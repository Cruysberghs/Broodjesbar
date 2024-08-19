<?php
include_once('../database/connectie.php');
include_once('../entities/Broodje.php');

class BroodjeService {
    private $conn;

    public function __construct() {
        $this->conn = getDatabaseConnection();
    }

    public function toonAlleBroodjes() {
        $broodjes = [];

        // Query om alle kolommen uit de tabel "broodjes" te halen
        $sql = "SELECT id, naam, omschrijving, prijs FROM broodjes";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $broodje = new Broodje($row["id"], $row["naam"], $row["omschrijving"], $row["prijs"]);
                $broodjes[] = $broodje;
            }
        }

        return $broodjes;
    }
}
?>
