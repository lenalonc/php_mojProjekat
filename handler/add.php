<?php
require "../dbBroker.php";
require "../model/termin.php";

if(isset($_POST['usluga']) && isset($_POST['klijent']) && isset($_POST['cena'])
    && isset($_POST['datum'])){

        $status = Termin::add($_POST['usluga'], $_POST['klijent'], $_POST['cena'], $_POST['datum'], $conn);

        if ($status) {
            echo 'Success';
        } else {
            echo $status;
            echo 'Failed';
        }
}

?>