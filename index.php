<?php
// link menuju file koneksi agar database terhubung
include 'koneksi.php';
session_start();

$query = "SELECT * FROM tb_siswa;";
$sql = mysqli_query($conn, $query);
$no = 0;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- datatables -->
    <!-- css -->
    <link rel="stylesheet" type="text/css" href="datatables/datatables.min.css">
    <!-- js -->
    <script type="text/javascript" src="datatables/datatables.min.js"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="fontawesome-free-5.15.3-web/css/all.min.css">
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity=" sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <title>Latihan CRUD
    </title>
</head>

<script type="text/javascript">
$(document).ready(function() {
    $('dt').DataTables();
});
</script>

<body>
    <nav class="navbar navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                CRUD - BS 5
            </a>
        </div>
    </nav>
    <!-- Judul -->
    <div class="container">
        <h1 class="mt-5">Data Siswa</h1>
        <figure>
            <blockquote class="blockquote">
                <p>Data yang telah tersimpan di database</p>
            </blockquote>
            <figcaption class="blockquote-footer">
                CRUD <cite title="Source Title">Create Read Update Delete </cite>
            </figcaption>
        </figure>
        <!-- Button -->
        <a href="kelola.php" type="button" class="btn btn-primary mb-4">
            <i class="fa fa-plus"></i>
            Tambah Data
        </a>
        <!-- fungsi if ini berguna sebagai sesi jika ada perubahan data maka akan memuculkan alert -->
        <?php
        if (isset($_SESSION['eksekusi'])) :
        ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>
                <?php
                    echo $_SESSION['eksekusi'];
                    ?>
            </strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php
            // sesion destroy berguna sebagai menghilangkan alert pada fungsi default dari session yang digunakan
            session_destroy();
        endif;
        ?>

        <!-- Table -->
        <div class="table-responsive">
            <table id="dt" class="table align-middle table-bordered table-hover">
                <thead>
                    <tr>
                        <th>
                            <center>No.</center>
                        </th>
                        <th>NISN</th>
                        <th>Nama Siswa</th>
                        <th>Jenis Kelamin</th>
                        <th>Foto Siswa</th>
                        <th>Alamat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($result = mysqli_fetch_assoc($sql)) {
                    ?>
                    <tr>
                        <td>
                            <center>
                                <?php
                                    echo ++$no;
                                    ?>.
                            </center>
                        </td>
                        <td><?php
                                echo $result['nisn'];
                                ?></td>
                        <td><?php
                                echo $result['nama_siswa'];
                                ?></td>
                        <td><?php
                                echo $result['jenis_kelamin'];
                                ?></td>
                        <td><img src="img/<?php
                                                echo $result['foto_siswa'];
                                                ?>" style="width: 110px;" alt=""></td>
                        <td><?php
                                echo $result['alamat'];
                                ?></td>
                        <td>
                            <!-- Button Ubah -->
                            <a href="kelola.php?ubah=<?php echo $result['id_siswa']; ?>" type="button"
                                class="btn btn-success btn-sm">
                                <i class="fa fa-pencil-alt"></i>
                            </a>
                            <!-- Button Hapus -->
                            <a href="proses.php?hapus=<?php echo $result['id_siswa']; ?>" type="button"
                                class="btn btn-danger btn-sm"
                                onClick="return confirm('Apakah Anda yakin ingin menghapus data tersebut???')">
                                <i class="fa fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    <?php
                    }
                    ?>
                    <tr class="align-bottom">
                    </tr>

                </tbody>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
</body>

</html>