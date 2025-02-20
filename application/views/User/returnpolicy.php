<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Return Policy</title>
    <style>
    /* Container styling */
    .containers {
        max-width: 90%;
        margin: 0 auto;
        padding: 30px !important;
        background-color: #ffffff;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        margin-bottom: 30px;
    }

    .footer-bottom p {
        color: #fff;
    }

    .footer-contact-section ul li {
        color: #fff !important;
    }

    .privacy-headings {
        font-size: 26px;
        font-weight: 600;
    }

    .containers h3 {
        font-size: 20px;
        font-weight: 600;
    }

    .containers h4 {
        font-size: 18px;
        font-weight: 500;
    }


    .main-page-container p,
    .main-page-container ul li {
        color: #34495e;
        font-size: 16px;
        line-height: 1.6;
        margin-bottom: 15px;
    }

    .footer-logo-section p {
        color: #fff !important;
    }

    /* List item styles */
    .containers ul li {
        margin-bottom: 10px;
        /* Space between list items */
    }

    /* Strong tag (bold) styling */
    .containers ul li strong {
        font-weight: bold;
        color: #2D3134;
    }

    .containers a {
        color: #3498db;
        /* Updated color for links */
        text-decoration: none;
    }

    .containers a:hover {
        text-decoration: underline;
    }
    </style>
</head>

<body>
    <?php include('header.php')?>
    <div class="main-page-section">
        <div class="main-content am">
            <h1>Return Policy</h1>
            <h3><a href="<?= base_url('welcome/index') ?>">Home</a> | Return Policy</h3>
        </div>
    </div>
    <section class="containers main-page-container">
        <h3>3-day Return Policy</h3>
        <p>Mnnchaha.com offers a 3-day return policy for eligible items. If you are not completely satisfied with your
            purchase, you may return it within 3 days of the delivery date for a refund or exchange.
        </p>

        <h3>Eligibility for Returns</h3>
        <p>To be eligible for a return, items must be unused, in the original packaging, and in the same condition as
            received. Custom or personalized items are not eligible for return unless there is a manufacturing defect or
            an error on our part.</p>

        <h3>Return Process</h3>
        <p><strong>1.</strong> Contact our customer service team at Enquiry@mnnchaha.com within 3 days of receiving your
            order to initiate the return process.</p>
        <p><strong>2.</strong> Provide your order number, details of the item(s) you wish to return, and the reason for
            the return.</p>
        <p><strong>3.</strong> Our customer service team will guide you on the return process, including the return
            shipping address.</p>
        <p><strong>4.</strong> Pack the item securely, including all original packaging and labels, and ship it to the
            provided address.
        </p>
        <p><strong>5.</strong> Once we receive the returned item and verify its condition, we will process the refund or
            exchange.
        </p>
        <h3>Refund Details</h3>
        <p>Refunds will be processed within 3 business days after receiving the returned item. Refunds will be issued
            through online payment method. Please note that shipping fees are non-refundable.</p>
        <h3>Defective or Damaged Items </h3>
        <p>If you receive a defective or damaged item, please contact our customer service team within 3 days of
            receiving the order. We will arrange for a replacement or issue a refund, including any applicable shipping
            fees.
        </p>
    </section>

    <section class="footer-section">
        <footer class="am">
            <div class="container">
                <div class="row">
                    <!-- First Section -->
                    <div class="col-lg-3 col-md-6 footer-logo-section">
                        <img src="<?= base_url('assets/images/footer-logo-new.png') ?>" alt="Footer Logo"
                            class="footer-logo">
                        <p>Shop premium products at Mnnchaha – Enjoy unbeatable prices, secure payments, and fast,
                            reliable delivery.</p>
                        <div class="social-icons">
                            <a href=""><img src="<?= base_url('assets/images/footer-fb.png') ?>" alt=""
                                    width="40px"></a>
                            <!-- <a href=""><img src="<?= base_url('assets/images/footer-twitter.png') ?>" alt="" width="40px"></a> -->
                            <!-- <a href=""><img src="<?= base_url('assets/images/footer-google.png') ?>" alt="" width="40px"></a> -->
                            <!-- <a href=""><img src="<?= base_url('assets/images/footer-youtube.png') ?>" alt="" width="40px"></a> -->

                        </div>
                    </div>

                    <!-- Second Section -->
                    <!-- ( changes-11/09/2024) -->
                    <div class=" col-md-5 footer-links-section">
                        <!-- --------------------- -->
                        <div class="row">
                            <div class="col-md-6">
                                <h4>Company</h4>
                                <ul>
                                    <li><a class="nav-link <?= (current_url() == base_url('welcome/index')) ? 'active-main-nav' : '' ?>"
                                            href="<?= base_url('welcome/index') ?>">Home</a></li>
                                    <li class="nav-item">
                                        <?php if($this->session->userdata('userToken')){?>
                                        <a class="nav-link" href="<?= base_url('Web/User/User/profile')?>">
                                            My Account
                                        </a>
                                        <?php }else{?>
                                        <a class="nav-link" href="<?= base_url('Welcome/loginpage')?>">
                                            Login
                                        </a>
                                        <?php }?>
                                    </li>
                                    <li> <a class="nav-link"
                                            href="<?= base_url('Web/User/User/wishlist') ?>">Wishlist</a></li>
                                    <li> <a class="nav-link" href="<?= base_url('Web/User/User/cart')?>">My Cart</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <h4>About Us</h4>
                                <ul>
                                    <li class="nav-item">
                                        <a class="nav-link <?= (current_url() == base_url('Web/Web/page/about')) ? 'active-main-nav' : '' ?>"
                                            href="<?= base_url('Web/Web/page/about') ?>">About Us</a>
                                    </li>
                                    <!-- <li><a href="">Blog</a></li> -->
                                    <li class="nav-item">
                                        <a class="nav-link <?= (current_url() == base_url('welcome/contact_us')) ? 'active-main-nav' : '' ?>"
                                            href="<?= base_url('welcome/contact_us') ?>">Contact Us</a>
                                    </li>
                                    <li><a href="<?= base_url('privacy')?>">Privacy Policy</a></li>
                                    <li><a href="<?= base_url('shipping')?>">Shipping & Returns</a></li>
                                </ul>
                            </div>
                            <!--  <div class="col-md-4">
									<h4>Useful Links</h4>
									<ul>
										<li><a href="">Contact Us</a></li>
										<li><a href="">Categories</a></li>
										<li><a href="">Boy Fashion</a></li>
										<li><a href="">Girl Fashion</a></li>
									</ul>
								</div> -->
                        </div>
                    </div>

                    <!-- Third Section -->
                    <div class="col-md-3  footer-contact-section">
                        <h4>Get In Touch</h4>
                        <ul>
                            <li class="d-flex"><img class="me-2"
                                    src="<?= base_url('assets/images/footer-location.png') ?>" alt="" width="40px"
                                    height="42px">
                                <div class="div">213 , Meghdoot signature . HDIL industrial business park . Chandansar road Virar East 401305 district Palghar , Maharashtra</div>
                            </li>
                            <li><img class="me-2" src="<?= base_url('assets/images/footer-call.png') ?>" alt=""
                                    width="40px"> Contact Us: +91 9920401329</li>
                            <li><img class="me-2" src="<?= base_url('assets/images/footer-mail.png') ?>" alt=""
                                    width="40px"> info@mnnchaha.com</li>
                        </ul>
                    </div>
                    <!-- ( changes-11/09/2024) -->
                    <a class="footer-scroll-up" href=""><img src="<?= base_url('assets/images/scroll-up.png') ?>"
                            alt="icon" width="48px"></a>
                    <!-- -------------------- -->
                </div>

                <div class="footer-bottom text-center">
                    <p>&copy; 2024 Manchaha. All Rights Reserved | Revised</p>
                </div>
            </div>
        </footer>

    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>