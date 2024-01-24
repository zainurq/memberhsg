<?php
error_reporting(E_ALL & ~E_NOTICE);

include 'layouts/main.php';
include 'layouts/config.php';

session_start(); // Call session_start() only once

if (!isset($_SESSION['kd_member'])) {
    header("Location: login.php");
    exit();
}

// Dapatkan kd_member dari session jika sudah login
$kd_member = isset($_SESSION['kd_member']) ? $_SESSION['kd_member'] : '';

$type = isset($_GET['type']) ? $_GET['type'] : '';
$fdate = isset($_GET['fdate']) ? $_GET['fdate'] : ''; // Check if 'fdate' is set
$tdate = isset($_GET['tdate']) ? $_GET['tdate'] : ''; // Check if 'tdate' is set
$flag = isset($_GET['flag']) ? $_GET['flag'] : '';
?>


<!DOCTYPE html>
<html lang="id">

<head>
    <?php includeFileWithVariables('layouts/title-meta.php', array('title' => 'Poin Diperoleh')); ?>
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
                    includeFileWithVariables('layouts/page-title.php', array('pagetitle' => 'HSGMember', 'title' => 'Poin Diperoleh'));

                    if (!empty($kd_member)) {
                        // Your SQL query goes here
                        $query = "SELECT * from
                                    (select a.no_invoice, a.invoice_date, a.time_transaction, 
                                    format((select sub_amount from invoice_payment where no_invoice = a.no_invoice limit 1), 0) as amt, ifnull(b.point, 0) as point
                                    from invoice_header a left join (select kd_member, invoice, point from point_member where flag = 'get') b
                                    on a.kd_member = b.kd_member and a.no_invoice = b.invoice
                                    where a.kd_member = '$kd_member')x
                                    order by invoice_date, time_transaction desc";

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
                                        <div class="card-body">
                                            <!-- Display the data from $row here -->
                                            <h2 class="mb-2"><?php echo $row['point']; ?></h2>
                                            <p><?php echo $row['invoice_date'] . ' ' . $row['time_transaction']; ?></p>
                                            <h6 class="text-muted mb-0"><?php echo $row['no_invoice']; ?></h6>
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
                                    <h5 class="mt-2">Poin Diperoleh</h5>
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
