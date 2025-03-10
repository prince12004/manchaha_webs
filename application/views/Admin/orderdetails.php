<style>
.main-orders {
    display: flex;
    gap: 10px;
}

.btn-edit {
    background-color: #FFFFFF;
    padding: 6px 18px;
    border-radius: 25px;
    border: 1px solid #757994;
    color: #757994;
    font-size: 16px;
    font-weight: 500;
}

.btn-delete {
    background-color: #FFFFFF;
    padding: 6px 18px;
    border-radius: 25px;
    border: 1px solid #757994;
    color: #757994;
    font-size: 16px;
    font-weight: 500;
}

.btn-view {
    background-color: #FFFFFF;
    padding: 6px 18px;
    border-radius: 25px;
    border: 1px solid #757994;
    color: #757994;
    font-size: 16px;
    font-weight: 500;
}
</style>


<?php $this->load->view('Admin/header') ?>
<div id="" class=" order-details-page mt-5">
    <div class="row">
        <!-- Left Section -->
        <div class="col-md-4">
            <!-- Order Section -->
            <div class="card mb-3 cont-padding container">
                <div class="card-body">
                    <h5>Order #<span id="order-id"><?= $data['order']['order_id']?></span></h5>
                    <ul class="list-unstyled">
                        <li class="col-12 d-flex justify-content-between"> <span><img class="m-2"
                                    src="<?= base_url('/assets/images/date.png') ?>" width="42px"> Added:</span> <span
                                class="detail-text-B" id="added-date">
                                <?php
                                  $date = new DateTime($data['order']['order_date'], new DateTimeZone('UTC'));
                                  $date->setTimezone(new DateTimeZone('Asia/Kolkata'));
                                  echo $date->format('d/m/Y H:i:s');
                                  ?>



                            </span></li>
                       
                        <li class="col-12 d-flex justify-content-between"> <span><img class="m-2"
                                    src="<?= base_url('/assets/images/wallet.png') ?>" width="42px"> Payment:</span>
                            <div class="detail-text-B"> ₹<span id="payment-amount"><?= $data['order']['amount']?>
                                    <?php 
                              if($data['order']['payment_status']==1){
                                echo 'Paid Online';
                              }elseif($data['order']['payment_status']==2){
                                echo 'COD';
                              }elseif($data['order']['payment_status']==3){
                                echo 'failed';
                              }elseif($data['order']['payment_status']==4){
                                echo 'refund';
                              }    
                              ?>
                                </span> <span id="payment-status"></span></div>
                        </li>
                        <li class="col-12 d-flex justify-content-between"> <span><img class="m-2"
                                    src="<?= base_url('/assets/images/shipping.png') ?>" width="42px"> Shipping:</span>
                            <div class="text-end">
                                <span class="detail-text-B" id="shipping-status">
                                   

                                </span>
                                <div><a href="<?= isset($data['status']['tracking_data']['track_url']) ? $data['status']['tracking_data']['track_url'] : '#' ?>"
                                        class="trackingurl">Order Tracking URL</a></div>
                            </div>
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
                                    src="<?= base_url('/assets/images/profile.png') ?>" width="42px"> Name: </span><span
                                class="detail-text-A mt-3" id="customer-name"><?= $data['order']['Aname']?></span>
                        </li>
                        <li class="col-12 d-flex justify-content-between"><span><img class="m-2"
                                    src="<?= base_url('/assets/images/message.png') ?>" width="42px"> Email:</span>
                            <span class="detail-text-A mt-3" id="customer-email"><?= $data['order']['email']?></span>
                        </li>
                        <li class="col-12 d-flex justify-content-between"><span><img class="m-2"
                                    src="<?= base_url('/assets/images/phone.png') ?>" width="42px"> Phone: </span> <span
                                class="detail-text-A mt-3"
                                id="customer-phone">+91<?= $data['order']['phone']?></span></li>
                    </ul>
                </div>
            </div>
            <div class="card mb-3 container cont-padding">
                <div class="card-body">
                    <h5>Address</h5>
                    <div class="d-flex align-items-center">
                        <img class="m-2" src="<?= base_url('/assets/images/address.png') ?>" width="42px">
                        <div class="div mt-2">
                            <div>Shipping Address:</div>
                            <span class="detail-text-A mt-2" id="shipping-address">
                                <?= $data['order']['apartment'].' '.$data['order']['streetAddress'].' '.$data['order']['pincode']?>
                            </span>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <img class="m-2" src="<?= base_url('/assets/images/address.png') ?>" width="42px">
                        <div class="div mt-2">
                            <div>Billing Address:</div>
                            <span class="detail-text-A mt-2" id="shipping-address">
                                <?= $data['order']['apartment'].' '.$data['order']['streetAddress'].' '.$data['order']['pincode']?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- Right Section -->
        <div class="col-md-8">
            <!-- Customer and Address Section -->
            <div class="order-tracking container  ">
                <h2 class="pt-1">Order ID: #278AB654</h2>
                <div class="status-line mt-4">
                    <div class="step completed">
                        <div class="icon"><i class="fa-solid fa-cart-arrow-down"></i></div>
                        <p>Order Placed</p>
                        <span class="date">Jul 23, 2024 7:01 AM</span>
                    </div>
                    <div class="step completed">
                        <div class="icon"><i class="fa-solid fa-spinner"></i></div>
                        <p>Processing</p>
                        <span class="date">Jul 23, 2024 7:01 AM</span>
                    </div>
                    <div class="step completed">
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
                    </div>
                </div>

            </div>



            <div class="container table-section p-0 card mt-3">
                <div class="d-flex pt-4">
                    <h5 class="ms-4">Order List</h5>
                </div>
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <!-- Table Cell for Buttons -->

                            </tr>
                        </tbody>
                        <table>
                            <thead>
                                
                                <th>Varient SKU</th>
                                <th>Quantity</th>
                                <th>amount</th>

                            </thead>
                            <tbody>
                                
                                <tr>
                                    <td><?= $data['order']['varient_sku']?></td>
                                    <td><?= $data['order']['quantity']?></td>
                                    <td>₹<?= $data['order']['amount']+$data['order']['taxes']?></td>
                                </tr>

                            </tbody>
                            
                               
                        </table>


                    </table>
                    <?php if ($data['order']['payment_status'] == 4) { ?>
                    <div class="d-flex justify-content-end"> 
                        <p class="btn btn-success">Amount has been refunded already</p>
                    </div>
                    <?php } ?>

                    <?php if(($data['order']['payment_type']=='prepaid')&&(!($data['order']['payment_status']==4))){ ?>
                    <button type="button" class="btn btn-danger" onclick="initiateRefund('<?= $data['order']['order_id']?>','<?= $data['order']['user_id']?>','<?= $data['order']['payment']?>')" >Refund ₹ <?= $data['order']['amount']+$data['order']['taxes']?></button>
                                
                    <?php } ?>
                </div>

            </div>



        </div>
    </div>
</div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/js/all.min.js"></script>
<script src="<?= base_url('assets/javascript/common.js') ?>"></script>

</body>

</html>

<script>

function initiateRefund(order_id,user_id,payment){
    $.ajax({
        url: '<?= base_url('Razorpay/initiateRefund')?>',
        type: 'POST',
        data: {order_id:order_id,user_id:user_id,payment:payment},
        success: function(response){
            console.log(response);
            response = JSON.parse(response);
            if(response.status =='success'){
                alert('Refund Initiated Successfully');
            }else{
                alert(response.error);
            }
        }
    });
}


</script>

<style>
.order-details-page .container h5 {
    margin-bottom: 15px;
    font-weight: 600;
}

.order-details-page .card ul {
    padding-left: 0;
}

.order-details-page .container {
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
}



.order-details-page .cont-padding {
    padding: 20px;
    border-radius: 10px;
}

.order-details-page .table tfoot td {
    font-weight: 600;
}



.order-details-page .detail-text-A {
    font-size: 15px;
    font-weight: 600;
    color: rgb(164, 175, 190);

}

.order-details-page .detail-text-B {
    color: rgba(60, 68, 75, 1);
    font-size: 14px;
    font-weight: 600;
    line-height: 31px;
    margin-top: 10px;
}

.order-details-page .detail-text-C {
    color: rgba(113, 128, 150, 1);
    font-size: 14px;
    font-weight: 700;
    line-height: 31px;

    ;
}

.order-details-page .text-left {
    text-align: left;
}

.trackingurl {
    font-size: 13px;
    text-decoration: underline;
}

.order-details-page .order-status-item p {
    margin-bottom: 0px;
}


.order-details-page .table-section {
    width: 835px;
    height: 477px;
    overflow-y: scroll;
    scrollbar-width: thin;
    position: relative;
}



.order-details-page .table-container {
    width: 100%;
    margin: 0 auto;
    padding: 10px 0px 10px 0px;
    background-color: #fff;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.order-details-page table {
    width: 100%;
    border-collapse: separate;
}

.order-details-page .table-container tfoot tr:last-child td {
    border-bottom: none;
}

.order-details-page th,
.order-details-page td {
    text-align: left;
    padding: 12px 15px;
    border-bottom: 1px solid #ddd;
}

.order-details-page th {
    background-color: #f4f4f4;
    font-weight: bold;
    color: #333;
}

.order-details-page td img {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    margin-right: 10px;
}

.order-details-page .product-info {
    display: flex;
    align-items: center;
}

.order-details-page .product-info div {
    display: flex;
    flex-direction: column;
}

.order-details-page .product-info p {
    margin: 0;
    font-size: 13px;
    font-weight: bold;
    color: #333;
}

.order-details-page .product-info span {
    font-size: 12px;
    color: #888;
}

.order-details-page .status {
    color: #007bff;
    cursor: pointer;
}

.order-details-page tfoot td {
    font-weight: bold;
    font-size: 16px;
    text-align: right;
}

.order-details-page tfoot tr:last-child td {
    font-size: 20px;
    color: #000;
}



.order-details-page .order-tracking {
    border: 1px solid #77777759;
    border-radius: 10px;

}

.order-details-page .status-line {
    display: flex;
    justify-content: space-between;
    align-items: center;
    max-width: 100%;
    margin: 20px auto;
    padding: 10px;
}

.order-details-page .order-tracking h2 {
    text-align: left;
    font-size: 20px;
    font-weight: 700;
    width: 100%;
    margin-bottom: 20px;
}

.order-details-page .step {
    position: relative;
    text-align: center;
    width: 100%;
    margin-bottom: 25px;
}

.order-details-page .step .icon {
    background-color: #f0ebeb;
    border-radius: 50%;
    padding: 10px;
    font-size: 24px;
    width: 50px;
    height: 50px;
    display: inline-block;
    color: #777;
    z-index: 100;
    position: relative;
}

.order-details-page .step p {
    margin: 10px 0 5px;
    font-size: 14px;
    color: #333;
}

.order-details-page .step .date {
    font-size: 12px;
    color: #777;
}

.order-details-page .step::before {
    content: '';
    position: absolute;
    width: 100%;
    height: 2px;
    background-color: #E0E0E0;
    top: 25px;
    left: -50%;
}

.order-details-page .step:first-child::before {
    display: none;
}

.order-details-page .completed .icon {
    background-color: #777;
    color: white;
}

.order-details-page .completed::before {
    background-color: #777;
}
</style>