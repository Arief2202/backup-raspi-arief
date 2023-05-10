<?php
    require_once('curl.php');
    $class = array(
        array("Basis Data", "44050"),
        array("Matematika 2", "44051"),
        array("Sistem Operasi", "44053"),
        array("Pemrograman Web", "44055"),
        array("B Inggris 2", "44057"),
        array("Algoritma Struktur Data", "44058")
    );
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="icon" href="https://ethol.pens.ac.id/favicon.ico" />
    <title>UJIAN PENS</title>
    <style>
        body{
            background: darkslategray;
        }
        .card{
            background: rgba(0, 0, 0, 0.5);
            color: white;
        }
        .center {
            position: absolute;
            color: white;
            top: 0px;
            left: 50%;
            transform: translate(-50%, 0%);
            padding: 10px;
            border-radius: 10px;
        }
        
        @media(max-width:700px) {
            .center {
                top: 20px;
                font-size: 15pt;
            }
        }

    </style>
</head>
<body>
    <br><br>
    <div class="container">
        <div class="row" >
            <h1 class="center">UAS (1 D3 IT A)</h1>
        </div>
        <div class="row"><br></div>
        <div class="row">
            <?php for($a = 0; $a < 3; $a++){?>
            <div class="col-md">
                <div class="card">
                    <div class="card-body text-center">
                        <?php
                        echo '<h5 class="card-title">'.$class[$a][0].'</h5>';
                        echo '<p class="card-text">';
                        $json = curl_get('https://ethol.pens.ac.id/api/v1/exam/detail?course='.$class[$a][1].'&jenisSchema=1&jenis=2&role=1');
                        $json = json_decode($json);
                        echo '<a>Dosen : '.$json->dosen.'</a><br>';
                        echo '<a>Mulai   : '.$json->mulai.'</a><br>';
                        echo '<a>Selesai : '.$json->selesai.'</a><br><br><h6>STATUS</h6>';
                        if($json->soal == NULL){
                            echo "soal belum tersedia";
                            echo '</p>';
                            echo '<a href="';
                            echo $json->soal;
                            echo '" class="btn btn-danger disabled">';
                            echo 'Download Soal</a>';
                        }
                        else{
                            echo "soal tersedia";
                            echo '</p>';
                            echo '<a href="';
                            echo $json->soal;
                            echo '" class="btn btn-success">';
                            echo 'Download Soal</a>';
                        }
                        ?>
                    </div>
                </div><br>
            </div>
            <?php } ?>
        </div>
        
        <div class="row">
            <?php for($a = 3; $a < 6; $a++){?>
            <div class="col-md">
                <div class="card">
                    <div class="card-body text-center">
                        <?php
                        echo '<h5 class="card-title">'.$class[$a][0].'</h5>';
                        echo '<p class="card-text">';
                        $json = curl_get('https://ethol.pens.ac.id/api/v1/exam/detail?course='.$class[$a][1].'&jenisSchema=1&jenis=2&role=1');
                        $json = json_decode($json);
                        echo '<a>Dosen : '.$json->dosen.'</a><br>';
                        echo '<a>Mulai   : '.$json->mulai.'</a><br>';
                        echo '<a>Selesai : '.$json->selesai.'</a><br><br><h6>STATUS</h6>';
                        if($json->soal == NULL){
                            echo "soal belum tersedia";
                            echo '</p>';
                            echo '<a href="';
                            echo $json->soal;
                            echo '" class="btn btn-danger disabled">';
                            echo 'Download Soal</a>';
                        }
                        else{
                            echo "soal tersedia";
                            echo '</p>';
                            echo '<a href="';
                            echo $json->soal;
                            echo '" class="btn btn-success">';
                            echo 'Download Soal</a>';
                        }
                        ?>
                    </div>
                </div><br>
            </div>
            <?php } ?>
        </div>

    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</body>
</html>