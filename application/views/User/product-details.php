<!-- --------------nav-section-end------------ -->

</header>
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
    font-size: 24px;
    font-weight: 600;
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

/* General Modal Styles */
.models {
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

.new-modal-content {
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

.new-modal-logo img {
    width: 240px;
    /* Adjust logo size */
    margin-bottom: 20px;
}

.new-modal h2 {
    font-size: 22px;
    font-weight: 500;
    color: black;
    margin-bottom: 20px;
    font-family: Arial, sans-serif;
}

.new-close-btn {
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

.new-close-btn:hover {
    background-color: #e04e27;
}

#errorModal h2 {
    color: red;
}

.new-modal {
    animation: fadeIn 0.3s ease-in-out;
}

.color-scroll {
    overflow: scroll;
}

.color-scroll::-webkit-scrollbar {
    display: none;
}

@media (max-width: 768px) {
    #alertModal {
        margin: 10px;
    }

    .models {
        margin: 10px;
    }
}

.goto-cart {
    background-color: #ff5733 !important;
    color: #FFFFFF;
    border: 1px solid #ff5733 !important;
    height: 40px !important;
}
.mains-reviewss{
	font-size: 18px;
	font-weight: 600;
	margin: 8px 0px;
	}
	
	    /* Default star appearance */
    .star {
        color: gray; /* Empty star color */
        cursor: pointer;
    }

    /* Filled star (selected) */
    .star.selected {
        color: yellow; /* Star text color when selected */
    }
	   .half-star {
            background: linear-gradient(to right, yellow 50%, grey 50%);
            -webkit-background-clip: text;
            color: transparent;
        }
</style>

<?php
$review_data = $this->db->select('COUNT(review) as review_count,COUNT(rating) as rating_count, AVG(rating) as avg_rating')
    ->from('reviews')
    ->where('product_id', $result['id'])
    ->get()
    ->row_array();
//print_r($result);
//exit;
?>

<div class=" product-discription am mt-4">
    <div class="row d-flex gap-2 justify-content-center">
        <!-- Product Images Section -->
        <div class="col-md-5 border-section">
            <div class="product-main-img col-6 ">
                <div class="zoom-container">
                    <!-- <?php print_r($result['id']['variants']) ?> -->
                    <?php $firstVariant = $result['variants'][0]; ?>
                    <img id="main-product-image" src="<?= $firstVariant['images'][0] ?>" class="img-fluid"
                        alt="Product Image" onmouseenter="showZoomModel(event)" onmousemove="moveZoomModel(event)"
                        onmouseleave="hideZoomModel()">
                    <div id="zoom-lens" class="zoom-lens"></div>
                </div>

            </div>
            <div class="thumbnail-container mt-3">
                <div id="carousel-G" class="owl-carousel owl-theme">
                    <?php foreach($firstVariant['images'] as $firstdata){ ?>
                    <div class="item">
                        <img src="<?= $firstdata ?>" class="img-fluid product-thumbnail" alt="Thumbnail 1"
                            id="base-images">
                    </div>
                    <?php } ?>
                    <!-- Add more thumbnails as needed -->

                </div>
            </div>

        </div>
        <!-- Product Description Section -->
        <div class="product-main-details pt-5">
            <h2 class="heading-A"><?= $result['jwellary_name']?></h2>
            <!-- <div class="product-rating">
                    <span class="stars">&#9733;&#9733;&#9733;&#9733;&#9733;</span>
                    <span class="reviews">14.5k</span>
                  </div> -->
            <div class=" px-2">
                <div class="product-info">
                    <p><?= $result['jwellary_description']?></p>
                    <!-- <h6 class="col-10 mb-3">1 Set - 7 Colours 35 Piece, Set Price ₹ 8,450.00 ( MRP:₹ 8,450.00 )</h6> -->
                    <!-- <button class="btn btn-success">In Stock</button> -->


                    <div class="price-pincode-cont d-flex justify-content-between">
                        <?php
                            $discount = ($firstVariant['base_price']-$firstVariant['sale_price'])*100/$firstVariant['base_price'];
                            ?>
                        <div class="left">
                            <div class="product-pricing">
                                <span
                                    style="font-size: 25px; font-weight: 700; color: black; margin-right: 4px; ">₹</span>
                                <span id="new-price" class="new-price"> <?= $firstVariant['sale_price']?></span>
                                <span
                                    style="font-size: 25x; font-weight: 700; color: black; margin-right: 4px; ">₹</span>
                                <span id="old-price" class="old-price"> <?= $firstVariant['base_price']?></span>
                                <span style="font-size: 15x; font-weight: 70; color: green; margin-right: 4px; "></span>
                                <span style="color: green;" id="discount" class="discount"> <?= round($discount)?>%
                                    off</span>
                            </div>

                            <div class="category mt-2 d-flex gap-2 align-items-center">
                                <h3 class="product-headingB">
                                    Category:
                                </h3>
                                <span id="product-category" class="product-paraB"><?= $result['CategoryName'] ?></span>

                            </div>
                            <div class="SKU d-flex mt-2 gap-2 align-items-center">
                                <h3 class="product-headingB">
                                    SKU:
                                </h3>
                                <span id="product-sku" class="product-paraB"><?= $firstVariant['varient_sku']?></span>
                            </div>
                            <p id="varient_id" style="display: none; position:absolute ">
                                <?= $firstVariant['varient_id']?></p>
                        </div>
                        <div class="right d-flex justify-content-start mt-2 align-items-center">
                            <div>
                                <form class="d-flex justify-content-center">
                                    <label class="product-headingB d-flex align-items-end"
                                        for="pinCodeInp">Delivery</label>
                                    <input id="pinCodeInp" class="form-control numbers-only pinCodeInp" name="pincode"
                                        value="<?= set_value('pincode')?>" placeholder="Enter Delivery Pin Code"
                                        type="text">
                                    <button type="button" onclick="checkDelivery()" class="checkPinCodebtn"
                                        class="btn btn-blue">check</button>
                                </form>
                                <p id="deliveryUpdate" style="display:none;"><small class="text-danger"> This item can
                                        deliver here</small></p>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between mt-4">
                        <!-- -----------size buttons--------- -->
                        <?php if(isset($result['sizing'])){?>
                        <div class="size-cont">
                            <div class="size-button">
                                <p class="dark-text">SIZE </p>
                                <div class=" d-flex gap-2">


                                    <span class="size">
                                        <input type="radio" name="size" id="size-30" class="size-radio" value="30"
                                            hidden>

                                        <label for="size-30"
                                            class="btn btn-outline-secondary size-label"><?= $result['sizing'] ?></label>
                                    </span>

                                </div>
                            </div>
                        </div>
                        <?php }?>
                        <!-- ------color-button---------- -->
                        <div class="color-cont">
                            <p class="dark-text">Other Colours </p>
                            <div class="d-flex gap-1 color-scroll">
                                <!-- <?php foreach($result['variant_colors'] as $key => $varientc){ ?>
                                        <div class="color">
                                          <input type="radio" name="color" id="color-<?= $varientc ?>" class="color-radio" value="<?= $varientc ?>" hidden>
                                            <label for="color-<?= $varientc ?>" onclick="filterbycolor('<?= $result['id'] ?>','<?= $varientc?>')" class="color-dot me-2 active" style="background-color: <?= $varientc ?>;" data-image="<?= $result['variants'][$key]['images'][0] ?>"></label>
                                        </div>
                                    <?php } ?> -->

                                <?php foreach($result['variants'] as $varientc){ ?>
                                <div class="color">
                                    <!-- <input type="radio" name="color" id="color-<?= $varientc ?>" class="color-radio" value="<?= $varientc ?>" hidden> -->
                                    <!-- <label for="color-<?= $varientc['color'] ?>" onclick="filterbycolor('<?= $result['id'] ?>','<?= $varientc['color']?>')" class="color-dot me-2 active" style="background-color: <?= $varientc['color'] ?>;" data-image="<?= $result['variants'][$key]['images'][0] ?>"></label> -->
                                    <img onclick="filterbycolor('<?= $result['id'] ?>','<?= $varientc['varient_id']?>')"
                                        style="height: 55px;width=:55px;" src="<?= $varientc['images']['0']?>">
                                </div>
                                <?php } ?>


                            </div>
                        </div>


                    </div>

                    <div class="mt-4 price-section d-flex justify-content-between align-items-center">
                        <span class="ms-3">
                            <p class="dark-text">QUANTITY</p>
                            <div class="quantity">
                                <div class="quantity-controls-btn">
                                    <button id="decrease-quantity">&minus;</button>
                                    <input id="product-quantity" type="text" class="form-control" value="1" min="1">
                                    <button id="increase-quantity">&plus;</button>
                                </div>
                            </div>
                        </span>
                        <div class="cart-btn d-flex gap-2">
                            <!-- <?= print_r($result['variants'])?> -->
                            <?php if(!empty($result['variants'][0]['in_cart'])){?>
                            <button class="btn btn-primary goto-cart" onclick="goToCart()">
                                <span class="material-symbols-outlined">
                                    add_shopping_cart
                                </span>GO TO CART</a>
                            </button>
                            <?php }else{?>
                            <button class="btn btn-primary" onclick="addToCart('<?= $result['id']?>')">
                                <span class="material-symbols-outlined">
                                    add_shopping_cart
                                </span>ADD TO CART</a>
                            </button>
                            <?php }?>

                            <button class="btn btn-secondary" onclick="addToWishlist('<?= $result['id']?>')">
                                <div class="wishlist-btn">
                                    <span id="heart-icon" class="heart-icon">&#9829;<span class="wishlist-text">
                                            ADD TO WISHLIST
                                        </span></span>
                                    <input type="hidden" id="heart-input" name="heartStatus" value="0">
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Product Info Section -->
    </div>
</div>
</div>
<!-- ==================================Discriptions============================ -->
<div class="discription-content">
    <div class="content am">
        <div class="tabs">
            <!-- <div class="tab active" data-tab="description">Description</div> -->
            <!-- <div class="tab" data-tab="specifications">Specifications</div> -->
            <div class="tab active" data-tab="reviews">Reviews (<?= $review_data['review_count']?>)</div>
        </div>

        <div id="tab-content">
            <!-- Description Section -->
            <div class="content-container" id="description">
                <!-- <div class="content-img">
                    <img src="https://via.placeholder.com/400x300" alt="Description Image">
                </div> -->
                <!-- <div class="content-text">
                    <h2>Lorem Ipsum is simply dummy text of the printing industry</h2>
                    <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</p>
                    <div class="content-details">
                        <div>
                            <p><strong>Material: <br></strong></p>
                            <p><strong>Manufacturer: <br></strong> Manchaha</p>
                        </div>
                        <div>
                            <p><strong>Claimed Size: <br></strong></p>
                            <p><strong>Recommended Use: <br></strong> for <?= $result['ideal_for'] ?></p>
                        </div>
                    </div>
                </div> -->
            </div> <!-- End of description -->

            <!-- Specifications Section -->
            <div class="content-container" id="specifications" style="display: none;">
                <div class="content-img">
                    <img src="https://via.placeholder.com/400x300" alt="Specifications Image">
                </div>
                <div class="content-text">
                    <h2>Specifications</h2>
                    <p>Details and specifications about the product go here.</p>
                    <div class="content-details">
                        <div>
                            <p><strong>Weight:</strong>kg</p>
                            <p><strong>Dimensions:</strong> cm</p>
                        </div>
                        <div>
                            <p><strong>Color:</strong> </p>
                            <p><strong>Material:</strong></p>
                        </div>
                    </div>
                </div>
            </div> <!-- End of specifications -->

            <!-- Reviews Section -->
            <div class="content-container" id="reviews">
                <div class="content-img">
					<?php if (!empty($result['thumbnail'])) { ?>
						<img src="<?= base_url('uploads/products/') . $result['thumbnail']; ?>" alt="Reviews Image">
					<?php } elseif (!empty($firstVariant['images'][0])) { ?>
						<img src="<?= $firstVariant['images'][0]; ?>" alt="Reviews Image">
					<?php } ?>

                </div>
                <div class="content-text">
                    <h2>Ratings & Reviews</h2>
                    <div class="main-reviews">
                        <div class="mains-rating">
                            <p><?= $review_data['review_count']?> Ratings & <?= $review_data['rating_count']?> Reviews</p>
                        </div>
                        <div class="main-ratings">
                            <div class="stars">
                                <p><?= round($review_data['avg_rating'],1)?></p>
                                <label class="star <?= ($review_data['avg_rating'] >= 1) ? 'selected' : ''; ?>">&#9733;</label>
                                <label class="star <?= ($review_data['avg_rating'] >= 2) ? 'selected' : ''; ?>">&#9733;</label>
                                <label class="star <?= ($review_data['avg_rating'] >= 3) ? 'selected' : ''; ?>">&#9733;</label>
                                <label class="star <?= ($review_data['avg_rating'] >= 4) ? 'selected' : ''; ?>">&#9733;</label>
                                <label class="star <?= ($review_data['avg_rating'] >= 5) ? 'selected' : ''; ?>">&#9733;</label>
                            </div>
                        </div> 
                    </div>
                 <!--   <div class="ratings-list">
                        <div class="review-process">
                            <p>
                                Excellent
                                <div class="progress-bar"><span class="excellent"></span></div>
                                <span>10</span>
                            </p>
                        </div>
                        <div class="review-process">
                            <p>
                                Very Good
                                <div class="progress-bar"><span class="very-good"></span></div>
                                <span>7</span>
                            </p>
                        </div>
                        <div class="review-process">
                            <p>
                                Good
                                <div class="progress-bar"><span class="good"></span></div>
                                <span>7</span>
                            </p>
                        </div>
                        <div class="review-process">
                            <p>
                                Average
                                <div class="progress-bar"><span class="average"></span></div>
                                <span>4</span>
                            </p>
                        </div>
                        <div class="review-process">
                            <p>
                                Poor
                                <div class="progress-bar"><span class="poor"></span></div>
                                <span>0</span>
                            </p>
                        </div>
                    </div> -->
					<?php if($review_data['review_count']>=1){?>
                    
					<a href="<?= base_url('allreview/').$result['id'] ?>" class="mains-reviewss"> All Review</a>
					<?php }else{?>
					<p class="details-para-n">No reviews yet. Be the first to review this product!</p>
					<?php }?>
					
                </div>
            </div> <!-- End of reviews -->
        </div> <!-- End of tab-content -->
    </div> <!-- End of content -->
</div> <!-- End of discription-content -->


<!-- ==================================Discriptions-ends============================ -->



<!-- ====================latest-popular-product-Starts============================ -->

<!-- <section class="latest-popular am">
        <div class="heading-menu d-flex align-itms-center justify-content-between">
            <div class="left-heading">
                <h2 class="heading-A">Latest Popular Products</h2>
                <img src="images/heading-line.png" alt="">
                <p class="para-A">Lorem Ipsum is simply dummy text of the printing</p>
            </div>
            <div class="right-menu">
                <button class="btn btn-primary"> View All <span class="material-symbols-outlined">
                    arrow_forward
                    </span>
                </button>
            </div>
        </div>
        <div id="carousel-F" class="owl-carousel owl-theme">
                <div class="item Card-A">
                    <div class="product-card">
                        <div class="product-image">
                          <img src="images/latest_pr1.png" alt="Product Image">
                          <div class="wishlist-btn">
                            <span id="heart-icon" class="heart-icon">&#9829;</span>
                            <input type="hidden" id="heart-input" name="heartStatus" value="0">
                        </div>
                        </div>
                        <a href="#">
                            <div class="product-info">
                                <h4 class="product-title">Simply Dummy Text</h4>
                                <p class="product-description">
                                  Lorem Ipsum is simply dummy text of the printing & typesetting industry.
                                </p>
                                <div class="product-rating">
                                  <span class="stars">&#9733;&#9733;&#9733;&#9733;&#9733;</span>
                                  <span class="reviews">14.5k</span>
                                </div>
                                <div class="product-pricing">
                                  <span id="newprice" class="new-price">400.50₹</span>
                                  <span id="baseprice" class="old-price">520.50₹</span>
                                  <button class="add-to-cart-btn"><span class="material-symbols-outlined">
                                      shopping_cart
                                      </span>Add Now</button>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                   
        </div>

    </section> -->
<!-- ====================latest-popular-product-ends============================ -->

<!-- ====================Testimonial-section============================ -->

<!-- <section class="testimonial-section">
        <div class="heading-para">
            <h2 class="heading-A">What our <br> Customers Says</h2>
                <img src="images/heading-line.png" alt="">
                <h4 class="">Lorem Ipsum is simply dummy text of the printing</h4>
                <p>
                    Lorem Ipsum is simply dummy text of the printing and typesetting 
                    industry. Lorem Ipsum has been the industry's standard dummy 
                    text ever since the. when an unknown printer took a galley of type 
                    and scrambled it to make a type specimen book. It has surviv
                </p>
        </div>
        <div class="testimonial-carousel">
            <div id="carousel-E" class="owl-carousel owl-theme">
                <div class="item">
                    <div class="card">
                        <div class="image-rating d-flex align-items-center justify-content-start w-100">
                            <img src="images/testi_2.png" alt="User Image">
                            <div class="name-rating">
                                <div class="title">Lorem Ipsum</div>
                            <div class="subtitle">Simply dummy text</div>
                            <div class="stars">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
                            </div>
                        </div>
                        <div class="description">
                            Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor
                        </div>
                        <img class="quote-icon" src="images/testi-comma.png" alt="Quote Icon">
                    </div>
                </div> 
                <div class="item">
                    <div class="card">
                        <div class="image-rating d-flex align-items-center justify-content-start w-100">
                            <img src="images/testi_1.png" alt="User Image">
                            <div class="name-rating">
                                <div class="title">Lorem Ipsum</div>
                            <div class="subtitle">Simply dummy text</div>
                            <div class="stars">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
                            </div>
                        </div>
                        <div class="description">
                            Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor
                        </div>
                        <img class="quote-icon" src="images/testi-comma.png" alt="Quote Icon">
                    </div>
                </div> 
            </div>
        </div>
    </section> -->


<div id="alertModal" class="modal" style="display: none;">
    <div class="modal-content">
        <!-- Logo in the center -->
        <div class="modal-logo">
            <img src="<?= base_url('/assets/images/images/header-new-logo.png') ?>" alt="Logo">
        </div>
        <h2 id="alertResponse"></h2>
        <button class="close-btn" onclick="closeErrorModal()">Close</button>
    </div>
</div>

<?php $this->load->view('User/footer') ?>


<div id="successModalcart" class="new-modal models" style="display: none;">
    <div class="new-modal-content">
        <!-- Logo in the center -->
        <div class="new-modal-logo">
            <img src="<?= base_url('/assets/images/images/header-new-logo.png') ?>" alt="Logo">
        </div>
        <h2>Product Added to Cart</h2>
    </div>
</div>

<div id="wishlist_successModalcart" class="new-modal models" style="display: none;">
    <div class="new-modal-content">
        <!-- Logo in the center -->
        <div class="new-modal-logo">
            <img src="<?= base_url('/assets/images/images/header-new-logo.png') ?>" alt="Logo">
        </div>
        <h2>Product Added to Wishlist</h2>
    </div>
</div>

<div id="errorModal" class="new-modal models" style="display: none;">
    <div class="new-modal-content">
        <!-- Logo in the center -->
        <div class="new-modal-logo">
            <img src="<?= base_url('/assets/images/images/header-new-logo.png') ?>" alt="Logo">
        </div>
        <h2 id="errorResponse"></h2>
        <button class="new-close-btn" onclick="closeErrorModal()">Close</button>
    </div>
</div>
<div id="zoom-lens" class="zoom-lens"></div>
<div id="zoom-preview" class="zoom-preview">
    <img id="zoomed-img" src="<?= $firstVariant['images'][0] ?>" alt="Zoomed Image" class="img-fluid">
</div>

<!-- Zoomed Image Preview 
<div id="zoom-preview" class="zoom-preview">
    <img id="zoomed-img" src="<?= $firstVariant['images'][0] ?>" alt="Zoomed Image">
</div>-->
<!-- ====================Deals of the day Ends============================ -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

<script>
$(document).ready(function() {
    // When color changes, update product details
    $('input[name="color"]').change(function() {
        var selectedColor = $(this).val();
        var $label = $(this).siblings('label');

        // Get variant data from the selected label

        var newImage = $label.attr('data-image');
        var newPrice = $label.attr('data-price');
        var newBasePrice = $label.attr('data-base-price');
        var newSKU = $label.attr('data-sku');
        var newDimension = $label.attr('data-dimension');

        // Update the main product image
        $('#main-product-image').attr('src', newImage);
        // $('#base-images').attr('src', newImage);

        // Update the product price
        $('.new-price').text(newPrice + '₹');
        $('.old-price').text(newBasePrice + '₹');

        // Update the product SKU
        $('#product-sku').text(newSKU);

        // Update the product dimension/size
        $('.size-label').text(newDimension);
    });

    // Trigger change event on page load to set default details
    $('input[name="color"]:checked').trigger('change');
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


$('.color-dot').click(function() {
    $('.color-dot').removeClass('selected');
    $(this).addClass('selected');
    var imageSrc = $(this).data('image');
    $('#main-product-image').attr('src', imageSrc);
});
$('#decrease-quantity').click(function() {
    var quantity = parseInt($('#product-quantity').val());
    if (quantity > 1) {
        $('#product-quantity').val(quantity - 1).trigger('input');
    }
});

$('#increase-quantity').click(function() {
    var quantity = parseInt($('#product-quantity').val());
    $('#product-quantity').val(quantity + 1).trigger('input');
});

// Event listeners for color dots and size buttons using jQuery
$('.color-dot').on('click', function(e) {
    e.preventDefault();
    $('.color-dot').removeClass('active');
    $(this).addClass('active');
    $(this).prev('input[type="radio"]').prop('checked', true);
});



$('.size-label').on('click', function(e) {
    e.preventDefault();
    $('.size-label').removeClass('active');
    $(this).addClass('active');
    $(this).prev('input[type="radio"]').prop('checked', true);
});


$(document).ready(function() {
    $('#carousel-F').owlCarousel({
        loop: true,
        margin: 10,
        dots: false,
        nav: false,
        navText: ["<", ">"],
        autoplay: true,
        autoplayTimeout: 6000,
        responsive: {
            0: {
                items: 3
            },
            600: {
                items: 4
            },
            1000: {
                items: 4
            }
        }
    });
});
$(document).ready(function() {
    $('#carousel-G').owlCarousel({
        items: 4,
        loop: false,
        margin: 10,
        nav: true,
        dots: false,
        navText: ["<", ">"],
        autoplayTimeout: 6000,

    });
});

$(document).ready(function() {
    $('#carousel-E').owlCarousel({
        loop: true,
        margin: 15,
        nav: true,
        dots: false,
        navText: ["<", ">"],
        autoplay: true,
        autoplayTimeout: 2000,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 2
            },
            1000: {
                items: 2
            }
        }
    });
});

$(document).ready(function() {
    $('.tab').click(function() {
        // Remove active class from all tabs
        $('.tab').removeClass('active');
        // Add active class to the clicked tab
        $(this).addClass('active');

        // Hide all content containers
        $('.content-container').hide();
        // Show the corresponding content container
        $('#' + $(this).data('tab')).show();
    });
});



$(document).ready(function() {
    $('.navlink-nav-menu li a').on('click', function(event) {
        event.preventDefault();
        $('.navlink-nav-menu li ').removeClass('active-nav');
        $(this).parent().addClass('active-nav');
    });
});
let weight = '';
let pickup_postcode = '283101';

function filterbycolor(id, varient_id) {
	const variants = <?= json_encode($result['variants']) ?>;
    const selectedVariant = variants.find(variant => variant.varient_id === varient_id);
	//console.log(selectedVariant.images[0]);
	        if (selectedVariant && selectedVariant.images[0]) {
            changeImage(selectedVariant.images[0]);
        }

    data = {
        id: id,
        varient_id: varient_id
    }


    $.ajax({
        url: '<?= base_url('getimagesbycolor') ?>',
        type: 'POST',
        data: JSON.stringify(data),
        contentType: 'application/json',
        dataType: 'json',
        success: function(response) {
            if (response.status === 'success') {

                var res = response.message;
                console.log(res);
                var images = res.images;
                var varien = res.variant;
                document.getElementById('old-price').innerHTML = varien.base_price;
                document.getElementById('new-price').innerHTML = varien.sale_price;
                let discount = Math.round(((varien.base_price - varien.sale_price) * 100) / varien
                    .base_price);
                document.getElementById('product-sku').innerHTML = varien.varient_sku;
                document.getElementById('varient_id').innerText = varien.varient_id;
                document.getElementById('discount').innerText = discount + '% off';
                // Change main image to the first image of the selected color
                if (images && images.length > 0) {
                    document.getElementById('main-product-image').src =
                        '<?= base_url('uploads/products/')?>' + images[0];

                    // Update the thumbnail carousel
                    var thumbnailsContainer = document.querySelector('#carousel-G ');
                    thumbnailsContainer.classList.add('d-flex');
                    thumbnailsContainer.innerHTML = ''; // Clear current thumbnails

                    // Add new thumbnails for the selected color
                    images.forEach(function(image) {
                        imgg = '<?= base_url('uploads/products/')?>' + image
                        var thumbnailItem = document.createElement('div');
                        thumbnailItem.classList.add('item');
                        thumbnailItem.classList.add('w-25');
                        thumbnailItem.innerHTML = '<img src="' + imgg +
                            '" class="img-fluid product-thumbnail" data-image="' + image +
                            '" onclick="changeMainImage(\'' + image + '\')">';
                        thumbnailsContainer.appendChild(thumbnailItem);
                    });
                }
            } else {
                console.error('Error fetching color images:', response.message);
                // alert('Failed to load images.');
                document.getElementById('alertResponse').innerHTML = 'Failed to load images.';
                alertModal();
            }
        },
        error: function(xhr, status, error) {
            console.error('Something went wrong:', error);

        }
    });

}


$('#carousel-G').on('click', '.product-thumbnail', function() {
    var src = $(this).attr('src');
    $('#main-product-image').attr('src', src);
});

function checkDelivery() {
    var pincode = document.getElementById('pinCodeInp').value.trim();

    if (pincode === '') {
        document.getElementById('alertResponse').innerHTML = 'Please Enter Pincode';
        alertModal();

        return;
    }

    var pickup_postcode = '201301'; // Example pickup postcode
    var weight = 1; // Example weight in kg
    var cod = true; // Example COD boolean value

    $.ajax({
        url: '<?= base_url('checkDelivery')?>',
        type: 'POST', // Use POST for raw JSON data
        contentType: 'application/json', // Set the content type to JSON
        data: JSON.stringify({
            delivery_postcode: pincode,
            pickup_postcode: pickup_postcode,
            weight: weight,
            cod: cod
        }),
        success: function(response) {
            // Ensure response is a valid JSON object
            if (typeof response !== 'object') {
                response = JSON.parse(response);
            }

            if (response.status === 'success') {
                const upd = document.getElementById('deliveryUpdate');
                upd.style.display = 'flex';
                upd.style.color = 'green';
                upd.innerHTML = response.message;
            } else if (response.status === 'fail') {
                const upd = document.getElementById('deliveryUpdate');
                upd.style.display = 'flex';
                upd.style.color = 'red';
                upd.innerHTML = response.message;
            } else {
                //alert(response.message || 'An error occurred. Please try again.');
                const upd = document.getElementById('deliveryUpdate');
                upd.style.display = 'flex';
                upd.style.color = 'red';
                upd.innerHTML = 'The Pin Code is not Serviceable';
            }
        },
        error: function(xhr, status, error) {
            console.error('Error during request:', xhr.responseText);
        }
    });
}



function addToCart(jwellary_id) {
    let varient_id = document.getElementById('varient_id').innerHTML;
    let quantity = document.getElementById('product-quantity').value;
    //window.location.href = '<?= base_url('Web/User/User/addTocart/') ?>'+jwellary_id+'/'+varient_id+'/'+quantity;

    if (!<?= json_encode($this->session->userdata('userToken')) ?>) {

        window.location.href = '<?= base_url('Web/User/User/addTocart/') ?>' + jwellary_id + '/' + varient_id + '/' +
            quantity;
    } else {

        $.ajax({
            url: '<?= base_url('addToCart') ?>',
            type: 'POST',
            data: {
                varient_id: varient_id,
                jwellary_id: jwellary_id,
                quantity: quantity
            },
            success: function(response) {
                var res = JSON.parse(response);
                if (res.status === 'success') {
                    showsuccessModal();
                    // alert('Product added to Cart');
                } else if (res.status === 'unauthenticated') {
                    alert('Please login to add to Cart.');
                    window.location.href = '<?= base_url('Welcome/loginpage') ?>';
                } else {
                    alert(res.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error Adding to Cart:', error);
                alert('An error occurred while saving the details.');
            }
        });
    }


}



function addToWishlist(jwellary_id) {
    let varient_id = document.getElementById('varient_id').innerHTML;

    if (!<?= json_encode($this->session->userdata('userToken')) ?>) {

        window.location.href = '<?= base_url('Web/User/User/addWishlist/') ?>' + jwellary_id + '/' + varient_id;
    } else {

        $.ajax({
            url: '<?= base_url('addToWishlist') ?>',
            type: 'POST',
            data: {
                varient_id: varient_id,
                jwellary_id: jwellary_id,
            },
            success: function(response) {
                var res = JSON.parse(response);
                if (res.status === 'success') {
                    whishlist_showsuccessModal();
                } else if (res.status === 'unauthenticated') {
                    alert('Please login to add to Wishlist.');
                    window.location.href = '<?= base_url('Welcome/loginpage') ?>';
                } else {
                    alert(res.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error Adding to Cart:', error);
                alert('An error occurred while saving the details.');
            }
        });
    }


}




function goToCart() {
    window.location.href = '<?= base_url('Web/User/User/Cart')?>';
}

// Function to close the modal when clicking outside
function closeModalOutsideClick(event) {
    const modal = document.getElementById('successModalcart');
    const modalContent = modal.querySelector('.new-modal-content');

    // Check if the click was outside the modal content
    if (!modalContent.contains(event.target)) {
        closesuccessModal(); // Close the modal if the click is outside
    }
}

// Function to show the success modal
function showsuccessModal() {
    const modal = document.getElementById('successModalcart');
    modal.style.display = 'flex'; // Show the modal

    // Automatically close the modal after 3 seconds (3000ms)
    setTimeout(function() {
        closesuccessModal();
        window.location.reload();
    }, 3000);
    document.addEventListener('click', closeModalOutsideClick);
}

function whishlist_showsuccessModal() {
    const modal = document.getElementById('wishlist_successModalcart');
    modal.style.display = 'flex'; // Show the modal

    // Automatically close the modal after 3 seconds (3000ms)
    setTimeout(function() {
        closesuccessModal();
        window.location.reload();
    }, 3000);
    document.addEventListener('click', closeModalOutsideClick);
}

function closesuccessModal() {
    const modal = document.getElementById('successModalcart');
    modal.style.display = 'none';
    document.removeEventListener('click', closeModalOutsideClick);
}

// Function to close the error modal
function closeErrorModal() {
    const modal = document.getElementById('errorModal');
    modal.style.display = 'none'; // Hide the modal
}


    const mainImage = document.getElementById('main-product-image');
    const zoomPreview = document.getElementById('zoom-preview');
    const zoomedImg = document.getElementById('zoomed-img');
    const ZOOM_LEVEL = 2.5;

    function initZoom() {
        const zoomedWidth = mainImage.offsetWidth * ZOOM_LEVEL;
        const zoomedHeight = mainImage.offsetHeight * ZOOM_LEVEL;

        zoomedImg.style.width = zoomedWidth + 'px';
        zoomedImg.style.height = zoomedHeight + 'px';
    }

    function moveZoom(e) {
        const rect = mainImage.getBoundingClientRect();
        const xPos = (e.clientX - rect.left) / mainImage.offsetWidth;
        const yPos = (e.clientY - rect.top) / mainImage.offsetHeight;

        const zoomedX = xPos * (zoomedImg.offsetWidth - zoomPreview.offsetWidth);
        const zoomedY = yPos * (zoomedImg.offsetHeight - zoomPreview.offsetHeight);

        zoomedImg.style.left = `-${zoomedX}px`;
        zoomedImg.style.top = `-${zoomedY}px`;
    }
	    function changeImage(newSrc) {
        mainImage.src = newSrc;
        zoomedImg.src = newSrc;
        initZoom();
    }



//     function filterbycolor(productId, variantId) {
//         const variants = <?= json_encode($result['variants']) ?>;
//         const selectedVariant = variants.find(variant => variant.varient_id === variantId);
        
//         if (selectedVariant && selectedVariant.images[0]) {
//             changeImage(selectedVariant.images[0]);
//         }
//     }

    mainImage.addEventListener('mouseenter', function() {
        initZoom();
        zoomPreview.style.display = 'block';
    });

    mainImage.addEventListener('mousemove', moveZoom);

    mainImage.addEventListener('mouseleave', function() {
        zoomPreview.style.display = 'none';
    });

    document.querySelectorAll('.product-thumbnail').forEach(thumb => {
        thumb.addEventListener('click', function() {
            changeImage(this.src);
        });
    });

    window.addEventListener('resize', initZoom);
    initZoom();

    // Expose filterbycolor globally
    window.filterbycolor = filterbycolor;

</script>


</body>

</html>