<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "seafood";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data dari form`
$nama = $_POST['nama'];
$no_handphone = $_POST['no_handphone'];

// Simpan pelanggan jika belum ada
$sql = "SELECT id_pelanggan FROM pelanggan WHERE no_handphone='$no_handphone'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $id_pelanggan = $row['id_pelanggan'];
} else {
    $sql = "INSERT INTO pelanggan (nama, no_handphone) VALUES ('$nama', '$no_handphone')";
    if ($conn->query($sql) === TRUE) {
        $id_pelanggan = $conn->insert_id;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        exit;
    }
}

// Redirect ke halaman pemesanan dengan id_pelanggan sebagai parameter
header("Location: ../index.php?id_pelanggan=$id_pelanggan");
$conn->close();
?>
