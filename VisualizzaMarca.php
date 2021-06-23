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
    </style>
</head>

<body>
<nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <a style="text-decoration: none; color: #fff;" href="HomePage.php"><img src="http://localhost/Social-Cars/data/logo.png" alt="" width="35" height="35" class="d-inline-block align-text-top"> &nbsp &nbsp Top Cars</a>
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
        $marca = $_GET['marca'];
        $connection = mysqli_connect("localhost", "root", "root", "macchine");
        $query = "SELECT * FROM marca WHERE marca='$marca'";
        $result = mysqli_query($connection, $query);
        if (mysqli_num_rows($result) != 0) {
            while ($tupla = mysqli_fetch_array($result)) {
                echo "<br><h1>&nbsp&nbsp$tupla[marca]</h1><br>";
                echo "<img src='http://localhost/Social-cars/data/loghi/$tupla[marca].png' class='logo' height='150'>";
                echo "<img style='margin-left: 2%; border: 1px solid black;' src ='http://localhost/Social-Cars/data/flags/$tupla[nazione].png' class='bandiera' width='225' height='150'>";
                echo " &nbsp &nbsp &nbspCerca $tupla[marca] su:";
                echo "<a target='_blank' href='https://www.autoscout24.it/lst/$tupla[marca]?sort=standard&desc=0&ustate=N%2CU&size=20&page=1&cy=I&atype=C&fc=0&qry=$tupla[marca]&'><img style='margin-left: 2%; border-radius: 10%; border: 1px solid black;' src='http://localhost/Social-Cars/data/link/autoscout.jpg' height='6%' width='11%'></a>";
                echo "<a target='_blank' href='https://www.subito.it/annunci-italia/vendita/auto/?q=$tupla[marca]&qso=true'><img style='margin-left: 2%; border-radius: 10%; border: 1px solid black;' src='http://localhost/Social-Cars/data/link/subito.jpg' height='6%' width='11%'></a>";
        ?>
                <br><br><br>
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Marca</th>
                            <th scope="col">Nazione</th>
                            <th scope="col">Anno di Fondazione</th>
                            <th scope="col">Sito web</th>
                            <th scope="col">Numero modelli</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php
                            echo "<td>$tupla[marca]</td>";
                            echo "<td>$tupla[nazione]</td>";
                            echo "<td>$tupla[annofondazione]</td>";
                            echo "<td>$tupla[sitoweb]</td>";
                            $query2 = "SELECT COUNT(*) AS tot FROM modello WHERE marca='$marca';";
                            $result2 = mysqli_query($connection, $query2);
                            if (mysqli_num_rows($result2) != 0) {
                                while ($tupla2 = mysqli_fetch_array($result2)) {
                                    echo "<td>$tupla2[tot]</td>";
                                }                                
                            }
                            ?>
                        </tr>
                    </tbody>
                </table>
        <?php
            }
        } else {
            echo "Nessuna Marca presente nel DataBase.";
        }
        ?>
        <br>
        <h1>Modelli</h1>
        <ul class="list-group list-group-flush">
            <?php
            $connection = mysqli_connect("localhost", "root", "root", "macchine");
            $query = "SELECT * FROM modello WHERE marca='$marca' ORDER BY modello ASC";
            $result = mysqli_query($connection, $query);
            if (mysqli_num_rows($result) != 0) {
                while ($tupla = mysqli_fetch_array($result)) {
                    echo "<li class='list-group-item'><h3><a href='VisualizzaModello.php?modello=$tupla[modello]&idmod=$tupla[idmodello]' style='text-decoration: none; color: #000'>&nbsp&nbsp$tupla[modello]</a></h3></li>";
                }
            }
            ?>
        </ul>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>

</html>