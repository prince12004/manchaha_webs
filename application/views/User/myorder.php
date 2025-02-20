
<!-- --------------nav-section-end------------ -->
<style>
.text-danger {
    border: 1px solid red;
    padding: 8px;
    border-radius: 20px;
    cursor: pointer;
}

.text-danger:hover {
    background-color: red;
    color: #FFFFFF !important;
}

.text-dangers {
    cursor: pointer;
    color: red;
}

.text-dangers:hover {
    background-color: red;
    color: #FFFFFF;
    padding: 5px;
    border-radius: 25px;
}

.shop-button {
    border: 1px solid #007bff;
    padding: 10px 22px;
    border-radius: 20px;
    cursor: pointer;
}

.shop-button:hover {
    background-color: #007bff;
    color: #FFFFFF;
}

.btn-danger {
    background-color: #FFFFFF;
    color: red;
    border-radius: 25px;
    border: 1px solid red;
}

.btn-danger:hover {
    background-color: red;
    color: #FFFFFF;
    border: 1px solid red;
}
</style>
</header>

<section class="my-order-page">
    <div class="filter-cont am d-flex justify-content-end overflow-visible">
        <div class="order-search-container">

            <div class="w-100 d-flex mb-2">
                <input type="text" class="search-input" id="orderSearch" placeholder="Search your orders here">
                <button class="search-button" onclick="searchOrders()"><img class="me-2" src="<?= base_url('assets/')?>images/search-nav.png"
                        alt="" width="16px">Search</button>
            </div>
            <!-- <div class="my-order-page">
                    <div class="dropdown-select">
                      <button class="dropdown-toggle">
                        Order Status
                      </button>
                      <ul class="dropdown-menu">
                        <li><a href="#">Pending</a></li>
                        <li><a href="#">Shipped</a></li>
                        <li><a href="#">Delivered</a></li>
                        <li><a href="#">Cancelled</a></li>
                      </ul>
                    </div>
                </div> -->

            <!-- <div class="my-order-page">
                    <div class="dropdown-select">
                        <button class="dropdown-toggle">
                            Order Time
                        </button>
                        <ul class="dropdown-menu">
                            <li><a href="#">Today</a></li>
                            <li><a href="#">Yesterday</a></li>
                            <li><a href="#">Week ago</a></li>
                            <li><a href="#">Month ago</a></li>
                        </ul>
                    </div>
                </div> -->
        </div>
    </div>

    <div class="cart-section am ">
        <table class="cart-table table table-borderless">
            <thead>
                <tr>
                    <th>PRODUCT NAME</th>
                    <th>QUANTITY</th>
                    <th>PRICE</th>
                    <th>DELIVERY STATUS</th>
                    <th>ACTION</th>
                </tr>
            </thead>
            <tbody id="cart-body">
                <?php 
                foreach($order as $orderData){?>
                <tr class="cart-item" data-price="400">
 <div class="min-inus">
                    <td class="product-info">
                        <img src="<?= $orderData['image'] ?>" alt="Product Image">
                        <a href="<?= base_url('order-status/').$orderData['shipment_id']?>">
                            <div class="description">
                                <strong><?= $orderData['jwellary_name'] ?></strong>
                                <!-- <p><?= $orderData['jwellary_description'] ?></p> -->

                            </div>
                        </a>
                    </td>


                   
						<td class="quantity-controls">
                        <input type="text" value="<?= $orderData['quantity'] ?>" class="quantity-input" readonly>
                    </td>
                   
                    <td class="price">₹ 
                   <?php  
              
                  if (!empty($orderData['payment_type']) && $orderData['payment_type'] == 2) { 
                      $total = ($orderData['amount'] * $orderData['quantity']);  
                      $tax = ($total * $orderData['applicable_tax']) / 100;  
                      $finalAmount = $total + $tax + $orderData['cod_charge'];  
                      echo ($finalAmount);  
                  } else { 
                      $total = ($orderData['amount'] * $orderData['quantity']);  
                      $tax = ($total * $orderData['applicable_tax']) / 100;  
                      $finalAmount = $total + $tax;  
                      echo ($finalAmount);  
                  } 
                  ?>
                  
                </td>


                    <td>
                        <?php if (($orderData['order_status']==5)||($orderData['order_status']==7)) {?>
                        <div class="text-danger">cancelled</div>
                        <?php }elseif(isset($orderData['track']['tracking_data'])&&$orderData['track']['tracking_data']['track_status'] ===1){?>
                        <div class="d-flex delivery-expected">
                            <div>
                                <img class="me-1" src="<?= base_url('assets/')?>images/green-bullet.png" alt=""
                                    width="15px">
                            </div>
                            <div class="min-ius">
                                <h5>Delivery expected by
                                    <?= $orderData['track']['tracking_data']['shipment_track'][0]['edd']?></h5>
                                <p>Current Status: <span
                                        class="text-dangers"><?= $orderData['track']['tracking_data']['shipment_track'][0]['current_status']?></span>
                                </p>
                                <p>Courier Name:
                                    <?= $orderData['track']['tracking_data']['shipment_track'][0]['courier_name']?></p>
                                <p>Track your order here: <a
                                        href="<?= $orderData['track']['tracking_data']['track_url'] ?>">click here</a>
                                </p>

                            </div>
                        </div>
                        <?php }else{?>
                        <p>order placed</p>
                        <?php }?>

                    </td>
                    <td>
                        <?php if ($orderData['order_status']==5) {?>
                        <a href="<?= base_url('Welcome/details/').$orderData['product_id']?>" class="shop-button">
                            shop again
                        </a>

                        <?php }else{?>
                        <button type="button" class="btn btn-danger"
                            onclick="cancelOrder('<?= $orderData['order_id']?>')">Cancel Order</button>

                        <?php } ?>
                    </td>
					</div>
                </tr>
                <?php }?>
            </tbody>
        </table>
    </div>
</section>






<!-- =============================newsLetter-section====================== -->

<?php $this->load->view('User/footer') ?>




<!-- ====================Deals of the day Ends============================ -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

<script>
$('.delete-btn').click(function() {
    $(this).closest('tr').remove();
    updateTotal();
});


function cancelOrder(orderid) {

    const finalData = {
        orderid: orderid,
    };




    $.ajax({
        url: '<?= base_url('cancelOrder') ?>', // Your endpoint
        type: 'POST',
        data: finalData,
        success: function(response) {
			console.log(response);
            resp = JSON.parse(response);
            if (resp.status === 'success') {
                alert('order cancelled successfully');
                window.location.reload();
                document.getElementById('alertResponse').innerHTML = 'Order Successfull';
                alertModal();
                console.log(response);

            } else {
                console.log(response);
                document.getElementById('alertResponse').innerHTML = 'something went wrong';
                alertModal();
            }
        },
        error: function(xhr, status, error) {
            console.error('Error Updating Details:', error);
            // alert('An error occurred while saving the details.');
            document.getElementById('alertResponse').innerHTML =
                'An error occurred while saving the details';
            alertModal();
        }
    });


}


    function searchOrders() {
        let input = document.getElementById("orderSearch").value.toLowerCase();
        let tableRows = document.querySelectorAll("#cart-body tr");

        tableRows.forEach(row => {
            let productName = row.querySelector(".product-info strong").innerText.toLowerCase();
            if (productName.includes(input)) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        });
    }
    document.getElementById("orderSearch").addEventListener("keyup", searchOrders);
</script>

</body>

</html>
