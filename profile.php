<?php 
include 'layouts/session.php';
include 'layouts/main.php';
include 'layouts/config.php';

// error_reporting(E_ALL);
// ini_set('display_errors', 1);
?>

<head>

    <?php
    includeFileWithVariables('layouts/title-meta.php', array('title' => 'Profile Settings'));
    include 'layouts/head-css.php';
    ?>

    <link href="assets/css/listtop.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
   
    <?php

$query = "SELECT member_hsg.*, IFNULL(SUM(CASE
                    WHEN point_member.flag = 'get' THEN point_member.point
                    WHEN point_member.flag = 'used' THEN -point_member.point
                    ELSE 0
                END),0) AS total_poin FROM member_hsg
        LEFT JOIN
        point_member ON member_hsg.memberid = point_member.kd_member
        WHERE member_hsg.memberid = 'HSG.21.000001' LIMIT 1";



        $exec = mysqli_query($link, $query);
        while($row = mysqli_fetch_array($exec)){
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
    <style>
        @media (max-width: 767px) {
        .map-container {
            width: 100%;
            padding-bottom: 75%; /* Asumsikan rasio lebar:tinggi iframe adalah 4:3 */
            position: relative;
        }

        .map-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
    }

    </style>

</head>

<body>
    <?php include 'layouts/menu.php'; ?>

    <!-- Begin page -->
    <div id="layout-wrapper">
        <div class="white-bg">
        </div>
        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <div class="position-relative mx-n2 mt-n2">
                        <div class="profile-wid-bg profile-setting-img">
                            <img src="assets/images/profile-bg.jpg" class="profile-wid-img" alt="">
                            <div class="overlay-content">
                                <div class="text-end">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-3">
                            <div class="card mt-n5">
                                <div class="card-body">
                                    <div class="text-center">
                                        <div class="profile-user position-relative d-inline-block mx-auto  mb-4">
                                            <img src="assets/images/users/avatar-1.jpg" class="rounded-circle avatar-xl img-thumbnail user-profile-image  shadow" alt="user-profile-image">
                                            <div class="avatar-xs p-0 rounded-circle profile-photo-edit">
                                                <input id="profile-img-file-input" type="file" class="profile-img-file-input">
                                                <label for="profile-img-file-input" class="profile-photo-edit avatar-xs">
                                                    <span class="avatar-title rounded-circle bg-light text-body shadow">
                                                        <i class="ri-camera-fill"></i>
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                        <p class="text-muted mb-2"><?php echo $memberid; ?></p>
                                        <p class="text-muted mb-0">Total Point</p>
                                        <p class="text-muted mb-0"><?php echo $poin; ?></p>

                                    </div>
                                </div>
                            </div>
                            <!--end card-->
                        </div>
                        <!--end col-->
                        <div class="col-xxl-9">
                            <div class="card mt-xxl-n5">
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
                                            <a class="nav-link" data-bs-toggle="tab" href="#maps" role="tab">
                                                <i class="fas fa-map-marker-alt"></i> Maps
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="card-body p-4">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="personalDetails" role="tabpanel">
                                            <form action="layouts/action/prosesupdate.php" method="POST">
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
                                                            <label for="provinceInput" class="form-label">Province</label>
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
                                                            <input type="text" class="form-control" id="zipcodeInput" name="zip" placeholder="Enter zipcode" value="<?php echo $zipcode; ?>">
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
                                            <form action="javascript:void(0);">
                                                <div class="row g-2">
                                                    <div class="col-lg-4">
                                                        <div>
                                                            <label for="oldpasswordInput" class="form-label">Old Password*</label>
                                                            <input type="password" class="form-control" id="oldpasswordInput" placeholder="Enter current password">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div>
                                                            <label for="newpasswordInput" class="form-label">New Password*</label>
                                                            <input type="password" class="form-control" id="newpasswordInput" name="password" placeholder="Enter new password">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div>
                                                            <label for="confirmpasswordInput" class="form-label">Confirm Password*</label>
                                                            <input type="password" class="form-control" id="confirmpasswordInput" placeholder="Confirm password">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="mb-3">
                                                            <a href="javascript:void(0);" class="link-primary text-decoration-underline">Forgot Password ?</a>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="text-end">
                                                            <button type="submit" class="btn btn-success">Change Password</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="tab-pane" id="help" role="tabpanel">
                                        <h4>Contact Information</h4>
                                        <!-- Accordions Bordered -->
                                        <div class="accordion custom-accordionwithicon custom-accordion-border accordion-border-box accordion-secondary" id="accordionBordered">
                                            <div class="accordion-item shadow">
                                                <h2 class="accordion-header" id="accordionborderedExample1">
                                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#accor_borderedExamplecollapse1" aria-expanded="true" aria-controls="accor_borderedExamplecollapse1">
                                                        Vapehan
                                                    </button>
                                                </h2>
                                                <div id="accor_borderedExamplecollapse1" class="accordion-collapse collapse show" aria-labelledby="accordionborderedExample1" data-bs-parent="#accordionBordered">
                                                    <div class="accordion-body">
                                                        <p>Contact Vapehan:</p>
                                                        <p>Email: vapehan@example.com</p>
                                                        <p>Phone: +123456789</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item shadow mt-2">
                                                <h2 class="accordion-header" id="accordionborderedExample2">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_borderedExamplecollapse2" aria-expanded="false" aria-controls="accor_borderedExamplecollapse2">
                                                        HSGMoto
                                                    </button>
                                                </h2>
                                                <div id="accor_borderedExamplecollapse2" class="accordion-collapse collapse" aria-labelledby="accordionborderedExample2" data-bs-parent="#accordionBordered">
                                                    <div class="accordion-body">
                                                        <p>Contact HSGMoto:</p>
                                                        <p>Email: hsgmoto@example.com</p>
                                                        <p>Phone: +123456789</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item shadow mt-2">
                                                <h2 class="accordion-header" id="accordionborderedExample3">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_borderedExamplecollapse3" aria-expanded="false" aria-controls="accor_borderedExamplecollapse3">
                                                        Helihantoys
                                                    </button>
                                                </h2>
                                                <div id="accor_borderedExamplecollapse3" class="accordion-collapse collapse" aria-labelledby="accordionborderedExample3" data-bs-parent="#accordionBordered">
                                                    <div class="accordion-body">
                                                        <p>Contact Helihantoys:</p>
                                                        <p>Email: helihantoys@example.com</p>
                                                        <p>Phone: +123456789</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item shadow mt-2">
                                                <h2 class="accordion-header" id="accordionborderedExample4">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_borderedExamplecollapse4" aria-expanded="false" aria-controls="accor_borderedExamplecollapse4">
                                                        Hans Print Plus
                                                    </button>
                                                </h2>
                                                <div id="accor_borderedExamplecollapse4" class="accordion-collapse collapse" aria-labelledby="accordionborderedExample4" data-bs-parent="#accordionBordered">
                                                    <div class="accordion-body">
                                                        <p>Contact Hans Print Plus:</p>
                                                        <p>Email: hansprint@example.com</p>
                                                        <p>Phone: +123456789</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item shadow mt-2">
                                                <h2 class="accordion-header" id="accordionborderedExample5">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_borderedExamplecollapse5" aria-expanded="false" aria-controls="accor_borderedExamplecollapse5">
                                                        Indonesian Juices
                                                    </button>
                                                </h2>
                                                <div id="accor_borderedExamplecollapse5" class="accordion-collapse collapse" aria-labelledby="accordionborderedExample5" data-bs-parent="#accordionBordered">
                                                    <div class="accordion-body">
                                                        <p>Contact Indonesian Juices:</p>
                                                        <p>Email: indjuices@example.com</p>
                                                        <p>Phone: +123456789</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item shadow mt-2">
                                                <h2 class="accordion-header" id="accordionborderedExample6">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_borderedExamplecollapse6" aria-expanded="false" aria-controls="accor_borderedExamplecollapse6">
                                                        Cafe
                                                    </button>
                                                </h2>
                                                <div id="accor_borderedExamplecollapse6" class="accordion-collapse collapse" aria-labelledby="accordionborderedExample6" data-bs-parent="#accordionBordered">
                                                    <div class="accordion-body">
                                                        <p>Contact Cafe:</p>
                                                        <p>Email: cafe@example.com</p>
                                                        <p>Phone: +123456789</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane" id="maps" role="tabpanel">
                                        <div class="map-container">
                                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.2773093131004!2d106.93293727499034!3d-6.227122293760967
                                                        !2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e698cbc5bbd3d9b%3A0x830a1dd78974e817!2sVAPEHAN!5e0!3m2!1sid!2sid!4v1702620135194!5m2!1sid!2sid" 
                                                        width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <?php include 'layouts/footer.php'; ?>

        </div>

    </div>

    <?php include 'layouts/vendor-scripts.php'; ?>

    <!-- profile-setting init js -->
    <script src="assets/js/pages/profile-setting.init.js"></script>

    <!-- App js -->
    <script src="assets/js/app.js"></script>

    <script>
    function showContactInfo(selectElement) {
        // Sembunyikan semua konten
        var allContactContents = document.querySelectorAll('[id$="Content"]');
        for (var i = 0; i < allContactContents.length; i++) {
            allContactContents[i].style.display = "none";
        }

        // Tampilkan konten yang sesuai dengan opsi yang dipilih
        var selectedContactContent = document.getElementById(selectElement.value + "Content");
        if (selectedContactContent) {
            selectedContactContent.style.display = "block";
        }
    }
</script>

</body>

</html>
