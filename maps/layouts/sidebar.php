<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="index.php" class="logo logo-dark">
            <span class="logo-sm">
                <img src="assets/images/logo-sm.png" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="assets/images/logo-dark.png" alt="" height="17">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="index.php" class="logo logo-light">
            <span class="logo-sm">
                <img src="assets/images/logo-sm.png" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="assets/images/logo-light.png" alt="" height="17">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarDashboards" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarDashboards">
                        <i class="mdi mdi-speedometer"></i> <span data-key="t-dashboards">Dashboards</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarDashboards">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="dashboard-analytics.php" class="nav-link" data-key="t-analytics"> Analytics </a>
                            </li>
                            <li class="nav-item">
                                <a href="dashboard-crm.php" class="nav-link" data-key="t-crm"> CRM </a>
                            </li>
                            <li class="nav-item">
                                <a href="index.php" class="nav-link" data-key="t-ecommerce"> Ecommerce </a>
                            </li>
                            <li class="nav-item">
                                <a href="dashboard-crypto.php" class="nav-link" data-key="t-crypto"> Crypto </a>
                            </li>
                            <li class="nav-item">
                                <a href="dashboard-projects.php" class="nav-link" data-key="t-projects"> Projects </a>
                            </li>
                            <li class="nav-item">
                                <a href="dashboard-nft.php" class="nav-link" data-key="t-nft"> NFT</a>
                            </li>
                            <li class="nav-item">
                                <a href="dashboard-job.php" class="nav-link" data-key="t-job">Job</a>
                            </li>
                        </ul>
                    </div>
                </li> <!-- end Dashboard Menu -->
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarApps" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarApps">
                        <i class="mdi mdi-view-grid-plus-outline"></i> <span data-key="t-apps">Apps</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarApps">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="apps-calendar.php" class="nav-link" data-key="t-calendar"> Calendar </a>
                            </li>
                            <li class="nav-item">
                                <a href="apps-chat.php" class="nav-link" data-key="t-chat"> Chat </a>
                            </li>
                            <li class="nav-item">
                                <a href="#sidebarEmail" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarEmail" data-key="t-email">
                                    Email
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarEmail">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="apps-mailbox.php" class="nav-link" data-key="t-mailbox"> Mailbox </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#sidebaremailTemplates" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebaremailTemplates" data-key="t-email-templates">
                                                Email Templates
                                            </a>
                                            <div class="collapse menu-dropdown" id="sidebaremailTemplates">
                                                <ul class="nav nav-sm flex-column">
                                                    <li class="nav-item">
                                                        <a href="apps-email-basic.php" class="nav-link" data-key="t-basic-action"> Basic Action </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="apps-email-ecommerce.php" class="nav-link" data-key="t-ecommerce-action"> Ecommerce Action </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a href="#sidebarEcommerce" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarEcommerce" data-key="t-ecommerce"> Ecommerce
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarEcommerce">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="apps-ecommerce-products.php" class="nav-link" data-key="t-products"> Products </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-ecommerce-product-details.php" class="nav-link" data-key="t-product-Details"> Product Details </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-ecommerce-add-product.php" class="nav-link" data-key="t-create-product"> Create Product </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-ecommerce-orders.php" class="nav-link" data-key="t-orders"> Orders </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-ecommerce-order-details.php" class="nav-link" data-key="t-order-details"> Order Details </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-ecommerce-customers.php" class="nav-link" data-key="t-customers"> Customers </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-ecommerce-cart.php" class="nav-link" data-key="t-shopping-cart"> Shopping Cart </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-ecommerce-checkout.php" class="nav-link" data-key="t-checkout"> Checkout </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-ecommerce-sellers.php" class="nav-link" data-key="t-sellers"> Sellers </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-ecommerce-seller-details.php" class="nav-link" data-key="t-sellers-details"> Seller Details </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a href="#sidebarProjects" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarProjects" data-key="t-projects">Projects
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarProjects">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="apps-projects-list.php" class="nav-link" data-key="t-list"> List </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-projects-overview.php" class="nav-link" data-key="t-overview"> Overview </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-projects-create.php" class="nav-link" data-key="t-create-project"> Create Project </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a href="#sidebarTasks" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarTasks" data-key="t-tasks"> Tasks
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarTasks">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="apps-tasks-kanban.php" class="nav-link" data-key="t-kanbanboard"> Kanban Board </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-tasks-list-view.php" class="nav-link" data-key="t-list-view"> List View </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-tasks-details.php" class="nav-link" data-key="t-task-details"> Task Details </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a href="#sidebarCRM" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarCRM" data-key="t-crm"> CRM
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarCRM">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="apps-crm-contacts.php" class="nav-link" data-key="t-contacts"> Contacts </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-crm-companies.php" class="nav-link" data-key="t-companies"> Companies </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-crm-deals.php" class="nav-link" data-key="t-deals"> Deals </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-crm-leads.php" class="nav-link" data-key="t-leads"> Leads </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a href="#sidebarCrypto" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarCrypto"> Crypto
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarCrypto">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="apps-crypto-transactions.php" class="nav-link" data-key="t-transactions"> Transactions </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-crypto-buy-sell.php" class="nav-link" data-key="t-buy-sell"> Buy & Sell </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-crypto-orders.php" class="nav-link" data-key="t-orders"> Orders </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-crypto-wallet.php" class="nav-link" data-key="t-my-wallet"> My Wallet </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-crypto-ico.php" class="nav-link" data-key="t-ico-list"> ICO List </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-crypto-kyc.php" class="nav-link" data-key="t-kyc-application"> KYC Application </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a href="#sidebarInvoices" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarInvoices"> Invoices
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarInvoices">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="apps-invoices-list.php" class="nav-link" data-key="t-list-view"> List View </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-invoices-details.php" class="nav-link" data-key="t-details"> Details </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-invoices-create.php" class="nav-link" data-key="t-create-invoice"> Create Invoice </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a href="#sidebarTickets" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarTickets"> Support Tickets
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarTickets">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="apps-tickets-list.php" class="nav-link" data-key="t-list-view"> List View </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-tickets-details.php" class="nav-link" data-key="t-ticket-details"> Ticket Details </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a href="#sidebarnft" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarnft" data-key="t-nft-marketplace">
                                    NFT Marketplace
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarnft">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="apps-nft-marketplace.php" class="nav-link" data-key="t-marketplace"> Marketplace </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-nft-explore.php" class="nav-link" data-key="t-explore-now"> Explore Now </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-nft-auction.php" class="nav-link" data-key="t-live-auction"> Live Auction </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-nft-item-details.php" class="nav-link" data-key="t-item-details"> Item Details </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-nft-collections.php" class="nav-link" data-key="t-collections"> Collections </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-nft-creators.php" class="nav-link" data-key="t-creators"> Creators </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-nft-ranking.php" class="nav-link" data-key="t-ranking"> Ranking </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-nft-wallet.php" class="nav-link" data-key="t-wallet-connect"> Wallet Connect </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-nft-create.php" class="nav-link" data-key="t-create-nft"> Create NFT </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a href="apps-file-manager.php" class="nav-link"> <span data-key="t-file-manager">File Manager</span></a>
                            </li>
                            <li class="nav-item">
                                <a href="apps-todo.php" class="nav-link"> <span data-key="t-to-do">To Do</span></a>
                            </li>
                            <li class="nav-item">
                                <a href="#sidebarjobs" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarjobs" data-key="t-jobs"> Jobs</a>
                                <div class="collapse menu-dropdown" id="sidebarjobs">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="apps-job-statistics.php" class="nav-link" data-key="t-statistics"> Statistics </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#sidebarJoblists" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarJoblists" data-key="t-job-lists">
                                                Job Lists
                                            </a>
                                            <div class="collapse menu-dropdown" id="sidebarJoblists">
                                                <ul class="nav nav-sm flex-column">
                                                    <li class="nav-item">
                                                        <a href="apps-job-lists.php" class="nav-link" data-key="t-list"> List
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="apps-job-grid-lists.php" class="nav-link" data-key="t-grid"> Grid </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="apps-job-details.php" class="nav-link" data-key="t-overview"> Overview</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#sidebarCandidatelists" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarCandidatelists" data-key="t-candidate-lists">
                                                Candidate Lists
                                            </a>
                                            <div class="collapse menu-dropdown" id="sidebarCandidatelists">
                                                <ul class="nav nav-sm flex-column">
                                                    <li class="nav-item">
                                                        <a href="apps-job-candidate-lists.php" class="nav-link" data-key="t-list-view"> List View
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="apps-job-candidate-grid.php" class="nav-link" data-key="t-grid-view"> Grid View</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-job-application.php" class="nav-link" data-key="t-application"> Application </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-job-new.php" class="nav-link" data-key="t-new-job"> New Job </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-job-companies-lists.php" class="nav-link" data-key="t-companies-list"> Companies List </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-job-categories.php" class="nav-link" data-key="t-job-categories"> Job Categories</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a href="apps-api-key.php" class="nav-link" data-key="t-api-key">API Key</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarLayouts" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarLayouts">
                        <i class="mdi mdi-view-carousel-outline"></i> <span data-key="t-layouts">Layouts</span> <span class="badge badge-pill bg-danger" data-key="t-hot">Hot</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarLayouts">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="layouts-horizontal.php" class="nav-link" target="_blank" data-key="t-horizontal">Horizontal</a>
                            </li>
                            <li class="nav-item">
                                <a href="layouts-detached.php" class="nav-link" target="_blank" data-key="t-detached">Detached</a>
                            </li>
                            <li class="nav-item">
                                <a href="layouts-two-column.php" class="nav-link" target="_blank" data-key="t-two-column">Two Column</a>
                            </li>
                            <li class="nav-item">
                                <a href="layouts-vertical-hovered.php" class="nav-link" target="_blank" data-key="t-hovered">Hovered</a>
                            </li>
                        </ul>
                    </div>
                </li> <!-- end Dashboard Menu -->

                <li class="menu-title"><i class="ri-more-fill"></i> <span data-key="t-pages">Pages</span></li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarAuth" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarAuth">
                        <i class="mdi mdi-account-circle-outline"></i> <span data-key="t-authentication">Authentication</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarAuth">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="#sidebarSignIn" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarSignIn" data-key="t-signin"> Sign In
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarSignIn">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="auth-signin-basic.php" class="nav-link" data-key="t-basic"> Basic </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="auth-signin-cover.php" class="nav-link" data-key="t-cover"> Cover </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a href="#sidebarSignUp" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarSignUp" data-key="t-signup"> Sign Up
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarSignUp">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="auth-signup-basic.php" class="nav-link" data-key="t-basic"> Basic </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="auth-signup-cover.php" class="nav-link" data-key="t-cover"> Cover </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <li class="nav-item">
                                <a href="#sidebarResetPass" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarResetPass" data-key="t-password-reset">Password Reset
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarResetPass">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="auth-pass-reset-basic.php" class="nav-link" data-key="t-basic"> Basic </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="auth-pass-reset-cover.php" class="nav-link" data-key="t-cover"> Cover </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <li class="nav-item">
                                <a href="#sidebarchangePass" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarchangePass" data-key="t-password-create">
                                    Password Create
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarchangePass">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="auth-pass-change-basic.php" class="nav-link" data-key="t-basic">
                                                Basic </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="auth-pass-change-cover.php" class="nav-link" data-key="t-cover">
                                                Cover </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <li class="nav-item">
                                <a href="#sidebarLockScreen" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarLockScreen" data-key="t-lock-screen"> Lock Screen
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarLockScreen">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="auth-lockscreen-basic.php" class="nav-link" data-key="t-basic"> Basic </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="auth-lockscreen-cover.php" class="nav-link" data-key="t-cover"> Cover </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <li class="nav-item">
                                <a href="#sidebarLogout" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarLogout" data-key="t-logout"> Logout
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarLogout">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="auth-logout-basic.php" class="nav-link" data-key="t-basic"> Basic </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="auth-logout-cover.php" class="nav-link" data-key="t-cover"> Cover </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a href="#sidebarSuccessMsg" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarSuccessMsg" data-key="t-success-message"> Success Message
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarSuccessMsg">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="auth-success-msg-basic.php" class="nav-link" data-key="t-basic"> Basic </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="auth-success-msg-cover.php" class="nav-link" data-key="t-cover"> Cover </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a href="#sidebarTwoStep" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarTwoStep" data-key="t-two-step-verification"> Two Step Verification
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarTwoStep">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="auth-twostep-basic.php" class="nav-link" data-key="t-basic"> Basic </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="auth-twostep-cover.php" class="nav-link" data-key="t-cover"> Cover </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a href="#sidebarErrors" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarErrors" data-key="t-errors"> Errors
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarErrors">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="auth-404-basic.php" class="nav-link" data-key="t-404-basic"> 404 Basic </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="auth-404-cover.php" class="nav-link" data-key="t-404-cover"> 404 Cover </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="auth-404-alt.php" class="nav-link" data-key="t-404-alt"> 404 Alt </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="auth-500.php" class="nav-link" data-key="t-500"> 500 </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="auth-offline.php" class="nav-link" data-key="t-offline-page"> Offline Page </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarPages" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarPages">
                        <i class="mdi mdi-sticker-text-outline"></i> <span data-key="t-pages">Pages</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarPages">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="pages-starter.php" class="nav-link" data-key="t-starter"> Starter </a>
                            </li>
                            <li class="nav-item">
                                <a href="#sidebarProfile" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarProfile" data-key="t-profile"> Profile
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarProfile">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="pages-profile.php" class="nav-link" data-key="t-simple-page"> Simple Page </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="pages-profile-settings.php" class="nav-link" data-key="t-settings"> Settings </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a href="pages-team.php" class="nav-link" data-key="t-team"> Team </a>
                            </li>
                            <li class="nav-item">
                                <a href="pages-timeline.php" class="nav-link" data-key="t-timeline"> Timeline </a>
                            </li>
                            <li class="nav-item">
                                <a href="pages-faqs.php" class="nav-link" data-key="t-faqs"> FAQs </a>
                            </li>
                            <li class="nav-item">
                                <a href="pages-pricing.php" class="nav-link" data-key="t-pricing"> Pricing </a>
                            </li>
                            <li class="nav-item">
                                <a href="pages-gallery.php" class="nav-link" data-key="t-gallery"> Gallery </a>
                            </li>
                            <li class="nav-item">
                                <a href="pages-maintenance.php" class="nav-link" data-key="t-maintenance"> Maintenance </a>
                            </li>
                            <li class="nav-item">
                                <a href="pages-coming-soon.php" class="nav-link" data-key="t-coming-soon"> Coming Soon </a>
                            </li>
                            <li class="nav-item">
                                <a href="pages-sitemap.php" class="nav-link" data-key="t-sitemap"> Sitemap </a>
                            </li>
                            <li class="nav-item">
                                <a href="pages-search-results.php" class="nav-link" data-key="t-search-results"> Search Results </a>
                            </li>
                            <li class="nav-item">
                                <a href="pages-privacy-policy.php" class="nav-link" data-key="t-privacy-policy">Privacy Policy</a>
                            </li>
                            <li class="nav-item">
                                <a href="pages-term-conditions.php" class="nav-link" data-key="t-term-conditions">Term & Conditions</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarLanding" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarLanding">
                        <i class="ri-rocket-line"></i> <span data-key="t-landing">Landing</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarLanding">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="landing.php" class="nav-link" data-key="t-one-page"> One Page </a>
                            </li>
                            <li class="nav-item">
                                <a href="nft-landing.php" class="nav-link" data-key="t-nft-landing"> NFT Landing </a>
                            </li>
                            <li class="nav-item">
                                <a href="job-landing.php" class="nav-link" data-key="t-job">Job</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="menu-title"><i class="ri-more-fill"></i> <span data-key="t-components">Components</span></li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarUI" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarUI">
                        <i class="mdi mdi-cube-outline"></i> <span data-key="t-base-ui">Base UI</span>
                    </a>
                    <div class="collapse menu-dropdown mega-dropdown-menu" id="sidebarUI">
                        <div class="row">
                            <div class="col-lg-4">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="ui-alerts.php" class="nav-link" data-key="t-alerts">Alerts</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="ui-badges.php" class="nav-link" data-key="t-badges">Badges</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="ui-buttons.php" class="nav-link" data-key="t-buttons">Buttons</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="ui-colors.php" class="nav-link" data-key="t-colors">Colors</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="ui-cards.php" class="nav-link" data-key="t-cards">Cards</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="ui-carousel.php" class="nav-link" data-key="t-carousel">Carousel</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="ui-dropdowns.php" class="nav-link" data-key="t-dropdowns">Dropdowns</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="ui-grid.php" class="nav-link" data-key="t-grid">Grid</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-lg-4">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="ui-images.php" class="nav-link" data-key="t-images">Images</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="ui-tabs.php" class="nav-link" data-key="t-tabs">Tabs</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="ui-accordions.php" class="nav-link" data-key="t-accordion-collapse">Accordion & Collapse</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="ui-modals.php" class="nav-link" data-key="t-modals">Modals</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="ui-offcanvas.php" class="nav-link" data-key="t-offcanvas">Offcanvas</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="ui-placeholders.php" class="nav-link" data-key="t-placeholders">Placeholders</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="ui-progress.php" class="nav-link" data-key="t-progress">Progress</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="ui-notifications.php" class="nav-link" data-key="t-notifications">Notifications</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-lg-4">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="ui-media.php" class="nav-link" data-key="t-media-object">Media object</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="ui-embed-video.php" class="nav-link" data-key="t-embed-video">Embed Video</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="ui-typography.php" class="nav-link" data-key="t-typography">Typography</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="ui-lists.php" class="nav-link" data-key="t-lists">Lists</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="ui-links.php" class="nav-link"><span data-key="t-links">Links</span> <span class="badge badge-pill bg-success" data-key="t-new">New</span></a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="ui-general.php" class="nav-link" data-key="t-general">General</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="ui-ribbons.php" class="nav-link" data-key="t-ribbons">Ribbons</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="ui-utilities.php" class="nav-link" data-key="t-utilities">Utilities</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarAdvanceUI" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarAdvanceUI">
                        <i class="mdi mdi-layers-triple-outline"></i> <span data-key="t-advance-ui">Advance UI</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarAdvanceUI">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="advance-ui-sweetalerts.php" class="nav-link" data-key="t-sweet-alerts">Sweet Alerts</a>
                            </li>
                            <li class="nav-item">
                                <a href="advance-ui-nestable.php" class="nav-link" data-key="t-nestable-list">Nestable List</a>
                            </li>
                            <li class="nav-item">
                                <a href="advance-ui-scrollbar.php" class="nav-link" data-key="t-scrollbar">Scrollbar</a>
                            </li>
                            <li class="nav-item">
                                <a href="advance-ui-animation.php" class="nav-link" data-key="t-animation">Animation</a>
                            </li>
                            <li class="nav-item">
                                <a href="advance-ui-tour.php" class="nav-link" data-key="t-tour">Tour</a>
                            </li>
                            <li class="nav-item">
                                <a href="advance-ui-swiper.php" class="nav-link" data-key="t-swiper-slider">Swiper Slider</a>
                            </li>
                            <li class="nav-item">
                                <a href="advance-ui-ratings.php" class="nav-link" data-key="t-ratings">Ratings</a>
                            </li>
                            <li class="nav-item">
                                <a href="advance-ui-highlight.php" class="nav-link" data-key="t-highlight">Highlight</a>
                            </li>
                            <li class="nav-item">
                                <a href="advance-ui-scrollspy.php" class="nav-link" data-key="t-scrollSpy">ScrollSpy</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="widgets.php">
                        <i class="mdi mdi-puzzle-outline"></i> <span data-key="t-widgets">Widgets</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarForms" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarForms">
                        <i class="mdi mdi-form-select"></i> <span data-key="t-forms">Forms</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarForms">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="forms-elements.php" class="nav-link" data-key="t-basic-elements">Basic Elements</a>
                            </li>
                            <li class="nav-item">
                                <a href="forms-select.php" class="nav-link" data-key="t-form-select"> Form Select </a>
                            </li>
                            <li class="nav-item">
                                <a href="forms-checkboxs-radios.php" class="nav-link" data-key="t-checkboxs-radios">Checkboxs & Radios</a>
                            </li>
                            <li class="nav-item">
                                <a href="forms-pickers.php" class="nav-link" data-key="t-pickers"> Pickers </a>
                            </li>
                            <li class="nav-item">
                                <a href="forms-masks.php" class="nav-link" data-key="t-input-masks">Input Masks</a>
                            </li>
                            <li class="nav-item">
                                <a href="forms-advanced.php" class="nav-link" data-key="t-advanced">Advanced</a>
                            </li>
                            <li class="nav-item">
                                <a href="forms-range-sliders.php" class="nav-link" data-key="t-range-slider"> Range Slider </a>
                            </li>
                            <li class="nav-item">
                                <a href="forms-validation.php" class="nav-link" data-key="t-validation">Validation</a>
                            </li>
                            <li class="nav-item">
                                <a href="forms-wizard.php" class="nav-link" data-key="t-wizard">Wizard</a>
                            </li>
                            <li class="nav-item">
                                <a href="forms-editors.php" class="nav-link" data-key="t-editors">Editors</a>
                            </li>
                            <li class="nav-item">
                                <a href="forms-file-uploads.php" class="nav-link" data-key="t-file-uploads">File Uploads</a>
                            </li>
                            <li class="nav-item">
                                <a href="forms-layouts.php" class="nav-link" data-key="t-form-layouts">Form Layouts</a>
                            </li>
                            <li class="nav-item">
                                <a href="forms-select2.php" class="nav-link" data-key="t-select2">Select2</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarTables" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarTables">
                        <i class="mdi mdi-grid-large"></i> <span data-key="t-tables">Tables</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarTables">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="tables-basic.php" class="nav-link" data-key="t-basic-tables">Basic Tables</a>
                            </li>
                            <li class="nav-item">
                                <a href="tables-gridjs.php" class="nav-link" data-key="t-grid-js">Grid Js</a>
                            </li>
                            <li class="nav-item">
                                <a href="tables-listjs.php" class="nav-link" data-key="t-list-js">List Js</a>
                            </li>
                            <li class="nav-item">
                                <a href="tables-datatables.php" class="nav-link" data-key="t-datatables">Datatables</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarCharts" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarCharts">
                        <i class="mdi mdi-chart-donut"></i> <span data-key="t-charts">Charts</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarCharts">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="#sidebarApexcharts" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarApexcharts" data-key="t-apexcharts"> Apexcharts
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarApexcharts">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="charts-apex-line.php" class="nav-link" data-key="t-line"> Line </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="charts-apex-area.php" class="nav-link" data-key="t-area"> Area </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="charts-apex-column.php" class="nav-link" data-key="t-column"> Column </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="charts-apex-bar.php" class="nav-link" data-key="t-bar"> Bar </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="charts-apex-mixed.php" class="nav-link" data-key="t-mixed"> Mixed </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="charts-apex-timeline.php" class="nav-link" data-key="t-timeline"> Timeline </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="charts-apex-range-area.php" class="nav-link"><span data-key="t-range-area">Range Area</span> <span class="badge badge-pill bg-success" data-key="t-new">New</span></a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="charts-apex-funnel.php" class="nav-link"><span data-key="t-funnel">Funnel</span> <span class="badge badge-pill bg-success" data-key="t-new">New</span></a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="charts-apex-candlestick.php" class="nav-link" data-key="t-candlstick"> Candlstick </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="charts-apex-boxplot.php" class="nav-link" data-key="t-boxplot"> Boxplot </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="charts-apex-bubble.php" class="nav-link" data-key="t-bubble"> Bubble </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="charts-apex-scatter.php" class="nav-link" data-key="t-scatter"> Scatter </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="charts-apex-heatmap.php" class="nav-link" data-key="t-heatmap"> Heatmap </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="charts-apex-treemap.php" class="nav-link" data-key="t-treemap"> Treemap </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="charts-apex-pie.php" class="nav-link" data-key="t-pie"> Pie </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="charts-apex-radialbar.php" class="nav-link" data-key="t-radialbar"> Radialbar </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="charts-apex-radar.php" class="nav-link" data-key="t-radar"> Radar </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="charts-apex-polar.php" class="nav-link" data-key="t-polar-area"> Polar Area </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a href="charts-chartjs.php" class="nav-link" data-key="t-chartjs"> Chartjs </a>
                            </li>
                            <li class="nav-item">
                                <a href="charts-echarts.php" class="nav-link" data-key="t-echarts"> Echarts </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarIcons" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarIcons">
                        <i class="mdi mdi-android-studio"></i> <span data-key="t-icons">Icons</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarIcons">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="icons-remix.php" class="nav-link" data-key="t-remix">Remix</a>
                            </li>
                            <li class="nav-item">
                                <a href="icons-boxicons.php" class="nav-link" data-key="t-boxicons">Boxicons</a>
                            </li>
                            <li class="nav-item">
                                <a href="icons-materialdesign.php" class="nav-link" data-key="t-material-design">Material Design</a>
                            </li>
                            <li class="nav-item">
                                <a href="icons-lineawesome.php" class="nav-link" data-key="t-line-awesome">Line Awesome</a>
                            </li>
                            <li class="nav-item">
                                <a href="icons-feather.php" class="nav-link" data-key="t-feather">Feather</a>
                            </li>
                            <li class="nav-item">
                                <a href="icons-crypto.php" class="nav-link"> <span data-key="t-crypto-svg">Crypto SVG</span></a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarMaps" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarMaps">
                        <i class="mdi mdi-map-marker-outline"></i> <span data-key="t-maps">Maps</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarMaps">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="maps-google.php" class="nav-link" data-key="t-google">
                                    Google
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="maps-vector.php" class="nav-link" data-key="t-vector">
                                    Vector
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="maps-leaflet.php" class="nav-link" data-key="t-leaflet">
                                    Leaflet
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarMultilevel" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarMultilevel">
                        <i class="mdi mdi-share-variant-outline"></i> <span data-key="t-multi-level">Multi Level</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarMultilevel">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="#" class="nav-link" data-key="t-level-1.1"> Level 1.1 </a>
                            </li>
                            <li class="nav-item">
                                <a href="#sidebarAccount" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarAccount" data-key="t-level-1.2"> Level 1.2
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarAccount">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="#" class="nav-link" data-key="t-level-2.1"> Level 2.1 </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#sidebarCrm" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarCrm" data-key="t-level-2.2"> Level 2.2
                                            </a>
                                            <div class="collapse menu-dropdown" id="sidebarCrm">
                                                <ul class="nav nav-sm flex-column">
                                                    <li class="nav-item">
                                                        <a href="#" class="nav-link" data-key="t-level-3.1"> Level 3.1 </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="#" class="nav-link" data-key="t-level-3.2"> Level 3.2 </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </li>

            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>