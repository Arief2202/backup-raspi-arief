<?php
    $day = array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jum'at", "Sabtu", );
    date_default_timezone_set('Asia/Jakarta');
    $dayTime = $day[date('w')];
    $date = date('H:i:s');
    echo $dayTime.' '.$date;
?>