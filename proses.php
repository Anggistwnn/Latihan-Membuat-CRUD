<?php
// agar terhubung ke fungsi.php
include 'fungsi.php';
session_start();
//proses
if (isset($_POST['aksi'])) {
    if ($_POST['aksi'] == "add") {
        //var_dump($_POST);
        //var_dump($_FILES);
        //mengambil data dari database, tanpa data default
        //echo $_FILES['foto_siswa']['name'];
        //die();
        $berhasil = tambah_data($_POST, $_FILES);

        if ($berhasil) {
            $_SESSION['eksekusi'] = "Data Berhasil Ditambahkan";
            header("location: index.php");
            //echo "Data Berhasil Ditambahkan <a href='index.php'>[Home]</a>";
        } else {
            echo $berhasil;
        }
        //echo $nisn." | ".$nama_siswa." | ".$jenis_kelamin." | ".$foto_siswa." | ".$alamat;
        //echo  "<br> Tambah Data <a href='index.php'>[Home]</a>";
    } else if ($_POST['aksi'] == "edit") {
        // echo  "Edit Data <a href='index.php'>[Home]</a>";
        //var_dump($_POST);
        //berikut adalah fungsi untuk memunculkan data pada form edit
        $berhasil = ubah_data($_POST, $_FILES);
        if ($berhasil) {
            $_SESSION['eksekusi'] = "Data Berhasil Diperbaharui";
            header("location: index.php");
            //echo "Data Berhasil Ditambahkan <a href='index.php'>[Home]</a>";
        } else {
            echo $berhasil;
        }
    }
}
if (isset($_GET['hapus'])) {
    $_SESSION['eksekusi'] = "Data Berhasil Dihapus";
    $berhasil = hapus_data($_GET);

    if ($berhasil) {
        header("location: index.php");
        //echo "Data Berhasil Ditambahkan <a href='index.php'>[Home]</a>";
    } else {
        echo $berhasil;
    }
    //echo  "Hapus Data <a href='index.php'>[Home]</a>";
}