<?php 
    require_once("config.php");
    session_start();
    if(!isset($_SESSION["user"])) header("Location: index.php");
    else if($_SESSION["user"]["type"] == 1) header("Location: admin.php"); 
    else if($_SESSION["user"]["type"] == 2) header("Location: guru.php");
    $koneksi = mysqli_connect("localhost","root","","finalproject") or die(mysqli_error());
    
    $day = array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jum'at", "Sabtu", );
    // $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    // $url_components = parse_url($actual_link);
    // parse_str($url_components['query'], $params);
    $sql = "SELECT * FROM `data_kelas` WHERE `id_kelas` = '".$_SESSION["user"]["kelas"]."'";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $class = $stmt->fetch(PDO::FETCH_ASSOC);
    $fullClass = $class["nama"];
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Halaman Siswa</title>
    <script> 
        if(window.location.search == ""){
            window.location.href="siswa.php?posisi=kelas";
        }
    </script>

    <link rel="stylesheet" href="css/bootstrap.css" />
    <link rel="stylesheet" href="css/guru.css">
    
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="?posisi=profile">
            <div class="container">
                    <img src="img/user/siswa/<?php echo $_SESSION["user"]["foto"]; ?>" class = "rounded-circle"width="60" height="60">
                    <div class="col">
                    </div>
                    <div class="col">
                        <div class="row nameNav">
                            <?php echo $_SESSION["user"]["nama"];?>
                        </div>
                        <div class="row classNav"><?php echo $fullClass;?></div>
                    </div>
            </div>
        </a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link" href="?posisi=kelas">Kelas</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="?posisi=jadwal">Jadwal</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="?posisi=profile">Profile</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="logout.php">LOGOUT</a>
        </li>
        </ul>
    </div>
    </nav>



    <?php 
    if($_GET['posisi'] == "profile"){ ?>
    <br>
    <div class="container">
        <div class="card">
            <div class="card-header" style="text-align: center;">
            <div class="cardHeaderText">PROFILE</div>
            </div>
            <div class="card-body">
                <div class="text-center">
                    <img src="img/user/siswa/<?php echo $_SESSION["user"]["foto"]; ?>" class = "rounded-circle midImg">
                    <!-- <img href="#" src="img/Background.jpg" class = "rounded-circle midImg"> -->
                    <!-- <button href="#" class = "myImg"></button> -->
                    <a type="button" class="myImg" data-toggle="modal" data-target="#changeImage"></a>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="changeImage" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <form action="" method="post" enctype="multipart/form-data">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">CHANGE PHOTO</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                            Pilih file: <input type="file" name="berkas" />
                        </form> 
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                        <input type="submit" class="btn btn-primary" name="upload" value="Save"/>
                    </div>
                    </div>
                </div>
                </div>
                <div class="text-center">
                    <h1><?php echo $_SESSION["user"]["nama"]; ?></h1>
                </div>
                <div class="text-center">
                    <h5>NISN. <?php echo $_SESSION["user"]["nisn"]; ?></h5>
                </div>
                <div class="text-center">
                    <h5>Kelas <?php echo $fullClass;?></h5>
                </div>
                
            </div>
        </div>
        <?php
        if(isset($_POST['upload'])){
            $namaFile = $_FILES['berkas']['name'];
            $extension = pathinfo($namaFile, PATHINFO_EXTENSION);
            $tmpImage = $_FILES['berkas']['tmp_name'];
            $SavedFileName = $_SESSION["user"]["nisn"].'.'.$extension;
            $dirUpload = "/home/web/finalproject/img/user/siswa";
            $locationSave = $dirUpload.'/'.$SavedFileName;

            $tmpfile = $_FILES['avatar']['tmp_name'];

            switch ($extension) {
            case 'jpg':
            case 'jpeg':
            $image = imagecreatefromjpeg($tmpImage);
            break;
            case 'png':
            $image = imagecreatefrompng($tmpImage);
            break;
            default:
            die("unknown extensions");
            }
            $terupload = imagejpeg($image, $locationSave);

            if($terupload){
                $sql =  "UPDATE data_siswa SET ".
                        "foto = '".$SavedFileName.
                        "' WHERE data_siswa.nisn = ".$_SESSION["user"]["nisn"].";";
                $simpan = mysqli_query($koneksi, $sql);
                if($simpan){
                    $_SESSION["user"]["foto"] = $SavedFileName;
                    echo '<script> alert("Upload Success"); </script>';
                    echo "<script>window.location.href='siswa.php?posisi=profile';</script>";
                }
            } 
            else echo '<script> alert("Upload Gagal"); </script>';
        }
        ?>
        <br>
        <?php if($_GET['aksi'] == "edit"){ ?>
        <form action="" method="POST">
        <?php } ?>
            <div class="card">
                <div class="card-header">
                    <div class="cardHeaderText">ACCOUNT</div>
                    <?php if($_GET['aksi'] == "edit"){ ?>
                    <input type="submit" name="save" value="Simpan" class="btn btn-success cardHeaderEditBtn">
                    <!-- <a href="?posisi=profile&aksi=edit&save=save" class="btn btn-success cardHeaderEditBtn">SAVE</a> -->
                    <?php }else{?>
                    <a href="?posisi=profile&aksi=edit" class="btn btn-danger cardHeaderEditBtn">EDIT</a>
                    <?php } ?>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md">
                            <div class="row">
                                <div class="col">NISN</div>
                                <?php if($_GET['aksi'] == "edit"){ ?>
                                    <input class="col userInput" type="text" name="nip" value="<?php echo $_SESSION["user"]["nisn"];?>" readonly>
                                <?php }else{?>
                                    <div class="col"><?php echo $_SESSION["user"]["nisn"]; ?></div>
                                <?php } ?>                            
                            </div>
                            <div class="row">
                                <div class="col">KELAS</div>
                                <?php if($_GET['aksi'] == "edit"){ ?>
                                    <input class="col userInput" type="text" name="nip" value="<?php echo $fullClass;?>" readonly>
                                <?php }else{?>
                                    <div class="col"><?php echo $fullClass;?></div>
                                <?php } ?>                            
                            </div>
                            <div class="row">
                                <div class="col">NAMA</div>
                                <?php if($_GET['aksi'] == "edit"){ ?>
                                    <input class="col userInput" type="text" name="nama" value="<?php echo $_SESSION["user"]["nama"];?>">                                
                                <?php }else{?>
                                    <div class="col"><?php echo $_SESSION["user"]["nama"]; ?></div>                                
                                <?php } ?>
                            </div>
                        </div>
                        <div class="col-md"></div>

                        <div class="col-md">
                            <div class="row">
                                <div class="col">EMAIL</div>
                                <?php if($_GET['aksi'] == "edit"){ ?>
                                    <input class="col userInput" type="email" name="email" value="<?php echo $_SESSION["user"]["email"];?>">                                
                                <?php }else{?>
                                    <div class="col"><?php echo $_SESSION["user"]["email"]; ?></div>                                
                                <?php } ?>
                            </div>
                            <?php if($_GET['aksi'] == "edit"){ ?>
                            <br>
                                <div class="row">
                                    <!-- <div class="col">Password</div> -->
                                    <div class="col">
                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">
                                        Change Password
                                        </button>                                  
                                    </div>
                                </div>  
                            <?php }else{?>      
                            <div class="row">                      
                                <div class="col">PASSWORD</div>
                                <div class="col">********</div> 
                            </div>  
                            <?php }?> 
                        </div>
                        <div class="col-md"></div>
                    </div>
                </div>
                <?php 
                // if($_GET['aksi'] == "edit"){ ?>
                <?php 
                if($_GET['aksi'] == "edit"){
                    echo '</form>';
                }
                if (isset($_POST['save'])){
                    $nama = filter_input(INPUT_POST, 'nama', FILTER_SANITIZE_STRING);
                    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
                    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
                    if(empty($nama)) {
                        echo '<script> alert("Nama tidak boleh kosong"); </script>';
                    }
                    else {
                        $sql =  "UPDATE data_siswa SET ".
                                "nama = '".$nama."', ".
                                "email = '".$email.
                                "' WHERE data_siswa.nisn = ".$_SESSION["user"]["nisn"].";";
                    	$simpan = mysqli_query($koneksi, $sql);
                    	if($simpan){
                            $_SESSION["user"]["nama"] = $nama;
                            $_SESSION["user"]["email"] = $email;
                            $nama = "";
                            $email = "";
                            echo "<script>window.location.href='siswa.php?posisi=profile';</script>";
                    	}
                    }
                }                   
                ?>         
            </div>         
        </form>
    </div>
    
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">    
        <form action="" method="POST">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                            <div class="col">
                                Old Password
                            </div>
                            <div class="col">
                                <input class="col userInput" type="password" name="pw" required="">                            
                            </div>
                            <div class="col">
                                New Password
                            </div>
                            <div class="col">
                                <input class="col userInput" type="password" name="pw1" required="">                      
                            </div>
                            <div class="col">
                                Confirm Password
                            </div>
                            <div class="col">
                                <input class="col userInput" type="password" name="pw2" required="">                      
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <!-- <a type="button" class="btn btn-primary">Save changes</button> -->
                    </div>
                </div>
            </div>                
        </form> 
        <?php
        if (isset($_POST['btn_simpan'])){
            $pw = filter_input(INPUT_POST, 'pw', FILTER_SANITIZE_STRING);
            $pw1 = filter_input(INPUT_POST, 'pw1', FILTER_SANITIZE_STRING);
            $pw2 = filter_input(INPUT_POST, 'pw2', FILTER_SANITIZE_STRING);
            if(password_verify($pw, $_SESSION["user"]["password"])){
                if($pw1 == $pw2){
                    $pwsave = password_hash($pw1, PASSWORD_DEFAULT);
                    $sql = "UPDATE data_siswa SET password = '".$pwsave."' WHERE data_siswa.nisn = ".$_SESSION["user"]["nisn"].";";
                    $simpan = mysqli_query($koneksi, $sql);
                    if($simpan){
                        $_SESSION["user"]["password"] = $pwsave;
                        $pwsave = "";
                        echo "<script>window.location.href='siswa.php?posisi=profile&aksi=edit';</script>";
                    }
                }
                else{
                    echo '<script> alert("New Password and Confirm Password not same!"); </script>';
                }  
            }
            else{
                echo '<script> alert("Wrong Old Password!"); </script>';
            }
        }
        ?>
    </div>     

    <br>   
    <!-- </form> -->
    <?php require_once 'footer.php'; ?>

    <?php } else if($_GET['posisi'] == "jadwal"){ ?>
    <!-- <h1>Anda adalah Guru</h1>
    <h1>Hi <?php //echo $_SESSION["user"]["nama"]?></h1> -->
    <br>
    <div class="container">
        <div class="card">
            <div class="card-header cardName">
                SENIN
            </div>
            <div class="" style="background: darkslategray;">
                <table class="styled-table">
                    <thead>
                        <tr>
                            <?php 
                                // if($params['posisi'] == 'guru') {
                                    echo "<th>Kelas</th>";
                                    echo "<th>Mapel</th>";
                                    // echo "<th>Hari</th>";
                                    echo "<th>Jam</th>";
                                // }
                            ?>
                            <!-- <th>Edit</th> -->
                        </tr>
                    </thead>
                    
                    <?php
                        $sql = "SELECT * FROM kelas";
                        $query = mysqli_query($koneksi, $sql);
                        echo '<tbody>';
                        while($data = mysqli_fetch_array($query)){
                            if($data['kelas'] == $_SESSION["user"]["kelas"]){
                                echo '<tr>';
                                echo '<td>';
                                $sql2 = "SELECT * FROM data_kelas";
                                $query2 = mysqli_query($koneksi, $sql2);
                                while($data2 = mysqli_fetch_array($query2)){
                                    if($data2['id_kelas'] == $data['kelas']){
                                        echo $data2['nama'];
                                        break;
                                    }
                                }
                                echo '</td>';
                                echo '<td>'.$data['mapel'].'</td>';
                                //echo '<td>'.$day[$data['hari']].'</td>';
                                echo '<td>'.date('H:i', strtotime($data['jam'])).' - ';
                                echo date('H:i',strtotime('+2 hour',strtotime($data['jam'])));
                                echo '</td>';
                                echo '</tr>';
                            }
                        }  
                    ?>
                </table>
            </div>
        </div>
    </div>
</div>

<?php } else if($_GET['posisi'] == "kelas"){ ?>
    <?php
        $sql = "SELECT * FROM data_guru";
        $query = mysqli_query($koneksi, $sql);
        while($data = mysqli_fetch_array($query)){
            if($data['nama'] == $_GET['cari']){
                echo '<script> alert("'.$data['nama'].'"); </script>';
            }
        }
    ?>
<?php } ?>

<script src="js/jquery.js"></script>
<script src="js/bootstrap.js"></script>

</body>
</html>
