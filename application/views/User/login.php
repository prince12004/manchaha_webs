<!-- --------------nav-section-end------------ -->

<style>
.navbar,
.header-main,
.newsLetter-section,
.footer-section,
#profile-menu {
    display: none !important;
}

/* --------------------enter-otp------------ */
.otp-text-head {
    text-align: left;
    font-size: 20px;
    font-weight: 500;
}

.otp-container {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: 10px;
}

.otp-input {
    width: 50px !important;
    margin: 10px !important;
    height: 50px;
    text-align: center;
    font-size: 18px;
    margin: 0 5px;
    border: 1px solid #ddd;
    border-radius: 4px;
    /* -webkit-appearance: none; Remove default styling on iOS */
}

.otp-input:focus {
    outline: none;
    border-color: #007bff;
}



.modal {
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

.modal-content {
    background-color: white;
    padding: 30px;
    border-radius: 10px;
    text-align: center;
    max-width: 600px;
    width: 100%;
    margin: 20vh auto;
    position: relative
}

.closebutton {
    width: 45px;
    height: 45px;
    border-radius: 50%;
    background-color: #FFF;
    display: flex;
    justify-content: center;
    align-items: center;
    position: absolute;
    top: 10px;
    right: 10px;
    padding: 8px;
    border: none;
}

.closebutton span {
    color: #2563eb;
    font-size: 40px;
    font-weight: 600;

}

.close-btn {
    background-color: #3182ce;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
}

.modal-logo {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-bottom: 20px;
    /* Space between logo and the rest of the modal content */
}


.modal-logo img {
    max-width: 100%;
    /* Ensure the logo doesn't overflow */
    height: 100px;
}



.close-btn:hover {
    background-color: #2563eb;
}

button:disabled {
    opacity: 0.6;
    cursor: not-allowed;
}
</style>

</header>
<div class="main-page-section">
    <div class="main-content am">
        <h1>Login</h1>
        <h3><a href="<?= base_url('/')?>">Home</a> | Login</h3>
    </div>
</div>
<div class="login-container">
    <div class="image-section">
        <img src="<?= base_url('/assets/images/logimage.png') ?>" alt="Fashion Model">
    </div>
    <div class="form-sectionss p-5">
        <h2>Enter Your Email</h2>
        <h4>We will send you a one-time password to this Email</h4>
        <form id="loginForm">
            <label for="mobile">Email</label>
            <input type="text" id="mobile" name="mobile" placeholder="Enter Email" oninput="validateEmail()"
                value="<?= set_value('mobile') ?>" autofocus>

            <button id="req-otp-btn" class="req-otp-btn" type="button" onclick="showModal() ">Request OTP</button>
            <p>Login Using Mobile Number <a href="<?= base_url('mobileLogin')?>">Click Here</a></p>
            <a href="<?= base_url('GoogleLogin/login'); ?>">
    <img src="https://developers.google.com/identity/images/btn_google_signin_light_normal_web.png" />
</a>
            <p class="terms-section">By creating an account, you agree to our <br /> <a href="#">Terms of Service</a> &amp;
                <a href="#">Privacy Policy</a></p>
        </form>
        <div id="modal" class="modal" style="display: none;">
            <div class="modal-content">
                <!-- Logo in the center -->
                <div class="modal-logo">
                    <img src="<?= base_url('/assets/images/images/header-new-logo.png') ?>" alt="Logo">
                </div>
                <form id="otpForm">
                    <h4 class="otp-text-head mt-4 mb-0">Enter Otp here..</h4>
                    <div class="otp-container">
                        <input type="text" maxlength="1" name="otp1" class="otp-input" id="otp1"
                            oninput="moveToNext(this, 'otp2')" onkeydown="moveToPrevious(event, 'otp2')">
                        <input type="text" maxlength="1" name="otp2" class="otp-input" id="otp2"
                            oninput="moveToNext(this, 'otp3')" onkeydown="moveToPrevious(event, 'otp1')">
                        <input type="text" maxlength="1" name="otp3" class="otp-input" id="otp3"
                            oninput="moveToNext(this, 'otp4')" onkeydown="moveToPrevious(event, 'otp2')">
                        <input type="text" maxlength="1" name="otp4" class="otp-input" id="otp4"
                            oninput="moveToNext(this, 'otp5')" onkeydown="moveToPrevious(event, 'otp3')">
                        <input type="text" maxlength="1" name="otp5" class="otp-input" id="otp5"
                            oninput="moveToNext(this, 'otp6')" onkeydown="moveToPrevious(event, 'otp4')">
                        <input type="text" maxlength="1" name="otp6" class="otp-input" id="otp6"
                            onkeydown="moveToPrevious(event, 'otp5')">
                    </div>


                    <button class="btn  d-block close-btn" type="button" onclick="submitOTP()">Submit</button>
                    <button type="button" class="btn btn-link" id="resendLink">Otp not recieved? resend Otp</button>
                    <p id="timer">Click "Trigger Event" to start the timer</p>
                    <p class="terms-section">By creating an account, you agree to our <br /> <a href="#">Terms of
                            Service</a> &amp; <a href="#">Privacy Policy</a></p>
                    <button class="closebutton" onclick="closeModal()">
                        <img class="" src="<?= base_url('assets/images/cancel-cross.png') ?>" alt="cancel" width="35px"
                            height="35px">
                    </button>
            </div>
        </div>


        </form>
        <div id="successModal" class="modal" style="display: none;">
            <div class="modal-content">
                <!-- Logo in the center -->
                <div class="modal-logo">
                    <img src="<?= base_url('/assets/images/images/header-new-logo.png') ?>" alt="Logo">
                </div>
                <h2>OTP successfull !!!</h2>
                <h2>WELCOME TO MNNCHAHA</h2>
                <!-- <button class="close-btn" onclick="closeModal()">Close</button> -->
            </div>
        </div>
        <div id="errorModal" class="modal" style="display: none;">
            <div class="modal-content">
                <!-- Logo in the center -->
                <div class="modal-logo">
                    <img src="<?= base_url('/assets/images/images/header-new-logo.png') ?>" alt="Logo">
                </div>
                <h2 id="errorResponse"></h2>
                <button class="close-btn" onclick="closeErrorModal()">Close</button>
            </div>
        </div>
    </div>
</div>


<!-- =============================newsLetter-section====================== -->

<?php $this->load->view('User/footer') ?>




<!-- ====================Deals of the day Ends============================ -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
document.getElementById('resendLink').addEventListener('click', function() {
    document.getElementById('req-otp-btn').click();
});




function validateEmail() {
    const emailInput = document.getElementById('mobile');
    const button = document.getElementById('req-otp-btn');
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // Email validation regex

    // Enable or disable button based on email validity
    button.disabled = !emailPattern.test(emailInput.value);
}

// Ensure the button starts disabled on page load
document.addEventListener("DOMContentLoaded", () => {
    const button = document.getElementById('req-otp-btn');
    button.disabled = true; // Button is disabled by default
});



function closeModal() {
    event.preventDefault();
    const modal = document.getElementById('modal');
    modal.style.display = 'none';
}

function showsuccessModal() {
    event.preventDefault();
    const modal = document.getElementById('successModal');
    modal.style.display = 'block';
}

// Function to close the modal
function closesuccessModal() {
    event.preventDefault();
    const modal = document.getElementById('successModal');
    modal.style.display = 'none';
}

function showErrorModal() {
    event.preventDefault();
    const modal = document.getElementById('errorModal');
    modal.style.display = 'block';
}

// Function to close the modal
function closeErrorModal() {
    event.preventDefault();
    const modal = document.getElementById('errorModal');
    modal.style.display = 'none';
}



// Function to show the modal
function showModal() {
    const mobile = document.getElementById('mobile').value;

    $.ajax({
        url: '<?= base_url('auth') ?>',
        type: 'POST',
        data: {
            mobile: mobile
        },
        success: function(response) {
            res = JSON.parse(response)
            if (res.status === 'success') {
                const modal = document.getElementById('modal');
                modal.style.display = 'block';
                startTimer();
            } else {
                alert(res.message);
            }
        },
        error: function(xhr, status, error) {
            console.error('Error Updating Details:', error);
            $("#errorResponse").html("An error occurred while saving the details.");
            showErrorModal();
        }
    });



}




let interval; // To store the interval reference
const timerDisplay = $("#timer");
const reqOtpBtn = $("#req-otp-btn");
const resendLink = $("#resendLink");

// Timer function
function startTimer() {
    let timer = 60; // Reset the timer to 60 seconds

    // Disable the buttons
    reqOtpBtn.prop("disabled", true);
    resendLink.prop("disabled", true);

    // Clear any existing interval to avoid multiple instances
    clearInterval(interval);

    // Start a new interval
    interval = setInterval(() => {
        timer--;
        timerDisplay.text(`resend Otp after ${timer} sec`);

        if (timer <= 0) {
            clearInterval(interval);
            // timerDisplay.text("You can now request or resend OTP.");
            reqOtpBtn.prop("disabled", false);
            resendLink.prop("disabled", false);
        }
    }, 1000);
}






function moveToNext(current, nextId) {
    // Allow only numeric input and move to the next field
    if (current.value.length === 1 && !isNaN(current.value)) {
        document.getElementById(nextId).focus();
    } else if (current.value.length > 1) {
        current.value = current.value.slice(0, 1); // Keep only the first character if multiple digits are entered
    }
}

function moveToPrevious(event, previousId) {
    if (event.key === 'Backspace') {
        const currentField = event.target;
        if (currentField.value === '') {
            document.getElementById(previousId).focus();
        }
    }
}

function submitOTP() {
    const formElement = document.getElementById('otpForm');
    const formData = new FormData(formElement);
    let mobile = document.getElementById('mobile').value
    formData.append('mobile', mobile);

    $.ajax({
        url: '<?= base_url('verifyOTP') ?>', // Your endpoint
        type: 'POST',
        data: formData, // Send the FormData object
        contentType: false, // Let jQuery handle the content type
        processData: false, // Let jQuery handle the process data
        success: function(response) {
            try {
                // Assuming the server responds with a JSON string
                const parsedResponse = JSON.parse(response); // Parse the JSON response

                if (parsedResponse.status === 'success') {
                    // Optionally close the modal or redirect the user
                    // For modal, hide it (example):
                    closeModal();
                    // alert('OTP successfull');
                    showsuccessModal();
                    setTimeout(() => {
                        window.location.href = decodeURIComponent(parsedResponse.redirect);

                    }, 2000);
                } else if (parsedResponse.status === 'wrong') {
                    $("#errorResponse").html(parsedResponse.message);
                    showErrorModal();
                } else {
                    $("#errorResponse").html("Something Went Wrong!! TRY AGAIN");
                    showErrorModal();
                }
            } catch (error) {
                console.error('Error parsing response:', error);
                $("#errorResponse").html("An error occurred while processing the response.");
                showErrorModal();
            }
        },
        error: function(xhr, status, error) {
            console.error('Error Updating Details:', error);
            $("#errorResponse").html("An error occurred while saving the details.");
            showErrorModal();
        }
    });
}
</script>

</body>

</html>