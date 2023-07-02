<?php

require "dbBroker.php";
require "model/cenovnik.php";

session_start();

if(empty($_SESSION['loggeduser']) || $_SESSION['loggeduser'] == ''){
    header("Location: index.php");
    die();
}

$rez = Cenovnik::getAll($conn);

if(!$rez){
    echo "Greska prilikom ucitavanja elementa tabele";
    die();
}

if($rez->num_rows == 0){
    echo "Nema zakazanih termina";
    die();
}

else{

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/home.css"> 
    <title>Cenovnik - Zo.Co.</title>
</head>
<body>
<div class="jumbotron">
        <div class="container">
            <br>
            <h1 style="font-weight: bold;">Kozmeticki salon Zo.Co.</h1>
        </div>
    </div>
    <img src="img/logo-01.png" alt="logo" class="logo">
    <div class="col-md-4" style="text-align:center; width:70%; position: fixed; top: 45%; left: 50%; transform: translate(-50%, -50%);">
        <div id="pregled">
            <table id="tabela" class="table table-bordered table-dark">
                <thead>
                    <tr>
                        <th scope="col">Tretman</th>
                        <th scope="col">Cena</th>
                        <th scope="col">Kozmeticar</th>
                    
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while($red=$rez->fetch_array()):
                    ?>
                    <tr>
                        <td><?php echo $red["tretman"] ?></td>
                        <td><?php echo $red["cena"] ?></td>
                        <td><?php echo $red["kozmeticar"] ?></td>
                        
                    </td>
                    </tr>
                    <?php
                    endwhile;
                    }
                ?>
                    </td>
                    </tr>
                    
                <tbody>
            </table>
            <button class="btn btn-block" style="width: 300px; height: 50px;background-color:  #355E3B; border: 5px solid; color: white; border-radius: 1rem;"
             onclick="window.location.href = 'home.php';">Povratak na Home</button>

        </div>
    </div>

    
</body>
</html>