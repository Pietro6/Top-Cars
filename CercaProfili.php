<html>

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
 <h1>Cerca Utenti</h1><br>

<form action="VisualizzaProfilo.php" method="GET">
    <select name="username" class="form-select" aria-label="Default select example">
        <?php
        $connection = mysqli_connect("localhost", "root", "root", "macchine");
        $query = "SELECT * FROM utente;";
        $result = mysqli_query($connection, $query);
        if (mysqli_num_rows($result) != 0) {
            while ($tupla = mysqli_fetch_array($result)) {
                echo "<option value='$tupla[Username]'>$tupla[Username]</option>";
            }
        }
        ?>
    </select>
    <br>
    <input type="submit" value="Cerca" class="btn btn-primary btn-block">
</form>
    </div>
</body>

</html>