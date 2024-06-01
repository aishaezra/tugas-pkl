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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <style>
        .mx-auto {
            width: auto;
            margin-top: 35px;
        }

        .card {
            margin-top: 10px;
        }

        .nav-tabs {
            margin-left: auto;
        }

        .col-12 {
            margin-right: auto;
        }
    </style>

</head>

<body>
    <div class="mx-auto">
        <!-- mengeluarkna data -->
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
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">NIM</th>
                            <th scope="col">Name</th>
                            <th scope="col">Address</th>
                            <th scope="col">Fakultas</th>
                            <th scope="col"></th>
                        </tr>
                    <tbody>
                        <?php
                        $sql2 = "SELECT * FROM mahasiswa ORDER BY id desc";
                        $q2 = mysqli_query($koneksi, $sql2);
                        $urut = 1;
                        while ($r2 = mysqli_fetch_array($q2)) {
                            $id       =   $r2['id'];
                            $nim      =   $r2['nim'];
                            $nama     =   $r2['nama'];
                            $alamat   =   $r2['alamat'];
                            $fakultas =   $r2['fakultas'];
                        ?>
                            <tr>
                                <th scope="row"><?php echo $urut++ ?></th>
                                <td scope="row"><?php echo $nim ?></td>
                                <td scope="row"><?php echo $nama ?></td>
                                <td scope="row"><?php echo $alamat ?></td>
                                <td scope="row"><?php echo $fakultas ?></td>
                                <td scope="row">
                                    <a href="index.php?op=edit&id=<?php echo $id ?>"><button type="button" class="btn btn-outline-dark">Edit</button></a>
                                    <a href="index.php?op=delete&id=<?php echo $id ?>"><button type="button" class="btn btn-outline-danger">Delete</button></a>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                    </thead>
                </table>
                <div class="card text-center">
                    <div class="card-header">
                        CRUD SEDERHANA
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Terima Kasih</h5>
                        <p class="card-text"> *  *  *</p>
                        <a href="home_page.html" class="btn btn-primary">Home</a>
                    </div>
                    <div class="card-footer text-body-secondary">
                    Copyright &copy; 2024 Aisha Ezra Sari
                    </div>
                </div>
            </div>
        </div>
</body>

</html>