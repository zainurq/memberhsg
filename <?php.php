<?php
include 'layouts/main.php';
include 'layouts/config.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php includeFileWithVariables('layouts/title-meta.php', array('title' => 'Redeem')); ?>
    <?php include 'layouts/head-css.php'; ?>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <style>
        .card-body p {
            font-size: 12px;
            height: 40px;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        @media (max-width: 767px) {
            .carousel-inner {
                display: flex;
                flex-wrap: nowrap;
                overflow: hidden;
            }

            .col-md-6 {
                flex: 0 0 50%; /* 2 kolom per baris pada tampilan mobile */
                max-width: 50%;
            }

            .card-body {
                height: 150px;
                overflow: hidden;
                text-overflow: ellipsis;
            }

            .card-body p {
                font-size: 12px;
                height: 40px;
                overflow: hidden;
                text-overflow: ellipsis;
            }

            .card-title {
                font-size: 14px;
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
                    <div class="container">
                        <?php
                        $carouselCategories = array('vp', 'ht', 'moto', 'hp');

                        foreach ($carouselCategories as $category) {
                            // Fetch data for each category
                            $remoteUrlProducts = "http://103.106.79.238:81/hsgmember/loaddata.php?action=getListNew&flag={$category}&param=10";
                            $jsonDataProducts = @file_get_contents($remoteUrlProducts);
                            $products = json_decode($jsonDataProducts, true);

                            if (is_array($products) && count($products) > 0) {
                                $productsToShow = array_slice($products, 0, 5); // Limit to 5 products
                                ?>
                                <div class="d-flex justify-content-between align-items-center mb-3 mt-5">
                                    <h4 class="font-weight-bold">Featured Products (<?= strtoupper($category) ?>)</h4>
                                    <a href="#" class="btn btn-primary">View All</a>
                                </div>

                                <div id="productCarousel<?= ucfirst($category) ?>" class="carousel slide" data-ride="carousel">
                                    <div class="carousel-inner">
                                        <?php
                                        $productChunks = array_chunk($productsToShow, 2);

                                        foreach ($productChunks as $index => $productChunk) {
                                            $activeClass = $index === 0 ? ' active' : '';
                                            ?>
                                            <div class="carousel-item<?= $activeClass ?>">
                                                <div class="row">
                                                    <?php
                                                    foreach ($productChunk as $product) {
                                                        ?>
                                                        <div class="col-md-6">
                                                            <div class="card">
                                                                <img src="<?= $product['urlimage'] ?>" class="card-img-top" alt="<?= $product['productname'] ?>">
                                                                <div class="card-body">
                                                                    <h6 class="card-title"><?= $product['productname'] ?></h6>
                                                                    <p class="card-text">SKU: <?= $product['sku'] ?></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                    </div>

                                    <a class="carousel-control-prev" href="#productCarousel<?= ucfirst($category) ?>" role="button" data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#productCarousel<?= ucfirst($category) ?>" role="button" data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>
                                <?php
                            } else {
                                // Tampilkan pesan jika data null
                                ?>
                                <div class="alert alert-warning" role="alert">
                                    No products available for <?= strtoupper($category) ?>.
                                </div>
                                <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UoZ+SUoQ5Lh5l9a0ZzztcTCxPZtbU5vN+KsZdLc2PUUjDvqJSkd9my0Pkkx21ZkN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
