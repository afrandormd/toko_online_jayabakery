<?php
namespace Midtrans;

require_once dirname(__FILE__) . '/../../Midtrans.php';
// Set Your server key
Config::$serverKey = 'SB-Mid-server-57mkIhwT9i3YXjlyulVOMWpQ';
Config::$clientKey = 'SB-Mid-client-Hk_Q8z24XlP4dKnI';

// non-relevant function only used for demo/example purpose
printExampleWarningMessage();

// Uncomment for production environment
// Config::$isProduction = true;

// Enable sanitization
Config::$isSanitized = true;

// Enable 3D-Secure
Config::$is3ds = true;

// Uncomment for append and override notification URL
// Config::$appendNotifUrl = "https://example.com";
// Config::$overrideNotifUrl = "https://example.com";

//koneksi ke database
include "../../../koneksi/koneksi.php";
$kd_cs = $_GET['kd_cs'];

// Ambil data transaksi dari database
$transaction_query = mysqli_query($conn, "SELECT * FROM produksi WHERE kode_customer = '$kd_cs'");

$gross_amount = 0;
$item_details = [];
while ($row = mysqli_fetch_assoc($transaction_query)) {
    $item_details[] = array(
        'id' => $row['kode_produk'],
        'price' => $row['harga'],
        'quantity' => $row['qty'],
        'name' => $row['nama_produk']
    );
    $gross_amount += $row['harga'] * $row['qty'];
}

// Pastikan gross_amount valid
if ($gross_amount < 0.01) {
    die("Total amount must be at least 0.01");
}

// Ambil detail transaksi pertama sebagai contoh
mysqli_data_seek($transaction_query, 0); // Reset pointer untuk mengambil data pertama
$transaction_details_row = mysqli_fetch_assoc($transaction_query);

// Detail transaksi
$transaction_details = array(
    // 'order_id' => $transaction_details_row['invoice'],
    'order_id' => $transaction_details_row['id_order'],
    'gross_amount' => $gross_amount, // no decimal allowed for creditcard
);

// Ambil data pelanggan dari database
$customer_data_query = mysqli_query($conn, "SELECT * FROM customer WHERE kode_customer = '$kd_cs'");
$customer_data_details = mysqli_fetch_assoc($customer_data_query);

// Detail pelanggan
$customer_details = array(
    'first_name' => isset($customer_data_details['nama']) ? $customer_data_details['nama'] : '',
    'phone' => isset($customer_data_details['telp']) ? $customer_data_details['telp'] : '',
    'billing_address' => array(
        'first_name' => isset($customer_data_details['nama']) ? $customer_data_details['nama'] : '',
        'address' => isset($transaction_details_row['alamat']) ? $transaction_details_row['alamat'] : '',
        'city' => isset($transaction_details_row['kota']) ? $transaction_details_row['kota'] : '',
        'postal_code' => isset($transaction_details_row['kopos']) ? $transaction_details_row['kopos'] : '',
        'phone' => isset($transaction_details_row['phone']) ? $transaction_details_row['phone'] : '',
        'country_code' => 'IDN'
    ),
    'shipping_address' => array(
        'first_name' => isset($transaction_details_row['first_name']) ? $transaction_details_row['first_name'] : '',
        'address' => isset($transaction_details_row['alamat']) ? $transaction_details_row['alamat'] : '',
        'city' => isset($transaction_details_row['kota']) ? $transaction_details_row['kota'] : '',
        'postal_code' => isset($transaction_details_row['kopos']) ? $transaction_details_row['kopos'] : '',
        'phone' => isset($transaction_details_row['phone']) ? $transaction_details_row['phone'] : '',
        'country_code' => 'IDN'
    )
);

// Fill transaction details
$transaction = array(
    'transaction_details' => $transaction_details,
    'customer_details' => $customer_details,
    'item_details' => $item_details,
);

// $snap_token = '';
try {
    $snap_token = Snap::getSnapToken($transaction);
} catch (\Exception $e) {
    echo $e->getMessage();
    // komentar di atas di gunakan agar tidak menampilkan token di page
}

// echo "snapToken = " . $snap_token;
// komentar di atas di gunakan agar tidak menampilkan token di page

function printExampleWarningMessage()
{
    if (strpos(Config::$serverKey, 'your ') !== false) {
        echo "<code>";
        echo "<h4>Please set your server key from sandbox</h4>";
        echo "In file: " . __FILE__;
        echo "<br>";
        echo "<br>";
        echo htmlspecialchars('Config::$serverKey = \'<your server key>\';');
        die();
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Checkout Berhasil!</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <style>
        body {
            background-color: #ffe8ae;
        }

        #pay-button {}

        #result-json {
            background-color: #f5f5f5;
            padding: 10px;
            border-radius: 5px;
            margin-top: 20px;
            font-family: monospace;
            white-space: pre-wrap;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <h2 class="text-center">Checkout Berhasil!</h2>
                <button id="pay-button" class="btn btn-lg btn-block"
                    style="background-color: #611319; color: white;">Bayar
                    Sekarang</button>
                <div id="result-json" class="result-item">
                    Status Pembayaran akan muncul disini:<br>
                </div>
                <br>
                <!-- <button href="#" class="btn btn-lg btn-block mt-5"
                    style="background-color: #ffe28f; color: black;">Kembali
                    Beranda</button> -->
            </div>
        </div>
    </div>
    <br>
    <br>
    <br>
    <br>
    <br>

    <script src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="<?php echo Config::$clientKey; ?>"></script>
    <script type="text/javascript">
        document.getElementById('pay-button').onclick = function () {
            snap.pay('<?php echo $snap_token ?>', {
                onSuccess: function (result) {
                    document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                },
                onPending: function (result) {
                    document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                },
                onError: function (result) {
                    document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                }
            });
        };
    </script>
</body>

</html>