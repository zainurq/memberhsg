<?php include 'layouts/main.php'; ?>
<?php include 'layouts/config.php'; ?>
<?php $custid = $_GET['custid']; ?>

<head>

    <?php includeFileWithVariables('layouts/title-meta.php', array('title' => 'Product Details')); ?>

    <!-- Sweet Alert css-->
    <link href="assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />

    <?php include 'layouts/head-css.php'; ?>

</head>

<body>

    <!-- Begin page -->
    <div id="layout-wrapper">

        <?php include 'layouts/menu.php'; ?>
        
        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <?php includeFileWithVariables('layouts/page-title.php', array('pagetitle' => 'Product', 'title' => 'Product Details')); ?>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row gx-lg-5">
                                            <?php 
                                                if($login == 'false'){
                                                    $poin = 'Silahkan login dahulu, untuk melihat jumlah poin anda';
                                                }else{
                                                    $poin = $_SESSION['poin'];
                                                }

                                                $sku = mysqli_real_escape_string($link, $_GET['sku']); 

                                                $query = "select *, (select sum(nominal) as total from gift_scratch where custid = 1) as duitkw 
                                                            from gift_itemmaster where sku = '".$sku."'";

                                                $exec = mysqli_query($link, $query);

                                                while($row = mysqli_fetch_array($exec)) {
                                                    $itemId      = $row['sku'];
                                                    $itemName    = $row['itemname'];
                                                    $color       = $row['color'];
                                                    $nic         = $row['nic'];
                                                    $description = $row['description'];
                                                    $nominal     = $row['nominal'];
                                                    $qty         = $row['qty'];
                                                    $datecreate  = $row['createdate'];
                                                    $poinamt     = $row['poin'];
                                                    $image       = $row['image'];
                                                }
                                            ?>
                                        <div class="col-xl-4 col-md-8 mx-auto">
                                            <div class="product-img-slider sticky-side-div">
                                            <img src="assets/images/products/<?php echo $image; ?>" alt="" class="img-fluid rounded" />
                                                <!-- end swiper thumbnail slide -->
                                            </div>
                                        </div>
                                        <!-- end col -->

                                        <div class="col-xl-8">
                                            <div class="mt-xl-0 mt-1">
                                                <div class="d-flex">
                                                    <div class="flex-grow-1">
                                                        <h4><?php echo $itemName; ?></h4>
                                                        <input type="hidden" value="<?php echo $itemId; ?>" id="sku">
                                                        <div class="hstack gap-3 flex-wrap">
                                                            <div><a href="#" class="text-primary d-block" id="sku"><?php echo $itemId; ?></a></div>
                                                            <div class="vr"></div>
                                                            <div class="text-muted">Published : <span class="text-body fw-medium"><?php echo $datecreate; ?></span></div>
                                                        </div>
                                                    </div>  
                                                </div>

                                                <div class="d-flex flex-wrap gap-2 align-items-center mt-3">
                                                    <div class="text-muted fs-16">
                                                        <span class="mdi mdi-star text-warning"></span>
                                                        <span class="mdi mdi-star text-warning"></span>
                                                        <span class="mdi mdi-star text-warning"></span>
                                                        <span class="mdi mdi-star text-warning"></span>
                                                        <span class="mdi mdi-star text-warning"></span>
                                                    </div>
                                                    <div class="text-muted">( 5.50k Customer Review )</div>
                                                </div>

                                                <div class="row mt-4">
                                                    <div class="col-lg-3 col-sm-6">
                                                        <div class="p-2 border border-dashed rounded">
                                                            <div class="d-flex align-items-center">
                                                                <div class="avatar-sm me-2">
                                                                    <div class="avatar-title rounded bg-transparent text-success fs-24">
                                                                        <i class="ri-money-dollar-circle-fill"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="flex-grow-1">
                                                                    <p class="text-muted mb-1">Poin Redeem :</p>
                                                                    <h5 class="mb-0"><?php echo number_format($poinamt, 0, ',', '.'); ?></h5>
                                                                    <p style="display: none" id="harga"><?php echo $nominal; ?></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- end col -->
                                                    <div class="col-lg-3 col-sm-6">
                                                        <div class="p-2 border border-dashed rounded">
                                                            <div class="d-flex align-items-center">
                                                                <div class="avatar-sm me-2">
                                                                    <div class="avatar-title rounded bg-transparent text-success fs-24">
                                                                        <i class="ri-stack-fill"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="flex-grow-1">
                                                                    <p class="text-muted mb-1">Available Stocks :</p>
                                                                    <h5 class="mb-0"><?php echo $qty; ?></h5>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- end col -->
                                                    <div class="col-lg-5 col-sm-4">
                                                        <div class="p-2 border border-dashed rounded">
                                                            <div class="d-flex align-items-center">
                                                                <div class="avatar-sm me-2">
                                                                    <div class="avatar-title rounded bg-transparent text-success fs-24">
                                                                        <i class="mdi mdi-wallet-membership"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="flex-grow-1">
                                                                    <p class="text-muted mb-1">Pengiriman :</p>
                                                                    <h5 class="mb-0">Bebas biaya pengiriman</h5>
                                                                    <p style="display: none" id="duitkw"><?php echo $duitkw; ?></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- end col -->
                                                </div>

                                                <div class="row">
                                                    <div class="col-xl-6">
                                                        <div class="mt-4">
                                                            <h5 class="fs-14">Nic :</h5>
                                                            <h3 class="fs-14"><?php echo $nic; ?></h3>
                                                        </div>
                                                    </div>
                                                    <!-- end col -->

                                                    <div class="col-xl-6">
                                                        <div class=" mt-4">
                                                            <h5 class="fs-14">Colors :</h5>
                                                            <h3 class="fs-14"><?php echo $color; ?></h3>
                                                        </div>
                                                    </div>
                                                    <!-- end col -->
                                                </div>
                                                <!-- end row -->

                                                <div class="mt-4 text-muted">
                                                    <h5 class="fs-14">Description :</h5>
                                                    <p><?php echo $description ?></p>
                                                </div>

                                                <div class="col-lg-5 col-sm-4">
                                                        <div class="p-2 border border-dashed rounded">
                                                            <div class="d-flex align-items-center">
                                                                <div class="avatar-sm me-2">
                                                                    <div class="avatar-title rounded bg-transparent text-success fs-24">
                                                                        <i class="ri-award-fill"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="flex-grow-1">
                                                                    <p class="text-muted mb-1">Balance Poin :</p>
                                                                    <h5 class="mb-0"><?php echo $poin ?></h5>
                                                                    <p style="display: none" id="duitkw"><?php echo $duitkw; ?></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                <div class="mt-5">
                                                    <button type="button" class="btn btn-primary btn-label waves-effect waves-light" id="redeem-product">
                                                        <i class="<?php echo $login == 'false' ? 'ri-login-box-line' : 'ri-shopping-cart-2-fill'; ?> label-icon align-middle fs-16 me-2"></i> 
                                                        <?php echo $login == 'false' ? 'Login' : 'Redeem'; ?></button>
                                                </div>
                                                <!-- end card body -->
                                            </div>
                                        </div>
                                        <!-- end col -->
                                    </div>
                                    <!-- end row -->
                                </div>
                                <!-- end card body -->
                            </div>
                            <!-- end card -->
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row -->

                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

            <?php include 'layouts/footer.php'; ?>
        </div>
        <!-- end main content-->
    </div>
    <!-- END layout-wrapper -->

    <!-- removeItemModal -->
    <div id="warningModal" class="modal fade zoomIn" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mt-2 text-center">
                        <!-- <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon> -->
                        <div class="swal2-icon swal2-error swal2-icon-show" style="display: flex;"><span class="swal2-x-mark">
                            <span class="swal2-x-mark-line-left"></span>
                            <span class="swal2-x-mark-line-right"></span>
                        </span>
                        </div>
                        <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                            <h4>Redeem Item</h4>
                            <p class="text-muted mx-4 mb-0">Poin anda tidak mencukupi, silahkan kolek poin dulu</p>
                        </div>
                    </div>
                    <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                        <button type="button" class="btn w-sm btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <?php include 'layouts/vendor-scripts.php'; ?>

    <!-- Sweet Alerts js -->
    <script src="assets/libs/sweetalert2/sweetalert2.min.js"></script>

    <!-- App js -->
    <script src="assets/js/app.js"></script>

    <!-- custom add function js -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#redeem-product').click(function () {
                var loggedIn = <?php echo $login; ?>;

                // Jika pengguna telah login, hindari kembali ke halaman login
                if (loggedIn) {
                    var _custId = '<?php echo $custid; ?>';
                    var _sku = document.getElementById("sku").value;
                    var _poin = parseInt('<?php echo $poin; ?>');
                    var _amount = parseInt('<?php echo $poinamt; ?>');

                    if(_poin >= _amount) {
                        $.ajax({
                            url: 'assets/api/process.php?action=addtocart', // Ganti dengan lokasi file PHP Anda
                            type: 'GET', // Atau 'POST' jika sesuai
                            data: { custid: _custId, sku: _sku, poin: _amount },
                            success: function (response) {
                                window.location.href = 'cart.php?custid='+_custId;
                            },
                            error: function () {
                                alert('Connection refused, please try again');
                            }
                        });
                    }else{
                        var myModal = new bootstrap.Modal(document.getElementById('warningModal'));
                        myModal.show();
                    }
                }else{
                    window.location.href = 'login.php';
                }
            });
        });
    </script>
</body>

</html>