
<!-- --------------nav-section-end------------ -->
<style>
.empty-message {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 60vh;
    text-align: center;
}

.empty-message h1 {
    font-size: 2rem;
    color: #555;
    margin-bottom: 1rem;
}

.empty-message p {
    font-size: 1rem;
    color: #777;
    margin-bottom: 1.5rem;
}

.home-button {
    padding: 0.75rem 1.5rem;
    font-size: 1rem;
    color: white;
    background-color: #007BFF;
    border: none;
    border-radius: 25px;
    cursor: pointer;
    text-decoration: none;
}

.home-button:hover {
    background-color: #0056b3;
}

@media (max-width: 768px) {
    .main-content {
        width: 87%;
        margin: 0px auto;
    }
    .table-type-list .product-item{
        flex-direction: column !important;
    }
    .wishlists{
        display: flex;
        gap: 10px;
    }
}
</style>

</header>
<div class="main-page-section">
    <div class="main-content am">
        <h1>My Wishlist</h1>
        <h3><a href="<?= base_url('/')?>">Home</a> | Wishlist</h3>
    </div>
</div>
<section class="list-container wishlist-table-page">
    <?php if($data){ ?>
    <div class="table-type-list">
        <?php foreach($data as $d){ ?>
        <div class="product-item d-flex justify-content-between">
            <div class="product-details d-flex gap-2 justify-content-center align-items-center">
                <div class="product-image">
                    <img src="<?= base_url('uploads/products/').$d['varient_image'] ?>" alt="Product">
                </div>
                <div class="">
                    <h3 class="product-title">
                        <?= strlen(($d['jwellary_name'])) > 30 ? substr($d['jwellary_name'], 0, strpos($d['jwellary_name'], ' ', 30)) . '...' : $d['jwellary_name']; ?>
                    </h3>
                    <p class="product-description">
                        <?= strlen(($d['jwellary_description'])) > 70 ? substr($d['jwellary_description'], 0, strpos($d['jwellary_description'], ' ', 80)) . '...' : $d['jwellary_description']; ?>
                    </p>
                </div>
            </div>
          <div class="wishlists">
          <div class="product-price d-flex align-items-center gap-2">
                <span class="current-price"><?= $d['sale_price'] ?> ₹</span>
                <span class="original-price"><?= $d['base_price'] ?> ₹</span>
                <?php
                            $discount = ($d['base_price']-$d['sale_price'])*100/$d['base_price'];
             ?>
                <span class=""><?= round($discount); ?> % Off</span>

            </div>
            <!-- <div class="product-rating  d-flex align-items-center gap-2">
                    <span class="stars">★★★★★★</span>
                    <span class="reviews">37 reviews</span>
                </div> -->
        <div class="wishs-mains">
			    <div class="product-delete">
                <?php if(isset($d['stock']) && $d['stock']>0){?>
                <button class="btn btn-primary"
                    onclick="addToCart('<?= $d['productID']?>','<?= $d['varient_id']?>')"><img src="images/delete.png"
                        alt="">Add to cart</button>
                <?php }else{?>
                <button class="btn btn-primary"><img src="images/delete.png" alt="">Out of stock</button>
                <?php }?>
            </div>
            <div class="product-delete">
                <button class="btn btn-danger" onclick="removeWishlist('<?= $d['varient_id']?>')"><img
                        src="images/delete.png" alt="">Remove</button>
            </div>
			  </div>
                </div>
        </div>
        <?php } ?>
    </div>
    <?php }else{?>
    <div class="empty-message">
        <h1>Your Wishlist is Empty</h1>
        <p>Looks like you haven’t added anything yet.</p>
        <a href="<?= base_url('welcome/index') ?>" class="home-button">Go to Home Page</a>
    </div>
    <?php }?>
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




function addToCart(jwellary_id, varient_id) {
    let quantity = 1;
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
                    //showsuccessModal();
                    alert('Product added to Cart');
                    location.reload();
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

function removeWishlist(varient_id) {


    $.ajax({
        url: '<?= base_url('removeWishlist') ?>',
        type: 'POST',
        data: {
            varient_id: varient_id,
        },
        success: function(response) {
            var res = JSON.parse(response);
            if (res.status === 'success') {
                //showsuccessModal();
                alert('Removed');
                window.location.reload();
            } else if (res.status === 'unauthenticated') {
                //alert('Please login to add to Cart.');
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
</script>

</body>

</html>