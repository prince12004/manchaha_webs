<?php $this->load->view('Admin/header') ?>
         <div id="" class=" order-details-page mt-5">
            <div class="row">
                <!-- Left Section -->
                <div class="col-md-4">
                    <!-- Order Section -->
                    <div class="card mb-3 cont-padding container">
                        <div class="card-body">
                            <h5>Order #<span id="order-id"></span></h5>
                            <ul class="list-unstyled">
                                <li class="col-12 d-flex justify-content-between"> <span><img class="m-2" src="images/date.png" alt="" width="42px"> Added:</span> <span class="detail-text-B" id="added-date">Jul 23, 2024 7:01 AM</span></li>
                                <li class="col-12 d-flex justify-content-between"> <span><img  class="m-2" src="images/wallet.png" alt="" width="42px">Payment:</span> <div class="detail-text-B"> ₹<span  id="payment-amount">15,532.00 Fully Paid</span> <span id="payment-status" ></span></div></li>
                                <li class="col-12 d-flex justify-content-between"> <span><img  class="m-2" src="images/shipping.png" alt="" width="42px">Shipping:</span> 
                                    <div class="text-end">
                                        <span class="detail-text-B" id="shipping-status">Pending</span>
                                        <div><a href="#" class="trackingurl">Order Tracking URL</a></div>
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
                                <li class="col-12 d-flex justify-content-between"><span> <img class="m-2" src="images/profile.png" alt="" width="42px">  Name: </span><span class="detail-text-A mt-3" id="customer-name">lorem ipsum</span></li>
                                <li  class="col-12 d-flex justify-content-between"><span><img class="m-2" src="images/message.png" alt="" width="42px"> Email:</span> <span class="detail-text-A mt-3" id="customer-email">abc@gmail.com</span></li>
                                <li  class="col-12 d-flex justify-content-between"><span><img class="m-2" src="images/phone.png" alt="" width="42px"> Phone: </span> <span class="detail-text-A mt-3" id="customer-phone">+918394738243</span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card mb-3 container cont-padding">
                        <div class="card-body">
                            <h5>Address</h5>
                            <div class="d-flex align-items-center">
                                <img class="m-2" src="images/address.png" alt="" width="42px">
                                <div class="div mt-2">
                                    <div>Shipping Address:</div> 
                                    <span class="detail-text-A mt-2" id="shipping-address">qwchuwhxerxwecr eceaxe </span>
                                 </div>
                            </div>
                            <div class="d-flex align-items-center">
                                <img class="m-2" src="images/address.png" alt="" width="42px">
                                <div class="div mt-2">
                                    <div>Billing Address:</div> 
                                    <span class="detail-text-A mt-2" id="shipping-address">crhrnwxq ewhrew ucxhueuwirhe</span>
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
                                        <th>Product</th>
                                        <th>Tracking ID</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Status</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                           <div class="product-info">
                                                <img src="https://via.placeholder.com/40" alt="Product Image">
                                                <div>
                                                    <p>Lorem Ipsum is simply</p>
                                                    <span>Simply dummy text</span>
                                                </div>
                                           </div>
                                        </td>
                                        <td>DC12#1234</td>
                                        <td>₹ 5,450</td>
                                        <td>1</td>
                                        <td class="status">Processing</td>
                                        <td class="total-price">₹ 5,450</td>
                                    </tr>
                                    <tr>
                                        <td>
                                           <div class="product-info">
                                                <img src="https://via.placeholder.com/40" alt="Product Image">
                                                <div>
                                                    <p>Lorem Ipsum is simply</p>
                                                    <span>Simply dummy text</span>
                                                </div>
                                           </div>
                                        </td>
                                        <td>DC12#1234</td>
                                        <td>₹ 5,450</td>
                                        <td>1</td>
                                        <td class="status">Processing</td>
                                        <td class="total-price">₹ 5,450</td>
                                    </tr>
                                    <tr>
                                        <td>
                                           <div class="product-info">
                                                <img src="https://via.placeholder.com/40" alt="Product Image">
                                                <div>
                                                    <p>Lorem Ipsum is simply</p>
                                                    <span>Simply dummy text</span>
                                                </div>
                                           </div>
                                        </td>
                                        <td>DC12#1234</td>
                                        <td>₹ 5,450</td>
                                        <td>1</td>
                                        <td class="status">Processing</td>
                                        <td class="total-price">₹ 5,450</td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="5">Discount</td>
                                        <td>20%</td>
                                    </tr>
                                    <tr>
                                        <td colspan="5">Shipping Cost</td>
                                        <td>₹ 00.00</td>
                                    </tr>
                                    <tr class="grand-total">
                                        <td colspan="5">Total:</td>
                                        <td id="grand-total">₹ 15,532.00</td>
                                    </tr>
                                </tfoot>
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
    <script src="java.scriptjs/common.js"></script>
    <script>
     
$(document).ready(function() {
   

    // Sample data
    const orderDetails = {
        orderId: '56789',
        addedDate: '2023-07-25',
        paymentAmount: 250,
        paymentStatus: 'Paid',
        shippingStatus: 'Pending'
    };

    const orderStatus = {
        orderPlaced: '2023-07-25',
        processing: '2023-07-26',
        packed: '2023-07-27',
        shipping: '',
        delivered: ''
    };

    const customerInfo = {
        name: 'John Doe',
        email: 'john.doe@example.com',
        phone: '+1234567890',
        shippingAddress: '123 Main St, City, Country'
    };

    const orderList = [
        {
            productImg: 'images/product-1.png',
            productName: 'Product 1',
            productDesc: ' Description',
            orderId: '12345',
            distributor: 'Distributor 1',
            retailer: 'Retailer 1',
            quantity: 2,
            price: 100
        },
        {
            productImg: 'images/product-2.png',
            productName: 'Product 1',
            productDesc: ' Description',
            orderId: '12345',
            distributor: 'Distributor 1',
            retailer: 'Retailer 2',
            quantity: 2,
            price: 100
        },
        {
            productImg: 'images/product-3.png',
            productName: 'Product 1',
            productDesc: ' Description',
            orderId: '12345',
            distributor: 'Distributor 1',
            retailer: 'Retailer 5',
            quantity: 2,
            price: 100
        },
        {
            productImg: 'images/product-4.png',
            productName: 'Product 1',
            productDesc: ' Description',
            orderId: '12345',
            distributor: 'Distributor 1',
            retailer: 'Retailer 1',
            quantity: 2,
            price: 100
        },
        {
            productImg: 'images/product-5.png',
            productName: 'Product 1',
            productDesc: ' Description',
            orderId: '12345',
            distributor: 'Distributor 1',
            retailer: 'Retailer 3',
            quantity: 2,
            price: 100
        },
        {
            productImg: 'images/product-7.png',
            productName: 'Product 1',
            productDesc: ' Description',
            orderId: '12345',
            distributor: 'Distributor 1',
            retailer: 'Retailer 8',
            quantity: 2,
            price: 100
        },
        
    ];

    // Populate order details
    $('#order-id').text(orderDetails.orderId);
    $('#added-date').text(orderDetails.addedDate);
    $('#payment-amount').text(orderDetails.paymentAmount);
    $('#payment-status').text(orderDetails.paymentStatus);
    $('#shipping-status').text(orderDetails.shippingStatus);

    // Populate order status
    $('#status-order-placed').text(orderStatus.orderPlaced);
    $('#status-processing').text(orderStatus.processing);
    $('#status-packed').text(orderStatus.packed);
    $('#status-shipping').text(orderStatus.shipping);
    $('#status-delivered').text(orderStatus.delivered);

    // Populate customer info
    $('#customer-name').text(customerInfo.name);
    $('#customer-email').text(customerInfo.email);
    $('#customer-phone').text(customerInfo.phone);
    $('#shipping-address').text(customerInfo.shippingAddress);

   
});

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
  .order-details-page .container{
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
  }
  
  
  
  .order-details-page .cont-padding{
    padding: 20px;
    border-radius: 10px;
  }
  
  .order-details-page .table tfoot td {
    font-weight: 600;
  }
  
  
  
  .order-details-page .detail-text-A{
    font-size: 15px;
    font-weight: 600;
    color: rgb(164, 175, 190);
  
  }
  .order-details-page .detail-text-B{
    color:  rgba(60, 68, 75, 1);
    font-size: 14px;
    font-weight: 600;
    line-height: 31px;
    margin-top: 10px
  
    ;
  }
  .order-details-page .detail-text-C{
    color: rgba(113, 128, 150, 1);
    font-size: 14px;
    font-weight: 700;
    line-height: 31px;
  
    ;
  }
  .order-details-page .text-left{
    text-align: left;
  }
  .trackingurl{
    font-size: 13px;
    text-decoration: underline;
  }
  
  .order-details-page .order-status-item p{
    margin-bottom: 0px;
  }
  
  
  .order-details-page .table-section{
      width: 835px;
      height: 477px;
      overflow-y: scroll;
      scrollbar-width: thin;
      position: relative;
  }
  
  
  
  .order-details-page .table-container {
    width: 100%;
    margin: 0 auto;
    padding: 10px 0px 10px 0px ;
    background-color: #fff;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  }
  
  .order-details-page table {
    width: 100%;
    border-collapse:separate;
  }
  .order-details-page .table-container tfoot tr:last-child td{
    border-bottom: none;
  }
  
  .order-details-page th,.order-details-page  td {
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
  
  
  
  .order-details-page .order-tracking{
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