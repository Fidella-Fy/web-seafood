<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "seafood";

// Buat koneksi ke database
$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data makanan
$foods = [];
$sql_foods = "SELECT id_menu, nama_menu, harga FROM menu WHERE type='food'";
$result_foods = $conn->query($sql_foods);
// var_dump($result_foods);die;
if ($result_foods->num_rows > 0) {
    while($row = $result_foods->fetch_assoc()) {
        $foods[] = $row;
    }
} else {
    echo "Tidak ada data makanan";
    // Tambahkan baris ini untuk debug
    echo "<br>Query: " . $sql_foods;
    echo "<br>Error: " . $conn->error;
}

// Ambil data minuman
$drinks = [];
$sql_drinks = "SELECT id_menu, nama_menu, harga FROM menu WHERE type='drink'";
$result_drinks = $conn->query($sql_drinks);
if ($result_drinks->num_rows > 0) {
    while($row = $result_drinks->fetch_assoc()) {
        $drinks[] = $row;
    }
} else {
    echo "Tidak ada data minuman";
    // Tambahkan baris ini untuk debug
    echo "<br>Query: " . $sql_drinks;
    echo "<br>Error: " . $conn->error;
}

$sql = "SELECT no_meja FROM meja";
$result = $conn->query($sql);
$meja = [];
while ($row = $result->fetch_assoc()) {
    $meja[] = $row;
}


// Tutup koneksi
$conn->close();
?>
