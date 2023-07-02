<?php

require "dbBroker.php";
require "model/termin.php";

session_start();

if(empty($_SESSION['loggeduser']) || $_SESSION['loggeduser'] == ''){
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
    <div class="col-md-4" style="text-align:center; width:70%; position: fixed; top: 42%; left: 60%; transform: translate(-50%, -50%);">
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
                
                <button class="btn btn-block" style="width: 300px; height: 50px;background-color:  #355E3B; border: 5px solid; color: white; border-radius: 1rem;"
                onclick="window.location.href = 'cenovnik.php';">Cenovnik</button>
            
                <button id="btn" class="btn btn-info btn-block" 
                style="width: 300px; height: 50px; background-color: #355E3B ; border: 5px solid; border-radius: 1rem; "  onclick="prikazi()"> Prikazi termine</button>
                
                <button id="btn-dodaj" type="button" class="btn btn-success btn-block"
                style="width: 300px; height: 50px;background-color: #355E3B ; border: 5px solid; border-radius: 1rem;" data-toggle="modal" data-target="#zakaziModal">Zakazi termin</button>
                
                <button id="btn-pretraga" class="btn btn-warning btn-block"
                style="width: 300px; height: 50px;background-color:  #355E3B; border: 5px solid; border-radius: 1rem;" > Pretrazi termin</button>
                <input type="text" id="myInput" onkeyup="findBy()" placeholder="Pretrazi termine po predmetu" hidden>
                
                <button id="btn-izmeni" type="button" class="btn btn-warning btn-block"
                style="width: 300px; height: 50px;background-color: #355E3B ; border: 5px solid; border-radius: 1rem;" data-toggle="modal" data-target="#izmeniModal">Izmeni</button>

                <button id="btn-obrisi" formmethod="post" class="btn btn-danger btn-block"
                style="width: 300px; height: 50px;background-color: #355E3B ; border: 5px solid; border-radius: 1rem;">Obrisi termin</button>
                
                <button id="btn-sortiraj" class="btn btn-normal btn-block"
                style="width: 300px; height: 50px;background-color:  #355E3B; border: 5px solid; color: white; border-radius: 1rem;" onclick="sortTable()">Sortiraj po datumu</button>

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
                                    <select style="width: 400px; border: 1px solid #355E3B" name="usluga" id="uslugaa" class="form-control">
                                    
                                    </select>
                              <!--  <input  type="text" style="width: 400px;border: 1px solid #355E3B" name="usluga" class="form-control"/> -->
                                </div>
                                <br>
                                <div class="form-group">
                                <label for="">Klijent</label>
                                    <input type="text" style="width: 400px; border: 1px solid #355E3B" name="klijent" class="form-control"/>
                                </div>
                                <div class="form-group">
                                    <label for="cena">Cena</label>
                                    <input type="cena" style="width: 400px; border: 1px solid #355E3B" name="cena" class="form-control"/>
                                </div>
                                <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Datum</label>
                                    <input type="date"  style="width: 400px; margin-left: -15px;border: 1px solid #355E3B" name="datum" class="form-control"/>
                                </div>
                                </div>
                                
                                <div class="form-group">
                                    <button id="btnDodaj" type="submit" class="btn btn-success btn-block"
                                    tyle="background-color: rgb(53, 94, 59); border: 1px solid #355E3B;">Zakazi</button>
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

    <script>

        function sortTable(){
            var table, rows, switching, i, x, y, shouldSwitch;
            table = document.getElementById("tabela");
            switching = true;
            while (switching) {
                switching = false;
                rows = table.rows;
                for (i = 1; i < (rows.length - 1); i++) {
                    shouldSwitch = false;
                    x = rows[i].getElementsByTagName("TD")[3];
                    y = rows[i + 1].getElementsByTagName("TD")[3];
                    if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                        shouldSwitch = true;
                        break;
                    }
                }
                if (shouldSwitch) {
                    rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                    switching = true;
                }
            }

        }


        function findBy() {

            var input, filter, table, tr, i, td1, td2, td4, txtValue1, txtValue2, txtValue4;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("tabela");
            tr = table.getElementsByTagName("tr");

            for (i = 0; i < tr.length; i++) {
                td1 = tr[i].getElementsByTagName("td")[0];
                td2 = tr[i].getElementsByTagName("td")[1];
                td4 = tr[i].getElementsByTagName("td")[3];

                if (td1 || td2 || td4) {
                    txtValue1 = td1.textContent || td1.innerText;
                    txtValue2 = td2.textContent || td2.innerText;
                    txtValue4 = td4.textContent || td4.innerText;

                    if (txtValue1.toUpperCase().indexOf(filter) > -1 || txtValue2.toUpperCase().indexOf(filter) > -1 ||
                         txtValue4.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                     tr[i].style.display = "none";
                            }
                 }
            }
        }

    </script>




</body>
</html>