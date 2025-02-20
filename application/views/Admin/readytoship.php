<?php $this->load->View('Admin/header') ?>
<div class="content">
    <div class="d-flex justify-content-between align-items-center my-3">
        <h1 class="dash-head1">Order History</h1>

    </div>
    <div class="main-name-page">
        <h3>Ready To Ship List</h3>
        <div class="pages-buttons">
            <a href="<?=base_url('orderHistory/1')?>" class="page-tab" id="pendingTab">
                Pending

            </a>
            <a href="<?= base_url('readytoship/1')?>" class="page-tab active" id="readyToShipTab">
                Ready to Ship
                <p><?= $orders['meta']['pagination']['total']?></p>
            </a>
            <a href="<?= base_url('shipped/1')?>" class="page-tab" id="shippedTab">
                Shipped

            </a>
            <a href="<?= base_url('cancelled/1')?>" class="page-tab" id="cancelledTab">
                Cancelled
            </a>
        </div>
    </div>
    <div class="ship-filter">
        <div class="filters-by">
            <div class="mains-filt">
                <h3> Filter by :</h3>
                <select class="main-filters">
                    <option>Label Download</option>
                    <option>Yes</option>
                    <option> No </option>
                </select>

                <select class="main-filters">
                    <option>All Filters</option>
                    <option>Yes</option>
                    <option> No </option>
                </select>
            </div>
        </div>
        <div class="ships-by">
            <div class="shorts-filter">
                <h3>Sort by :</h3>
                <select class="main-filters">
                    <option>SKU ID</option>
                    <option>Yes</option>
                    <option> No </option>
                </select>

                <input type="text" placeholder="SKU ID">
            </div>
        </div>
    </div>
    <div class="row g-3">
        <div class="col-12">
            <div class="table-header d-flex justify-content-between align-items-center ms-4">
                <div class="headings">
                </div>
            </div>
            <div class="table-wrapper col-12 bg-white p-3 rounded">
                <div class="pb-2">
                    <table id="Order-History-readyto" class="table hover">
                        <thead>

                            <tr>
                                <th><input type="checkbox" value=""></th>
                                <th>Product Details</th>
                                <th>Sub Order ID</th>
                                <th>SKU ID</th>
                                <th>Manchaha ID</th>
                                <th>Size</th>
                                <!-- <th>Order Date</th> -->
                                <th>Quantity</th>
                                <th>Dispatch Date/SLA </th>
                                <th>Action</th>
                                <th>Courier Partner</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($orders['data'] as $order) {?>
                            <tr>
                                <td><input type="checkbox" value=""></td>
                                <td style="white-space: normal;">
                                    <div class="products1"
                                        style="display: flex; width: 350px; text-align: left; gap: 8px ">
                                        <img src="<?= isset($order['products'][0]['image']['image']) ? $order['products'][0]['image']['image']: '' ?>"
                                            width="45px" class="vieews">
                                        <p style="margin-bottom: 0px"><?= $order['products'][0]['name']?></p>
                                    </div>
                                </td>
                                <td><?= $order['id']?></td>
                                <td><?= $order['products'][0]['channel_sku']?></td>
                                <td><?= $order['shipments'][0]['id']?></td>
                                <td>Free Size</td>
                                <td><?= $order['products'][0]['quantity']?></td>
                                <td>
                                    <?php
                                      $numberOfDays = intval($order['sla']);
                                      $currentDate = new DateTime('now');
                                      $currentDate->add(new DateInterval("P{$numberOfDays}D"));
                                      echo $currentDate->format('d-m-Y');
                                      if ($currentDate>= new DateTime('now')) {
                                       echo'<p class="breached">Breaching Soon</p>';
                                      }elseif ($currentDate<= new DateTime('now')) {
                                        echo'<p class="breached">Breached</p>';
                                      }
                                    ?>

                                </td>
                                <td>
                                    <div class="status-buttons">
                                        <div class="label-download-buttons">
                                            <button onclick="downloadLabel('<?= $order['shipments'][0]['id']?>')"
                                                class="labels">
                                                <img src="<?= base_url('assets/images/label.png')?>" alt="View"
                                                    width="20px">Label
                                            </button>
                                            <?php if($order['status_code']==4){?>
                                            <p style="color: green; margin-bottom:0px;">Downloaded</p>
                                            <?php }else{?>
                                            <p style="color: red; margin-bottom:0px;">Not Downloaded</p>
                                            <?php }?>
                                        </div>
                                    </div>
                                </td>
                                <td> <span class="cancel" id="deliveryieh">
                                        <img src="<?= base_url('assets/images/delivery.png') ?>" alt="View"
                                            width="20px"> <?= $order['shipments'][0]['sr_courier_name']?>
                                    </span>
                                </td>
                            </tr>
                            <?php }?>


                        </tbody>
                    </table>


                    <div class="order-history-paging" style="display: flex; justify-content: end;">
                        <ul class="page" style="display: flex; list-style: none; gap: 14px; margin: 19px 0px; cursor: pointer; font-size: 18px; align-items: center;">
                            <!-- Previous Button -->
                            <li class="page__btn <?php if($orders['meta']['pagination']['current_page'] == 1) echo 'disabled'; ?>"
                                data-page="<?= $orders['meta']['pagination']['current_page'] - 1 ?>"
                                onclick="window.location.href='<?= base_url('readytoship/' . ($orders['meta']['pagination']['current_page'] - 1)) ?>'">
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
                                    echo "<li class='page__numbers $activeClass' onclick=\"window.location.href='" . base_url('readytoship/' . $i) . "'\" data-page='$i'>$i</li>";
                                }
                                if ($endPage < $orders['meta']['pagination']['total_pages']) {
                                    echo "<li class='page__dots'>...</li>";
                                    echo "<li class='page__numbers' onclick=\"window.location.href='" . base_url('readytoship/' . $orders['meta']['pagination']['total_pages']) . "'\" data-page='{$orders['meta']['pagination']['total_pages']}'>{$orders['meta']['pagination']['total_pages']}</li>";
                                }
                                ?>
                            <li class="page__btn <?php if ($orders['meta']['pagination']['current_page'] == $orders['meta']['pagination']['total_pages']) echo 'disabled'; ?>"
                                data-page="<?= $orders['meta']['pagination']['current_page'] + 1 ?>"
                                onclick="window.location.href='<?= base_url('readytoship/' . ($orders['meta']['pagination']['current_page'] + 1)) ?>'">
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/js/all.min.js"></script>
<script src="<?= base_url('assets/javascript/common.js') ?>"></script>
<script>
$(document).ready(function() {
    $('#Order-History-readyto').DataTable({
        searching: true,
        paging: false
    });
});

function downloadLabel(shipmentID) {
    // Check if the shipmentID is valid
    if (!shipmentID) {
        alert('Invalid shipment ID. Please provide a valid shipment ID.');
        return;
    }
    const shipmentIDs = [shipmentID];
    $.ajax({
        url: '<?= base_url('generateLabel') ?>',
        type: 'POST',
        contentType: 'application/json',
        data: JSON.stringify(shipmentIDs),
        success: function(response) {

            try {
                const res = typeof response === 'string' ? JSON.parse(response) : response;

                if (res.label_created === 1) {
                    window.location.href = res.label_url;
                    schedulePickup(shipmentID);

                    

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
            alert('Failed to download label. Please try again.');
        }
    });
	window.location.reload();
}

function schedulePickup(shipmentIDs) {
    const shipment_id = [shipmentIDs];
    $.ajax({
        url: '<?= base_url('SchedulePickup') ?>',
        type: 'POST',
        contentType: 'application/json',
        data: JSON.stringify(shipment_id),
        success: function(response) {
            console.log('Server Response:', response);

            try {
                const res = typeof response === 'string' ? JSON.parse(response) : response;

                if (res.status === 'success') {
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
            alert('Failed to download label. Please try again.');
        }
    });
}
</script>
</body>
<style>
.table-wrapper {
    width: 100%;
    overflow-x: scroll;
    text-align: left;
}

.table-wrapper::-webkit-scrollbar {
    display: none;
}

.table-wrapper {
    -ms-overflow-style: none;
    scrollbar-width: none;
}

#Order-History-readyto {
    width: 100%;
    white-space: nowrap;

}

table tr td,
table tr th {
    text-align: center !important;
}

.dataTables_wrapper .dataTables_filter input {
    display: none;
}
</style>

</html>