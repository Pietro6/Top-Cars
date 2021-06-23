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
        $nome = $_SESSION['nome'];
        $cognome = $_SESSION['cognome'];
        $username = $_SESSION['username'];
        $password = $_SESSION['password'];
        $email = $_SESSION['email'];
        echo "<h1>Profilo di $username</h1>";
        ?>
        <h1>Modifica dati personali</h1><br>
        <form class="form-container" action="ModificaDati.php" method="POST">
            <div class="mb-3">
                <?php
                echo "<input type='text' name='nome' placeholder='Nome' value='$nome' required class='form-control' id='exampleInputEmail1' aria-describedby='emailHelp'>";
                ?>
            </div>
            <div class="mb-3">
                <?php
                echo "<input type='text' name='cognome' placeholder='Cognome' value='$cognome' required class='form-control' id='exampleInputEmail1' aria-describedby='emailHelp'>";
                ?>
            </div>
            <div class="mb-3">
                <?php
                echo "<input type='text' name='username' placeholder='Username' value='$username' required class='form-control' id='exampleInputEmail1' aria-describedby='emailHelp'>";
                ?>
            </div>
            <div class="mb-3">
                <?php
                echo "<input type='email' name='email' placeholder='Email' value='$email' required class='form-control' id='exampleInputEmail1' aria-describedby='emailHelp'>";
                ?>
            </div>
            <br>
            <input type="submit" value="Modifica" class="btn btn-primary btn-block">
        </form>
        <button onclick="window.location.href='ModificaProfilo.php'" class='btn btn-primary btn-block'>Indietro</button>
    </div>
</body>

</html>