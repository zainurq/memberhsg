                    <div class="modal fade" id="productDetailsModal" tabindex="-1" role="dialog" aria-labelledby="productDetailsModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="productDetailsModalLabel">Product Details</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <img id="modalProductImage" class="img-fluid mb-3" alt="Product Image">
                                    <p id="modalProductName" class="mb-1 fw-bold"></p>
                                    <p id="modalProductSKU" class="mb-1 text-muted"></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="d-lg-flex align-items-center mb-4">
                                <div class="flex-grow-1">
                                    <p class="card-title mb-0 fw-semibold fs-16">Item Baru Vapehan</p>
                                </div>
                                <div class="flex-shrink-0 mt-4 mt-lg-0">
                                <a href="view_all.php?type=vapehan" class="btn btn-soft-primary">View All <i class="ri-arrow-right-line align-bottom"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php
                    $queryVapehan = "SELECT sku, productname, nic, color, IF(nic = '', color, nic) AS flag,
                                    TIMESTAMPDIFF(DAY, date_create, CURDATE()) AS cek,
                                    CONCAT('http://103.106.79.238:81/hsgmoto/images/vapehan/', sku, '.jpg') AS urlimage
                                    FROM htwarehouse.masterproduct
                                    WHERE TIMESTAMPDIFF(DAY, date_create, CURDATE()) BETWEEN 1 AND 7
                                    LIMIT 9";

                    $resultVapehan = mysqli_query($link, $queryVapehan);

                    if ($resultVapehan) {
                        $itemCountVapehan = mysqli_num_rows($resultVapehan);

                        if ($itemCountVapehan > 0) {
                            $productsVapehan = mysqli_fetch_all($resultVapehan, MYSQLI_ASSOC);

                            // Desktop Carousel
                            echo '<div id="productCarouselVapehan" class="carousel slide d-none d-lg-block" data-bs-ride="carousel">';
                            echo '<div class="carousel-inner">';

                            for ($i = 0; $i < $itemCountVapehan; $i += 5) {
                                echo '<div class="carousel-item ' . (($i == 0) ? 'active' : '') . '">';
                                echo '<div class="row row-cols-xl-5 row-cols-lg-3 row-cols-md-2 row-cols-1">';

                                for ($j = 0; $j < 5 && ($i + $j) < $itemCountVapehan; $j++) {
                                    $rowVapehan = $productsVapehan[$i + $j];
                                    echo '<div class="col">';
                                    echo '<div class="card explore-box card-animate" id="vapehan">';
                                    echo '<div class="explore-place-bid-img">';
                                    echo '<img src="' . ($rowVapehan['urlimage'] ? $rowVapehan['urlimage'] : 'mobile/images/default.png') . '" alt="" class="card-img-top explore-img w-100" />';
                                    echo '<div class="bg-overlay"></div>';
                                    echo '<div class="place-bid-btn">';
                                    echo '<a href="#productDetailsModal" data-bs-toggle="modal" data-image="' . $rowVapehan['urlimage'] . '" data-name="' . $rowVapehan['productname'] . '" data-sku="' . $rowVapehan['sku'] . '" class="btn btn-success view-product"><i class="ri-heart-fill align-bottom me-1"></i> View</a>';
                                    echo '</div>';
                                    echo '</div>';
                                    echo '<div class="card-body">';
                                    echo '<p class="mb-1"><a href="#">' . $rowVapehan['productname'] . '</a></p>';
                                    echo '</div>';
                                    echo '</div>';
                                    echo '</div>';
                                }

                                echo '</div>';
                                echo '</div>';
                            }

                            echo '</div>';
                            echo '<button class="carousel-control-prev" type="button" data-bs-target="#productCarouselVapehan" data-bs-slide="prev">';
                            echo '<span class="carousel-control-prev-icon" aria-hidden="true"></span>';
                            echo '<span class="visually-hidden">Previous</span>';
                            echo '</button>';
                            echo '<button class="carousel-control-next" type="button" data-bs-target="#productCarouselVapehan" data-bs-slide="next">';
                            echo '<span class="carousel-control-next-icon" aria-hidden="true"></span>';
                            echo '<span class="visually-hidden">Next</span>';
                            echo '</button>';
                            echo '</div>';
                            
                            // Mobile Carousel
                            echo '<div id="productCarouselVapehanMobile" class="carousel slide d-lg-none" data-bs-ride="carousel">';
                            echo '<div class="carousel-inner">';

                            for ($i = 0; $i < $itemCountVapehan; $i += 2) {
                                echo '<div class="carousel-item ' . (($i == 0) ? 'active' : '') . '">';
                                echo '<div class="row row-cols-2">';

                                for ($j = 0; $j < 2 && ($i + $j) < $itemCountVapehan; $j++) {
                                    $rowVapehan = $productsVapehan[$i + $j];
                                    echo '<div class="col">';
                                    echo '<div class="card explore-box card-animate" id="vapehan">';
                                    echo '<div class="explore-place-bid-img">';
                                    echo '<img src="' . ($rowVapehan['urlimage'] ? $rowVapehan['urlimage'] : 'mobile/images/default.png') . '" alt="" class="card-img-top explore-img w-100" />';
                                    echo '<div class="bg-overlay"></div>';
                                    echo '<div class="place-bid-btn">';
                                    echo '<a href="#productDetailsModal" data-bs-toggle="modal" data-image="' . $rowVapehan['urlimage'] . '" data-name="' . $rowVapehan['productname'] . '" data-sku="' . $rowVapehan['sku'] . '" class="btn btn-success view-product"><i class="ri-heart-fill align-bottom me-1"></i> View</a>';
                                    echo '</div>';
                                    echo '</div>';
                                    echo '<div class="card-body">';
                                    echo '<p class="mb-1"><a href="#">' . $rowVapehan['productname'] . '</a></p>';
                                    echo '</div>';
                                    echo '</div>';
                                    echo '</div>';
                                }

                                echo '</div>';
                                echo '</div>';
                            }

                            echo '</div>';
                            echo '<button class="carousel-control-prev" type="button" data-bs-target="#productCarouselVapehanMobile" data-bs-slide="prev">';
                            echo '<span class="carousel-control-prev-icon" aria-hidden="true"></span>';
                            echo '<span class="visually-hidden">Previous</span>';
                            echo '</button>';
                            echo '<button class="carousel-control-next" type="button" data-bs-target="#productCarouselVapehanMobile" data-bs-slide="next">';
                            echo '<span class="carousel-control-next-icon" aria-hidden="true"></span>';
                            echo '<span class="visually-hidden">Next</span>';
                            echo '</button>';
                            echo '</div>';
                        } else {
                            echo '<div class="text-center">No Vapehan products found</div>';
                        }
                    } else {
                        echo "Query Vapehan failed: " . mysqli_error($link);
                    }
                    ?>
                    
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="d-lg-flex align-items-center justify-content-between mb-4">
                                <div class="flex-grow-1">
                                    <p class="card-title mb-0 fw-semibold fs-16">Item Baru Moto</p>
                                </div>
                                <div class="flex-shrink-0 mt-4 mt-lg-0">
                                <a href="view_all.php?type=moto" class="btn btn-soft-primary">View All <i class="ri-arrow-right-line align-bottom"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>


                    <?php
                    $queryMoto = "SELECT sku, productname, nic, color, IF(nic = '', color, nic) AS flag,
                                TIMESTAMPDIFF(DAY, date_create, CURDATE()) AS cek,
                                CONCAT('http://103.106.79.238:81/hsgmoto/images/moto/', sku, '.jpg') AS urlimage
                                FROM hmwarehouse.masterproduct
                                WHERE TIMESTAMPDIFF(DAY, date_create, CURDATE()) BETWEEN 1 AND 20";

                    $resultMoto = mysqli_query($link, $queryMoto);

                    if ($resultMoto) {
                        $itemCountMoto = mysqli_num_rows($resultMoto);

                        if ($itemCountMoto > 0) {
                            $productsMoto = mysqli_fetch_all($resultMoto, MYSQLI_ASSOC);


                            echo '<div id="productCarouselMoto" class="carousel slide d-none d-lg-block" data-bs-ride="carousel">';
                            echo '<div class="carousel-inner">';

                            for ($i = 0; $i < $itemCountMoto; $i += 5) {
                                echo '<div class="carousel-item ' . (($i == 0) ? 'active' : '') . '">';
                                echo '<div class="row row-cols-xl-5 row-cols-lg-3 row-cols-md-2 row-cols-1">';

                                for ($j = 0; $j < 5 && ($i + $j) < $itemCountMoto; $j++) {
                                    $rowMoto = $productsMoto[$i + $j];
                                    echo '<div class="col">';
                                    echo '<div class="card explore-box card-animate" id="moto">';
                                    echo '<div class="explore-place-bid-img">';
                                    echo '<img src="' . $rowMoto['urlimage'] . '" alt="" class="card-img-top explore-img w-100" />';
                                    echo '<div class="bg-overlay"></div>';
                                    echo '<div class="place-bid-btn">';
                                    echo '<a href="#productDetailsModal" data-bs-toggle="modal" data-image="' . $rowMoto['urlimage'] . '" data-name="' . $rowMoto['productname'] . '" data-sku="' . $rowMoto['sku'] . '" class="btn btn-success view-product"><i class="ri-heart-fill align-bottom me-1"></i> View</a>';
                                    echo '</div>';
                                    echo '</div>';
                                    echo '<div class="card-body">';
                                    echo '<p class="mb-1"><a href="#">' . $rowMoto['productname'] . '</a></p>';
                                    echo '</div>';
                                    echo '</div>';
                                    echo '</div>';
                                }

                                echo '</div>';
                                echo '</div>';
                            }

                            echo '</div>';
                            echo '<button class="carousel-control-prev" type="button" data-bs-target="#productCarouselMoto" data-bs-slide="prev">';
                            echo '<span class="carousel-control-prev-icon" aria-hidden="true"></span>';
                            echo '<span class="visually-hidden">Previous</span>';
                            echo '</button>';
                            echo '<button class="carousel-control-next" type="button" data-bs-target="#productCarouselMoto" data-bs-slide="next">';
                            echo '<span class="carousel-control-next-icon" aria-hidden="true"></span>';
                            echo '<span class="visually-hidden">Next</span>';
                            echo '</button>';
                            echo '</div>';
                            
                            // Mobile Carousel
                            echo '<div id="productCarouselMotoMobile" class="carousel slide d-lg-none" data-bs-ride="carousel">';
                            echo '<div class="carousel-inner">';

                            for ($i = 0; $i < $itemCountMoto; $i += 2) {
                                echo '<div class="carousel-item ' . (($i == 0) ? 'active' : '') . '">';
                                echo '<div class="row row-cols-2">';

                                for ($j = 0; $j < 2 && ($i + $j) < $itemCountMoto; $j++) {
                                    $rowMoto = $productsMoto[$i + $j];
                                    echo '<div class="col">';
                                    echo '<div class="card explore-box card-animate" id="moto">';
                                    echo '<div class="explore-place-bid-img">';
                                    echo '<img src="' . ($rowMoto['urlimage'] ? $rowMoto['urlimage'] : 'mobile/images/default.png') . '" alt="" class="card-img-top explore-img w-100" />';
                                    echo '<div class="bg-overlay"></div>';
                                    echo '<div class="place-bid-btn">';
                                    echo '<a href="#productDetailsModal" data-bs-toggle="modal" data-image="' . $rowMoto['urlimage'] . '" data-name="' . $rowMoto['productname'] . '" data-sku="' . $rowMoto['sku'] . '" class="btn btn-success view-product"><i class="ri-heart-fill align-bottom me-1"></i> View</a>';
                                    echo '</div>';
                                    echo '</div>';
                                    echo '<div class="card-body">';
                                    echo '<p class="mb-1"><a href="#">' . $rowMoto['productname'] . '</a></p>';
                                    echo '</div>';
                                    echo '</div>';
                                    echo '</div>';
                                }

                                echo '</div>';
                                echo '</div>';
                            }

                            echo '</div>';
                            echo '<button class="carousel-control-prev" type="button" data-bs-target="#productCarouselMotoMobile" data-bs-slide="prev">';
                            echo '<span class="carousel-control-prev-icon" aria-hidden="true"></span>';
                            echo '<span class="visually-hidden">Previous</span>';
                            echo '</button>';
                            echo '<button class="carousel-control-next" type="button" data-bs-target="#productCarouselMotoMobile" data-bs-slide="next">';
                            echo '<span class="carousel-control-next-icon" aria-hidden="true"></span>';
                            echo '<span class="visually-hidden">Next</span>';
                            echo '</button>';
                            echo '</div>';
                        } else {
                            echo '<div class="text-center">No Moto products found</div>';
                        }
                    } else {
                        echo "Query Moto failed: " . mysqli_error($link);
                    }
                    ?>
                    
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="d-lg-flex align-items-center mb-4">
                                <div class="flex-grow-1">
                                    <p class="card-title mb-0 fw-semibold fs-16">Item Baru Hansprint</p>
                                </div>
                                <div class="flex-shrink-0 mt-4 mt-lg-0">
                                <a href="view_all.php?type=hansprint" class="btn btn-soft-primary">View All <i class="ri-arrow-right-line align-bottom"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php
                    $queryHansprint = "SELECT *, TIMESTAMPDIFF(DAY, dateupload, CURDATE()) AS cek
                                    FROM vp_pos.itemhanprint a
                                    WHERE TIMESTAMPDIFF(DAY, dateupload, CURDATE()) <= 30";

                    $resultHansprint = mysqli_query($link, $queryHansprint);

                    if ($resultHansprint) {
                        $itemCountHansprint = mysqli_num_rows($resultHansprint);

                        if ($itemCountHansprint > 0) {
                            $productsHansprint = mysqli_fetch_all($resultHansprint, MYSQLI_ASSOC);

                            // Desktop Carousel
                            echo '<div id="productCarouselHansprint" class="carousel slide d-none d-lg-block" data-bs-ride="carousel">';
                            echo '<div class="carousel-inner">';

                            for ($i = 0; $i < $itemCountHansprint; $i += 5) {
                                echo '<div class="carousel-item ' . (($i == 0) ? 'active' : '') . '">';
                                echo '<div class="row row-cols-xl-5 row-cols-lg-3 row-cols-md-2 row-cols-1">';

                                for ($j = 0; $j < 5 && ($i + $j) < $itemCountHansprint; $j++) {
                                    $rowHansprint = $productsHansprint[$i + $j];
                                    echo '<div class="col">';
                                    echo '<div class="card explore-box card-animate" id="hansprint">';
                                    echo '<div class="explore-place-bid-img">';
                                    echo '<img src="' . $rowHansprint['gambar'] . '" alt="" class="card-img-top explore-img w-100" />';
                                    echo '<div class="bg-overlay"></div>';
                                    echo '<div class="place-bid-btn">';
                                    echo '<a href="#productDetailsModal" data-bs-toggle="modal" data-image="' . $rowHansprint['gambar'] . '" data-name="' . $rowHansprint['nama'] . '" data-sku="' . $rowHansprint['sku'] . '" class="btn btn-success view-product"><i class="ri-heart-fill align-bottom me-1"></i> View</a>';
                                    echo '</div>';
                                    echo '</div>';
                                    echo '<div class="card-body">';
                                    echo '<p class="mb-1"><a href="#">' . $rowHansprint['nama'] . '</a></p>';
                                    echo '</div>';
                                    echo '</div>';
                                    echo '</div>';
                                }

                                echo '</div>';
                                echo '</div>';
                            }

                            echo '</div>';
                            echo '<button class="carousel-control-prev" type="button" data-bs-target="#productCarouselHansprint" data-bs-slide="prev">';
                            echo '<span class="carousel-control-prev-icon" aria-hidden="true"></span>';
                            echo '<span class="visually-hidden">Previous</span>';
                            echo '</button>';
                            echo '<button class="carousel-control-next" type="button" data-bs-target="#productCarouselHansprint" data-bs-slide="next">';
                            echo '<span class="carousel-control-next-icon" aria-hidden="true"></span>';
                            echo '<span class="visually-hidden">Next</span>';
                            echo '</button>';
                            echo '</div>';
                            
                            // Mobile Carousel
                            echo '<div id="productCarouselHansprintMobile" class="carousel slide d-lg-none" data-bs-ride="carousel">';
                            echo '<div class="carousel-inner">';

                            for ($i = 0; $i < $itemCountHansprint; $i += 2) {
                                echo '<div class="carousel-item ' . (($i == 0) ? 'active' : '') . '">';
                                echo '<div class="row row-cols-2">';

                                for ($j = 0; $j < 2 && ($i + $j) < $itemCountHansprint; $j++) {
                                    $rowHansprint = $productsHansprint[$i + $j];
                                    echo '<div class="col">';
                                    echo '<div class="card explore-box card-animate" id="hansprint">';
                                    echo '<div class="explore-place-bid-img">';
                                    echo '<img src="' . $rowHansprint['gambar'] . '" alt="" class="card-img-top explore-img w-100" />';
                                    echo '<div class="bg-overlay"></div>';
                                    echo '<div class="place-bid-btn">';
                                    echo '<a href="#productDetailsModal" data-bs-toggle="modal" data-image="' . $rowHansprint['gambar'] . '" data-name="' . $rowHansprint['nama'] . '" data-sku="' . $rowHansprint['sku'] . '" class="btn btn-success view-product"><i class="ri-heart-fill align-bottom me-1"></i> View</a>';
                                    echo '</div>';
                                    echo '</div>';
                                    echo '<div class="card-body">';
                                    echo '<p class="mb-1"><a href="#">' . $rowHansprint['nama'] . '</a></p>';
                                    echo '</div>';
                                    echo '</div>';
                                    echo '</div>';
                                }

                                echo '</div>';
                                echo '</div>';
                            }

                            echo '</div>';
                            echo '<button class="carousel-control-prev" type="button" data-bs-target="#productCarouselHansprintMobile" data-bs-slide="prev">';
                            echo '<span class="carousel-control-prev-icon" aria-hidden="true"></span>';
                            echo '<span class="visually-hidden">Previous</span>';
                            echo '</button>';
                            echo '<button class="carousel-control-next" type="button" data-bs-target="#productCarouselHansprintMobile" data-bs-slide="next">';
                            echo '<span class="carousel-control-next-icon" aria-hidden="true"></span>';
                            echo '<span class="visually-hidden">Next</span>';
                            echo '</button>';
                            echo '</div>';
                        } else {
                            echo '<div class="text-center">No Hansprint products found</div>';
                        }
                    } else {
                        echo "Query Hansprint failed: " . mysqli_error($link);
                    }
                    ?>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="d-lg-flex align-items-center mb-4">
                                <div class="flex-grow-1">
                                    <p class="card-title mb-0 fw-semibold fs-16">Item Baru Helihan</p>
                                </div>
                                <div class="flex-shrink-0 mt-4 mt-lg-0">
                                <a href="view_all.php?type=helihan" class="btn btn-soft-primary">View All <i class="ri-arrow-right-line align-bottom"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php
                    $queryHelihan = "SELECT *, TIMESTAMPDIFF(DAY, dateupload, CURDATE()) AS cek,
                                    (SELECT nama_product FROM ht_pos.master_product_new WHERE sku_product = a.sku LIMIT 1) AS productname
                                    FROM ht_pos.listitempromo a
                                    WHERE flag = 1 AND TIMESTAMPDIFF(DAY, dateupload, CURDATE()) <= 30";

                    $resultHelihan = mysqli_query($link, $queryHelihan);

                    if ($resultHelihan) {
                        $itemCountHelihan = mysqli_num_rows($resultHelihan);

                        if ($itemCountHelihan > 0) {
                            $productsHelihan = mysqli_fetch_all($resultHelihan, MYSQLI_ASSOC);

                            // Desktop Carousel
                            echo '<div id="productCarouselHelihan" class="carousel slide d-none d-lg-block" data-bs-ride="carousel">';
                            echo '<div class="carousel-inner">';

                            for ($i = 0; $i < $itemCountHelihan; $i += 5) {
                                echo '<div class="carousel-item ' . (($i == 0) ? 'active' : '') . '">';
                                echo '<div class="row row-cols-xl-5 row-cols-lg-3 row-cols-md-2 row-cols-1">';

                                for ($j = 0; $j < 5 && ($i + $j) < $itemCountHelihan; $j++) {
                                    $rowHelihan = $productsHelihan[$i + $j];
                                    echo '<div class="col">';
                                    echo '<div class="card explore-box card-animate" id="helihan">';
                                    echo '<div class="explore-place-bid-img">';
                                    echo '<img src="' . ($rowHelihan['urlimage'] ? $rowHelihan['urlimage'] : 'mobile/images/default.png') . '" alt="" class="card-img-top explore-img w-100" />';
                                    echo '<div class="bg-overlay"></div>';
                                    echo '<div class="place-bid-btn">';
                                    echo '<a href="#productDetailsModal" data-bs-toggle="modal" data-image="' . ($rowHelihan['urlimage'] ? $rowHelihan['urlimage'] : 'mobile/images/default.png') . '" data-name="' . $rowHelihan['productname'] . '" data-sku="' . $rowHelihan['sku'] . '" class="btn btn-success view-product"><i class="ri-heart-fill align-bottom me-1"></i> View</a>';
                                    echo '</div>';
                                    echo '</div>';
                                    echo '<div class="card-body">';
                                    echo '<p class="mb-1"><a href="#">' . $rowHelihan['productname'] . '</a></p>';
                                    echo '</div>';
                                    echo '</div>';
                                    echo '</div>';
                                }

                                echo '</div>';
                                echo '</div>';
                            }
                            echo '</div>';
                            echo '<button class="carousel-control-prev" type="button" data-bs-target="#productCarouselHelihan" data-bs-slide="prev">';
                            echo '<span class="carousel-control-prev-icon" aria-hidden="true"></span>';
                            echo '<span class="visually-hidden">Previous</span>';
                            echo '</button>';
                            echo '<button class="carousel-control-next" type="button" data-bs-target="#productCarouselHelihan" data-bs-slide="next">';
                            echo '<span class="carousel-control-next-icon" aria-hidden="true"></span>';
                            echo '<span class="visually-hidden">Next</span>';
                            echo '</button>';
                            echo '</div>';      
                            // Mobile Carousel
                            echo '<div id="productCarouselHelihanMobile" class="carousel slide d-lg-none" data-bs-ride="carousel">';
                            echo '<div class="carousel-inner">';
                            for ($i = 0; $i < $itemCountHelihan; $i += 2) {
                                echo '<div class="carousel-item ' . (($i == 0) ? 'active' : '') . '">';
                                echo '<div class="row row-cols-2">';

                                for ($j = 0; $j < 2 && ($i + $j) < $itemCountHelihan; $j++) {
                                    $rowHelihan = $productsHelihan[$i + $j];
                                    echo '<div class="col">';
                                    echo '<div class="card explore-box card-animate" id="helihan">';
                                    echo '<div class="explore-place-bid-img">';
                                    echo '<img src="' . ($rowHelihan['urlimage'] ? $rowHelihan['urlimage'] : 'mobile/images/default.png') . '" alt="" class="card-img-top explore-img w-100" />';
                                    echo '<div class="bg-overlay"></div>';
                                    echo '<div class="place-bid-btn">';
                                    echo '<a href="#productDetailsModal" data-bs-toggle="modal" data-image="' . ($rowHelihan['urlimage'] ? $rowHelihan['urlimage'] : 'mobile/images/default.png') . '" data-name="' . $rowHelihan['productname'] . '" data-sku="' . $rowHelihan['sku'] . '" class="btn btn-success view-product"><i class="ri-heart-fill align-bottom me-1"></i> View</a>';
                                    echo '</div>';
                                    echo '</div>';
                                    echo '<div class="card-body">';
                                    echo '<p class="mb-1"><a href="#">' . $rowHelihan['productname'] . '</a></p>';
                                    echo '</div>';
                                    echo '</div>';
                                    echo '</div>';
                                }
                                echo '</div>';
                                echo '</div>';
                            }
                            echo '</div>';
                            echo '<button class="carousel-control-prev" type="button" data-bs-target="#productCarouselHelihanMobile" data-bs-slide="prev">';
                            echo '<span class="carousel-control-prev-icon" aria-hidden="true"></span>';
                            echo '<span class="visually-hidden">Previous</span>';
                            echo '</button>';
                            echo '<button class="carousel-control-next" type="button" data-bs-target="#productCarouselHelihanMobile" data-bs-slide="next">';
                            echo '<span class="carousel-control-next-icon" aria-hidden="true"></span>';
                            echo '<span class="visually-hidden">Next</span>';
                            echo '</button>';
                            echo '</div>';
                        } else {
                            echo '<div class="text-center mt-4">No Helihan products found</div>';
                        }
                    } else {
                        echo "Query Helihan failed: " . mysqli_error($link);
                    }
                    ?>

                    
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Update modal content when the "View" button is clicked
        var viewButtons = document.querySelectorAll('.view-product');
        viewButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                var modalImage = document.getElementById('modalProductImage');
                var modalName = document.getElementById('modalProductName');
                var modalSKU = document.getElementById('modalProductSKU');

                modalImage.src = this.getAttribute('data-image');
                modalName.textContent = this.getAttribute('data-name');
                modalSKU.textContent = 'SKU: ' + this.getAttribute('data-sku');
            });
        });
    });
</script>