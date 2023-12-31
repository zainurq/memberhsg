<?php
include 'layouts/main.php';
include 'layouts/config.php';

$member = $_GET['member'];
$type = isset($_GET['type']) ? $_GET['type'] : '';
$fdate = $_GET['fdate'];
$tdate = $_GET['tdate'];
$flag = isset($_GET['flag']) ? $_GET['flag'] : '';

?>

<head>
    <?php includeFileWithVariables('layouts/title-meta.php', array('title' => 'Mendapatkan Point')); ?>
    <?php include 'layouts/head-css.php'; ?>
</head>

<body>
    <div id="layout-wrapper">
        <?php include 'layouts/menu.php'; ?>
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <?php
                    includeFileWithVariables('layouts/page-title.php', array('pagetitle' => 'HSGMember', 'title' => 'Point Didapatkan')); 
                    include 'mobile/connection.php';
                    $member = 'HSG.21.000001';
                    $query = "SELECT * from
                                (select a.no_invoice, a.invoice_date, a.time_transaction, 
                                format((select sub_amount from invoice_payment where no_invoice = a.no_invoice limit 1), 0) as amt, ifnull(b.point, 0) as point
                                from invoice_header a left join (select kd_member, invoice, point from point_member where flag = 'get') b
                                on a.kd_member = b.kd_member and a.no_invoice = b.invoice
                                where a.kd_member = '$member')x
                                order by invoice_date, time_transaction desc";

                    $result = $db->query($query);
                    $res = $result->fetch_all(MYSQLI_ASSOC);
                    mysqli_close($db);
                    ?>

                    <?php if ($res) { ?>
                        <div class="row">
                            <?php foreach ($res as $row) { ?>
                                <div class="col-xl-3 col-md-4">
                                    <div class="card">
                                        <div class="card-body" data-toggle="modal" data-target="#exampleModal<?php echo $row['no_invoice']; ?>">
                                            <div class="d-flex position-relative">
                                                <div>
                                                    <h2 class="mb-2"><span class="counter-value" data-target="<?php echo $row['point']; ?>"><?php echo $row['point']; ?></span><small class="text-muted fs-13"></small></h2>
                                                    <p><?php echo $row['date_create'] . ' ' . $row['time_create'] ?></p>
                                                    <h6 class="text-muted mb-0"><?php echo $row['no_invoice']; ?></h6>
                                                </div>
                                            </div>
                                            
                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModal<?php echo $row['no_invoice']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header text-white" style="background-color: #2b4059; text-align: center;">
                                                            <h5 class="modal-title" id="exampleModalLabel">Detail Invoice  <?php echo $row['no_invoice']; ?></h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true" class="text-white">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body" style="max-height: 650px; overflow-y: auto;">
                                                            <?php
                                                             include 'mobile/connection.php';
                                                            $modal_query = "SELECT a.no_invoice, a.sku_product as SKU, b.barcode, b.productname, 
                                                                    CASE WHEN b.color = '' AND b.nic = '' THEN ''
                                                                            WHEN b.color = '' THEN CONCAT('Nic : ', b.nic)
                                                                            WHEN b.nic   = '' THEN CONCAT('Color : ', b.color)
                                                                    END AS flag, 
                                                                    a.quantity as qty, format(a.price, 0) as harga, 
                                                                    CASE WHEN a.flag_disc = 'Percent' THEN CONCAT(a.discount, '%')
                                                                            WHEN a.flag_disc = 'Amount' THEN format(a.discount, 0)
                                                                            ELSE ''
                                                                    END AS disc, 
                                                                    CASE WHEN flag_disc = 'Percent' THEN format((IFNULL(a.price, 0) - ((IFNULL(a.price, 0) * a.discount) / 100)) * a.quantity, 0)
                                                                            WHEN flag_disc = 'Amount' THEN format((IFNULL(a.price, 0) - a.discount) * a.quantity, 0)
                                                                            ELSE format(IFNULL(a.price, 0), 0) * a.quantity
                                                                    END AS net 
                                                                    FROM invoice_detail a 
                                                                    LEFT JOIN htwarehouse.masterproduct b ON a.sku_product = b.sku
                                                                    WHERE no_invoice = '{$row['no_invoice']}'";

                                                            $modal_result = $db->query($modal_query);
                                                            $modal_data = $modal_result->fetch_all(MYSQLI_ASSOC);

                                                            if ($modal_data) {
                                                                foreach ($modal_data as $modal_row) {
                                                            ?>
                                                                    <div class="card mb-3">
                                                                        <div class="card-body">
                                                                        <h5 class="card-title"><?php echo $modal_row['productname']; ?></h5>
                                                                            <div class="row">
                                                                                <div class="col-6">
                                                                                    <p class="card-text"><strong>Quantity:</strong> <?php echo $modal_row['qty']; ?></p>
                                                                                    <p class="card-text"><strong> <?php echo $modal_row['flag']; ?></strong></p>
                                                                                    <p class="card-text"><strong>Discount:</strong> <?php echo $modal_row['disc']; ?></p>

                                                                             
                                                                                </div>
                                                                                <div class="col-6">
                                                                                    <p class="card-text"><strong>Harga:</strong> <?php echo $modal_row['harga']; ?></p>
                                                                                    <p class="card-text"><strong>Total:</strong> <?php echo $modal_row['net']; ?></p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                            <?php
                                                                }
                                                            } else {
                                                                echo "<p>No data available for this invoice.</p>";
                                                            }
                                                            ?>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    <?php } else { ?>
                        <div class="row">
                            <div class="noresult mb-0 p-5">
                                <div class="text-center">
                                    <img src="assets/images/profile.png" alt="" class="img-fluid rounded" style="width:270px;height:210px" />
                                    <h5 class="mt-2">Poin Anda</h5>
                                    <p class="text-muted mb-0">Anda belum memiliki poin</p>
                                    <p></p>
                                    <div class="flex-grow-1 mb-0">
                                        <a href="index.php" class="btn btn-primary btn-label waves-effect waves-light">
                                            <i class="ri-home-4-fill label-icon align-middle fs-16 me-2"></i> Beranda</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap CSS and JavaScript -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <?php include 'layouts/vendor-scripts.php'; ?>
    <script src="assets/js/app.js"></script>
    <script src="assets/libs/sweetalert2/sweetalert2.min.js"></script>
</body>

</html>
