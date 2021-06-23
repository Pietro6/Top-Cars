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
    <br>
    <h1 style="text-align:center;">Auto della Settimana:</h1>
    <hr>
    <div class="container">
        <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active" data-bs-interval="2500">
                    <a href="VisualizzaModello.php?modello=M3%20Coupe&idmod=310">
                        <img src="http://localhost/Social-Cars/data/link/slide1.jpg" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Bmw M3 E36</h5>
                            <p>Trazione posteriore, motore 6 cilindri, una bmw di sangue puro</p>
                        </div>
                    </a>
                </div>
                <div class="carousel-item" data-bs-interval="2500">
                    <a href="VisualizzaModello.php?modello=4C&idmod=26">
                        <img src="http://localhost/Social-Cars/data/link/slide2.jpg" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Alfa Romeo 4C</h5>
                            <p>Bella divertente e molto leggera, il peso della leggerezza</p>
                        </div>
                    </a>
                </div>
                <div class="carousel-item" data-bs-interval="2500">
                    <a href="VisualizzaModello.php?modello=500%20Abarth&idmod=671">
                        <img src="http://localhost/Social-Cars/data/link/slide3.jpg" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>500 Abarth</h5>
                            <p>Una piccola bestia in grado di battere auto di fascia maggiore</p>
                        </div>
                    </a>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <?php
    $connection = mysqli_connect("localhost", "root", "root", "macchine");
    $query = "SELECT COUNT(marca) AS totmarche FROM marca";
    $result = mysqli_query($connection, $query);
    if (mysqli_num_rows($result) != 0) {
        while ($tupla = mysqli_fetch_array($result)) {
            echo "<hr>";
            echo "<h1 style='text-align:center;'>Seleziona una Marca</h1><h3 style='text-align:center;'>Totale case automobilistiche:&nbsp&nbsp$tupla[totmarche]</h3><br>";
        }
    } else {
        echo "Nessuna Marca presente.";
    }
    ?>
    <ol class="list-group list-group-numbered">
        <?php
        $query = "SELECT * FROM marca";
        $result = mysqli_query($connection, $query);
        if (mysqli_num_rows($result) != 0) {
            echo "<div class='container'>";
            echo "<div class='row'>";
            while ($tupla = mysqli_fetch_array($result)) {
        ?>
                <div class="col">
                    <div class="card" style="width: 18rem;">
                <?php
                echo "<img src='http://localhost/Social-Cars/data/loghi/$tupla[marca].png' width='200' class='card-img-top' alt=''>";
                echo "<div class='card-body'>";
                $link = 'https://$tupla[sitoweb]';
                echo "<h5 class='card-title'>$tupla[marca]</h5>";
                echo "<p class='card-text'>Nazione: $tupla[nazione]<br>Anno di Fondazione: $tupla[annofondazione]</p>";
                echo "<a href='VisualizzaMarca.php?marca=$tupla[marca]' class='btn btn-primary'>Visualizza Marca</a>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
            }
            echo "</div>";
            echo "</div>";
        } else {
            echo "Nessuna Marca presente nel DataBase.";
        }
        mysqli_close($connection);
                ?>
    </ol>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>

</html>