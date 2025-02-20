
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

.update-address {
    display: flex;
    justify-content: end;
}

.update-address button {
    background-color: #007bff;
    border: 1px solid #007bff;
    color: #FFFFFF;
}

.update-address button:hover {
    background-color: #007bff;
    border: 1px solid #007bff;
    color: #FFFFFF;
}

@media (max-width: 768px) {
    #alertModal {
        margin: 10px;
    }
}
</style>




</header>
<?php
$states = $this->db->select('states.*')->from('states')->where('states.is_active',1)->get()->result_array();
?>
<!-- ===========main-container============== -->
<div class="content user-profile-page-wrapper">
    <div class="container my-3">
        <div class="row">
            <div class="col-md-4">
                <div class="profile-card">
                    <div class="profile-img">
                        <?php
                            if($data['image']){
                                $image = base_url('/').$data['image'];
                            }else{
                                $image = 'https://via.placeholder.com/100';
                            }
                            ?>
                        <img id="profileImage" src="<?= $image ?>" alt="Profile Image">
                        <img src="<?= base_url('/assets/images/camera.png') ?>" id="uploadIcon" alt="icon" width="45px">
                    </div>

                    <div class="card-details p-3">
                        <h2 id="profileName"><?= $data['name']  ?></h2>
                        <p>
                        <h6>Email ID:</h6> <span id="profileEmail"><?= $data['Email']  ?></span></p>
                        <!-- <p><h6>Phone:</h6> <span id="profilePhone"><?= $data['PhoneNumber'] ?></span></p> -->
                        <p>
                        <h6>Date of Birth: </h6> <span id="profileDate"><?= $data['birth_date']  ?></span></p>
                        <p>
                        <h6>Address:</h6> <span id="profileAddress"><?= $data['address']  ?></span></p>
                    </div>
                </div>
            </div>
            <div class=" form-section col-md-8">
                <form action="editUser" method="post" enctype="multipart/form-data">
                    <input type="file" id="imageUpload" name="image" class="hidden" accept="image/*">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="name" class="form-label">Full Name</label>
                            <input type="text" name="name" value="<?= set_value('name')?>" class="form-control"
                                id="name" placeholder="Enter Your Name" required>
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email ID</label>
                            <input type="email" name="email" value="<?= set_value('email')?>" class="form-control"
                                id="email" placeholder="yourname12@yourmail.com" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="product-status" class="form-label">Your Gender</label>
                            <select id="product-status" name="gender" class="form-select" required>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Female">Other</option>
                                <!-- Add statuses here -->
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="date" class="form-label me-1"> Date of Birth</label>
                            <!-- <input type="date" name = "birth_date" value="<?= set_value('birth_date')?>"  class="form-control" id="date" placeholder="23/08/2024" required> -->
                            <input type="date" name="birth_date" id="date" placeholder="23/08/2024"
                                value="<?= set_value('birth_date')?>" class="form-control" required>
                        </div>
                    </div>
                    <div class="row mb-3">

                        <div class="col-md-6">
                            <label for="city" class="form-label">City</label>
                            <input type="text" name="city" value="<?= set_value('city')?>" class="form-control"
                                id="city" placeholder="New Delhi" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" name="address" name="<?= set_value('address')?>" class="form-control"
                            id="address" placeholder="House No.1234 , XYZ  city ...." required>
                    </div>
                    <div>
                        <button class="btn btn-primary ">SAVE NOW</button>
                    </div>
                </form>

                <div class="main d-flex">
                    <div class="address-container col-md-12">
                        <div class="d-flex heading-btn justify-content-between">
                            <div>
                                <h2 class="mb-1">Shipping Address</h2>
                                <!-- <p>Lorem Ipsum is simply dummy text of the printing.</p> -->
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-4 me-5">
                                <button id="addNewBtn" class="btn btn-light">+ ADD NEW</button>
                            </div>
                        </div>

                        <div id="addressContainer" class="row g-3 d-flex justify-content-between">
                            <!-- Existing address cards (if any) -->

                            <?php if(!empty($data['addresses'])){ ?>
                            <?php foreach ($data['addresses'] as $address) {?>


                            <div class="address-card ">
                                <input type="radio" <?= $check = ($address['is_default']==='1') ? "checked" : '' ;?>
                                    name="selectedAddress" class="select-address radio-inp">
                                <div class="d-flex gap-2">
                                    <div class="icon">
                                        <img src="<?= base_url('/assets/images/address-card-icon.png')?>" alt="">
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
                                        <img src="<?= base_url('/assets/images/three-dots.png') ?>" alt="menu">
                                    </button>
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
                                            <h5 class="modal-title" id="deleteConfirmationModalLabel">Delete Address
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Do you want to delete this address?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">No</button>
                                            <button type="button" class="btn btn-danger"
                                                id="confirmDeleteBtn">Delete</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- Additional cards will be added here -->
                    </div>
                </div>


                <div class="modal fade" id="editAddressModal" tabindex="-1" aria-labelledby="addAddressModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addAddressModalLabel">Add New Address</h5>
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
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="postcode" class="form-label">Post Code</label>
                                            <input type="text" name="pincode" class="form-control" id="postcode"
                                                required>
                                            <small class="error-message text-danger"></small>
                                        </div>
                                        <div class="col-md-6 mb-3">
											                             <div style="flex-direction: column; display: flex;">
                           <label for="postcode" class="form-label">State</label>
                            <select class="modal-state" name="state" id="postcode">
								<option>Select State</option>
								<?php foreach($states as $state)?>
                                
                                <option value="<?= $state['name']?>"><?= $state['name']?></option>
                              
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


                <!-- Add New Address Modal -->
                <div class="modal fade" id="addAddressModal" tabindex="-1" aria-labelledby="addAddressModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addAddressModalLabel">Add New Address</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="addressForm">
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
                                            <input type="email" name="email" class="form-control email" id="email"
                                                required>
                                            <small class="error-message text-danger"></small>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="city" class="form-label">Town / City</label>
                                            <input type="text" name="city" class="form-control text-only" id="city"
                                                required>
                                            <small class="error-message text-danger"></small>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="apartment" class="form-label">Apartment, suite, etc.
                                                (optional)</label>
                                            <input type="text" name="apartment" class="form-control" id="apartment">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="postcode" class="form-label">Post Code</label>
                                            <input type="text" name="pincode" class="form-control" id="postcode"
                                                required>
                                            <small class="error-message text-danger"></small>
                                        </div>
                                        <div class="col-md-6 mb-3">
											                             <div style="flex-direction: column; display: flex;">
                           <label for="postcode" class="form-label">State</label>
                                      <select class="modal-state" name="state" id="postcode">
								<option>Select State</option>
								<?php foreach($states as $state)?>
                                
                                <option value="<?= $state['name']?>"><?= $state['name']?></option>
                              
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
                                    <button type="button" onclick="saveAddress()"
                                        class="btn btn-dark d-flex align-items-center gap-2" disabled id="submitButton">
                                        <img src="images/white-tick.png" alt=""> Save New Address
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


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

<?php $this->load->view('User/footer'); ?>


<!-- =============================news-letter-starts========================= -->
<!-- ( changes-11/09/2024)  full html change-->






<!-- ====================Deals of the day Ends============================ -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script>
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





$(document).ready(function() {
    // Elements
    const profileName = $('#profileName');
    const profileEmail = $('#profileEmail');
    const profilePhone = $('#profilePhone');
    const profileDate = $('#profileDate');
    const profileImage = $('#profileImage');
    const imageUpload = $('#imageUpload');
    const profileAddress = $('#profileAddress');

    const nameInput = $('#name');
    const emailInput = $('#email');
    const contactInput = $('#contact');
    const dateInput = $('#date');
    const addressInput = $('#address');

    // Update profile card on input change
    nameInput.on('input', function() {
        profileName.text($(this).val());
    });
    emailInput.on('input', function() {
        profileEmail.text($(this).val());
    });
    contactInput.on('input', function() {
        profilePhone.text($(this).val());
    });
    dateInput.on('input', function() {
        profileDate.text($(this).val());
    });
    addressInput.on('input', function() {
        profileAddress.text($(this).val());
    });


    // Profile image upload
    $('#uploadIcon').on('click', function() {
        imageUpload.click();
    });

    imageUpload.on('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                profileImage.attr('src', e.target.result);
            };
            reader.readAsDataURL(file);
        }
    });
});


flatpickr("#date", {
    enableTime: false,
    maxDate: "today",
    dateFormat: "d-m-Y",
    allowInput: false
});


function alertModal() {
    event.preventDefault();
    const modal = document.getElementById('alertModal');
    modal.style.display = 'block';
}



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


// Function to close the modal
function closeAlertModal() {
    event.preventDefault();
    const modal = document.getElementById('alertModal');
    modal.style.display = 'none';
}


// =============address-card-javascript=================

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
                let editdata = resp.message;
                document.getElementById('fullName').value = editdata.name;
                document.getElementById('phone').value = editdata.phone;
                document.getElementById('emails').value = editdata.email;
                document.getElementById('citys').value = editdata.city;
                document.getElementById('apartment').value = editdata.apartment;
                document.getElementById('postcode').value = editdata.pincode;
                document.getElementById('street').value = editdata.streetAddress;
                document.getElementById('addId').innerText = editdata.id;
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
                document.getElementById('alertResponse').innerHTML = 'Details Updated Successfully';
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
</script>

</body>

</html>