<?php $this->load->View('Admin/header') ?>
<div class="content">
    <div class="d-flex justify-content-between align-items-center my-3">
        <h1 class="dash-head1">Order Returns</h1>
    </div>
    <div class="cards-return">
        <div class="graph-cards">
            <div class="main-returns">
                <div class="cadss">
                    <h2>35%</h2>
                </div>
                <div class="return-rate">
                    <p>Customer Return Rate</p>
                    <h3>₹ 5,210.00</h3>
                    <p id="greens">25,10 %</p>
                </div>
            </div>
            <p id="border-bottom">111 orders returned out of 403 delivered</p>
        </div>
        <div class="graph-cards">
            <div class="main-returns">
                <div class="cadss">
                    <h2>15%</h2>
                </div>
                <div class="return-rate">
                    <p>Customer Return Rate</p>
                    <h3>₹ 5,210.00</h3>
                    <p id="reds">25,10 %</p>
                </div>
            </div>
            <p id="border-bottom">111 orders returned out of 403 delivered</p>
        </div>
        <div class="graph-cards">
            <div class="main-returns">
                <div class="cadss">
                    <h2>00%</h2>
                </div>
                <div class="return-rate">
                    <p>Customer Return Rate</p>
                    <h3>₹ 5,210.00</h3>
                    <p id="markss">25,10 %</p>
                </div>
            </div>
            <p id="border-bottom">111 orders returned out of 403 delivered</p>
        </div>
    </div>
    <div class="main-name-page">
        <h3>Return/RTO Orders</h3>
        <div class="pages-buttons">
            <a href="<?=base_url('returnorder')?>" class="page-tab active" id="pendingTab">
                Overview
                <p>6</p>
            </a>
            <a href="<?= base_url('returntracking')?>" class="page-tab" id="readyToShipTab">
            Return Tracking  
            <a href="<?= base_url('returntracking')?>" class="page-tab" id="readyToShipTab">
            Return Tracking  
            
        </a>
       <!-- <a href="<?= base_url('/')?>" class="page-tab" id="shippedTab">
            Shipped
            
        </a>
        <a href="<?= base_url('/')?>" class="page-tab" id="cancelledTab">
            Cancelled
           
        </a> -->
        </div>
    </div>

    <div class="row g-3">
        <div class="col-12">
            <div class="table-header d-flex justify-content-between align-items-center ms-4">
                <div class="headings">
                    <!-- <h3>Order History List</h3> -->
                </div>
            </div>
            <div class="table-wrapper col-12 bg-white p-3 rounded">
                <div class="pb-2">
                    <table id="Order-History-return" class="table hover returns">
                        <thead>
                            <tr>
                                <!-- <th>S.No.</th> -->
                                <th>Product Name</th>
                                <th>Product ID</th>
                                <th>Category</th>
                                <th>Orders Delivered</th>
                                <!-- <th>Order Date</th> -->
                                <th>Return</th>
                                <th>What Changed</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="white-space: normal;">
                                    <div class="products1"
                                        style="display: flex; width: 350px; text-align: left; gap: 8px ">
                                        <img src="<?= base_url('assets/images/product1.png') ?>" alt="View" width="45px"
                                            class="vieews">
                                        <p style="margin-bottom: 0px">Fashion Jewellers Bridal Radiance Jewellery Combo
                                            Set | gold plated jewellery set for women</p>
                                    </div>
                                </td>
                                <td>DC12#123</td>
                                <td>Women</td>
                                <td>456 Orders</td>
                                <td>
                                    <div class="total-returns">
                                        <p style="font-weight: 500;">25.00%</p>
                                        <p>28 Returns</p>
                                    </div>
                                </td>
                                <!-- <td>7.10%</td> -->
                                <td><span class="colors">7.10%</span>Returns increased compared to the last month</td>
                                <td>
                                    <div class="status-buttons">
                                        <button class="accept">
                                            View Details
                                        </button>
                                    </div>
                                </td>
                            </tr>


                            <tr>
                                <td style="white-space: normal;">
                                    <div class="products1"
                                        style="display: flex; width: 350px; text-align: left; gap: 8px ">
                                        <img src="<?= base_url('assets/images/product1.png') ?>" alt="View" width="45px"
                                            class="vieews">
                                        <p style="margin-bottom: 0px">Fashion Jewellers Bridal Radiance Jewellery Combo
                                            Set | gold plated jewellery set for women</p>
                                    </div>
                                </td>
                                <td>DC12#123</td>
                                <td>Women</td>
                                <td>456 Orders</td>
                                <td>
                                    <div class="total-returns">
                                        <p style="font-weight: 500;">25.00%</p>
                                        <p>28 Returns</p>
                                    </div>
                                </td>
                                <!-- <td>7.10%</td> -->
                                <td><span class="colors">7.10%</span>Returns increased compared to the last month</td>
                                <td>
                                    <div class="status-buttons">
                                        <button class="accept">
                                            View Details
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="white-space: normal;">
                                    <div class="products1"
                                        style="display: flex; width: 350px; text-align: left; gap: 8px ">
                                        <img src="<?= base_url('assets/images/product1.png') ?>" alt="View" width="45px"
                                            class="vieews">
                                        <p style="margin-bottom: 0px">Fashion Jewellers Bridal Radiance Jewellery Combo
                                            Set | gold plated jewellery set for women</p>
                                    </div>
                                </td>
                                <td>DC12#123</td>
                                <td>Women</td>
                                <td>456 Orders</td>
                                <td>
                                    <div class="total-returns">
                                        <p style="font-weight: 500;">25.00%</p>
                                        <p>28 Returns</p>
                                    </div>
                                </td>
                                <!-- <td>7.10%</td> -->
                                <td><span class="colors">7.10%</span>Returns increased compared to the last month</td>
                                <td>
                                    <div class="status-buttons">
                                        <button class="accept">
                                            View Details
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="white-space: normal;">
                                    <div class="products1"
                                        style="display: flex; width: 350px; text-align: left; gap: 8px ">
                                        <img src="<?= base_url('assets/images/product1.png') ?>" alt="View" width="45px"
                                            class="vieews">
                                        <p style="margin-bottom: 0px">Fashion Jewellers Bridal Radiance Jewellery Combo
                                            Set | gold plated jewellery set for women</p>
                                    </div>
                                </td>
                                <td>DC12#123</td>
                                <td>Women</td>
                                <td>456 Orders</td>
                                <td>
                                    <div class="total-returns">
                                        <p style="font-weight: 500;">25.00%</p>
                                        <p>28 Returns</p>
                                    </div>
                                </td>
                                <!-- <td>7.10%</td> -->
                                <td><span class="colors">7.10%</span>Returns increased compared to the last month</td>
                                <td>
                                    <div class="status-buttons">
                                        <button class="accept">
                                            View Details
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="white-space: normal;">
                                    <div class="products1"
                                        style="display: flex; width: 350px; text-align: left; gap: 8px ">
                                        <img src="<?= base_url('assets/images/product1.png') ?>" alt="View" width="45px"
                                            class="vieews">
                                        <p style="margin-bottom: 0px">Fashion Jewellers Bridal Radiance Jewellery Combo
                                            Set | gold plated jewellery set for women</p>
                                    </div>
                                </td>
                                <td>DC12#123</td>
                                <td>Women</td>
                                <td>456 Orders</td>
                                <td>
                                    <div class="total-returns">
                                        <p style="font-weight: 500;">25.00%</p>
                                        <p>28 Returns</p>
                                    </div>
                                </td>
                                <!-- <td>7.10%</td> -->
                                <td><span class="colors">7.10%</span>Returns increased compared to the last month</td>
                                <td>
                                    <div class="status-buttons">
                                        <button class="accept">
                                            View Details
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="white-space: normal;">
                                    <div class="products1"
                                        style="display: flex; width: 350px; text-align: left; gap: 8px ">
                                        <img src="<?= base_url('assets/images/product1.png') ?>" alt="View" width="45px"
                                            class="vieews">
                                        <p style="margin-bottom: 0px">Fashion Jewellers Bridal Radiance Jewellery Combo
                                            Set | gold plated jewellery set for women</p>
                                    </div>
                                </td>
                                <td>DC12#123</td>
                                <td>Women</td>
                                <td>456 Orders</td>
                                <td>
                                    <div class="total-returns">
                                        <p style="font-weight: 500;">25.00%</p>
                                        <p>28 Returns</p>
                                    </div>
                                </td>
                                <!-- <td>7.10%</td> -->
                                <td><span class="colors">7.10%</span>Returns increased compared to the last month</td>
                                <td>
                                    <div class="status-buttons">
                                        <button class="accept">
                                            View Details
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="white-space: normal;">
                                    <div class="products1"
                                        style="display: flex; width: 350px; text-align: left; gap: 8px ">
                                        <img src="<?= base_url('assets/images/product1.png') ?>" alt="View" width="45px"
                                            class="vieews">
                                        <p style="margin-bottom: 0px">Fashion Jewellers Bridal Radiance Jewellery Combo
                                            Set | gold plated jewellery set for women</p>
                                    </div>
                                </td>
                                <td>DC12#123</td>
                                <td>Women</td>
                                <td>456 Orders</td>
                                <td>
                                    <div class="total-returns">
                                        <p style="font-weight: 500;">25.00%</p>
                                        <p>28 Returns</p>
                                    </div>
                                </td>
                                <!-- <td>7.10%</td> -->
                                <td><span class="colors">7.10%</span>Returns increased compared to the last month</td>
                                <td>
                                    <div class="status-buttons">
                                        <button class="accept">
                                            View Details
                                        </button>
                                    </div>
                                </td>
                            </tr>

                        </tbody>
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
$(document).ready(function() {
    $('#Order-History-return').DataTable({
        searching: true,
        paging: false
    });
});
</script>
<script>
// Wait for the DOM to be fully loaded
document.addEventListener('DOMContentLoaded', function () {
    // Select all the redirect-tab elements
    const tabs = document.querySelectorAll('.redirect-tab');

    // Set the first tab as active by default
    tabs[0].classList.add('active');

    // Add event listeners to each tab to toggle the active state on click
    tabs.forEach(tab => {
        tab.addEventListener('click', function () {
            // Remove 'active' class from all tabs
            tabs.forEach(t => t.classList.remove('active'));

            // Add 'active' class to the clicked tab
            tab.classList.add('active');
        });
    });
});


</script>
<script>
// Wait for the DOM to be fully loaded
document.addEventListener('DOMContentLoaded', function () {
    // Select all the redirect-tab elements
    const tabs = document.querySelectorAll('.redirect-tab');

    // Set the first tab as active by default
    tabs[0].classList.add('active');

    // Add event listeners to each tab to toggle the active state on click
    tabs.forEach(tab => {
        tab.addEventListener('click', function () {
            // Remove 'active' class from all tabs
            tabs.forEach(t => t.classList.remove('active'));

            // Add 'active' class to the clicked tab
            tab.classList.add('active');
        });
    });
});


</script>
</body>

</html>











<style>
.dataTables_wrapper .dataTables_filter {
    right: 1vw;
}

.additional-fields {
    display: none;
    margin-top: 10px;
}

.dataTables_wrapper .dataTables_filter input {
    display: none;
}

table tr td,
table tr th {
    text-align: left;
}

#popup-form {
    display: none;
}

.model {
    z-index: 10000000;
}

select {
    border: 0px;
    background-color: transparent;
}

.dispatch-select {
    border-radius: 32px;
    padding: 5px 10px;
    background-color: rgba(227, 232, 243, 1);
    font-family: 'Poppins';
    font-size: 12px;
    font-weight: 500;
    line-height: 18px;
    width: 115px;

}

.uploadpdf-btn {
    background: #D0DCEB;
    border-radius: 10px;
    height: 70px;
    width: 200px;
    margin-top: 23px !important
}

#imageContainer img {
    width: 30px;
}

.order-status .copy-btn {
    position: absolute;
    right: 0px;
    bottom: 0px;
    font-size: 12px;

}

.returns {
    white-space: nowrap !important;
}

.table-wrapper {
    width: 100%;
    overflow: scroll;
}

.table-wrapper::-webkit-scrollbar {
    display: none;
}

/* table tr td,
table tr th {
    text-align: left;
    overflow: scroll;
} */
</style>