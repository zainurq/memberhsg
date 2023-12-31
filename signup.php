<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include 'layouts/main.php';
include 'layouts/config.php';

// Inisialisasi variabel pesan error
$error_message = "";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    $id = '0';
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php includeFileWithVariables('layouts/title-meta.php', array('title' => 'Redeem')); ?>
    <?php include 'layouts/head-css.php'; ?>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php include 'layouts/title-meta.php';?>
    <?php include 'layouts/head-css.php'; ?>
    <style>
        body {
            overflow: hidden;
        }

        .auth-page-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            overflow: hidden;
        }

        .card {
            height: calc(100vh - 70px); /* Menggunakan tinggi otomatis agar sesuai dengan kontennya */
        }

        .card-body {
            overflow-y: auto;
            padding: 0px; /* Menghapus padding agar kontennya dimulai dari kiri */
        }

        .card-header {
            padding: 0; /* Updated padding value */
        }

        .form-label {
            margin-bottom: 0.5rem;
        }

        .form-control {
            border: none;
            border-bottom: 1px solid #ccc;
            border-radius: 0;
            padding: 0.375rem 0.75rem;
        }

        .form-control:focus {
            border-bottom: 2px solid #007bff;
        }

        .fixed-bottom {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            background-color: #fff;
            padding: 15px;
            border-top: 1px solid #ccc;
        }
    </style>
</head>

<body>
<div id="layout-wrapper">
        <?php include 'layouts/menu.php'; ?>
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <div class="auth-page-wrapper pt-3">
                        <div class="auth-page-content">
                            <div class="container">
                                <div class="row justify-content-center">
                                    <div class="card mt-4">
                                        <div class="card-header mt-4">
                                            <div class="row mb-3">
                                                <div class="col-2">
                                                    <a href="login.php" class="btn btn-secondary">
                                                        <i class="mdi-arrow-left-bold"></i>
                                                    </a>
                                                </div>
                                                <div class="col-10">
                                                    <h4 class="card-title mt-2">REGISTER MEMBER </h4>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card-body">
                                            <div class="p-2 mt-4">
                                                <!-- Menampilkan pemberitahuan error jika ada -->
                                                <?php if (!empty($error_message)) : ?>
                                                    <div class="alert alert-danger" role="alert">
                                                        <?php echo $error_message; ?>
                                                    </div>
                                                <?php endif; ?>
                
                                                <form class="needs-validation" action="mobile/insert.php?action=RegisterMemberX" method="post">
                                                    <div class="row">
                                                        <div class="col-md-6 mb-3">
                                                            <label for="first_name" class="form-label">Nama Depan <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" name="firstname" id="first_name" placeholder="Masukkan nama depan" required>
                                                            <div class="invalid-feedback">
                                                                Silakan masukkan nama depan
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label for="last_name" class="form-label">Nama Belakang <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" name="lastname" id="last_name" placeholder="Masukkan nama belakang" required>
                                                            <div class="invalid-feedback">
                                                                Silakan masukkan nama belakang
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="row">
                                                        <div class="col-md-6 mb-3">
                                                            <label for="date_of_birth" class="form-label">Tanggal Lahir <span class="text-danger">*</span></label>
                                                            <input type="date" class="form-control" name="birthdate" id="date_of_birth" required>
                                                            <div class="invalid-feedback">
                                                                Silakan masukkan tanggal lahir
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6 mb-3">
                                                            <label for="place_of_birth" class="form-label">Tempat Lahir <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" name="birthplace" id="place_of_birth" placeholder="Masukkan tempat lahir" required>
                                                            <div class="invalid-feedback">
                                                                Silakan masukkan tempat lahir
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-6 mb-3">
                                                            <label for="ktp_number" class="form-label">Nomor KTP <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" name="idktp" id="ktp_number" placeholder="Masukkan nomor KTP" required>
                                                            <div class="invalid-feedback">
                                                                Silakan masukkan nomor KTP
                                                            </div>
                                                        </div>
                                                            
                                                        <div class="col-md-6 mb-3">
                                                            <label for="phone_number" class="form-label">Nomor Handphone <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" name="phonenumb" id="phone_number" placeholder="Masukkan nomor handphone" required>
                                                            <div class="invalid-feedback">
                                                                Silakan masukkan nomor handphone
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-6 mb-3">
                                                            <label for="useremail" class="form-label">Email <span class="text-danger">*</span></label>
                                                            <input type="email" class="form-control" name="email" id="useremail" placeholder="Masukkan alamat email" required>
                                                            <div class="invalid-feedback">
                                                                Silakan masukkan alamat email
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6 mb-3">
                                                            <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                                                            <input type="password" class="form-control" name="password" id="password" placeholder="Masukkan password" required>
                                                            <div class="invalid-feedback">
                                                                Silakan masukkan password
                                                            </div>
                                                        </div>
                                                    </div>

                                                        <div class="col-md-12 mb-3">
                                                            <label for="home_address" class="form-label">Alamat Rumah <span class="text-danger">*</span></label>
                                                            <textarea class="form-control" name="address" id="home_address" placeholder="Masukkan alamat rumah" required></textarea>
                                                            <div class="invalid-feedback">
                                                                Silakan masukkan alamat rumah
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="row">
                                                        <div class="col-md-6 mb-3">
                                                            <label for="zipcode" class="form-label">Alamat Rumah <span class="text-danger">*</span></label>
                                                            <textarea class="form-control" name="zipcode" id="zipcode" placeholder="Masukkan kodepos" required></textarea>
                                                            <div class="invalid-feedback">
                                                                Silakan masukkan kode pos
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6 mb-3">
                                                            <label for="village" class="form-label">Kelurahan <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" name="kelurahan" id="village" placeholder="Masukkan kelurahan" required>
                                                            <div class="invalid-feedback">
                                                                Silakan masukkan kelurahan
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-6 mb-3">
                                                            <label for="district" class="form-label">Kecamatan <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" name="kecamatan" id="district" placeholder="Masukkan kecamatan" required>
                                                            <div class="invalid-feedback">
                                                                Silakan masukkan kecamatan
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6 mb-3">
                                                            <label for="province" class="form-label">Provinsi <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" name="province" id="province" placeholder="Masukkan provinsi" required>
                                                            <div class="invalid-feedback">
                                                                Silakan masukkan provinsi
                                                            </div>
                                                        </div>
                                                    </div>
                                                

                                                    <div class="mb-4">
                                                        <input class="form-check-input" type="checkbox" value="" id="auth-remember-check" required>
                                                        <label class="mb-0 fs-12 text-muted fst-italic">
                                                            Saya setuju dengan ketentuan ini
                                                            <a href="#" class="text-primary text-decoration-underline fst-normal fw-medium">Ketentuan</a>
                                                        </label>
                                                    </div>

                                                    <div id="password-contain" class="p-3 bg-light mb-2 rounded">
                                                        <h5 class="fs-13">Password harus mengandung:</h5>
                                                        <p id="pass-length" class="invalid fs-12 mb-2">Minimum <b>8 karakter</b></p>
                                                        <p id="pass-lower" class="invalid fs-12 mb-2">Setidaknya <b>huruf kecil</b> (a-z)</p>
                                                        <p id="pass-upper" class="invalid fs-12 mb-2">Setidaknya <b>huruf besar</b> (A-Z)</p>
                                                        <p id="pass-number" class="invalid fs-12 mb-0">Setidaknya <b>angka</b> (0-9)</p>
                                                    </div>

                                                    <button class="btn btn-success w-100" type="submit">Daftar</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>

    <?php include 'layouts/vendor-scripts.php'; ?>

    <!-- particles js -->
    <script src="assets/libs/particles.js/particles.js"></script>
    <!-- particles app js -->
    <script src="assets/js/pages/particles.app.js"></script>
    <!-- validation init -->
    <script src="assets/js/pages/form-validation.init.js"></script>
    <!-- password create init -->
    <script src="assets/js/pages/passowrd-create.init.js"></script>

</body>

</html>
