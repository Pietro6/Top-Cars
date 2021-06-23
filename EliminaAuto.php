<?php
    $id=$_GET['id'];
    $scelta=$_GET['scelta'];
    $connection = mysqli_connect("localhost", "root", "root", "macchine");
    if($scelta=='recensione'){
        $query = "DELETE FROM `macchine`.`recensione` WHERE (`idrecensione` = '$id');";
    }else if($scelta=='account'){
        $query = "DELETE FROM `macchine`.`utente` WHERE (`idUtente` = '$id');";
        session_start();
        session_unset();
        session_destroy();
        $_SESSION = array();
        $result = mysqli_query($connection, $query);
        header('location: Login.php');	
    }else{
        $query = "DELETE FROM `macchine`.`auto$scelta` WHERE (`idauto$scelta` = '$id');";
    }
    $result = mysqli_query($connection, $query);
    header('location: ' . $_SERVER['HTTP_REFERER']);
?>	
