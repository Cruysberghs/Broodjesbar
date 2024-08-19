<?php
class Broodje {
    private $id;
    private $naam;
    private $omschrijving;
    private $prijs;

    public function __construct($id, $naam, $omschrijving, $prijs) {
        $this->id = $id;
        $this->naam = $naam;
        $this->omschrijving = $omschrijving;
        $this->prijs = $prijs;
    }

    public function getId() {
        return $this->id;
    }

    public function getBroodjeNaam() {
        return $this->naam;
    }

    public function getOmschrijving() {
        return $this->omschrijving;
    }

    public function getPrijs() {
        return $this->prijs;
    }
}
?>
