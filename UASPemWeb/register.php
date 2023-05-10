<?php
    $koneksi = mysqli_connect("localhost","root","","uas_pemweb") or die(mysqli_error());
    if (isset($_POST['btn_simpan'])){
        $nama = filter_input(INPUT_POST, 'nama', FILTER_SANITIZE_STRING);
        $tempat = filter_input(INPUT_POST, 'tempat_lahir', FILTER_SANITIZE_STRING);
        $lahir_tgl = filter_input(INPUT_POST, 'tgl_lahir', FILTER_SANITIZE_STRING);
        $lahir_bln = filter_input(INPUT_POST, 'bln_lahir', FILTER_SANITIZE_STRING);
        $lahir_thn = filter_input(INPUT_POST, 'thn_lahir', FILTER_SANITIZE_STRING);
        $tgl_lahir = $lahir_thn.'-'.$lahir_bln.'-'.$lahir_tgl;
        $alamat = filter_input(INPUT_POST, 'alamat', FILTER_SANITIZE_STRING);
        $kelamin = filter_input(INPUT_POST, 'kelamin', FILTER_SANITIZE_STRING);
        $agama = filter_input(INPUT_POST, 'agama', FILTER_SANITIZE_STRING);
        $warganegara = filter_input(INPUT_POST, 'warganegara', FILTER_SANITIZE_STRING);
        $hobi = filter_input(INPUT_POST, 'hobi', FILTER_SANITIZE_STRING);

        //INSERT INTO `biodata` (`id`, `nama`, `tempat_lahir`, `tanggal_lahir`, `alamat`, `jenis_kelamin`, `agama`, `kewarganegaraan`, `hobi`) VALUES (NULL, 'Arief', 'Sby', '2000-02-22', 'Sby', 'Laki-Laki', 'Islam', 'WNI', 'Nyoba');
        $sql = "INSERT INTO biodata (id, nama, tempat_lahir, tanggal_lahir, alamat, jenis_kelamin, agama, kewarganegaraan, hobi) VALUES(NULL,'".$nama."','".$tempat."','".$tgl_lahir."','".$alamat."','".$kelamin."','".$agama."','".$warganegara."','".$hobi."')";
        $simpan = mysqli_query($koneksi, $sql);
        if($simpan){
            echo '<script> alert("Save Success"); </script>';
            echo "<script>window.location.href='index.php';</script>";
        }
        else{
            echo '<script> alert("Save Failed"); </script>';
            echo "<script>window.location.href='index.php';</script>";
        }
    }
    
?>