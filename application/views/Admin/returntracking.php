<?php $this->load->View('Admin/header') ?>
<div class="content">
    <div class="d-flex justify-content-between align-items-center my-3">
        <h1 class="dash-head1">Order Returns</h1>
    </div>
    <div class="main-name-page">
        <h3>Return/RTO Orders</h3>
        <div class="pages-buttons">
            <!-- <a href="<?=base_url('returnorder')?>" class="page-tab" id="pendingTab">
                Overview
                <p>6</p>
            </a> -->
            <a href="<?= base_url('returntracking/new')?>" class="page-tab active" id="readyToShipTab">
                Return Tracking

            </a>
            <!--  <a href="<?= base_url('/')?>" class="page-tab" id="shippedTab">
            Shipped
            
        </a>
        <a href="<?= base_url('/')?>" class="page-tab" id="cancelledTab">
            Cancelled
           
        </a> -->
        </div>
    </div>

    <div class="ship-filter return-filter">
        <div class="return-tabs">
        <a href="<?= base_url('returntracking/new')?>">
                <div class="redirect-tab">
                    <h4>New Returns</h4>
                </div>
            </a>
            <a href="<?= base_url('returntracking/pending')?>">
                <div class="redirect-tab">
                    <h4>In Transit</h4>
                </div>
            </a>
            <a href="#">
                <div class="redirect-tab">
                    <h4>Out For Delivery</h4>
                </div>
            </a>
            <a href="#">
                <div class="redirect-tab">
                    <h4>Delivered</h4>
                </div>
            </a>
            <a href="#">
                <div class="redirect-tab">
                    <h4>Lost</h4>
                </div>
            </a>
            <a href="#">
                <div class="redirect-tab">
                    <h4>Disposed</h4>
                </div>
            </a>

            <a href="<?= base_url('returntracking/new/?ret=2')?>">
                <div class="redirect-tab">
                    <h4>Disapproved</h4>
                </div>
            </a>
        </div>
        <div class="filters-by">
            <div class="mains-filt">
                <h3> Filter by :</h3>
                <select class="main-filters">
                    <option>Last Date</option>
                    <option>Yes</option>
                    <option> No </option>
                </select>

                <select class="main-filters">
                    <option>Courier Partner</option>
                    <option>Yes</option>
                    <option> No </option>
                </select>
                <select class="main-filters">
                    <option>Category</option>
                    <option>Yes</option>
                    <option> No </option>
                </select>
                <select class="main-filters">
                    <option>Return Type</option>
                    <option>Yes</option>
                    <option> No </option>
                </select>
            </div>
        </div>
        <div class="ships-by">
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
                                <th> User Name</th>
                                <th>Product Details</th>
                                <th>Suborder ID</th>
                                <th>Payment Status</th>
                                <th>Return Fee</th>
                                <!-- <th>Order Date</th> -->
                                <th>Lost on</th>
                                <th>AWB Number</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($orders['data'] as $order) {?>
                            <tr>
                                <td><?= $order['customer_name']?></td>
                                <td style="white-space: normal;">
                                    <div class="products1"
                                        style="display: flex; width: 350px; text-align: left; gap: 8px ">
                                        <img src="<?= base_url('assets/images/product1.png') ?>" alt="View" width="45px"
                                            class="vieews">
                                        <p style="margin-bottom: 0px"><?= $order['products'][0]['name']?></p>
                                    </div>
                                </td>
                                <td><?= $order['channel_order_id']?></td>
                                <td><?= $order['status']?></td>
                                <td>₹ <?= isset($order['return_fee']) ? $order['return_fee']: '0'?> </td>
                                <td>
                                    <div class="total-returns">
                                        <p style="font-weight: 500;">7 Jan 2025</p>
                                    </div>
                                </td>
                                <!-- <td>7.10%</td> -->
                                <td><?= isset($order['shipments']['awb'])?></td>
                                <td>
                                    <div class="status-buttons">
                                        <button class="accepts" onclick="viewdetails('<?= $order['id']?>')">
                                            View Details
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <?php }?>



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


function viewdetails(awb)
{
    window.location.href = '<?= base_url('viewdetails/')?>'+awb;
}
</script>
<script>
$(document).ready(function () {
    // Function to set active tab based on path or localStorage
    function setActiveTabByPath(path) {
        let activeTab = localStorage.getItem('activeTab'); // Get the stored active tab

        // If there's no active tab stored, set the "In Transit" tab as active by default
        if (!activeTab) {
            activeTab = $('.return-tabs a').eq(0).attr('href'); // Get the href of the first tab (In Transit)
            localStorage.setItem('activeTab', activeTab); // Store the "In Transit" tab as active
        }

        $('.return-tabs a').each(function () {
            const $tab = $(this);
            const hrefPath = $tab.attr('href');

            if (path.includes(hrefPath) || hrefPath === activeTab) {
                $('.return-tabs a').find('h4').removeClass('active-tab');
                $tab.find('h4').addClass('active-tab'); 
            }
        });
    }

    const currentPath = window.location.pathname;
    localStorage.removeItem('activeTab');
    setActiveTabByPath(currentPath);

    $('.return-tabs a').on('click', function (event) {

        const href = $(this).attr('href');
        localStorage.setItem('activeTab', href);

        // Update active class on <h4> inside clicked tab
        $('.return-tabs a').find('h4').removeClass('active-tab');
        $(this).find('h4').addClass('active-tab');
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

table tr th {
    text-align: left;
}

table tr td {
    text-align: center;
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