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
                    <h5>Order #<span id="order-id"><?= $data['order'][0]['order_id']?></span></h5>
                    <ul class="list-unstyled">
                        <li class="col-12 d-flex justify-content-between"> <span><img class="m-2"
                                    src="<?= base_url('/assets/images/date.png') ?>" width="42px"> Added:</span> <span
                                class="detail-text-B" id="added-date">
                                <?php
                                  $date = new DateTime($data['order'][0]['order_date'], new DateTimeZone('UTC'));
                                  $date->setTimezone(new DateTimeZone('Asia/Kolkata'));
                                  echo $date->format('d/m/Y H:i:s');
                                  ?>



                            </span></li>
                        <?php 
                                $totalAmount = 0;
                                foreach ($data['order'] as $order) {
                                  $totalAmount = $totalAmount+$order['amount'];
                                }
                                ?>
                        <li class="col-12 d-flex justify-content-between"> <span><img class="m-2"
                                    src="<?= base_url('/assets/images/wallet.png') ?>" width="42px"> Payment:</span>
                            <div class="detail-text-B"> ₹<span id="payment-amount"><?= $totalAmount?>
                                    <?php 
                              if($data['order'][0]['payment_status']==1){
                                echo 'Paid Online';
                              }elseif($data['order'][0]['payment_status']==2){
                                echo 'COD';
                              }elseif($data['order'][0]['payment_status']==3){
                                echo 'failed';
                              }elseif($data['order'][0]['payment_status']==4){
                                echo 'refund';
                              }    
                              ?>
                                </span> <span id="payment-status"></span></div>
                        </li>
                        <li class="col-12 d-flex justify-content-between"> <span><img class="m-2"
                                    src="<?= base_url('/assets/images/shipping.png') ?>" width="42px"> Shipping:</span>
                            <div class="text-end">
                                <span class="detail-text-B" id="shipping-status">
                                    <?php if(isset($data['status']['tracking_data'])){
                                           echo $data['status']['tracking_data']['shipment_track'][0]['current_status'];
                                            
                                          }else{
                                            if(empty($data['status'][$data['order'][0]['shipment_id']]['tracking_data']['shipment_track'][0]['current_status'])){
                                            echo 'New Order';
                                            }else{
                                              echo $data['status'][$data['order'][0]['shipment_id']]['tracking_data']['shipment_track'][0]['current_status'];
                                            }
                                          }
                                          ?>

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
                                class="detail-text-A mt-3" id="customer-name"><?= $data['order'][0]['name']?></span>
                        </li>
                        <li class="col-12 d-flex justify-content-between"><span><img class="m-2"
                                    src="<?= base_url('/assets/images/message.png') ?>" width="42px"> Email:</span>
                            <span class="detail-text-A mt-3" id="customer-email"><?= $data['order'][0]['email']?></span>
                        </li>
                        <li class="col-12 d-flex justify-content-between"><span><img class="m-2"
                                    src="<?= base_url('/assets/images/phone.png') ?>" width="42px"> Phone: </span> <span
                                class="detail-text-A mt-3"
                                id="customer-phone">+91<?= $data['order'][0]['phone']?></span></li>
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
                                <?= $data['order'][0]['apartment'].' '.$data['order'][0]['streetAddress'].' '.$data['order'][0]['pincode']?>
                            </span>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <img class="m-2" src="<?= base_url('/assets/images/address.png') ?>" width="42px">
                        <div class="div mt-2">
                            <div>Billing Address:</div>
                            <span class="detail-text-A mt-2" id="shipping-address">
                                <?= $data['order'][0]['apartment'].' '.$data['order'][0]['streetAddress'].' '.$data['order'][0]['pincode']?>
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
                                <td>
                                    <div class="main-orders">
                                        <!-- Edit Button -->
                                        <button class="btn-edit"
                                            onclick="SchedulePickup('<?= $data['order'][0]['shipment_id']?>')">Schedule
                                            PickUp</button>
                                        <?php
                $totalWeight = 0;
               foreach ($data['order'] as $order) {
                $totalWeight = $totalWeight+$order['weight'];
               }
                ?>
                                        <!-- Delete Button -->
                                        <button class="btn-delete"
                                            onclick="assignAWB('<?= $data['order'][0]['shipment_id']?>','<?= $totalWeight/1000?>','<?= $data['order'][0]['pincode']?>')">
                                            Generate Label
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                        <!-- <tfoot>
                                      <tr>
                                          <td colspan="5">Discount</td>
                                          <td>0%</td>
                                      </tr>
                                      <tr>
                                          <td colspan="5">Shipping Cost</td>
                                          <td>₹ 00.00</td>
                                      </tr>
                                      <tr class="grand-total">
                                          <td colspan="5">Total:</td>
                                          <td id="grand-total">₹ 00.00</td>
                                      </tr>
                                </tfoot> -->
                        <table>
                            <thead>
                                <tr>Products </tr>

                            </thead>
                            <tbody>
                                <th>#</th>
                                <th>varient sku</th>
                                <th>Quantity</th>
                                <th>amount</th>

                                <?php foreach ($data['order'] as $value=> $order) {?>
                                <tr>
                                    <td><?= $value+1?></td>
                                    <td><?= $order['varient_sku']?></td>
                                    <td><?= $order['quantity']?></td>
                                    <td><?= $order['amount']?></td>
                                </tr>
                                <?php }?>
                            </tbody>
                        </table>


                    </table>
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
<script>
// $(document).ready(function() {


//     // Sample data
//     const orderDetails = {
//         orderId: '56789',
//         addedDate: '2023-07-25',
//         paymentAmount: 250,
//         paymentStatus: 'Paid',
//         shippingStatus: 'Pending'
//     };

//     const orderStatus = {
//         orderPlaced: '2023-07-25',
//         processing: '2023-07-26',
//         packed: '2023-07-27',
//         shipping: '',
//         delivered: ''
//     };

//     const customerInfo = {
//         name: 'John Doe',
//         email: 'john.doe@example.com',
//         phone: '+1234567890',
//         shippingAddress: '123 Main St, City, Country'
//     };

//     const orderList = [
//         {
//             productImg: 'images/product-1.png',
//             productName: 'Product 1',
//             productDesc: ' Description',
//             orderId: '12345',
//             distributor: 'Distributor 1',
//             retailer: 'Retailer 1',
//             quantity: 2,
//             price: 100
//         },
//         {
//             productImg: 'images/product-2.png',
//             productName: 'Product 1',
//             productDesc: ' Description',
//             orderId: '12345',
//             distributor: 'Distributor 1',
//             retailer: 'Retailer 2',
//             quantity: 2,
//             price: 100
//         },
//         {
//             productImg: 'images/product-3.png',
//             productName: 'Product 1',
//             productDesc: ' Description',
//             orderId: '12345',
//             distributor: 'Distributor 1',
//             retailer: 'Retailer 5',
//             quantity: 2,
//             price: 100
//         },
//         {
//             productImg: 'images/product-4.png',
//             productName: 'Product 1',
//             productDesc: ' Description',
//             orderId: '12345',
//             distributor: 'Distributor 1',
//             retailer: 'Retailer 1',
//             quantity: 2,
//             price: 100
//         },
//         {
//             productImg: 'images/product-5.png',
//             productName: 'Product 1',
//             productDesc: ' Description',
//             orderId: '12345',
//             distributor: 'Distributor 1',
//             retailer: 'Retailer 3',
//             quantity: 2,
//             price: 100
//         },
//         {
//             productImg: 'images/product-7.png',
//             productName: 'Product 1',
//             productDesc: ' Description',
//             orderId: '12345',
//             distributor: 'Distributor 1',
//             retailer: 'Retailer 8',
//             quantity: 2,
//             price: 100
//         },

//     ];

//     // Populate order details
//     $('#order-id').text(orderDetails.orderId);
//     $('#added-date').text(orderDetails.addedDate);
//     $('#payment-amount').text(orderDetails.paymentAmount);
//     $('#payment-status').text(orderDetails.paymentStatus);
//     $('#shipping-status').text(orderDetails.shippingStatus);

//     // Populate order status
//     $('#status-order-placed').text(orderStatus.orderPlaced);
//     $('#status-processing').text(orderStatus.processing);
//     $('#status-packed').text(orderStatus.packed);
//     $('#status-shipping').text(orderStatus.shipping);
//     $('#status-delivered').text(orderStatus.delivered);

//     // Populate customer info
//     $('#customer-name').text(customerInfo.name);
//     $('#customer-email').text(customerInfo.email);
//     $('#customer-phone').text(customerInfo.phone);
//     $('#shipping-address').text(customerInfo.shippingAddress);


// });


function assignAWB(id, weight, pincode) {
    $.ajax({
        url: '<?= base_url('assignAWB') ?>',
        type: 'POST',
        contentType: 'application/json',
        data: JSON.stringify({
            shipment_id: id,
            weight: weight,
            pincode: pincode
        }),
        success: function(response) {
            res = JSON.parse(response);
            if (res.status === 1) {
                window.location.href = res.manifest_url;
            } else if (res.label_created === 0) {
                alert('Label Not Created');
            } else if (res.error) {
                alert(res.error);
            } else {
                alert(res.details.message);
            }

        },
        error: function(xhr, status, error) {
            console.error('Error:', error);
            alert('Failed to generate label. Please try again.');
        }
    });
}


function generateLabel(id) {
    $.ajax({
        url: '<?= base_url('generateLabel') ?>',
        type: 'POST',
        contentType: 'application/json',
        data: JSON.stringify({
            shipment_id: [id]
        }),
        success: function(response) {
            res = JSON.parse(response);
            if (res.label_created === 1) {
                window.location.href = res.label_url;
            } else if (res.label_created === 0) {
                alert('Label Not Created');
            } else {
                alert('something went wrong');
            }

        },
        error: function(xhr, status, error) {
            console.error('Error:', error);
            alert('Failed to generate label. Please try again.');
        }
    });
}



function SchedulePickup(shipment) {
    $.ajax({
        url: '<?= base_url('SchedulePickup') ?>',
        type: 'POST',
        contentType: 'application/json',
        data: JSON.stringify({
            shipment_id: [shipment]
        }),
        success: function(response) {
            console.log(response);
            res = JSON.parse(response);
            if (res.pickup_status === 1) {
                alert('done');
                alert(res.response.pickup_scheduled_date);
            } else if (res.status_code === 400) {
                alert('Missing Data');
            } else {
                alert('something went wrong');
            }

        },
        error: function(xhr, status, error) {
            console.error('Error:', error);
            alert('Failed to generate label. Please try again.');
        }
    });
}
</script>
</body>

</html>



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