<?php
    $koneksi = mysqli_connect("localhost","arief","password","bahasa_isyarat") or die(mysqli_error());
    header('Content-Type: application/json');
    header("Access-Control-Allow-Origin: *");
    header("HTTP/1.1 200 Not Found");

    if(isset($_POST['message'])){
        $status = mysqli_query($koneksi, "INSERT INTO `message` (`id`, `text`) VALUES (NULL, '".$_POST['message']."');");
        if($status){
            header('Content-Type: application/json');
            header("Access-Control-Allow-Origin: *");
            header("HTTP/1.1 201 OK");
        }
    }

    $messageQuery = mysqli_query($koneksi, "SELECT * from `message`");
    $message = array();
    $index = 0;
    while($data = mysqli_fetch_array($messageQuery)){
        $message[$index++] = [
            "id" => $data['id'],
            "text" => $data['text'],
        ];
    }
    echo json_encode($message);


