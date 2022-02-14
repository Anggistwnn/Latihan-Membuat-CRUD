<?php
include 'koneksi.php';
function tambah_data($data, $files)
{
    $nisn = $data['nisn'];
    $nama_siswa = $data['nama_siswa'];
    $jenis_kelamin = $data['jenis_kelamin'];
    // variable split berfungsi untuk memisahkan antara ekstensi dengan nama file, agar ketika ada 1 gambar yang sama pada 2 datauser. 2 user itu tetap memiliki 2 gambar pada tmpfile
    $split = explode('.', $files['foto_siswa']['name']);
    $ekstensi = $split[count($split) - 1];
    // variable foto_siswa dimana tempat input foto diganti menjadi $nisn karna mengurangi rawan duplikat data.
    $foto_siswa = $nisn . '.' . $ekstensi;
    // jika sudah ganti juga menjadi variable split pada fungsi ubah paada line 44
    $alamat = $data['alamat'];
    $dir = "img/";
    $tmpFile = $files['foto_siswa']['tmp_name'];
    //menindahkan file dari temporary ke directory
    move_uploaded_file($tmpFile, $dir . $foto_siswa);
    //die();
    $query = "INSERT INTO tb_siswa VALUES(null, '$nisn', '$nama_siswa', '$jenis_kelamin', '$foto_siswa', '$alamat')";
    // ketik dipindahkan $conn tidak dapat terdeteksi di file ini, karna diluar dari fungsi ini dan mereka merupakan variable lokal, diubah dulu menjadi variable global, seperti dibawah ini :)
    $sql = mysqli_query($GLOBALS['conn'], $query);

    return true;
}

function ubah_data($data, $files)
{
    $id_siswa = $data['id_siswa'];
    $nisn = $data['nisn'];
    $nama_siswa = $data['nama_siswa'];
    $jenis_kelamin = $data['jenis_kelamin'];
    $alamat = $data['alamat'];

    // fungsi dari code dibawah adalah ketika kita mengubah data foto user maka data akan berubah
    $queryShow = "SELECT * FROM tb_siswa WHERE id_siswa = '$id_siswa';";
    $sqlShow = mysqli_query($GLOBALS['conn'], $queryShow);
    $result = mysqli_fetch_assoc($sqlShow);

    if ($files['foto_siswa']['name'] == "") {
        $foto_siswa = $result['foto_siswa'];
    } else {
        // 
        $split = explode('.', $files['foto_siswa']['name']);
        $ekstensi = $split[count($split) - 1];
        $foto_siswa = $result['nisn'] . '.' . $ekstensi;
        //menghapus gambar didalam file directory ketika data dihapus
        unlink("img/" . $result['foto_siswa']);
        move_uploaded_file($files['foto_siswa']['tmp_name'], 'img/' . $foto_siswa);
    }

    //fungsi query unutk menyesuaikan pada form edit tersebut
    $query = "UPDATE tb_siswa SET nisn='$nisn', nama_siswa='$nama_siswa', jenis_kelamin='$jenis_kelamin', alamat='$alamat', foto_siswa ='$foto_siswa' WHERE id_siswa='$id_siswa';";


    //proses query diatas dengan mysqli
    $sql = mysqli_query($GLOBALS['conn'], $query);

    return true;
}

function hapus_data($data)
{
    $id_siswa = $data['hapus'];

    $queryShow = "SELECT * FROM tb_siswa WHERE id_siswa = '$id_siswa';";
    $sqlShow = mysqli_query($GLOBALS['conn'], $queryShow);
    $result = mysqli_fetch_assoc($sqlShow);

    //untuk melakukan pengecekan apakah fungsi sudah berjalan dengan sesuai
    //var_dump($result);

    //menghapus gambar didalam file directory ketika data dihapus
    unlink("img/" . $result['foto_siswa']);

    $query = "DELETE FROM tb_siswa WHERE id_siswa = '$id_siswa';";
    $sql = mysqli_query($GLOBALS['conn'], $query);

    return true;
}