<?php
error_reporting(E_ALL & ~E_NOTICE);

include 'layouts/main.php';
include 'layouts/config.php';

session_start();
if (!isset($_SESSION['kd_member'])) {
    header("Location: login.php");
    exit();
}

// Dapatkan kd_member dari session jika sudah login
$kd_member = isset($_SESSION['kd_member']) ? $_SESSION['kd_member'] : '';

$type = isset($_GET['type']) ? $_GET['type'] : '';
$fdate = $_GET['fdate'];
$tdate = $_GET['tdate'];
$flag = isset($_GET['flag']) ? $_GET['flag'] : '';
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <?php includeFileWithVariables('layouts/title-meta.php', array('title' => 'Poin Digunakan')); ?>
    <?php include 'layouts/head-css.php'; ?>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>

<body>
    <div id="layout-wrapper">
        <?php include 'layouts/menu.php'; ?>
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <?php
                    includeFileWithVariables('layouts/page-title.php', array('pagetitle' => 'HSGMember', 'title' => 'Point Digunakan'));

                    if (!empty($kd_member)) {
                        $query = "SELECT kd_member, invoice as no_invoice, 
                                ifnull((select itemname from development.poin_item_gift where sku = x.invoice limit 1), '') as itemgift, ifnull(point, 0) as point,
                                date_create, time_create, flag, ifnull(noresi, '') as noresi, 
                                ifnull((select courierid from indoongkir.courier where devid = x.delivery limit 1), '') as courierid,
                                concat('http://103.106.79.238:81/hsgmember/images/giftpoin/', invoice, '.jpg') as urlimage
                                from point_member x 
                                where kd_member = '$kd_member' and flag = 'used' and point not in (0)
                                order by concat(date_create, time_create) desc";

                        $result = $link->query($query);
                        $res = $result->fetch_all(MYSQLI_ASSOC);
                        mysqli_close($link);
                    } else {
                        $res = null;
                    }
                    ?>

                    <?php if ($res) { ?>
                        <div class="row">
                            <?php foreach ($res as $row) { ?>
                                <div class="col-xl-3 col-md-4">
                                    <div class="card">
                                        <div class="card-body" data-toggle="modal" data-target="#myModal<?php echo $row['no_invoice']; ?>">
                                            <h2 class="mb-2"><span class="counter-value" data-target="<?php echo $row['point']; ?>"><?php echo $row['point']; ?></span><small class="text-muted fs-13"></small></h2>
                                            <p><?php echo $row['date_create'] . ' ' . $row['time_create'] ?></p>
                                            <h6 class="text-muted mb-0"><?php echo $row['no_invoice']; ?></h6>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal -->
                                <div class="modal fade" id="myModal<?php echo $row['no_invoice']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header text-white" style="background-color: #2b4059; text-align: center;">
                                                <h5 class="modal-title" id="exampleModalLabel">  <?php echo $row['no_invoice']; ?></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true" class="text-white">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body" style="max-height: 650px; overflow-y: auto;">
                                                <div class="card mb-3">
                                                    <div class="card-body">
                                                        <p><strong>Item Gift:</strong> <?php echo $row['itemgift']; ?></p>
                                                        <p><strong>Poin:</strong> <?php echo $row['point']; ?></p>
                                                        <p><strong>Tanggal:</strong> <?php echo $row['date_create'] . ' ' . $row['time_create']; ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
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

    <!-- Bootstrap and other scripts here -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <?php include 'layouts/vendor-scripts.php'; ?>
    <script src="assets/js/app.js"></script>
    <script src="assets/libs/sweetalert2/sweetalert2.min.js"></script>
</body>
</html>
