<?php
require('Session.php');
?>
<html>

<head>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
</head>

<body>
	<div class="container">
	<?php
	$idmodello = $_GET['idmodello'];
	$scelta = $_GET['scelta'];
	$connection = new mysqli("localhost", "root", "root", "macchine");
	$id = $_SESSION['idUtente'];
	if ($scelta == "preferita") {
		$query = "SELECT * FROM autopreferita WHERE idmodello ='$idmodello' AND idUtente ='$id'";
		$result = mysqli_query($connection, $query);
		if (mysqli_num_rows($result) == 0) {
			$query = "INSERT INTO auto$scelta (idmodello, idUtente) VALUES ('$idmodello', '$id')";
			$result = $connection->query($query);
		}
	} else {
		$query = "INSERT INTO auto$scelta (idmodello, idUtente) VALUES ('$idmodello', '$id')";
		$result = $connection->query($query);
	}
	$connection->close();
	//header('location: ' . $_SERVER['HTTP_REFERER']);	
	?>
	<br>
	<div class="alert alert-success" role="alert">
		Auto Aggiunta con successo!
	</div>
	<?php
		header('Refresh: 2; url='. $_SERVER['HTTP_REFERER']);
	?>
</div>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>

</html>