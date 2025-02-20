
<!-- --------------nav-section-end------------ -->

</header>
<div class="main-page-section">
    <div class="main-content am">
        <h1>Contact</h1>
        <h3><a href="<?= base_url('welcome/index') ?>">Home</a> | Contact</h3>
    </div>
</div>
<div class="contact-container am">
    <div class="containerA">
        <div class="left-container">
            <div class="left-images">
                <img src="<?= base_url('assets/images/Group157894.png') ?>" alt="" />
            </div>
        </div>

        <div class="right-container">
            <div class="contact-form-container-new">
                <div class="contact-form">
                    <h1>Let’s Connect!</h1>
                    <p>Have questions? We’re here to help.</p>
                    <form>
                        <?php
                    if(validation_errors()){
                      print_r(validation_errors());
                    }
                    ?>
                        <div class="form-group">
                            <label for="full-name">Full Name</label>
                            <div class="input-container">
                                <input type="text" id="full_name" class="input-with-icon"
                                    placeholder="Enter your full name" name="full_name"
                                    value="<?= set_value('full_name') ?>" required />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="phone-number">Your Phone No.</label>
                            <div class="input-container">
                                <input type="text" id="phone_number" class="input-with-icon"
                                    placeholder="Enter your phone number" name="phone_number"
                                    value="<?= set_value('phone_number') ?>" required />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email">Your Email Address</label>
                            <div class="input-container">
                                <input type="email" id="email" class="input-with-icon" placeholder="Enter your mail"
                                    name="email" value="<?= set_value('email') ?>" required />

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="message">Type Your Message</label>
                            <div class="input-container">
                                <input type="text" id="message" class="input-with-icon" placeholder="Enter your message"
                                    name="message" value="<?= set_value('message') ?>" required />
                            </div>
                        </div>
                        <button type="submit" class="submit-btn" id="submit_form">Submit Now</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <div class="get-touch">
        <div class="ddd">
            <div class="get-content">
                <h1>Get in touch us <span class="status-dot-new"></span></h1>
                <p></p>
            </div>
        </div>

        <div class="main-cards">
            <div class="card-one">
                <div class="icon-gets">
                    <img src="<?= base_url('assets/images/map.png') ?>" alt="" />
                </div>
                <h2 class="title">Location:</h2>
                <p class="description">
                   213 , Meghdoot signature . HDIL industrial business park . Chandansar road Virar East 401305 district Palghar , Maharashtra
                </p>
            </div>

            <div class="card-two">
                <div class="icon-gets">
                    <img src="<?= base_url('assets/images/Group2741.png') ?>" alt="" />
                </div>
                <h2 class="title">Email</h2>
                <p class="description">info@mnnchaha.com</p>
            </div>

            <div class="card-three">
                <div class="icon-gets">
                    <img src="<?= base_url('assets/images/CALL1.png') ?>" alt="" />
                </div>
                <h2 class="title">Phone:</h2>
                <p class="description">Phone: +91 9920401329</p>
            </div>
        </div>
    </div>
</div>




<!-- =============================newsLetter-section====================== -->

<?php $this->load->view('User/footer') ?>



<!-- ====================Deals of the day Ends============================ -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
$(document).ready(function() {
    $('#submit_form').click(function(e) {
        e.preventDefault();
        var full_name = $('#full_name').val();
        var phone_number = $('#phone_number').val();
        var email = $('#email').val();
        var message = $('#message').val();
        console.log(full_name);
        console.log(phone_number);
        $.ajax({
            url: "<?= base_url('Welcome/contact'); ?>",
            type: "POST",
            data: {
                full_name: full_name,
                phone_number: phone_number,
                email: email,
                message: message
            },
            success: function(response) {
                var res = JSON.parse(response);
                alert(res.message);
            },
            error: function(xhr, status, error) {
                alert('Something Went wrong!');
                console.error(error);
            }
        });
    });
});
</script>

</body>

</html>