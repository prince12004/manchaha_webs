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
            <a href="#">
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
        </div>
        <div class="filters-by">
            <div class="mains-filt">
                <h3> Filter by :</h3>
                <select class="main-filters">
                    <option value="last">Last Date</option>
                </select>
            <?php $cat = $this->db->select('categories.CategoryName,categories.CategoryID')->from('categories')->get()->result_array() ?>
                <select class="main-filters" onchange="filterbycat(this.value)" >
                    <option>Category</option>
                    <?php foreach ($cat as $category) {?>
                        <option value="<?= $category['CategoryID']?>" ><?= $category['CategoryName']?></option>
                    <?php }?>
                    
                    <option> No </option>
                </select>
                <select class="main-filters" onchange="filterOrder(this.value)" >
                    <option>Return Type</option>
                    <option value="1">Return</option>
                    <option value="2">Exchange</option>
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
                                <th>Order Date</th>
                                
                              
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($orders['data'] as $order) {?>
                            <tr>
                                <td><?= ucwords($order['address_name'])?></td>
                                <td style="white-space: normal;">
                                    <div class="products1"
                                        style="display: flex; width: 350px; text-align: left; gap: 8px ">
                                        <img src="<?= base_url('uploads/products/').$order['thumbnail'] ?>" alt="View" width="45px"
                                            class="vieews">
                                        <p style="margin-bottom: 0px"><?= strlen($order['jwellary_name']) > 40 ? substr($order['jwellary_name'], 0, 40) . '...' : $order['jwellary_name']; ?>
                                        </p>
                                    </div>
                                </td>
                                <td><?= $order['order_id']?></td>
                                <td><?= $order['payment_type']?></td>
                                <td>₹ <?= isset($order['return_fee']) ? $order['return_fee']: '0'?> </td>
                                <td>
                                    <div class="total-returns">
                                        <p style="font-weight: 500;">
                                            <?php 
                                            $formatted_date = date("d M Y", strtotime($order['order_date']));

                                            echo $formatted_date;
                                            ?>
                                        </p>
                                    </div>
                                </td>
                               
                                <td>
                                    <div class="status-buttons">
                                        <div style="display: flex; flex-direction:column; ">
                                        <button class="accepts" onclick="accept_return('<?= $order['order_id']?>',1 , '<?= $order['shipment_id']?>')">
                                            Accept
                                        </button>
                                        <button class="accepts" onclick="accept_return('<?= $order['order_id']?>',2 , '<?= $order['shipment_id']?>')">
                                            Decline
                                        </button>
                                        <button class="accepts" onclick="viewdetails('<?= isset($order['shipments']['awb'])?>')">
                                            View Details
                                        </button>
                                        </div>
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
    window.location.href = '<?= base_url('viewdetails')?>'+awb;
}

function filterbycat(id){
    window.location.href = '<?= base_url('returntracking/new/') ?>' + '?category=' + encodeURIComponent(id);
}
function filterOrder(id){
    window.location.href = '<?= base_url('returntracking/new/') ?>' + '?order=' + encodeURIComponent(id);
}

function accept_return(id,res,shipment_id)
{
    console.log(id);
    $.ajax({
        url: "<?= base_url('accept-return') ?>",
        type: "POST",
        data: { return_id: id,res:res,shipment_id:shipment_id},
        success: function(response) {
        // window.location.reload();
        }
    });
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

        // Loop through each redirect-tab and set active class on <h4>
        $('.return-tabs a').each(function () {
            const $tab = $(this);
            const hrefPath = $tab.attr('href');

            // If the current URL matches the href or it's the stored active tab, mark it as active
            if (path.includes(hrefPath) || hrefPath === activeTab) {
                $('.return-tabs a').find('h4').removeClass('active-tab'); // Remove active from all <h4>
                $tab.find('h4').addClass('active-tab'); // Add active to the current <h4>
            }
        });
    }

    // Get the current page's URL path
    const currentPath = window.location.pathname;

    // Always clear the localStorage on page load to match the correct path
    localStorage.removeItem('activeTab');

    // Set active state based on current path (matches the correct page after redirect)
    setActiveTabByPath(currentPath);

    // When a tab is clicked, update localStorage with the new active link
    $('.return-tabs a').on('click', function (event) {
        event.preventDefault(); // Prevent default action to ensure we handle state

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