<?php $this->load->view('User/header') ?>
<!-- --------------nav-section-end------------ -->

</header>
<div class="main-page-section">
    <div class="main-content am">
        <h1>All Notifications</h1>
        <h3><a href="<?= base_url('/')?>">Home</a> | notification</h3>
    </div>
</div>
<section class="list-container notification-page">
    <div class="table-type-list">
        <div class="product-item">
            <div class="product-details d-flex gap-2 justify-content-center align-items-center">
                <div class="product-image">
                    <img src="images/noti-1.png" alt="Product">
                </div>
                <div class="">
                    <h3 class="product-title">LOREM IPSUM IS SIMPLY DUMMY TEXT</h3>
                    <p class="product-description">Lorem Ipsum is simply dummy text of the printing and typesetting
                        industry. Lorem Ipsum has been the industry's standard dummy.</p>
                </div>
            </div>
            <div class="product-delete">
                <button class="delete-btn"><img src="images/delete-icon2.png" alt=""></button>
            </div>
        </div>
        <div class="product-item">
            <div class="product-details d-flex gap-2 justify-content-center align-items-center">
                <div class="product-image">
                    <img src="images/noti-2.png" alt="Product">
                </div>
                <div class="">
                    <h3 class="product-title">LOREM IPSUM IS SIMPLY DUMMY TEXT</h3>
                    <p class="product-description">Lorem Ipsum is simply dummy text of the printing and typesetting
                        industry. Lorem Ipsum has been the industry's standard dummy.</p>
                </div>
            </div>
            <div class="product-delete">
                <button class="delete-btn"><img src="images/delete-icon2.png" alt=""></button>
            </div>
        </div>
        <div class="product-item">
            <div class="product-details d-flex gap-2 justify-content-center align-items-center">
                <div class="product-image">
                    <img src="images/noti-3.png" alt="Product">
                </div>
                <div class="">
                    <h3 class="product-title">LOREM IPSUM IS SIMPLY DUMMY TEXT</h3>
                    <p class="product-description">Lorem Ipsum is simply dummy text of the printing and typesetting
                        industry. Lorem Ipsum has been the industry's standard dummy.</p>
                </div>
            </div>
            <div class="product-delete">
                <button class="delete-btn"><img src="images/delete-icon2.png" alt=""></button>
            </div>
        </div>
        <div class="product-item">
            <div class="product-details d-flex gap-2 justify-content-center align-items-center">
                <div class="product-image">
                    <img src="images/noti-4.png" alt="Product">
                </div>
                <div class="">
                    <h3 class="product-title">LOREM IPSUM IS SIMPLY DUMMY TEXT</h3>
                    <p class="product-description">Lorem Ipsum is simply dummy text of the printing and typesetting
                        industry. Lorem Ipsum has been the industry's standard dummy.</p>
                </div>
            </div>
            <div class="product-delete">
                <button class="delete-btn"><img src="images/delete-icon2.png" alt=""></button>
            </div>
        </div>
        <!-- Repeat .product-item as needed -->
    </div>
</section>




<!-- =============================newsLetter-section====================== -->

<?php $this->load->view('User/footer') ?>




<!-- ====================Deals of the day Ends============================ -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
$('.delete-btn').click(function() {
    $(this).closest('.product-item').remove();
    updateTotal();
});
</script>

</body>

</html>