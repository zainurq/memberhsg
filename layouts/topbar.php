<?php include 'layouts/session.php'; ?>
<header id="page-topbar">
    <div class="layout-width">
        <div class="navbar-header">
            <div class="d-flex">
                <!-- LOGO -->
                <div class="navbar-brand-box horizontal-logo">
                    <a href="index.php" class="logo logo-dark">
                        <span class="logo-sm">
                            <img src="assets/images/logo-sm.png" alt="" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="assets/images/logo-dark.png" alt="" height="17">
                        </span>
                    </a>

                    <a href="index.php" class="logo logo-light">
                        <span class="logo-sm">
                            <img src="assets/images/logo-light.png" alt="" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="assets/images/logo-light.png" alt="" height="40">
                        </span>
                    </a>
                </div>

                <button type="button" class="btn btn-sm px-3 fs-16 header-item vertical-menu-btn topnav-hamburger" id="topnav-hamburger-icon">
                    <span class="hamburger-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                    <span class="logo-sm">
                        <img src="assets/images/persilogo.png" alt="" height="40">
                    </span>
                </button>
            </div>

            <div class="d-flex align-items-center">
                    <?php
                        if($login == 'true') {
                            $query = "select *, (poin - ifnull(used_poin, 0)) as rest_poin
                                    from
                                    (
                                        select *, ifnull(profile_image, 'noimage') as imageprofile, 
                                            (select sum(point) as total from gift_point where kd_member = a.userid and flag = 'get') as poin, 
                                            (select sum(price) as totalpoin from gift_orderdtl where custid = a.userid) as used_poin  
                                        from gift_user a
                                        where useremail = '".$_SESSION['useremail']."' limit 1 
                                    )x";

                            $exec = mysqli_query($link, $query);

                            while($row = mysqli_fetch_array($exec)){
                                $_SESSION['custid'] = $row['userid'];
                                $_SESSION['poin'] = $row['rest_poin'];
                    ?>
                    <div class="dropdown ms-sm-3 header-item topbar-user">
                        <button type="button" class="btn" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="d-flex align-items-center">
                                <img class="rounded-circle header-profile-user" src="assets/images/users/<?php echo $row['imageprofile'].'.jpg'; ?>" alt="Header Avatar">
                                <span class="text-start ms-xl-2">
                                    <span class="d-none d-xl-inline-block ms-1 fw-medium align-midle"><?php echo $row['firstname'].' '.$row['lastname']; ?></span>
                                    <span class="d-none d-xl-block ms-1 fs-12 align-midle"><?php echo $_SESSION['poin']; ?> poin</span>
                                </span>
                            </span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <!-- item-->
                            <h6 class="dropdown-header">Welcome <?php echo $row['username']; ?></h6>
                            <a class="dropdown-item" href="pages-profile.php"><i class="mdi mdi-account-circle text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Profile</span></a>
                            <a class="dropdown-item" href="ij-profile-settings.php"><i class="mdi mdi-message-text-outline text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Edit Profile</span></a>
                            <a class="dropdown-item" href="apps-tasks-kanban.php"><i class="mdi mdi-form-textbox-password text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Edit Password</span></a>
                            <a class="dropdown-item" href="pages-faqs.php"><i class="mdi mdi-lifebuoy text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Help</span></a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="pages-profile.php"><i class="mdi mdi-wallet text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Balance Poin : <b><?php echo $_SESSION['poin'] ?></b></span></a>
                            <a class="dropdown-item" href="assets/api/logout.php"><i class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i> <span class="align-middle" data-key="t-logout">Logout</span></a>
                        </div>
                    </div>
                <?php } 
                } else {
                ?>
                    <div class="dropdown ms-sm-3 header-item topbar-user">
                        <button type="button" class="btn" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="d-flex align-items-center">
                                <img class="rounded-circle header-profile-user" src="assets/images/users/noimage.jpg" alt="Header Avatar">
                                <span class="text-start ms-xl-2">
                                    <!-- <p class="card-title mb-0 flex-grow-1">Anda belum login</p> -->
                                </span>
                            </span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <!-- item-->
                            <a class="dropdown-item" href="login.php"><i class="mdi mdi-login text-muted fs-16 align-middle me-1"></i> <span class="align-middle">LogIn</span></a>
                            <a class="dropdown-item" href="signup.php"><i class="mdi mdi-account-box text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Sign Up</span></a>
                            <a class="dropdown-item" href="ij-profile-settings.php"><i class="mdi mdi-form-textbox-password text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Lupa Password</span></a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="pages-faqs.php"><i class="mdi mdi-lifebuoy text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Help</span></a>
                        </div>
                    </div>
                <?php } ?>
            </div>
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