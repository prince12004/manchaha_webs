<!-- --------------nav-section-end------------ -->
<style>
@media (max-width: 768px) {
    .header-main {
        box-shadow: none !important;
    }
}

.pagination-container {
    display: flex;
    justify-content: end;
}

.pagination {
    gap: 2px;
}
.pagination button {
    padding: 6px 15px;
    font-size: 15px;
    border-radius: 30px;
    border: 1px solid #ccc;
}
.pagination li {
    padding: 6px 15px;
    font-size: 12px;
    border-radius: 30px;
    border: 1px solid #ccc;
	background-color: #FFFFFF;
}

.pagination li:hover {
    background-color: #66b2ff;
    color: #FFFFFF !important;
}

.pagination li a:hover {
    color: #FFFFFF;
}

.modal {
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

.modal-content {
    background-color: white;
    padding: 30px;
    border-radius: 10px;
    text-align: center;
    max-width: 500px;
    width: 100%;
    margin: 20vh auto;
    position: relative
}

.closebutton {
    width: 45px;
    height: 45px;
    border-radius: 50%;
    background-color: #FFF;
    display: flex;
    justify-content: center;
    align-items: center;
    position: absolute;
    top: 10px;
    right: 10px;
    padding: 8px;
    border: none;
}

.closebutton span {
    color: #2563eb;
    font-size: 40px;
    font-weight: 600;

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

/* .no-scroll {
    overflow: hidden;
} */

.close-btn:hover {
    background-color: #2563eb;
}

button:disabled {
    opacity: 0.6;
    cursor: not-allowed;
}

@media (max-width: 768px) {
    .model {
        margin: 10px;
    }
    /* .no-scroll {
        overflow: auto !important;
    } */
}
</style>

</header>

<div class="filter-toggle-btn d-flex justify-content-end w-100">
    <button id="cardlistfilterToggleBtn" class="btn "><span class="material-symbols-outlined me-3">
            tune
        </span> <strong>Filter</strong>
    </button>
</div>

<div class="cardlist-container d-flex am">
    <div class="filter-section-wrapper">
        <div class="filter-section">
            <div class="overflow-auto">
                <div class="side-filter-section filter-category">
                    <h2 class="filter-heading">Categories:</h2>
                    <div class="filter-list">
                        <?php foreach ($result['subcategories'] as $subcategory) { 
                        $id = 'subcategory_' . $subcategory['CategoryID'];
                        ?>
                        <li>
                            <input type="radio" id="<?= $id ?>"
                                onclick="filterData('<?= $subcategory['CategoryID'] ?>')">
                            <label for="<?= $id ?>"><?= $subcategory['CategoryName'] ?></label>
                        </li>
                        <?php } ?>
                    </div>
                </div>
                <!-- Price range filter -->
                <!--  <div class="filter-price side-filter-section">
                        <h2 class="filter-heading">Price:</h2>                  
                    <div class="price-filter">
                        <input type="range" min="0" max="1000" value="500" class="slider" id="priceRange">
                        <p class="range-price">Price: ₹<span id="priceValue">500</span></p>
                    </div>
                    </div>
                    <div class="filter-size side-filter-section">
                        <h2 class="filter-heading">Size: </h2>
                        <div class="size-cont">
                            <div class="size-button">
                                <div class=" d-flex gap-2 flex-wrap">
                                    <span class="size">
                                        <input type="radio" name="size" id="size-30" class="size-radio" value="30" hidden>
                                        <label for="size-30" class="btn btn-outline-secondary size-label">XS</label>
                                    </span>
                                    <span class="size">
                                        <input type="radio" name="size" id="size-32" class="size-radio"   value="32" hidden>
                                        <label for="size-32" class="btn btn-outline-secondary size-label">S</label>
                                    </span>
                                    <span class="size">
                                        <input type="radio" name="size" id="size-32" class="size-radio" value="32" hidden>
                                        <label for="size-32" class="btn btn-outline-secondary size-label">M</label>
                                    </span>
                                    <span class="size">
                                        <input type="radio" name="size" id="size-34" class="size-radio" value="34" hidden>
                                        <label for="size-34" class="btn btn-outline-secondary size-label">L</label>
                                    </span>
                                    <span class="size">
                                        <input type="radio" name="size" id="size-36" class="size-radio" value="36" hidden>
                                        <label for="size-36" class="btn btn-outline-secondary size-label">XL</label>
                                    </span>
                                    <span class="size">
                                        <input type="radio" name="size" id="size-38" class="size-radio" value="38" hidden>
                                        <label for="size-36" class="btn btn-outline-secondary size-label">XXL</label>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>-->

                <!-- Size filters -->
                <!-- <div class="side-filter-section filter-color">
                        <h2 class="filter-heading">Color: </h2>
                        <div class=" color-cont ">
                            <div class="d-flex gap-1 flex-wrap">
                                <div class="color">
                                    <input type="radio" name="color" id="color-red" class="color-radio" value="red" hidden checked>
                                    <label for="color-red" class="color-dot me-2 red active" data-image="images/pop_pr1.png"></label>
                                </div>
        
                                <div class="color">
                                    <input type="radio" name="color" id="color-blue" class="color-radio" value="blue" hidden>
                                    <label for="color-blue" class="color-dot me-2 blue" data-image="images/pop_pr2.png"></label>
                                </div>
                                <span class="color">
                                    <input type="radio" name="color" id="color-green" class="color-radio" value="green" hidden>
                                    <label for="color-green" class="color-dot me-2 green" data-image="images/pop_pr3.png"></label>
                                </span>
                            
                            </div> 
                        </div>
                    </div>  -->
            </div>
        </div>
    </div>
    <div class="products-section mt-3">
        <h2 class="products-card-list-h2"><?= $result['tittle'] ?? 'Jewellery'; ?>
            <span class="text-muted" id="product-quantity">(<?= $result['meta']['total']?>)</span>
        </h2>
        <div class="products-card-list d-flex justify-content-start p-3 flex-wrap">
            <!-- Product cards -->
            <?php 

            // print_r($result['products']);
            foreach($result['products'] as $res){ ?>
            <div class="item Card-A">
                <div class="product-card">
                    <a class="anchor-redirect-tag"
                        href="<?= base_url('/Welcome/details/').$res['id'].'/'.$res['jwellary_id'] ?>">
                        <div class="product-image">
                            <?php if(isset($res['thumbnail']) && !empty($res['thumbnail'])){?>
                            <img src="<?= base_url('/uploads/products/').$res['thumbnail'] ?>" alt="Product Image">
                            <?php }else{?>
                            <img src="<?= base_url('/uploads/products/').$res['image'] ?>" alt="Product Image">
                            <?php }?>
                        </div>
                        <div class="product-info">
                            <p style="display: none; position:absolute;"><?= $res['subcategory_id']?></p>
                            <h4 class="product-title">
                                <?= strlen(($res['jwellary_name'])) > 40 ? substr($res['jwellary_name'], 0, strpos($res['jwellary_name'], ' ', 30)) . '...' : $res['jwellary_name']; ?>
                            </h4>
                            <p class="product-description">
                                <?= strlen(($res['jwellary_description'])) > 70 ? substr($res['jwellary_description'], 0, strpos($res['jwellary_description'], ' ', 80)) . '...' : $res['jwellary_description']; ?>
                            </p>
                            <!-- <div class="product-rating">
                                 <div class="product-rating">
                                <span class="stars">&#9733;&#9733;&#9733;&#9733;&#9733;</span>
                                <span class="reviews"><?= round(rand(1000, 14899)/100,2)?>k</span>
                                </div> -->
                    </a>
                    <div class="product-pricing">




                      <div>
						    <span class="new-price"><?= $res['sale_price'] ?>₹</span>
                        <span class="old-price"><?= $res['base_price'] ?>₹</span>
                        <?php $discount = ($res['base_price']-$res['sale_price'])*100/$res['base_price'];     ?>
                        <span class="product-title"><?= round($discount) ?>% Off</span>
						</div>
						<div>
<?php if($res['is_cart']=='0') { ?>
                            <button class="add-to-cart-btn" onclick="addtocart('<?= $res['varient_id']?>','<?= $res['id']?>')">
                                    <span class="material-symbols-outlined">
                                        add_shopping_cart
                                    </span>ADD TO CART</a>
                                </button>
    <?php } else {?>
                            <button class="goto-carts" onclick="goToCart()">
                                    <span class="material-symbols-outlined">
                                        add_shopping_cart
                                    </span>GO TO CART</a>
                                </button>
                                
                            <?php }?>
						</div>
                    </div>
                    <div class="wishlist-btn">
                        <span id="heart-icon" onclick="addToWishlist('<?= $res['varient_id']?>','<?= $res['id']?>')"
                            class="heart-icon">&#9829;</span>
                        <!-- <input type="hidden" id="heart-input" name="heartStatus" value="0"> -->
                    </div>
                </div>

            </div>
        </div>
        <?php } ?>
        <!-- Add more product cards as needed -->
    </div>
    <?php if (!empty($result['pagination'])): ?>
    <div class="pagination-container">
        <?= $result['pagination']; ?>
    </div>
    <?php endif; ?>
</div>
</div>





<!-- =============================newsLetter-section====================== -->

<?php $this->load->view('User/footer') ?>




<!-- ====================Deals of the day Ends============================ -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

<script>

    
function goToCart() {
    window.location.href = '<?= base_url('Web/User/User/Cart')?>';
}

/*    $(document).ready(function(){
        $('.heart-icon').click(function(event){
            event.preventDefault(); // Prevent any default behavior
            $(this).toggleClass('active');
            
            // Get the associated hidden input using the closest parent
            let input = $(this).closest('.card').find('.heart-input');
            if($(this).hasClass('active')) {
                input.val('1'); // Active state
            } else {
                input.val('0'); // Inactive state
            }
        });
    }); */


    document.addEventListener("DOMContentLoaded", function() {
    const sideFilter = document.querySelector(".filter-section");
    const footerSection = document.getElementById("bottom-section");
    const body = document.body;

    // Check if screen width is mobile or desktop
    const isMobile = window.innerWidth <= 768;

    // Function to toggle scroll on mobile
    function toggleScroll(disable) {
        if (isMobile) {
            if (disable) {
                body.classList.add("no-scroll"); // Disable scrolling on mobile
            } else {
                body.classList.remove("no-scroll"); // Enable scrolling on mobile
            }
        }
    }

    // IntersectionObserver to detect when the newsletter section enters/exits the viewport
    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                // If the screen is not mobile, manage hiding/showing the filter and scrolling
                if (!isMobile) {
                    if (entry.isIntersecting) {
                        // When the newsletter section is in the viewport, hide the filter
                        sideFilter.classList.add("hidden");
                        body.classList.remove("no-scroll"); // Allow scrolling
                    } else {
                        // When the newsletter section is not in the viewport, show the filter
                        sideFilter.classList.remove("hidden");
                        body.classList.add("no-scroll"); // Disable scrolling
                    }
                }
            });
        }, {
            threshold: 0.05,
        }
    );

    // Observe the footer section
    observer.observe(footerSection);

    // Mobile - If the filter is manually opened, disable scrolling on the page
    sideFilter.addEventListener("mouseenter", function() {
        toggleScroll(true); // Disable scrolling when filter is open
    });

    // Mobile - If the filter is manually closed, enable scrolling again
    sideFilter.addEventListener("mouseleave", function() {
        toggleScroll(false); // Enable scrolling when filter is closed
    });
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
    $(this).toggleClass('active');
    $(this).prev('input[type="radio"]').prop('checked', true);
});



$(document).ready(function() {
    // Toggle filter section
    $('#cardlistfilterToggleBtn').on('click', function() {
        $('.filter-section-wrapper').toggleClass('slide-show');
        $('.product-section').toggleClass('slide-show');
    });

    // Update price value on range change
    $('#priceRange').on('input', function() {
        $('#priceValue').text($(this).val());
    });

    // Make checkbox and label both clickable
    $('.filter-list label').on('click', function() {
        const checkboxId = $(this).attr('for');
        $('#' + checkboxId).trigger('click');
    });
});



$(window).on("scroll", function() {
    const scrollPosition = $(window).scrollTop();
    const filterSection = $(".filter-section-wrapper");
    const screenWidth = $(window).width(); // Get the current screen width

    // Check if the screen width is greater than 768px (adjust for your desktop breakpoint)
    if (screenWidth > 768) {
        if (scrollPosition > 50) {
            filterSection.css("top", "70px");
        } else {
            filterSection.css("top", "120px");
        }
    } else {
        // Reset the top property for mobile resolutions if necessary
        filterSection.css("top", "100px");
    }
});


function addToWishlist(varient_id, jwellary_id) {
    if (!<?= json_encode($this->session->userdata('userToken')) ?>) {
        window.location.href = '<?= base_url('Welcome/loginpage') ?>';
    } else {
        $.ajax({
            url: '<?= base_url('addToWishlist') ?>',
            type: 'POST',
            data: {
                varient_id: varient_id,
                jwellary_id: jwellary_id
            },
            success: function(response) {
                var res = JSON.parse(response);
                if (res.status === 'success') {
                    location.reload();
                    // alert('Product added to wishlist');
                } else if (res.status === 'unauthenticated') {
                    alert('Please login to add to wishlist.');
                    window.location.href = '<?= base_url('Welcome/loginpage') ?>';
                } else {
                    alert(res.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error Adding to Wishlist:', error);
                alert('An error occurred while saving the details.');
            }
        });
    }
}




// function filterData(id){
//     console.log(id);
// }



function filterData(filterId) {
    window.location.href = '<?= base_url('welcome/cardlist/')?>' + filterId;

}

// Attach event listeners to the filter checkboxes
// document.querySelectorAll('.filter-list input[type="checkbox"]').forEach(checkbox => {
//     checkbox.addEventListener('change', function () {
//         filterData();
//     });
// });


function addtocart(varientid, productid) {


    if (!<?= json_encode($this->session->userdata('userToken')) ?>) {
        window.location.href = '<?= base_url('Welcome/loginpage') ?>';
    } else {
        $.ajax({
            url: '<?= base_url('addToCart') ?>',
            type: 'POST',
            data: {
                quantity: 1,
                varient_id: varientid,
                jwellary_id: productid
            },
            success: function(response) {
                var res = JSON.parse(response);
                if (res.status === 'success') {
                    // showsuccessModal();
                   location.reload();
                    // alert('Product added to Cart');
                } else if (res.status === 'unauthenticated') {
                    alert('Please login to add to Cart.');
                    window.location.href = '<?= base_url('Welcome/loginpage') ?>';
                } else {
                    alert(res.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error Adding to Wishlist:', error);
                alert('An error occurred while saving the details.');
            }
        });
    }


}



// Function to close the modal when clicking outside
function closeModalOutsideClick(event) {
    const modal = document.getElementById('successModal');
    const modalContent = modal.querySelector('.modal-content');

    // Check if the click was outside the modal content
    if (!modalContent.contains(event.target)) {
        closesuccessModal(); // Close the modal if the click is outside
    }
}

// Function to show the success modal
function showsuccessModal() {
    const modal = document.getElementById('successModal');
    modal.style.display = 'block'; // Show the modal

    // Automatically close the modal after 5 seconds (5000ms)
    setTimeout(function() {
        closesuccessModal(); // Close the modal after 5 seconds
    }, 5000);

    // Add event listener to close the modal if the user clicks outside of it
    document.addEventListener('click', closeModalOutsideClick);
}

// Function to close the modal
function closesuccessModal() {
    const modal = document.getElementById('successModal');
    modal.style.display = 'none'; // Hide the modal

    // Remove the event listener to stop listening for clicks outside when the modal is closed
    document.removeEventListener('click', closeModalOutsideClick);
}
</script>

</body>

</html>