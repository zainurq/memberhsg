<?php
error_reporting(E_ALL & ~E_NOTICE);

include 'layouts/main.php';
include 'layouts/config.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Query untuk mendapatkan data produk dari API baru
$apiUrl = 'http://103.106.79.238:81/hsgmember/loaddata.php?action=getLoadGift';
$jsonData = @file_get_contents($apiUrl);

if ($jsonData === false) {
    // Handle error when unable to fetch data from the API
    echo '<p class="not-found-message show">Gagal mengambil data produk</p>';
    exit;
}

// Decode JSON data
$products = json_decode($jsonData, true);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php includeFileWithVariables('layouts/title-meta.php', array('title' => 'Redeem')); ?>
    <?php include 'layouts/head-css.php'; ?>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <style>
        .card-body p {
        font-size: 12px;
        height: 20px;
        overflow: hidden;
        text-overflow: ellipsis;
        }

        .card-body h5 {
        font-size: 14px;
        height: 30px;

        }
        
        .card-body {
        height: 200px;
        }

        .col-md-4 {
            flex: 0 0 20%; /* Mengatur lebar kolom untuk tampilan dekstop */
            max-width: 20%;
        }

        @media (max-width: 767px) {

            .col-md-4 {
                flex: 0 0 50%;
                max-width: 50%;
            }

            .card-body {
                height: 130px;
                overflow: hidden;
                text-overflow: ellipsis;
            }

            .card-body p {
                font-size: 12px;
                height: 20px;
                overflow: hidden;
                text-overflow: ellipsis;
            }

            .card-title {
                font-size: 12px;
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
            }
        }
    </style>
</head>

<body>
    <div id="layout-wrapper">
        <?php include 'layouts/menu.php'; ?>
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <div class="row">
                        <?php foreach ($products as $product) : ?>
                            <div class="col-md-4 col-sm-6">
                                <div class="card clickable-card" onclick="addToCart('<?php echo $product['sku']; ?>');">
                                    <img src="<?php echo $product['urlimage']; ?>" class="card-img-top" alt="Product Image">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo $product['itemname']; ?></h5>
                                        <p class="card-text">SKU: <?php echo $product['sku']; ?></p>
                                        <p class="card-text">Poin: <?php echo $product['poin']; ?></p>
                                        <a href="cart.php?sku=<?php echo $product['sku']; ?>" class="btn btn-success"><i class="ri-heart-fill align-bottom me-1"></i> Beli</a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <?php include 'layouts/vendor-scripts.php'; ?>
    <script src="assets/js/app.js"></script>
    <script src="assets/libs/sweetalert2/sweetalert2.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function addToCart(sku) {
            window.location.href = 'cart.php?sku=' + sku;
        }
    </script>
</body>

</html>
