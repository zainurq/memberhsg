<?php
include 'layouts/main.php';
include 'layouts/config.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <?php includeFileWithVariables('layouts/title-meta.php', array('title' => 'Informasi Pengguna Tidak Lengkap')); ?>
    <?php include 'layouts/head-css.php'; ?>

    <!-- Tambahkan link CSS untuk Bootstrap modal -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            color: #495057;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
        }

        .info-box {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .btn-back {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn-back:hover {
            background-color: #0056b3;
        }

        h2 {
            color: #007bff;
        }

        p {
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div id="layout-wrapper">
        <?php include 'layouts/menu.php'; ?>
        <div class="main-content">
            <div class="page-content">
                <div class="container">
                    <div class="info-box">
                        <h2>Informasi Pengguna Tidak Lengkap</h2>
                        <p>Data pengguna Anda belum lengkap. Silakan lengkapi data di <a href="profile.php">profil Anda</a> sebelum melakukan transaksi.</p>

                        <form action="profile.php">
                            <button type="submit" class="btn btn-back">Kembali ke Profil</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tambahkan script JS untuk Bootstrap -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <?php include 'layouts/vendor-scripts.php'; ?>
    <script src="assets/js/app.js"></script>
    <script src="assets/libs/sweetalert2/sweetalert2.min.js"></script>
</body>

</html>
