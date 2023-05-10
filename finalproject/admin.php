<?php 
    require_once("config.php");
    require_once("auth.php"); 
    if($_SESSION["user"]["type"] == 2) header("Location: guru.php"); 
    else if($_SESSION["user"]["type"] == 3) header("Location: siswa.php"); 
    $koneksi = mysqli_connect("localhost","root","","finalproject") or die(mysqli_error());
    $day = array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jum'at", "Sabtu");
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/admin.css">
        <link rel="stylesheet" href="css/dropdown.css">
        <link rel="stylesheet" href="css/time.css">
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.js"></script>
        <script> 
            if(window.location.search == ""){
                window.location.href="admin.php?edit=guru";
            }
        </script>
        <title>Admin</title>
    </head>
    <body>
    <!------ Include the above in your HEAD tag ---------->
        <!------------------------------------------------------------------------------------------------------------------------------------------------->
       <div id="wrapper">    
            <!-- Sidebar -->
            <div id="sidebar-wrapper" style="overflow-x: hidden;">
                <ul class="sidebar-nav">
                    <li class="sidebar-brand">
                        <a href="logout.php">
                            LOGOUT
                        </a>
                    </li>
                    <h5 style="color: white;text-align:center;">Edit Data</h5>
                    <li>
                        <a href="?edit=guru">Data Guru</a>
                    </li>
                    <li>
                        <a href="?edit=siswa">Data Siswa</a>
                    </li>
                    <br>
                    <a href="?edit=kelas"><h5 style="color: white;text-align:center;">Edit Kelas</h5></a>
                    <?php 
                        $sql = "SELECT * FROM data_kelas";
                        $query = mysqli_query($koneksi, $sql);
                        while($data = mysqli_fetch_array($query)){

                        echo '<li><a href="?edit='.$data['id_kelas'].'&posisi=';
                        if($_GET['posisi']=="") echo "siswa";
                        else echo $_GET['posisi'];
                        echo '">'.$data['nama'].'</a></li>';
                        }
                    ?>
                </ul>
            </div>



            <!-- /#sidebar-wrapper -->
    
            <!-- Page Content -->
            <div id="page-content-wrapper">
            <a href="#menu-toggle" class="btn btn-default h" id="menu-toggle">
                <img style="width:30px;"src="img/menu.png">  
            </a>       
                <div class="container-fluid">    
                    <a id="position" class="hidden"><?php echo $_GET['edit'];?></a>
                    <button id="myBtn" class="transparent-button plus-button">
                        <img style="width:30px;"src="img/add_white.png">
                    </button>
                    <?php if($_GET['edit'] == 'guru' || $_GET['edit'] == 'siswa' || $_GET['edit'] == 'kelas'){?>        
                    
                    <!-- <br><br> -->
                    <div class="row">
                        <table class="styled-table">
                            <thead>
                                <tr>
                                    <div class="text-center2"><b>
                                            <?php
                                                echo "DATABASE ";
                                                echo strtoupper($_GET['edit']);
                                            ?>
                                        </b>
                                    </div> 
                                </tr>
                            </thead>
                            <thead>
                                <tr>
                                    <?php 
                                        if($_GET['edit'] == 'siswa') echo "<th>NIS</th>"; 
                                        else if($_GET['edit'] == 'guru') echo "<th>NIP</th>"; 
                                        echo "<th>Nama</th>";
                                        if($_GET['edit'] == 'kelas') echo "<th>ID_Kelas</th>"; 
                                    ?>
                                    <th>Edit</th>
                                </tr>
                            </thead>
                            <?php
                                    $sql = "SELECT * FROM data_".$_GET['edit'];
                                    $query = mysqli_query($koneksi, $sql);
                                    echo '<tbody>';
                                    while($data = mysqli_fetch_array($query)){
                                        if($_GET['edit'] == 'siswa') $pk = $data['nisn']; 
                                        else if($_GET['edit'] == 'guru') $pk = $data['nip'];
                                        if($pk != 0){
                                            echo "<tr>";
                                            echo "<td>".$pk."</td>";                                    
                                            echo "<td>".$data['nama']."</td>";    
                                            ?>
                                            <td>
                                            <a href="admin.php?edit=<?php echo $_GET['edit']?>&aksi=edit&id=<?php echo $pk ?>">
                                                <img style="width:30px;"src="img/edit.png"></a>
                                            </td>
                                            <?php
                                            echo "</tr>";
                                        }
                                        else if($_GET['edit'] == 'kelas'){           
                                            echo '<tr>';                         
                                            echo '<td>'.$data['nama'].'</td>'; 
                                            echo '<td>'.$data['id_kelas'].'</td>';
                                            echo '<td><a href="admin.php?edit='.$_GET['edit'].'&aksi=delete&id='.$data['id'].'">';
                                            echo '<img style="width:30px;" src="img/remove.png">';
                                            echo '</a></td>';                                            
                                            echo '</tr>';
                                        }                                        
                                    }
                                    echo '</tbody></table>';
                                }
                                else{
                                    echo '<a id="siswaBtn" class="siswaBtn" href="?edit='.$_GET['edit'].'&posisi=siswa">SISWA</a>';
                                    echo '<a id="guruBtn" class="guruBtn" href="?edit='.$_GET['edit'].'&posisi=guru">GURU</a>';
                                    if($_GET['posisi'] == 'siswa'){?>
                                        <script>
                                            document.getElementById("siswaBtn").classList.add("active");
                                            document.getElementById("guruBtn").classList.remove("active");
                                        </script>
                                        <?php
                                    }
                                    else if($_GET['posisi'] == 'guru'){?>
                                        <script>
                                         document.getElementById("siswaBtn").classList.remove("active");
                                         document.getElementById("guruBtn").classList.add("active");
                                        </script>
                                        <?php
                                    }
                                    ?>
                                    

                                    <br><br>
                                    <div class="row">
                                        <table class="styled-table">
                                            <thead>
                                                <tr>
                                                    <div class="text-center2" ><b>
                                                    <?php
                                                        echo strtoupper($_GET['posisi'])." ";
                                                        $sql = "SELECT * FROM data_kelas";
                                                        $query = mysqli_query($koneksi, $sql);
                                                        while($data = mysqli_fetch_array($query)){
                                                            if($data['id_kelas'] == $_GET['edit']){
                                                                echo $data['nama'];
                                                            }
                                                        }
                                                    ?>
                                                    </b></div> 
                                                </tr>
                                            </thead>
                                            <thead>
                                                <tr>
                                                    <?php 
                                                        if($_GET['posisi'] == 'siswa') {
                                                            echo "<th>NIS</th>";
                                                            echo "<th>Nama</th>";
                                                        } 
                                                        else if($_GET['posisi'] == 'guru') {
                                                            echo "<th>Nama</th>";
                                                            echo "<th>Mapel</th>";
                                                            echo "<th>Hari</th>";
                                                            echo "<th>Jam</th>";
                                                        }
                                                    ?>
                                                    <th>Edit</th>
                                                </tr>
                                            </thead>
                                            
                                            <?php
                                                if($_GET['posisi'] == 'guru'){
                                                    $sql = "SELECT * FROM kelas";
                                                    $query = mysqli_query($koneksi, $sql);
                                                    echo '<tbody>';
                                                    while($data = mysqli_fetch_array($query)){
                                                        $sql2 = "SELECT * FROM data_guru";
                                                        $query2 = mysqli_query($koneksi, $sql2);           
                                                        while($data2 = mysqli_fetch_array($query2)){
                                                            if($data['guru'] == $data2['nip'] && $_GET['edit'] == $data['kelas']){
                                                                echo '<tr>';  
                                                                echo '<td>';     
                                                                echo $data2['nama'];
                                                                echo '</td>'; 
                                                                echo '<td>'.$data['mapel'].'</td>';
                                                                echo '<td>'.$day[$data['hari']].'</td>';
                                                                echo '<td>'.$data['jam'].'</td>';
                                                                echo '<td><a href="admin.php?edit='.$_GET['edit'].'&aksi=delete&posisi=guru&id='.$data['id'].'">';
                                                                echo '<img style="width:30px;" src="img/remove.png">';
                                                                echo '</a></td>';
                                                                echo '</tr>';
                                                                break;
                                                            }
                                                        }       
                                                    }
                                                    echo '</tbody>';
                                                }
                                                 else if($_GET['posisi'] == 'siswa'){
                                                    echo '<tbody>';                                                    
                                                    $sql = "SELECT * FROM data_siswa";
                                                    $query = mysqli_query($koneksi, $sql);     
                                                    while($data = mysqli_fetch_array($query)){
                                                        if($_GET['edit'] == $data['kelas']){
                                                            echo '<tr>';  
                                                            echo '<td>'.$data['nisn'].'</td>';
                                                            echo '<td>';     
                                                            echo $data['nama'];
                                                            echo '</td>'; 
                                                            echo '<td><a href="admin.php?edit='.$_GET['edit'].'&aksi=delete&posisi=siswa&id='.$data['nisn'].'">';
                                                            echo '<img style="width:30px;" src="img/remove.png">';
                                                            echo '</a></td>';
                                                            echo '</tr>';
                                                        }
                                                    }       
                                                    echo '</tbody>';
                                                }
                                                    
                                            ?>
                                        </table>
                                        
                                    </div>


                                    <?php
                                    // date_default_timezone_set('Asia/Jakarta');
                                    // $date = date('N H:i:s');
                                    // echo '<h5 style="color:#fff">'.$date.'</h5>';
                                }
                            ?>
                    </div>	
                    

                </div>
            </div>
            <!-- /#page-content-wrapper -->
        </div>
        <script>
            $("#menu-toggle").click(function(e) {
                e.preventDefault();
                $("#wrapper").toggleClass("toggled");
            });
        </script>
        <form action="" method="POST">
            <div id="myModal" class="modal hidden">
                <div class="modal-content">
                        <span class="close">&times;</span>
                        <?php if($_GET['edit'] == 'guru'){
                                if($_GET['aksi'] == 'edit'){
                                    $sql = "SELECT * FROM data_guru WHERE nip = ".$_GET['id'];
                                    $stmt = $db->prepare($sql);
                                    $stmt->execute();
                                    $user = $stmt->fetch(PDO::FETCH_ASSOC);
                                    echo '<h2>Edit Data ';
                                }
                                else echo '<h2>Add Data '; 
                                echo $_GET['edit']; 
                        ?>
                        </h2>
                            <div class="inputBox">
                                <?php
                                    if($_GET['aksi'] == 'edit')
                                    echo '<input type="text" name="nip" required="" value="'.$user['nip'].'">';
                                    else 
                                    echo '<input type="text" name="nip" required="">';
                                ?>
                                <label>NIP</label>
                            </div>
                            <div class="inputBox">
                                <?php
                                    if($_GET['aksi'] == 'edit')
                                    echo '<input type="text" name="nama" required="" value="'.$user['nama'].'">';
                                    else 
                                    echo '<input type="text" name="nama" required="">';
                                ?>
                                <label>Nama</label>
                            </div>
                            <div class="inputBox">
                                <?php
                                    if($_GET['aksi'] == 'edit')
                                    echo '<input type="password" name="password" required="" value="123456">';
                                    else 
                                    echo '<input type="password" name="password" required="" value="123456">';
                                ?>
                                <label>Password</label>
                            </div>
                        <?php } else if($_GET['edit'] == 'siswa'){
                                if($_GET['aksi'] == 'edit'){
                                    $sql = "SELECT * FROM data_siswa WHERE nisn = ".$_GET['id'];
                                    $stmt = $db->prepare($sql);
                                    $stmt->execute();
                                    $user = $stmt->fetch(PDO::FETCH_ASSOC);
                                    echo '<h2>Edit Data ';
                                }
                                else echo '<h2>Add Data '; 
                                echo $_GET['edit']; 
                        ?>
                        </h2>
                            <div class="inputBox">
                                <?php
                                    if($_GET['aksi'] == 'edit')
                                    echo '<input type="text" name="nisn" required="" value="'.$user['nisn'].'">';
                                    else 
                                    echo '<input type="text" name="nisn" required="">';
                                ?>
                                <label>NISN</label>
                            </div>
                            <div class="inputBox">
                                <?php
                                    if($_GET['aksi'] == 'edit')
                                    echo '<input type="text" name="nama" required="" value="'.$user['nama'].'">';
                                    else 
                                    echo '<input type="text" name="nama" required="">';
                                ?>
                                <label>Nama</label>
                            </div>
                            <div class="form-group">
                                <label for="kelamin" style="color: #03a9f4;">Jenis Kelamin</label>
                                <select class="form-control" id="kelamin" name="kelamin">
                                <option value="L">L</option>
                                <option value="P">P</option>
                                </select>
                            </div>     
                            <?php echo '<script> document.getElementById("kelamin").value = "'.$user['kelamin'].'"; </script>'; ?>
                            <div class="inputBox">
                                <?php
                                    if($_GET['aksi'] == 'edit')
                                    echo '<input type="password" name="password" required="" value="123456">';
                                    else 
                                    echo '<input type="password" name="password" required="" value="123456">';
                                ?>
                                <label>Password</label>
                            </div>

                        <?php }else if($_GET['edit'] == 'kelas'){?>
                                <h2>Add Data <?php echo $_GET['edit']; ?></h2>
                                <div class="inputBox">
                                    <input type="text" name="nama" required="">
                                    <label>Nama Kelas</label>
                                </div>
                                <div class="inputBox">
                                    <input type="text" name="id_kelas" required="">
                                    <label>ID Kelas</label>
                                </div>
                                <input type="submit" name="btn_simpan2" value="Simpan">
                                <input type="reset" name="reset" value="Besihkan">

                        <?php }else if($_GET['posisi'] == 'siswa'){?>
                            <h2>Add Siswa Kelas 
                                <?php 
                                $sql = "SELECT * FROM data_kelas";
                                $query = mysqli_query($koneksi, $sql);
                                while($data = mysqli_fetch_array($query)){
                                    if($_GET['edit'] == $data['id_kelas']) echo $data['nama']; 
                                }
                                ?>
                            </h2>                            
                            <div class="row">
                                <div class="col-md">
                                    <a style="color: white;">Siswa</a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md">
                                    <div class="mydropdown">
                                        <select name="addsiswa">
                                            <?php
                                                $sql = "SELECT * FROM data_siswa";
                                                $query = mysqli_query($koneksi, $sql);
                                                echo "<option value=\"-1\">";
                                                echo "Pilih Siswa";
                                                echo "</option>";
                                                while($data = mysqli_fetch_array($query)){
                                                    if($data['kelas'] == $_GET['$edit']){
                                                        echo "<option value=\"".$data['nisn']."\">";
                                                        echo $data['nama'];
                                                        echo "</option>";
                                                    }
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        <?php }else if($_GET['posisi'] == 'guru'){?>
                            <h2>Add Guru Kelas 
                                <?php 
                                $sql = "SELECT * FROM data_kelas";
                                $query = mysqli_query($koneksi, $sql);
                                while($data = mysqli_fetch_array($query)){
                                    if($_GET['edit'] == $data['id_kelas']) echo $data['nama']; 
                                }
                                ?>
                            </h2>                            
                            <div class="row">
                                <div class="col-md">
                                    <a style="color: white;">Guru</a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md">
                                    <div class="mydropdown">
                                        <select name="guru">
                                            <?php
                                                $sql = "SELECT * FROM data_guru";
                                                $query = mysqli_query($koneksi, $sql);
                                                echo "<option value=\"-1\">";
                                                echo "Pilih Guru";
                                                echo "</option>";
                                                while($data = mysqli_fetch_array($query)){
                                                    if($data['nip'] != 0){
                                                        echo "<option value=\"".$data['nip']."\">";
                                                        echo $data['nama'];
                                                        echo "</option>";
                                                    }
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col"><br>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md">
                                    <div class="inputBox">
                                        <input type="text" name="mapel" required="">
                                        <label>Mata Pelajaran</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md">
                                        <a style="color: white;">Jam Pelajaran</a><br>
                                        <input class="tmClass" type="time" name="jam">
                                </div>
                                <div class="col-md"><br></div>
                                <div class="col-md">
                                    <a style="color: white;">Hari</a><br>
                                    <div class="mydropdown" style="width:200px;">
                                        <select name="hari">
                                            <option value="0">Minggu</option>
                                            <option value="1">Senin</option>
                                            <option value="2">Selasa</option>
                                            <option value="3">Rabu</option>
                                            <option value="4">Kamis</option>
                                            <option value="5">Jum'at</option>
                                            <option value="6">Sabtu</option>
                                        </select>
                                    </div>
                                </div>
                             </div>
                            <div class="row">
                            <br><br>
                            </div>
                        <?php }?>
                        <br><br>
                        <div class="row">
                            <input type="submit" name="btn_simpan" value="Simpan">
                        </div>
                        <?php
                            if($_GET['aksi'] == 'edit'){
                                ?>
                                <a href="admin.php?edit=<?php echo $_GET['edit'];?>&aksi=delete&id=<?php echo $_GET['id'] ?>"
                                style="position:absolute; bottom: 43px; right: 50px;"
                                >
                                <img src="img/remove.png" style="width:35px;"></a>
                                <?php
                            }
                        ?>
                </div>
            </div>
        </form>
        
        <?php
            if($_GET['aksi'] == 'edit'){
                echo '<script>';
                echo 'var modal = document.getElementById("myModal");';
                echo 'modal.style.display = "block";';
                echo '</script>';
            }
        ?>       


        <?php
            if (isset($_POST['btn_simpan'])){
                if($_GET['edit'] == 'guru'){
                    $nip = filter_input(INPUT_POST, 'nip', FILTER_SANITIZE_STRING);
                    $nama = filter_input(INPUT_POST, 'nama', FILTER_SANITIZE_STRING);
                    // $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
                    // $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
                    $username = "";
                    $email = "";
                    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
                    $type = "2";
                    $foto = "default.jpg";
                    if(empty($password)) $password = '$2y$10$cDG4J8J8AbPI6G5AiAnZi.FGtRX.pXTxZ.0eK.GxRPk5IczyHWUcO'; //123456
                    if(!empty($nip) && !empty($nama) && !empty($password)){
                        $sql;
                        if($_GET['aksi'] == 'edit'){
                            $sql =  "UPDATE data_guru SET ".
                            "nip = '".$nip."', ".
                            "nama = '".$nama."', ".
                            "password = '".$password.
                            "' WHERE data_guru.nip = ".$_GET["id"].";";
                        }
                        else $sql = "INSERT INTO data_guru (id, nip, nama, username, email, password, type, foto) VALUES(NULL,".$nip.",'".$nama."','".$username."','".$email."','".$password."','".$type."','".$foto."')";
                        $simpan = mysqli_query($koneksi, $sql);
                        $nip = "";
                        $nama = "";
                        $username = "";
                        $email = "";
                        $password = "";
                        $type = "";
                        $foto = "";
                        if($simpan){
                            echo "<script>window.location.href='admin.php?edit=guru';</script>";
                        }
                    }
                }
                else if($_GET['edit'] == 'siswa'){
                    $nis = "";
                    $nisn = filter_input(INPUT_POST, 'nisn', FILTER_SANITIZE_STRING);
                    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
                    $nama = filter_input(INPUT_POST, 'nama', FILTER_SANITIZE_STRING);
                    // $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
                    // $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
                    $kelas = "";
                    $kelamin = filter_input(INPUT_POST, 'kelamin', FILTER_SANITIZE_STRING);
                    $email = "";
                    $foto = "default.jpeg";
                    $type = "3";
                    if(!empty($nisn) && !empty($nama) && !empty($password)){
                        $sql;
                        if($_GET['aksi'] == 'edit'){
                            $sql =  "UPDATE data_siswa SET ".
                            "nisn = '".$nisn."', ".
                            "password = '".$password."', ".
                            "nama = '".$nama."', ".
                            "kelamin = '".$kelamin.
                            "' WHERE data_siswa.nisn = ".$_GET["id"].";";
                        }
                        else $sql = "INSERT INTO data_siswa (id, nis, nisn, password, nama, kelas, kelamin, email, foto, type) VALUES(NULL,'".$nis."','".$nisn."','".$password."','".$nama."','".$kelas."','".$kelamin."','".$email."','".$foto."','".$type."')";
                        $simpan = mysqli_query($koneksi, $sql);
                        $nis = "";
                        $nisn = "";
                        $password = "";
                        $nama = "";
                        $kelas = "";
                        $kelamin = "";
                        $email = "";
                        $foto = "";
                        $type = "";
                        if($simpan){
                            echo "<script>window.location.href='admin.php?edit=siswa';</script>";
                        }
                    } 
                }
                else if($_GET['edit'] == 'kelas'){
                    $nama = filter_input(INPUT_POST, 'nama', FILTER_SANITIZE_STRING);
                    $id_kelas = filter_input(INPUT_POST, 'id_kelas', FILTER_SANITIZE_STRING);
                    if(!empty($nama) && !empty($id_kelas)){   
                        $sql = "INSERT INTO data_kelas (id, nama, id_kelas) VALUES(NULL,'".$nama."','".$id_kelas."')";
                        $simpan = mysqli_query($koneksi, $sql);
                        $nama = "";
                        $id_kelas = "";
                        if($simpan){
                            echo "<script>window.location.href='admin.php?edit=kelas';</script>";
                        }
                    }
                } 
                else if($_GET['posisi'] == 'guru'){
                    $mapel = filter_input(INPUT_POST, 'mapel', FILTER_SANITIZE_STRING);
                    $jam = filter_input(INPUT_POST, 'jam', FILTER_SANITIZE_STRING);
                    $hari = filter_input(INPUT_POST, 'hari', FILTER_SANITIZE_STRING);
                    $guru = filter_input(INPUT_POST, 'guru', FILTER_SANITIZE_STRING);
                    $kelas = $_GET['edit'];
                    if(!empty($mapel)){   
                        $sql = "INSERT INTO kelas (id, mapel, kelas, guru, hari, jam) VALUES(NULL,'".$mapel."','".$kelas."','".$guru."','".$hari."','".$jam."')";
                        $simpan = mysqli_query($koneksi, $sql);
                        $mapel = "";
                        $jam = "";
                        $hari = "";
                        $guru = "";
                        $kelas = "";
                        if($simpan){
                            echo "<script>window.location.href='admin.php?edit=".$_GET['edit']."&posisi=guru';</script>";
                        }
                    }            
                }
                else if($_GET['posisi'] == 'siswa'){
                    $addsiswa = filter_input(INPUT_POST, 'addsiswa', FILTER_SANITIZE_STRING);

                    if(!empty($addsiswa)){   
                        $sql = "UPDATE data_siswa SET kelas = '".$_GET['edit']."' WHERE data_siswa.nisn = ".$addsiswa.";";
                        $simpan = mysqli_query($koneksi, $sql);
                        $addsiswa = "";
                        if($simpan){
                            echo "<script>window.location.href='admin.php?edit=".$_GET['edit']."&posisi=siswa';</script>";
                        }
                    }            
                }
                else {
                    echo '<script>alert("Unknown Error")</script>';
                }
            }
            
            if($_GET['aksi'] == 'delete'){
                if($_GET['edit'] == 'guru'){
                    $sql_hapus = "DELETE FROM data_guru WHERE nip=".$_GET['id'];
                    $hapus = mysqli_query($koneksi, $sql_hapus);
                    if($hapus){
                        echo "<script>window.location.href='admin.php?edit=guru';</script>";
                    }
                }
                else if($_GET['edit'] == 'siswa'){
                    $sql_hapus = "DELETE FROM data_siswa WHERE nisn=".$_GET['id'];
                    $hapus = mysqli_query($koneksi, $sql_hapus);
                    if($hapus){
                        echo "<script>window.location.href='admin.php?edit=siswa';</script>";
                    }
                }
                else if($_GET['edit'] == 'kelas'){
                    $sql_hapus = "DELETE FROM data_kelas WHERE id=".$_GET['id'];
                    $hapus = mysqli_query($koneksi, $sql_hapus);
                    if($hapus){
                        echo "<script>window.location.href='admin.php?edit=kelas';</script>";
                    }
                }
                else if($_GET['posisi'] == 'guru'){
                    $sql_hapus = "DELETE FROM kelas WHERE id=".$_GET['id'];
                    $hapus = mysqli_query($koneksi, $sql_hapus);
                    if($hapus){
                        echo "<script>window.location.href='admin.php?edit=".$_GET['edit']."&posisi=guru';</script>";
                    }
                }
                else if($_GET['posisi'] == 'siswa'){
                    $sql_hapus = "UPDATE data_siswa SET kelas = '' WHERE data_siswa.nisn = ".$_GET['id'].";";
                    $simpan = mysqli_query($koneksi, $sql_hapus);
                    if($simpan){
                        echo "<script>window.location.href='admin.php?edit=".$_GET['edit']."&posisi=siswa';</script>";
                    }         
                }
            }
        ?>        

        <script>
            var modal = document.getElementById("myModal");
            var btn = document.getElementById("myBtn");
            var span = document.getElementsByClassName("close")[0];
            if (window.history.replaceState) {
	            window.history.replaceState( null, null, window.location.href );
            }
            btn.onclick = function() {
                modal.style.display = "block";
            }
            span.onclick = function() {
                modal.style.display = "none";
                <?php 
                    if(($_GET['edit'] == 'guru') || ($_GET['edit'] == 'siswa')){
                        echo 'window.location.href="admin.php?edit='.$_GET['edit'].'";';
                    }
                ?>
            }
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                    <?php 
                        if(($_GET['edit'] == 'guru') || ($_GET['edit'] == 'siswa')){
                            echo 'window.location.href="admin.php?edit='.$_GET['edit'].'";';
                        }
                    ?>
                }
            }

        </script>
        <script src="js/dropdown.js"></script>
    </body>
</html>
