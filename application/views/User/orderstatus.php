<!-- --------------nav-section-end------------ -->

</header>
<div class="main-page-section">
    <div class="main-content am">
        <h1>Order Status</h1>
        <h3><a href="<?= base_url('/')?>">Home</a> | Order Status</h3>
    </div>
</div>

<?php  


// print_r($trackdata['track']['data']['payment_method']);
$net_total = $trackdata['track']['data']['products'][0]['net_total'];
$tax = $trackdata['track']['data']['products'][0]['tax'];
?>
<div id="main-content" class="main-content order-details-page am">
    <div class="row">
        <!-- Left Section -->
        <div class="col-md-4">
            <!-- Order Section -->
            <div class="card mb-3 cont-padding container">
                <div class="card-body">
                    <h5>Order #<span id="order-id"><?= $trackdata['track']['data']['id']?></span></h5>
                    <ul class="list-unstyled">
                        <li class="col-12 d-flex justify-content-between"> <span><img class="m-2" src="<?= base_url('assets/images/date.png')?>"
                                    alt="" width="42px"> Added:</span> <span class="detail-text-B"
                                id="added-date"><?= $trackdata['track']['data']['created_at']?></span></li>
                        <li class="col-12 d-flex justify-content-between"> <span><img class="m-2"
                                    src="<?= base_url('assets/images/wallet.png')?>" alt="" width="42px">Payment:</span>
                            <div class="detail-text-B"> ₹<span
                                    id="payment-amount">
                                    
                                    <?php  
                                    if ($trackdata['track']['data']['payment_method'] == 'cod') { 
                                        echo number_format($net_total + 40, 2); 
                                    } else { 
                                        echo number_format($net_total , 2); 
                                    } 
                                    ?>

                                    <?= strtoupper($trackdata['track']['data']['payment_method']) ?>
                                    </span> <span
                                    id="payment-status"></span></div>
                        </li>
                        <li class="col-12 d-flex justify-content-between"> <span><img class="m-2"
                                    src="<?= base_url('assets/images/shipping.png')?>" alt="" width="42px">Shipping:</span>
                            <div>
                                <span class="detail-text-B"
                                    id="shipping-status">
                                    <?php  
                                    if ($trackdata['track']['data']['payment_method'] == 'cod') { 
                                     echo   '₹ 40'; 
                                    } else { 
                                      echo  'Free';
                                    } 
                                    ?>
                                    
                                   </span>


                                    
                                <!-- <div><a href="<?= isset($trackdata['track']['data']['last_mile_awb_track_url']) ? $trackdata['track']['data']['last_mile_awb_track_url'] : '' ?>">Order Tracking URL</a></div> -->
                            </div>
                            
                            </span>

                        </li>
                           <?php  $id= $this->uri->segment('2'); ?>

               
				<li class="col-12 d-flex justify-content-between"> <span><img class="m-2" src="<?= base_url('assets/images/date.png')?>"
                                    alt="" width="42px"> Invoice:</span> <span class="detail-text-B"
                                id="added-date"><button onclick="downloadInvoice('<?= $trackdata['track']['data']['id']?>')" class="btn btn-primary">Download</button>
                            
                            </span>
                            
                            
                            </li>


                    </ul>
                </div>
            </div>
            <div class="card mb-3 pb-2 cont-padding container">
                <div class="card-body">
                    <h5>Customer</h5>
                    <ul class="list-unstyled">
                        <li class="col-12 d-flex justify-content-between"><span> <img class="m-2"
                                    src="<?= base_url('assets/images/profile-2.png')?>" alt="" width="42px"> Name: </span><span
                                class="detail-text-A mt-3"
                                id="customer-name"><?= $trackdata['track']['data']['billing_name']?></span></li>
                        <li class="col-12 d-flex justify-content-between"><span><img class="m-2" src="<?= base_url('assets/images/mess.png')?>"
                                    alt="" width="42px"> Email:</span> <span class="detail-text-A mt-3"
                                id="customer-email"><?= $trackdata['track']['data']['billing_email']?></span></li>
                        <li class="col-12 d-flex justify-content-between"><span><img class="m-2"
                                    src="<?= base_url('assets/images/phoness.png')?>" alt="" width="42px"> Phone: </span> <span
                                class="detail-text-A mt-3" id="customer-phone">+91
                                <?= $trackdata['track']['data']['billing_phone']?></span></li>
                    </ul>
                </div>
            </div>
            <div class="card mb-3 container cont-padding">
                <div class="card-body">
                    <h5>Address</h5>
                    <div class="d-flex align-items-center">
                        <img class="m-2" src="<?= base_url('assets/images/address-card-icon.png')?>" alt="" width="42px">
                        <div class="div mt-2">
                            <div>Shipping Address:</div>
                            <span class="detail-text-A mt-2"
                                id="shipping-address"><?= $trackdata['track']['data']['billing_address']. ' ' . $trackdata['track']['data']['billing_address_2'].' '.$trackdata['track']['data']['billing_city']. ' '.$trackdata['track']['data']['billing_pincode'] ?>
                            </span>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <img class="m-2" src= "<?= base_url('assets/images/address-card-icon.png')?>" alt="" width="42px">
                        <div class="div mt-2">
                            <div>Billing Address:</div>
                            <span class="detail-text-A mt-2"
                                id="shipping-address"><?= $trackdata['track']['data']['billing_address']. ' ' . $trackdata['track']['data']['billing_address_2'].' '.$trackdata['track']['data']['billing_city']. ' '.$trackdata['track']['data']['billing_pincode'] ?></span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- Right Section -->
        <div class="col-md-8">
            <div class="container table-container card mb-3">
                <div class="card-body">
                    <div class="d-flex">
                        <h5 class="ms-4">Order List</h5>
                        <div class="ms-4 mb-3">
                            <span class="Order-list-badge"> <?= count($trackdata['track']['data']['products'])?>
                                Orders</span>
                        </div>
                    </div>
                    <table class="table product-detail-table">
                        <thead class="thead">
                            <tr>
                                <th>Product</th>
                                <th>Product ID</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Total Price</th>

                            </tr>
                        </thead>
                        <tbody id="order-list">
                            <?php
                            //  echo '<pre>';
                            // print_r($trackdata['track']['data']['products']);
                            foreach ($trackdata['track']['data']['products'] as $product) {?>
                            <tr>
                                <td><?= strlen($product['name']) > 10 ? substr($product['name'], 0, 10) . '...' : $product['name'] ?>
                                </td>
                                <td><?= $product['product_id']?></td>
                                <td><?= $product['quantity']?></td>
                                <td><?= $product['net_total']?></td>
                            <td>
                                <?php 
                                    if ($trackdata['track']['data']['payment_method'] == 'cod') { 
                                        echo $product['net_total'] + 40; 
                                    } else { 
                                        echo $product['net_total']; 
                                    } 
                                ?> 
                            </td>

                            </tr>
                            <?php }?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-8" style="width: 100%">
                <!-- Customer and Address Section -->
                <div class="order-tracking container" style="padding: 10px;">
                    <h2 class="pt-1">Order ID: #<?= $trackdata['track']['data']['id']?></h2>
                    <div class="status-line mt-4">
                        <?php if(isset($trackdata['trackingdata'][0][$trackdata['track']['data']['id']]['tracking_data']['shipment_track_activities'])&&!empty($trackdata['trackingdata'][0][$trackdata['track']['data']['id']]['tracking_data']['shipment_track_activities'])){?>
                        <?php foreach($trackdata['trackingdata'][0][$trackdata['track']['data']['id']]['tracking_data']['shipment_track_activities'] as $trck){?>
                        <div class="step completed">
                            <div class="icon"><i class="fa-solid fa-cart-arrow-down"></i></div>
                            <p><?= $trck['activity']?></p>
                            <span class="date"><?= $trck['date']?></span>
                        </div>
                        <?php }?>
                        <?php }else{?>
                        <div class="step completed">
                            <div class="icon"><i class="fa-solid fa-spinner"></i></div>
                            <p><?= $trackdata['track']['data']['status']?></p>
                            <span class="date"><?= $trackdata['track']['data']['created_at']?></span>
                        </div>
                        <?php }?>
                        <!-- <div class="step completed">
                                <div class="icon"><i class="fa-solid fa-box"></i></div>
                                <p>Packed</p>
                                <span class="date">Jul 23, 2024 7:01 AM</span>
                              </div>
                              <div class="step">
                                <div class="icon"><i class="fa-solid fa-truck-fast"></i></div>
                                <p>Shipping</p>
                                <span class="date">Jul 23, 2024 7:01 AM</span>
                              </div>
                              <div class="step">
                                <div class="icon"><i class="fa-solid fa-truck-ramp-box"></i></div>
                                <p>Delivered</p>
                                <span class="date">Jul 23, 2024 7:01 AM</span>
                              </div> -->
                    </div>
					
					                    <div>
                        <button class="btn btn-primary" onclick="review('<?= $trackdata['order']['product_id'] ?>','<?= $trackdata['order']['varient_id'] ?>')" >Add Review</button>
                    </div>

                </div>



                <!-- Customer and Address Section -->

                <div class="row">
                    <div class="col-md-6">

                    </div>
                    <div class="col-md-6">

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>





<!-- =============================newsLetter-section====================== -->

<?php $this->load->view('User/footer') ?>




<!-- ====================Deals of the day Ends============================ -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!-- =============this table is only for this page================ -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<script>

	function review(product, varient) {
    $.ajax({
        url: "<?= base_url('add-review') ?>",
        type: "POST",
        data: { product: product, varient: varient },
        success: function(response) {
            window.location.href = '<?= base_url('review-page') ?>';
        }
    });
}
	
function downloadInvoice(shipmentID) {
    // Check if the shipmentID is valid
    if (!shipmentID) {
        alert('Invalid shipment ID. Please provide a valid shipment ID.');
        return;
    }
    const ids = [shipmentID];
    $.ajax({
        url: '<?= base_url('generateInvoice') ?>',
        type: 'POST',
        contentType: 'application/json',
        data: JSON.stringify(ids),
        success: function(response) {

            try {
                const res = typeof response === 'string' ? JSON.parse(response) : response;

                if (res.is_invoice_created === true) {
                    window.location.href = res.invoice_url;
                } else {
                    alert(res.message || 'Something went wrong. Please try again.');
                }
				
            } catch (e) {
                console.error('Response Parsing Error:', e);
                alert('Invalid response from the server. Please contact support.');
            }
        },
        error: function(xhr, status, error) {
            console.error('Request Error:', error);
            alert('Failed to download Invoice. Please try again.');
        }
    });
	//window.location.reload();
}

</script>

</body>

</html>