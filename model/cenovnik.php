<?php

class Cenovnik{
    public $id;
    public $tretman;
    public $cena;
    public $kozmeticar;


    public function __construct($id=null,$usluga=null,$klijent=null,$cena=null,$datum=null){
        $this->tretman=$tretman;
        $this->usluga=$usluga;
        $this->cena=$cena;
        $this->kozmeticar=$kozmeticar;
    }


    public static function getAll(mysqli $conn){
        $query = "SELECT * FROM cenovnik";
        return $conn->query($query);
    }

    public static function getTretman(mysqli $conn){
        $query = "SELECT tretman FROM cenovnik";

    $myArray = array();
    if ($result = $conn->query($query)) {
        while ($row = $result->fetch_assoc()) {
            $myArray[] = $row['tretman'];
        }
    }

    return $myArray;
    }

    public static function getById($id, mysqli $conn)
    {
        $query = "SELECT * FROM cenovnik WHERE id=$id";
        $myArray = array();
        if ($result = $conn->query($query)) {

            while ($row = $result->fetch_array(1)) {
                $myArray[] = $row;
            }
        }
        return $myArray;
    }
   
}
?>