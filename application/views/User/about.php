<!-- --------------nav-section-end------------ -->

</header>
<div class="main-page-section">
    <div class="main-content am">
        <h1><?= ucfirst($result[0]['page_name']) ?> Us</h1>
        <h3><a href="<?= base_url('/')?>">Home</a> | <?= $result[0]['page_name'] ?> Us</h3>
    </div>
</div>
<div class="about-content-container ">
    <div class="main-container am">
        <div class="headings_contents mb-5">

            <h2 class="heading-A"><?= $result[0]['page_tittle'] ?></h2>
            <img src="<?= base_url('/assets/images/heading-line.png') ?>" alt="">
            <p class="para-A"><?= ucfirst($result[0]['page_heading']) ?></p>

            <p><?= $result[0]['page_description'] ?></p>

            <div class="image_section">
                <img src="<?= base_url('/assets/images/about1.png') ?>" alt="" />
                <img src="<?= base_url('/assets/images/about2.png') ?>" alt="" />
            </div>
            <p>
            </p>
        </div>
        <div class="container-b am">
            <div class="cards-container">
                <div class="card">
                    <img src="<?= base_url('/assets/images/image1.png') ?>" alt="Icon 1" />
                    <h3>MISSION</h3>
                    <p>
                        To provide exceptional, high-quality products at competitive prices, delivering an unmatched
                        shopping experience. We prioritize customer satisfaction, ensuring every interaction is
                        seamless, efficient, and tailored to your needs
                    </p>
                </div>
                <div class="card">
                    <img src="<?= base_url('/assets/images/image2.png') ?>" alt="Icon 2" />
                    <h3>VISION</h3>
                    <p>
                        To become the most trusted eCommerce platform, leading in innovation, customer experience, and
                        sustainable growth. We aim to create long-lasting relationships by consistently exceeding
                        expectations and offering unmatched value.
                    </p>
                </div>
                <div class="card">
                    <img src="<?= base_url('/assets/images/image3.png') ?>" alt="Icon 3" />
                    <h3>STRATEGY</h3>
                    <p>
                        Our strategy focuses on delivering premium products, secure payment options, fast shipping, and
                        outstanding customer service. We utilize cutting-edge technology to continuously improve and
                        ensure a superior, user-friendly shopping experience.
                    </p>
                </div>
            </div>
        </div>
    </div>
    <!-- <div class="main-section-new">
            <div class="container-d am">
              <div class="left-container">
                <h2 class="heading-A">Why Choose Us</h2>
                <img src="<?= base_url('/assets/images/heading-line.png') ?>" alt="">
                <p class="para-A">Lorem Ipsum is simply dummy text of the printing</p>
                
                <p class="paragraph">
                  Lorem Ipsum is simply dummy text of the printing typesetting
                  industry. Lorem Ipsum has been the industry's standard dummy text
                  ever since the 1500s, when an unknown printer took a galley of
                  type and scrambled it to make a type specimen book. It has
                  survived not only five centuries, but also the leap into
                  electronic typesetting, remaining essentially unchanged. It was
                  popularised in the 1960s with the release of Letraset sheets
                  containing Lorem Ipsum passages, & more recently with desktop
                  publishing software like Aldus PageMaker including versions of
                  Lorem Ipsum.
                </p>
                <div class="points_para">
                  <div class="point">
                    <img src="<?= base_url('/assets/images/tick.png') ?>" alt="" />
                    <div class="point-text">
                      <p>
                        Lorem Ipsum is simply dummy text of the printing typesetting
                        industry. Lorem Ipsum has been the industry's
                      </p>
                    </div>
                  </div>
                  <div class="point">
                    <img src="<?= base_url('/assets/images/tick.png') ?>" alt="" />
                    <div class="point-text">
                      <p>
                        Lorem Ipsum is simply dummy text of the printing typesetting
                        industry. Lorem Ipsum has been the industry's
                      </p>
                    </div>
                  </div>
                  <div class="point">
                    <img src="<?= base_url('/assets/images/tick.png') ?>" alt="" />
                    <div class="point-text">
                      <p>
                        Lorem Ipsum is simply dummy text of the printing typesetting
                        industry. Lorem Ipsum has been the industry's
                      </p>
                    </div>
                  </div>
                  <div class="point">
                    <img src="<?= base_url('/assets/images/tick.png') ?>" alt="" />
                    <div class="point-text">
                      <p>
                        Lorem Ipsum is simply dummy text of the printing typesetting
                        industry. Lorem Ipsum has been the industry's
                      </p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="rightcontainer">
                <div class="imagess">
                  <img src="<?= base_url('/assets/images/imageright.png') ?>" alt="" />
                </div>
              </div>
            </div>
          </div> -->
    <div class="cards-sections am">
        <div class="get_touch">
            <div class="heading text-center">
                <h2 class="heading-A">Why Should You Choose Us?</h2>
                <img src="<?= base_url('/assets/images/heading-line.png')?>" alt="">
                <p class="para-A"></p>
            </div>
            <div class="main_cards">
                <div class="card">
                    <div class="icon_gets">
                        <span class="icon">
                            <img src="<?= base_url('/assets/images/Group181.png') ?>" alt="" />
                        </span>
                    </div>
                    <h2 class="title">Free Shipping</h2>
                    <p class="description">
                        Enjoy fast, reliable, and free shipping on all orders. We ensure your products reach you quickly
                        and safely, no matter where you are.
                    </p>
                </div>
                <div class="card">
                    <div class="icon_gets">
                        <span class="icon">
                            <img src="<?= base_url('/assets/images/Path4.png') ?>" alt="" />
                        </span>
                    </div>
                    <h2 class="title">Easy Payments</h2>
                    <p class="description">
                        With multiple secure payment options, your transactions are seamless and hassle-free. We
                        prioritize your convenience and security in every purchase.
                    </p>
                </div>
                <div class="card">
                    <div class="icon_gets">
                        <span class="icon">
                            <img src="<?= base_url('/assets/images/Path3.png') ?>" alt="" />
                        </span>
                    </div>
                    <h2 class="title">Money-Back Guarantee</h2>
                    <p class="description">
                        Shop with confidence! We offer a money-back guarantee on all purchases, ensuring that you're
                        completely satisfied with your experience.
                    </p>
                </div>
                <div class="card">
                    <div class="icon_gets">
                        <span class="icon">
                            <img src="<?= base_url('/assets/images/Path111.png') ?>" alt="" />
                        </span>
                    </div>
                    <h2 class="title">Finest Quality</h2>
                    <p class="description">

                        We pride ourselves on offering only the highest-quality products, carefully selected to meet
                        your needs and exceed expectations.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ===================testimonial-carousel starts========================= -->

<section class="testimonial-section">
    <div class="heading-para">
        <h2 class="heading-A">What our <br> Customers Says</h2>
        <img src="<?= base_url('/assets/images/heading-line.png') ?>" alt="">
        <h4 class="">Experience Excellence, Every Time</h4>
        <p>
            Our customers' feedback speaks volumes about the quality and service we offer. Here are a couple of reviews
            that highlight our commitment to delivering the best experience
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
                    <img class="quote-icon" src="<?= base_url('/assets/images/testi-comma.png') ?>" alt="Quote Icon">
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
                        Good selection of products, but shipping took a little longer than expected. Overall satisfied.
                    </div>
                    <img class="quote-icon" src="<?= base_url('/assets/images/testi-comma.png') ?>" alt="Quote Icon">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- =============================newsLetter-section====================== -->

<!-- ====================Deals of the day Ends============================ -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>


<script>
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
</script>

</body>

</html>