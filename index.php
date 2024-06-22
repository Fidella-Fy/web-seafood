<?php require 'menu.php'?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/index.css">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap"
      rel="stylesheet"
    />
    <script>
        function updateTotal() {
            const menuSelect = document.getElementById('menu');
            const minumanSelect = document.getElementById('minuman');
            const jumlahMenuInput = document.getElementById('jumlah_menu');
            const jumlahMinumanInput = document.getElementById('jumlah_minuman');
            const totalOutput = document.getElementById('total_harga');
            const menuInfo = document.getElementById('menu_info');
            const minumanInfo = document.getElementById('minuman_info');

            const selectedMenu = menuSelect.options[menuSelect.selectedIndex];
            const menuHarga = parseFloat(selectedMenu.getAttribute('data-harga') || 0);
            const selectedMinuman = minumanSelect.options[minumanSelect.selectedIndex];
            const minumanHarga = parseFloat(selectedMinuman.getAttribute('data-harga') || 0);
            const jumlahMenu = parseInt(jumlahMenuInput.value || 0);
            const jumlahMinuman = parseInt(jumlahMinumanInput.value || 0);

            const totalHarga = (menuHarga * jumlahMenu) + (minumanHarga * jumlahMinuman);

            totalOutput.innerText = 'Total Harga: Rp ' + totalHarga.toFixed(3);
            menuInfo.innerText = 'Menu: ' + selectedMenu.text + ', Harga per item: Rp ' + menuHarga.toFixed(3);
            minumanInfo.innerText = 'Minuman: ' + selectedMinuman.text + ', Harga per item: Rp ' + minumanHarga.toFixed(3);
        }

        document.addEventListener('DOMContentLoaded', () => {
            document.getElementById('menu').addEventListener('change', updateTotal);
            document.getElementById('jumlah_menu').addEventListener('input', updateTotal);
            document.getElementById('minuman').addEventListener('change', updateTotal);
            document.getElementById('jumlah_minuman').addEventListener('input', updateTotal);
        });
    </script>
</head>
<body>
    <nav>
<h3>Liamtan SteakHouse</h3>
        <ul>
            <li><a href="#navbar">Home</a></li>
            <li><a href="#section1">Introduce The Menu</a></li>
            <li><a href="#section2">Booking</a></li>
        </ul>
    </nav><br><br>
    <header  id="navbar">
        <div class="banner"><br><br>
            <img src=" img/banner.png" alt="Restaurant Banner">
        </div>
        </header>
    <section id="section1">
    <div class="menu">
        <h1>INTRODUCE THE MENU</h1>
        <div class="perkenalan">
        <div class="menu1">
            <h3>Udang Saus Padang</h3>
            <img src="img/udang.png" alt="">
            <p>Udang Saus Padang adalah hidangan populer dari Indonesia yang menampilkan udang segar yang dimasak dengan saus Padang khas. </p>
            <h4>RP. 120.000</h4>
        </div>
        <div class="menu2">
        <h3>Udang Goreng Tepung</h3>
            <img src="img/tepung.jpg" alt="">
            <p>Udang goreng tepung adalah hidangan laut yang populer di mana udang segar dicelupkan ke dalam adonan tepung dan digoreng hingga kuning keemasan dan renyah.</p>
            <h4>RP. 130.000</h4>
        </div>
        <div class="menu3">
        <h3>Cumi Saus Tiram</h3>
            <img src="img/cumi saus.jpg" alt="">
            <p>Cumi saus tiram adalah hidangan yang menggabungkan cita rasa gurih dan manis dari saus tiram dengan kelezatan cumi yang lembut dan kenyal yang mana menjadi cita rasa yang menarik.</p>
            <h4>RP. 90.000</h4>
        </div>
        <div class="menu4">
        <h3>Lobster Saus Padang</h3>
            <img src="img/lobster.jpg" alt="">
            <p>Lobster saus Padang adalah hidangan istimewa yang menggabungkan kelezatan lobster dengan cita rasa khas saus Padang, yang terkenal dengan kepedasan dan kekayaan rempahnya.</p>
            <h4>RP. 400.000</h4>
        </div>
        <div class="minum1">
        <h3>Es Jeruk</h3>
            <img src="img/jeruk.jpg" alt="">
            <p>Es jeruk adalah minuman segar yang terbuat dari perasan jeruk yang ditambahkan dengan es batu dan gula sesuai selera.</p>
            <h4>RP. 15.000</h4>
        </div>
        <div class="minum2">
        <h3>Es Teler</h3>
            <img src="img/teler.jpg" alt="">
            <p>Es Teler adalah minuman khas Indonesia yang menyegarkan dan menggugah selera.</p>
            <h4>RP. 25.000</h4>
        </div>
        <div class="minum3">
        <h3>Es Lemon Tea</h3>
            <img src="img/lemon.jpe" alt="">
            <p>Es Lemon Tea adalah minuman yang menyegarkan dan sangat populer di berbagai belahan dunia. </p>
            <h4>RP. 20.000</h4>
        </div>
        <div class="minum4">
        <h3>Es Kelapa Muda</h3>
            <img src="img/kelapa.jpg" alt="">
            <p>Es kelapa muda adalah minuman yang menyegarkan yang terbuat dari air kelapa segar yang diberi tambahan es batu.</p>
            <h4>RP. 15.000</h4>
        </div>
        </div>
    </div>
    </section>
    <div id="section2" class="form">
    <h1>BOOKING</h1>
    <div class="container">
        <form id="orderForm" action="order.php" method="POST">
            <input type="hidden" id="id_pelanggan" name="id_pelanggan" value="<?php echo isset($_GET['id_pelanggan']) ? $_GET['id_pelanggan'] : ''; ?>">
            
            <label for="menu">Menu:</label>
            <select id="menu" name="menu" required>
                <?php foreach ($foods as $food): ?>
                    <option value="<?php echo $food['id_menu']; ?>" data-harga="<?php echo $food['harga']; ?>"><?php echo $food['nama_menu']; ?></option>
                <?php endforeach; ?>
            </select>

            <label for="jumlah_menu">Jumlah:</label>
            <input type="number" id="jumlah_menu" name="jumlah_menu" min="1" required>
            
            <p id="menu_info"></p>
            
            <label for="minuman">Minuman:</label>
            <select id="minuman" name="minuman" required>
                <?php foreach ($drinks as $drink): ?>
                    <option value="<?php echo $drink['id_menu']; ?>" data-harga="<?php echo $drink['harga']; ?>"><?php echo $drink['nama_menu']; ?></option>
                <?php endforeach; ?>
            </select>
            
            <label for="jumlah_minuman">Jumlah:</label>
            <input type="number" id="jumlah_minuman" name="jumlah_minuman" min="1" required>
            
            <p id="minuman_info"></p>
            <p id="total_harga">Total Harga: Rp 0.000</p>
            
            <label for="metode_pembayaran">Metode Pembayaran:</label>
            <select id="metode_pembayaran" name="metode_pembayaran" required>
                <option value="Cash">Cash</option>
                <option value="Credit Card">Credit Card</option>
                <option value="Debit Card">Debit Card</option>
            </select>
            <label for="no_meja">Nomor Meja:</label>
<select id="no_meja" name="no_meja" required>
    <?php foreach ($meja as $meja_item): ?>
        <option value="<?php echo $meja_item['no_meja']; ?>"><?php echo 'Meja ' . $meja_item['no_meja']; ?></option>
    <?php endforeach; ?>
</select>
            
            <button type="submit">Pesan</button>
        </form>
        </div>
    </div>
</body>
</html>
