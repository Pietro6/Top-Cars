<?php
require('Session.php');
?>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <title>HomePage</title>
    <style>
        .link {
            align-content: right;
        }

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
        $modello = $_GET['modello'];
        $idmod = $_GET['idmod'];
        $connection = mysqli_connect("localhost", "root", "root", "macchine");
        $query = "SELECT * FROM marca, modello WHERE modello='$modello' AND marca.marca=modello.marca AND idmodello='$idmod'";
        $result = mysqli_query($connection, $query);
        $modelli = explode(" ", $modello);
        //echo "$modelli[0]";
        if (mysqli_num_rows($result) != 0) {
            while ($tupla = mysqli_fetch_array($result)) {
                echo "<br><h1>&nbsp&nbsp$tupla[marca] $tupla[modello]</h1><br>";
                echo "<img src='http://localhost/Social-cars/data/loghi/$tupla[marca].png' class='logo' height='150'>";
                echo "<img style='margin-left: 2%; border: 1px solid black;' src ='http://localhost/Social-Cars/data/flags/$tupla[nazione].png' class='bandiera' width='225' height='150'>";
                echo " &nbsp &nbsp &nbspCerca $tupla[modello] su:";
                echo "<a target='_blank' href='https://www.autoscout24.it/lst/$tupla[marca]/$modelli[0]
                /?sort=standard&desc=0&ustate=N%2CU&size=20&page=1&cy=I&atype=C&fc=0
                &qry=$tupla[marca]&$modelli[0]'>                                                                                <img style='margin-left: 2%; border-radius: 10%; border: 1px solid black;' src='http://localhost/Social-Cars/data/link/autoscout.jpg' height='6%' width='11%'></a>";
                echo "<a target='_blank' href='https://www.subito.it/annunci-italia/vendita/auto/
                ?q=$tupla[marca] $tupla[modello]&qso=true'>
                <img style='margin-left: 2%; border-radius: 10%; border: 1px solid black;' src='http://localhost/Social-Cars/data/link/subito.jpg' height='6%' width='11%'></a>";
                $query1 = "SELECT * FROM recensione, utente WHERE recensione.idUtente=utente.idUtente AND idmodello=$tupla[idmodello] ORDER BY dataInserimento DESC";
                $result1 = mysqli_query($connection, $query1);
                echo "<br>";
                echo "<br><br>";

                echo "<a href='InserisciAutoCollezione.php?idmodello=$tupla[idmodello]&scelta=posseduta'>"; ?><button style='background-color: red; border-color: red;' class='btn btn-primary btn-block'>Aggiungi come auto posseduta</button></a>
                <?php
                echo "<a href='InserisciAutoCollezione.php?idmodello=$tupla[idmodello]&scelta=preferita'>"; ?><button style='background-color: red; border-color: red;' class='btn btn-primary btn-block'>Aggiungi come auto preferita</button></a>
                <?php
                echo "<br><br><h1>Inserisci Recensione</h1>";
                echo "<form action='InserisciRecensione.php?idmodello=$tupla[idmodello]&modello=$tupla[modello]' method='POST'>";
                ?>
                <br>
                <div class="input-group">
                    <div class="input-group-prepend">
                    </div>
                    <input type="text" name="recensione" placeholder="Scrivi qui la tua recensione" class="form-control" aria-label="Text input with radio button" required>
                    <input type="submit" value="Invia" />
                </div>
                <div class="input-group">
                <div class="input-group">
                </div>
                </div>

                <?php
                echo "</form>";




                if (mysqli_num_rows($result1) != 0) {
                    echo "<br><h1>Recensioni</h1><br>";
                    while ($tupla1 = mysqli_fetch_array($result1)) {
                        echo "<ul class='list-group'>";
                        if (mysqli_num_rows($result) != 0) {
                            if(!is_null($tupla1['foto'])||$tupla1['foto']!=''){
                                echo"<img src='http://localhost/Social-cars/data/$tupla1[foto]'/>";
                            }else{
                                if($_SESSION['idUtente']==$tupla1['idUtente']){
                                echo "<span class='input-group-text' id='basic-addon1'/>";
                                echo"<form action='CaricaFoto.php?id=$tupla1[idrecensione]&scelta=recensione' method='POST' enctype='multipart/form-data'>";
                                echo" <input type='file' name='file' required/>";
                                echo"<input type='submit' value='Carica'>";
                                echo"</form>";
                                echo"</span>";
                                }
                                
                            }
                            $dataCorretta= date("d-m-y",strtotime($tupla1['dataInserimento']));
                            echo "<li class='list-group-item active' aria-current='true'>Recensione di: <a href='VisualizzaProfilo.php?username=$tupla1[Username]'>$tupla1[Username]</a><br>Data pubblicazione: " .$dataCorretta;
                            echo "</li>";
                            echo "<li class='list-group-item'>$tupla1[testo]</li>";
                            echo "</ul>";
                            echo "<br>";
                        }
                    }
                } else { ?>

                    <div class="alert alert-danger" role="alert">
                        Ancora nessuna Recensione !
                    </div>

        <?php
                }
            }
        } else {
            echo "Nessuna Modello di questa marca presente nel database presente nel DataBase.";
        }
        ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>

</html>