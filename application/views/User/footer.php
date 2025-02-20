<style>
.alertModal .Modal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    /* Semi-transparent background */
    display: none;
    justify-content: center;
    align-items: center;
    z-index: 9999;
    /* Ensure the modal is on top of all other content */
}

.alertModal .modal-content {
    background-color: white;
    padding: 30px;
    border-radius: 10px;
    text-align: center;
    max-width: 400px;
    width: 100%;
    margin: 20vh auto;
    color: #000
}

.alertModal .modal-content h2 {
    font-size: 20px;
}

.alertModal .modal-logo {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-bottom: 20px;
    /* Space between logo and the rest of the modal content */
}

.alertModal .modal-logo img {
    max-width: 100%;
    /* Ensure the logo doesn't overflow */
    height: 100px;
}

.alertModal .close-btn {
    background-color: #3182ce;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
}

.alertModal .close-btn:hover {
    background-color: #2563eb;
}

.services-contents {
    display: contents;
}

.services-section .service-card h3 {
    color: black;
}

.footer-logo-section p {
    color: #FFFFFF;
}
</style>

<div id="bottom-section" class="bottom-section">
    <section id="newsLetter-section" class="newsLetter-section mb-3">
        <div class="newsLetter-content am d-flex justify-content-between align-content-center">
            <div class="left">
                <img class="newsletter-light" src="<?= base_url('assets/images/address-card-icon-light.png') ?>" alt="">
                <h3>NEWSLETTER</h3>
                <p>Subscribe To Newsletter To Stay Up To Date On Our Latest News</p>
                <div class="input-section">
                    <img src="<?= base_url('assets/images/envolope.png') ?>" alt="" width="20px">
                    <input type="email" id="newsletteremail" placeholder="Enter your Email..."
                        oninput="validateEmail()">
                    <button id="subscribeBtn" class="btn " onclick="subscribeNews()"> Subscribe</button>
                </div>
                <div class="appstore-div d-flex">
                    <h2>GET STARTED WITH MOBILE APP!</h2>
                    <div class="d-flex align-items-center gap-1 mt-1">
                        <a href="" class="btn btn-dark"><img src="<?= base_url('assets/images/appstorebtn.png') ?>"
                                alt=""></a>
                        <a href="" class="btn btn-ios"><img src="<?= base_url('/uploads/1733076311_651.png') ?>"
                                alt=""></a>
                    </div>

                </div>
            </div>

            <div class="right d-flex justify-content-end">
                <img class="newletter-main" src="<?= base_url('assets/images/newsLetterImg.png') ?>" alt="">
                <img class="newletter-responsive" src="<?= base_url('assets/images/newsLetterImg-responsive.png') ?>"
                    alt="">
            </div>
        </div>
    </section>
    <!-- ---------------------------- -->
    <section class="services-section am d-flex flex-wrap">
        <a href="<?= base_url('freedelivery') ?>" class="service-card">
            <div class="services-contents">
                <img src="<?= base_url('assets/images/freeDelivery.png') ?>" alt="" width="90px">
                <h3>Free Delivery</h3>
                <p class="para-A">Enjoy free shipping on all orders, no minimum required.</p>

            </div>
            <a href="<?= base_url('returnpolicy') ?>" class="service-card">
                <div class="services-contents">
                    <img src="<?= base_url('assets/images/returnPolicy.png') ?>" alt="" width="90px">
                    <h3>Return Policy</h3>
                    <p class="para-A"> Hassle-free returns within 3 days, easy refund process.</p>

                </div>
            </a>
            <a href="<?= base_url('welcome/contact_us') ?>" class="service-card">
                <div class="services-contents">
                    <img src="<?= base_url('assets/images/support24.png') ?>" alt="" width="90px">
                    <h3>24/7 Support</h3>
                    <p class="para-A">Our support team is available 24/7 for assistance.</p>
                    </p>

                </div>
                <a href="<?= base_url('securepayment') ?>" class="service-card">
                    <div class="services-contents">
                        <img src="<?= base_url('assets/images/securePymnt.png') ?>" alt="" width="90px">
                        <h3>Secure Payment</h3>
                        <p class="para-A">Safe and secure payment methods to protect your transactions.</p>

                    </div>
                </a>
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
        <div id="alertModalA" class="modal" style="display: none;">
            <div class="modal-content">
                <!-- Logo in the center -->
                <div class="modal-logo">
                    <img src="<?= base_url('/assets/images/images/header-new-logo.png') ?>" alt="Logo">
                </div>
                <h2 id="alertResponseA">You have been subscribed!</h2>
                <button class="close-btn" onclick="closeAlertModalA()">Close</button>
            </div>
        </div>
        <div id="alertModalB" class="modal alertModal" style="display: none;">
            <div class="modal-content">
                <!-- Logo in the center -->
                <div class="modal-logo">
                    <img src="<?= base_url('/assets/images/images/header-new-logo.png') ?>" alt="Logo">
                </div>
                <h2 id="alertResponseB">An error occurred. Please try again.</h2>
                <button class="close-btn" onclick="closeAlertModalB()">Close</button>
            </div>
        </div>

    </section>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
function validateEmail() {
    const emailInput = document.getElementById('newsletteremail');
    const button = document.getElementById('subscribeBtn');
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // Email validation regex

    // Enable or disable button based on email validity
    button.disabled = !emailPattern.test(emailInput.value);
}

// Ensure the button starts disabled on page load
document.addEventListener("DOMContentLoaded", () => {
    const button = document.getElementById('subscribeBtn');
    button.disabled = true; // Button is disabled by default
});


function alertModalB() {
    event.preventDefault();
    const modal = document.getElementById('alertModalB');
    modal.style.display = 'block';
}

// Function to close the modal
function closeAlertModalB() {
    event.preventDefault();
    const modal = document.getElementById('alertModalB');
    modal.style.display = 'none';
}

function alertModalA() {
    event.preventDefault();
    const modal = document.getElementById('alertModalA');
    modal.style.display = 'block';
}

// Function to close the modal
function closeAlertModalA() {
    event.preventDefault();
    const modal = document.getElementById('alertModalA');
    modal.style.display = 'none';
}


function subscribeNews() {
    let newsemail = document.getElementById('newsletteremail').value; // Use .value to get input text
    $.ajax({
        url: '<?= base_url('subscribeEmail') ?>',
        type: 'POST',
        contentType: 'application/json',
        data: JSON.stringify({
            email: newsemail
        }), // Corrected 'email' key
        success: function(response) {
            if (typeof response !== 'object') {
                response = JSON.parse(response);
            }

            if (response.status === 'success') {
                // alert('You have been subscribed!');
                // document.getElementById('alertResponse').innerHTML="You have been subscribed!";
                alertModalA();
            } else {
                // alert(response.message || 'An error occurred. Please try again.');
                alertModalB();
            }
        },
        error: function(xhr, status, error) {
            console.error('Error during request:', xhr.responseText);
        }
    });
}
</script>