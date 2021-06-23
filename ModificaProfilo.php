<?php
require('Session.php');
?>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <title>HomePage</title>
    <style>
        a {
            text-decoration: none;
            color: #fff;
        } 
    </style>
</head>

<body>
<nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <a href="HomePage.php"><img src="http://localhost/Social-Cars/data/logo.png" alt="" width="35" height="35" class="d-inline-block align-text-top"> &nbsp &nbsp Top Cars</a>
                <div class="container-sm">
                    <a href="https://www.facebook.com/pietro.minelli.589"><img src=" http://localhost/Social-Cars/data/socials/facebook.png" class="d-inline-block align-text-top" height="35" width="35" alt="..." vertical-align:middle></a>
                    <a href="https://www.instagram.com/top_cars020/"><img src="http://localhost/Social-Cars/data/socials//instagram.png" class="d-inline-block align-text-top" height="35" width="35" alt="..."></a>
                    <a href="https://twitter.com/TopCars72640809"><img src="http://localhost/Social-Cars/data/socials/twitter.png" class="d-inline-block align-text-top" height="35" width="35" alt="..."></a>
                    <a style="float: right;" href="CercaProfili.php"><button type="button" class="btn btn-secondary">Cerca Utenti</button></a>
                    <a style="float: right; margin-right: 2%;" href="ModificaProfilo.php"><button type="button" class="btn btn-warning">Profilo</button></a>
                    <a style="float: right; margin-right: 2%;" href="Logout.php"><button type="button" class="btn btn-info">Logout</button></a>
                </div>
            </a>
        </div>
    </nav>
    <div class="container">
        <?php
        $username = $_SESSION['username'];
        echo "<h1>Profilo di $username</h1>";
        echo"<a href='ModificaDatiProfilo.php'><button type='button' class='btn btn-info'>Modifica account</button></a>";
        echo"<a style='margin-left: 2%;' href='EliminaAuto.php?id=$_SESSION[idUtente]&scelta=account'><button type='button' class='btn btn-danger'>Elimina account</button></a>";
        echo"<hr>";
        $connection = mysqli_connect("localhost", "root", "root", "macchine");
        $query = "SELECT * FROM utente, modello, autopreferita, marca WHERE username='$username' AND modello.idmodello=autopreferita.idmodello AND utente.idUtente=autopreferita.idUtente AND marca.marca = modello.marca";
        $result = mysqli_query($connection, $query);
        echo"<h1>Auto preferite</h1>";
        if (mysqli_num_rows($result) != 0) {
            while ($tupla = mysqli_fetch_array($result)) {
                echo "<ul class='list-group'>";
                echo "<li class='list-group-item'><img src='data/loghi/$tupla[marca].png' height='100'/><a style='color:#000;' href='VisualizzaModello.php?modello=$tupla[modello]&idmod=$tupla[idmodello]'>$tupla[marca] $tupla[modello]</a></li>";                echo "<a style='text-decoration: none;' href='EliminaAuto.php?id=$tupla[idautopreferita]&scelta=preferita'><span class='input-group-text' id='basic-addon1'>Elimina auto</span></a>";
                echo "</ul>";
                echo "<br>";
            }
        } else {
        ?>
            <div class="alert alert-danger" role="alert">
                Nessuna auto aggiunta come preferita!
            </div>
        <?php
        }
        $query2 = "SELECT * FROM utente, modello, autoposseduta, marca WHERE username='$username' AND modello.idmodello=autoposseduta.idmodello AND utente.idUtente=autoposseduta.idUtente AND marca.marca = modello.marca";
        $result2 = mysqli_query($connection, $query2);
        echo"<hr>";
        echo"<h1>Auto Possedute</h1>";
        if (mysqli_num_rows($result2) != 0) {
            while ($tupla2 = mysqli_fetch_array($result2)) {
                echo "<ul class='list-group'>";
                echo "<li class='list-group-item'><img src='data/loghi/$tupla2[marca].png' height='100'/><a style='color:#000;' href='VisualizzaModello.php?modello=$tupla2[modello]&idmod=$tupla2[idmodello]'>$tupla2[marca] $tupla2[modello]</a></li>";                echo "<a style='text-decoration: none;' href='EliminaAuto.php?id=$tupla2[idautoposseduta]&scelta=posseduta'><span class='input-group-text' id='basic-addon1'>Elimina auto</span></a>";
                if(is_null($tupla2['foto'])||$tupla2['foto']==''){
                    echo "<span class='input-group-text' id='basic-addon1'/>";
                    echo"<form action='CaricaFoto.php?id=$tupla2[idautoposseduta]&scelta=posseduta' method='POST' enctype='multipart/form-data'>";
                    echo" <input type='file' name='file' required/>";
                    echo"<input type='submit' value='Carica'>";
                    echo"</form>";
                    echo"</span>";
                }else{
                    echo"<img src='http://localhost/Social-cars/data/$tupla2[foto]'/>";

                }
                    echo "</ul>";
                    echo "<br>";

            }
        } else {
        ?>
            <div class="alert alert-danger" role="alert">
                Nessuna auto aggiunta come posseduta!
            </div>
        <?php
        } 
        $query3 = "SELECT * FROM recensione, utente, modello WHERE recensione.idUtente=utente.idUtente AND recensione.idmodello=modello.idmodello AND Username='$username' ORDER BY dataInserimento DESC";
        $result3 = mysqli_query($connection, $query3);
        echo"<hr>";
        echo"<h1>Recensioni</h1>";
        if (mysqli_num_rows($result3) != 0) {
            while ($tupla3 = mysqli_fetch_array($result3)) {
                echo "<ul class='list-group'>";
                echo "<a style='text-decoration: none;' href='EliminaAuto.php?id=$tupla3[idrecensione]&scelta=recensione'><span class='input-group-text' id='basic-addon1'>Elimina recensione</span></a>";
                if (mysqli_num_rows($result3) != 0) {
                    $dataCorretta= date("d-m-y",strtotime($tupla3['dataInserimento']));
                    echo "<li class='list-group-item active' aria-current='true'>Recensione di: <a href='VisualizzaProfilo.php?username=$tupla3[Username]'>$tupla3[Username]</a><br>Data pubblicazione: " . $dataCorretta."<br>Macchina: <a href='VisualizzaModello.php?modello=$tupla3[modello]&idmod=$tupla3[idmodello]'>".$tupla3['marca']." ".$tupla3['modello']."</a>";                    echo "</li>";
                    echo "<li class='list-group-item'>$tupla3[testo]</li>";
                    echo "</ul>";
                    if(!is_null($tupla3['foto'])||$tupla3['foto']!=''){
                        echo"<img width='100%' src='http://localhost/Social-cars/data/$tupla3[foto]'/>";
                    }
                    echo"<br><br>";
                }
            }
        } else {
        ?>
            <div class="alert alert-danger" role="alert">
                Nessuna recensione!
            </div>
        <?php
        }
        ?>
    </div>
</body>

</html>