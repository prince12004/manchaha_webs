
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
    max-width: 80%; /* Ensure the logo doesn't overflow */
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


    </style>
        <div class="mt-2">
        <form id="submit_form" action="addJwellery" method="post" enctype="multipart/form-data">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1 class="add-product-h1 mt-3">Add Products</h1>
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
                            <?php foreach ($product['categories'] as $categories) {?>
                                <option value="<?= $categories['CategoryID']?>"  <?= isset($categories['CategoryName']) && $categories['CategoryName'] == $product['CategoryName'] ? 'selected' : '' ?> ><?= $categories['CategoryName']?></option>
                            <?php }?>
                        

                        </select>

                        <!-- Sub Category 01 -->
                        <label for="sub-category-01" class="form-label">Sub Category 01</label>
                        <select id="sub-category-01" name="sub-category-1" class="form-select" required>
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
                    <div class="section container mb-3">
                        <h5>INVENTORY</h5>

                        <!-- Product ID -->
                        <label for="Product-ID" class="form-label">Product ID</label>
                        <input id="Product-ID" name="product_id" value="<?= htmlspecialchars($product['jwellary_id']) ?>" type="text" class="form-input" required>

                        <!-- Visibility -->
                        <label for="Visibility-status" class="form-label">Visibility Status</label>
                        <select id="Visibility-status" name="visibility" class="form-select" required>
                            <option value="Published" <?= isset($product['visibility']) && $product['visibility'] == "Published" ? 'selected' : '' ?>>Published</option>
                            <option value="Un-Published" <?= isset($product['visibility']) && $product['visibility'] == "Un-Published" ? 'selected' : '' ?>>Un-Published</option>
                        </select>

                        <!-- SKU -->
                        <label for="SKU" class="form-label">SKU</label>
                        <input id="SKU" type="text" name="sku" value="<?= htmlspecialchars($product['sku_code']) ?>" class="form-input" required>

                        <!-- Discount Type -->
                        <label for="Discount-type" class="form-label">Discount Type</label>
                        <select id="Discount-type" name="discount" class="form-select" required>
                            <?php
                            $discountOptions = [10, 20, 30, 40, 50, 60, 70, 80, 90];
                            foreach ($discountOptions as $discount) {
                                $selected = isset($product['discount']) && $product['discount'] == $discount ? 'selected' : '';
                                echo "<option value=\"$discount\" $selected>$discount%</option>";
                            }
                            ?>
                        </select>

                        <!-- Product Tags -->
                        <label for="Product-tags" class="form-label">Product Tags</label>
                        <select id="Product-tags" name="tag" class="form-select" required>
                            <option value="tag1" <?= isset($product['tag']) && $product['tag'] == "tag1" ? 'selected' : '' ?>>Tag 01</option>
                            <option value="tag2" <?= isset($product['tag']) && $product['tag'] == "tag2" ? 'selected' : '' ?>>Tag 02</option>
                        </select>

                        <!-- Publish Schedule -->
                        <label for="Publish-Schedule" class="form-label">Publish Schedule(Date and Time)</label><br>
                        <input type="text" name="publish_date" id="Publish-Schedule" value="<?= date('Y-m-d\  H:i', strtotime($product['publish_at'])) ?>" class="form-input" required>
                    </div>

                </div>
                <div class="col-md-8">
                    <div style="max-width:900px" class="section container  mb-3">
                        <h5>General Information</h5>
                        <label for="product-name" class="form-label">Product Name</label>
                        <input type="text" id="product-name" name ="product_name" class="form-control" value="<?= htmlspecialchars($product['jwellary_name']) ?>" placeholder="Type Product Name here..." required>
                        <label for="product-description" class="form-label mt-3">Description</label>
                        <textarea id="product-description" name="product_description" class="form-control" rows="3" placeholder="Type Product Description here..." required><?= htmlspecialchars($product['jwellary_description']) ?></textarea>
                    </div>
                    <div style="max-width:900px" class="section container mb-3">
                       <div class="product-discription-cont">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h5>Product Discription</h5>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label for="material Type" class="form-label">Material Type</label>
                                    <input id="material-type" name="material_type" value="<?= htmlspecialchars($product['material_type']) ?>" type="text" class="form-input" placeholder="Crystal" required>
                                </div>
                                <div class="col-6">
                                    <label for="metal Type" class="form-label">Metal Type</label>
                                    <input id="metal-Type" name="metal_type" value="<?= htmlspecialchars($product['metal_type']) ?>" type="text" class="form-input" placeholder="Silver" required>
                                </div>
                             </div>
                             <div class="row">
                                <div class="col-6">
                                    <label for="Gem Type" class="form-label">Gem Type</label>
                                    <input id="gem-Type" name="gem_type" value="<?= htmlspecialchars($product['metal_type']) ?>" type="text" class="form-input" placeholder="Crystal" required>
                                </div>
                                <div class="col-6">
                                    <label for="Occasion Type" class="form-label">Occasion Type</label>
                                    <input id="Occasion-Type" value="<?= htmlspecialchars($product['occation_type']) ?>" name="occation_type" type="text" class="form-input" placeholder="Party, Valentines Day, Wedding, Birthday, Anniversary" required>
                                </div>
                             </div>
                             <div class="row">
                                <div class="col-6">
                                    <label for="Ideal For" class="form-label">Ideal For</label>
                                    <input id="Ideal-For" name="ideal_for" type="text" value="<?= htmlspecialchars($product['ideal_for']) ?>" class="form-input" placeholder="Women" required>
                                </div>
                                <div class="col-6">
                                    <label for="Sizing" class="form-label">Sizing </label>
                                    <input id="Product-Sizing" name="sizing" value="<?= htmlspecialchars($product['sizing']) ?>" type="text" class="form-input" placeholder="Adjustable" required>
                                </div>
                             </div>
                             <div class="row">
                                <div class="col-6">
                                    <label for="finish" class="form-label">Finish</label>
                                    <input id="product-Finish" name="product_finish" value="<?= htmlspecialchars($product['finish']) ?>" type="text" class="form-input" placeholder="Glossy" required>
                                </div>
                                <div class="col-6">
                                    <label for="Generic Name"  class="form-label">Generic Name</label>
                                    <input id="Generic-Name" name="generic_name" value="<?= htmlspecialchars($product['generic_name']) ?>" type="text" class="form-input" placeholder="Bracelets" required>
                                </div>
                             </div>
                       </div>
                       
                    </div>
<div style="max-width:900px" class="section  container mb-3">
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
                                <input type="number" class="form-input" name="policy_time" placeholder="number of days">
                            </div>
                        </div>
                    </div>

                    
                    <div style="max-width:900px" class="section container mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h5>Product Information</h5>

                            
                            <a id="add-variant-btn" class="product-info-btn d-flex justify-content-center gap-1 align-items-center">
                               <span class="material-symbols-outlined">add_circle</span> Add Variant
                            </a>
                            
                             </div>
                            <?php foreach ($product['variants'] as $variantIndex => $varient) { ?>
                                <div class="variants-container" id="variants-container">
                                    <div class="variant-section mb-3">
                                        <div class="d-flex flex-column align-items-center mb-3">

                                            <!-- Image Upload Section -->
                                            <div class="d-flex justify-content-around flex-wrap w-100">
                                                <?php foreach ($varient['images'] as $imag) { ?>
                                                    <div class="d-flex flex-column gap-2 align-itmes-center">
                                                        <img style="height:75px ; border-radius:10px;" src="<?= base_url('uploads/products/').$imag['image']?>">
                                                        <button style="font-size:12px;" class="btn btn-outline-dark" type="button" onclick="updateImage('<?= $imag['image_id'] ?>')">update</button>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                            <!-- Details Section -->
                                            <div class="details">
                                                <div class="row">
                                                    <div class="col-4">
                                                        <label for="Item Dimensions" class="form-label">Item Dimensions :</label>
                                                        <input type="text" name="dimension[<?= $variantIndex ?>]" class="form-input" 
                                                            value="<?= $varient['dimension'] ?>" 
                                                            placeholder="23 x 3 x 2 Centimeters" required>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label for="Color" class="form-label">Color</label>
                                                        <input type="text" name="color[<?= $variantIndex ?>]" class="form-input" 
                                                            value="<?= $varient['color'] ?>" 
                                                            placeholder="Rose Gold" required>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label for="Weight" class="form-label">Weight:</label>
                                                        <input type="text" name="weight[<?= $variantIndex ?>]" class="form-input" 
                                                            value="<?= $varient['weight'] ?>" 
                                                            placeholder="20 g" required>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label for="Stock" class="form-label">Stock</label>
                                                        <input type="text" name="stock[<?= $variantIndex ?>]" class="form-input" 
                                                            value="<?= $varient['stock'] ?>" 
                                                            placeholder="256" required>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <label for="Product Base Price" class="form-label">Product Base Price :</label>
                                                        <input type="text"  name="base_price[<?= $variantIndex ?>]" class="form-input"  
                                                            value="<?= $varient['base_price'] ?>" 
                                                            placeholder="Type Base price" required>
                                                    </div>
                                                    <div class="col-4">
                                                        <label for="Sale Price" class="form-label">Sale Price:</label>
                                                        <input type="text"  name="sale_price[<?= $variantIndex ?>]" class="form-input"  
                                                            value="<?= isset($varient['sale_price']) ? $varient['sale_price'] : '' ?>" 
                                                            placeholder="Type sale price" required>
                                                    </div>
                                                    <div class="col-4">
                                                        <label for="Product Status" class="form-label">Product Status:</label>
                                                        <select class="form-select" name="status[<?= $variantIndex?>]">
                                                            <option value="1" <?= isset($varient['status']) && $varient['status'] == 1 ? 'selected' : '' ?>>Active</option>
                                                            <option value="2" <?= isset($varient['status']) && $varient['status'] == 2 ? 'selected' : '' ?>>Not-Active</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex w-100 justify-content-between align-items-center">
                                                <div class="d-flex flex-column justify-content-center align-items-center mt-4 mb-2">
                                                    <div id="imageContainer" style="margin-bottom: 20px;">
                                                        <button style="font-size: 13px; border-radius: 25px !important; box-shadow: 0px 8px 20px #4aba4ab3;" 
                                                        class="btn btn-success me-3" 
                                                        type="button" 
                                                        onclick="addNewImage('<?= $varient['varient_id']?>')">Add New Image</button>
                                                    </div>
                                                    <div id="singlePreviewContainer"></div>
                                                </div>
                                                <div class="d-flex justify-content-end mt-4">
                                                    <button style="font-size:13px; border-radius:25px !important; box-shadow:0px 8px 20px #4A90E2;" class="btn btn-primary me-3" type="button" onclick="Updatevarient('<?= $variantIndex ?>', '<?= $varient['varient_id'] ?>')">Update Variant details</button>
                                                </div>
                                            </div>
                                            

                                            <!-- <button class="delete-btn remove-variant" type="button">
                                                <span class="material-symbols-outlined">delete</span>
                                            </button> -->
                                             
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>



        </div>
        <div class="w-100 d-flex justify-content-center mt-3 mb-5">
            <button style="border-radius:25px; padding:8px 20px; box-shadow:0px 8px 20px rgba(0,0,0,0.2);" class="btn btn-dark" type="button" onclick="updateProductDetails('<?= $product['jwellary_id']?>')">Save updated product</button>
        </div>
    </form>
</div>
        <div id="successModal" class="modal" style="display: none;">
            <div class="modal-content">
                <div class="modal-logo">
                    <img src="<?= base_url('/assets/images/images/logo.png') ?>" alt="Logo">
                </div>
                <p>Image updated successfully!</p>
                <div class="d-flex justify-content-center">
                    <!-- <button  class="closeSuccessModal modal-btn close-btn">OK</button> -->
                </div>
            </div>
        </div>
        <div id="successModal-B" class="modal" style="display: none;">
            <div class="modal-content">
                <div class="modal-logo">
                    <img src="<?= base_url('/assets/images/images/logo.png') ?>" alt="Logo">
                </div>
                <p>Product details updated successfully!</p>
                <div class="d-flex justify-content-center">
                    <!-- <button  class="closeSuccessModal modal-btn close-btn">OK</button> -->
                     
                </div>
            </div>
        </div>
        <div id="successModal-C" class="modal" style="display: none;">
            <div class="modal-content">
                <div class="modal-logo">
                    <img src="<?= base_url('/assets/images/images/logo.png') ?>" alt="Logo">
                </div>
                <p>Variant updated successfully!</p>
                <div class="d-flex justify-content-center">
                    <button  class="closeSuccessModal modal-btn close-btn">OK</button>
                </div>
            </div>
        </div>
        <div id="errorModal" class="modal" style="display: none;">
            <div class="modal-content">
                <div class="modal-logo">
                    <img src="<?= base_url('/assets/images/images/logo.png') ?>" alt="Logo">
                </div>
                <p>Something went wrong!!</p>
                <p><small>An error occurred. Please try again.</small></p>
                <div class="d-flex justify-content-center">
                    <button  class="closeSuccessModal modal-btn close-btn">OK</button>
                </div>
            </div>
        </div>
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
            <div id="singleImgModal" class="modal" style="display: none;">
                <div class="modal-content">
                    <!-- Logo in the center -->
                    <div class="modal-logo">
                    <img src="<?= base_url('/assets/images/images/logo.png') ?>" alt="Logo" >
                    </div>
                    <h2>An image input field is already open.</h2>
                    <button class="close-btn" onclick="closeSingleImgModal()">Close</button>
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
            <div id="alertModal" class="modal" style="display: none;">
                <div class="modal-content">
                    <!-- Logo in the center -->
                    <div class="modal-logo">
                      <img src="<?= base_url('/assets/images/images/logo.png') ?>" alt="Logo" >
                    </div>
                    <h2 id="alertResponse"></h2>
                    <button class="close-btn" onclick="closeAlertModal()">Close</button>
                </div>
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
     
       





function updateProductDetails(jwellaryId) {
    // Collect form data
    const formData = {
        jwellary_id: jwellaryId,
        category: document.querySelector("select[name='category']").value,
        sub_category_1: document.querySelector("select[name='sub-category-1']").value,
        sub_category_2: document.querySelector("select[name='sub-category-2']").value,
        sub_category_3: document.querySelector("select[name='sub-category-3']").value,
        product_id: document.querySelector("input[name='product_id']").value,
        visibility: document.querySelector("select[name='visibility']").value,
        sku: document.querySelector("input[name='sku']").value,
        discount: document.querySelector("select[name='discount']").value,
        tag: document.querySelector("select[name='tag']").value,
        publish_date: document.querySelector("input[name='publish_date']").value,
        product_name: document.querySelector("input[name='product_name']").value,
        product_description: document.querySelector("textarea[name='product_description']").value,
        material_type: document.querySelector("input[name='material_type']").value,
        metal_type: document.querySelector("input[name='metal_type']").value,
        gem_type: document.querySelector("input[name='gem_type']").value,
        occation_type: document.querySelector("input[name='occation_type']").value,
        ideal_for: document.querySelector("input[name='ideal_for']").value,
        sizing: document.querySelector("input[name='sizing']").value,
        product_finish: document.querySelector("input[name='product_finish']").value,
        generic_name: document.querySelector("input[name='generic_name']").value,
        policy_type: document.querySelector("select[name='policy_type']").value,
        policy_time: document.querySelector("input[name='policy_time']").value
    };

    // Send AJAX request to update product details
    $.ajax({
        url: '<?= base_url("updateProductDetails") ?>',
        type: 'POST',
        data: JSON.stringify(formData),
        contentType: 'application/json',
        success: function(response) {
            const responseData = JSON.parse(response);
            if (responseData.status === 'success') {
                // alert("Product details updated successfully!");
                $('#successModal-B').show();
                setInterval(() => {
                    window.location.href = "<?= base_url('Web/Admin/Admin/productList') ?>";
                }, 1500);
            } else {
                alert("Failed to update product details: " + responseData.message);
            }
        },
        error: function(xhr, status, error) {
            console.error("Error updating product details:", error);
            // alert("An error occurred while updating the product details.");
            document.getElementById('alertResponse').innerHTML="An error occurred while updating the product details";
                alertModal()
        }
    });
}


flatpickr("#Publish-Schedule", {
        enableTime: true,                // Enables time selection
        minDate: "today",                // Allows only future dates
        dateFormat: "Y-m-d H:i",         // Format: Year-Month-Day Hour:Minute
        allowInput: false                // Disables manual input
    });




     // Handle closing the success modal
     $('.closeSuccessModal').click(function() {
        // Close the success modal
        event.preventDefault();
        $('#errorModal').hide();
        
        // Optionally reload the page or navigate to another page
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
    




    function Updatevarient(variantIndex, variantId) {
        console.log(variantIndex);
        console.log(document.querySelector(`input[name='color[${variantIndex}]']`).value);
    // Use the variant index to dynamically select the inputs within the form
    const formData = {
        varient_id: variantId,
        dimension: document.querySelector(`input[name='dimension[${variantIndex}]']`).value,
        color: document.querySelector(`input[name='color[${variantIndex}]']`).value,
        weight: document.querySelector(`input[name='weight[${variantIndex}]']`).value,
        stock: document.querySelector(`input[name='stock[${variantIndex}]']`).value,
        base_price: document.querySelector(`input[name='base_price[${variantIndex}]']`).value,
        sale_price: document.querySelector(`input[name='sale_price[${variantIndex}]']`).value,
        status: document.querySelector(`select[name='status[${variantIndex}]']`).value
    };
  
    console.log(formData);

    // Send AJAX request to update variant
    $.ajax({
        url: '<?= base_url("updateVarient") ?>', // Update with your actual endpoint
        type: 'POST',
        data: JSON.stringify(formData),
        contentType: 'application/json',
        success: function(response) {
            const responseData = JSON.parse(response);
            if (responseData.status === 'success') {
                // alert("Variant updated successfully!");
                $('#successModal-C').show();
                setInterval(() => {
                    location.reload(); // Optional: Reload page to reflect changes
                    
                }, 2000);
            } else {
                // alert("Failed to update variant: " + responseData.message);
                document.getElementById('alertResponse').innerHTML="Failed to update variant: " + responseData.message;
                alertModal()
            }
        },
        error: function(xhr, status, error) {
            console.error("Error updating variant:", error);
            // alert("An error occurred while updating the variant.");
            document.getElementById('alertResponse').innerHTML="An error occurred while updating the variant.";
            alertModal()
        }
    });
}


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
                url: '<?= base_url('getChildCategories/')?>' + parentCategoryID,
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




    // $('#add-variant-btn').on('click', function() {
    //     var newVariant = `
    //     <form id="addNewVarientForm" enctype="multipart/form-data" >
    //    <div class="variant-section mt-5 mb-3">
    //         <div class="d-flex align-items-center mb-3">
    //             <div class="product-container-3">
    //                 <div class="custom-file-input-container" style="position: absolute; top: -35px; left: 20px; cursor: pointer; background-color: #3182ce; color: white; padding: 5px 20px; border-radius: 5px; font-size: 13px; width: 150px">
    //                     <input type="file" class="preview-input" name="images[]" accept="image/*" multiple style="display: none;">
    //                     <label class="custom-label d-flex justify-content-center preview-input-btn">
    //                         *Upload Images
    //                     </label>
    //                 </div>
    //                 <div class="image-preview-container"></div>
    //             </div>
    //             <div class="details">
    //                 <div class="row">
    //                     <div class="col-4">
    //                         <label for="Item Dimensions" class="form-label">Item Dimensions :</label>
    //                         <input type="text" name="dimension" class="form-input" placeholder="23 x 3 x 2 Centimeters">
    //                     </div>
    //                     <div class="col-md-3">
    //                         <label for="Color" class="form-label">*Color</label>
    //                         <input type="text" name="color" class="form-input text-only" placeholder="Rose Gold" required>
    //                     </div>
    //                     <div class="col-md-3">
    //                         <label for="SKU" class="form-label">*SKU Code</label>
    //                         <input type="text" name="var_sku" class="form-input" placeholder="SKU" required>
    //                     </div>
    //                     <div class="col-md-2">
    //                         <label for="Weight" class="form-label">Weight:</label>
    //                         <input type="text" name="weight" class="form-input numbers-only" placeholder="20 g" required>
    //                     </div>
    //                     <div class="col-md-3">
    //                         <label for="Stock" class="form-label">*Stock</label>
    //                         <input type="text" name="stock" class="form-input numbers-only" placeholder="256" required>
    //                     </div>
    //                     <div class="col-4">
    //                         <label for="Product Base Price" class="form-label">*Product Base Price :</label>
    //                         <input type="text"  name="base_price" class="form-input numbers-only" placeholder="Type Base price" required>
    //                     </div>
    //                     <div class="col-4">
    //                         <label for="Sale Price" class="form-label">*Sale Price:</label>
    //                         <input type="text"  name="sale_price" class="form-input numbers-only" placeholder="Type sale price" required oninput="validatePrices()">
    //                     </div>
    //                     <p id="price-error" style="color: red; display: none;"><small>Product Base Price should be less than or equal to the Sale Price.</small></p>
    //                 </div>
    //                 <div class="row d-flex justify-content-center">
    //                     <div class="col-4">
    //                         <label for="Product Status" class="form-label">Product Status:</label>
    //                         <select class="form-select" name="status">
    //                             <option value="1">Active</option>
    //                             <option value="2">Not-Active</option>
    //                         </select>
    //                     </div>
    //                 </div>
    //             </div>
    //             <button type="button" class="delete-btn remove-variant" type="button">
    //                 <span class="material-symbols-outlined">delete</span>
    //             </button>
    //         </div>
    //         <button type="button" style="font-size:13px; border-radius:25px !important; box-shadow:0px 8px 20px #4A90E2;" class="btn btn-primary me-3" type="button" onclick="AddNewVarient('<?= $product['id'] ?>')">Save Variant</button>
    //     </div>
    //     </form>`;
        
    //     $('#variants-container').append(newVariant);
    // });
    // $(document).on('click', '.remove-variant', function() {
    //     $(this).closest('.variant-section').remove();
    // });

    // $(document).on('change', '.image-upload', function() {
    //     var input = $(this);
    //     var previewContainer = input.siblings('.image-preview-container');
    //     previewContainer.empty();
        
    //     if (input[0].files) {
    //         $.each(input[0].files, function(index, file) {
    //             var reader = new FileReader();
    //             reader.onload = function(e) {
    //                 var imgElement = $('<div class="image-box"><img src="' + e.target.result + '" alt="Preview"><span class="delete-icon">x</span></div>');
    //                 previewContainer.append(imgElement);
    //             };
    //             reader.readAsDataURL(file);
    //         });
    //     }
    // });

    // $(document).on('click', '.delete-icon', function() {
    //     $(this).closest('.image-box').remove();
    // });



// =====================changes-02-12-2024=======================
// function AddNewVarient(id){
//     const formElement = document.getElementById('addNewVarientForm');
//     const formData = new FormData(formElement);
//     formData.append('jwellary_id', id);
//     console.log(formData);
// }


let variantCounter = 0; // Counter to ensure unique IDs
let variantExists = false; // Flag to check if a clone exists

$('#add-variant-btn').on('click', function (event) {
    event.preventDefault(); // Prevent page reload

    // Check if a variant already exists
    if (variantExists) {
        // alert("You can only create one variant at a time. Delete the existing one to add a new variant.");
        document.getElementById('alertResponse').innerHTML="You can only create one variant at a time. Delete the existing one to add a new variant.";
        alertModal()
        
        
        return; // Prevent further execution
    }

    // Increment counter for unique IDs
    variantCounter++;
    variantExists = true; // Set the flag to true

    // New variant section with a unique form ID
    var newVariant = `
<form id="addNewVariantForm-${variantCounter}" enctype="multipart/form-data">
    <div class="variant-section mt-5 mb-3">
        <div class="d-flex align-items-center mb-3">
            <div class="product-container-3">
                <div class="custom-file-input-container" style="position: absolute; top: -35px; left: 20px; cursor: pointer; background-color: #3182ce; color: white; padding: 5px 20px; border-radius: 5px; font-size: 13px; width: 150px">
                    <input type="file" class="preview-input" name="images[]" accept="image/*" multiple style="display: none;">
                    <label class="custom-label d-flex justify-content-center preview-input-btn">
                        *Upload Images
                    </label>
                </div>
                <div class="image-preview-container"></div>
            </div>
            <div class="details">
                <div class="row d-flex flex-wrap">
                    <div class="col-5">
                        <label for="Item Dimensions" class="form-label">Item Dimensions :</label>
                        <input type="text" name="dimension" class="form-input" placeholder="23 x 3 x 2 Centimeters">
                    </div>
                    <div class="col-3">
                        <label for="Color" class="form-label">*Color</label>
                        <input type="text" name="color" class="form-input text-only" placeholder="Rose Gold" required>
                    </div>
                    <div class="col-3">
                        <label for="SKU" class="form-label">*SKU Code</label>
                        <input type="text" name="var_sku" class="form-input" placeholder="SKU" required>
                    </div>
                    <div class="col-2">
                        <label for="Weight" class="form-label">Weight:</label>
                        <input type="text" name="weight" class="form-input numbers-only" placeholder="20 g" required>
                    </div>
                    <div class="col-3">
                        <label for="Stock" class="form-label">*Stock</label>
                        <input type="text" name="stock" class="form-input numbers-only" placeholder="256" required>
                    </div>
                    <div class="col-5">
                        <label for="Product Base Price" class="form-label">*Product Base Price :</label>
                        <input type="text" name="base_price" class="form-input numbers-only" placeholder="Type Base price" required>
                    </div>
                    <div class="col-5">
                        <label for="Sale Price" class="form-label">*Sale Price:</label>
                        <input type="text" name="sale_price" class="form-input numbers-only" placeholder="Type sale price" required>
                        <p id="price-error" style="color: red; display: none;"><small>Product Base Price should be less than or equal to the Sale Price.</small></p>
                    </div>
                    <div class="col-4">
                        <label for="Product Status" class="form-label">Product Status:</label>
                        <select class="form-select" name="status">
                            <option value="1">Active</option>
                            <option value="2">Not-Active</option>
                        </select>
                    </div>
                </div>
                <div class="row d-flex justify-content-center">
                </div>
            </div>
            <button class="delete-btn remove-variant" type="button">
                <span class="material-symbols-outlined">delete</span>
            </button>
        </div>
        <button type="button" class="btn btn-primary me-3 save-variant-btn" data-form-id="addNewVariantForm-${variantCounter}" style="font-size:13px; border-radius:25px !important; box-shadow:0px 8px 20px #4A90E2;">
            Save Variant
        </button>
    </div>
</form>`;

    // Append the new variant to the last .variants-container
    $('.variants-container').last().append(newVariant);
});



$(document).on('click', '.save-variant-btn', function () {
    const formId = $(this).data('form-id');
    const formElement = document.getElementById(formId);

    if (formElement && formElement.tagName === 'FORM') {
        const formData = new FormData(formElement);

        const id = '<?= $product['id']?>';
        formData.append('jwellary_id', id);
        console.log(formData);

        console.log('Form Data:', formData); // Logs the form data with additional fields

        // Perform the AJAX request to submit the form data
        $.ajax({
            url: '<?= base_url('addNewVarient') ?>', // Your endpoint
            type: 'POST',
            data: formData, // Send the FormData object
            contentType: false, // Let jQuery handle the content type
            processData: false, // Let jQuery handle the process data
            success: function (response) {
                console.log(response);
                if (response) {
                    document.getElementById('alertResponse').innerHTML="Details Updated Successfully";
                    alertModal()
                    window.location.reload();
                } else {
                    // alert('Something went wrong');
                    document.getElementById('alertResponse').innerHTML="Something went wrong";
                    alertModal()
                    
                }
            },
            error: function (xhr, status, error) {
                // console.error('Error Updating Details:', error);
                // alert('An error occurred while saving the details.');
                document.getElementById('alertResponse').innerHTML="An error occurred while saving the details.";
                alertModal()
            }
        });

        console.log(`Form Data for ${formId}:`);
        for (let [key, value] of formData.entries()) {
            console.log(`${key}:`, value);
        }
    } else {
        console.error(`Form with ID "${formId}" not found or is not a valid form.`);
    }
});


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
            variantExists = false; // Reset the flag
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


document.addEventListener("DOMContentLoaded", function () {
    const variantsContainer = document.getElementById("variants-container");
    const addVariantBtn = document.getElementById("add-variant-btn");

    // Function to validate prices
    function validatePrices() {
        const variantSections = document.querySelectorAll(".variant-section");
        variantSections.forEach(section => {
            const basePriceInput = section.querySelector("[name='base_price[]']");
            const salePriceInput = section.querySelector("[name='sale_price[]']");
            const error = section.querySelector("#price-error");

            const basePrice = parseFloat(basePriceInput.value) || 0;
            const salePrice = parseFloat(salePriceInput.value) || 0;

            if (salePrice && basePrice > salePrice) {
                error.style.display = "block";
            } else {
                error.style.display = "none";
            }
        });
    }

    // Add event listener for price validation
    variantsContainer.addEventListener("input", function (e) {
        if (
            e.target.name === "base_price[]" || 
            e.target.name === "sale_price[]"
        ) {
            validatePrices();
        }
    });
   
});



function showSingleImgModal() {
    event.preventDefault();
    const modal = document.getElementById('singleImgModal');
    modal.style.display = 'block';
}

// Function to close the modal
function closeSingleImgModal() {
    event.preventDefault();
    const modal = document.getElementById('singleImgModal');
    modal.style.display = 'none';
}





function addNewImage(varid) {
    console.log(varid);
    // Check if an input field already exists
    if (document.getElementById('imageInputField')) {
        // alert('An image input field is already active.');
        showSingleImgModal()
        return;
    }

    // Create the image input field (hidden)
    const imageInput = document.createElement('input');
    imageInput.type = 'file';
    imageInput.accept = 'image/*';
    imageInput.id = 'imageInputField';
    imageInput.style.display = 'none'; // Hide the input field
    // imageInput.onchange = function () {
    //     previewImage(imageInput);
    // };



    imageInput.onchange = function () {
        const file = imageInput.files[0];
        if (file) {
            const formData = new FormData();
            formData.append('image', file);
            formData.append('varient_id', varid);

            // Send AJAX request to the server
            fetch('<?= base_url('addNewImage') ?>', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // alert('Image updated successfully!');
                    $('#successModal').show();
                    //Optionally, refresh the image display
                    setInterval(() => {
                        location.reload();  
                    }, 2000);
                } else {
                    // alert('Image update failed: ' + data.message);
                    document.getElementById('alertResponse').innerHTML="Image update failed: " + data.message;
                    alertModal();
                }
            })
            .catch(error => {
                console.error('Error:', error);
                // alert('An error occurred. Please try again.');
                $('#errorModal').show();
            });
        }
    };


    // Append the input field to the container
    document.getElementById('imageContainer').appendChild(imageInput);

    // Automatically trigger the file input dialog
    imageInput.click();
}

function previewImage(inputElement) {
    const previewContainer = document.getElementById('singlePreviewContainer');
    previewContainer.innerHTML = ''; // Clear existing preview

    // Check if a file is selected
    if (inputElement.files && inputElement.files[0]) {
        const reader = new FileReader();

        reader.onload = function (e) {
            // Create a new preview element
            const preview = document.createElement('div');
            preview.style.height = '100px';
            preview.style.width = '100px';
            preview.style.backgroundImage = `url(${e.target.result})`;
            preview.style.backgroundSize = 'cover';
            preview.style.backgroundPosition = 'center';
            preview.style.border = '1px solid #ddd';
            preview.style.boxShadow = '0px 4px 10px rgba(0,0,0,0.1)';

            // Append the preview to the preview container
            previewContainer.appendChild(preview);
        };

        reader.readAsDataURL(inputElement.files[0]);
    }
}








// ===================== end changes-02-12-2024=======================



function updateImage(imageId) {
    // Create an input to select a new file
    const fileInput = document.createElement('input');
    fileInput.type = 'file';
    fileInput.accept = 'image/*';
    
    // When a file is selected, upload it
    fileInput.onchange = function () {
        const file = fileInput.files[0];
        if (file) {
            const formData = new FormData();
            formData.append('image', file);
            formData.append('image_id', imageId);

            // Send AJAX request to the server
            fetch('<?= base_url('updateImage') ?>', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // alert('Image updated successfully!');
                    $('#successModal').show();
                    // Optionally, refresh the image display
                    setInterval(() => {
                        location.reload();  
                    }, 2000);
                } else {
                    // alert('Image update failed: ' + data.message);
                    document.getElementById('alertResponse').innerHTML="Image update failed: " + data.message;
                    alertModal();
                    
                }
            })
            .catch(error => {
                console.error('Error:', error);
                // alert('An error occurred. Please try again.');
                $('#errorModal').show();
            });
        }
    };

    // Trigger the file input click
    fileInput.click();
}











    </script>
    
  




</body>
</html>