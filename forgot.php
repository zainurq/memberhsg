<?php
include "layouts/config.php";
include 'layouts/main.php';
require 'vendor/autoload.php';

$msg = '';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['useremail'];

    // Periksa apakah email terdaftar
    $check_query = "SELECT * FROM member_hsg WHERE email = '$email'";
    $check_result = mysqli_query($link, $check_query);

    if (!$check_result) {
        die('Error in query: ' . mysqli_error($link));
    }

    if (mysqli_num_rows($check_result) == 0) {
        $msg = "Email tidak terdaftar.";
    } else {
        // Generate kode reset password
        $reset_code = generateRandomCode();

        // Simpan kode reset password ke database
        $member_data = mysqli_fetch_assoc($check_result);
        $member_id = $member_data['memberid'];

        $update_query = "INSERT INTO forgotpassword (memberid, email, kode, status, datecreate) 
                        VALUES ('$member_id', '$email', '$reset_code', 'ready', NOW()) 
                        ON DUPLICATE KEY UPDATE kode = VALUES(kode), status = 'ready', datecreate = NOW()";
        mysqli_query($link, $update_query);

        // Kirim email reset password
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = "mail.vapehan.com";
            $mail->SMTPAuth = true;
            $mail->Username = "sales@vapehan.com";
            $mail->Password = "HSGHelihan77";
            $mail->Port = 587;
            $mail->SMTPSecure = "SSL";

            $mail->isHTML(true);
            $mail->setFrom("sales@vapehan.com", "no-reply");
            $mail->addAddress($email);
            $mail->Subject = "Reset Password";
            $mail->Body = "Hi, {$member_data['firstname']}. Click here to reset your password: http://localhost/memberhsg/auth-reset-password.php?email=$email&token=$reset_code&kode=$reset_code";
            $mail->send();
            $msg = "Email reset password berhasil dikirim.";
        } catch (Exception $e) {
            $msg = "Gagal mengirim email reset password. Error: {$mail->ErrorInfo}";
        }
    }
}

function generateRandomCode() {
    return sprintf("%04d", mt_rand(1, 9999));
}
?>


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
                                    <h5 class="text-primary">Forgot Password?</h5>

                                    <lord-icon src="https://cdn.lordicon.com/rhvddzym.json" trigger="loop" colors="primary:#0ab39c" class="avatar-xl">
                                    </lord-icon>

                                </div>

                                <div class="alert border-0 alert-warning text-center mb-2 mx-2" role="alert">
                                    Enter your email and instructions will be sent to you!
                                </div>
                                <div class="p-2">
                                <?php if (isset($msg)) { ?>
                                    <div class="alert alert-success text-center mb-4 mt-4 pt-2" role="alert">
                                        <?php echo $msg; ?>
                                    </div>
                                <?php } ?>
                                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                        <div class="mb-4">
                                            <label class="form-label">Email</label>
                                            <input type="email" class="form-control" name="useremail" id="email" placeholder="Enter Email">
                                            <span class="text-danger"></span>
                                        </div>

                                        <div class="text-center mt-4">
                                            <button class="btn btn-success w-100" type="submit">Send Reset Link</button>
                                        </div>
                                    </form><!-- end form -->
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->
                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end auth page content -->

        
        <!-- end Footer -->
    </div>
    <!-- end auth-page-wrapper -->

    <?php include 'layouts/vendor-scripts.php'; ?>

    <!-- particles js -->
    <script src="assets/libs/particles.js/particles.js"></script>

    <!-- particles app js -->
    <script src="assets/js/pages/particles.app.js"></script>
</body>

</html>
