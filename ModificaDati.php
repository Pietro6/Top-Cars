<?php
	require('Session.php');
?>
<html>
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
</head>
<body>
<?php
	$connection = new mysqli ("localhost", "root", "root", "macchine");
	$nome = $_POST['nome'];
    $cognome = $_POST['cognome'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $id= $_SESSION['idUtente'];
    // echo"$nome, $cognome, $username, $email, $id";
    $query = "SELECT * FROM utente;";
    $result = mysqli_query($connection, $query);
    $vabene=true;
    if (mysqli_num_rows($result) != 0) {
        while ($tupla = mysqli_fetch_array($result)) {
            if($tupla['Username']==$username&&$_SESSION['idUtente']!=$tupla['idUtente']){
                $vabene=false;
            }
        }
    }
    if($vabene){
        $query= "UPDATE `utente` SET `Nome` = '$nome', `Cognome` = '$cognome', `Username` = '$username', `Email` = '$email' WHERE (`idUtente` = '$id');";
        $_SESSION['nome'] = $nome;
        $_SESSION['cognome'] = $cognome;
        $_SESSION['username'] = $username;
        $_SESSION['email'] = $email;
        $result = mysqli_query($connection, $query);
        $risposta="Dati Modificati";
        $condizione="succes";
    }else{
        $risposta="Username già in uso";
        $condizione="danger";
    }
    ?>
    <div class="container">
    <br>
    <?php   
    echo"<div class='alert alert-$condizione' role='alert'>";
        echo"$risposta";
    ?>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
<?php
    header('Refresh: 2; url='. $_SERVER['HTTP_REFERER']);
?>
</body>
</html>