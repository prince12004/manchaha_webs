
<!-- --------------nav-section-end------------ -->
</header>
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
</style>

<section>
    <div class="main-page-section">
        <div class="main-content am">
            <h1>My Cart</h1>
            <h3><a href="<?= base_url('/')?>">Home</a> | Cart</h3>
        </div>
    </div>
    <div class="cart-section am">
        <?php if(!empty($data)){ ?>

        <table class="cart-table table table-borderless">
            <thead>
                <tr>
                    <!-- <th>Select</th> -->
                    <th>PRODUCT NAME</th>
                    <!-- <th>SIZE</th> -->
                    <th>QUANTITY</th>
                    <th>PRICE</th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="cart-body">
                <?php $total_price = 0; ?>
                <?php foreach ($data as $d) { ?>
                <tr class="cart-item" data-price="<?= $d['sale_price'] ?>" data-varient-id="<?= $d['varient_id'] ?>"
                    data-product-id="<?= $d['product_id']?>">
                    <!-- <td><input type="checkbox" name="selectproduct"></td> -->
                    <td style="display: none; position:absolute" id="productId"><?= $d['varient_id']?></td>
                    <td class="product-info">
                        <img src="<?= base_url('/uploads/products/') . $d['image'] ?>" alt="Product Image">
                        <div class="description">
                            <strong><?= $d['jwellary_name'] ?></strong>
                            <?= strlen(($d['jwellary_description'])) > 70 ? substr($d['jwellary_description'], 0, strpos($d['jwellary_description'], ' ', 80)) . '...' : $d['jwellary_description']; ?>
                        </div>
                    </td>
                    <!-- <td class="size-options"><span>XS</span></td> -->
                    <td class="quantity-controls">
                        <div class="buttons d-flex justify-content-center">
                            <button type="button" id="minusButton" class="btn-decrease">-</button>
                            <input type="text" value="<?= $d['quantity']?>" class="quantity-input" readonly>
                            <button type="button" class="btn-increase">+</button>
                        </div>
                    </td>
                    <td class="price">₹ <?=$d['quantity']*$d['sale_price'] ?></td>
                    <td><button class="delete-btn"><img src="images/delete.png" alt=""></button></td>
                </tr>
                <?php $total_price += $d['sale_price']; ?>
                <?php } ?>
            </tbody>
        </table>


        <div class="promo-code-section">
            <div>
                <input type="text" id="promo-code" placeholder="PROMOCODE">
                <button id="apply-promo-btn">APPLY NOW</button>
            </div>
           <div class="cartss">
			    <div>
                <span>
                    <span class="text-muted fw-semibold">Shipping: ₹</span>
                    <span id="shipping-charge"><strong>0.00</strong></span>
                </span>
            </div>
            <div>
                <span class="me-4">
                    <span class="text-muted fw-semibold">Total: ₹</span>
                    <span id="total-price"></span>
                </span>
            </div>
			</div>
        </div>


        <div class="action-buttons">
            <button class="continue-shopping-btn" onclick="window.location.href='<?= base_url('Welcome/index') ?>'">
                CONTINUE SHOPPING
            </button>
            <button onclick="proceedToPay()" class="pay-now-btn">PAY NOW</button>
        </div>
        <?php }else{?>
        <div class="empty-message">
            <h1>Your Cart is Empty</h1>
            <p>Looks like you haven’t added anything yet.</p>
            <a href="<?= base_url('welcome/index') ?>" class="home-button">Go to Home Page</a>
        </div>
        <?php }?>
    </div>
</section>

<?php $this->load->view('User/footer') ?>

<!-- Scripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

<script>
$(document).ready(function() {
    // document.getElementById('minusButton').innerHTML = 'delete';
    function updateTotal() {
        let total = 0;
        $('.cart-item').each(function() {
            let quantity = parseInt($(this).find('.quantity-input').val());
            let price = parseFloat($(this).data('price'));
            total += quantity * price;
        });
        $('#total-price').text(total.toFixed(2));
    }

    $('.btn-increase').click(function() {
        let quantityInput = $(this).siblings('.quantity-input');
        let currentQuantity = parseInt(quantityInput.val());
        let newQuantity = currentQuantity + 1;
        quantityInput.val(newQuantity);

        let pricePerItem = parseFloat($(this).closest('tr').data('price'));
        let newPrice = pricePerItem * newQuantity;
        $(this).closest('tr').find('.price').text('₹ ' + newPrice.toFixed(2));

        updateTotal();
    });

    $('.btn-decrease').click(function() {
        let quantityInput = $(this).siblings('.quantity-input');
        let currentQuantity = parseInt(quantityInput.val());
        if (currentQuantity > 1) {
            let newQuantity = currentQuantity - 1;
            quantityInput.val(newQuantity);

            let pricePerItem = parseFloat($(this).closest('tr').data('price'));
            let newPrice = pricePerItem * newQuantity;
            $(this).closest('tr').find('.price').text('₹ ' + newPrice.toFixed(2));

            updateTotal();
        } else if (currentQuantity === 1) {

            let cartData = {
                'product_id': document.getElementById('productId').innerText,

            };

            $.ajax({
                url: '<?= base_url('deleteFromCart') ?>',
                method: 'POST',
                data: cartData,
                success: function(response) {
                    window.location.reload();
                },
                error: function() {
                    alert('Error saving cart data.');
                }
            });

        }
    });

    $('.delete-btn').click(function() {
        $(this).closest('tr').remove();
        updateTotal();
    });

    $('#apply-promo-btn').click(function() {
        let promoCode = $('#promo-code').val().trim();
        if (promoCode === 'DISCOUNT10') {
            let currentTotal = parseFloat($('#total-price').text());
            let discountedTotal = currentTotal * 0.90;
            $('#total-price').text(discountedTotal.toFixed(2));
        }
    });

    updateTotal();
});

function proceedToPay() {
    let cartData = [];
    $('.cart-item').each(function() {
        let productID = $(this).data('product-id');
        let varientID = $(this).data('varient-id');
        let quantity = parseInt($(this).find('.quantity-input').val());
        let price = parseFloat($(this).find('.price').text().replace('₹', '').trim());

        if (!isNaN(quantity) && !isNaN(price)) {
            cartData.push({
                productID: productID,
                varientID: varientID,
                quantity: quantity,
                price: price
            });
        }
    });

    if (cartData.length > 0) {
        $.ajax({
            url: '<?= base_url('saveCartData') ?>',
            method: 'POST',
            data: {
                cartData: cartData
            },
            success: function(response) {
                window.location.href = '<?= base_url('checkout') ?>';
            },
            error: function() {
                alert('Error saving cart data.');
            }
        });
    } else {
        alert('No valid items in the cart.');
    }
}
</script>