<?php

require "../dbBroker.php";
require "../model/cenovnik.php";


    $myArray = Cenovnik::getTretman($conn);
    echo json_encode($myArray);

?>