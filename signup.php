<?php
include 'layouts/main.php';
include 'layouts/config.php';

// Inisialisasi variabel pesan error
$error_message = "";

// Tambahkan query untuk mendapatkan nilai member_id terakhir
$getLastMemberIdQuery = "SELECT MAX(memberid) AS last_member_id FROM development.member_hsg";
$result = mysqli_query($link, $getLastMemberIdQuery);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $lastMemberId = isset($row['last_member_id']) ? $row['last_member_id'] : 'HSG.23.000000';
    $lastMemberIdNumber = intval(substr($lastMemberId, 8));

    // Periksa apakah ada nomor yang dihapus
    // Jika ya, gunakan nomor yang seharusnya digunakan sebagai dasar
    $baseMemberIdNumber = max($lastMemberIdNumber + 1, 1);

    // Format ulang memberid
    $newMemberIdFormatted = 'HSG.23.' . str_pad($baseMemberIdNumber, 6, '0', STR_PAD_LEFT);
} else {
    // Handle error when querying last member_id
    $error_message = "Error getting last member_id";
}

// Periksa apakah formulir sudah dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data pengguna dari formulir
    $phonenumb = $_POST['phonenumb'];
    $email = $_POST['email'];
    $password = md5($_POST['password']); // Gunakan MD5 untuk hashing password (tidak disarankan)

    // Lakukan validasi jika diperlukan

    // Query SQL untuk menyisipkan data pengguna ke dalam database
    $query = "INSERT INTO development.member_hsg(reqid, phonenumber, email, password, login, setpassword, notif, memberid, flag)
          VALUES (null, '".$phonenumb."', '".$email."', '".$password."',  1, 0, 0, '".$newMemberIdFormatted."', 1)";

    // Jalankan query
    if (mysqli_query($link, $query)) {
        // Registrasi berhasil
        header("Location: login.php"); // Redirect ke halaman sukses
        exit();
    } else {
        // Registrasi gagal
        $error_message = "Registrasi gagal. Silakan coba lagi. Pesan kesalahan: " . mysqli_error($link);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php includeFileWithVariables('layouts/title-meta.php', array('title' => 'Redeem')); ?>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php include 'layouts/title-meta.php';?>
    <?php include 'layouts/head-css.php'; ?>
    <style>
         body {
            overflow: hidden;
        }


        .card {
            max-width: 500px; /* Sesuaikan lebar maksimum sesuai kebutuhan Anda */
            margin: 0 auto; /* Menengahkan kartu di tengah halaman */
        }

        .card-body {
            overflow-y: auto;
            padding: 0px;
        }

        .auth-page-content {
            font-size: 14px;
        }

        .form-label {
            margin-bottom: 0.5rem;
            text-align: center; /* Teks title menjadi center */
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

        .input-group-append .btn {
            border: none;
        }
    </style>
        
    </style>
</head>

<body>
<div id="layout-wrapper">
    <?php include 'layouts/topbar.php'?>
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="auth-page-wrapper">
                    <div class="auth-page-content">
                        <div class="container">
                            <div class="card">
                                <div class="card-header mt-4 text-center">
                                    <div class="mb-3">
                                        <div class="col-12">
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

                                        <form class="needs-validation" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                                                <div class="col-12 mb-4">
                                                    <label for="phone_number" class="form-label">Nomor Handphone <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="phonenumb" id="phone_number" placeholder="Masukkan nomor handphone" required>
                                                    <div class="invalid-feedback">
                                                        Silakan masukkan nomor handphone
                                                    </div>
                                                </div>

                                                <div class="col-12 mb-4">
                                                    <label for="useremail" class="form-label">Email <span class="text-danger">*</span></label>
                                                    <input type="email" class="form-control" name="email" id="useremail" placeholder="Masukkan alamat email" required>
                                                    <div class="invalid-feedback">
                                                        Silakan masukkan alamat email
                                                    </div>
                                                </div>

                                                <div class="col-12 mb-3">
                                                    <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                                                    <div class="input-group">
                                                        <input type="password" class="form-control" name="password" id="password" placeholder="Masukkan password" required>
                                                        <div class="input-group-append">
                                                            <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                                                <i class="bi bi-eye"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <div class="invalid-feedback">
                                                        Silakan masukkan password
                                                    </div>
                                                </div>


                                            <div class="mb-4">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="auth-remember-check" required>
                                                    <label class="form-check-label mb-0 fs-12 text-muted fst-italic" for="auth-remember-check">
                                                        Saya setuju dengan ketentuan ini
                                                        <a href="snk.php"
                                                            class="text-primary text-decoration-underline fst-normal fw-medium">Ketentuan</a>
                                                    </label>
                                                </div>
                                            </div>

                                            <div id="password-contain" class="p-3 bg-light mb-2 rounded">
                                                <h5 class="fs-13">Password harus mengandung:</h5>
                                                <p id="pass-length" class="invalid fs-12 mb-2">Minimum <b>8 karakter</b></p>
                                                <p id="pass-lower" class="invalid fs-12 mb-2">Setidaknya <b>huruf kecil</b> (a-z)</p>
                                                <p id="pass-upper" class="invalid fs-12 mb-2">Setidaknya <b>huruf besar</b> (A-Z)</p>
                                                <p id="pass-number" class="invalid fs-12 mb-0">Setidaknya <b>angka</b> (0-9)</p>
                                            </div>

                                            <button class="btn btn-success w-100" type="submit" style="margin-bottom: 10px;">Daftar</button>

                                            <div class="login" style="font-size: 12px;">
                                                <div class="form-check">
                                                    <label class="form-check-label text-muted">
                                                        Sudah Memiliki akun? 
                                                        <a href="login.php"
                                                            class="text-primary text-decoration-underline fst-normal fw-medium">Masuk</a>
                                                    </label>
                                                </div>
                                            </div>

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

<?php include 'layouts/vendor-scripts.php'; ?>

<!-- particles js -->
<script src="assets/libs/particles.js/particles.js"></script>
<!-- particles app js -->
<script src="assets/js/pages/particles.app.js"></script>
<!-- validation init -->
<script src="assets/js/pages/form-validation.init.js"></script>
<!-- password create init -->
<script src="assets/js/pages/passowrd-create.init.js"></script>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>


<script>
        document.getElementById('togglePassword').addEventListener('click', function () {
            var passwordInput = document.getElementById('password');
            var type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);

            // Ganti ikon mata sesuai dengan status password
            this.innerHTML = type === 'password' ? '<i class="bi bi-eye"></i>' : '<i class="bi bi-eye-slash"></i>';
        });
    </script>
</body>

</html>
