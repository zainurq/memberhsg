<?php
// Include file-session.php, main.php, dan config.php
error_reporting(E_ALL & ~E_NOTICE);

include 'layouts/session.php';
include 'layouts/main.php';
include 'layouts/config.php';

if ($login == 'true' && $_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['oldpassword']) && !empty($_POST['newpassword'])) {
        // Verifikasi old password
        $checkQuery = "SELECT * FROM member_hsg WHERE email = ? AND password = MD5(?)";
        $checkStmt = mysqli_prepare($link, $checkQuery);
        mysqli_stmt_bind_param($checkStmt, 'ss', $_SESSION['email'], $_POST['oldpassword']);
        mysqli_stmt_execute($checkStmt);
        $checkResult = mysqli_stmt_get_result($checkStmt);

        if ($checkResult && mysqli_num_rows($checkResult) > 0) {
            // Update password
            $updatePasswordQuery = "UPDATE member_hsg SET password = MD5(?) WHERE email = ?";
            $updatePasswordStmt = mysqli_prepare($link, $updatePasswordQuery);
            mysqli_stmt_bind_param($updatePasswordStmt, 'ss', $_POST['newpassword'], $_SESSION['email']);
            mysqli_stmt_execute($updatePasswordStmt);
        } else {
            // Password lama tidak cocok
            echo json_encode(array('success' => false, 'message' => 'Old password does not match.'));
            exit;
        }
    } else {
        // Jika oldpassword dan newpassword kosong, berarti user ingin memperbarui informasi pengguna
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $phonenumber = $_POST['phonenumber'];
        $province = $_POST['province'];
        $kecamatan = $_POST['kecamatan'];
        $kelurahan = $_POST['kelurahan'];
        $zipcode = $_POST['zipcode'];
        $address = $_POST['address'];

        // Contoh query UPDATE
        $query = "UPDATE member_hsg SET
                  firstname = ?, lastname = ?, phonenumber = ?, province = ?,
                  kecamatan = ?, kelurahan = ?, zipcode = ?, address = ?
                  WHERE email = ?";
        $stmt = mysqli_prepare($link, $query);
        mysqli_stmt_bind_param($stmt, 'sssssssss', $firstname, $lastname, $phonenumber, $province, $kecamatan, $kelurahan, $zipcode, $address, $_SESSION['email']);
        mysqli_stmt_execute($stmt);
    }

    // Redirect ke halaman profile setelah update
    header('Location: profile.php');
    exit;
}

// Mengambil data pengguna dari database berdasarkan email yang disimpan di sesi
if ($login == 'true') {
    $query = "SELECT member_hsg.*, IFNULL(SUM(CASE
                WHEN point_member.flag = 'get' THEN point_member.point
                WHEN point_member.flag = 'used' THEN -point_member.point
                ELSE 0
            END), 0) AS total_poin FROM member_hsg
        LEFT JOIN
        point_member ON member_hsg.memberid = point_member.kd_member
        WHERE member_hsg.email = ? LIMIT 1";

    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, 's', $_SESSION['email']);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_array($result)) {
        $memberid = $row['memberid'];
        $firstname = $row['firstname'];
        $lastname = $row['lastname'];
        $email = $row['email'];
        $phonenumber = $row['phonenumber'];
        $image = $row['imageprofile'];
        $province = $row['province'];
        $kecamatan = $row['kecamatan'];
        $kelurahan = $row['kelurahan'];
        $zipcode = $row['zipcode'];
        $address = $row['address'];
        $poin = $row['total_poin'];
    }
} else {
    // Pengguna belum login, tampilkan pesan atau redirect ke halaman login jika perlu
    header('Location: login.php');
    exit;
}
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

    <style>
        @media (max-width: 767px) {
            .map-container {
                width: 100%;
                padding-bottom: 75%;
                position: relative;
            }

            .map-container iframe {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
            }

            form {
                margin-top: 20px; /* Sesuaikan dengan kebutuhan Anda */
                margin-bottom: 20px; /* Sesuaikan dengan kebutuhan Anda */
            }

            .col-lg-4 {
                margin-bottom: 15px; /* Sesuaikan dengan kebutuhan Anda */
            }

            .col-lg-12 {
                margin-top: 20px; /* Sesuaikan dengan kebutuhan Anda */
            }
        }
        

        #barcodeContainer {
        display: none;
        margin: auto;
        text-align: center;
    }

    .toggle-barcode-container {
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    </style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

</head>

<body>
    <?php include 'layouts/menu.php'; ?>

    <div id="layout-wrapper">
        <div class="white-bg">
        </div>
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    

                    <?php
                    if ($login == 'true') {
                        $query = "SELECT member_hsg.*, IFNULL(SUM(CASE
                                    WHEN point_member.flag = 'get' THEN point_member.point
                                    WHEN point_member.flag = 'used' THEN -point_member.point
                                    ELSE 0
                                END), 0) AS total_poin FROM member_hsg
                            LEFT JOIN
                            point_member ON member_hsg.memberid = point_member.kd_member
                            WHERE member_hsg.memberid = ? LIMIT 1";

                        $stmt = mysqli_prepare($link, $query);
                        mysqli_stmt_bind_param($stmt, 's', $_SESSION['kd_member']);
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);

                        if ($row = mysqli_fetch_array($result)) {
                            $memberid = $row['memberid'];
                            $firstname = $row['firstname'];
                            $lastname = $row['lastname'];
                            $email = $row['email'];
                            $phonenumber = $row['phonenumber'];
                            $image = $row['imageprofile'];
                            $province = $row['province'];
                            $kecamatan = $row['kecamatan'];
                            $kelurahan = $row['kelurahan'];
                            $zipcode = $row['zipcode'];
                            $address = $row['address'];
                            $poin = $row['total_poin'];
                        }
                    ?>
                        <div class="row">
                            <div class="col-xl-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="text-center">
                                            <div class="profile-user position-relative d-inline-block mx-auto  mb-4">
                                                <img src="assets/images/noimage.jpg" class="rounded-circle avatar-xl img-thumbnail user-profile-image  shadow" alt="user-profile-image">
                                                <div class="avatar-xs p-0 rounded-circle profile-photo-edit">
                                                    <input id="profile-img-file-input" type="file" class="profile-img-file-input">
                                                    
                                                </div>
                                            </div>
                                            <p class="text-muted mb-2"><?php echo $memberid; ?></p>
                                            <p class="text-muted mb-0">Total Point</p>
                                            <p class="text-muted mb-0"><?php echo $poin; ?></p>
                                                <!-- Toggle Button -->
                                            <div class="toggle-barcode-container">
                                                <button class="btn btn-primary mt-2" onclick="toggleBarcode()">Show Barcode</button>
                                                
                                                <!-- Barcode Container -->
                                                <div id="barcodeContainer" class="mt-2"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end card-->
                            <div class="col-xxl-9">
                            <div class="card">
                                <div class="card-header">
                                    <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-bs-toggle="tab" href="#personalDetails" role="tab">
                                                <i class="fas fa-home"></i> Personal Details
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#changePassword" role="tab">
                                                <i class="far fa-user"></i> Change Password
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#help" role="tab">
                                                <i class="far fa-question-circle"></i> Help
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#deleteAccount" role="tab">
                                                <i class="fas fa-delete"></i> Delete Account
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="card-body p-4">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="personalDetails" role="tabpanel">
                                            <form action="" method="POST">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="firstnameInput" class="form-label">Nama Depan</label>
                                                            <input type="text" class="form-control" id="firstnameInput" name="firstname" placeholder="Enter your firstname" value="<?php echo $firstname; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="lastnameInput" class="form-label">Nama Belakang</label>
                                                            <input type="text" class="form-control" id="lastnameInput" name="lastname" placeholder="Enter your lastname" value="<?php echo $lastname; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="phonenumberInput" class="form-label">No Telepon</label>
                                                            <input type="text" class="form-control" id="phonenumberInput" name="phonenumber" placeholder="Enter your phone number" value="<?php echo $phonenumber; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="emailInput" class="form-label">Email</label>
                                                            <input type="email" class="form-control" id="emailInput" name="email" placeholder="Enter your email" value="<?php echo $email; ?>" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <div class="mb-3">
                                                            <label for="provinceInput" class="form-label">Provinsi</label>
                                                            <input type="text" class="form-control" id="provinceInput" name="province" placeholder="province" value="<?php echo $province; ?>" />
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <div class="mb-3">
                                                            <label for="kecamatanInput" class="form-label">Kecamatan</label>
                                                            <input type="text" class="form-control" id="kecamatanInput" name="kecamatan" placeholder="District" value="<?php echo $kecamatan; ?>" />
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <div class="mb-3">
                                                            <label for="kelurahanInput" class="form-label">Kelurahan</label>
                                                            <input type="text" class="form-control" id="subdistric" name="kelurahan" placeholder="Enter subdistric" value="<?php echo $kelurahan; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <div class="mb-3">
                                                            <label for="KodeposInput" class="form-label">kodepos</label>
                                                            <input type="text" class="form-control" id="zipcodeInput" name="zipcode" placeholder="Enter zipcode" value="<?php echo $zipcode; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="mb-3 pb-2">
                                                            <label for="exampleFormControlTextarea" class="form-label">Alamat</label>
                                                            <textarea class="form-control" id="exampleFormControlTextarea" name="address" placeholder="Enter your description" rows="3"><?php echo $address; ?></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="hstack gap-2 justify-content-end">
                                                            <button type="submit" class="btn btn-primary">Update</button>
                                                            <button type="button" class="btn btn-soft-success">Cancel</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="tab-pane" id="changePassword" role="tabpanel">
                                        <form action="" method="POST">
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <div>
                                                        <label for="oldpasswordInput" class="form-label">Old Password*</label>
                                                        <input type="password" class="form-control" id="oldpasswordInput" name="oldpassword" placeholder="Enter current password" required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div>
                                                        <label for="newpasswordInput" class="form-label">New Password*</label>
                                                        <div class="input-group">
                                                            <input type="password" class="form-control" id="newpasswordInput" name="newpassword" placeholder="Enter new password" required>
                                                            <button type="button" class="btn btn-outline-secondary" id="toggleNewPassword">
                                                                <i class="fas fa-eye"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div>
                                                        <label for="confirmpasswordInput" class="form-label">Confirm Password*</label>
                                                        <div class="input-group">
                                                            <input type="password" class="form-control" id="confirmpasswordInput" placeholder="Confirm password" required>
                                                            <button type="button" class="btn btn-outline-secondary" id="toggleConfirmPassword">
                                                                <i class="fas fa-eye"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="text-end">
                                                        <button type="submit" class="btn btn-primary">Update</button>
                                                        <button type="button" class="btn btn-soft-success">Cancel</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        </div>
                                        <div class="tab-pane" id="help" role="tabpanel">
                                            <h4>Contact Information</h4>
                                            <?php include 'help.php' ?>
                                        </div>

                                        <div class="tab-pane" id="deleteAccount" role="tabpanel">
                                            <div class="text-center mt-4">
                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal">
                                                    Delete Account
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } else { ?>
                        <div class="row">
                            <div class="noresult mb-0 p-5">
                                <div class="text-center">
                                    <img src="assets/images/profile.png" alt="" class="img-fluid rounded" style="width:270px;height:210px" />
                                    <h5 class="mt-2">Sorry! Anda belum login</h5>
                                    <p class="text-muted mb-0">Silahkan login terlebih dahulu, untuk edit data profile anda</p>
                                    <p></p>
                                    <div class="flex-grow-1 mb-0">
                                        <a href="login.php" class="btn btn-primary btn-label waves-effect waves-light">
                                            <i class="ri-lock-2-fill label-icon align-middle fs-16 me-2"></i> LogIn</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <?php include 'layouts/footer.php'; ?>
        </div>
    </div>

    <!-- Add this code where you want to place your modal, for example, at the end of your body tag -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Confirm Deletion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete your account? This action cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" onclick="deleteAccount()">Delete Account</button>
            </div>
        </div>
    </div>
</div>


    <?php include 'layouts/vendor-scripts.php'; ?>

    <script src="assets/js/pages/profile-setting.init.js"></script>
    <script src="assets/js/app.js"></script>

    
    <script src="https://cdn.jsdelivr.net/gh/davidshimjs/qrcodejs/qrcode.min.js"></script>
    <!-- Add this script to the end of your HTML body or include it in your existing script -->
    <script>
        function generateBarcode() {
            var barcodeContainer = document.getElementById('barcodeContainer');
            barcodeContainer.innerHTML = ''; // Bersihkan kontainer sebelum menambahkan barcode baru

            // Ganti JsBarcode dengan fungsi dari pustaka QR Code Generator
            var memberid = '<?php echo $memberid; ?>';
            var qrcode = new QRCode(barcodeContainer, {
                text: memberid,
                width: 128,
                height: 128
            });
        }

        function toggleBarcode() {
        var barcodeContainer = document.getElementById('barcodeContainer');
        if (barcodeContainer.style.display === '' || barcodeContainer.style.display === 'none') {
            generateBarcode();
            barcodeContainer.style.display = 'block';
        } else {
            barcodeContainer.style.display = 'none';
        }
    }

        generateBarcode(); // Inisialisasi barcode saat halaman dimuat
    </script>

<script>
    document.getElementById('toggleNewPassword').addEventListener('click', function () {
        togglePassword('newpasswordInput');
    });

    document.getElementById('toggleConfirmPassword').addEventListener('click', function () {
        togglePassword('confirmpasswordInput');
    });

    function togglePassword(inputId) {
        const input = document.getElementById(inputId);
        const icon = document.getElementById(`toggle${inputId}Icon`);

        if (input.getAttribute('type') === 'password') {
            input.setAttribute('type', 'text');
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        } else {
            input.setAttribute('type', 'password');
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        }
    }
</script>
<script>
    function deleteAccount() {
        var confirmed = confirm('Are you sure you want to delete your account?');
        if (confirmed) {
            // Use AJAX to send a request to the server for account deletion
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'delete_account_ajax.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    // Handle the response from the server if needed
                    // For example, you can redirect the user to the login page
                    window.location.href = 'login.php';
                }
            };
            
            // Assuming you have the memberid or kd_member in a variable called memberid
            var memberid = '<?php echo $memberid; ?>';
            
            // Send the request with the memberid as data
            xhr.send('memberid=' + memberid);
        }
    }
</script>

    </body>
</html>
