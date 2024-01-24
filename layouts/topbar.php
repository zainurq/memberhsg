<?php include 'layouts/session.php'; ?>
<header id="page-topbar" style="background-color: rgba(197,160,143,255); color: white;">
    <div class="layout-width">
        <div class="navbar-header" style="background-color: rgba(197,160,143,255)">
            <div class="d-flex">
                <!-- LOGO -->
                <div class="navbar-brand-box horizontal-logo">
                    <a href="index.php" class="logo logo-dark">
                        <span class="logo-sm">
                            <img src="assets/images/memberhsg.png" alt="" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="assets/images/hsgmember.png" alt="" height="17">
                        </span>
                    </a>

                    <a href="index.php" class="logo logo-light">
                        <span class="logo-sm">
                            <img src="assets/images/memberhsg.png" alt="" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="assets/images/hsgmember.png" alt="" height="69">
                        </span>
                    </a>
                </div>

                <button type="button" class="btn btn-sm px-3 fs-16 header-item vertical-menu-btn topnav-hamburger" id="topnav-hamburger-icon">
                    <span>
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                    <span class="logo-sm">
                        <img src="assets/images/memberhsg.png" alt="" height="60">
                    </span>
                </button>
            </div>

            <div class="d-flex align-items-center">
            <?php
            if ($login == 'true') {
                $query = "SELECT m.*, IFNULL(SUM(CASE WHEN pm.flag = 'get' THEN pm.point ELSE -pm.point END), 0) AS poin
                          FROM member_hsg m
                          LEFT JOIN point_member pm ON m.memberid = pm.kd_member
                          WHERE email = '".$_SESSION['email']."' LIMIT 1";

                $exec = mysqli_query($link, $query);

                while ($row = mysqli_fetch_array($exec)) {
                    $_SESSION['kd_member'] = $row['memberid'];
                    $_SESSION['poin'] = $row['poin'];
                    $welcomeText = !empty($row['firstname']) ? $row['firstname'] : "Profile";
                ?>
                    <div class="dropdown ms-sm-3 header-item topbar-user" style="background-color: rgba(197,160,143,255); font-color: white">
                        <button type="button" class="btn" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="d-flex align-items-center">
                                <span class="text-start ms-xl-2" style="color: aliceblue;">
                                    <span class=" d-xl-inline-block ms-1 fw-medium align-midle"><?php echo $welcomeText; ?></span>
                                    <span class="d-none d-xl-block ms-1 fs-12 align-midle"><?php echo $_SESSION['poin']; ?> poin</span>
                                    <span class="d-none d-xl-block ms-1 fs-12 align-midle"><?php echo $_SESSION['kd_member']; ?> </span>
                                </span>
                            </span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <!-- item-->
                            <h6 class="dropdown-header">Welcome <?php echo $welcomeText; ?></h6>
                            <!-- item-->
                            <a class="dropdown-item" href="profile.php"><i class="mdi mdi-account-circle text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Profile</span></a>
                            <a class="dropdown-item" href="snk.php"><i class="mdi mdi-lifebuoy text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Syarat dan Ketentuan</span></a>
                            <a class="dropdown-item" href="#" onclick="showBarcodePopup()">
                                <i class="mdi mdi-barcode-scan text-muted fs-16 align-middle me-1"></i>
                                <span class="align-middle">Show Barcode</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="get.php"><i class="mdi mdi-wallet text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Balance Poin : <b><?php echo $_SESSION['poin'] ?></b></span></a>
                            <a class="dropdown-item" href="assets/api/logout.php"><i class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i> <span class="align-middle" data-key="t-logout">Logout</span></a>
                        </div>
                    </div>
                <?php
                }
            } else {
                ?>
                <div class="dropdown ms-sm-3 header-item topbar-user" style="background-color: rgba(197,160,143,255); color: white">
                    <button type="button" class="btn" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="d-flex align-items-center">
                            <img class="rounded-circle header-profile-user" src="assets/images/noimage.jpg" alt="Header Avatar">
                            <span class="text-start ms-xl-2">
                                <!-- <p class="card-title mb-0 flex-grow-1">Anda belum login</p> -->
                            </span>
                        </span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <!-- item-->
                        <a class="dropdown-item" href="login.php"><i class="mdi mdi-login text-muted fs-16 align-middle me-1"></i> <span class="align-middle">LogIn</span></a>
                        <a class="dropdown-item" href="signup.php"><i class="mdi mdi-account-box text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Sign Up</span></a>
                        <a class="dropdown-item" href="forget.php"><i class="mdi mdi-form-textbox-password text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Lupa Password</span></a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="snk.php"><i class="mdi mdi-lifebuoy text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Help</span></a>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</header>

<!-- removeNotificationModal -->
<div id="removeNotificationModal" class="modal fade zoomIn" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="NotificationModalbtn-close"></button>
            </div>
            <div class="modal-body">
                <div class="mt-2 text-center">
                    <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>
                    <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                        <h4>Are you sure ?</h4>
                        <p class="text-muted mx-4 mb-0">Are you sure you want to remove this Notification ?</p>
                    </div>
                </div>
                <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                    <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn w-sm btn-danger" id="delete-notification">Yes, Delete It!</button>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Popup barcode -->
<div id="barcodePopup" class="modal fade modal-top" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="title" style="display: flex; align-items: center; justify-content: center;"> <h4>Scan Barcode</h4></div>
            <div class="modal-body text-center">
                <!-- Use a container for the QR code -->
                <div id="popupBarcodeContainer" style="display: flex; align-items: center; justify-content: center;"></div>
            </div>
        </div>
    </div>
</div>

<style>
    @keyframes slideInFromTop {
        0% {
            transform: translateY(-100%);
            opacity: 0;
        }
        100% {
            transform: translateY(0);
            opacity: 1;
        }
    }

    .modal-top .modal-dialog {
        animation: slideInFromTop 0.5s ease-out;
    }
</style>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>
<script>
    function showBarcodePopup() {
        var popupBarcodeContainerElem = document.getElementById("popupBarcodeContainer");
        var nilaiQRCode = "<?php echo isset($_SESSION['kd_member']) ? $_SESSION['kd_member'] : ''; ?>";

        popupBarcodeContainerElem.innerHTML = '';

        var qrcode = new QRCode(popupBarcodeContainerElem, {
            text: nilaiQRCode,
            width: 200,
            height: 200
        });

        $('#barcodePopup').modal('show');

        qrcode.makeCode(nilaiQRCode);
    }

    $('#barcodePopup').on('shown.bs.modal', function () {
        showBarcodePopup();
    });
</script>
