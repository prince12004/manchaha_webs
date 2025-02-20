<?php $this->load->view('User/header') ?>
<style>
.images-contaimner {
    width: 100%;
    display: flex;
    justify-content: center;
    margin: 0px auto;
    position: relative;
}
.mains-fields{
    background-color: #FFFFFF;
    border-radius: 10px;
    padding: 20px 30px;
    margin: 40px auto;
    box-shadow: 0px 15px 35px 0px #0000000F;
    width: 30%;
}
.input-fields{
    display: flex;
    flex-direction: column;
    gap: 12px;
}
.input-fields label{
    font-size: 22px;
    font-weight: 600;
    margin: 0px;
}
.input-fields input{
    width: 100%;
    border: 1px solid #ccc;
    padding: 10px 20px;
    border-radius: 5px;
    font-size: 16px;
    color: black;
}
.submit{
    background-color: #007bff;
    color: #FFFFFF;
    border: 1px solid #007bff;
    padding: 9px 20px;
    border-radius: 5px;
    margin: 10px 0px;
    /* width: 100px; */
}
.button-ok{
    background-color: #007bff;
    color: #FFFFFF;
    border: 1px solid #007bff;
    padding: 5px 12px;
    border-radius: 50px;
    margin: 10px 0px;
    display: flex;
    justify-content: center;
    width: 80px;
    font-size: 20px;
    margin: 0px auto;
}
.mains-ok{
    display: flex;
    justify-content: center;
}
/* Modal styles */
.modal {
    display: none; 
    position: fixed; 
    z-index: 1; 
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgb(0,0,0); 
    background-color: rgba(0,0,0,0.4);
    padding-top: 60px;
}
.modal-content {
    background-color: #fefefe;
    margin: 5% auto;
    padding: 20px;
    display: flex;
    justify-content: center;
    border: 1px solid #888;
    width: 80%;
    max-width: 400px;
    border-radius: 10px;
    font-size: 17px;
    font-weight: 500;
    text-align: center;
}
.close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}
.close:hover,
.close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}
.error-message {
    color: red;
    font-size: 14px;
    margin-top: 5px;
}
</style>

<section class="main-deletes">
    <div class="main-content">
        <div class="images-contaimner">
          <div class="mains-fields">
            <div class="input-fields">
                <label>Delete Account Request </label>
                <div>
                <input type="text" placeholder="Enter your e-mail" id="email-input">
                <div id="email-error" class="error-message"></div>
</div>
                <button type="button" class="submit" id="submit-btn">Submit</button>

            </div>
          </div>
        </div>
    </div>
</section>

<!-- Modal -->
<div id="myModal" class="modal">
  <div class="modal-content">
    <p>Delete account request is under process and you will be updated over your email.</p>
     <button type="button" class="button-ok" id="ok-btn">Ok</button>
  </div>
</div>

<?php $this->load->view('User/footer') ?>

<!-- Scripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

<script>
$(document).ready(function() {
    // Get the modal
    var modal = $('#myModal');

    // Get the button that opens the modal
    var btn = $('#submit-btn');

    // Get the <span> element that closes the modal
    var okBtn = $('#ok-btn'); // 'Ok' button inside modal

    // Email validation regular expression
    var emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

    // When the user clicks the button, open the modal if email is valid
    btn.click(function() {
        var email = $('#email-input').val();
        
        // Clear any previous error message
        $('#email-error').text('');
        
        // Validate email
        if (email === '') {
            $('#email-error').text('Please enter an email address.');
        } else if (!emailRegex.test(email)) {
            $('#email-error').text('Please enter a valid email address.');
        } else {
            modal.show(); // Show the modal
        }
    });

    // When the user clicks the "Ok" button, close the modal
    okBtn.click(function() {
        modal.hide(); // Hide the modal
    });

    // // When the user clicks anywhere outside of the modal, close it
    // $(window).click(function(event) {
    //     if (event.target == modal[0]) {
    //         modal.hide();
    //     }
    // });
});
</script>
