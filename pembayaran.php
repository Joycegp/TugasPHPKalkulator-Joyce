<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Pembayaran Sederhana</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .container { max-width: 500px; padding: 20px; border: 1px solid #ccc; border-radius: 8px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input[type="text"], input[type="number"] { width: 100%; padding: 8px; box-sizing: border-box; }
        button { padding: 10px 15px; background-color: #28a745; color: white; border: none; border-radius: 4px; cursor: pointer; }
        button:hover { background-color: #218838; }
        .error { color: red; margin-bottom: 15px; }
        .result { margin-top: 20px; padding: 15px; border-top: 2px solid #333; background-color: #f9f9f9; }
    </style>
</head>
<body>

<div class="container">
    <h2>Form Pembayaran Barang</h2>
    
    <form action="" method="POST">
        <div class="form-group">
            <label for="nama_barang">Nama Barang:</label>
            <input type="text" id="nama_barang" name="nama_barang" required>
        </div>
        
        <div class="form-group">
            <label for="harga_satuan">Harga Satuan (Rp):</label>
            <input type="number" id="harga_satuan" name="harga_satuan" min="0" required>
        </div>
        
        <div class="form-group">
            <label for="jumlah_pembelian">Jumlah Pembelian:</label>
            <input type="number" id="jumlah_pembelian" name="jumlah_pembelian" min="1" required>
        </div>
        
        <button type="submit" name="hitung">Hitung Total</button>
    </form>

    <?php
    if (isset($_POST['hitung'])) {

        $nama_barang = htmlspecialchars($_POST['nama_barang']);
        $harga_satuan = (float) $_POST['harga_satuan'];
        $jumlah_pembelian = (int) $_POST['jumlah_pembelian'];

        if ($harga_satuan < 0 || $jumlah_pembelian < 1) {
            echo "<div class='error'><strong>Error:</strong> Harga tidak boleh negatif dan jumlah pembelian minimal 1.</div>";
        } else {
            $total_harga = $harga_satuan * $jumlah_pembelian;

            if ($total_harga >= 500000) {
                $persen_diskon = 20;
            } elseif ($total_harga >= 250000) {
                $persen_diskon = 10;
            } else {
                $persen_diskon = 0;
            }

            $nominal_diskon = ($persen_diskon / 100) * $total_harga;
            $total_pembayaran = $total_harga - $nominal_diskon;

            echo "<div class='result'>";
            echo "<h3>Rincian Pembayaran</h3>";
            echo "<p><strong>Nama Barang:</strong> " . $nama_barang . "</p>";
            echo "<p><strong>Harga Satuan:</strong> Rp " . number_format($harga_satuan, 0, ',', '.') . "</p>";
            echo "<p><strong>Jumlah Pembelian:</strong> " . $jumlah_pembelian . "</p>";
            echo "<p><strong>Total Harga:</strong> Rp " . number_format($total_harga, 0, ',', '.') . "</p>";
            echo "<p><strong>Diskon (" . $persen_diskon . "%):</strong> Rp " . number_format($nominal_diskon, 0, ',', '.') . "</p>";
            echo "<p><strong>Total Pembayaran:</strong> Rp " . number_format($total_pembayaran, 0, ',', '.') . "</p>";
            echo "</div>";
        }
    }
    ?>
</div>

</body>
</html>