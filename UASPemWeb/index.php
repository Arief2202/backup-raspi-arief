<?php
  $bulan = array("Bulan","Januari","February","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="register.php" method="POST">
        <pre><h1>        BIODATA</h1></pre>
        <pre>Nama                    : <input type="text" name="nama"></pre>
        <pre>Tempat, Tanggal Lahir   : <input type="text" name="tempat_lahir"> <select name="tgl_lahir">
              <?php 
              for($a=0; $a<=32; $a++){
                echo '<option value="'.$a.'">';
                if($a == 0) echo "Tanggal";
                else echo $a;
                echo '</option>';
              }
              ?>
            </select><select name="bln_lahir">
              <?php 
              for($a=0; $a<=12; $a++){
                echo '<option value="'.$a.'">'.$bulan[$a].'</option>';
              }
              ?>
            </select><select name="thn_lahir">
              <?php 
              for($a=1940; $a<=2422; $a++){
                echo '<option value="';
                if($a == 1940) echo '0">Tahun';
                else echo $a.'">'.$a;
                echo '</option>';
              }
              ?>
            </select></pre>
        <pre>Alamat                  : <input type="text" name="alamat"></pre>
        <pre>Jenis Kelamin           : <input type="radio" name="kelamin" value="male">Laki-Laki<input type="radio" name="kelamin" value="female">Perempuan</pre>
        <pre>Agama                   : <select name="agama">
              <option value="islam">Islam</option>
              <option value="kristen">Kristen</option>
              <option value="hindu">Hindu</option>
              <option value="buddha">Buddha</option>
            </select></pre>
        <pre>Kewarganegaraan         : <select name="warganegara">
              <option value="wni">WNI</option>
              <option value="wna">WNA</option>
            </select></pre>
        <pre>Hobi                    : <input type="checkbox" name="hobi" value="Musik">Musik <input type="checkbox" name="hobi" value="Olahraga">Olahraga <input type="checkbox" name="hobi" value="Travel">Travelling</pre>
        <br>
        <input type="submit" class="btn btn-primary" name="btn_simpan" value="Kirim">   
        <input type="reset" name="reset" value="Reset">
    </form> 
</body>
</html>