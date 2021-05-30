<?php
    $id=$_GET['id'];
    $scelta=$_GET['scelta'];
    $file = $_FILES['file'];
    $fileName = $_FILES['file']['name'];
    $fileTmpname = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];
    $fileExt = explode('.',$fileName);
    $fileActualExt = strtolower(end($fileExt));
    $allowed = array('jpg','jpeg','png','svg');
    if(in_array($fileActualExt, $allowed)){
        if($fileError===0){
            if($fileSize<10000000){
                $fileNameNew = uniqid('',true).".".$fileActualExt;
                $fileDestination = 'data/'.$fileNameNew;
                move_uploaded_file($fileTmpname, $fileDestination);
                $connection = mysqli_connect("localhost", "root", "root", "macchine");
                if($scelta=='posseduta'){
                $query = "UPDATE `macchine`.`autoposseduta` SET `foto` = '$fileNameNew' WHERE (`idautoposseduta` = '$id');";
                $result = mysqli_query($connection, $query);
                }else if($scelta=='recensione'){
                    $query = "UPDATE `macchine`.`recensione` SET `foto` = '$fileNameNew' WHERE (`idrecensione` = '$id');";
                    $result = mysqli_query($connection, $query);
                }
                header('location: ' . $_SERVER['HTTP_REFERER']);	
            }else{
                $risposta="File troppo grande";
            }
        }else{
            $risposta="Errore durante il caricamento";
        }
    }else{
        $risposta="Tipo di file non supportato";
    }
    echo"$risposta";
    ?>
