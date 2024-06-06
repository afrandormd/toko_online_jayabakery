<?php
namespace Midtrans;

include 'layouts/header.php';

require_once dirname(__FILE__) . '/midtrans/Midtrans.php';
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

// Koneksi ke database
include "koneksi/koneksi.php";
$kd_cs = $_GET['kd_cs'];

// Ambil data transaksi dari database
$transaction_query = mysqli_query($conn, "SELECT * FROM produksi WHERE kode_customer = '$kd_cs' AND terima != 1 AND tolak != 1");

if (!$transaction_query) {
    die("Error querying database: " . mysqli_error($conn));
}

$gross_amount = 0;
$item_details = [];
while ($row = mysqli_fetch_assoc($transaction_query)) {
    if ($row['harga'] > 0 && $row['qty'] > 0) {
        $item_details[] = array(
            'id' => $row['kode_produk'],
            'price' => $row['harga'],
            'quantity' => $row['qty'],
            'name' => $row['nama_produk']
        );
        $gross_amount += $row['harga'] * $row['qty'];
    } else {
        echo "Invalid product data: ";
        print_r($row);
    }
}

// Pastikan gross_amount valid
if ($gross_amount < 0.01) {
    die("Total amount must be at least 0.01. Gross amount: $gross_amount");
}

// Generate unique order ID
$unique_order_id = uniqid($kd_cs . '-');

// Detail transaksi
$transaction_details = array(
    'order_id' => $unique_order_id,
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
        'address' => isset($customer_data_details['alamat']) ? $customer_data_details['alamat'] : '',
        'city' => isset($customer_data_details['kota']) ? $customer_data_details['kota'] : '',
        'postal_code' => isset($customer_data_details['kopos']) ? $customer_data_details['kopos'] : '',
        'phone' => isset($customer_data_details['phone']) ? $customer_data_details['phone'] : '',
        'country_code' => 'IDN'
    ),
    'shipping_address' => array(
        'first_name' => isset($customer_data_details['nama']) ? $customer_data_details['nama'] : '',
        'address' => isset($customer_data_details['alamat']) ? $customer_data_details['alamat'] : '',
        'city' => isset($customer_data_details['kota']) ? $customer_data_details['kota'] : '',
        'postal_code' => isset($customer_data_details['kopos']) ? $customer_data_details['kopos'] : '',
        'phone' => isset($customer_data_details['phone']) ? $customer_data_details['phone'] : '',
        'country_code' => 'IDN'
    )
);

// Fill transaction details
$transaction = array(
    'transaction_details' => $transaction_details,
    'customer_details' => $customer_details,
    'item_details' => $item_details,
);

try {
    $snap_token = Snap::getSnapToken($transaction);
} catch (\Exception $e) {
    echo $e->getMessage();
}

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
                <h5 class="bg-success" style="padding: 7px; width: 100%; font-weight: bold;">
                    <marquee>Harap jangan meninggalkan halaman ini sebelum melakukan pembayaran!</marquee>
                </h5>
                <button id="pay-button" class="btn btn-lg btn-block"
                    style="background-color: #611319; color: white;">Bayar Sekarang</button>
                <!-- <div id="result-json" class="result-item">
                    Status Pembayaran akan muncul disini:<br>
                </div> -->
                <br>
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
<br>
<?php include 'layouts/footer.php'; ?>