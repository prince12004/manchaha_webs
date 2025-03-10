<?php $this->load->view('Admin/header') ?>
<div class="vendor-page content">
    <div class="d-flex  justify-content-between align-items-center my-3">
        <h1 class="dash-head1">Bulk Orders</h1>
    </div>
    <!-- stat-box -->
    <div class="stat-box-row-1 g-1 col-12 mb-3 d-flex ">
        <div class="cards ">
            <div class="stat-box-1 p-3 text-center bg-light rounded">
                <img src="<?= base_url('/assets/images/newOrder.png') ?>" alt="icon" width="42px">
                <h3>New Order </h3>
                <p><?= $orders['stats']['new']?></p>
                <div class="percent-stat d-flex gap-2">
                    <!-- <div class="green d-flex align-items-center">
                        <span class=" arrow-icon material-symbols-outlined">
                            arrow_upward
                        </span>
                        0%
                    </div> 
                    <span>Super Admin</span>-->
                </div>
            </div>
        </div>
        <div class="cards ">
            <div class="stat-box-1 p-3 text-center bg-light rounded">
                <img src="<?= base_url('/assets/images/orderDelivered.png') ?>" alt="icon" width="42px">
                <h3>Contacted</h3>
                <p><?= $orders['stats']['contacted']?></p>
                <div class="percent-stat d-flex gap-2">
                    <!-- <div class="green d-flex align-items-center"> <span class=" arrow-icon material-symbols-outlined">
                            arrow_upward
                        </span>0%</div> Super Admin -->
                </div>
            </div>
        </div>
        <div class="cards ">
            <div class="stat-box-1 p-3 text-center bg-light rounded">
                <img src="<?= base_url('/assets/images/orderPending.png') ?>" alt="icon" width="42px">
                <h3>Fulfilled Orders</h3>
                <p><?= $orders['stats']['fulfilled']?></p>
                <!-- <span class="percent-stat d-flex gap-2"><span class="red d-flex align-items-center"><span
                            class=" arrow-icon material-symbols-outlined">
                            arrow_downward
                        </span>0%</span> Super Admin</span> -->
            </div>
        </div>
        <div class="cards ">
            <div class="stat-box-1 p-3 text-center bg-light rounded">
                <img src="<?= base_url('/assets/images/orderConfirm.png') ?>" alt="icon" width="42px">
                <h3>Denied Order</h3>
                <p><?= $orders['stats']['denied']?></p>
                <!-- <span class="percent-stat d-flex gap-2"><span class="green d-flex align-items-center"><span
                            class=" arrow-icon material-symbols-outlined">
                            arrow_upward
                        </span>0%</span> Super Admin</span> -->
            </div>
        </div>
        <!-- <div class="cards ">
            <div class="stat-box-1 p-3 text-center bg-light rounded">
                <img src="<?= base_url('/assets/images/orderCancel.png') ?>" alt="icon" width="42px">
                <h3>Order Cancel</h3>
                <p>0</p>
                <span class="percent-stat d-flex gap-2"><span class="green d-flex align-items-center"><span
                            class=" arrow-icon material-symbols-outlined">
                            arrow_upward
                        </span>0%</span> Super Admin</span>
            </div> -->
        </div>
    </div>
    <!-- stat-box ends -->

    <div class="row g-3">
        <div class="col-12 ">
            <div class="table-header d-flex justify-content-between align-items-center ms-4">
                <div class="headings mt-2 mb-1">
                    <h3>Bulk Orders</h3>
                    <!-- <h6>Lorem Ipsum is simply dummy text</h6> -->
                </div>
            </div>
            <div class="table-wrapper col-12 bg-white p-3 rounded">
                <div class="pb-2" style="overflow-x: scroll;">
                    <div class="buttons-filter">
                        <!-- <button type="button" class="btn btn-outline-success"><span class="material-symbols-outlined">
                                    add_circle
                                    </span>ADD NOW</button> -->
                        <!-- <button type="button" class="btn btn-light"><span class="material-symbols-outlined">
                                    tune
                                    </span>FILTERS</button> -->
                    </div>

                    <table id="vendor-list-Table" class=" table hover">
                        <thead>
                            <tr>
                            <th>S.No</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Email ID</th>
                                
                                <th>Business Name</th>
                                <th>Category</th>
                                
                                <th>quantity</th>
                                <th>Address</th>
                                <th>Contact Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($orders['orders'] as $index=> $order) {?>
                                
                           
                            <tr>
                                        <td><?= $index+1?></td>
                                        <td><?= $order['name'] ?></td>
                                        <td><?= $order['contact'] ?></td>
                                        <td><?= $order['email'] ?></td>
                                        <td><?= $order['business_name'] ?></td>
                                        <td><?= $order['category'] ?></td>
                                        <td><?= $order['quantity'] ?></td>
                                        <td><?= $order['address'] ?></td>
                                       
                                        <td>
                                            <?php 
                                            $date = new DateTime($order['created']);
                                            $formattedDate = $date->format('d-m-Y H:i');
                                            
                                            echo $formattedDate;
                                             
                                             ?>
                                            
                                        </td>
<td>
    <select class="select-status" onchange="BulkStatus(this.value, '<?= $order['id'] ?>')" style="color: black;">
        <?php if ($order['status'] == 1) { ?>
            <option selected class="active" value="1">New</option>
        <?php } ?>
        <option <?= ($order['status'] == 2) ? 'selected' : '' ?> class="block" value="2">Contacted</option>
        <option <?= ($order['status'] == 3) ? 'selected' : '' ?> class="block" value="3">Fulfilled</option>
        <option <?= ($order['status'] == 4) ? 'selected' : '' ?> class="unactive" value="4">Denied</option>
    </select>
</td>

                                        <!-- <td>
                                            <div class="action-icons">
                                                <a href="<?= base_url('venderDetails') ?>" class="icon eye-icon" title="View"><img src="<?= base_url('/assets/images/eye.png') ?>" alt="View" width="20px"></a>
                                                <a href="#" class="icon hand-icon" title="Delete"><img src="<?= base_url('/assets/images/Trash.png') ?>" alt="Handle" width="20px"></a>
                                            </div>
                                        </td> -->
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
<script src="<?= base_url('/assets/javascript/common.js') ?>"></script>




<script>
$(document).ready(function() {
    const distributorListTable = $('#vendor-list-Table').DataTable({
        searching: true,
        "initComplete": function(settings, json) {
            $('#vendor-list-Table_filter input').attr('placeholder', 'Search vendor name here');
        }
    });


    // Apply color to select options
    $('#vendor-list-Table').on('change', '.select-status', function() {
        const option = $(this).find('option:selected');
        if (option.hasClass('unactive')) {
            $(this).css('color', 'orange');
        } else if (option.hasClass('active')) {
            $(this).css('color', 'green');
        } else if (option.hasClass('block')) {
            $(this).css('color', 'red');
        }
    });
});

function BulkStatus(status,id)
{
    console.log(status);
    $.ajax({
        url: '<?= base_url('bulkStatuschange') ?>',
        type: 'POST',
        data: {status:status,id:id},
        success: function(response) {
            console.log(response);
        }
    });
}


</script>
</body>

</html>