<?php
error_reporting(E_ALL & ~E_NOTICE);

include 'layouts/main.php';
include 'layouts/config.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: *");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php includeFileWithVariables('layouts/title-meta.php', array('title' => 'View All Products')); ?>
    <?php include 'layouts/head-css.php'; ?>

    <?php
    // Tambahkan URL gambar default
    $defaultImage = 'memberhsg/mobile/images/default.jpg';
    ?>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


    <style>
        .product-container {
            display: grid;
            gap: 20px;
            margin-top: 20px;
        }

        .product-card {
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: box-shadow 0.3s ease-in-out;
            cursor: pointer;
            width: 100%;
        }

        .product-img {
            height: auto;
            width: 100%;
            object-fit: cover;
            border-bottom: 1px solid #ddd;
            border-radius: 8px 8px 0 0;
        }

        .product-details {
            padding: 15px;
        }

        .product-title {
            font-weight: bold;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            margin-bottom: 10px;
        }

        .product-sku {
            color: #6c757d;
            font-size: 14px;
            margin-bottom: 10px;
        }

        /* CSS for modal close button */
        .close {
            color: black;
            opacity: 0.8;
            transition: opacity 0.3s ease;
        }

        .close:hover,
        .close:focus {
            color: black;
            opacity: 1;
        }

        /* Media Queries */
        @media (max-width: 767px) {
            .product-container {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (min-width: 768px) {
            .product-container {
                grid-template-columns: repeat(5, 1fr);
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
                    <?php
                    if (isset($_GET['division'])) {
                        $selectedDivision = $_GET['division'];
                        $remoteUrlProducts = "http://103.106.79.238:81/hsgmember/loaddata.php?action=getListNew&flag=" . getFlagForDivision($selectedDivision) . "&param=10";
                        $jsonDataProducts = @file_get_contents($remoteUrlProducts);

                        if ($jsonDataProducts === false) {
                            echo "<p class='not-found-message show'>Gagal mengambil data produk untuk divisi $selectedDivision</p>";
                        } else {
                            $products = json_decode($jsonDataProducts, true);

                            if (!empty($products)) {
                                echo "<h2 class='font-weight-bold mb-4'>$selectedDivision Products</h2>";
                                echo "<div class='product-container'>";

                                foreach ($products as $product) {
                                    // Check if 'productid' key exists in the current product array
                                    $productId = isset($product['productid']) ? $product['productid'] : '';
                                    $imageUrl = !empty($product['urlimage']) ? $product['urlimage'] : $defaultImage;

                                    echo "<div class='product-card' data-toggle='modal' data-target='#productModal$productId' onclick='updateModalContent(\"$productId\", \"{$product['productname']}\", \"$imageUrl\", \"{$product['nic']}\", \"{$product['color']}\")'>";
                                    echo "<img class='product-img' src='$imageUrl' alt='{$product['productname']}'>";
                                    echo "<div class='product-details'>";
                                    echo "<h6 class='product-title'>{$product['productname']}</h6>";
                                    echo "<p class='product-sku'>" . formatSKU($product['nic'], $product['color'], $product['productname']) . "</p>";
                                    echo "</div>";
                                    echo "</div>";

                                    // Modal for Product Details
                                    echo "<div class='modal fade' id='productModal$productId' tabindex='-1' role='dialog' aria-labelledby='productModalLabel' aria-hidden='true'>";
                                    echo "<div class='modal-dialog' role='document'>";
                                    echo "<div class='modal-content'>";
                                    echo "<div class='modal-header'>";
                                    echo "<h5 class='modal-title' id='productModalLabel'></h5>";
                                    echo "<button type='button' class='close' data-dismiss='modal' aria-label='Close'>";
                                    echo "<span aria-hidden='true'>&times;</span>";
                                    echo "</button>";
                                    echo "</div>";
                                    echo "<div class='modal-body'>";
                                    echo "<img class='product-img' src='$imageUrl' alt='{$product['productname']}'>";
                                    echo "<p class='product-sku'>" . formatSKU($product['nic'], $product['color'], $product['productname']) . "</p>";
                                    echo "</div>";
                                    echo "</div>";
                                    echo "</div>";
                                    echo "</div>";
                                }

                                echo "</div>";
                            } else {
                                echo "<p class='not-found-message show'>Data produk tidak ditemukan untuk divisi $selectedDivision</p>";
                            }
                        }
                    } else {
                        echo "<p class='not-found-message show'>Tidak ada divisi yang dipilih</p>";
                    }

                    function formatSKU($nic, $color, $productName)
                    {
                        $formattedSKU = '';

                        if (!empty($nic)) {
                            $formattedSKU .= "NIC: $nic";
                        }

                        if (!empty($color)) {
                            $formattedSKU .= !empty($formattedSKU) ? " / " : "";
                            $formattedSKU .= "Color: $color";
                        }

                        if (empty($formattedSKU)) {
                            $formattedSKU = $productName; // Jika tidak ada nic dan color, tampilkan nama produk saja
                        }

                        return $formattedSKU;
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Additional scripts if needed -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-fn5aRlAL3UJlZuEKFAfFEadIDFLFZhMWhucn+aK1YIHdZOxTY2KPhwCiGqVuC3eG" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <?php include 'layouts/vendor-scripts.php'; ?>
    <script src="assets/js/app.js"></script>
    <script src="assets/libs/sweetalert2/sweetalert2.min.js"></script>

    <script>
        function updateModalContent(productId, productName, imageUrl, nic, color)
        {
            // Update modal title
            document.getElementById('productModalLabel').innerText = productName;

            // Update modal body content
            var modalBody = document.querySelector('#productModal' + productId + ' .modal-body');
            modalBody.innerHTML = "<img class='product-img' src='" + imageUrl + "' alt='" + productName + "'>";
            modalBody.innerHTML += "<p class='product-sku'>" + formatSKU(nic, color, productName) + "</p>";
        }

        function formatSKU(nic, color, productName)
        {
            var formattedSKU = '';

            if (nic) {
                formattedSKU += "NIC: " + nic;
            }

            if (color) {
                formattedSKU += formattedSKU ? " / " : "";
                formattedSKU += "Color: " + color;
            }

            if (!formattedSKU) {
                formattedSKU = productName;
            }

            return formattedSKU;
        }
    </script>
</body>

</html>

<?php
function getFlagForDivision($divisionName)
{
    // Define the mapping of division names to flags
    $divisionFlags = array(
        'Vapehan' => 'vp',
        'Helihantoys' => 'ht',
        'HSGMoto' => 'moto',
        'Hans Print Plus' => 'hp'
    );

    // Check if the division name exists in the mapping
    if (array_key_exists($divisionName, $divisionFlags)) {
        return $divisionFlags[$divisionName];
    } else {
        return ''; // Return an empty string or handle the case as needed
    }
}
?>
