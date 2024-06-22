<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "seafood";

// Koneksi ke database
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Tangkap data dari form
$id_pelanggan = isset($_POST['id_pelanggan']) ? $_POST['id_pelanggan'] : null;
$menu_id = isset($_POST['menu']) ? $_POST['menu'] : null;
$jumlah_menu = isset($_POST['jumlah_menu']) ? $_POST['jumlah_menu'] : null;
$minuman_id = isset($_POST['minuman']) ? $_POST['minuman'] : null;
$jumlah_minuman = isset($_POST['jumlah_minuman']) ? $_POST['jumlah_minuman'] : null;
$metode_pembayaran = isset($_POST['metode_pembayaran']) ? $_POST['metode_pembayaran'] : null;
$no_meja = isset($_POST['no_meja']) ? $_POST['no_meja'] : null;

if (!$id_pelanggan || !$menu_id || !$jumlah_menu || !$minuman_id || !$jumlah_minuman || !$metode_pembayaran || !$no_meja) {
    die("Data form tidak lengkap!");
}

// Ambil harga dari database berdasarkan ID menu
$menu_query = "SELECT nama_menu, harga FROM menu WHERE id_menu='$menu_id'";
$menu_result = mysqli_query($conn, $menu_query);

if ($menu_result && mysqli_num_rows($menu_result) > 0) {
    $menu_row = mysqli_fetch_assoc($menu_result);
    $menu_nama = $menu_row['nama_menu'];
    $menu_harga = $menu_row['harga'];
} else {
    die("Menu dengan ID '$menu_id' tidak ditemukan!");
}

// Ambil harga dari database berdasarkan ID minuman
$minuman_query = "SELECT nama_menu, harga FROM menu WHERE id_menu='$minuman_id'";
$minuman_result = mysqli_query($conn, $minuman_query);

if ($minuman_result && mysqli_num_rows($minuman_result) > 0) {
    $minuman_row = mysqli_fetch_assoc($minuman_result);
    $minuman_nama = $minuman_row['nama_menu'];
    $minuman_harga = $minuman_row['harga'];
} else {
    die("Minuman dengan ID '$minuman_id' tidak ditemukan!");
}

// Hitung total harga pesanan
$total_harga = ($menu_harga * $jumlah_menu) + ($minuman_harga * $jumlah_minuman);

// Simpan pesanan ke database
$insert_query = "INSERT INTO pesanan (id_pelanggan, id_menu, jumlah_menu, minuman_id, jumlah_minuman, metode_pembayaran, total_harga, no_meja) VALUES ('$id_pelanggan', '$menu_id', '$jumlah_menu', '$minuman_id', '$jumlah_minuman', '$metode_pembayaran', '$total_harga', '$no_meja')";

if (mysqli_query($conn, $insert_query)) {
    // Tampilkan informasi pesanan yang dibuat dengan CSS tambahan
    echo "<div style='border: 1px solid #ccc; padding: 10px; margin-bottom: 10px;'>";
    echo "<h2>Detail Pesanan</h2>";
    echo "<p><strong>ID Pelanggan:</strong> " . $id_pelanggan . "</p>";
    echo "<p><strong>Menu:</strong> " . $menu_nama . ", Jumlah: " . $jumlah_menu . ", Harga per item: Rp " . number_format($menu_harga, 3) . "</p>";
    echo "<p><strong>Minuman:</strong> " . $minuman_nama . ", Jumlah: " . $jumlah_minuman . ", Harga per item: Rp " . number_format($minuman_harga, 3) . "</p>";
    echo "<p><strong>Nomor Meja:</strong> " . $no_meja . "</p>";
    echo "<p><strong>Metode Pembayaran:</strong> " . $metode_pembayaran . "</p>";
    echo "<p><strong>Total Harga:</strong> Rp " . number_format($total_harga, 3) . "</p>";
    echo "</div>";

    // Tambahkan tombol untuk kembali ke halaman customer.html dengan border
    echo "<a href='pelanggan/customer.html' style='display: inline-block; padding: 10px 20px; background-color: #f0f0f0; border: 1px solid #ccc; text-decoration: none; color: #333; margin-bottom: 20px;'>Kembali</a>";
} else {
    echo "Error: " . mysqli_error($conn);
}

// Tutup koneksi ke database
mysqli_close($conn);
?>
