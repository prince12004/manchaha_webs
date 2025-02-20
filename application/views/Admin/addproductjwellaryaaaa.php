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
    grid-column: span 2;
    /* Make the plus button span across both columns */
}

.image-preview-container {
    display: contents;
    /* Ensure images are placed directly in the grid without extra wrapping */
}

.image-box {
    position: relative;
    width: 80px;
    /* Same size as the add button */
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
    border: 1px solid rgba(255, 0, 0);
    border-radius: 50%;
    /* padding: 2px; */
    color: white;
}

.input-image {
    opacity: 0;
    position: absolute;
}

.text-success {
    font-size: 20px;
    font-weight: 700;
    text-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
    color: #20a920 !important;
}
</style>
<div class="mt-2">
    <form id="submit_form" action="addJwellery" method="post" enctype="multipart/form-data">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="add-product-h1 mt-3">Add Products</h1>
                <small class="add-product-small">Lorem ipsum is simply text</small>
                <?php 
                    if($this->session->flashdata('message')){
                        echo'<pre class="text-success" style="display:flex; justify-content:center; position: relative; left: 25vw">';
                        print_r($this->session->flashdata('message'));
                        echo '</pre>';

                    }
                    ?>
            </div>

            <div class="d-flex">
                <button type="submit" class="btn btn-dark me-2 d-flex align-items-center"><span
                        class="material-symbols-outlined">
                        check_circle
                    </span>Save Now</button>
                <button type="button" class="btn btn-light d-flex align-items-center"><span
                        class="material-symbols-outlined">
                        cancel
                    </span>Cancel Now</button>
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
                    <select id="sub-category-01" name="sub-category-1" class="form-select" required>
                        <option value="">Select Sub Category</option>
                    </select>

                    <!-- Sub Category 02 -->
                    <label for="sub-category-02" class="form-label">Sub Category 02</label>
                    <select id="sub-category-02" name="sub-category-2" class="form-select">
                        <option value="">Select Sub Category</option>
                    </select>

                    <!-- Sub Category 03 -->
                    <label for="sub-category-03" class="form-label">Sub Category 03</label>
                    <select id="sub-category-03" name="sub-category-3" class="form-select">
                        <option value="">Select Sub Category</option>
                    </select>
                </div>

                <!-- ---------Inventory------------ -->
                <div class="section container  mb-3">
                    <h5>INVENTORY</h5>
                    <!-- product id -->
                    <label for="Product ID" class="form-label">Product ID</label>
                    <input id="Product-ID" name="product_id" value="<?= set_value('product_id')?>" type="text"
                        class="form-input" required>
                    <!-- Visibility -->
                    <label for="product-visibility" class="form-label">Visibility Status</label>
                    <select id="Visibility-status" name="visibility" <?= set_value('visibility')?> class="form-select"
                        required>
                        <option>Published</option>
                        <option>Un-Published</option>
                    </select>
                    <!-- product id -->
                    <label for="SKU" class="form-label">SKU</label>
                    <input id="SKU" type="text" name="sku" <?= set_value('sku')?> class="form-input" required>
                    <!-- Discount type -->
                    <label for="Discount type" class="form-label">Discount Type</label>
                    <select id="Discount-type" name="discount" class="form-select" required>
                        <option>10%</option>
                        <option>20%</option>
                        <option>30%</option>
                        <option>40%</option>
                        <option>50%</option>
                        <option>60%</option>
                        <option>70%</option>
                        <option>80%</option>
                        <option>90%</option>
                    </select>
                    <!-- Product Tags -->
                    <label for="product tags" class="form-label">Product Tags</label>
                    <select id="Product-tags" name="tag" class="form-select" required>
                        <option>Tag 01</option>
                        <option>Tag 02</option>
                    </select>
                    <!-- Publish Schedule -->
                    <label for="Publish Schedule" class="form-label">Publish Schedule</label> <br>
                    <input type="datetime-local" name="publish_date" class="form-input" name="Publish Schedule"
                        id="Publish-Schedule" required>
                </div>
                <!-- manoj-section-update -->
                <div class="section container  mb-3 image-update-container">
                    <h5>Updated Image</h5>
                    <div class="image-preview-container d-flex flex-wrap gap-2">
                        <div class="image-box">
                            <img src="<?= base_url('/assets/images/bestVal_1.png') ?>" alt="Uploaded Image">
                            <span class="material-symbols-outlined delete-icon">&times;</span>
                        </div>
                        <div class="image-box">
                            <img src="<?= base_url('/assets/images/bestVal_2.png') ?>" alt="Uploaded Image">
                            <span class="material-symbols-outlined delete-icon">&times;</span>
                        </div>
                        <div class="image-box">
                            <img src="<?= base_url('/assets/images/bestVal_3.png') ?>" alt="Uploaded Image">
                            <span class="material-symbols-outlined delete-icon">&times;</span>
                        </div>
                        <div class="image-box">
                            <img src="<?= base_url('/assets/images/bestVal_1.png') ?>" alt="Uploaded Image">
                            <span class="material-symbols-outlined delete-icon">&times;</span>
                        </div>
                    </div>
                </div>

                <!-- ------manoj-ends----------- -->
            </div>
            <div class="col-md-8">
                <div class="section container  mb-3">
                    <h5>General Information</h5>
                    <label for="product-name" class="form-label">Product Name</label>
                    <input type="text" id="product-name" name="product_name" class="form-control"
                        placeholder="Type Product Name here..." required>
                    <label for="product-description" class="form-label mt-3">Description</label>
                    <textarea id="product-description" name="product_description" class="form-control" rows="3"
                        placeholder="Type Product Description here..." required></textarea>
                </div>
                <div class="section container mb-3">
                    <div class="product-discription-cont">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h5>Product Discription</h5>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <label for="material Type" class="form-label">Material Type</label>
                                <input id="material-type" name="material_type" type="text" class="form-input"
                                    placeholder="Crystal" required>
                            </div>
                            <div class="col-6">
                                <label for="metal Type" class="form-label">Metal Type</label>
                                <input id="metal-Type" name="metal_type" type="text" class="form-input"
                                    placeholder="Silver" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <label for="Gem Type" class="form-label">Gem Type</label>
                                <input id="gem-Type" name="gem_type" type="text" class="form-input"
                                    placeholder="Crystal" required>
                            </div>
                            <div class="col-6">
                                <label for="Occasion Type" class="form-label">Occasion Type</label>
                                <input id="Occasion-Type" name="occation_type" type="text" class="form-input"
                                    placeholder="Party, Valentines Day, Wedding, Birthday, Anniversary" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <label for="Ideal For" class="form-label">Ideal For</label>
                                <input id="Ideal-For" name="ideal_for" type="text" class="form-input"
                                    placeholder="Women" required>
                            </div>
                            <div class="col-6">
                                <label for="Sizing" class="form-label">Sizing </label>
                                <input id="Product-Sizing" name="sizing" type="text" class="form-input"
                                    placeholder="Adjustable" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <label for="finish" class="form-label">Finish</label>
                                <input id="product-Finish" name="product_finish" type="text" class="form-input"
                                    placeholder="Glossy" required>
                            </div>
                            <div class="col-6">
                                <label for="Generic Name" class="form-label">Generic Name</label>
                                <input id="Generic-Name" name="generic_name" type="text" class="form-input"
                                    placeholder="Bracelets" required>
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
                                <option value="return">Return</option>
                                <option value="replacement">Replacement</option>
                                <option value="Refund">Refund</option>
                            </select>
                        </div>
                        <div class="col-md-6 ">
                            <label for="product grade" class="form-label mt-3">Number of days</label>
                            <input type="number" class="form-input" name="policy_time" placeholder="number of days">
                        </div>
                    </div>
                </div>
                <div class="section container mb-3">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5>Product Information</h5>
                        <a id="add-variant-btn"
                            class="product-info-btn d-flex justify-content-center gap-1 align-items-center">
                            <span class="material-symbols-outlined">add_circle</span> Add Variant
                        </a>
                    </div>
                    <div id="variants-container">
                        <div class=" d-flex align-items-center variant-section section-cloned-3 mb-3">
                            <div class="d-flex align-items-center mb-3">

                                <!--change-->
                                <div class="product-container-3">
                                    <div class="add-image-btn" style="">
                                        <span class="material-symbols-outlined">add</span>
                                    </div>
                                    <!-- Hidden input fields for image uploads -->
                                    <input type="file" name="index[0][0]" class="image-upload" accept="image/*"
                                        style="display: none;" id="imageUploadInput1">
                                    <input type="file" name="index[0][1]" class="image-upload" accept="image/*"
                                        style="display: none;" id="imageUploadInput2">
                                    <input type="file" name="index[0][2]" class="image-upload" accept="image/*"
                                        style="display: none;" id="imageUploadInput3">
                                    <input type="file" name="index[0][3]" class="image-upload" accept="image/*"
                                        style="display: none;" id="imageUploadInput4">

                                    <!-- Preview container where uploaded images will be displayed -->
                                    <div class="image-preview-container">
                                        <!-- Uploaded image previews will appear here -->
                                    </div>
                                </div>

                                <!--change-->
                                <div class="details">
                                    <div class="row">
                                        <div class="col-4">
                                            <label for="Item Dimensions" class="form-label">Item Dimensions :</label>
                                            <input type="text" name="dimension[]" class="form-input"
                                                placeholder="23 x 3 x 2 Centimeters" required>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="Color" class="form-label">Color</label>
                                            <input type="text" name="color[]" class="form-input" placeholder="Rose Gold"
                                                required>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="Weight" class="form-label">Weight:</label>
                                            <input type="text" name="weight[]" class="form-input" placeholder="20 g"
                                                required>
                                        </div>
                                        <div class="col-md-2">
                                            <label for="Stock" class="form-label">Stock</label>
                                            <input type="text" name="stock[]" class="form-input" placeholder="256"
                                                required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-4">
                                            <label for="Product Base Price" class="form-label">Product Base Price
                                                :</label>
                                            <input type="text" name="base_price[]" class="form-input"
                                                placeholder="Type Base price" required>
                                        </div>
                                        <div class="col-4">
                                            <label for="Sale Price" class="form-label">Sale Price:</label>
                                            <input type="text" name="sale_price[]" class="form-input"
                                                placeholder="Type sale price" required>
                                        </div>
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
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/js/all.min.js"></script>
<script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
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
                        dropdown.append('<option value="' + childCategory.CategoryID +
                            '">' + childCategory.CategoryName + '</option>');
                    });
                }
            });
        } else {
            $(targetDropdown).empty().append('<option value="">Select Sub Category</option>');
        }
    }
});


$(document).ready(function() {
    var maxImages = 4; // Maximum images per section
    var imageCountMap = {}; // Track the number of images uploaded per section
    var imageUrlsMap = {}; // Store image URLs per section
    var sectionIndex = 0; // Initialize index for sections

    // Initialize data-index attributes for image-upload inputs in the main section
    $('#variants-container .section-cloned-3').first().find('.image-upload').each(function(index) {
        $(this).attr('data-index', index).attr('name', `index[0][${index}]`).val('');
    });

    // Function to handle add image button click
    $(document).on('click', '.add-image-btn', function() {
        var $section = $(this).closest('.section-cloned-3');
        var sectionId = $section.attr('id');

        if (!imageCountMap[sectionId]) {
            imageCountMap[sectionId] = 0;
        }

        // Check if the maximum image limit is reached for the section
        if (imageCountMap[sectionId] < maxImages) {
            // Trigger the next hidden input field for image upload based on image count
            $section.find(`.image-upload[data-index="${imageCountMap[sectionId]}"]`).click();
        } else {
            alert("Maximum image limit reached for this section.");
        }
    });

    // Handle image upload for each section independently, assigning to the correct input field
    $(document).on('change', '.image-upload', function(e) {
        var file = e.target.files[0];
        var $input = $(this);
        var $section = $input.closest('.section-cloned-3');
        var sectionId = $section.attr('id');

        if (!imageCountMap[sectionId]) {
            imageCountMap[sectionId] = 0;
            imageUrlsMap[sectionId] = [];
        }

        if (file) {
            var reader = new FileReader();
            reader.onload = function(event) {
                if (imageCountMap[sectionId] < maxImages) {
                    // Display the image preview in the current section
                    $section.find('.image-preview-container').append(
                        `<div class="image-box" data-input-id="${$input.attr('id')}">
                            <img src="${event.target.result}" alt="Uploaded Image">
                            <span class="material-symbols-outlined delete-icon">&times;</span>
                        </div>`
                    );
                    imageCountMap[sectionId]++;
                    imageUrlsMap[sectionId].push(event.target.result);

                    // Log the name of the uploaded file in the console
                    console.log("Uploaded file name:", $input.attr('name'));
                }
            };
            reader.readAsDataURL(file);
        }
    });

    // Handle image deletion for each section independently
    $(document).on('click', '.delete-icon', function() {
        var $imageBox = $(this).closest('.image-box');
        var $section = $imageBox.closest('.section-cloned-3');
        var sectionId = $section.attr('id');

        // Clear the associated input field and remove image from preview and map
        $('#' + $imageBox.data('input-id')).val('');
        $imageBox.remove();
        imageCountMap[sectionId]--;
    });

    // Clone a new section when the "Product Details" button is clicked
    $('.product-info-btn').on('click', function() {
        var $originalSection = $('#variants-container .section-cloned-3').first();
        var $newSection = $originalSection.clone(true);

        // Update section index and assign a new unique ID to the cloned section
        sectionIndex++;
        var newId = 'section-' + sectionIndex;
        $newSection.attr('id', newId);

        // Reset inputs, image previews, and initialize image counts for the new section
        $newSection.find('input[type="text"], textarea').val(''); // Clear inputs
        $newSection.find('.image-preview-container').empty(); // Clear images
        $newSection.find('.add-image-btn').show(); // Reset add button visibility

        // Initialize hidden file inputs with unique data-index and updated name for each section
        $newSection.find('.image-upload').each(function(index) {
            $(this).attr('data-index', index).attr('name', `index[${sectionIndex}][${index}]`)
                .val('');
        });

        // Initialize image tracking for the new section
        imageCountMap[newId] = 0;
        imageUrlsMap[newId] = [];

        // Append the cloned section to the container
        $('#variants-container').append($newSection);
    });

    // Delete section functionality with confirmation
    $('#variants-container').on('click', '.delete-btn', function() {
        if (confirm("Are you sure you want to delete this section?")) {
            var $section = $(this).closest('.section-cloned-3');
            var sectionId = $section.attr('id');

            // Remove section data from maps and delete the section
            delete imageCountMap[sectionId];
            delete imageUrlsMap[sectionId];
            $section.remove();
        }
    });
});
</script>






</body>

</html>