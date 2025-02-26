<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manchaha</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="<?= base_url('/assets/admincss/styles.css')?>">
</head>

<body>
    <div id="sidebar" class="sidebar">
        <div id="logo-main" class="logo py-3">
            <img src="<?= base_url('/assets/images/images/header-new-logo.png') ?>" alt="" height="40px">
        </div>
        <nav>
            <ul>
                <li><a href="<?= base_url('Web/Admin/Admin/maindashboard') ?>"><img class=" ms-4 me-4"
                            src="<?= base_url('/assets/images/images/dashboard.png') ?>" alt="icon"> Dashboard</a></li>
                <li><a href="<?= base_url('bannerHeroSection') ?>"><img class=" ms-4 me-4"
                            src="<?= base_url('/assets/images/images/dashboard.png') ?>" alt="icon"> Banner(Main)</a>
                </li>
                <li><a href="<?= base_url('Web/Admin/Admin/allCustomers') ?>"><img class="ms-4 me-4"
                            src="<?= base_url('/assets/images/images/distributor.png') ?>" alt="icon">All Customer</a>
                </li>
                <!--<li><a href="<?= base_url('Web/Admin/Admin/addproductothers') ?>"><img class="ms-4 me-4" src="<?= base_url('/assets/images/images/prodcuts.png') ?>" alt="icon">Add Product</a></li>-->
                <li><a href="<?= base_url('Web/Admin/Admin/dashboard') ?>"><img class="ms-4 me-4"
                            src="<?= base_url('/assets/images/images/prodcuts.png') ?>" alt="icon">Add Products</a>
                </li>
                <li><a href="<?= base_url('Web/Admin/Admin/productList') ?>"><img class="ms-4 me-4"
                            src="<?= base_url('/assets/images/images/distributor.png') ?>" alt="icon">Our Products</a>
                </li>
                <li><a href="<?= base_url('transition') ?>"><img class="ms-4 me-4"
                            src="<?= base_url('/assets/images/images/transaction.png') ?>" alt="icon">Transactions</a>
                </li>
                <li><a href="<?= base_url('Web/Admin/Admin/showCategory') ?>"><img class="ms-4 me-4"
                            src="<?= base_url('/assets/images/images/category.png') ?>" alt="icon">Category</a></li>
                <li><a href="<?= base_url('orderHistory/1') ?>"><img class="ms-4 me-4"
                            src="<?= base_url('/assets/images/images/orderHistory.png') ?>" alt="icon">Order</a></li>
                <li><a href="<?= base_url('vender') ?>"><img class="ms-4 me-4"
                            src="<?= base_url('/assets/images/images/orderHistory.png') ?>" alt="icon">Vendor</a></li>
                <li><a href="<?= base_url('returntracking/new') ?>"><img class="ms-4 me-4"
                            src="<?= base_url('/assets/images/images/orderHistory.png') ?>" alt="icon"> Order Returns</a></li>
                <li>
                    <a href="<?= base_url('logout')?>"><img class="ms-4 me-4"
                            src="<?= base_url('/assets/images/images/logout.png') ?>" alt="icon">Logout</a>
                </li>
            </ul>
        </nav>

    </div>
    <div id="main-content" class="main-content">
        <header class="d-flex justify-content-between align-items-center pb-2">
            <div class="search-nav  col-7 d-flex">
                <div class="lensbar d-flex justify-content-center align-items-center">
                    <img src="<?= base_url('/assets/images/images/lens.png') ?>" alt="lens">
                </div>
                <input type="text" class="form-control  w-50" placeholder="Search anything here...">
            </div>
            <div class="user d-flex align-items-center">
                <!-- notification-icon -->
                <div class="notification-icon notify-icon me-4 d-flex justify-content-center align-items-center">
                    <img src="<?= base_url('/assets/images/images/notify-bell.png') ?>" alt="icon" width="25px ">
                    <div id="notify-count" class="notify-count">
                        2
                    </div>
                    <div class="notify-dropdown"></div>

                </div>
                <img src="<?= base_url('/assets/images/images/user-line.png') ?>" alt="">
                <div class="userImg me-1 ms-4">
                    <img src="<?= base_url('/assets/images/images/Avatar.png') ?>" alt="img">
                    <img id="green-dot" src="<?= base_url('/assets/images/images/greenDot.png') ?>" alt="icon">
                </div>
                <div class="user-details d-flex flex-column ">
                    <h5 class="m-0">Brand Login</h5>
                    <!-- <span> Simple Dummy text</span> -->
                </div>
            </div>
        </header>