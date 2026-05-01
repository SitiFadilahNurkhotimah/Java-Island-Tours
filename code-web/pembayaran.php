<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f3f4f6;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: #ffffff;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input, select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .hidden {
            display: none;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: rgb(119, 208, 86);
        }
        .details {
            font-size: 14px;
            color: #333;
            background-color: #f9f9f9;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-bottom: 15px;
        }
    </style>
    <script>
        function togglePaymentOptions() {
            const transferOptions = document.getElementById('transfer-options');
            const ewalletOptions = document.getElementById('ewallet-options');
            const transferDetails = document.getElementById('transfer-details');
            const ewalletDetails = document.getElementById('ewallet-details');

            transferOptions.classList.add('hidden');
            ewalletOptions.classList.add('hidden');
            transferDetails.classList.add('hidden');
            ewalletDetails.classList.add('hidden');

            const selected = document.getElementById('metode_pembayaran').value;
            if (selected === 'Transfer Bank') {
                transferOptions.classList.remove('hidden');
                transferDetails.classList.remove('hidden');
            } else if (selected === 'E-Wallet') {
                ewalletOptions.classList.remove('hidden');
                ewalletDetails.classList.remove('hidden');
            }
        }
    </script>
</head>
<body>
    <div class="container">
        <h1>Pembayaran</h1>
        <form id="form-pembayaran" action="prosespembayaran.php" method="POST" enctype="multipart/form-data">

            <label for="metode_pembayaran">Metode Pembayaran</label>
            <select id="metode_pembayaran" name="metode_pembayaran" onchange="togglePaymentOptions()" required>
                <option value="" disabled selected>Pilih metode pembayaran</option>
                <option value="Transfer Bank">Transfer Bank</option>
                <option value="E-Wallet">E-Wallet</option>
            </select>

            <!-- Opsi Transfer Bank -->
            <div id="transfer-options" class="hidden">
                <label for="bank">Bank</label>
                <select id="bank" name="bank">
                    <option value="BCA">Bank BCA</option>
                    <option value="BNI">Bank BNI</option>
                    <option value="Mandiri">Bank Mandiri</option>
                    <option value="BRI">Bank BRI</option>
                    <option value="BSI">Bank BSI</option>
                </select>
            </div>

            <div id="transfer-details" class="hidden details">
                <p>Nomor Rekening: <strong>1234567890</strong></p>
                <p>Atas Nama: <strong>Travel Agency</strong></p>
            </div>

            <!-- Opsi E-Wallet -->
            <div id="ewallet-options" class="hidden">
                <label for="ewallet">E-Wallet</label>
                <select id="ewallet" name="ewallet">
                    <option value="GoPay">GoPay</option>
                    <option value="ShopeePay">ShopeePay</option>
                    <option value="OVO">OVO</option>
                    <option value="Dana">Dana</option>
                </select>
            </div>

            <div id="ewallet-details" class="hidden details">
                <p>Nomor E-Wallet: <strong>081234567890</strong></p>
                <p>Atas Nama: <strong>Travel Agency</strong></p>
            </div>

            <label for="tanggal_pembayaran">Tanggal Pembayaran</label>
            <input type="date" id="tanggal_pembayaran" name="tanggal_pembayaran" required>

            <label for="jumlah_pembayaran">Jumlah Pembayaran</label>
            <input type="number" id="jumlah_pembayaran" name="jumlah_pembayaran" placeholder="Masukkan jumlah pembayaran" required>

            <label for="proof">Upload Bukti Pembayaran</label>
            <input type="file" id="proof" name="proof" accept="image/*" required>

            <button type="submit">Bayar</button>
        </form>
    </div>
</body>
</html>
