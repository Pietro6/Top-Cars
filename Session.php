<html>
	<head>
		<title>Social Cars</title>
	</head>
	<body>
	<?php
		session_start();
		if(!isset($_SESSION['start_time'])) { 
			header('location: Login.php');
			die();
		}else{
			$now= time();
			$time = $now - $_SESSION['start_time'];
			if($time>3600){
				header('location: Logout.php');
				die();
			}
		}
	?>
	</body>
</html>