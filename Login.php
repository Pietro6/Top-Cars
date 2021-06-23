<!DOCTYPE html>
<?php
require('Firewall.php');
session_start();
session_unset();
session_destroy();
$_SESSION = array();
?>
<html>

<head>
	<meta charset="UTF-8">
	<title>Login</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="LoginRegistration.css" />
	<link rel="icon" type="image/png" href="http://localhost/Social-Cars/data/logo.ico"/>
</head>

<body>
	<?php
	$messaggio=@$_GET['messaggio'];
	if(isset($messaggio)){
		alert("Registrazione effettuata con successo, Effettua il Login");
	}
	if ((!isset($_POST['username']) || !isset($_POST['password']))) {
	?>
		<section class="container-fluid bg">
			<section class="row justify-content-center">
				<section class="col-12 col-sm-6 col-md-3">
					<form class="form-container" action="Login.php" method="POST">
						<div class="mb-3">
							<label for="exampleInputEmail1" class="form-label">Top Cars Login</label>
							<input type="text" name="username" placeholder="Username" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
						</div>
						<div class="mb-3">
							<input type="password" name="password" placeholder="Password" required class="form-control" id="exampleInputPassword1">
						</div>
						<input type="submit" value="Accedi" class="btn btn-primary btn-block">
						<button onclick="window.location.href='Registrazione.php'" class='btn btn-primary btn-block'>Registrati</button>
					</form>
				</section>
			</section>
		</section>
	<?php
	} else {
		$username = $_POST['username'];
		$password = $_POST['password'];
		FireWall($username);
		FireWall($password);
		if (strlen($username) != 0 && strlen($password) != 0) {
			$password = md5($password);
			$connection = new mysqli("localhost", "root", "root", "macchine");
			$query = "SELECT * FROM utente WHERE username='$username'";
			$result = $connection->query($query);
			if ($result->num_rows != 0) {
				$user_row = $result->fetch_array();
				if ($password == $user_row['Password']) {
					session_start();
					session_unset();
					session_destroy();
					session_start();
					$_SESSION['idUtente'] = $user_row['idUtente'];
					$_SESSION['nome'] = $user_row['Nome'];
					$_SESSION['cognome'] = $user_row['Cognome'];
					$_SESSION['username'] = $username;
					$_SESSION['password'] = $password;
					$_SESSION['email'] = $user_row['Email'];
					$_SESSION['start_time'] = time();



					


					header('location:HomePage.php');
				}
			}
			$result->free();
			$connection->close();
		}
	?>
		<section class="container-fluid bg">
			<section class="row justify-content-center">
				<section class="col-12 col-sm-6 col-md-3">
					<form class="form-container" action="Login.php" method="POST">
						<div class="mb-3">
							<label for="exampleInputEmail1" class="form-label">Top Cars Login</label>
							<input type="text" name="username" placeholder="Username" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
						</div>
						<div class="mb-3">
							<input type="password" name="password" placeholder="Password" required class="form-control" id="exampleInputPassword1">
							<div id="emailHelp" class="form-text" style="color:#ff0000">Username o Password Errati</div>
						</div>
						<input type="submit" value="Accedi" class="btn btn-primary btn-block">
						<button onclick="window.location.href='Registrazione.php'" class='btn btn-primary btn-block'>Registrati</button>
					</form>
				</section>
			</section>
		</section>
	<?php
	}
	?>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>

</html>