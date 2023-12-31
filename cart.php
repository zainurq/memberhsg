<?php
include 'layouts/main.php';
include 'layouts/config.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Mendapatkan data pengguna
$kd_member = 'HSG.21.000001'; // Ganti dengan kode member yang sesuai
$queryUserData = "SELECT firstname, phonenumber, address, province, zipcode, kelurahan, kecamatan
                  FROM member_hsg
                  WHERE memberid = '$kd_member'";

$resultUserData = $link->query($queryUserData);

if ($resultUserData->num_rows > 0) {
    $userData = $resultUserData->fetch_assoc();

    // Lanjutkan dengan pengambilan data produk dan poin
    if (isset($_GET['sku'])) {
        $sku = $_GET['sku'];

        $query = "SELECT idcategori, sku, itemname, poin, `status`, 
                    CONCAT('http://103.106.79.238:81/hsgmember/images/giftpoin/', sku, '.jpg') as urlimage
                    FROM development.poin_item_gift WHERE sku = '$sku'";
        $result = $link->query($query);

        if ($result->num_rows > 0) {
            $product = $result->fetch_assoc();

            // Mendapatkan poin pengguna
            $queryPoin = "SELECT IFNULL(SUM(CASE WHEN flag = 'get' THEN point ELSE -point END), 0) as poin FROM point_member WHERE kd_member = '$kd_member'";
            $resultPoin = $link->query($queryPoin);

            if ($resultPoin->num_rows > 0) {
                $userPoin = $resultPoin->fetch_assoc()['poin'];
            } else {
                echo 'Error fetching user points.';
                exit();
            }
        } else {
            echo 'Produk tidak ditemukan';
            exit();
        }
    } else {
        echo 'Parameter SKU tidak diatur';
        exit();
    }

    // Cek apakah data pengguna lengkap
    if (empty($userData['firstname']) || empty($userData['phonenumber']) || empty($userData['address']) || empty($userData['province']) || empty($userData['zipcode']) || empty($userData['kelurahan']) || empty($userData['kecamatan'])) {
        // Redirect ke halaman lain jika data pengguna tidak lengkap
        header('Location: insertdata.php');
        exit();
    }
} else {
    // Redirect ke profile.php jika data pengguna belum lengkap
    header('Location: profile.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <?php includeFileWithVariables('layouts/title-meta.php', array('title' => 'Keranjang')); ?>
    <?php include 'layouts/head-css.php'; ?>

    <!-- Tambahkan link CSS untuk Bootstrap modal -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            color: #495057;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
        }

        .product-details {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .btn-proceed {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn-proceed:disabled {
            background-color: #ccc;
            cursor: not-allowed;
        }

        .error-message {
            color: #dc3545;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div id="layout-wrapper">
        <?php include 'layouts/menu.php'; ?>
        <div class="main-content">
            <div class="page-content">
                <div class="container">
                    <div class="product-details">
                        <img src="<?php echo $product['urlimage']; ?>" class="card-img-top" alt="Gambar Produk">
                        <h2><?php echo $product['itemname']; ?></h2>
                        <p>SKU: <?php echo $product['sku']; ?></p>
                        <p>Poin: <?php echo $product['poin']; ?></p>
                        <p>Poin Pengguna: <?php echo $userPoin; ?></p>

                        <?php
                        if ($userPoin < $product['poin']) {
                            // Jika poin pengguna kurang, tampilkan tombol "Buka Modal"
                            echo '
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal">
                                Poin Anda Kurang
                            </button>

                            <!-- Modal -->
                            <div class="modal" id="myModal">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <!-- Header Modal -->
                                        <div class="modal-header">
                                            <h4 class="modal-title">Pemberitahuan</h4>
                                            <button type="button" class="close" data-dismiss="modal" onclick="redirectToRedeem()">&times;</button>
                                        </div>
                                        <!-- Isi Modal -->
                                        <div class="modal-body">
                                            <p>Poin Anda tidak mencukupi untuk membeli produk ini.</p>
                                        </div>
                                        <!-- Footer Modal -->
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="redirectToRedeem()">Tutup</button>
                                        </div>
                                    </div>
                                </div>
                            </div>';
                        } else {

                            echo '
                            <form action="purchase.php" method="post">
                                <input type="hidden" name="sku" value="' . $product['sku'] . '">
                                <button type="submit" class="btn btn-success btn-proceed">Lanjutkan ke Pembelian</button>
                            </form>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tambahkan script JS untuk Bootstrap -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <?php include 'layouts/vendor-scripts.php'; ?>
    <script src="assets/js/app.js"></script>
    <script src="assets/libs/sweetalert2/sweetalert2.min.js"></script>

    <script>
        function redirectToRedeem() {
            window.location.href = 'redeem.php';
        }
    </script>
</body>

</html>
