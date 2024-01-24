<?php
// Include file-session.php, main.php, dan config.php
error_reporting(E_ALL & ~E_NOTICE);

include 'layouts/main.php';
include 'layouts/config.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    includeFileWithVariables('layouts/title-meta.php', array('title' => 'Profile Settings'));
    include 'layouts/head-css.php';
    ?>

    <link href="assets/css/listtop.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body>
    <?php include 'layouts/menu.php'; ?>

    <div id="layout-wrapper">
        <div class="main-content">
            <div class="container mt-5">
                <div class="card">
                    <div class="card-body p-4">
                        <div class="tab-content">
                            <h1 class="text-center">Syarat dan Ketentuan - HSG Member</h1>

                            <h2>1. Pendaftaran</h2>
                            <p>1.1 Syarat pertama pendaftaran.</p>
                            <p>1.2 Syarat kedua pendaftaran.</p>

                            <h2>2. Keanggotaan</h2>
                            <p>2.1 Syarat pertama keanggotaan.</p>
                            <p>2.2 Syarat kedua keanggotaan.</p>

                            <h2>3. Penggunaan Akun</h2>
                            <p>3.1 Syarat pertama penggunaan akun.</p>
                            <p>3.2 Syarat kedua penggunaan akun.</p>

                            <h2>Terima Kasih</h2>
                            <p>Terima kasih atas partisipasi Anda dalam HSG Member.</p>
                        </div>
                    </div>
                </div>
            </div>
            <?php include 'layouts/footer.php'; ?>
        </div>
    </div>

    <?php include 'layouts/vendor-scripts.php'; ?>

    <script src="assets/js/pages/profile-setting.init.js"></script>
    <script src="assets/js/app.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/davidshimjs/qrcodejs/qrcode.min.js"></script>
    <!-- Add this script to the end of your HTML body or include it in your existing script -->
</body>

</html>
