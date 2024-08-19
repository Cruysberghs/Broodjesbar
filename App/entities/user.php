<?php
class User {
    private $klantID;
    private $voornaam;
    private $achternaam;
    private $email;
    private $wachtwoord;

    public function __construct($klantID, $voornaam, $achternaam, $email, $wachtwoord) {
        $this->klantID = $klantID;
        $this->voornaam = $voornaam;
        $this->achternaam = $achternaam;
        $this->email = $email;
        $this->wachtwoord = $wachtwoord;
    }

    public function getKlantNaam() {
        return $this->voornaam . ' ' . $this->achternaam;
    }
}
?>
