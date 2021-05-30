<?php
	require('Session.php');
?>
<html>
<head>
</style>
</head>
<body>
<?php
	$idmodello=$_GET['idmodello'];
    $scelta=$_GET['scelta'];
	$connection = new mysqli ("localhost", "root", "root", "macchine");
	$id=$_SESSION['idUtente'];
	if($scelta=="preferita"){
		$query = "SELECT * FROM autopreferita WHERE idmodello ='$idmodello' AND idUtente ='$id'";
		$result = mysqli_query( $connection, $query);
		if(mysqli_num_rows($result)==0){
			$query ="INSERT INTO auto$scelta (idmodello, idUtente) VALUES ('$idmodello', '$id')";
   	 		$result = $connection->query($query);
		}
	}else{
		$query ="INSERT INTO auto$scelta (idmodello, idUtente) VALUES ('$idmodello', '$id')";
   	 	$result = $connection->query($query);
	}
	$connection->close();
	header('location: ' . $_SERVER['HTTP_REFERER']);	
	?>
</body>
</html>