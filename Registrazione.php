<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="LoginRegistration.css" />
</head>

<body>
    <?php
    require('FireWall.php');
    if ((!isset($_POST['username']) || !isset($_POST['password']))) {
    ?>
        <section class="container-fluid bg">
            <section class="row justify-content-center">
                <section class="col-12 col-sm-6 col-md-3">
                    <form class="form-container" action="Registrazione.php" method="POST">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Top Cars Registrazione</label>
                            <input type="text" name="nome" placeholder="Nome" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <input type="text" name="cognome" placeholder="Cognome" required class="form-control" id="exampleInputPassword1">
                        </div>
                        <div class="mb-3">
                            <input type="text" name="username" placeholder="Username" required class="form-control" id="exampleInputPassword1">
                        </div>
                        <div class="mb-3">
                            <input type="password" name="password" placeholder="Password" required class="form-control" id="exampleInputPassword1">
                        </div>
                        <div class="mb-3">
                            <input type="email" name="email" placeholder="Email" required class="form-control" id="exampleInputPassword1">
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" required>
                            <label class="form-check-label" for="flexCheckDefault">
                                Ho letto l'<a href="Informativa.html">informativa sulla privacy</a>
                            </label>
                        </div>
                        <br>
                        <input type="submit" value="Registrati" class="btn btn-primary btn-block">
                        <button onclick="window.location.href='Login.php'" class='btn btn-primary btn-block'>Accedi</button>
                    </form>
                </section>
            </section>
        </section>
        <?php
    } else {
        $nome = $_POST["nome"];
        $cognome = $_POST["cognome"];
        $username = $_POST["username"];
        $password = $_POST["password"];
        $email = $_POST['email'];
        $ceck = [$nome, $cognome, $username, $password, $email];
        $error = false;
        $results = array();
        foreach ($ceck as $c) {
            $results = FireWall($c);
            if (!$results) {
                $error = true;
            }
        }



        if ($error == false) {
            $connection = mysqli_connect("localhost", "root", "root", "macchine");
            $password = md5($password);
            $query = "SELECT * FROM utente WHERE Username ='$username'";
            $result = $connection->query($query);
            if ($result->num_rows == 0) {
                $query = "INSERT INTO utente (Nome,Cognome,Username,Password,Email) VALUES ('$nome','$cognome','$username','$password','$email')";
                $result = mysqli_query($connection, $query);
                mysqli_close($connection);
                header('location:Login.php?messaggio=true');
            } else {
        ?>
                <section class="container-fluid bg">
                    <section class="row justify-content-center">
                        <section class="col-12 col-sm-6 col-md-3">
                            <form class="form-container" action="Registrazione.php" method="POST">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Top Cars Registrazione</label>
                                    <input type="text" name="nome" placeholder="Nome" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                </div>
                                <div class="mb-3">
                                    <input type="text" name="cognome" placeholder="Cognome" required class="form-control" id="exampleInputPassword1">
                                </div>
                                <div class="mb-3">
                                    <input type="text" name="username" placeholder="Username" required class="form-control" id="exampleInputPassword1">
                                </div>
                                <div class="mb-3">
                                    <input type="password" name="password" placeholder="Password" required class="form-control" id="exampleInputPassword1">
                                </div>
                                <div class="mb-3">
                                    <input type="email" name="email" placeholder="Email" required class="form-control" id="exampleInputPassword1">
                                    <div id="emailHelp" class="form-text" style="color:#ff0000">Username già in uso</div>
                                </div>
                                <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" required>
                                <label class="form-check-label" for="flexCheckDefault">
                                    Ho letto l'<a href="Informativa.html">informativa sulla privacy</a>
                                </label>
                                </div>
                                <br>
                                <input type="submit" value="Registrati" class="btn btn-primary btn-block">
                                <button onclick="window.location.href='Login.php'" class='btn btn-primary btn-block'>Accedi</button>
                            </form>
                        </section>
                    </section>
                </section>
            <?php
            }
        } else {
            ?>
            <section class="container-fluid bg">
                <section class="row justify-content-center">
                    <section class="col-12 col-sm-6 col-md-3">
                        <form class="form-container" action="Registrazione.php" method="POST">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Top Cars Registrazione</label>
                                <input type="text" name="nome" placeholder="Nome" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                            </div>
                            <div class="mb-3">
                                <input type="text" name="cognome" placeholder="Cognome" required class="form-control" id="exampleInputPassword1">
                            </div>
                            <div class="mb-3">
                                <input type="text" name="username" placeholder="Username" required class="form-control" id="exampleInputPassword1">
                            </div>
                            <div class="mb-3">
                                <input type="password" name="password" placeholder="Password" required class="form-control" id="exampleInputPassword1">
                            </div>
                            <div class="mb-3">
                                <input type="email" name="email" placeholder="Email" required class="form-control" id="exampleInputPassword1">
                                <div id="emailHelp" class="form-text" style="color:#ff0000">Carattere non supportato</div>
                            </div>
                            <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" required>
                            <label class="form-check-label" for="flexCheckDefault">
                                Ho letto l'<a href="Informativa.html">informativa sulla privacy</a>
                            </label>
                            </div>
                            <br>
                            <input type="submit" value="Registrati" class="btn btn-primary btn-block">
                            <button onclick="window.location.href='Login.php'" class='btn btn-primary btn-block'>Accedi</button>
                        </form>
                    </section>
                </section>
            </section>
    <?php
        }
    }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>

</html>