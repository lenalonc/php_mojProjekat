<?php

require "dbBroker.php";
require "model/termin.php";

session_start();

if(empty($_SESSION['loggeduser']) || $_SESSION['loggeduser']==''){
    header("Location: index.php");
    die();
}

$rez = Termin::getAll($conn);

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
    <link rel="icon" href="img/logo-01.png" />
    <link rel="stylesheet" href="css/home.css">
    <title>Zo.Co.</title>
</head>
<body>
    <div class="jumbotron">
        <div class="container">
            <br>
            <h1 style="font-weight: bold;">Kozmeticki salon Zo.Co.</h1>
        </div>
    </div>
    <img src="img/logo-01.png" alt="logo" class="logo">
    <div class="col-md-8" style="text-align:center; width:70%; position: fixed; top: 42%; left: 60%; transform: translate(-50%, -50%);">
        <div id="pregled">
            <table id="tabela" class="table table-bordered table-dark">
                <thead>
                    <tr>
                        <th scope="col">Usluga</th>
                        <th scope="col">Klijent</th>
                        <th scope="col">Cena</th>
                        <th scope="col">Datum</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while($red=$rez->fetch_array()):
                    ?>
                    <tr>
                        <td><?php echo $red["usluga"] ?></td>
                        <td><?php echo $red["klijent"] ?></td>
                        <td><?php echo $red["cena"] ?></td>
                        <td><?php echo $red["datum"] ?></td>
                        <td>
                        <label class="custom-radio-btn">
                            <input type="radio" name="checked-donut" value=<?php echo $red["id"]?>>
                            <span class="checkmark"></span>
                        </label>
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
        </div>
    </div>

            <div class="col-md-4" style="width:30%; position: fixed; bottom: 100px; left: 100px;">
                
                <button id="btn" class="btn btn-info btn-block" 
                style="width: 300px; height: 50px; background-color: #355E3B ; border: 5px solid; border-radius: 1rem; "> Prikazi termine</button>
                
                <button id="btn-dodaj" type="button" class="btn btn-success btn-block"
                style="width: 300px; height: 50px;background-color: #355E3B ; border: 5px solid; border-radius: 1rem;" data-toggle="modal" data-target="#zakaziModal">Zakazi termin</button>
                
                <button id="btn-pretraga" class="btn btn-warning btn-block"
                style="width: 300px; height: 50px;background-color:  #355E3B; border: 5px solid; border-radius: 1rem;" > Pretrazi termin</button>
                <input type="text" id="myInput" onkeyup="funkcijaZaPretragu()" placeholder="Pretrazi kolokvijume po predmetu" hidden>
                
                <button id="btn-izmeni" type="button" class="btn btn-warning btn-block"
                style="width: 300px; height: 50px;background-color: #355E3B ; border: 5px solid; border-radius: 1rem;" data-toggle="modal" data-target="#izmeniModal">Izmeni</button>

                <button id="btn-obrisi" class="btn btn-danger btn-block"
                style="width: 300px; height: 50px;background-color: #355E3B ; border: 5px solid; border-radius: 1rem;">Obrisi termin</button>
                
                <button id="btn-sortiraj" class="btn btn-normal btn-block"
                style="width: 300px; height: 50px;background-color:  #355E3B; border: 5px solid; color: white; border-radius: 1rem;" onclick="sortTable()">Sortiraj</button>

            </div>

<!-- Modal -->
<div class="modal fade" id="zakaziModal" role="dialog" >
    <div class="modal-dialog">

    <!--Sadrzaj modala-->
    <div class="modal-content" >
        <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
                <div class="container dodatno-form">
                    <form action="#" method="post" id="dodajForm">
                        <h3 style="color: black; text-align: center">Zakazi termin</h3>
                        <div class="row">
                            <div class="col-md-11 ">
                                <div class="form-group">
                                    <label for="">Usluga</label>
                                    <input type="text" style="border: 1px solid black" name="usluga" class="form-control"/>
                                </div>
                                <div class="form-group">
                                <label for="">Klijent</label>
                                    <input type="text" style="border: 1px solid black" name="klijent" class="form-control"/>
                                </div>
                                <div class="form-group">
                                    <label for="cena">Cena</label>
                                    <input type="cena" style="border: 1px solid black" name="cena" class="form-control"/>
                                </div>
                                <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Datum</label>
                                    <input type="date"  style="border: 1px solid black" name="datum" class="form-control"/>
                                </div>
                                </div>
                                
                                <div class="form-group">
                                    <button id="btnDodaj" type="submit" class="btn btn-success btn-block"
                                    tyle="background-color: rgb(53, 94, 59); border: 1px solid black;">Zakazi</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
    </div>

    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="izmeniModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal sadrzaj-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="container dodatno-form">
                    <form action="#" method="post" id="izmeniForm">
                        <h3 style="color: black">Izmeni termine</h3>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input id="id" type="text" name="id" class="form-control"
                                           placeholder="id" value="" readonly />
                                </div>
                                <div class="form-group">
                                    <input id="usluga" type="text" name="usluga" class="form-control"
                                           placeholder="Usluga*" value=""/>
                                </div>
                                <div class="form-group">
                                    <input id="klijent" type="text" name="klijent" class="form-control"
                                           placeholder="Klijent *" value=""/>
                                </div>
                                <div class="form-group">
                                    <input id="cena" type="text" name="cena" class="form-control"
                                           placeholder="Cena *" value=""/>
                                </div>
                                <div class="form-group">
                                    <input id="datum" type="date" name="datum" class="form-control"
                                           placeholder="Datum *" value=""/>
                                </div>
                                <div class="form-group">
                                    <button id="btnIzmeni" type="submit" class="btn btn-success btn-block"
                                            style="color: white; background-color: rgb(53, 94, 59); border: 1px solid white"> Izmeni
                                    </button>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Zatvori</button>
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="js/main.js"></script>
        </body>
</html>