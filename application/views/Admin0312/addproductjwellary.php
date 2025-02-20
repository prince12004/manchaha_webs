<?php $this->load->View('Admin/header') ?>
    <style>
       .product-container-3 {
    position: relative;
    width: 200px;
    height: 200px;
    border: 2px solid #ddd;
    padding: 10px;
    background-color: #ddd;
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    grid-template-rows: repeat(2, 1fr);
    gap: 5px;
    justify-items: center;
    align-items: center;
}

.add-image-btn {
    width: 45px;
    height: 45px;
    background-color: #f0f0f0;
    border: 2px dashed #bbb;
    border-radius: 50%;
    cursor: pointer;
    display: flex;
    align-items: center;
    position: absolute;
    /* top: -20px;
    right: -20px; */
    justify-content: center;
    grid-column: span 2; /* Make the plus button span across both columns */
}

.image-preview-container {
    display: contents; /* Ensure images are placed directly in the grid without extra wrapping */
}

.image-box {
    position: relative;
    width: 80px; /* Same size as the add button */
    height: 80px;
    background-color: #f5f5f5;
    border-radius: 5px;
    display: flex;
    align-items: center;
    justify-content: center;
    /* overflow: hidden; */
}

.image-box img {
    max-width: 100%;
    max-height: 100%;
    object-fit: cover;
}

.delete-icon {
    position: absolute;
    top: -8px;
    right: -8px;
    width: 20px;
    height: 20px;
    font-size: 14px;
    display: flex;
    justify-content: center;
    align-items: center;
    font-weight: 700;
    cursor: pointer;
    background-color: rgba(255, 0, 0);
    border: 1px solid  rgba(255, 0, 0);
    border-radius: 50%;
    /* padding: 2px; */
    color: white;
}
.input-image{
    opacity: 0;
    position: absolute;
}
.text-success{
    font-size: 20px;
    font-weight: 700;
    text-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
    color: #20a920!important;
}

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
.image-popup {
    position: absolute;
    z-index: 9999;
    border: 5px solid #fff;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.7);
    max-width: 500px; /* Increase to double the current size */
    max-height: 500px; /* Increase to double the current size */
    overflow: hidden;
    transition: opacity 0.3s ease-in-out;
}

.image-popup .popup-img {
    width: 100%;  /* Ensure the image scales to fit the popup size */
    height: auto;
}
#confirmDelete{
    padding:8px 20px;
    border-radius:25px;
    border:none;
    background-color:#4a90e2;
    color:#FFF;
    font-weight:500
}
#cancelDelete{
    padding:8px 20px;
    border-radius:25px;
    border:none;
    background-color:#333;
    color:#FFF;
    font-weight:500
}
.modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.8);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 1000;
    }
    .modal-overlay img {
        max-width: 90%;
        max-height: 90%;
    }
    #fullScreenModal .close-button {
        position: absolute;
        top: 20px;
        right: 20px;
        font-size: 30px;
        color: white;
        cursor: pointer;
    }

    .form-action-btn .btn{
        padding:8px 20px ;
        border-radius:25px;
        box-shadow:0px 8px 20px rgba(0,0,0,0.2);
    }
    .form-action-btn .btn span{
        margin-right:5px;
    }


.col-md-6 input[type="number"]::-webkit-inner-spin-button,
   .col-md-6 input[type="number"]::-webkit-outer-spin-button {
    display: none;
   }



    </style>
        <div class="mt-2">
        <form id="submit_form" action="addJwellery" method="post" enctype="multipart/form-data">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1 class="add-product-h1 mt-3">Add Products(Jewellery)</h1>
                    <?php 
                    if($this->session->flashdata('message')){
                        echo'<pre class="text-success" style="display:flex; justify-content:center; position: relative; left: 25vw">';
                        print_r($this->session->flashdata('message'));
                        echo '</pre>';

                    }
                    ?>
                </div>
                
                
            </div>
            
            <div class="row">
            <div class="col-md-4">
                <div class="section container mb-3">
                <h5>Category</h5>

                    <!-- Product Category -->
                        <label for="product-category" class="form-label">Product Category</label>
                        <select id="product-category" name="category" class="form-select" required>
                        <option value="">Select Category</option>
                        <?php foreach($data as $cat){ ?>
                        <option value="<?= $cat['CategoryID'] ?>"><?= $cat['CategoryName'] ?></option>
                        <?php } ?>
                        </select>

                        <!-- Sub Category 01 -->
                        <label for="sub-category-01" class="form-label">Sub Category 01</label>
                        <select id="sub-category-01" name="subcategory1" class="form-select" required>
                            <option value="">Select Sub Category</option>
                        </select>

                    <!-- Sub Category 02 -->
                        <label for="sub-category-02" class="form-label">Sub Category 02</label>
                        <select id="sub-category-02" name="sub-category-2" class="form-select" >
                            <option value="">Select Sub Category</option>
                        </select>

                        <!-- Sub Category 03 -->
                        <label for="sub-category-03" class="form-label">Sub Category 03</label>
                        <select id="sub-category-03" name="sub-category-3" class="form-select" >
                            <option value="">Select Sub Category</option>
                        </select>
                    </div>

                    <!-- ---------Inventory------------ -->
                    <div class="section container  mb-3">
                        <h5>INVENTORY</h5>
                        <!-- product id -->
                        <label for="Product ID" class="form-label">Product ID</label>
                        <input id="Product-ID" name="product_id" value="<?= set_value('product_id')?>" type="text" class="form-input" required>
                        <!-- Visibility -->
                        <label for="product-visibility" class="form-label">Visibility Status</label>
                        <select id="Visibility-status" name="visibility" <?= set_value('visibility')?> class="form-select" required>
                            <option>Published</option>
                            <option>Un-Published</option>
                        </select>
                        <!-- product id -->
                        <!-- <label for="SKU" class="form-label">SKU</label>
                        <input id="SKU" type="text" name="sku"<?= set_value('sku')?> class="form-input" required> -->
                        <!-- Discount type -->
                        <label for="Discount type" class="form-label">Discount Type</label>
                        <select id="Discount-type" name="discount" class="form-select" required>
                            <option value ="10">10%</option>
                            <option value ="20">20%</option>
                            <option value ="30">30%</option>
                            <option value ="40">40%</option>
                            <option value ="50">50%</option>
                            <option value ="60">60%</option>
                            <option value ="70">70%</option>
                            <option value ="80">80%</option>
                            <option value ="90">90%</option>
                        </select>
                         <!-- Product Tags -->
                        <label for="product tags" class="form-label">Product Tags</label>
                        <select id="Product-tags" name="tag" class="form-select" required>
                            <option value ="Tag01">Tag 01</option>
                            <option value ="Tag02">Tag 02</option>
                        </select>
                        <!-- Publish Schedule -->
                        <label for="Publish-Schedule" class="form-label">Publish Schedule(Date and Time)</label><br>
                        <input type="text" name="publish_date" 
                                id="Publish-Schedule" 
                                value="<?= set_value('publish_date') ?>" 
                                class="form-input" 
                                required>
                            


                    </div>
                </div>
                <div class="col-md-8">
                    <div class="section container  mb-3">
                        <h5>General Information</h5>
                        <label for="product-name" class="form-label">Product Name</label>
                        <input type="text" id="product-name" name ="product_name" value="<?= set_value('product_name') ?>" class="form-control" placeholder="Type Product Name here..." required>
                        <label for="product-description" class="form-label mt-3">Description</label>
                        <textarea id="product-description" name="product_description" value="<?= set_value('product_description') ?>" class="form-control" rows="3" placeholder="Type Product Description here..." required></textarea>
                    </div>
                    <div class="section container mb-3">
                       <div class="product-discription-cont">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h5>Product Discription</h5>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label for="material Type" class="form-label">Material Type</label>
                                    <input id="material-type" name="material_type" value="<?= set_value('material_type') ?>" type="text" class="form-input " placeholder="Crystal" required>
                                </div>
                                <div class="col-6">
                                    <label for="metal Type" class="form-label">Metal Type</label>
                                    <input id="metal-Type" name="metal_type" type="text" value="<?= set_value('metal_type') ?>" class="form-input " placeholder="Silver" required>
                                </div>
                             </div>
                             <div class="row">
                                <div class="col-6">
                                    <label for="Gem Type" class="form-label">Gem Type</label>
                                    <input id="gem-Type" name="gem_type" value="<?= set_value('gem_type') ?>" type="text" class="form-input" placeholder="Crystal" required>
                                </div>
                                <div class="col-6">
                                    <label for="Occasion Type" class="form-label">Occasion Type</label>
                                    <input id="Occasion-Type" name="occation_type" value="<?= set_value('occation_type') ?>" type="text" class="form-input" placeholder="Party, Valentines Day, Wedding, Birthday, Anniversary" required>
                                </div>
                             </div>
                             <div class="row">
                                <div class="col-6">
                                    <label for="Ideal For" class="form-label">Ideal For</label>
                                    <input id="Ideal-For" name="ideal_for" type="text" value="<?= set_value('ideal_for') ?>" class="form-input" placeholder="Women" required>
                                </div>
                                <div class="col-6">
                                    <label for="Sizing" class="form-label">Sizing </label>
                                    <input id="Product-Sizing" name="sizing" type="text" value="<?= set_value('sizing') ?>" class="form-input" placeholder="Adjustable" required>
                                </div>
                             </div>
                             <div class="row">
                                <div class="col-6">
                                    <label for="finish" class="form-label">Finish</label>
                                    <input id="product-Finish" name="product_finish" type="text" value="<?= set_value('product_finish') ?>" class="form-input text-only" placeholder="Glossy" required>
                                </div>
                                <div class="col-6">
                                    <label for="Generic Name"  class="form-label">Generic Name</label>
                                    <input id="Generic-Name" name="generic_name" value="<?= set_value('generic_name') ?>" type="text" class="form-input text-only" placeholder="Bracelets" required>
                                </div>
                             </div>
                       </div>
                       
                    </div>
<div class="section container mb-3">
                        <div class="row">
                            <h5>Policy Informtaion</h5>
                           
                            <div class="col-md-6 ">
                                <label for="product grade" class="form-label mt-3">Seller Policy</label>
                                <select id="product-grade" name="policy_type" class="form-select">
                                    <option value = "return" >Return</option>
                                    <option value = "replacement" >Replacement</option>
                                    <option value = "Refund" >Refund</option>
                                </select>
                            </div>
                            <div class="col-md-6 ">
                                <label for="product grade" class="form-label mt-3">Number of days</label>
                                <input type="text" class="form-input numbers-only" name="policy_time" placeholder="number of days">
                            </div>
                        </div>
                    </div>
                    <div class="section container mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h5>Product Information</h5>
                            <a id="add-variant-btn" class="product-info-btn d-flex justify-content-center gap-1 align-items-center">
                                <span class="material-symbols-outlined">add_circle</span> Add Variant
                            </a>
                        </div>

                        <div id="variants-container">
                            <div class="variant-section mb-3 mt-5">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="product-container-3">
                                        <div class="custom-file-input-container" style="position: absolute; top: -35px; left: 20px; background-color: #3182ce; color: white; padding: 5px 20px; border-radius: 5px;font-size:13px; width:150px">
                                            <input type="file" class="preview-input" name="images[0][]" accept="image/*" multiple id="fileInput" style="display: none;">
                                            <label for="fileInput" class="d-flex justify-content-center preview-input-btn">*Upload Images</label>
                                        </div>
                                        <div class="image-preview-container"></div>
                                    </div>
                                        <div class="details">
                                            <div class="row">
                                                <div class="col-4">
                                                    <label for="Item Dimensions" class="form-label">Item Dimensions :</label>
                                                    <input type="text" name="dimension[]" class="form-input" placeholder="23 x 3 x 2 Centimeters">
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="Color" class="form-label">*Color</label>
                                                    <input type="text" name="color[]" class="form-input" placeholder="Rose Gold" required>
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="Color" class="form-label">*SKU Code</label>
                                                    <input type="text"  name="var_sku[]" class="form-input" placeholder="sku" required>
                                                </div>
                                                <div class="col-md-2">
                                                    <label for="Weight" class="form-label">Weight:</label>
                                                    <input type="text" name="weight[]" class="form-input numbers-only" placeholder="20 g" required>
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="Stock" class="form-label">*Stock</label>
                                                    <input type="text" name="stock[]" class="form-input numbers-only" placeholder="256" required>
                                                </div>
                                                <div class="col-4">
                                                    <label for="Product Base Price" class="form-label">*Product Base Price :</label>
                                                    <input type="text" id="base_price" name="base_price[]" class="form-input numbers-only" placeholder="Type Base price" required>
                                                </div>
                                                <div class="col-4">
                                                    <label for="Sale Price" class="form-label">*Sale Price:</label>
                                                    <input type="text" id="sale_price" name="sale_price[]" class="form-input numbers-only" placeholder="Type sale price" required oninput="validatePrices()">
                                                </div>
                                                <p id="price-error" style="color: red; display: none;"><small>Product Sale Price should be less than or equal to the Base Price.</small></p>
                                            </div>
                                            <div class="row d-flex justify-content-center">
                                                <div class="col-4">
                                                    <label for="Product Status" class="form-label">Product Status:</label>
                                                    <select class="form-select" name="status[]">
                                                        <option value="1">Active</option>
                                                        <option value="2">Not-Active</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <button class="delete-btn remove-variant" type="button">
                                            <span class="material-symbols-outlined">delete</span>
                                        </button>
                                    </div>
                                </div>
                            </div>

                    </div>
                </div>
                <div class="d-flex gap-5 form-action-btn justify-content-center mb-5 mt-4">
                    <button type="submit" class="btn btn-dark me-2 d-flex align-items-center"><span class="material-symbols-outlined">
                        check_circle
                        </span>Save Now</button>
                    <button type="button" class="btn btn-light d-flex align-items-center me-4"><span class="material-symbols-outlined">
                        cancel
                        </span>Cancel Now</button>
                </div>
            </form>
            <!-- Modal -->
            <div id="modal" class="modal" style="display: none;">
                <div class="modal-content">
                    <!-- Logo in the center -->
                    <div class="modal-logo">
                      <img src="<?= base_url('/assets/images/images/logo.png') ?>" alt="Logo" >
                    </div>
                    <h2>Please fill in the required fields before adding a new variant</h2>
                    <p>The fields marked with asterisks (*) are required.</p>
                    <button class="close-btn" onclick="closeModal()">Close</button>
                </div>
            </div>
            <div id="image-modal" class="modal" style="display: none;">
                <div class="modal-content">
                    <!-- Logo in the center -->
                    <div class="modal-logo">
                    <img src="<?= base_url('/assets/images/images/logo.png') ?>" alt="Logo" >
                    </div>
                    <h2>Maximum FOUR (4) images can be uploaded</h2>
                    <button class="close-btn" onclick="closeImgModal()">Close</button>
                </div>
            </div>
            <div id="deleteConfirmationModal" class="modal" style="display: none;">
                <div class="modal-content">
                    <div class="modal-logo">
                       <img src="<?= base_url('/assets/images/images/logo.png') ?>" alt="Logo" >
                    </div>
                    <p>Are you sure you want to delete this variant?</p>
                    <div class="d-flex gap-5 justify-content-center">
                        <button id="confirmDelete" class="modal-btn">Yes</button>
                        <button id="cancelDelete" class="modal-btn">No</button>
                    </div>
                </div>
            </div>
            <div id="fullScreenModal" class="modal-overlay" style="display: none;">
                <span class="close-button">x</span>
                <img id="fullScreenImage" src="" alt="Full Screen Preview">
            </div>
        </div>
            
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/js/all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('assets/javascript/common.js') ?>"></script>
    <script>
        // code to load categories
        $(document).ready(function() {
    $('#product-category').on('change', function() {
        var categoryID = $(this).val();
        loadSubCategories(categoryID, '#sub-category-01');
    });
    $('#sub-category-01').on('change', function() {
        var subCategoryID = $(this).val();
        loadSubCategories(subCategoryID, '#sub-category-02');
    });
    $('#sub-category-02').on('change', function() {
        var subCategoryID = $(this).val();
        loadSubCategories(subCategoryID, '#sub-category-03');
    });
    function loadSubCategories(parentCategoryID, targetDropdown) {
        if (parentCategoryID) {
            console.log(parentCategoryID);
            $.ajax({
                url: 'getChildCategories/' + parentCategoryID,
                method: 'GET',
                success: function(data) {
                    var dropdown = $(targetDropdown);
                    dropdown.empty();
                    dropdown.append('<option value="">Select Sub Category</option>');

                    var childCategories = JSON.parse(data);
                    $.each(childCategories, function(index, childCategory) {
                        dropdown.append('<option value="'+ childCategory.CategoryID +'">' + childCategory.CategoryName + '</option>');
                    });
                }
            });
        } else {
            $(targetDropdown).empty().append('<option value="">Select Sub Category</option>');
        }
    }
});

flatpickr("#Publish-Schedule", {
        enableTime: true,                // Enables time selection
        minDate: "today",                // Allows only future dates
        dateFormat: "Y-m-d H:i",         // Format: Year-Month-Day Hour:Minute
        allowInput: false                // Disables manual input
    });



var variantCount = 0;

// Add new variant on button click
document.getElementById('add-variant-btn').addEventListener('click', function(event) {
    event.preventDefault(); // Prevent page reload

    // Get the current variant section and its input fields
    const variantSections = document.querySelectorAll('.variant-section');
    const currentSection = variantSections[variantSections.length - 1];
    const inputs = currentSection.querySelectorAll('input, select');

    // Get specific fields that need to be validated
    const imageInput = currentSection.querySelector('.preview-input');
    const colorInput = currentSection.querySelector('input[name="color[]"]');
    const skuInput = currentSection.querySelector('input[name="var_sku[]"]');
    const stockInput = currentSection.querySelector('input[name="stock[]"]');
    const basePriceInput = currentSection.querySelector('input[name="base_price[]"]');
    const salePriceInput = currentSection.querySelector('input[name="sale_price[]"]');

    // Check if all required fields are filled
    let isValid = true;
    if (!imageInput.files.length || !colorInput.value.trim() || !stockInput.value.trim() || !skuInput.value.trim() || !basePriceInput.value.trim() || !salePriceInput.value.trim()) {
        isValid = false;
    }

    // If valid, add a new variant section
    if (isValid) {
        variantCount++;
        var newVariant = `
        <div class="variant-section mt-5 mb-3">
            <div class="d-flex align-items-center mb-3">
                <div class="product-container-3">
                    <div class="custom-file-input-container" style="position: absolute; top: -35px; left: 20px; cursor: pointer; background-color: #3182ce; color: white; padding: 5px 20px; border-radius: 5px; font-size: 13px; width: 150px">
                        <input type="file" class="preview-input" name="images[${variantCount}][]" accept="image/*" multiple style="display: none;">
                        <label class="custom-label d-flex justify-content-center preview-input-btn">
                            *Upload Images
                        </label>
                    </div>
                    <div class="image-preview-container"></div>
                </div>
                <div class="details">
                    <div class="row">
                        <div class="col-4">
                            <label for="Item Dimensions" class="form-label">Item Dimensions :</label>
                            <input type="text" name="dimension[]" class="form-input" placeholder="23 x 3 x 2 Centimeters">
                        </div>
                        <div class="col-md-3">
                            <label for="Color" class="form-label">*Color</label>
                            <input type="text" name="color[]" class="form-input" placeholder="Rose Gold" required>
                        </div>
                        <div class="col-md-3">
                            <label for="SKU" class="form-label">*SKU Code</label>
                            <input type="text" name="var_sku[]" class="form-input" placeholder="SKU" required>
                        </div>
                        <div class="col-md-2">
                            <label for="Weight" class="form-label">Weight:</label>
                            <input type="text" name="weight[]" class="form-input numbers-only" placeholder="20 g" required>
                        </div>
                        <div class="col-md-3">
                            <label for="Stock" class="form-label">*Stock</label>
                            <input type="text" name="stock[]" class="form-input numbers-only" placeholder="256" required>
                        </div>
                        <div class="col-4">
                            <label for="Product Base Price" class="form-label">*Product Base Price :</label>
                            <input type="text" id="base_price" name="base_price[]" class="form-input numbers-only" placeholder="Type Base price" required>
                        </div>
                        <div class="col-4">
                            <label for="Sale Price" class="form-label">*Sale Price:</label>
                            <input type="text" id="sale_price" name="sale_price[]" class="form-input numbers-only" placeholder="Type sale price" required oninput="validatePrices()">
                        </div>
                        <p id="price-error" style="color: red; display: none;"><small>Product Base Price should be less than or equal to the Sale Price.</small></p>
                    </div>
                    <div class="row d-flex justify-content-center">
                        <div class="col-4">
                            <label for="Product Status" class="form-label">Product Status:</label>
                            <select class="form-select" name="status[]">
                                <option value="1">Active</option>
                                <option value="2">Not-Active</option>
                            </select>
                        </div>
                    </div>
                </div>
                <button class="delete-btn remove-variant" type="button">
                    <span class="material-symbols-outlined">delete</span>
                </button>
            </div>
        </div>`;

        // Insert the new variant section into the container
        document.getElementById('variants-container').insertAdjacentHTML('beforeend', newVariant);
    } else {
        // Show the modal if the required fields are not filled
        showModal();
    }
});

// Function to show the modal
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

// ----------maximum image exceed modal------------------
// Function to show the modal for max image exceed
function showImgModal() {
    event.preventDefault();
    const modal = document.getElementById('image-modal');
    modal.style.display = 'block';
}

// Function to close the modal
function closeImgModal() {
    event.preventDefault();
    const modal = document.getElementById('image-modal');
    modal.style.display = 'none';
}

// Remove variant on delete button click
document.addEventListener('click', function(event) {
    // Prevent the default action to avoid page reload

    // Check if the remove button is clicked
    if (event.target.closest('.remove-variant')) {
        // Store the variant section for later use
        const variantSection = event.target.closest('.variant-section');

        // Show the modal
        const modal = document.getElementById('deleteConfirmationModal');
        modal.style.display = 'flex';

        // Handle the "Yes" button click
        document.getElementById('confirmDelete').onclick = function(event) {
            event.preventDefault(); // Prevent page reload on confirmation button click
            variantSection.remove();
            modal.style.display = 'none';
        };

        // Handle the "No" button click
        document.getElementById('cancelDelete').onclick = function(event) {
            event.preventDefault(); // Prevent page reload on cancel button click
            modal.style.display = 'none';
        };
    }
});


// Trigger the file input when clicking on the label
document.addEventListener('click', function(event) {
    if (event.target.classList.contains('preview-input-btn')) {
        const fileInput = event.target.parentNode.querySelector('.preview-input');
        fileInput.click();
    }
});

// Handle file input change event for image preview
document.addEventListener('change', function(event) {
    if (event.target.classList.contains('preview-input')) {
        const input = event.target;
        const previewContainer = input.closest('.product-container-3').querySelector('.image-preview-container');
        const files = Array.from(input.files);
        const maxFiles = 4;
        
        previewContainer.innerHTML = ''; // Clear previous previews if any

        // Ensure only the first 4 images are used for preview
        const previewFiles = files.slice(0, maxFiles);

        // Show modal if more than 4 files are selected
        if (files.length > maxFiles) {
            showImgModal();
        }

        // Preview the selected files (first 4 if more are selected)
        previewFiles.forEach(function(file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const imgElement = document.createElement('div');
                imgElement.classList.add('image-box');
                imgElement.innerHTML = `
                    <img class="preview-image" src="${e.target.result}" alt="Preview">
                    <span class="delete-icon">x</span>
                `;
                previewContainer.appendChild(imgElement);
            };
            reader.readAsDataURL(file);
        });

        // Update the input to contain only the first 4 files
        const dataTransfer = new DataTransfer();
        previewFiles.forEach(file => dataTransfer.items.add(file));
        input.files = dataTransfer.files;
    }
});

    // Event listener for opening full-screen preview
    document.addEventListener('click', function(event) {
        if (event.target.classList.contains('preview-image')) {
            const fullScreenModal = document.getElementById('fullScreenModal');
            const fullScreenImage = document.getElementById('fullScreenImage');
            fullScreenImage.src = event.target.src;
            fullScreenModal.style.display = 'flex';
        }
    });

    // Event listener for closing full-screen preview
    document.querySelector('.close-button').addEventListener('click', function() {
        document.getElementById('fullScreenModal').style.display = 'none';
    });


// Delete image preview on delete icon click
document.addEventListener('click', function(event) {
    if (event.target.classList.contains('delete-icon')) {
        event.target.closest('.image-box').remove();
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

//  --------------javascript for product and sale price-----------


function validatePrices() {
    const basePrice = parseFloat(document.getElementById("base_price").value) || 0;
    const salePrice = parseFloat(document.getElementById("sale_price").value) || 0;
    const error = document.getElementById("price-error");

    // Show error only if sale price is entered and base price is greater
    if (salePrice && basePrice < salePrice) {
        error.style.display = "block";
    } else {
        error.style.display = "none";
    }
}







    </script>
    
  




</body>
</html>