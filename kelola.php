<?php
include 'koneksi.php';
session_start();

$id_siswa = '';
$nisn = '';
$nama_siswa = '';
$jenis_kelamin = '';
$alamat = '';

if (isset($_GET['ubah'])) {
    $id_siswa = $_GET['ubah'];
    //menambahkan fitur dalam ubah agar ketika di pilih fitur ubah data langsung muncul pada form 
    $query = "SELECT * FROM tb_siswa WHERE id_siswa = '$id_siswa';";
    $sql = mysqli_query($conn, $query);

    $result = mysqli_fetch_assoc($sql);
    // memasukan data menjadi variable dan akan muncul di forme edit data

    $nisn = $result['nisn'];
    $nama_siswa = $result['nama_siswa'];
    $jenis_kelamin = $result['jenis_kelamin'];
    $alamat = $result['alamat'];

    //var_dump($result);
    //die();
}
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="fontawesome-free-5.15.3-web/css/all.css">
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <title>Belajar CRUD</title>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-light bg-light mb-4">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                CRUD - BS 5
            </a>
        </div>
    </nav>
    <!-- Input Data -->
    <div class="container">
        <form method="POST" action="proses.php" enctype="multipart/form-data">
            <!-- menambahkan fungsi dari kondisi where yaitu pada baris berapa data berada -->
            <input type="hidden" value="<?php echo $id_siswa; ?>" name="id_siswa">
            <!-- NISN -->
            <div class="mb-3 row">
                <label for="nisn" class="col-sm-2 col-form-label">NISN
                </label>
                <div class="col-sm-10">
                    <input required type="text" name="nisn" class="form-control" id="nisn" placeholder="181011400 ..."
                        value="<?php echo $nisn; ?>">
                </div>
            </div>

            <!-- Nama Siswa -->
            <div class="mb-3 row">
                <label for="nama" class="col-sm-2 col-form-label">Nama
                </label>
                <div class="col-sm-10">
                    <input required type="text" name="nama_siswa" class="form-control" id="nama" placeholder="Anggi"
                        value="<?php echo $nama_siswa; ?>">
                </div>
            </div>
            <!-- Jenis Kelamin -->
            <div class="mb-3 row">
                <label for="jkel" class="col-sm-2 col-form-label">Jenis Kelamin
                </label>
                <div class="col-sm-10">
                    <select required id=" jkel" name="jenis_kelamin" class="form-select">
                        <option <?php if ($jenis_kelamin == 'Laki-Laki') {
                                    echo "selected";
                                } ?> value=" Laki-Laki">Laki-Laki
                        </option>
                        <option <?php if ($jenis_kelamin == 'Perempuan') {
                                    echo "selected";
                                } ?> value="Perempuan">Perempuan
                        </option>
                    </select>
                </div>
            </div>
            <!-- Foto Siswa -->
            <div class="mb-3 row">
                <label for="foto" class="col-sm-2 col-form-label">Foto Siswa
                </label>
                <div class="col-sm-10">
                    <!-- berikut adalah fungsi untuk ubah data pada foto tidak perlu diisi, dan jika tambah data baru itu perlu diisi -->
                    <input <?php if (!isset($_GET['ubah'])) {
                                echo "required";
                            } ?> class="form-control" type="file" name="foto_siswa" id="foto" accept="image/*">
                </div>
            </div>

            <!-- Alamat Siswa -->
            <div class="mb-3 row">
                <label for="alamat" class="col-sm-2 col-form-label">Alamat Lengkap
                </label>
                <div class="col-sm-10">
                    <textarea required class="form-control" id="alamat" name="alamat"
                        rows="3"><?php echo $alamat; ?></textarea>
                </div>
            </div>

            <!-- button Fungsi -->
            <div class="mb-3 row mt-5">
                <div class="col">

                    <?php
                    if (isset($_GET['ubah'])) {
                    ?>

                    <!-- Button Tambahkan -->
                    <!-- ketika ada perubahan atas nama "aksi" dia akan ke proses.php (if isset) -->
                    <button type="submit" name="aksi" value="edit" class="btn btn-primary">
                        <i class="fa fa-cloud" aria-hidden="true"></i>
                        Simpan Perubahan
                    </button>

                    <?php
                    } else {
                    ?>

                    <button type="submit" name="aksi" value="add" class="btn btn-primary">
                        <i class="fa fa-cloud" aria-hidden="true"></i>
                        Tambahkan
                    </button>

                    <?php
                    }
                    ?>

                    <!-- Button Batal -->
                    <a href="index.php" type="button" class="btn btn-danger">
                        <i class="fa fa-reply" aria-hidden="true"></i>
                        Batal </a>

                </div>
            </div>
        </form>
    </div>
</body>

</html>