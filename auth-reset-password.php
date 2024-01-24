<?php
include "layouts/config.php";
include 'layouts/main.php';
require 'vendor/autoload.php';

$msg = '';
$reset_code = $_GET['kode'] ?? ''; // Ambil kode dari parameter URL

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari formulir
    $new_password = $_POST['new_password'];
    $confirm_new_password = $_POST['confirm_new_password'];

    // Periksa panjang password baru
    if (strlen($new_password) < 6) {
        $msg = "Password harus minimal 6 karakter.";
    } elseif ($new_password !== $confirm_new_password) {
        $msg = "Password baru dan konfirmasi password tidak sesuai.";
    } else {
        // Periksa apakah token reset password valid
        $check_query = "SELECT * FROM forgotpassword WHERE kode = '$reset_code' AND status = 'ready'";
        $check_result = mysqli_query($link, $check_query);

        if (!$check_result) {
            die('Error in query: ' . mysqli_error($link));
        }

        if (mysqli_num_rows($check_result) == 0) {
            $msg = "Token reset password tidak valid atau sudah digunakan.";
        } else {
            // Ambil memberid dan email berdasarkan token
            $row = mysqli_fetch_assoc($check_result);
            $memberid = $row['memberid'];
            $email = $row['email'];

            // Hash password baru
            $hashed_password = md5($new_password);

            // Update password di tabel member_hsg
            $update_password_query = "UPDATE member_hsg SET password = '$hashed_password' WHERE memberid = '$memberid'";
            mysqli_query($link, $update_password_query);

            // Ubah status token/reset code menjadi 'used'
            $update_status_query = "UPDATE forgotpassword SET status = 'used' WHERE kode = '$reset_code'";
            mysqli_query($link, $update_status_query);

            $msg = "Password berhasil direset. Silakan login dengan password baru Anda.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php includeFileWithVariables('layouts/title-meta.php', array('title' => 'Reset Password')); ?>
    <?php include 'layouts/head-css.php'; ?>
</head>

<body>
    <div class="auth-page-wrapper pt-5">
        <!-- auth page bg -->
        <div class="auth-one-bg-position auth-one-bg" id="auth-particles">
            <div class="shape">
                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 1440 120">
                    <path d="M 0,36 C 144,53.6 432,123.2 720,124 C 1008,124.8 1296,56.8 1440,40L1440 140L0 140z"></path>
                </svg>
            </div>
        </div>

        <!-- auth page content -->
        <div class="auth-page-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center mt-sm-5 mb-4 text-white-50">
                            <div>
                                <a href="index.php" class="d-inline-block auth-logo">
                                    <img src="assets/images/memberhsg.png" alt="" height="130">
                                </a>
                            </div>
                            <p class="mt-3 fs-15 fw-medium"></p>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card mt-4">
                            <div class="card-body p-4">
                                <div class="text-center mt-2">
                                    <h5 class="text-primary">Reset Password</h5>
                                </div>

                                <div class="alert border-0 alert-warning text-center mb-2 mx-2" role="alert">
                                    Enter your new password.
                                </div>

                                <div class="p-2">
                                    <?php if (isset($msg)) { ?>
                                        <div class="alert alert-danger text-center mb-4 mt-4 pt-2" role="alert">
                                            <?php echo $msg; ?>
                                        </div>
                                    <?php } ?>

                                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?kode=$reset_code"); ?>" method="post">
                                        <div class="mb-4">
                                            <label class="form-label">New Password</label>
                                            <input type="password" class="form-control" name="new_password" id="new_password" placeholder="Enter New Password">
                                            <span class="text-danger"></span>
                                        </div>

                                        <div class="mb-4">
                                            <label class="form-label">Confirm New Password</label>
                                            <input type="password" class="form-control" name="confirm_new_password" id="confirm_new_password" placeholder="Confirm New Password">
                                            <span class="text-danger"></span>
                                        </div>

                                        <div class="text-center mt-4">
                                            <button class="btn btn-success w-100" type="submit">Reset Password</button>
                                        </div>
                                    </form><!-- end form -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php include 'layouts/vendor-scripts.php'; ?>
    </body>
</html>
