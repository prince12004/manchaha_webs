<?php $this->load->view('User/header') ?>
<!-- --------------nav-section-end------------ -->

</header>


<!-- ==================HERO SECTION======================= -->

<div class="herosection">
    <div class="carousel-container">
        <div id="carousel" class="owl-carousel owl-theme">
            <?php foreach ($data['banner'] as $banner): ?>
            <div class="carousel-item">

                <img src="<?= base_url('uploads/') . $banner['image'] ?>" alt="Banner Image">


                <!--       <div class="right">
                            <div class="carousel-text">
                                <h2><span class="bold">Discover What You Love at Mnnchaha</span><span class="bold"></span> </h2>
                                <p>Shop top-quality products, unbeatable prices, and a seamless shopping experience.</p>
                            </div>
                        </div>-->
            </div>
            <?php endforeach; ?>
            <!--                   <div class="carousel-item">
                        <img src="<?= base_url('/assets/catImage/Mask.png') ?>" alt="Image 1">
                        <div class="right">
                            <div class="carousel-text">
                                <h2><span class="bold">Discover What You Love at Mnnchaha</span><span class="bold"></span> </h2>
                                <p>Shop top-quality products, unbeatable prices, and a seamless shopping experience.</p>
                            </div>
                        </div>
                    </div>-->

            <!-- Additional carousel items can be added here -->
        </div>

        <div class="button-pair flex-column d-flex">
            <!--                     <a href="" class=" btn btn-blue">SHOP NOW<span class="material-symbols-outlined ms-2">
                        arrow_forward
                        </span>
                    </a>>-->
            <h3 class="get-started-text mt-2" style="color:#ffffff;">GET STARTED WITH THE MOBILE APP!</h3>
            <div class="d-flex mobile-button align-items-center gap-1 mt-1">
                <a href="" class="btn btn-dark"><img src="<?= base_url('/uploads/1733076443_729.png') ?>" alt=""></a>
                <a href="" class="btn btn-ios"><img src="<?= base_url('/uploads/1733076311_651.png') ?>" alt=""></a>
            </div>
        </div </div>
    </div>


    <!-- ===============herosection -ends============= -->

    <!-- ============================Shop-by-category-Start===================== -->
    <section class="shop-by-categories am">
        <h2 class="heading-A">Shop By Categories</h2>
        <img src="<?= base_url('/assets/images/heading-line.png') ?>" alt="">
        <p class="para-A"></p>

        <!-- Carousel container should be outside the loop -->
        <div id="carousel-B" class="owl-carousel owl-theme">
            <?php foreach ($data['category'] as $category) { ?>
            <div class="item">
                <a href="<?= base_url('welcome/cardlist/').$category['CategoryID']; ?>">
                    <div class="category-card">
                        <div class="image">
                            <img src="<?= base_url('uploads/').$category['categoryImage']?>"
                                alt="<?= $category['CategoryName'] ?>">
                        </div>
                        <p class="card-title-text"><?= $category['CategoryName'] ?></p>
                    </div>
                </a>
            </div>
            <?php } ?>
        </div>
    </section>

    <!-- ============================Shop-by-category-ends===================== -->
    <!-- =========================best-value-starts============================= -->
    <section class="best-value am">
        <h2 class="heading-A">Best Value</h2>
        <img class="heading-line" src="<?= base_url('/assets/images/heading-line.png') ?>" alt="">
        <p class="para-A"></p>
        <div id="carousel-C" class="owl-carousel owl-theme">
            <?php foreach ($data['offer'] as $offer) { ?>

            <div class="item">
                <div class="best-value-category">
                    <div class="image"><img src="<?= base_url('uploads/').$offer['image'] ?>" alt="bestValue 1"></div>
                    <div class="hot-deal-tag">
                        <h4 class="text-green"><?= $offer['offer_name'] ?></h4>
                        <p><?= $offer['offer_description'] ?></p>
                    </div>
                    <a href="<?= base_url('welcome/cardlist/7') ?>">
                        <button class="btn btn-success">View Offer</button>
                    </a>
                </div>
            </div>

            <?php } ?>
        </div>
    </section>
    <!-- =========================best-value-ends============================= -->


    <!-- =====================Popular-Product-starts=========================== -->
    <!--<section class="popular-products">
       <div class="content am">
            <div class="heading-menu d-flex align-itms-center justify-content-between">
                <div class="left-heading">
                    <h2 class="heading-A">Popular Products</h2>
                    <img src="<?= base_url('/assets/images/heading-line.png') ?>" alt="">
                    <p class="para-A"></p>
                </div>
                <div class="right-menu">
                    <ul class="navlink-nav-menu">
                        <li class="active-nav"><a href="">All</a></li>
                        <li><a href="">Boy Fashion</a></li>
                        <li><a href="">Girl Fashion</a></li>
                        <li><a href="">Footwear</a></li>
                        <li><a href="">Toys</a></li>
                        <li><a href="">Diapering</a></li>
                        <li><a href="">Gear</a></li>
                        <li><a href="">Feeding</a></li>
                    </ul>
                </div>
            </div>
            <div class="carousel-d-container">
                <div id="carousel-D" class="owl-carousel owl-theme">
                <?php foreach ($data['populars'] as $popular) { ?>
                        <div class="item Card-A">
                            <div class="product-card">
                                <div class="badge-C"><?= $popular['basis'] ?></div>
                                <div class="product-image">
                                  <img src="<?= base_url('uploads/products/').$popular['image']?>" alt="Product Image">
                                  <div class="wishlist-btn">
                                    <span id="heart-icon" class="heart-icon">&#9829;</span>
                                    <input type="hidden" id="heart-input" name="heartStatus" value="0">
                                </div>
                                </div>
                                <a href="">
                                    <div class="product-info">
                                        <h4 class="product-title"><?= $popular['ProductName'] ?></h4>
                                        <p class="product-description">
                                          <?= $popular['Description'] ?>
                                        </p>
                                        <div class="product-rating">
                                          <span class="stars">&#9733;&#9733;&#9733;&#9733;&#9733;</span>
                                          <span class="reviews">14.5k</span>
                                        </div>
                                        <div class="product-pricing">
                                          <span class="new-price"><?= $popular['offer_price'] ?>₹</span>
                                          <span class="old-price"><?= $popular['offer_price'] ?>₹</span>
                                          <button class="add-to-cart-btn"><span class="material-symbols-outlined">
                                              shopping_cart
                                              </span>Add Now</button>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <?php } ?>
    
                </div>
            </div>
       </div>
    </section>-->
    <!-- =====================Popular-Product-ends=========================== -->

    <!-- ======================fashion-section-starts================== -->

    <section class="fashion-section am">
        <div class="heading text-center">
            <h2 class="heading-A">Featured Categories</h2>
            <img src="<?= base_url('/assets/images/heading-line.png') ?>" alt="">
            <p class="para-A">Our most trending Categories based on sales</p>
        </div>
        <div class="fashion-content">
            <div class="left">
                <div class="card fashion-man"
                    style="background-image: url('<?= base_url('uploads/1733064779_517.png') ?>')">
                    <div class="content" style="top: 20vh;">
                        <h2 class="text-black">Designer Earrings</h2>
                        <!--   <p>From $999.99</p> -->
                        <a href="<?= base_url('welcome/cardlist/7') ?>" class="shop-btn">Shop Now</a>
                    </div>
                </div>
            </div>
            <div class="right">
                <div class="card woman-fashion"
                    style="background-image: url('<?= base_url('uploads/1733064809_790.png') ?>')">
                    <div class="content" style="top: 10vh;">
                        <h2 class="text-black">Trending jewellery</h2>
                        <!--     <p>From $999.99</p> -->
                        <a href="<?= base_url('welcome/cardlist/7') ?>" class="shop-btn">Shop Now</a>
                    </div>
                </div>
                <div class="d-flex justify-content-between cards-kids-watch">
                    <div class="card love-kids"
                        style="background-image: url('<?= base_url('uploads/1733064825_686.png') ?>')">
                        <div class="content">
                            <h2>Necklace</h2>
                            <p>New Collection</p>
                            <a href="<?= base_url('welcome/cardlist/7') ?>" class="shop-btn">Shop Now</a>
                        </div>
                    </div>
                    <div class="card watch"
                        style="background-image: url('<?= base_url('uploads/1733064840_243.png') ?>')">
                        <div class="content">
                            <h2>Necklace</h2>
                            <p>New Collection</p>
                            <a href="<?= base_url('welcome/cardlist/7') ?>" class="shop-btn">Shop Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ======================fashion-section-ends================== -->


    <!-- ====================latest-popular-product-Starts============================ -->

    <!--   <section class="latest-popular am">
        <div class="heading-menu d-flex align-itms-center justify-content-between">
            <div class="left-heading">
                <h2 class="heading-A">Latest Popular Products</h2>
                <img src="<?= base_url('/assets/images/heading-line.png') ?>" alt="">
                <p class="para-A">Lorem Ipsum is simply dummy text of the printing</p>
            </div>
            <div class="right-menu">
                <button class="btn btn-primary"> View All <span class="material-symbols-outlined">
                    arrow_forward
                    </span></button>
            </div>
        </div>
        <div class="latest-pop-card-container d-flex flex-wrap ">
                <div class="item Card-A">
                    <div class="product-card">
                        <div class="product-image">
                          <img src="<?= base_url('/assets/images/latest_pr1.png') ?>" alt="Product Image">
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
                                  <span class="new-price">400.50₹</span>
                                  <span class="old-price">520.50₹</span>
                                  <button class="add-to-cart-btn"><span class="material-symbols-outlined">
                                      shopping_cart
                                      </span>Add Now</button>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="item Card-A">
                    <div class="product-card">
                        <div class="product-image">
                            <img src="<?= base_url('/assets/images/latest_pr2.png') ?>" alt="Product Image">
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
                                  <span class="new-price">400.50₹</span>
                                  <span class="old-price">520.50₹</span>
                                  <button class="add-to-cart-btn"><span class="material-symbols-outlined">
                                      shopping_cart
                                      </span>Add Now</button>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="item Card-A">
                    <div class="product-card">
                        <div class="product-image">
                            <img src="<?= base_url('/assets/images/latest_pr3.png') ?>" alt="Product Image">
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
                                <span class="new-price">400.50₹</span>
                                <span class="old-price">520.50₹</span>
                                <button class="add-to-cart-btn"><span class="material-symbols-outlined">
                                    shopping_cart
                                    </span>Add Now</button>
                              </div>
                            </div>
                        </a>
                      </div>
                </div>
            
                <div class="item Card-A">
                    <div class="product-card">
                        <div class="product-image">
                            <img src="<?= base_url('/assets/images/latest_pr4.png') ?>" alt="Product Image">
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
                                  <span class="new-price">400.50₹</span>
                                  <span class="old-price">520.50₹</span>
                                  <button class="add-to-cart-btn"><span class="material-symbols-outlined">
                                      shopping_cart
                                      </span>Add Now</button>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="item Card-A">
                    <div class="product-card">
                        <div class="product-image">
                            <img src="<?= base_url('/assets/images/latest_pr5.png') ?>" alt="Product Image">
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
                                  <span class="new-price">400.50₹</span>
                                  <span class="old-price">520.50₹</span>
                                  <button class="add-to-cart-btn"><span class="material-symbols-outlined">
                                      shopping_cart
                                      </span>Add Now</button>
                                </div>
                            </div>

                        </a>
                      </div>
                </div> 
                <div class="item Card-A">
                    <div class="product-card">
                        <div class="product-image">
                            <img src="<?= base_url('/assets/images/latest_pr6.png') ?>" alt="Product Image">
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
                                  <span class="new-price">400.50₹</span>
                                  <span class="old-price">520.50₹</span>
                                  <button class="add-to-cart-btn"><span class="material-symbols-outlined">
                                      shopping_cart
                                      </span>Add Now</button>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="item Card-A">
                    <div class="product-card">
                        <div class="product-image">
                            <img src="<?= base_url('/assets/images/latest_pr7.png')?>" alt="Product Image">
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
                                  <span class="new-price">400.50₹</span>
                                  <span class="old-price">520.50₹</span>
                                  <button class="add-to-cart-btn"><span class="material-symbols-outlined">
                                      shopping_cart
                                      </span>Add Now</button>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="item Card-A">
                    <div class="product-card">
                        <div class="product-image">
                            <img src="<?= base_url('/assets/images/latest_pr8.png') ?>" alt="Product Image">
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
                                  <span class="new-price">400.50₹</span>
                                  <span class="old-price">520.50₹</span>
                                  <button class="add-to-cart-btn"><span class="material-symbols-outlined">
                                      shopping_cart
                                      </span>Add Now</button>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>   
        </div>

    </section>-->
    <!-- ====================latest-popular-product-ends============================ -->

    <!-- ====================Deals of the day============================ -->
    <!--   <section class="deals-of-day am">
         <div class="heading-menu d-flex align-itms-center justify-content-between">
            <div class="left-heading">
                <h2 class="heading-A">Deals Of The Day</h2>
                <img src="<?= base_url('/assets/images/heading-line.png') ?>" alt="">
                <p class="para-A">Lorem Ipsum is simply dummy text of the printing</p>
            </div>
            <div class="right-menu">
                <button class="btn btn-primary"> View All <span class="material-symbols-outlined">
                    arrow_forward
                    </span>
                </button>
            </div>
        </div>
        
        <div class="deals-card-container d-flex flex-wrap">
        <?php foreach ($data['dotd'] as $deals) { ?>
            <div class="item Card-A">
                <div class="product-card card">
                    <div class="first d-flex">
                        <div class="product-image">
                            <img src="<?= base_url('/assets/images/deals-day-1.png') ?>" alt="Product Image">
                            <div class="discount-badge">20%</div>
                            <div class="wishlist-btn">
                                <span id="heart-icon" class="heart-icon">&#9829;</span>
                                <input type="hidden" id="heart-input" name="heartStatus" value="0">
                            </div>
                        </div>
                        <div class="product-info">
                          <h4 class="product-title"><?= $deals['ProductName'] ?></h4>
                          <p class="product-description">
                            Lorem Ipsum is simply dummy text of the printing
                          </p>
                          <div class="product-rating">
                            <span class="stars">&#9733;&#9733;&#9733;&#9733;&#9733;</span>
                            <span class="reviews">14.5k</span>
                          </div>
                          <div class="product-pricing">
                            <span class="new-price">400.50₹</span>
                            <span class="old-price">520.50₹</span>
                        </div>
                        <button class="add-to-cart-btn d-flex justify-content-between px-3">Add Now<span class="material-symbols-outlined">
                            shopping_cart
                            </span>
                        </button>
                       </div>
                    </div>
                   <div class="second d-flex justify-content-center align-items-center">
                    <div class="timer mt-1">
                        <div class="d-flex align-items-center">
                            <div class="time-box">72</div>
                            <div class="time-box">05</div>
                            <div class="time-box">45</div>
                            <div class="mx-1">:</div>
                            <div class="time-box">08</div>
                        </div>
                        <div class="time-label">
                            Remains until the end of the offer
                        </div>
                    </div>
                   </div>
                </div>
            </div>
            
            
           <?php } ?>

        </div>
    </section> -->

    <!-- ===================testimonial-carousel starts========================= -->

    <section class="testimonial-section">
        <div class="heading-para">
            <h2 class="heading-A">What our <br> Customers Says</h2>
            <img src="<?= base_url('/assets/images/heading-line.png') ?>" alt="">
            <h4 class="">Experience Excellence, Every Time</h4>
            <p>
                Our customers' feedback speaks volumes about the quality and service we offer. Here are a couple of
                reviews that highlight our commitment to delivering the best experience
            </p>
        </div>
        <div class="testimonial-carousel">
            <div id="carousel-E" class="owl-carousel owl-theme">
                <div class="item">
                    <div class="card">
                        <div class="image-rating d-flex align-items-center justify-content-start w-100">
                            <img src="<?= base_url('/assets/images/testi_2.png') ?>" alt="User Image">
                            <div class="name-rating">
                                <div class="title">Shivani</div>
                                <!--  <div class="subtitle">Simply dummy text</div> -->
                                <div class="stars">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
                            </div>
                        </div>
                        <div class="description">
                            Great shopping experience! Fast shipping, easy returns, and excellent customer service.
                        </div>
                        <img class="quote-icon" src="<?= base_url('/assets/images/testi-comma.png') ?>"
                            alt="Quote Icon">
                    </div>
                </div>
                <div class="item">
                    <div class="card">
                        <div class="image-rating d-flex align-items-center justify-content-start w-100">
                            <img src="<?= base_url('/assets/images/testi_1.png') ?>" alt="User Image">
                            <div class="name-rating">
                                <div class="title">Himani </div>
                                <!--    <div class="subtitle">Simply dummy text</div> -->
                                <div class="stars">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
                            </div>
                        </div>
                        <div class="description">
                            Good selection of products, but shipping took a little longer than expected. Overall
                            satisfied.
                        </div>
                        <img class="quote-icon" src="<?= base_url('/assets/images/testi-comma.png') ?>"
                            alt="Quote Icon">
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- =============================news-letter-starts========================= -->
    <?php $this->load->view('User/footer') ?>




    <!-- ====================Deals of the day Ends============================ -->
    <script src="<?= base_url('assets/javascript/common.js')?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

    <script>
    /* $(document).ready(function() {
                $('.main-nav-tab li a').on('click', function(event) {
                    $('.main-nav-tab li ').removeClass('active-main-nav');
                    $(this).parent().addClass('active-main-nav');
                });
            }); */

    $(document).ready(function() {
        $('.heart-icon').click(function(event) {
            event.preventDefault(); // Prevent any default behavior
            $(this).toggleClass('active');

            // Get the associated hidden input using the closest parent
            let input = $(this).closest('.card').find('.heart-input');
            if ($(this).hasClass('active')) {
                input.val('1'); // Active state
            } else {
                input.val('0'); // Inactive state
            }
        });
    });







    $(document).ready(function() {
        $("#carousel").owlCarousel({
            items: 1,
            nav: true,
            navText: ["<", ">"],
            dots: false,
            autoplay: false,
            autoplayTimeout: 5000,
            loop: true
        });
    });


    $(document).ready(function() {
        $('#carousel-B').owlCarousel({
            loop: true,
            margin: 10,
            nav: true,
            navText: ["<", ">"],
            autoplay: true,
            autoplayTimeout: 6000,
            responsive: {
                0: {
                    items: 3
                },
                600: {
                    items: 5
                },
                1000: {
                    items: 8
                }
            }
        });
    });
    $(document).ready(function() {
        $('#carousel-C').owlCarousel({
            loop: true,
            margin: 10,
            nav: true,
            navText: ["<", ">"],
            autoplay: true,
            autoplayTimeout: 6000,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 1
                },
                1000: {
                    items: 3
                }
            }
        });
    });
    $(document).ready(function() {
        $('#carousel-D').owlCarousel({
            loop: true,
            margin: 25,
            nav: true,
            dots: false,
            navText: ["<", ">"],
            autoplay: false,
            autoplayTimeout: 9000,
            responsive: {
                0: {
                    items: 2
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 5
                }
            }
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
        $('.navlink-nav-menu li a').on('click', function(event) {
            event.preventDefault();
            $('.navlink-nav-menu li ').removeClass('active-nav');
            $(this).parent().addClass('active-nav');
        });
    });
    </script>

    </body>

    </html>