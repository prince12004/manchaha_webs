<?php $this->load->View('Admin/header') ?>
<div class=" mt-2">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="add-product-h1 mt-3">Add Products</h1>
            <!-- <small class="add-product-small">Lorem ipsum is simply dummy text</small> -->
        </div>
        <div class="d-flex">
            <button type="button" class="btn btn-dark me-2 d-flex align-items-center"><span
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
                <!--product-category -->
                <label for="product-category" class="form-label">Product Category</label>
                <select id="product-category" class="form-select">
                    <option>Mens</option>
                    <option>Women</option>
                    <option>kids</option>
                    <!-- Add categories here -->
                </select>
                <!--sub-category-01 -->
                <label for="Sub Category 01" class="form-label">Sub Category 01</label>
                <select id="sub-category-01" class="form-select">
                    <option>Jeans</option>
                    <option>Shirt</option>
                    <option>Shorts</option>
                    <option>Saree</option>
                    <!-- Add categories here -->
                </select>
                <!--sub-category-02 -->
                <label for="Sub Category 01" class="form-label">Sub Category 02</label>
                <input id="sub-category-01" type="text" class="form-input">
                <!--sub-category-03 -->
                <label for="Sub Category 01" class="form-label">Sub Category 03</label>
                <select id="sub-category-01" class="form-select">
                    <option>Jeans</option>
                    <option>Shirt</option>
                    <option>Shorts</option>
                    <option>Saree</option>
                    <!-- Add categories here -->
                </select>
                <!--sub-category-04 -->
                <label for="Sub Category 04" class="form-label">Sub Category 04</label>
                <input id="sub-category-04" type="text" class="form-input">
            </div>
            <!-- ---------Inventory------------ -->
            <div class="section container  mb-3">
                <h5>INVENTORY</h5>
                <!-- product id -->
                <label for="Product ID" class="form-label">Product ID</label>
                <input id="Product-ID" type="text" class="form-input">
                <!-- Visibility -->
                <label for="product-visibility" class="form-label">Visibility Status</label>
                <select id="Visibility-status" class="form-select">
                    <option>Published</option>
                    <option>Un-Published</option>
                </select>
                <!-- product id -->
                <label for="SKU" class="form-label">SKU</label>
                <input id="SKU" type="text" class="form-input">
                <!-- Discount type -->
                <label for="Discount type" class="form-label">Discount Type</label>
                <select id="Discount-type" class="form-select">
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
                <select id="Product-tags" class="form-select">
                    <option>Tag 01</option>
                    <option>Tag 02</option>
                </select>
                <!-- Publish Schedule -->
                <label for="Publish Schedule" class="form-label">Publish Schedule</label> <br>
                <input type="datetime-local" class="form-input" name="Publish Schedule" id="Publish-Schedule">
            </div>
            <div class="section container mb-3">
                <h5>Product Details</h5>
                <!--product-category -->
                <div class="row">
                    <div class="col-6">
                        <label for="product Type" class="form-label">Type</label>
                        <input id="product-Type" type="text" class="form-input" placeholder="V-Neck">
                    </div>
                    <div class="col-6">
                        <label for="product Style" class="form-label">Style</label>
                        <input id="Product-syle" type="text" class="form-input" placeholder="Jacket">
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <label for="Product sleevs" class="form-label">Sleevs</label>
                        <input id="Product-sleevs" type="text" class="form-input" placeholder="Full Sleevs">
                    </div>
                    <div class="col-6">
                        <label for="Suitable for" class="form-label">Suitable For</label>
                        <input id="Suitable-for" type="text" class="form-input" placeholder="Western Wear">
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <label for="product fabric" class="form-label">Fabric</label>
                        <input id="product-fabric" type="text" class="form-input" placeholder="Cotton Blend">
                    </div>
                    <div class="col-6">
                        <label for="Product Brand" class="form-label">Brand </label>
                        <input id="Product-Brand" type="text" class="form-input" placeholder="Brand Name">
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <label for="product pattern" class="form-label">Pattern</label>
                        <input id="product-pattern" type="text" class="form-input" placeholder="Solid">
                    </div>
                    <div class="col-6">
                        <label for="Product fit" class="form-label">Fit</label>
                        <input id="Product-fit" type="text" class="form-input" placeholder="Regular">
                    </div>
                </div>

            </div>
            <div class="section container mb-3">
                <h5>General Image</h5>
                <div class="photo-container" id="photo-container">
                    <button id="upload-button">Upload Images</button>
                    <input type="file" id="file-input" accept="image/*" multiple style="display: none;">
                    <div class="image-gallery" id="image-gallery"></div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="section container  mb-3">
                <h5>General Information</h5>
                <label for="product-name" class="form-label">Product Name</label>
                <input type="text" id="product-name" class="form-control" placeholder="Type Product Name here...">
                <label for="product-description" class="form-label mt-3">Description</label>
                <textarea id="product-description" class="form-control" rows="3"
                    placeholder="Type Product Description here..."></textarea>
            </div>
            <div class="section container mb-3">
                <div class="product-discription-cont">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5>Product Discription</h5>
                    </div>
                    <div id="product-sections">
                        <div class="product-container">
                            <div class="image-upload">
                                <img src="https://via.placeholder.com/50" alt="Image Preview">
                                <input type="file" accept="image/*">
                                <span id="upload-text">UPLOAD IMAGE</span>
                            </div>
                            <div class="details">
                                <input type="text" class="form-input mb-1" placeholder="Type Title Heading here...">
                                <textarea id="product-description" class="form-control" rows="3"
                                    placeholder="Type Product Description here..."></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product-Specification-cont">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5>Product Specification</h5>
                    </div>
                    <div id="product-sections-2">
                        <div class="product-container-2">
                            <div class="image-upload-2">
                                <img src="https://via.placeholder.com/50" alt="Image Preview">
                                <input type="file" accept="image/*">
                                <span>UPLOAD IMAGE</span>
                            </div>
                            <div class="details">
                                <input type="text" class="form-input mb-1" placeholder="Type Title Heading here...">
                                <textarea id="product-description" class="form-control" rows="3"
                                    placeholder="Type Product Specification here..."></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="section container mb-3">
                <div class="row">
                    <h5>Policy Informtaion</h5>

                    <div class="col-md-6 ">
                        <label for="product grade" class="form-label mt-3">Seller Policy</label>
                        <select id="product-grade" class="form-select">
                            <option>10 days Return Policy?</option>
                            <option>20 days Return Policy?</option>
                            <option>30 days Return Policy?</option>

                        </select>
                    </div>
                    <div class="col-md-6 ">
                        <label for="product grade" class="form-label mt-3">Seller Policy</label>
                        <select id="product-grade" class="form-select">
                            <option>10 days Replacement Policy?</option>
                            <option>20 days Replacement Policy?</option>
                            <option>30 days Replacement Policy?</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="section container mb-3">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h5>Size-Stock</h5>
                    <button class="product-size-btn d-flex justify-content-center gap-1 align-items-center">
                        <span class="material-symbols-outlined">add_circle</span> Add Variant
                    </button>
                </div>
                <!-- Container to hold all product size-stock sections -->
                <div id="product-sections-4">
                    <!-- Original product size-stock section -->
                    <div class="product-container-4 mb-3">
                        <div class="row d-flex align-items-center">
                            <div class="col-md-4">
                                <label for="product Color" class="form-label">Color</label>
                                <input id="product-color" type="text" class="form-input" placeholder="White">
                            </div>
                            <div class="col-md-4">
                                <label for="product-Size" class="form-label mt-3">Size</label>
                                <select id="product-Size" class="form-select">
                                    <option>XS</option>
                                    <option>S</option>
                                    <option>M</option>
                                    <option>L</option>
                                    <option>XL</option>
                                    <option>XXL</option>
                                    <option>XXXL</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="product-stock" class="form-label mt-3">Stock</label>
                                <input id="product-stock" type="text" class="form-input" placeholder="256">
                            </div>
                            <button class="delete-btn mt-4 btn btn-danger">
                                <span class="material-symbols-outlined">
                                    delete</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="section container mb-3">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5>Product Information</h5>
                    <button class="product-info-btn d-flex justify-content-center gap-1 align-items-center"><span
                            class="material-symbols-outlined">
                            add_circle
                        </span> Add Vairant</button>
                </div>
                <div class="d-flex gap-1  flex-wrap " id="product-sections-3">
                    <div class=" mb-3 section-cloned-3">
                        <div class="product-container-3">
                            <!-- Plus button for adding images -->
                            <button id="add-image-btn" class="add-image-btn">
                                <span class="material-symbols-outlined">add</span>
                            </button>

                            <!-- Hidden input for file selection -->
                            <input type="file" id="image-upload" class="image-upload" accept="image/*"
                                style="display: none;" multiple>

                            <div class="image-preview-container">
                                <!-- Uploaded images will appear here -->
                            </div>
                        </div>

                        <div class="details p-0">
                            <div class="row d-flex justify-content-start align-items-end">
                                <div class="col-8">
                                    <label for="product Color" class="form-label">Color</label>
                                    <input id="product-color" type="text" class="form-input" placeholder="White">
                                </div>
                                <button class="delete-btn ">
                                    <span class="material-symbols-outlined">
                                        delete
                                    </span>
                                </button>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/js/all.min.js"></script>
<script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script src="<?= base_url('/assets/javascript/add-product-cloths.js') ?>"></script>
<script>


</script>






</body>

</html>
<style>
.product-container-3 {
    position: relative;
    width: 200px;
    /* Fixed width of the container */
    height: 200px;
    /* Fixed height of the container */
    border: 2px solid #ddd;
    padding: 2px;
    background-color: #ddd;
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    /* Create a 2x2 grid */
    grid-template-rows: repeat(2, 1fr);
    gap: 0px;
    /* Spacing between images */
    justify-items: center;
    /* Center items horizontally */
    align-items: center;
    /* Center items vertically */
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

.section-cloned-3 {
    width: 32%;
}
</style>