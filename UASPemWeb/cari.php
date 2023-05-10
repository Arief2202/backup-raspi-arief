<?php

    $cariData = "Politeknik Elektronika Negeri Surabaya";

    $db_host = "localhost";
    $db_user = "root";
    $db_pass = "";
    $db_name = "Politeknik";

    try {    
        //create PDO connection 
        $db = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
    } catch(PDOException $e) {
        //show error
        die("Terjadi masalah: " . $e->getMessage());
    }

    $sql = "SELECT * FROM `politeknik` WHERE `nama_poltek` LIKE '".$cariData."'";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $found = $stmt->fetch(PDO::FETCH_ASSOC);
    if($found){
        echo "Found Data!<br><br>";
        echo "ID : ".$found['id'];
        echo "<br>Nama Poltek : ".$found['nama_poltek'];
    }
    else{
        echo "Data not found!";
    }
?>