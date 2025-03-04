<?php $this->load->View('Admin/header') ?>
<div class="content">
    <div class="d-flex justify-content-between align-items-center my-3">
        <!-- <h1 class="dash-head1">Order Returns</h1> -->
    </div>
    <div class="main-name-page">
        <h3>Return Product Details</h3>

    </div>

    <div class="row g-3">
        
        <div class="order-container">

            <div class="order-details">
                <div class="orders-new">
                    <div class="order-details-new">
                        <label><strong>User Name:</strong></label>
                        <p><?= ucwords($data['order']['name']) ?></p>
                    </div>

                    <div class="order-details-new">
                        <label><strong>Order Date:</strong></label>
                        <p>
                        <?php 
                            $formatted_date = date("d M Y", strtotime($data['order']['order_date']));
                            echo $formatted_date;
                            ?> 
                        </p>
                    </div>

                    <div class="order-details-new">
                        <label><strong>Delivery Date:</strong></label>
                        <p>
                        Not Delivered 
                        </p>
                    </div>
                    <div class="order-details-new">
                        <label><strong>Bill</strong></label>
                        <span>
                            <button type="button" onclick="downloadInvoice('<?= $data['order']['order_id'] ?>')" >Download Bill</button>
                        </span>
                    </div>
                </div>

                <div class="orders-new">
                    <div class="order-details-new pro-description">
                        <label><strong>Product Description:</strong></label>
                        <p>
                            <?= $data['order']['jwellary_description'] ?>
                        </p>
                    </div>
                </div>

                <div class="orders-new">
                    <div class="order-details-new">
                        <label><strong>Return Date:</strong></label>
                        <p>
                        <?php 
                            $formatted_date = date("d M Y", strtotime($data['order']['return_date']));
                            echo $formatted_date;
                            ?> 
                        </p>
                    </div>
                    <div class="order-details-new">
                        <label><strong>Return Reason:</strong></label>
                        <p>
                            <?= $data['order']['return_reason'] ?>
                        </p>
                    </div>
                    <div class="order-details-new">
                        <label><strong>Uploaded Image:</strong></label>
                        <div class="image-uploads">
                            <div class="image-box"> 200px</div>
                            <div class="image-box"> 200px</div>
                        </div>
                    </div>
                </div>

                <div>
                    <label><strong>Comments:</strong></label>
                    <p><?= ucfirst($data['order']['comment']) ?></p>
                </div>
            </div>
    <?php if($data['order']['is_approved'] == 1){ ?>
            <div class="admin-buttons">
                <button type="button" class="approve-btn">Approved</button>
            </div>
<?php }elseif ($data['order']['is_approved'] == 2) {?>
    <div class="admin-buttons">
    <button type="button" class="reject-btn">Rejected</button>
    </div>
<?php }else{?>
    <div class="admin-buttons">
                    <button type="button" onclick="accept_return('<?= $data['order']['order_id']?>',1 , '<?= $data['order']['order_ship']?>')" class="approve-btn">Approve Return</button>
                <button type="button" onclick="accept_return('<?= $data['order']['order_id']?>',2 , '<?= $data['order']['order_ship']?>')" class="reject-btn">Reject Return</button>
                </div>
<?php }?>
<?php if(($data['status']['tracking_data']['shipment_track_activities'])&&($data['status']['tracking_data']['shipment_track_activities']!='')){ ?>
            <div class="mains-status">
                <h3>Return Status</h3>
                <div class="tracking-status">
                    <!-- Pending Status -->
                    <div class="status pending">
                        <div class="status-box">
                            <div class="status-icon">
                                <i class="fas fa-hourglass-start"></i>
                            </div>
                            <div class="status-info">
                                <span class="status-text">Return Requested</span>
                            </div>
                        </div>
                    </div>
                    <!-- In Progress Status -->
                    <div class="status in-progress">
                        <div class="status-box">
                            <div class="status-icon">
                                <i class="fas fa-sync-alt"></i>
                            </div>
                            <div class="status-info">
                                <span class="status-text">Return in Progress</span>
                            </div>
                        </div>
                    </div>
                    <!-- Picked Up Status -->
                    <div class="status">
                        <div class="status-box">
                            <div class="status-icon">
                                <i class="fas fa-box-open"></i>
                            </div>
                            <div class="status-info">
                                <span class="status-text">Item Picked Up</span>
                            </div>
                        </div>
                    </div>
                    <!-- Completed Status -->
                    <div class="status completed">
                        <div class="status-box">
                            <div class="status-icon">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <div class="status-info">
                                <span class="status-text">Return Completed</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php }?>
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


<style>
    .order-container {
        background-color: #ffffff;
        border-radius: 8px;
        width: 96%;
        margin: 0 auto;
        margin-top: 20px;
        padding: 20px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
    }

    .order-details {
        margin-bottom: 20px;
    }

    .order-details label {
        font-weight: 500;
        display: block;
        margin: 10px 0 5px;
        font-size: 18px;
    }

    .order-details p {
        margin: 5px 0 15px;
        padding: 10px;
        background-color: #FFFFFF;
        border-radius: 4px;
        font-size: 14px;
        color: black;
        border: 1px solid #f1f1f1;
    }

    .image-uploads {
        display: flex;
        gap: 10px;
        align-items: center;
    }

    .pro-description {
        width: 50% !important;
    }

    .uploaded-image {
        margin-top: 10px;
        width: 100%;
        max-width: 200px;
        border-radius: 5px;
    }

    .admin-buttons {
        display: flex;
        justify-content: space-between;
        margin-top: 30px;
    }

    button {
        padding: 10px 15px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        width: 48%;
        background-color: rgba(74, 144, 226, 1);
        color: #FFFFFF;
        border: 1px solid #f1f1f1;
    }

    .approve-btn {
        background-color: #4CAF50;
        color: white;
    }

    .reject-btn {
        background-color: #f44336;
        color: white;
    }

    button:hover {
        opacity: 0.9;
    }

    .orders-new {
        display: flex;
        width: 100%;
        gap: 10px;
        justify-content: space-between;
    }

    .order-details-new {
        width: 32%;
    }

    .order-details-new span button {
        width: 100%;
        justify-content: start;
        display: flex;
    }

    .image-box {
        width: 80px;
        height: 50px;
        background-image: url('https://via.placeholder.com/200');
        background-size: cover;
        background-color: #f9f9f9;
        border-radius: 5px;
        justify-content: center;
        align-items: center;
        display: flex;
    }

    .mains-status {
        width: 80%;
        margin: 20px auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    h3 {
        text-align: center;
        margin-bottom: 30px;
        color: #333;
    }

    .tracking-status {
        display: flex;
        flex-direction: row;
        position: relative;
    }

    .status {
        display: flex;
        align-items: center;
        position: relative;
        padding-left: 10px;
        padding-right: 30px;
        margin-bottom: 40px;
    }

    /* Connecting Line */
    .tracking-status::before {
        content: '';
        position: absolute;
        top: 0;
        left: 50%;
        width: 4px;
        height: 100%;
        background-color: #ddd;
        z-index: -1;
    }

    .status-box {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .status-icon {
        font-size: 24px;
        margin-right: 20px;
        left: 0px;
        background-color: #fff;
        border-radius: 50%;
        padding: 10px;
        border: 2px solid #ddd;
    }

    .status-info {
        font-size: 16px;
        padding-left: 30px;
    }

    .status-text {
        font-weight: bold;
    }

    .status.pending .status-icon i {
        color: #007bff;
    }

    .status.in-progress .status-icon i {
        color: #f0ad4e;
    }

    .status.completed .status-icon i {
        color: #5cb85c;
    }

    .status.pending .status-text {
        color: #007bff;
    }

    .status.in-progress .status-text {
        color: #f0ad4e;
    }

    .status.completed .status-text {
        color: #5cb85c;
    }

    .status.active .status-icon i {
        color: blue;
    }

    .status::before {
        content: '';
        position: absolute;
        top: 25px;
        left: 50%;
        width: 4px;
        height: 60%;
        background-color: #ddd;
        z-index: -1;
    }

    .status:first-child::before {
        display: none;
    }

    .status:last-child::before {
        display: none;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        let statuses = document.querySelectorAll('.status');
        setTimeout(function() {
            statuses[0].classList.add('completed', 'active');
            statuses[1].classList.add('in-progress', 'active');
            statuses[2].classList.add('completed');
        }, 2000);

        setTimeout(function() {
            statuses[3].classList.add('completed', 'active');
        }, 4000);
    });



    // Approve Return
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