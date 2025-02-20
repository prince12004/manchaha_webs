<?php $this->load->view('User/header') ?>
<!-- --------------nav-section-end------------ -->
<style>
#alertModal {
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

#alertModal .modal-content {
    background-color: white;
    padding: 30px;
    border-radius: 10px;
    text-align: center;
    max-width: 400px;
    width: 100%;
    margin: 20vh auto
}

.modal-content h2 {
    font-size: 20px;
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

.close-btn {
    background-color: #3182ce;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
}

.close-btn:hover {
    background-color: #2563eb;
}

.eye-icon span {
    font-size: 17px !important;
    color: #666 !important;
}

.error-message {
    color: red;
    font-size: 13px
}

.adddress-button {
    display: flex;
    justify-content: end;
}

@media (max-width: 768px) {
    #alertModal {
        margin: 10px;
    }
}

/* General Modal Styles */
.payment-cancel-modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    /* Semi-transparent background */
    z-index: 1000;
    display: flex;
    justify-content: center !important;
    align-items: center !important;
    text-align: center;
}

.payment-cancel-modal-content {
    background-color: #fff;
    border-radius: 8px;
    padding: 20px;
    text-align: center;
    max-width: 400px;
    width: 100%;
    /* Ensure modal content doesn't overflow */
    box-sizing: border-box;
    position: relative;
}

.payment-cancel-logo img {
    width: 240px;
    /* Adjust logo size */
    margin-bottom: 20px;
}

.payment-cancel-modal h2 {
    font-size: 22px;
    font-weight: 500;
    color: black;
    margin-bottom: 20px;
    font-family: Arial, sans-serif;
}

.payment-cancel-close-btn {
    background-color: #ff5733;
    /* Close button color */
    color: white;
    border: none;
    padding: 10px 20px;
    font-size: 16px;
    border-radius: 5px;
    cursor: pointer;
    position: absolute;
    bottom: 20px;
    left: 50%;
    transform: translateX(-50%);
}

.payment-cancel-close-btn:hover {
    background-color: #e04e27;
}

#errorModal h2 {
    color: red;
}

.payment-cancel-modal {
    animation: fadeIn 0.3s ease-in-out;
}

.place-order {
    padding: 10px 20px;
    width: 100%;
    background-color: #007bff;
    color: #FFFFFF;
    font-size: 15px;
    font-weight: 500;
    border: 1px solid #007bff;
    border-radius: 5px;
}

@media (max-width: 768px) {
    .payment-cancel-modal {
        margin: 10px;
    }
}
</style>
<?php
$states = $this->db->select('states.*')->from('states')->where('states.is_active',1)->get()->result_array();
?>
</header>
<div class="main payment-address-page d-flex am">
    <div class="address-container col-md-7 mt-5">
        <div class="d-flex justify-content-between">
            <div>
                <h2 class="mb-1">Shipping Address</h2>
                <!-- <p>Lorem Ipsum is simply dummy text of the printing.</p> -->
            </div>
            <div class="d-flex justify-content-between align-items-center mb-4 me-5">
                <button id="addNewBtn" class="btn btn-light">+ ADD NEW</button>
            </div>
        </div>

        <div id="addressContainer" class="row d-flex g-3">
            <!-- Existing address cards (if any) -->
            <div class="col-md-12 d-flex justify-content-between flex-wrap g-3">
                <?php if(!empty($productdetails['addresses'])){ ?>
                <?php foreach($productdetails['addresses'] as $address){ ?>
                <div class="address-card">
                    <input type="radio" oninput="selectAddress('<?= $address['id']?>','<?= $address['phone']?>','<?= $address['state']?>')"
                        name="selectedAddress" class="select-address radio-inp">
                    <div class="d-flex gap-2">
                        <div class="icon">
                            <img src="<?= base_url('assets/images/address-card-icon.png')?>" alt="">
                        </div>
                        <label>
                            <h5 class="address-name">Home Address</h5>
                            <p class="address-street"><?= $address['streetAddress'] ?></p>
                            <p class="address-city"><?= $address['city']." ".$address['pincode'] ?></p>
                            <p><strong class="address-phone">+91 <?= $address['phone'] ?></strong></p>
                            <p class="address-email"><?= $address['email'] ?></p>
                        </label>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button"
                            id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="<?= base_url('assets/images/three-dots.png')?>" alt="menu">
                        </button>
                        <!-- <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <li><a class="dropdown-item edit-option" href="#">Edit</a></li>
                            <li><a class="dropdown-item delete-option" href="#">Delete</a></li>
                        </ul> -->

                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <li><button class="dropdown-item edit-option"
                                                onclick="editAddress('<?= $address['id']?>')">Edit</button></li>
                                        <li><button class="dropdown-item"
                                                onclick="deleteAddress('<?= $address['id']?>')">Delete</button></li>
                                    </ul>
                    </div>
                </div>
                <?php }?>
                <?php }?>

                <!-- Delete Confirmation Modal -->
                <div class="modal fade" id="deleteConfirmationModal" tabindex="-1"
                    aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteConfirmationModalLabel">Delete Address</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Do you want to delete this address?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- Additional cards will be added here -->
        </div>
    </div>
    <div class="payment-container col-md-4">
        <?php 
$subtotal = 0;  // Initialize the subtotal variable
$tax = 0
?>


        <div class="product-title">Product</div>
        <div class="product-description">Product details</div>
        <?php foreach ($productdetails['product'] as $product) { ?>
        <div class="product-item d-flex">
            <img src="<?= base_url('uploads/products/').$product['image']?>" alt="Product Image">
            <div class="product-info">
                <h5>
                    <?= strlen(($product['jwellary_name'])) > 30 ? substr($product['jwellary_name'], 0, strpos($product['jwellary_name'], ' ', 30)) . '...' : $product['jwellary_name']; ?>
                </h5>
                <p>
                    <?= strlen(($product['jwellary_description'])) > 70 ? substr($product['jwellary_description'], 0, strpos($product['jwellary_description'], ' ', 80)) . '...' : $product['jwellary_description']; ?>
                <p><strong>Size :</strong> <?= $product['sizing']?> / <strong>Quantity : </strong><?= $product['quantity']?></p>
                <div class="product-price">
                    <?= number_format($product['sale_price'], 2) ?> &#8377;
                </div>
            </div>
        </div>

        <?php 
    $subtotal += $product['sale_price'] * $product['quantity']; 
	$tax+= ($product['sale_price']*$product['applicable_tax']*$product['quantity'])/100;
																
    ?>
	
        <?php } ?>


        <div class="order-summary">

            <div class="row">
                <div class="col">
                    <span>Subtotal</span>
                    <span> <strong> <?= number_format($subtotal, 2) ?> &#8377;</strong></span>
                </div>
            </div>
            <div class="row">
                <div class="col" id="igst" style="display: flex;">
                    <span>IGST</span>
			
                    <span> <strong>+ <?= ($tax) ?></strong> </span>
					
                </div>
				     <div class="col" id="cgst" style="display: none; ">
                   <span style="display: flex; justify-content: space-between;">
					    <span>CGST</span>
				
                    <span> <strong>+ <?= round(($tax/2),2) ?></strong> </span>
						 </span>
		<span style="display: flex; justify-content: space-between;">
							 <span>SGST</span>
					<span>  <strong>+ <?= round(($tax/2),2) ?></strong> </span>
						 </span>
					
                </div>
				
				
            </div>
            <div class="row" id="codChages" style="display: none;">
                <div class="col">
                    <span>COD Charges</span>
                    <span><strong>+ 40</strong> </span>
                </div>
            </div>
            <div class="row"  id="ship_cost">
                <div class="col">
                    <span>Shipping Cost</span>
                    <span><strong>Free</strong> </span>
                </div>
            </div>
            <div class="row total">
                <div class="col">
                    <span>Total:</span>
                    <div >
                         <strong style="display: flex; gap: 4px;">
                        <div id="totall"><?= number_format($total = $subtotal+$gst+$tax, 2) ?></div>
                     <!-- <div id="totall"><?= number_format(round($subtotal + $gst + $tax, 2), 2, '.', '') ?></div> -->

                <div>    &#8377; </div>
                </strong></div>
                </div>
            </div>
        </div>

        <form id="paymentForm">
            <label>
                
                <input type="radio" name="paymentMethod" onclick="checkCod(true)" id="codRadio" value="cod">
                COD (₹40 Extra)
            </label>
            <br>
            <label>
                
                <input type="radio" name="paymentMethod" onclick="checkCod(false)" id="onlineRadio" value="online">
                Pay Online
            </label>
            <br><br>
            <button type="button" class="place-order" onclick="placeOrder()">Place Order</button>
        </form>


    </div>
</div>

<!-- Add New Address Modal -->
<div class="modal fade" id="addAddressModal" tabindex="-1" aria-labelledby="addAddressModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addAddressModalLabel">Add New Address</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addressForm">
                    <div class="mb-3">
                        <label for="fullName" class="form-label">Full Name</label>
                        <input type="text" name="name" class="form-control text-only" id="fullName_add" required>
                        <small class="error-message text-danger"></small>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" name="phone" class="form-control numbers-only" id="phone_add" required>
                            <small class="error-message text-danger"></small>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Email ID</label>
                            <input type="email" name="email" class="form-control email" id="email_add" required>
                            <small class="error-message text-danger"></small>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="city" class="form-label">Town / City</label>
                            <input type="text" name="city" class="form-control text-only" id="city_add" required>
                            <small class="error-message text-danger"></small>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="apartment" class="form-label">Apartment, suite, etc. (optional)</label>
                            <input type="text" name="apartment" class="form-control" id="apartment_add">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="postcode" class="form-label">Post Code</label>
                            <input type="text" name="pincode" class="form-control" id="postcode_add" required>
                            <small class="error-message text-danger"></small>
                        </div>
                        <div class="col-md-6 mb-3">
                    	<div style="flex-direction: column; display: flex;">
                           <label for="postcode" class="form-label">State</label>
                            <select class="modal-state" name="state" id="state_add" required >
								<option value="">Select Status</option>
								<?php foreach($states as $state){?>
                                <option value="<?= $state['name']?>"><?= $state['name']?></option>
								<?php }?>
                                
                            </select>
        </div>
                            <small class="error-message text-danger"></small>
                        </div>
                    </div>
                    <div class="mb-3">
			  <label for="street" class="form-label">Street address *</label>
                                        <input type="text" name="streetAddress" class="form-control" id="street"
                                            required>
                        <small class="error-message text-danger"></small>
                    </div>
                    <div class="adddress-button">
                        <button type="button" onclick="saveAddress()"
                            class="btn btn-dark d-flex align-items-center gap-2" disabled id="submitButton">
                            <img src="images/white-tick.png" alt=""> Save New Address
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="editAddressModal" tabindex="-1" aria-labelledby="addAddressModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addAddressModalLabel">Update  Address</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="updateAddressForm">
                                    <p id="addId" style="display: none; position:absolute"></p>
                                    <div class="mb-3">
                                        <label for="fullName" class="form-label">Full Name</label>
                                        <input type="text" name="name" class="form-control text-only" id="fullName"
                                            required>
                                        <small class="error-message text-danger"></small>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="phone" class="form-label">Phone</label>
                                            <input type="text" name="phone" class="form-control numbers-only" id="phone"
                                                required>
                                            <small class="error-message text-danger"></small>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="email" class="form-label">Email ID</label>
                                            <input type="email" name="email" class="form-control email" id="emails"
                                                required>
                                            <small class="error-message text-danger"></small>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="city" class="form-label">Town / City</label>
                                            <input type="text" name="city" class="form-control text-only" id="citys"
                                                required>
                                            <small class="error-message text-danger"></small>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="apartment" class="form-label">Apartment, suite, etc.
                                                (optional)</label>
                                            <input type="text" name="apartment" class="form-control" id="apartment">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="postcode" class="form-label">Post Code</label>
                                            <input type="text" name="pincode" class="form-control" id="postcode"
                                                required>
                                            <small class="error-message text-danger"></small>
                                        </div>
                                        <div class="col-md-6 mb-3">
											                             <div style="flex-direction: column; display: flex;">
                           <label for="postcode" class="form-label">State</label>
                            <select class="modal-state" name="state" id="state" >
                                <option>Select State</option>
								<?php foreach($states as $state){?>
                                <option <?= $state['name']?>><?= $state['name']?></option>
								<?php }?>
                              
                            </select> 
        </div>
                                            <small class="error-message text-danger"></small>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="street" class="form-label">Street address *</label>
                                        <input type="text" name="streetAddress" class="form-control" id="street"
                                            required>
                                        <small class="error-message text-danger"></small>
                                    </div>
                                    <div class="update-address">
                                        <button type="button" onclick="updateAddress()"
                                            class="btn btn-dark d-flex align-items-center gap-2">
                                            <img src="images/white-tick.png" alt=""> Update Address
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


<div id="alertModal" class="modal" style="display: none;">
    <div class="modal-content">
        <!-- Logo in the center -->
        <div class="modal-logo">
            <img src="<?= base_url('/assets/images/images/header-new-logo.png') ?>" alt="Logo">
        </div>
        <h2 id="alertResponse"></h2>
        <button class="close-btn" onclick="closeAlertModal()">Close</button>
    </div>
</div>


<div id="paymentCancelModal" class="payment-cancel-modal" style="display: none;">
    <div class="payment-cancel-modal-content">
        <!-- Logo in the center -->
        <div class="payment-cancel-logo">
            <img src="<?= base_url('/assets/images/images/header-new-logo.png') ?>" alt="Logo">
        </div>
        <h2>Payment Cancelled</h2>
    </div>
</div>


<script src="https://checkout.razorpay.com/v1/checkout.js"></script>





<!-- =============================newsLetter-section====================== -->

<?php $this->load->view('User/footer') ?>


<!-- ====================Deals of the day Ends============================ -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


<script>
let selectedAddress = 0;
let payment_type = 'COD';
const codharge = 40;
let total = <?= $total?>;
let payment_id = 0;
let signature = ' ';
//let order_id = Math.random(100000,999999)+time();


// Razorpay options
var options = {
    "key": "rzp_live_wCfwLMvANxj9jD",
    "amount": Math.round(total * 100),
    "currency": "INR",
    "name": "MNNCHAHA",
    "image": "https://mnnchaha.com/assets/images/header-new-logo.png",
    "handler": function(response) {
        console.log(response);
        payment_type = 'Prepaid';
        payment_id = response.razorpay_payment_id;
        signature = response.razorpay_signature;
        //payment_type = 'Prepaid';
        payNow();
    },
    "prefill": {
        "contact": phone 
    },
    "theme": {
        "color": "#3399cc"
    }
};

var rzp1 = new Razorpay(options); // Initialize Razorpay

// Razorpay button click event
// document.getElementById('rzp-button1').onclick = function(e) {
//     if (selectedAddress <= 0) {
//         document.getElementById('alertResponse').innerHTML = 'Please select a delivery address';
//         alertModal();
//         return;
//     }
//     rzp1.open();
//     e.preventDefault();
// };
//  function checkCod(isCod){
//     if (isCod) {
//         document.getElementById('codChages').style.display = 'block';
//         document.getElementById('totall').innerText = total+codharge;
//         total = total+codharge
        
//     }else{
//         document.getElementById('codChages').style.display = 'none';
//         document.getElementById('totall').innerText = <?= $total?>;
//         total = <?= $total?>;
//     }
//  }


function checkCod(isCod){
    let total = <?= $total ?>; // Get the total from PHP

if (isCod) {
    document.getElementById('codChages').style.display = 'block';
    document.getElementById('ship_cost').style.display = 'none';
    total += codharge;
} else {
    document.getElementById('codChages').style.display = 'none';
    document.getElementById('ship_cost').style.display = 'block';
}

document.getElementById('totall').innerText = '₹ ' + total.toFixed(2);
 }
// Place Order Function
function placeOrder() {
    // Get the selected payment method
    const selectedPaymentMethod = document.querySelector('input[name="paymentMethod"]:checked');

    if (!selectedPaymentMethod) {
        alert("Please select a payment method before placing your order.");
        return;
    }

    // Validate address selection
    if (selectedAddress <= 0) {
        document.getElementById('alertResponse').innerHTML = 'Please select a delivery address';
        alertModal();
        return;
    }

    // Handle payment based on the selected method
    if (selectedPaymentMethod.value === 'cod') {
        payment_type = 'COD';
        payNow(); // Call the payNow function for COD
    } else if (selectedPaymentMethod.value === 'online') {
        rzp1.open(); // Open Razorpay modal
    }
}



// Function to close the modal
function closePaymentCancelModal() {
    const modal = document.getElementById('paymentCancelModal');
    modal.style.display = 'none'; // Hide the modal
}

// Function to show the payment cancel modal
function showPaymentCancelModal() {
    const modal = document.getElementById('paymentCancelModal');
    modal.style.display = 'flex';

    setTimeout(function() {
        closePaymentCancelModal();
    }, 3000);
}




document.addEventListener("DOMContentLoaded", function() {
    const form = document.getElementById("addressForm");
    const submitButton = document.getElementById("submitButton");
    const inputs = form.querySelectorAll("input[required]");

    // Function to validate fields
    const validateFields = () => {
        let isValid = true;

        inputs.forEach((input) => {
            const errorMessage = input.nextElementSibling;
            if (!input.value.trim()) {
                errorMessage.textContent = "This field is required.";
                isValid = false;
            } else if (input.id === "postcode" && !/^\d{6}$/.test(input.value)) {
                errorMessage.textContent = "Post Code must be a 6-digit number.";
                isValid = false;
            } else if (input.id === "email" && !/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/
                .test(input.value)) {
                errorMessage.textContent = "Enter a valid email.";
                isValid = false;
            } else if (input.id === "phone" && !/^\d{10}$/.test(input.value)) {
                errorMessage.textContent = "Phone must be a 10-digit number.";
                isValid = false;
            } else {
                errorMessage.textContent = "";
            }
        });

        submitButton.disabled = !isValid;
    };

    // Add event listeners to validate fields on input
    inputs.forEach((input) => {
        input.addEventListener("input", validateFields);
    });
});



function alertModal() {
    event.preventDefault();
    const modal = document.getElementById('alertModal');
    modal.style.display = 'block';
}

// Function to close the modal
function closeAlertModal() {
    event.preventDefault();
    const modal = document.getElementById('alertModal');
    modal.style.display = 'none';
}



$(document).ready(function() {
    // Restrict input fields dynamically
    $(document).on('input', '.numbers-only', function() {
        this.value = this.value.replace(/[^0-9]/g, ''); // Allow only numbers
    });

    $(document).on('input', '.text-only', function() {
        this.value = this.value.replace(/[^a-zA-Z\s]/g, ''); // Allow only letters and spaces
    });

    // Form validation on submission
    $(document).on('submit', '#addressForm', function(event) {
        event.preventDefault(); // Prevent default submission

        let isValid = true;

        // Email validation
        const email = $('#email').val();
        const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
        if (!emailPattern.test(email)) {
            $('.emailError').text('Please enter a valid email').show();
            isValid = false;
        } else {
            $('.emailError').hide();
        }

        // Phone validation
        const phone = $('#phone').val();
        const phonePattern = /^\d{10}$/;
        if (!phonePattern.test(phone)) {
            $('.phoneError').text('Please enter a valid 10-digit phone number').show();
            isValid = false;
        } else {
            $('.phoneError').hide();
        }

        // Proceed if valid
        if (isValid) {
            // alert('Form submitted successfully!');
            document.getElementById('alertResponse').innerHTML = 'Form submitted successfully!';
            alertModal();
            $('#addAddressModal').modal('hide'); // Close modal
        }
    });
});



function saveAddress() {
    const formElement = document.getElementById('addressForm');
    const formData = new FormData(formElement);

    $.ajax({
        url: '<?= base_url('saveAddress') ?>', // Your endpoint
        type: 'POST',
        data: formData, // Send the FormData object
        contentType: false, // Let jQuery handle the content type
        processData: false, // Let jQuery handle the process data
        success: function(response) {
            resp = JSON.parse(response);
            if (resp.message === 'success') {
                // alert('Details Updated Successfully');
                document.getElementById('alertResponse').innerHTML = 'Details Save Successfully';
                alertModal();
                window.location.reload(); // Assuming you have a function to close the modal
            } else {
                // alert('something went wrong');
                document.getElementById('alertResponse').innerHTML = 'something went wrong';
                alertModal();
            }
        },
        error: function(xhr, status, error) {
            console.error('Error Updating Details:', error);
            // alert('An error occurred while saving the details.');
            document.getElementById('alertResponse').innerHTML =
                'An error occurred while saving the details';
            alertModal();

        }
    });



}




function editAddress(id) {
    console.log(id);
    $.ajax({
        url: '<?= base_url('editAddress') ?>', // Your endpoint
        type: 'POST',
        data: JSON.stringify({
            id: id
        }),
        contentType: 'application/json',
        success: function(response) {
            resp = JSON.parse(response);
            if (resp.status === 'success') {
                // let editdata = resp.message;
                document.getElementById('fullName').value = resp.message.name;
                document.getElementById('phone').value = resp.message.phone;
                document.getElementById('emails').value = resp.message.email;
                document.getElementById('citys').value = resp.message.city;
                document.getElementById('apartment').value = resp.message.apartment;
                document.getElementById('postcode').value = resp.message.pincode;
                document.getElementById('street').value = resp.message.streetAddress;
                document.getElementById('addId').innerText = resp.message.id;
                document.getElementById('state').value = resp.message.state;
                //document.getElementById('fullName').value = editdata.name;
                $('#editAddressModal').modal('show');

                //document.getElementById
                //document.getElementById('alertResponse').innerHTML='Order Successfull';
                //alertModal();
                //window.location.href = '<?= base_url()?>';
            } else {
                console.log(response);
                document.getElementById('alertResponse').innerHTML = 'something went wrong';
                alertModal();
            }
        },
        error: function(xhr, status, error) {
            console.error('Error Updating Details:', error);
            // alert('An error occurred while saving the details.');
            document.getElementById('alertResponse').innerHTML =
                'An error occurred while saving the details';
            alertModal();
        }
    });

}




$(document).ready(function() {
    // let editingCard = null;
    console.log('clicked');
    // let cardToDelete = null;

    // Open the modal when "Add New" button is clicked
    $('#addNewBtn').on('click', function() {
        //editingCard = null;

        $('#addressForm')[0].reset();
        $('#addAddressModal').modal('show');

    });

    // Handle the form submission

    // Edit an existing card
    // $('#addressContainer').on('click', '.edit-option', function() {
    //     editingCard = $(this).closest('.col-md-6');
    //     const fullName = $(editingCard).find('.address-name').text();
    //     const phone = $(editingCard).find('.address-phone').text();
    //     const email = $(editingCard).find('.address-email').text();
    //     const street = $(editingCard).find('.address-street').text().split(',')[0];
    //     const city = $(editingCard).find('.address-city').text();
    //     const apartment = $(editingCard).find('.address-street').text().split(',')[1] || '';

    //     $('#fullName').val(fullName);
    //     $('#phone').val(phone);
    //     $('#email').val(email);
    //     $('#city').val(city.trim());
    //     $('#apartment').val(apartment.trim());
    //     $('#street').val(street.trim());

    //     $('#addAddressModal').modal('show');
    // });


    $(document).ready(function() {
    $('#addNewBtn').on('click', function() {
        $('#addressForm')[0].reset();
        $('#addAddressModal').modal('show');
    });
    $('#editAddressModal').on('click', '.edit-option', function() {
        editingCard = $(this).closest('.col-md-6');
        const fullName = $(editingCard).find('.address-name').text();
        const phone = $(editingCard).find('.address-phone').text();
        const email = $(editingCard).find('.address-email').text();
        const street = $(editingCard).find('.address-street').text().split(',')[0];
        const city = $(editingCard).find('.address-city').text();
        const apartment = $(editingCard).find('.address-street').text().split(',')[1] || '';

        $('#fullName').val(fullName);
        $('#phone').val(phone);
        $('#email').val(email);
        $('#city').val(city.trim());
        $('#apartment').val(apartment.trim());
        $('#street').val(street.trim());

        $('#editAddressModal').modal('show');
    });
    $('#addressContainer').on('click', '.delete-option', function() {
        cardToDelete = $(this).closest('.col-md-6');
        $('#deleteConfirmationModal').modal('show');
    });
    $('#confirmDeleteBtn').on('click', function() {
        if (cardToDelete) {
            cardToDelete.remove();
            cardToDelete = null;
            $('#deleteConfirmationModal').modal('hide');
        }
    });
});

    // Delete an existing card
    $('#addressContainer').on('click', '.delete-option', function() {
        cardToDelete = $(this).closest('.col-md-6');
        $('#deleteConfirmationModal').modal('show');
    });

    // Confirm deletion
    $('#confirmDeleteBtn').on('click', function() {
        if (cardToDelete) {
            cardToDelete.remove();
            cardToDelete = null;
            $('#deleteConfirmationModal').modal('hide');
        }
    });
});

function selectAddress(id, phone, state) {
    selectedAddress = id;
    phoneNumber = phone;
    selectedState = state.toLowerCase(); // Normalize state to lowercase

if (selectedState === 'maharashtra') {
    document.getElementById('igst').style.display = 'none';
    const cgstElement = document.getElementById('cgst');
    cgstElement.style.display = 'flex';
    cgstElement.style.flexDirection = 'column'; 
    cgstElement.style.gap = '10px';
}

 else {
		document.getElementById('igst').style.display = 'flex';
        document.getElementById('cgst').style.display = 'none';

    }
}

function payNow() {
    if (selectedAddress <= 0) {
        // alert('please select delivery address');
        document.getElementById('alertResponse').innerHTML = 'please select delivery address';
        alertModal();
        return;
    }
    let total = '<?= $total?>';
    const subtotal = '<?= $subtotal?>';
    const gst = '<?= $gst?>';
    if (payment_type === 'COD') {
        total = parseFloat(total) + 40; // Ensure it's numeric before adding
    }
    const finalData = {
        total: total,
        subtotal: subtotal,
        gst: gst,
        deliveryAddress: selectedAddress,
        payment_type: payment_type,
        payment_id:payment_id,
        signature:signature
    };

    console.log(total);

    $.ajax({
        url: '<?= base_url('payment') ?>', // Your endpoint
        type: 'POST',
        data: finalData,
        success: function(response) {
            resp = JSON.parse(response);
            if (resp.status === 'success') {
            document.getElementById('alertResponse').innerHTML = 'Order Successfull';
            alertModal();
            setTimeout(function () {
                window.location.href = '<?= base_url()?>'; // Redirect after 5 sec
            }, 4000);
        } else {
            console.log(response);
            document.getElementById('alertResponse').innerHTML = 'Something went wrong';
            alertModal();
            setTimeout(hideModal, 000); // Hide modal after 5 sec
        }
        },
        error: function(xhr, status, error) {
            console.error('Error Updating Details:', error);
            // alert('An error occurred while saving the details.');
            document.getElementById('alertResponse').innerHTML =
                'An error occurred while saving the details';
            alertModal();
        }
    });



}

function updateAddress() {
    // Get the form element
    const formElement = document.getElementById('updateAddressForm');

    // Initialize FormData with the form element
    const formData = new FormData(formElement);
    formData.append('addid', document.getElementById('addId').innerText);
    $.ajax({
        url: '<?= base_url('updateAddress') ?>', // Your endpoint
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
            try {
                const resp = JSON.parse(response);
                if (resp.status === 'success') {
                    console.log(resp);
                    document.getElementById('alertResponse').innerHTML = 'Address Updated Successfully';
                    alertModal(); // Assuming this displays the alert modal
                    // Optionally, refresh or update parts of the page
                    window.location.reload();
                } else {
                    document.getElementById('alertResponse').innerHTML = 'Something went wrong';
                    alertModal();
                }
            } catch (e) {
                console.error('Error parsing response:', e);
                document.getElementById('alertResponse').innerHTML = 'Invalid server response';
                alertModal();
            }
        },
        error: function(xhr, status, error) {
            console.error('Error Updating Details:', error);
            document.getElementById('alertResponse').innerHTML =
                'An error occurred while saving the details';
            alertModal();
        }
    });
}


// update address validation

document.addEventListener("DOMContentLoaded", function() {
    const form = document.getElementById("updateAddressForm");
    const submitButton = document.querySelector(".update-address button"); // The submit button
    const inputs = form.querySelectorAll("input[required]");

    // Function to validate fields
    const validateFields = () => {
        let isValid = true;

        inputs.forEach((input) => {
            const errorMessage = input
                .nextElementSibling; // The <small> element after the input for error message

            // Validate if the field is empty
            if (!input.value.trim()) {
                errorMessage.textContent = "This field is required.";
                isValid = false;
            }
            // Validate post code (should be a 6-digit number)
            else if (input.id === "postcode" && !/^\d{6}$/.test(input.value)) {
                errorMessage.textContent = "Post Code must be a 6-digit number.";
                isValid = false;
            }
            // Validate email format
            else if (input.id === "emails" && !/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/
                .test(input.value)) {
                errorMessage.textContent = "Enter a valid email.";
                isValid = false;
            }
            // Validate phone number (should be a 10-digit number)
            else if (input.id === "phone" && !/^\d{10}$/.test(input.value)) {
                errorMessage.textContent = "Phone must be a 10-digit number.";
                isValid = false;
            }
            // Validate text-only fields (e.g., fullName, city, etc.)
            else if ((input.classList.contains("text-only") || input.id === "street") && !
                /^[a-zA-Z\s]+$/.test(input.value)) {
                errorMessage.textContent = "Only letters and spaces are allowed.";
                isValid = false;
            }
            // If no issues, clear error message
            else {
                errorMessage.textContent = "";
            }
        });

        // Disable submit button if the form is not valid
        submitButton.disabled = !isValid;
    };

    // Add event listeners to validate fields on input
    inputs.forEach((input) => {
        input.addEventListener("input", validateFields);
    });
});



function deleteAddress(id) {
    $.ajax({
        url: '<?= base_url('deleteAddress') ?>',
        type: 'POST',
        data: JSON.stringify({
            id: id
        }),
        contentType: 'application/json',
        processData: false,
        success: function(response) {
            resp = JSON.parse(response);
            if (resp.status === 'success') {
                // alert('Address Deleted Successfully');
                document.getElementById('alertResponse').innerHTML = 'Address Deleted Successfully';
                alertModal();
                window.location.reload();
            } else {
                document.getElementById('alertResponse').innerHTML = 'something went wrong';
                alertModal();
            }
        },
        error: function(xhr, status, error) {
            console.error('Error Updating Details:', error);
            document.getElementById('alertResponse').innerHTML =
                'An error occurred while saving the details';
            alertModal();

        }
    });
    $('#deleteConfirmationModal').modal('hide');
}

</script>

</body>

</html>