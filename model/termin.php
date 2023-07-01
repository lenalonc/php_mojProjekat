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

    public static function getById($id, mysqli $conn)
    {
        $query = "SELECT * FROM zakazani_termini WHERE id=$id";
        $myArray = array();
        if ($result = $conn->query($query)) {

            while ($row = $result->fetch_array(1)) {
                $myArray[] = $row;
            }
        }
        return $myArray;
    }
    public static function deleteById($id, mysqli $conn)
    {
        $query = "DELETE FROM zakazani_termini WHERE id=$id";
        return $conn->query($query);
    }


    public static function add($usluga, $klijent, $cena, $datum, mysqli $conn)
    {

        $query = "INSERT INTO zakazani_termini(usluga, klijent, cena, datum) values('$usluga', '$klijent', '$cena',  '$datum')";
        return $conn->query($query);
    }


    public static function update($id, $usluga, $klijent, $cena, $datum, mysqli $conn)
    {
        $query = "UPDATE zakazani_termini set usluga='$usluga', klijent='$klijent', cena='$cena', datum='$datum' where id=$id";
        return $conn->query($query);
    }

    




}

?>