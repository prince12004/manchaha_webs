<?php $this->load->view('Admin/header') ?>
<style>
    .modal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5); /* Semi-transparent background */
    display: none;
    justify-content: center;
    align-items: center;
    z-index: 9999; /* Ensure the modal is on top of all other content */
}

.modal-content {
    background-color: white;
    padding: 30px;
    border-radius: 10px;
    text-align: center;
    max-width: 400px;
    width: 100%;
    margin:20vh auto
}
.modal-content h2{
    font-size:20px;
}

.modal-logo {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-bottom: 20px; /* Space between logo and the rest of the modal content */
}

.modal-logo img {
    max-width: 100%; /* Ensure the logo doesn't overflow */
    height: auto;
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
.eye-icon span{
    font-size: 17px !important;
    color: #666 !important;
}
.error-message{
    color:red;
    font-size:13px
}
</style>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@3.1.0/dist/css/multi-select-tag.css">
        <div class="add-vendor-page content">
        <div class="content">
            <div class="table-header d-flex justify-content-between align-items-center ms-4 ">
                <div class="headings my-4">       
                    <h3>Edit Vendor</h3>
                    <!-- <h6>Lorem Ipsum is simply dummy text</h6> -->
                </div>
            </div>  

            <div class="vendor-details-cont my-2 mx-5">
                <div class="  d-flex flex-column">
                    <div class="profile-section mb-3 w-100">
                        <div class="profile-card ">
                            <div class="d-flex flex-row">
                                <div class="profile-img">
                                    <img id="profileImage" src="https://via.placeholder.com/100" alt="Profile Image">
                                    <img src="<?=base_url('/assets/images/image-uploader.png')?>"  id="uploadIcon" alt="icon">
                                    <input type="file" id="imageUpload" class="hidden" accept="image/*">
                                </div>
                                <div class="card-details ps-4 p-3">
                                   <div class="content">
                                   <h2 id="profileName">Enter name in the input</h2>
                                    <p id="profileDescription">Enter description in the input</p>
                                    <img  src="<?= base_url('/assets/images/vendor-line.png') ?>" alt="icon" alt="">
                                    <div class="d-flex justify-content-start gap-5">
                                        <ul>
                                            <li><h6>Email ID:</h6> <span id="profileEmail">abc@gmail.com</span></li>
                                            <li><h6>Phone:</h6> <span id="profilePhone">+91 1234 567890</span></li>
                                            <li><h6>Joining Date:</h6> <span id="profileDate">23-07-2024</span></li>
                                            <li><h6>GST:</h6> <span id="profileGST">AB#123456</span></li>
                                        </ul>
                                        <ul>
                                            <li><h6>Company Name:</h6> <span id="companyName">Company Name.</span></li>
                                            <li><h6>Pen Card Number:</h6> <span id="pencardNumber">KXWPS7314B</span></li>
                                            <li><h6>City:</h6> <span id="profileCity">Noida</span></li>
                                            <li>
                                                <h6>Status:</h6> 
                                                <span id="profileStatus">Approved</span>
                                            </li>
                                        </ul>
                                    </div>
                                   </div>
                                </div>
                            </div>
                        </div>
                        <div class="information-tags">
                             <div class="content">
                                <div class="info-tabs" data-tab="1">
                                    Basic Information
                                </div>
                                <div class="info-tabs" data-tab="2">
                                    Bank Details
                                </div>
                                <div class="info-tabs" data-tab="3">
                                    Supplier E-Signature
                                </div>
                                <div class="info-tabs" data-tab="4">
                                    Legal & Policies
                                </div>
                                <div class="info-tabs" data-tab="5">
                                    Email Notifications
                                </div>
                             </div>
                        </div>
                    </div>
                    <div class=" form-section w-100" data-tab="1">
                        <form>
                            <h3>Basic Information</h3>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="vendorName" class="form-label">Vendor Name</label>
                                    <input type="text" class="form-control text-only" id="vendorName" placeholder="Lorem Ipsum" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="companyName" class="form-label">Company Name</label>
                                    <input type="text" class="form-control" id="vendorcompanyName" placeholder="Simply Dummy Text" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="email" class="form-label">Email ID</label>
                                    <input type="email" class="form-control email" id="vendorEmail" placeholder="abc@gmail.com" required>
                                    <small class="error-message emailError"></small>
                                </div>
                                <div class="col-md-6">
                                    <label for="phoneNumber" class="form-label">Phone Number</label>
                                    <input type="text" class="form-control numbers-only phone" id="phoneNumber" placeholder="+91 1234567890" required>
                                    <small class="error-message phoneError"></small>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="gstNumber" class="form-label">GST Number</label>
                                    <input type="text" class="form-control" id="gstNumber" placeholder="AB#123456" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="joiningDate" class="form-label">Joining Date</label>
                                    <input type="date" class="form-control date" id="joiningDate" placeholder="23-07-2024">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="panCardNumber" class="form-label">Pan Card Number</label>
                                    <input type="text" class="form-control" id="panCardNumber" placeholder="DX123MV456" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="categories" class="form-label">Categories</label>
                                    <div class="dropdown ">
                                        <div class="dropdown-toggle vendor-category form-check w-100" type="button" id="categoryDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                            Select Categories
                                        </div>
                                        <ul class="dropdown-menu w-100" aria-labelledby="categoryDropdown">
                                            <li>
                                                <div class="form-check d-flex align-items-center gap-1">
                                                    <input class="form-check-input category-checkbox" type="checkbox" value="1" id="menFashion">
                                                    <label class="form-check-label" for="menFashion">Men Fashion</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check  d-flex align-items-center gap-1">
                                                    <input class="form-check-input category-checkbox" type="checkbox" value="2" id="womenFashion">
                                                    <label class="form-check-label" for="womenFashion">Women Fashion</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check d-flex align-items-center gap-1">
                                                    <input class="form-check-input category-checkbox" type="checkbox" value="3" id="kidsToys">
                                                    <label class="form-check-label" for="kidsToys">Kids & Toys</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check d-flex align-items-center gap-1">
                                                    <input class="form-check-input category-checkbox" type="checkbox" value="4" id="electronics">
                                                    <label class="form-check-label" for="electronics">Electronics</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check d-flex align-items-center gap-1">
                                                    <input class="form-check-input category-checkbox" type="checkbox" value="5" id="homeKitchen">
                                                    <label class="form-check-label" for="homeKitchen">Home & Kitchen</label>
                                                </div>
                                            </li>
                                        </ul>
                                        <input type="hidden" id="selectedCategories" name="categories[]" />
                                    </div>
                                </div>
                                
                            </div>
                            <div class="row mb-3">
                                <label for="categories" class="form-label"> Commission on Selected Categories</label>
                                <div id="category-inputs-container" class="" style=" "></div> <!-- Container for dynamic input fields -->
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-control" id="status">
                                        <option value="Approved">Approved</option>
                                        <option value="Blocked">Blocked</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="city" class="form-label">City</label>
                                    <input type="text" class="form-control text-only" id="city" placeholder="Noida"  required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="state" class="form-label">State</label>
                                    <select class="form-control" id="state">
                                        <option>Uttar Pradesh</option>
                                        <option>Delhi</option>
                                        <option>Noida</option>
                                        <option>Noida</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="postCode" class="form-label">Post Code</label>
                                    <input type="text" class="form-control" id="postCode" placeholder="201307"  required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" class="form-control" id="address" placeholder="enter the Address details...">
                            </div>
                            <div class="mb-3">
                                <label for="aboutUs" class="form-label">About Us</label>
                                <textarea class="form-control" id="aboutUs" rows="3" placeholder="enter the details"></textarea>
                            </div>
                            <div class="row my-3 gap-3 d-flex flex-row justify-content-start">
                                <button class="btn btn-primary col-2 ms-2">SAVE NOW</button>
                                <button class="btn btn-outline-dark col-2">CANCEL NOW</button>
                            </div>
                        </form>
                        <div class="form-section w-100 mt-2 d-flex justify-content-between align-items-center gap-3" >  
                            <form class="w-50" id="passwordForm">
                                <h3>Change Password</h3>
                                <div class="password-section">
                                    <label for="current-password">Current Password</label>
                                        <div class="input-wrapper">
                                        <input type="password" class="form-control" id="current-password" placeholder="Enter Current Password" required>
                                        <button type="button" class="toggle-password" onclick="toggleVisibility('current-password')">
                                        <i class="eye-icon"><span class="material-symbols-outlined">
                                        visibility
                                        </span></i>
                                    </button>
                                    </div>
                                </div>
                                <div class="password-section">
                                    <label for="new-password">New Password</label>
                                        <div class="input-wrapper">
                                        <input type="password" class="form-control" id="new-password" placeholder="Enter New Password" required>
                                        <button type="button" class="toggle-password" onclick="toggleVisibility('new-password')">
                                            <i class="eye-icon"><span class="material-symbols-outlined">
                                            visibility
                                            </span></i>
                                    </button>
                                    </div>
                                </div>
                                <div class="password-section">
                                    <label for="confirm-password">Confirm New Password</label>
                                    <div class="input-wrapper">
                                        <input type="password" class="form-control" id="confirm-password" placeholder="Enter Confirm New Password" required>
                                        <button type="button" class="toggle-password" onclick="toggleVisibility('confirm-password')">
                                            <i class="eye-icon"><span class="material-symbols-outlined">
                                            visibility
                                            </span></i>
                                        </button>
                                    </div>
                                    <span id="password-error-message" class="error-message" style="display: none; color: red; font-size: 0.9rem;">Passwords do not match!</span>
                                </div>
                                <div class="buttons">
                                    <button type="submit" class="btn btn-primary  ms-2" id="save-changes">Save Changes</button>
                                    <button type="reset" class="btn btn-outline-dark" id="cancel-now">Cancel Now</button>
                                </div>
                            </form>
                            <div class="deactivate-section w-50">
                                <h3>Deactivate Account</h3>
                                <label class="mb-2">Warning: account will be deactivate.</label>
                                <label for="deactivate-reason">Reason Deactivate Account</label>
                                <textarea class="form-control w-100 mb-2" id="deactivate-reason" placeholder="Enter Reason to Deactivate Account" rows="3"></textarea>
                                <button type="button" id="deactivate-account">Deactivate Account</button>
                            </div>
                        </div>
                    </div>
                    <div class="form-section" data-tab="2">
                        <form>
                            <!-- Bank Details Form Content -->
                            <h3>Bank Details</h3>
                            <div class="row mb-1">
                                <div class="col-md-6">
                                    <label for="name-bank" class="form-label">Account Name</label>
                                    <input type="text" class="form-control text-only" id="name-bank" placeholder="Enter your name" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="email-bank" class="form-label">Account Email</label>
                                    <input type="email" class="form-control email" id="email-bank" placeholder="Enter your email">
                                    <small class="error-message emailError"></small>
                                </div>
                            </div>
                            <div class="row mb-1">
                                <div class="col-md-6">
                                    <label for="account-number" class="form-label"> Account Number</label>
                                    <input type="text" class="form-control numbers-only" id="account-number" placeholder="Enter account number" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="account-number" class="form-label">Confirm Account Number</label>
                                    <input type="text" class="form-control numbers-only" id="conf-account-number" placeholder="Enter account number" required>
                                    <span id="account-error-message" class="error-message" style="display: none; color: red; font-size: 0.9rem;">Account Number does not match!</span>
                                    
                                </div>
                            </div>
                            <!-- Additional Fields for Bank Details -->
                            <div class="row mb-1">
                                <div class="col-md-6">
                                    <label for="ifsc-code" class="form-label">IFSC Code</label>
                                    <input type="text" class="form-control" id="ifsc-code" placeholder="Enter IFSC code" required>
                                </div>
                            </div>
                            <div class="row my-3 gap-3 d-flex flex-row justify-content-start">
                                <button class="btn btn-primary col-2 ms-2">SAVE NOW</button>
                                <button class="btn btn-outline-dark col-2">CANCEL NOW</button>
                            </div>
                        </form>
                    </div>
                    <div class="form-section" data-tab="3">
                        <form>
                            <!-- Supplier E-Signature Form Content -->
                            <h3>Supplier E-Signature</h3>
                            <!-- Add your form fields here -->
                            
                            <div class="d-flex gap-2 justify-content-center align-items-center" >
                                <div class="col-md-6">
                                    <label class="mb-2">
                                    Warning: 
                                    </label>
                                    <div class="col-md-11">
                                        <label for="name-bank" class="form-label">Full Legal Name</label>
                                        <input type="text" class="form-control text-only " id="legal-name" placeholder="Enter Full Legal Name" required>
                                    </div>
                                    <div class="row my-3 gap-3 d-flex flex-row justify-content-start">
                                        <button style="width:170px" class="btn btn-primary  ms-2">SAVE NOW</button>
                                        <button style="width:170px"  class="btn btn-outline-dark">CANCEL NOW</button>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="signature" class="form-label">Upload E-Signature</label>
                                        <input type="file" class="form-control" id="signature" accept="image/*" onchange="previewSignature(event)"  required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Preview</label>
                                        <div id="signaturePreview" class="border p-3 text-center" style="height: 150px; width: 100%; border: 1px solid #ccc;">
                                            <p class="text-muted">Your signature preview will appear here</p>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            
                        </form>
                    </div>
                    <div class="form-section" data-tab="4">
                        <form>
                            <!-- Legal & Policies Form Content -->
                            <h3>Legal & Policies</h3>
                            <div class=" container-A my-3">
                                <!-- Dropdown 1 -->
                                <div class="dropdown-card">
                                    <div class="dropdown-card-header" data-bs-toggle="collapse" data-bs-target="#dropdown1">
                                        <div class="d-flex align-items-center">
                                            <h5 class="dropdown-heading">policy 1
                                            </h5>
                                        </div>
                                        <span class="dropdown-toggle-icon">+</span>
                                    </div>
                                    <div id="dropdown1" class="collapse dropdown-card-body">
                                        <p class="para-A">policy details</p>
                                    </div>
                                </div>
                                <!-- Dropdown 2 -->
                                <div class="dropdown-card">
                                    <div class="dropdown-card-header" data-bs-toggle="collapse" data-bs-target="#dropdown2">
                                        <div class="d-flex align-items-center"> 
                                            <h5 class="dropdown-heading">Policy 2</h5>
                                        </div>
                                        <span class="dropdown-toggle-icon">+</span>
                                    </div>
                                    <div id="dropdown2" class="collapse dropdown-card-body">
                                        <p class="para-A">policy Details
                                        </p>
                                    </div>
                                </div>
                                <!-- Dropdown 3 -->
                                <div class="dropdown-card">
                                    <div class="dropdown-card-header" data-bs-toggle="collapse" data-bs-target="#dropdown3">
                                        <div class="d-flex align-items-center">
                                            <h5 class="dropdown-heading">policy 3</h5>
                                        </div>
                                        <span class="dropdown-toggle-icon">+</span>
                                    </div>
                                    <div id="dropdown3" class="collapse dropdown-card-body">
                                        <p class="para-A">policy details </p>
                                    </div>
                                </div>
                                <!-- Dropdown 4 -->
                                <div class="dropdown-card">
                                    <div class="dropdown-card-header" data-bs-toggle="collapse" data-bs-target="#dropdown4">
                                        <div class="d-flex align-items-center">
                                            <h5 class="dropdown-heading">policy 4

                                            </h5>
                                        </div>
                                        <span class="dropdown-toggle-icon">+</span>
                                    </div>
                                    <div id="dropdown4" class="collapse dropdown-card-body">
                                        <p class="para-A">policy details.</p>
                                    </div>
                                </div>
                            </div>   
                        </form>
                    </div>
                    <div class="form-section" data-tab="5">
                        <form>
                            <!-- Email Notifications Form Content -->
                            <h3>Email Notifications</h3>
                            <!-- Add your form fields here -->
                            <div class="mb-3">
                                <label for="email-notifications" class="form-label">Recieve important updates and notification on Email</label>
                                <div class="d-flex align-items-top gap-2">
                               <div>
                                    <input type="email" class="form-control email" id="email-notifications" placeholder="Enter your email"  required>
                                    <small class="error-message emailError"></small>
                               </div>
                                <button class="btn-success btn"><img src="<?= base_url('/assets/images/white-tick.png') ?>" alt="User Image">Subscribe Now</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    
                </div>
            </div>
        </div>
        <div id="modal" class="modal" style="display: none;">
                <div class="modal-content">
                    <!-- Logo in the center -->
                    <div class="modal-logo">
                      <img src="<?= base_url('/assets/images/images/logo.png') ?>" alt="Logo" >
                    </div>
                    <h2>Passwords do not match!</h2>
                    <p> Please fix them before submitting.</p>
                    <button class="close-btn" onclick="closeModal()">Close</button>
                </div>
            </div>
        </div>
        <div id="myModal" class="modal" style="display: none;">
                <div class="modal-content">
                    <!-- Logo in the center -->
                    <div class="modal-logo">
                      <img src="<?= base_url('/assets/images/images/logo.png') ?>" alt="Logo" >
                    </div>
                    <h2>SAVED!!!</h2>
                    <button class="close-btn" onclick="closemyModal()">Close</button>
                </div>
            </div>
        </div>        
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/js/all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@3.1.0/dist/js/multi-select-tag.js"></script>
    <script src="<?= base_url('/assets/javascript/common.js') ?>"></script>
    <script>








$(document).ready(function () {
    // Elements for profile card update
    const $vendorName = $('#vendorName');
    const $vendorcompanyName = $('#vendorcompanyName');
    const $phoneNumber = $('#phoneNumber');
    const $vendorEmail = $('#vendorEmail');
    const $panCardNumber = $('#panCardNumber');
    const $gstNumber = $('#gstNumber');
    const $joiningDate = $('#joiningDate');
    const $city = $('#city');
    const $status = $('#status');

    const $profileName = $('#profileName');
    const $profileEmail = $('#profileEmail');
    const $profilePhone = $('#profilePhone');
    const $profileDate = $('#profileDate');
    const $profileGST = $('#profileGST');
    const $companyName = $('#companyName');
    const $profilePanCard = $('#pencardNumber');
    const $profileCity = $('#profileCity');
    const $profileStatus = $('#profileStatus');

    // Image upload elements
    const $imageUpload = $('#imageUpload');
    const $profileImage = $('#profileImage');
    const $uploadIcon = $('#uploadIcon');

    // Update profile card on input change
    $vendorName.on('input', function () {
        $profileName.text($(this).val());
    });

    $vendorEmail.on('input', function () {
        $profileEmail.text($(this).val());
    });

    $phoneNumber.on('input', function () {
        $profilePhone.text($(this).val());
    });

    $joiningDate.on('input', function () {
        $profileDate.text($(this).val());
    });

    $gstNumber.on('input', function () {
        $profileGST.text($(this).val());
    });

    $vendorcompanyName.on('input', function () {
        $companyName.text($(this).val());
    });

    $panCardNumber.on('input', function () {
        $profilePanCard.text($(this).val());
    });

    $city.on('input', function () {
        $profileCity.text($(this).val());
    });

    $status.on('change', function () {
        $profileStatus.text($(this).val());
    });

    // Profile image upload
    $uploadIcon.on('click', function () {
        $imageUpload.click();
    });

    $imageUpload.on('change', function (event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                $profileImage.attr('src', e.target.result);
            };
            reader.readAsDataURL(file);
        }
    });
});

$(document).ready(function () {
    const $statusDropdown = $('#status');
    const $profileStatus = $('#profileStatus');

    // Function to update the status text and color
    const updateStatus = () => {
        const statusValue = $statusDropdown.val();
        $profileStatus.text(statusValue);

        if (statusValue === "Approved") {
            $profileStatus.css({ 'color': '#7CFFAC', 'font-weight': 'semi-bold' });
        } else if (statusValue === "Blocked") {
            $profileStatus.css({ 'color': 'red', 'font-weight': 'semi-bold' });
        }
    };

    // Initial status update on page load
    updateStatus();

    // Update status on dropdown change
    $statusDropdown.on('change', function () {
        updateStatus();
    });
});

flatpickr(".date", {
        enableTime: false,                // Enables time selection
        minDate: "today",                // Allows only future dates
        dateFormat: "d-m-Y ",         // Format: Year-Month-Day Hour:Minute
        allowInput: false                // Disables manual input
    });

  
    $(document).ready(function () {
        $('.category-checkbox').on('change', function () {
            const selectedCategories = $('.category-checkbox:checked')
                .map(function () {
                    return $(this).val();
                })
                .get()
                .join(',');

            $('#selectedCategories').val(selectedCategories);
        });

        // Close dropdown when clicked outside
        $(document).on('click', function (e) {
            if (!$(e.target).closest('.dropdown').length) {
                $('.dropdown-menu').removeClass('show');
            }
        });

        // Keep dropdown open only while interacting with the menu or button
        $('.dropdown-menu').on('click', function (e) {
            e.stopPropagation();
        });
    });



    // Listen for checkbox changes
document.querySelectorAll('.category-checkbox').forEach((checkbox) => {
    checkbox.addEventListener('change', function () {
        const container = document.getElementById('category-inputs-container');
        const categoryName = this.nextElementSibling.textContent.trim(); // Get category name
        const inputId = `input-${this.id}`; // Unique ID for input

        if (this.checked) {
            // Add input field when checked
            if (!document.getElementById(inputId)) {
                const inputGroup = document.createElement('div');
                inputGroup.id = inputId;
                inputGroup.style.display = 'flex';
                inputGroup.style.alignItems = 'center';

                const label = document.createElement('label');
                label.textContent = categoryName;
                label.style.marginRight = '10px';
                label.style.marginTop = '0px';
                label.style.minWidth = '50px';

                const input = document.createElement('input');
                input.type = 'text';
                input.className = 'numbers-only'; // Add the "numbers-only" class;
                input.name = `commission_${this.value}`; // Name attribute
                input.placeholder = 'Enter %';
                input.style.width = '150px';
                input.style.padding = '5px';
                input.style.marginRight = '15px';
                input.style.border = '1px solid rgba(218, 221, 224, 0.58)';
                input.style.borderRadius = '5px';

                inputGroup.appendChild(label);
                inputGroup.appendChild(input);
                container.appendChild(inputGroup);
            }
        } else {
            // Remove input field when unchecked
            const existingInput = document.getElementById(inputId);
            if (existingInput) {
                container.removeChild(existingInput);
            }
        }
    });
});


   




        $(document).ready(function () {
        $(".info-tabs").click(function () {
            // Remove active-tab class from all tabs
            $(".info-tabs").removeClass("active-tab");

            // Add active-tab class to the clicked tab
            $(this).addClass("active-tab");

            // Get the data-tab attribute of the clicked tab
            const tabId = $(this).data("tab");

            // Hide all form sections
            $(".form-section").removeClass("active");

            // Show the corresponding form section
            $(`.form-section[data-tab="${tabId}"]`).addClass("active");
        });

        // Initialize the first tab as active
        $(".info-tabs:first").addClass("active-tab");
        $(".form-section:first").addClass("active");
    });


    $(document).ready(function () {
        $('#signature').on('change', function () {
            const fileInput = this;
            const previewContainer = $('#signaturePreview');
            const file = fileInput.files[0];

            // Clear previous content
            previewContainer.empty();

            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const img = $('<img>', {
                        src: e.target.result,
                        alt: 'Signature Preview',
                        css: {
                            'max-height': '100%',
                            'max-width': '100%',
                        }
                    });
                    previewContainer.append(img);
                };
                reader.readAsDataURL(file);
            } else {
                previewContainer.html('<p class="text-muted">Your signature preview will appear here</p>');
            }
        });
    });

// ======legal-policies-dropdown==========

    $(document).ready(function () {
        const $dropdowns = $('.dropdown-card');
    
        $dropdowns.each(function () {
            const $dropdown = $(this);
            const $collapseElement = $dropdown.find('.collapse');
            const $headingElement = $dropdown.find('.dropdown-heading');
            const $toggleIcon = $dropdown.find('.dropdown-toggle-icon');
    
            // When the dropdown is expanding
            $collapseElement.on('show.bs.collapse', function () {
                // Change styles and behavior before the dropdown expands
                $headingElement.css({
                    'color': '#310C40',
                    'font-weight': '500'
                });
                $dropdown.css({
                    'box-shadow': '0px 3px 6px 0px #0000000D',
                    'border': '1px solid #f2f2f2'
                });
                $toggleIcon.addClass('dropdown-icon-active');
            });
    
            // When the dropdown is collapsing
            $collapseElement.on('hide.bs.collapse', function () {
                // Revert styles and behavior before the dropdown collapses
                $headingElement.css({
                    'color': '',
                    'font-weight': '400'
                });
                $dropdown.css({
                    'box-shadow': '',
                    'border': ''
                });
                $toggleIcon.removeClass('dropdown-icon-active');
            });
        });
    });


    document.getElementById("conf-account-number").addEventListener("input", function () {
        const newPassword = document.getElementById("account-number").value;
        const confirmPassword = this.value;
        const message = document.getElementById("account-error-message");

        if (newPassword !== confirmPassword) {
            message.style.display = "block";
            message.textContent = "account number does not match!";
        } else {
            message.style.display = "none";
        }
        });


    function toggleVisibility(inputId) {
        const input = document.getElementById(inputId);
        input.type = input.type === "password" ? "text" : "password";
        }

        
        document.getElementById("confirm-password").addEventListener("input", function () {
        const newPassword = document.getElementById("new-password").value;
        const confirmPassword = this.value;
        const message = document.getElementById("password-error-message");

        if (newPassword !== confirmPassword) {
            message.style.display = "block";
            message.textContent = "Passwords do not match!";
        } else {
            message.style.display = "none";
        }
        });

        document.getElementById("passwordForm").addEventListener("submit", function (e) {
        const newPassword = document.getElementById("new-password").value;
        const confirmPassword = document.getElementById("confirm-password").value;

        if (newPassword !== confirmPassword) {
            e.preventDefault();
            showModal();
        }
        });

        
        function restrictInput() {
            // Use event delegation to handle both initial and dynamically added inputs
            document.addEventListener('input', (e) => {
                if (e.target.classList.contains('numbers-only')) {
                    e.target.value = e.target.value.replace(/[^0-9]/g, ''); // Allow numbers only
                } else if (e.target.classList.contains('text-only')) {
                    e.target.value = e.target.value.replace(/[^a-zA-Z\s]/g, ''); // Allow letters and spaces only
                }
            });
        }

// Call the function to initialize event delegation
        restrictInput();


        function showModal() {
            event.preventDefault();
            const modal = document.getElementById('modal');
            modal.style.display = 'block';
        }

        // Function to close the modal
        function closeModal() {
            event.preventDefault();
            const modal = document.getElementById('modal');
            modal.style.display = 'none';
        }

        function showmyModal() {
            event.preventDefault();
            const modal = document.getElementById('mymodal');
            modal.style.display = 'block';
        }
        function closemyModal() {
            event.preventDefault();
            const modal = document.getElementById('myModal');
            modal.style.display = 'none';
        }


        $(document).ready(function() {
        $('form').on('submit', function(event) {
            event.preventDefault(); // Prevent the form from submitting normally
            let isValid = true;

            // Email validation
            const email = $('.email').val();
            const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
            if (!emailPattern.test(email)) {
                $('.emailError').text('Please enter a valid email').show();
                isValid = false;
            } else {
                $('.emailError').hide();
            }
             // Phone validation
             const phone = $('.phone').val();
            const phonePattern = /^\d{10}$/;
            if (!phonePattern.test(phone)) {
                $('.phoneError').text('Please enter a valid 10-digit phone number').show();
                isValid = false;
            } else {
                $('.phoneError').hide();
            }

            
            // If the form is valid, show the modal
            if (isValid) {
                showmyModal();
                
            }
        });
    });

   

    
    </script>

</body>
</html>

