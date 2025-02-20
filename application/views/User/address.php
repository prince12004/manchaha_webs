<?php $this->load->view('User/header') ?>
<!-- --------------nav-section-end------------ -->

</header>
<div class="main d-flex am">
    <div class="address-container col-md-7 mt-5">
        <div class="d-flex justify-content-between">
            <div>
                <h2 class="mb-1">Shipping Address</h2>
                <p>Lorem Ipsum is simply dummy text of the printing.</p>
            </div>
            <div class="d-flex justify-content-between align-items-center mb-4 me-5">
                <button id="addNewBtn" class="btn btn-light">+ ADD NEW</button>
            </div>
        </div>

        <div id="addressContainer" class="row g-3">
            <!-- Existing address cards (if any) -->
            <div class="col-md-6">
                <div class="address-card mb-2">
                    <input type="radio" name="selectedAddress" class="select-address radio-inp">
                    <div class="d-flex gap-2">
                        <div class="icon">
                            <img src="images/address-card-icon.png" alt="">
                        </div>
                        <label>
                            <h5 class="address-name">Home Address</h5>
                            <p class="address-street">Street no. 20, Building 32, Floor Lorem</p>
                            <p class="address-city">New Delhi 110001</p>
                            <p><strong class="address-phone">+91 12345 67890</strong></p>
                            <p class="address-email">example@example.com</p>
                        </label>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button"
                            id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="images/three-dots.png" alt="menu">
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <li><a class="dropdown-item edit-option" href="#">Edit</a></li>
                            <li><a class="dropdown-item delete-option" href="#">Delete</a></li>
                        </ul>
                    </div>
                </div>

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
        <div class="product-title"></div>
        <div class="product-description"></div>
        <div class="product-item d-flex">
            <img src="https://via.placeholder.com/100" alt="Course Image">
            <div class="product-info">
                <h5></h5>
                <p></p>
                <p class="d-flex align-items-center blue-text">📅</p>
                <p><strong>Size :</strong> <strong>Qunatity : </strong></p>

                <div class="product-price"> 00 &#8377;</div>
            </div>
        </div>
        <div class="product-item d-flex">
            <img src="https://via.placeholder.com/100" alt="Course Image">
            <div class="product-info">
                <h5></h5>
                <p></p>
                <p class="d-flex align-items-center blue-text">📅 Date:</p>
                <p><strong>Size :</strong> / <strong>Qunatity : </strong></p>

                <div class="product-price"> 00.00 &#8377;</div>
            </div>
        </div>
        <div class="order-summary">
            <div class="row">
                <div class="col">
                    <span>Subtotal</span>
                    <span> <strong> 00.00 &#8377;</strong></span>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <span>Shipping</span>
                    <span><strong>+ 00%</strong> </span>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <span>Shipping Cost</span>
                    <span><strong>00.00 &#8377;</strong> </span>
                </div>
            </div>
            <div class="row total">
                <div class="col">
                    <span>Total:</span>
                    <span> <strong>0.00 &#8377;</strong></span>
                </div>
            </div>
        </div>
        <a href="#" class="btn-complete-payment">Complete Payment</a>
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
                        <input type="text" name="name" class="form-control text-only" id="fullName" required>
                        <small class="error-message text-danger"></small>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" name="phone" class="form-control numbers-only" id="phone" required>
                            <small class="error-message text-danger"></small>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Email ID</label>
                            <input type="email" name="email" class="form-control email" id="email" required>
                            <small class="error-message text-danger"></small>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="city" class="form-label">Town / City</label>
                            <input type="text" name="city" class="form-control text-only" id="city" required>
                            <small class="error-message text-danger"></small>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="apartment" class="form-label">Apartment, suite, etc. (optional)</label>
                            <input type="text" name="apartment" class="form-control" id="apartment">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="postcode" class="form-label">Post Code</label>
                            <input type="text" name="pincode" class="form-control" id="postcode" required>
                            <small class="error-message text-danger"></small>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="street" class="form-label">Street address *</label>
                        <input type="text" name="streetAddress" class="form-control" id="street" required>
                        <small class="error-message text-danger"></small>
                    </div>
                    <button type="button" onclick="saveAddress()" class="btn btn-dark d-flex align-items-center gap-2"
                        disabled id="submitButton">
                        <img src="images/white-tick.png" alt=""> Save New Address
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>





<!-- =============================newsLetter-section====================== -->

<?php $this->load->view('User/footer') ?>


<!-- ====================Deals of the day Ends============================ -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

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
    let editingCard = null;
    let cardToDelete = null;

    // Open the modal when "Add New" button is clicked
    $('#addNewBtn').on('click', function() {
        editingCard = null;
        $('#addressForm')[0].reset();
        $('#addAddressModal').modal('show');
    });

    // Handle the form submission
    $('#addressForm').on('submit', function(e) {
        e.preventDefault();

        const fullName = $('#fullName').val();
        const phone = $('#phone').val();
        const email = $('#email').val();
        const city = $('#city').val();
        const apartment = $('#apartment').val();
        const street = $('#street').val();

        if (editingCard) {
            $(editingCard).find('.address-name').text(fullName);
            $(editingCard).find('.address-phone').text(phone);
            $(editingCard).find('.address-email').text(email);
            $(editingCard).find('.address-street').text(
                `${street}, ${city} ${apartment ? ', ' + apartment : ''}`);
            $(editingCard).find('.address-city').text(city);
        } else {
            const newCard = `
                <div class="col-md-6">
                    <div class="address-card mb-2">
                        <input type="radio" name="selectedAddress" class="select-address radio-inp">
                        <div class="d-flex gap-2">
                            <div class="icon">
                                <img src="images/address-card-icon.png" alt="">
                            </div>
                            <label>
                                <h5 class="address-name">${fullName}</h5>
                                <p class="address-street">${street}, ${city} ${apartment ? ', ' + apartment : ''}</p>
                                <p class="address-city">${city}</p>
                                <p><strong class="address-phone">${phone}</strong></p>
                                <p class="address-email">${email}</p>
                            </label>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="/images/three-dots.png" alt="menu">
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <li><a class="dropdown-item edit-option" href="#">Edit</a></li>
                                <li><a class="dropdown-item delete-option" href="#">Delete</a></li>
                            </ul>
                        </div>
                    </div>
                </div>`;
            $('#addressContainer').append(newCard);
        }

        $('#addAddressModal').modal('hide');
    });

    // Edit an existing card
    $('#addressContainer').on('click', '.edit-option', function() {
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

        $('#addAddressModal').modal('show');
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
</script>

</body>

</html>