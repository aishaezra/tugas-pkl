<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "crud";

$koneksi = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) {
    die("Wrong!");
}
$nim = "";
$nama = "";
$alamat = "";
$fakultas = "";
$succes = "";
$error = "";

if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}
if ($op == 'delete') {
    $id = $_GET['id'];
    $sql1 = "DELETE FROM mahasiswa WHERE id = '$id'";
    $q1 = mysqli_query($koneksi, $sql1);
    if ($q1) {
        $succes = "Success To Deleted";
    } else {
        $error = "Failed to Deleted";
    }
}

if ($op == 'edit') {
    $id        = $_GET['id'];
    $sql1      = "SELECT * FROM mahasiswa WHERE id = '$id'";
    $q1        = mysqli_query($koneksi, $sql1);
    $r1        = mysqli_fetch_array($q1);
    $nim       = $r1['nim'];
    $nama      = $r1['nama'];
    $alamat    = $r1['alamat'];
    $fakultas  = $r1['fakultas'];

    if (empty($r1)) {
        $error = "Your Data Isn't Found";
    }
}

// UNTUK CREATE
if (isset($_POST['simpan'])) {
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $fakultas = $_POST['fakultas'];

    // UNTUK UPDATE
    if ($nim && $nama && $alamat && $fakultas) {
        if ($op == 'edit') {
            $sql1 = "UPDATE mahasiswa SET nim = '$nim', nama = '$nama', alamat = '$alamat', fakultas = '$fakultas' WHERE id = '$id'";
            $q1 = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $succes = "Update Success";
            } else {
                $error = "Failed To Update";
            }
        } else {
            $sql2 = "INSERT INTO mahasiswa(nim, nama, alamat, fakultas) values ('$nim','$nama','$alamat','$fakultas')";
            $sq2 = mysqli_query($koneksi, $sql2);
            if ($sq2) {
                $succes = "Succed :)";
            } else {
                $error = "Failed :(";
            }
        }
    } else {
        $error = "Please Enter All Data";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>


<body>
    <div class="mx-auto">
        <!-- memasukkan data -->
        <div class="card">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs">
                    <li class="nav-item">
                        <a class="btn btn-outline-dark" aria-current="true" href="index.php">Create Data</a>
                        <a class="btn btn-outline-dark" aria-current="true" href="data.php">Data Mahasiswa</a>
                    </li>
                    
                </ul>
            </div>

            <div class="card-body">
                <?php
                if ($error) {
                ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error ?>
                    </div>
                <?php
                    header("refresh:5;url=index.php");
                }
                ?>

                <?php
                if ($succes) {
                ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $succes ?>
                    </div>
                <?php
                }
                ?>


                <form action="" method="POST">
                    <div class="mb-3">
                        <label for="nim" class="form-label">NIM</label>
                        <input type="text" class="form-control" id="nim" name="nim" placeholder="enter your NIM" value="<?php echo $nim ?>">
                    </div>

                    <div class="mb-3">
                        <label for="nama" class="form-label">Name</label>
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="enter your Name" value="<?php echo $nama ?>">
                    </div>

                    <div class="mb-3">
                        <label for="alamat" class="form-label">Address</label>
                        <input type="text" class="form-control" id="alamat" name="alamat" placeholder="enter your address" value="<?php echo $alamat ?>">
                    </div>

                    <div class="mb-3">
                        <label for="fakultas" class="form-label">Fakultas</label>
                        <select class="form-control" name="fakultas" id="fakultas">
                            <option style align="center" value="">- Pilih Fakultas -</option>
                            <option value="Kedokteran" <?php if ($fakultas == "Kedokteran") echo "selected" ?>>Kedokteran</option>
                            <option value="Farmasi" <?php if ($fakultas == "Farmasi") echo "selected" ?>>Farmasi</option>
                            <option value="Hukum" <?php if ($fakultas == "Hukum") echo "selected" ?>>Hukum</option>
                            <option value="Politik" <?php if ($fakultas == "Politik") echo "selected" ?>>Politik</option>
                            <option value="Manajemen" <?php if ($fakultas == "Manajemen") echo "selected" ?>>Manajemen</option>
                            <option value="Sastra" <?php if ($fakultas == "Sastra") echo "selected" ?>>Satra</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <a class="btn btn-dark" aria-current="true" href="home_page.html">Home</a>
                        <input type="submit" name="simpan" value="Send" class="btn btn-success">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>