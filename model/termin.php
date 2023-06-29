<?php

class Termin{
    public $id;
    public $usluga;
    public $klijent;
    public $cena;
    public $datum;


    public function __construct($id=null,$usluga=null,$klijent=null,$cena=null,$datum=null){
        $this->id=$id;
        $this->usluga=$usluga;
        $this->klijent=$klijent;
        $this->cena=$cena;
        $this->datum=$datum;
    }


    public static function getAll(mysqli $conn){
        $query = "SELECT * FROM zakazani_termini";
        return $conn->query($query);
    }







}

?>