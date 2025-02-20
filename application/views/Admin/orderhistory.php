<?php $this->load->View('Admin/header') ?>
<div class="content">
    <div class="d-flex justify-content-between align-items-center my-3">
        <h1 class="dash-head1">Order History</h1>

    </div>
    <div class="main-name-page">
        <h3>Pending List</h3>
        <div class="pages-buttons">
            <a href="<?=base_url('orderHistory/1')?>" class="page-tab active" id="pendingTab">
                Pending
                <p><?= $orders['meta']['pagination']['total']?></p>
            </a>
            <a href="<?= base_url('readytoship/1')?>" class="page-tab" id="readyToShipTab">
                Ready to Ship

            </a>
            <a href="<?= base_url('shipped/1')?>" class="page-tab" id="shippedTab">
                Shipped

            </a>
            <a href="<?= base_url('cancelled/1')?>" class="page-tab" id="cancelledTab">
                Cancelled

            </a>
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
                <div class="pb-2 ordertables" style="width: 100%; overflow: scroll;">
                    <table id="Order-History-Table" class="table hover">
                        <thead>
                            <tr>
                                <th>S.No.</th>
                                <th>Customer Name</th>
                                <th>Order ID</th>
                                <th>SKU ID</th>
                                <th>Phone N0.</th>
                                <th>Email ID</th>
                                <!-- <th>Order Date</th> -->
                                <th>Quantity</th>
                                <th>Payment </th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($orders['data'] as $key=> $order){ ?>


                            <tr>
                                <td><?= $key+1?></td>
                                <td><?= isset($order['customer_name']) ? $order['customer_name'] : '-' ?></td>
                                <td><?= isset($order['id']) ? $order['id'] : '-' ?></td>
                                <td> <?= $order['products'][0]['channel_sku']?></td>
                                <td><?= $order['customer_phone'] ?></td>
                                <td><?= $order['customer_email'] ?></td>
                                <!-- <td><?= $order['order_details']['order_date'] ?></td> -->
                                <td><?= $order['products'][0]['quantity'] ?></td>
                             
								<td><?= $order['total'] ?>
                                    <?=strtoupper($order['payment_method'])?>

                                </td>
                                <td>
                                    <div class="status-buttons">
                                        <button
                                            onclick="assignAwb('<?= $order['customer_pincode']?>','<?= $order['others']['weight']?>','<?= $order['cod']?>','<?= $order['shipments'][0]['id']?>')"
                                            class="accept">
                                            Accept
                                        </button>
                                        <button onclick="cancelOrder('<?= $order['id']?>')" class="cancel">
                                            Cancel
                                        </button>
                                    </div>
                                </td>
                                <td>
                                    <div class="action-icons">
                                        
                                        <!-- <a href="#" -->
                                         <a href="<?= base_url('Web/Admin/Admin/OrderDetails/').$order['shipments'][0]['id'] ?>"
                                            class="icon eye-icon" title="View"><img
                                                src="<?= base_url('assets/images/eye.png') ?>" alt="View"
                                                width="20px"></a>
                                    </div>
                                </td>
                            </tr>
                            <?php } ?>


                        </tbody>
                    </table>

                    <div class="order-history-paging" style="display: flex; justify-content: end;">
                        <ul class="page" style="display: flex; list-style: none; gap: 14px; margin: 19px 0px; cursor: pointer; font-size: 18px; align-items: center;">
                            <!-- Previous Button -->
                            <li class="page__btn <?php if($orders['meta']['pagination']['current_page'] == 1) echo 'disabled'; ?>
                                data-page="<?= $orders['meta']['pagination']['current_page'] - 1 ?>"
                                onclick="window.location.href='<?= base_url('orderHistory/' . ($orders['meta']['pagination']['current_page'] - 1)) ?>'">
                                <i class="fa-solid fa-chevron-left"></i>
                            </li>

                            <?php 
                                $maxPagesToDisplay = 5; // Number of pages to display
                                $startPage = max(1, $orders['meta']['pagination']['current_page'] - floor($maxPagesToDisplay / 2));
                                $endPage = min($orders['meta']['pagination']['total_pages'], $orders['meta']['pagination']['current_page'] + floor($maxPagesToDisplay / 2));
                                if ($endPage - $startPage < $maxPagesToDisplay - 1) {
                                    $startPage = max(1, $endPage - $maxPagesToDisplay + 1);
                                }

                                for ($i = $startPage; $i <= $endPage; $i++) {
                                    $activeClass = ($i == $orders['meta']['pagination']['current_page']) ? 'active' : '';
                                    echo "<li class='page__numbers $activeClass' onclick=\"window.location.href='" . base_url('orderHistory/' . $i) . "'\" data-page='$i'>$i</li>";
                                }
                                if ($endPage < $orders['meta']['pagination']['total_pages']) {
                                    echo "<li class='page__dots'>...</li>";
                                    echo "<li class='page__numbers' onclick=\"window.location.href='" . base_url('orderHistory/' . $orders['meta']['pagination']['total_pages']) . "'\" data-page='{$orders['meta']['pagination']['total_pages']}'>{$orders['meta']['pagination']['total_pages']}</li>";
                                }
                                ?>
                            <li class="page__btn <?php if ($orders['meta']['pagination']['current_page'] == $orders['meta']['pagination']['total_pages']) echo 'disabled'; ?>"
                                data-page="<?= $orders['meta']['pagination']['current_page'] + 1 ?>"
                                onclick="window.location.href='<?= base_url('orderHistory/' . ($orders['meta']['pagination']['current_page'] + 1)) ?>'">
                                <i class="fa-solid fa-chevron-right"></i>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<!-- Modal generate label -->
<div id="labelGenerateBookingModal" class="label-generate-modal">
    <div class="label-generate-modal-content">
        <div style="border-bottom: 1px solid #ccc; padding-bottom: 5px;">
            <span class="label-generate-close" onclick="closeLabelGenerateBookingModal()">&times;</span>
            <div class="label-generate-modal-header">
                <h2>Accepting Orders</h2>
            </div>
        </div>
        <div class="model-para">
            <p>Once you accept orders it will be moved to the 'Ready to Ship' tab.</p>
        </div>
        <div class="label-generate-button">
            <a href="#" class="label-generate-buttons" id="acceptLabelbokking"> Accept Order </a>
            <a href="#" class="label-generate-buttons" id="cancelLabelbokking"> Close </a>
        </div>
    </div>
</div>

<!-- Accept Order Modal -->
<div id="accept-order" class="label-generate-modal">
    <div class="label-generate-modal-content">
        <div style="border-bottom: 1px solid #ccc; padding-bottom: 5px;">
            <span class="label-generate-close" onclick="closeacceptordermodel()">&times;</span>
            <div class="label-generate-modal-header">
                <h2>Accepting Orders</h2>
            </div>
        </div>
        <div class="model-para">
            <p><span class="mains-process">L</span> processing...</p>
        </div>
        <div class="processing-bottom">
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
function openLabelGenerateBookingModal() {
    document.getElementById("labelGenerateBookingModal").style.display = "block";
}

function closeLabelGenerateBookingModal() {
    document.getElementById("labelGenerateBookingModal").style.display = "none";
}

function openacceptordermodel() {
    document.getElementById("labelGenerateBookingModal").style.display = "none";
    document.getElementById("accept-order").style.display = "block";
}

function closeacceptordermodel() {
    document.getElementById("accept-order").style.display = "none";
}


$(document).ready(function() {
    $('#Order-History-Table').DataTable({
        searching: true,
        paging: false,
        "initComplete": function(settings, json) {
            $('#Order-History-Table_filter input').attr('placeholder', 'Search Product name here');
        },
        "createdRow": function(row, data, dataIndex) {
            const stockCell = $('td', row).eq(6);
            if (stockCell.text().includes('In Stock')) {
                stockCell.css('color', 'blue');
            } else if (stockCell.text().includes('Out Stock')) {
                stockCell.css('color', 'red');
            }
        }


    });
    // Apply color to select options
    $('#Order-History-Table').on('change', '.select-status', function() {
        const option = $(this).find('option:selected');
        if (option.hasClass('pending')) {
            $(this).css('color', 'orange');
        } else if (option.hasClass('delivered')) {
            $(this).css('color', 'green');
        } else if (option.hasClass('cancel')) {
            $(this).css('color', 'red');
        }
    });
});


function assignAwb(pincode, totalWeight, payment_status, shipment_id) {
    // Open the modal for user confirmation
    openLabelGenerateBookingModal();

    $('#acceptLabelbokking').off('click').on('click', function() {
        openacceptordermodel();
        $.ajax({
            url: '<?= base_url('Ship/assignAwb') ?>',
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({
                pincode: pincode,
                totalWeight: totalWeight,
                payment_status: payment_status,
                shipment_id: shipment_id
            }),
            success: function(response) {
                console.log(response);
                try {
                    const res = JSON.parse(response);
                    if (res.status === 'success') {
                        alert('Order Accepted With AWB code ' + res.message);
                        // Close the modal if needed

                        closeacceptordermodel();
                        window.location.reload()
                    } else {
                        closeacceptordermodel();
                        alert(res.details?.message || 'Something went wrong. Please try again.');
                    }
                } catch (e) {
                    closeacceptordermodel();
                    console.error('Response Parsing Error:', e);
                    alert('Invalid response from the server. Please contact support.');
                }
            },
            error: function(xhr, status, error) {
                closeacceptordermodel();
                console.error('Request Error:', error);
                alert('Failed to accept order. Please try again.');
            }
        });
    });

    $('#cancelLabelbokking').off('click').on('click', function() {
        closeLabelGenerateBookingModal();
        return;
    });
}



function cancelOrder(shipmentID) {
    if (!shipmentID) {
        alert('Invalid shipment ID.');
        return;
    }
    $.ajax({
        url: '<?= base_url('cancel-order') ?>',
        type: 'POST',
        contentType: 'application/json',
        data: JSON.stringify({
            shipmentID: shipmentID
        }),
        success: function(response) {
            console.log(response);
            try {
                const res = JSON.parse(response);
                if (res.status === 'success') {
                    alert(res.message);
                    window.location.reload();
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
            alert('Failed to cancel order. Please try again.');
        }
    });
}
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

option.pending {
    color: rgba(236, 140, 56, 1);
}

option.delivered {
    color: rgba(37, 222, 104, 1);
}

option.cancel {
    color: rgba(236, 79, 79, 1);
}

option.shipped {
    color: rgba(46, 91, 255, 1);
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
.ordertables::-webkit-scrollbar {
    display: none; /* Hides scrollbar in WebKit browsers */
  }
</style>