<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
<link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
<link rel="stylesheet" href="<?= base_url('/assets/admincss/styles.css')?>">
<link rel="stylesheet"
    href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@3.1.0/dist/css/multi-select-tag.css">
<style>
.add-vendor-page .dropdown-card {
    border-bottom: 1px solid rgba(216, 226, 239, 1);
    border-radius: 10px;
    margin-bottom: 15px;
    padding: 10px 10px;
}

.dropdown-card-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    cursor: pointer;
    padding: 10px;
    border-radius: 10px;
}

.para-A {
    padding: 10px;
}

.add-vendor-page .dropdown-card-header h5 {
    font-size: 15px;
    font-weight: 400;
    line-height: 19.36px;
    text-align: left;
    color: #4B4B4B;
}

.add-vendor-page .dropdown-card-body {
    margin-top: 10px;
}

.add-vendor-page .dropdown-toggle-icon {
    font-size: 1.3rem;
    width: 30px;
    height: 30px;
    display: flex;
    justify-content: center;
    align-items: center;
    color: #888;
    border-radius: 50%;
    padding: 0px 7px;
}

.add-vendor-page .dropdown-icon-active {
    background-color: #CCF1FF;
    color: #00AEEF;
    transform: rotate(45deg);
    transition: all 0.3s ease-in;
}

.vendor-details-cont {
    width: 95%;
    margin: 0 auto;
}

/* General Modal Styles */
.success-modal,
.error-modal {
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

.success-modal-content,
.error-modal-content {
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

.success-logo img,
.error-logo img {
    width: 240px;
    /* Adjust logo size */
    margin-bottom: 20px;
}

.success-modal h2,
.error-modal h2 {
    font-size: 22px;
    font-weight: 500;
    color: black;
    margin-bottom: 20px;
    font-family: Arial, sans-serif;
}

.success-close-btn,
.error-close-btn {
    background-color: #007bff;
    color: #FFFFFF;
    border: none;
    padding: 10px 20px;
    font-size: 16px;
    border-radius: 5px;
    cursor: pointer;
}

.error-close-btn {
    background-color: #ff5733;
    /* Error button color for error modal */
}


.error-close-btn:hover {
    background-color: #e04e27;
    /* Error button hover color */
}

/* Animation for modal */
.success-modal,
.error-modal {
    animation: fadeIn 0.3s ease-in-out;
}

/* .modal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5); 
    display: none;
    justify-content: center;
    align-items: center;
    z-index: 9999;
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
    margin-bottom: 20px; 
}

.modal-logo img {
    max-width: 100%; 
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
} */
.eye-icon span {
    font-size: 17px !important;
    color: #666 !important;
}

.error-message {
    color: red;
    font-size: 13px
}
</style>


<div class="vendor-details-cont my-2">
    <div class="  d-flex flex-column">
        <div class="profile-section mb-3 w-100">
            <div class="profile-card ">
                <div class="d-flex flex-row">
                    <div class="profile-img">
                        <img id="profileImage" src="https://via.placeholder.com/100" alt="Profile Image">
                        <img src="<?=base_url('/assets/images/image-uploader.png')?>" id="uploadIcon" alt="icon">

                    </div>
                    <div class="card-details ps-4 p-3">
                        <div class="content">
                            <h2 id="profileName">Enter profile name</h2>
                            <p id="profileDescription">Enter profile description</p>
                            <img src="<?= base_url('/assets/images/vendor-line.png') ?>" alt="icon" alt=""
                                style="width: 100%">
                            <div class="d-flex justify-content-start gap-5">
                                <ul>
                                    <li>
                                        <h6>Email ID:</h6> <span id="profileEmail">abc@gmail.com</span>
                                    </li>
                                    <li>
                                        <h6>Phone:</h6> <span id="profilePhone">+91 1234 567890</span>
                                    </li>
                                    <li>
                                        <h6>Joining Date:</h6> <span id="profileDate">23-07-2024</span>
                                    </li>
                                    <li>
                                        <h6>GST:</h6> <span id="profileGST">AB#123456</span>
                                    </li>
                                </ul>
                                <ul>
                                    <li>
                                        <h6>Company Name:</h6> <span id="companyName"> Enter Company name</span>
                                    </li>
                                    <li>
                                        <h6>Pan Card Number:</h6> <span id="pencardNumber">KXWPS7314B</span>
                                    </li>
                                    <li>
                                        <h6>City:</h6> <span id="profileCity">Noida</span>
                                    </li>
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
            <form id="basicForm" enctype="multipart/form-data">

                <h3>Basic Information</h3>
                <input type="file" id="imageUpload" name="vendor_image" class="hidden" accept="image/*">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="vendorName" class="form-label">Vendor Name</label>
                        <input type="text" name="vendor_name" value="<?= set_value('vendor_name')?>"
                            class="form-control text-only" id="vendorName" placeholder="Enter name" required>
                    </div>
                    <div class="col-md-6">
                        <label for="companyName" class="form-label">Company Name</label>
                        <input type="text" name="vendor_company" value="<?= set_value('vendor_company')?>"
                            class="form-control" id="vendorcompanyName" placeholder="Enter company name" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="email" class="form-label">Email ID</label>
                        <input type="email" name="vendor_email" value="<?= set_value('vendor_email')?>"
                            class="form-control email" id="vendorEmail" placeholder="Enter your mail" required>
                        <small class="error-message emailError"></small>
                    </div>
                    <div class="col-md-6">
                        <label for="phoneNumber" class="form-label">Phone Number</label>
                        <input type="text" name="vendor_phone" oninput="checkPhone(this.value)" value="<?= set_value('vendor_phone')?>"
                            class="form-control numbers-only phone" id="phoneNumber" placeholder="Enter your number"
                            required>
                        <small class="error-message phoneError"></small>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="gstNumber" class="form-label">GST Number</label>
                        <input type="text" name="vendor_gst" value="<?= set_value('vendor_gst')?>" class="form-control"
                            id="gstNumber" placeholder="Enter your GST number" required>
                    </div>

                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="panCardNumber" class="form-label">Pan Card Number</label>
                        <input type="text" name="vendor_pan_card" value="<?= set_value('vendor_pan_card')?>"
                            class="form-control" id="panCardNumber" placeholder="Enter your pan number" required>
                    </div>
                    <div class="col-md-6">
                        <label for="categories" class="form-label">Categories</label>
                        <div class="dropdown ">
                            <div class="dropdown-toggle vendor-category form-check w-100" type="button"
                                id="categoryDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                Select Categories
                            </div>
                            <ul class="dropdown-menu w-100" aria-labelledby="categoryDropdown">
                                <?php foreach($data['category'] as $category){?>
                                <li>
                                    <div class="form-check d-flex align-items-center gap-1">
                                        <input class="form-check-input category-checkbox" type="checkbox"
                                            value="<?= $category['CategoryID']?>" id="menFashion">
                                        <label class="form-check-label"
                                            for="menFashion"><?= $category['CategoryName']?></label>
                                    </div>
                                </li>
                                <?php }?>

                            </ul>
                            <input type="hidden" id="selectedCategories" name="categories[]" />
                        </div>
                    </div>

                </div>
                <!-- <div class="row mb-3">
                                <label for="categories" class="form-label"> Commission on Selected Categories</label>
                                <div id="category-inputs-container" class="" style=" "></div> 
                            </div> -->
                <div class="row mb-3">
                    <!-- <div class="col-md-6">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-control" name="vendor_status" id="status">
                                        <option value="Approved">Approved</option>
                                        <option value="Blocked">Blocked</option>
                                    </select>
                                </div> -->
                    <div class="col-md-6">
                        <label for="country" class="form-label">Country</label>
                        <select class="form-control" name="vendor_country" id="country" onchange="getStates(this.value)">
    <option value="">Select</option>
    <?php if (!empty($data['countries'])) { 
        foreach ($data['countries'] as $country) { 
            $selected = (isset($_POST['vendor_country']) && $_POST['vendor_country'] == $country['id']) ? 'selected' : ''; 
    ?>
        <option value="<?= $country['id'] ?>" <?= $selected ?>>
            <?= htmlspecialchars($country['country_name']) ?>
        </option>
    <?php 
        } 
    } ?>
</select>

                    </div>
                    <div class="col-md-6">
                        <label for="city" class="form-label">City</label>
                        <input type="text" name="vendor_city" value="<?= set_value('vendor_city')?>"
                            class="form-control text-only" id="city" placeholder="Enter your city" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="state" class="form-label">State</label>
                        <select class="form-control" name="vendor_state" id="state">
                            <option value="">select</option>

                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="postCode" class="form-label">Post Code</label>
                        <input type="text" name="vendor_postcode" value="<?= set_value('vendor_postcode')?>"
                            class="form-control" id="postCode" placeholder="Enter your post code" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" name="vendor_address" value="<?= set_value('vendor_address')?>"
                        class="form-control" id="address" placeholder="Enter address...">
                </div>
                <div class="mb-3">
                    <label for="aboutUs" class="form-label">About Us</label>
                    <textarea class="form-control" name="vendor_about" value="<?= set_value('vendor_about')?>"
                        id="aboutUs" rows="3" placeholder="Something about you..."></textarea>
                </div>
                <div class="row my-3 gap-3 d-flex flex-row justify-content-start">
                    <button type="button" onclick="saveVendorData()" class="btn btn-primary col-2 ms-2">SAVE
                        NOW</button>
                    <button class="btn btn-outline-dark col-2">CANCEL NOW</button>
                </div>
            </form>
        </div>
        <div class="form-section" data-tab="2">
            <form id="bankDetails">
                <h3>Bank Details</h3>
                <p id="basicId" style="display: none;position:absolute;"></p>
                <div class="row mb-1">
                    <div class="col-md-6">
                        <label for="name-bank" class="form-label">Account Name</label>
                        <input type="text" name="account_name" value="<?= set_value('account_name')?>"
                            class="form-control text-only" id="name-bank" placeholder="Enter your name" required>
                    </div>
                    <!-- <div class="col-md-6">
                        <label for="email-bank" class="form-label">Account Email</label>
                        <input type="email" name="account_email" value="<?= set_value('account_email')?>"
                            class="form-control email" id="email-bank" placeholder="Enter your email">
                        <small class="error-message emailError"></small>
                    </div> -->
                </div>
                <div class="row mb-1">
                    <div class="col-md-6">
                        <label for="account-number" class="form-label"> Account Number</label>
                        <input type="text" name="account_number" value="<?= set_value('account_number')?>"
                            class="form-control numbers-only" id="account-number" placeholder="Enter account number"
                            required>
                    </div>
                    <div class="col-md-6">
                        <label for="account-number" class="form-label">Confirm Account Number</label>
                        <input type="text" class="form-control numbers-only" id="conf-account-number"
                            placeholder="Enter account number" required>
                        <span id="account-error-message" class="error-message"
                            style="display: none; color: red; font-size: 0.9rem;">Account Number does not match!</span>

                    </div>
                </div>
                <!-- Additional Fields for Bank Details -->
                <div class="row mb-1">
                    <div class="col-md-6">
                        <label for="ifsc-code" class="form-label">IFSC Code</label>
                        <input type="text" name="ifsc" value="<?= set_value('ifsc')?>" class="form-control"
                            id="ifsc-code" placeholder="Enter IFSC code" required>
                    </div>
                </div>
                <div class="row my-3 gap-3 d-flex flex-row justify-content-start">
                    <button type="button" class="btn btn-primary col-2 ms-2" onclick="saveBank()">SAVE NOW</button>
                    <button type="button" class="btn btn-outline-dark col-2">CANCEL NOW</button>
                </div>
            </form>
        </div>
        <div class="form-section" data-tab="3">
            <form id="signatureForm">
                <!-- Supplier E-Signature Form Content -->
                <h3>Supplier E-Signature</h3>
                <!-- Add your form fields here -->

                <div class="d-flex gap-2 justify-content-center align-items-center">
                    <div class="col-md-6">
                        <label class="mb-2">
                            Warning: Lorem Ipsum is simply dummy text of the printing typesetting industry.Lorem Ipsum
                            has been the industry's standard dummy text ever since
                        </label>
                        <div class="col-md-11">
                            <label for="name-bank" class="form-label">Full Legal Name</label>
                            <input type="text" name="vendor_full_name" class="form-control text-only " id="legal-name"
                                placeholder="Enter Full Legal Name" required>
                        </div>
                        <div class="row my-3 gap-3 d-flex flex-row justify-content-start">
                            <button type="button" onclick="saveSignature()" style="width:170px" class="btn btn-primary  ms-2">SAVE NOW</button>
                            <button style="width:170px" class="btn btn-outline-dark">CANCEL NOW</button>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="signature" class="form-label">Upload E-Signature</label>
                            <input type="file" name="signature_document" class="form-control" id="signature" accept="image/*"
                                onchange="previewSignature(event)" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Preview</label>
                            <div id="signaturePreview" class="border p-3 text-center"
                                style="height: 150px; width: 100%; border: 1px solid #ccc;">
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
                                <h5 class="dropdown-heading">Lorem ipsum dolor sit amet consectetur, adipisicing elit.
                                </h5>
                            </div>
                            <span class="dropdown-toggle-icon">+</span>
                        </div>
                        <div id="dropdown1" class="collapse dropdown-card-body">
                            <p class="para-A">Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolor quis
                                perspiciatis hic non laudantium atque vel illum, a nisi consequuntur, quae numquam
                                facere amet natus repellendus placeat sunt libero autem? </p>
                        </div>
                    </div>
                    <!-- Dropdown 2 -->
                    <div class="dropdown-card">
                        <div class="dropdown-card-header" data-bs-toggle="collapse" data-bs-target="#dropdown2">
                            <div class="d-flex align-items-center">
                                <h5 class="dropdown-heading">Lorem ipsum dolor sit amet consectetur, adipisicing elit.
                                </h5>
                            </div>
                            <span class="dropdown-toggle-icon">+</span>
                        </div>
                        <div id="dropdown2" class="collapse dropdown-card-body">
                            <p class="para-A">Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolor quis
                                perspiciatis hic non laudantium atque vel illum, a nisi consequuntur, quae numquam
                                facere amet natus repellendus placeat sunt libero autem? al.
                            </p>
                        </div>
                    </div>
                    <!-- Dropdown 3 -->
                    <div class="dropdown-card">
                        <div class="dropdown-card-header" data-bs-toggle="collapse" data-bs-target="#dropdown3">
                            <div class="d-flex align-items-center">
                                <h5 class="dropdown-heading">Lorem ipsum dolor sit amet consectetur, adipisicing elit.
                                </h5>
                            </div>
                            <span class="dropdown-toggle-icon">+</span>
                        </div>
                        <div id="dropdown3" class="collapse dropdown-card-body">
                            <p class="para-A">Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolor quis
                                perspiciatis hic non laudantium atque vel illum, a nisi consequuntur, quae numquam
                                facere amet natus repellendus placeat sunt libero autem? </p>
                        </div>
                    </div>
                    <!-- Dropdown 4 -->
                    <div class="dropdown-card">
                        <div class="dropdown-card-header" data-bs-toggle="collapse" data-bs-target="#dropdown4">
                            <div class="d-flex align-items-center">
                                <h5 class="dropdown-heading">Lorem ipsum dolor sit amet consectetur, adipisicing elit.

                                </h5>
                            </div>
                            <span class="dropdown-toggle-icon">+</span>
                        </div>
                        <div id="dropdown4" class="collapse dropdown-card-body">
                            <p class="para-A">Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolor quis
                                perspiciatis hic non laudantium atque vel illum, a nisi consequuntur, quae numquam
                                facere amet natus repellendus placeat sunt libero autem? ed memories.</p>
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
                    <label for="email-notifications" class="form-label">Recieve important updates and notification on
                        Email</label>
                    <div class="d-flex align-items-top gap-2">
                        <div>
                            <input type="email" class="form-control email" id="email-notifications"
                                placeholder="Enter your email" required>
                            <small class="error-message emailError"></small>
                        </div>
                        <button class="btn-success btn"><img src="<?= base_url('/assets/images/white-tick.png') ?>"
                                alt="User Image">Subscribe Now</button>
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
            <img src="<?= base_url('/assets/images/images/header-new-logo.png') ?>" alt="Logo">
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
            <img src="<?= base_url('/assets/images/images/header-new-logo.png') ?>" alt="Logo">
        </div>
        <h2>SAVED!!!</h2>
        <button class="close-btn" onclick="closemyModal()">Close</button>
    </div>
</div>
</div>
</div>

<!-- Success Modal -->
<div id="successModal" class="success-modal" style="display: none;">
    <div class="success-modal-content">
        <!-- Logo in the center -->
        <div class="success-logo">
            <img src="<?= base_url('/assets/images/images/header-new-logo.png') ?>" alt="Logo">
        </div>
        <h2>Data Saved Successfully</h2>
        <!-- OK button to close the modal and redirect -->
        <button class="success-close-btn" onclick="redirectToNextTab()">OK</button>
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
$(document).ready(function() {
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
    $vendorName.on('input', function() {
        $profileName.text($(this).val());
    });

    $vendorEmail.on('input', function() {
        $profileEmail.text($(this).val());
    });

    $phoneNumber.on('input', function() {
        $profilePhone.text($(this).val());
    });

    $joiningDate.on('input', function() {
        $profileDate.text($(this).val());
    });

    $gstNumber.on('input', function() {
        $profileGST.text($(this).val());
    });

    $vendorcompanyName.on('input', function() {
        $companyName.text($(this).val());
    });

    $panCardNumber.on('input', function() {
        $profilePanCard.text($(this).val());
    });

    $city.on('input', function() {
        $profileCity.text($(this).val());
    });

    $status.on('change', function() {
        $profileStatus.text($(this).val());
    });

    // Profile image upload
    $uploadIcon.on('click', function() {
        $imageUpload.click();
    });

    $imageUpload.on('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                $profileImage.attr('src', e.target.result);
            };
            reader.readAsDataURL(file);
        }
    });
});

$(document).ready(function() {
    const $statusDropdown = $('#status');
    const $profileStatus = $('#profileStatus');

    // Function to update the status text and color
    const updateStatus = () => {
        const statusValue = $statusDropdown.val();
        $profileStatus.text(statusValue);

        if (statusValue === "Approved") {
            $profileStatus.css({
                'color': '#7CFFAC',
                'font-weight': 'semi-bold'
            });
        } else if (statusValue === "Blocked") {
            $profileStatus.css({
                'color': 'red',
                'font-weight': 'semi-bold'
            });
        }
    };

    // Initial status update on page load
    updateStatus();

    // Update status on dropdown change
    $statusDropdown.on('change', function() {
        updateStatus();
    });
});

flatpickr(".date", {
    enableTime: false, // Enables time selection
    minDate: "today", // Allows only future dates
    dateFormat: "d-m-Y ", // Format: Year-Month-Day Hour:Minute
    allowInput: false // Disables manual input
});


$(document).ready(function() {
    $('.category-checkbox').on('change', function() {
        const selectedCategories = $('.category-checkbox:checked')
            .map(function() {
                return $(this).val();
            })
            .get()
            .join(',');

        $('#selectedCategories').val(selectedCategories);
    });

    // Close dropdown when clicked outside
    $(document).on('click', function(e) {
        if (!$(e.target).closest('.dropdown').length) {
            $('.dropdown-menu').removeClass('show');
        }
    });

    // Keep dropdown open only while interacting with the menu or button
    $('.dropdown-menu').on('click', function(e) {
        e.stopPropagation();
    });
});



// Listen for checkbox changes
document.querySelectorAll('.category-checkbox').forEach((checkbox) => {
    checkbox.addEventListener('change', function() {
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
                input.style.margin = '5px';
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







$(document).ready(function() {
    $(".info-tabs").click(function() {
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


$(document).ready(function() {
    $('#signature').on('change', function() {
        const fileInput = this;
        const previewContainer = $('#signaturePreview');
        const file = fileInput.files[0];

        // Clear previous content
        previewContainer.empty();

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
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

$(document).ready(function() {
    const $dropdowns = $('.dropdown-card');

    $dropdowns.each(function() {
        const $dropdown = $(this);
        const $collapseElement = $dropdown.find('.collapse');
        const $headingElement = $dropdown.find('.dropdown-heading');
        const $toggleIcon = $dropdown.find('.dropdown-toggle-icon');

        // When the dropdown is expanding
        $collapseElement.on('show.bs.collapse', function() {
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
        $collapseElement.on('hide.bs.collapse', function() {
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


document.getElementById("conf-account-number").addEventListener("input", function() {
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


function checkPhone(number) {
    console.log(number);

    $.ajax({
        url: '<?= base_url('checkPhone') ?>',
        type: 'POST',
        data: JSON.stringify({ 'number': number }),  
        contentType: 'application/json',  
        success: function(response) {
            try {
                let res = JSON.parse(response);
                if (res.status === 'success') {
                    document.getElementById('basicId').innerText = res.id;
                    showSuccessModal();
                } else {
                    showErrorModal();
                }
            } catch (e) {
                console.error('Parsing error:', e);
                showErrorModal();
            }
        },
        error: function(xhr, status, error) {
            console.error('Error:', error);
            showErrorModal();
        }
    });
}


document.getElementById("confirm-password").addEventListener("input", function() {
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

document.getElementById("passwordForm").addEventListener("submit", function(e) {
    const newPassword = document.getElementById("new-password").value;
    const confirmPassword = document.getElementById("confirm-password").value;

    if (newPassword !== confirmPassword) {
        e.preventDefault();
        showModal();
    }
});


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

// $('#countryDropdown').on('change', function() {
//     const countryId = $(this).val(); // Get the selected country ID
//     if (countryId) {
//         getStates(countryId); // Fetch and populate states
//     } else {
//         $('#state').html('<option value="">Select State</option>'); // Reset dropdown if no country is selected
//     }
// });



function getStates(countryId) {
    
    // Reset the state dropdown and show a loading indicator
    $('#state').html('<option value="">Loading...</option>');
    console.log(countryId);
    if (countryId) {
        $.ajax({
            url: '<?= base_url('getStates') ?>', // Replace with your actual endpoint
            type: 'POST',
            dataType: 'json',
            contentType: 'application/json',
            data: JSON.stringify({
                id: countryId
            }),
            success: function(response) {
                if (response.status === 'success') {
                    let states = response.response;
                    let options = '<option value="">Select State</option>';

                    if (states.length > 0) {
                        states.forEach(function(state) {
                            options += `<option value="${state.id}">${state.name}</option>`;
                        });
                    } else {
                        options += '<option value="">No states available</option>';
                    }

                    $('#state').html(options);
                } else {
                    alert(response.message || 'Failed to load states.');
                    $('#state').html('<option value="">Select State</option>');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                alert('An error occurred while fetching states.');
                $('#state').html('<option value="">Select State</option>');
            }
        });
    } else {
        $('#state').html('<option value="">Select State</option>'); // Reset dropdown if no country selected
    }
}



function saveVendorData() {

    const formElement = document.getElementById('basicForm');
    const formData = new FormData(formElement);
    $.ajax({
        url: '<?= base_url('saveVendor') ?>',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            res = JSON.parse(response);
            if (res.status === 'success') {
                document.getElementById('basicId').innerText = res.id;
                showSuccessModal()
                // alert('Vendor data saved successfully!');
            } else {
                showErrorModal()
                // alert('please try again later');
            }
        },
        error: function(xhr, status, error) {
            console.error('Error:', error);
            showErrorModal()
            // alert('An error occurred while saving vendor data. Please try again.');
        }
    });
}


function saveBank() {
    id = document.getElementById('basicId').innerText;

    if (id == '') {
        alert('please save basic details first');
        return
    }
    const formElement = document.getElementById('bankDetails');
    const formData = new FormData(formElement);
    formData.append('vendor_id', id);

    //formData.append('id',id);
    $.ajax({
        url: '<?= base_url('saveBank') ?>',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            res = JSON.parse(response);
            if (res.status === 'success') {
                showSuccessModal()
                // alert('Vendor data saved successfully!');
            } else {
                showErrorModal()
                // alert('please try again later');
            }
        },
        error: function(xhr, status, error) {
            console.error('Error:', error);
            showErrorModal()
            // alert('An error occurred while saving vendor data. Please try again.');
        }
    });
}



function saveSignature() {
        let vendorId = "<?= $this->session->userdata('vendor_app_id') ?>";
        let vendorExp = "<?= $this->session->userdata('vendor_exp') ?>";
        let currentTime = "<?= time() ?>";

        if (vendorId && vendorExp > currentTime) {
            console.log('Hi');
        }

        const formElement = document.getElementById('signatureForm');
        const formData = new FormData(formElement);
        formData.append('vendor_id', vendorId);

        // Debugging
        console.log("Vendor ID:", vendorId);
        console.log("Form Data:", [...formData.entries()]);

        // Example: Sending data via AJAX (Modify URL accordingly)
        fetch('save-signature', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => showSuccessModal())
        .catch(error => console.error('Error:', error));
    }
// Function to show success modal
function showSuccessModal() {
    document.getElementById("successModal").style.display = "flex";
}

// Function to show error modal
function showErrorModal() {
    document.getElementById("errorModal").style.display = "flex";
}

// Function to close success modal
function closeSuccessModal() {
    document.getElementById("successModal").style.display = "none";
}

// Function to close error modal
function closeErrorModal() {
    document.getElementById("errorModal").style.display = "none";
}

// Function to close the success modal and switch to the next tab
function redirectToNextTab() {
    // Close the success modal
    document.getElementById("successModal").style.display = "none";

    // Find the current active tab
    const currentTab = $(".info-tabs.active-tab");

    // Find the next tab
    const nextTab = currentTab.next(".info-tabs");

    // If there is a next tab, simulate a click to switch to it
    if (nextTab.length > 0) {
        nextTab.click(); // Trigger the click event for the next tab
    }
}
</script>

</body>

</html>