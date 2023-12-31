<?php
include 'layouts/main.php';
include 'layouts/config.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: *");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php includeFileWithVariables('layouts/title-meta.php', array('title' => 'Home')); ?>
    <?php include 'layouts/head-css.php'; ?>
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <style>
        .carousel-inner {
            display: flex;
            flex-wrap: nowrap;
            overflow: hidden;
        }

        .col-md-2 {
            flex: 0 0 19%;
            max-width: 19%;
            margin-right: 1%;
        }

        .card {
            height: 375px;
            margin-top: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease-in-out;
            margin-bottom: 60px;
            position: relative;
        }

        .card-img-top {
            height: 275px;
            width: 100%;
            border-radius: 8px 8px 0 0;
        }

        .carousel-control-prev,
        .carousel-control-next {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            font-size: 24px;
            color: #6c757d;
            cursor: pointer;
            background: none;
            border: none;
            outline: none;
            transition: color 0.3s ease-in-out;
        }

        .carousel-control-prev:hover,
        .carousel-control-next:hover {
            color: #495057;
        }

        .carousel-control-prev {
            left: 10px;
        }

        .carousel-control-next {
            right: 10px;
        }

        .card-title {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .card:hover {
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        @media (max-width: 767px) {
            .carousel-inner {
                flex-wrap: wrap;
            }

            .col-md-2 {
                flex: 0 0 48%;
                max-width: 48%;
                margin-right: 1%;
                margin-bottom: 1%;
            }

            .card {
                height: 300px;
                margin-top: 20px;
            }
        }

        @media (min-width: 768px) and (max-width: 991px) {
            .col-md-2 {
                flex: 0 0 24%;
                max-width: 24%;
                margin-right: 1%;
                margin-bottom: 1%;
            }
        }

        .not-found-message {
            text-align: center;
            padding: 20px;
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
            border-radius: 5px;
            margin-top: 20px;
            opacity: 0;
            transform: translateY(-20px);
            transition: opacity 0.3s ease-in-out, transform 0.3s ease-in-out;
        }

        .not-found-message.show {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
</head>
<body>
    <div id="layout-wrapper">
        <?php include 'layouts/menu.php'; ?>
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <?php
                    $remoteUrlDivisi = 'http://103.106.79.238:81/hsgmember/loaddata.php?action=getDivisi';
                    $jsonDataDivisi = @file_get_contents($remoteUrlDivisi);

                    if ($jsonDataDivisi === false) {
                        echo '<p class="not-found-message show">Gagal mengambil data divisi</p>';
                    } else {
                        $divisions = json_decode($jsonDataDivisi, true);

                        displayProductsForDivision('Vapehan', 'vp', 10, $divisions);
                        displayProductsForDivision('Helihantoys', 'ht', 10, $divisions);
                        displayProductsForDivision('HSGMoto', 'moto', 10, $divisions);
                        displayProductsForDivision('Hans Print Plus', 'hp', 10, $divisions);
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

     <!-- Tambahkan modal -->
     <div class="modal fade" id="productModal" tabindex="-1" role="dialog" aria-labelledby="productModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="productModalLabel">Product Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="productModalBody">
                    <!-- Isi modal akan ditampilkan di sini -->
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <?php include 'layouts/vendor-scripts.php'; ?>
    <script src="assets/js/app.js"></script>
    <script src="assets/libs/sweetalert2/sweetalert2.min.js"></script>

    <script>
        // Fungsi untuk menampilkan modal dengan informasi produk
        function showProductDetails(productData) {
            var modalBody = $('#productModalBody');
            modalBody.empty();

            // Tambahkan informasi produk ke dalam modal
            modalBody.append('<p><strong>Name:</strong> ' + productData.productname + '</p>');
            modalBody.append('<p><strong>SKU:</strong> ' + productData.sku + '</p>');
            modalBody.append('<img src="' + productData.urlimage + '" class="img-fluid" alt="' + productData.productname + '">');

            // Tampilkan modal
            $('#productModal').modal('show');
        }

        // Document ready function
        $(document).ready(function () {
            // Tambahkan event click untuk setiap produk
            $('.card').on('click', function () {
                // Dapatkan data produk dari atribut data
                var productData = {
                    productname: $(this).find('.card-title').text(),
                    sku: $(this).find('.card-text').text().replace('SKU: ', ''),
                    urlimage: $(this).find('.card-img-top').attr('src')
                };

                // Tampilkan informasi produk di modal
                showProductDetails(productData);
            });
        });
    </script>
</body>
</html>

<?php
function findDivision($divisions, $targetNamediv) {
    foreach ($divisions as $division) {
        if ($division['namediv'] === $targetNamediv) {
            return $division;
        }
    }
    return null;
}

function displayProductsForDivision($targetNamediv, $flag, $param, $divisions) {
    $targetDivision = findDivision($divisions, $targetNamediv);
    
    if ($targetDivision !== null) {
        if ($targetDivision['publish'] == 1) {
            $remoteUrlProducts = "http://103.106.79.238:81/hsgmember/loaddata.php?action=getListNew&flag=$flag&param=$param";
            $jsonDataProducts = @file_get_contents($remoteUrlProducts);
            $defaultImage = 'mobile/images/default.jpg';

            if ($jsonDataProducts === false) {
                echo "<p class='not-found-message show'>Gagal mengambil data produk untuk divisi $targetDivision[namediv]</p>";
            } else {
                $products = json_decode($jsonDataProducts, true);

                if (!empty($products)) {
                    $numProductsPerRow = (isset($_GET['mobile']) && $_GET['mobile'] == 'true') ? 2 : 5;
                    $productChunks = array_chunk($products, $numProductsPerRow);
                    
                    ?>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="font-weight-bold"><?= $targetDivision['namediv'] ?></h4>
                        </div>
                        <div class="col-md-6 text-right">
                            <a href="viewall.php?division=<?= urlencode($targetDivision['namediv']) ?>" class="btn btn-primary">View All</a>
                        </div>
                    </div>


                    <div id="<?= $targetDivision['namediv'] ?>Carousel" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <?php
                            foreach ($productChunks as $index => $productChunk) {
                                $activeClass = $index === 0 ? ' active' : '';
                                ?>
                                <div class="carousel-item<?= $activeClass ?>">
                                    <div class="row">
                                        <?php
                                        foreach ($productChunk as $product) {
                                            ?>
                                            <div class="col-md-<?php echo (isset($_GET['mobile']) && $_GET['mobile'] == 'true') ? '6' : '2'; ?>">
                                                <div class="card">
                                                    <?php
                                                    // Tambahkan logika untuk menampilkan gambar default jika tidak ada gambar
                                                    $imageUrl = !empty($product['urlimage']) ? $product['urlimage'] : $defaultImage;
                                                    ?>
                                                    <img src="<?= $imageUrl ?>" class="card-img-top" alt="<?= $product['productname'] ?>">
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
                        <a class="carousel-control-prev" href="#<?= $targetDivision['namediv'] ?>Carousel" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Sebelumnya</span>
                        </a>
                        <a class="carousel-control-next" href="#<?= $targetDivision['namediv'] ?>Carousel" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Berikutnya</span>
                        </a>
                    </div>
                    <?php
                } else {
                    echo "<p class='not-found-message show'>Data produk tidak ditemukan untuk divisi $targetDivision[namediv]</p>";
                }
            }
        } else {
            echo "<p class='not-found-message show'>Produk tidak ditampilkan karena divisi $targetDivision[namediv] tidak di-publish</p>";
        }
    } else {
        echo "<p class='not-found-message show'>Divisi $targetNamediv tidak ditemukan</p>";
    }
}
?>
