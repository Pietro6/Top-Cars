<?php
	require('Session.php');
?>
<html>
<head>
</style>
</head>
<body>
<?php
	$recensione=$_POST['recensione'];
	$modello=$_GET['modello'];
	$idmodello=$_GET['idmodello'];
	$data = date('Y-m-d');
	$connection = new mysqli ("localhost", "root", "root", "macchine");
	$id=$_SESSION['idUtente'];
	echo $recensione, $idmodello, $data, $id;
	$query ="INSERT INTO recensione (idmodello, idUtente, testo, dataInserimento) VALUES ('$idmodello', '$id', '$recensione','$data')";
	$result = $connection->query($query);
	$connection->close();
	header('location: ' . $_SERVER['HTTP_REFERER']);	
	?>
</body>
</html>