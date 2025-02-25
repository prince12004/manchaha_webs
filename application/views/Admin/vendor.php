<?php $this->load->view('Admin/header') ?>
<div class="vendor-page content">
    <div class="d-flex  justify-content-between align-items-center my-3">
        <h1 class="dash-head1">All Vendors</h1>
    </div>
    <!-- stat-box -->
    <div class="stat-box-row-1 g-1 col-12 mb-3 d-flex ">
        <div class="cards ">
            <div class="stat-box-1 p-3 text-center bg-light rounded">
                <img src="<?= base_url('/assets/images/newOrder.png') ?>" alt="icon" width="42px">
                <h3>New Order </h3>
                <p>0</p>
                <div class="percent-stat d-flex gap-2">
                    <div class="green d-flex align-items-center">
                        <span class=" arrow-icon material-symbols-outlined">
                            arrow_upward
                        </span>
                        0%
                    </div>
                    <span>Super Admin</span>
                </div>
            </div>
        </div>
        <div class="cards ">
            <div class="stat-box-1 p-3 text-center bg-light rounded">
                <img src="<?= base_url('/assets/images/orderDelivered.png') ?>" alt="icon" width="42px">
                <h3>Order Delivered</h3>
                <p>0</p>
                <div class="percent-stat d-flex gap-2">
                    <div class="green d-flex align-items-center"> <span class=" arrow-icon material-symbols-outlined">
                            arrow_upward
                        </span>0%</div> Super Admin
                </div>
            </div>
        </div>
        <div class="cards ">
            <div class="stat-box-1 p-3 text-center bg-light rounded">
                <img src="<?= base_url('/assets/images/orderPending.png') ?>" alt="icon" width="42px">
                <h3>Order Pending</h3>
                <p>0</p>
                <span class="percent-stat d-flex gap-2"><span class="red d-flex align-items-center"><span
                            class=" arrow-icon material-symbols-outlined">
                            arrow_downward
                        </span>0%</span> Super Admin</span>
            </div>
        </div>
        <div class="cards ">
            <div class="stat-box-1 p-3 text-center bg-light rounded">
                <img src="<?= base_url('/assets/images/orderConfirm.png') ?>" alt="icon" width="42px">
                <h3>Confirm Order</h3>
                <p>0</p>
                <span class="percent-stat d-flex gap-2"><span class="green d-flex align-items-center"><span
                            class=" arrow-icon material-symbols-outlined">
                            arrow_upward
                        </span>0%</span> Super Admin</span>
            </div>
        </div>
        <div class="cards ">
            <div class="stat-box-1 p-3 text-center bg-light rounded">
                <img src="<?= base_url('/assets/images/orderCancel.png') ?>" alt="icon" width="42px">
                <h3>Order Cancel</h3>
                <p>0</p>
                <span class="percent-stat d-flex gap-2"><span class="green d-flex align-items-center"><span
                            class=" arrow-icon material-symbols-outlined">
                            arrow_upward
                        </span>0%</span> Super Admin</span>
            </div>
        </div>
    </div>
    <!-- stat-box ends -->

    <div class="row g-3">
        <div class="col-12 ">
            <div class="table-header d-flex justify-content-between align-items-center ms-4">
                <div class="headings mt-2 mb-1">
                    <h3>Vendor List</h3>
                    <!-- <h6>Lorem Ipsum is simply dummy text</h6> -->
                </div>
                <a href="<?= base_url('addvender') ?>">
                    <button class=" btn btn-primary add-vendor-btn d-center gap-3 mb-2">
                        <img src="<?= base_url('/assets/images/newvendor.png') ?>" alt="icon"> Add New Vendor
                    </button>
                </a>
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
                                <th>Vendor</th>
                                <th>Email ID</th>
                                <th>Phone</th>
                                <th>State</th>
                                <th>City</th>
                                <th>Orders</th>
                                <th>Joining</th>
                                <th>Published</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($vendordata['vendors'] as $vendor) {?>
                                
                           
                            <tr>
                                <td>01</td>
                            <?php foreach ($vendordata['vendors'] as $vendor) {?>
                                
                           
                            <tr>
                                        <td>
                                            <img class="user-image" src="<?= base_url('/uploads/vendorimages/').$vendor['vendor_image'] ?>" alt="User Image"><?= $vendor['vendor_name']?>
                                        </td>
                                        <td><?= $vendor['vendor_email'] ?></td>
                                        <td><?= $vendor['vendor_phone'] ?></td>
                                        <td><?= $vendor['state_name'] ?></td>
                                        <td><?= $vendor['vendor_city'] ?></td>
                                        <td>0 Orders</td>
                                        <td>
                                            <?php 
                                            $date = new DateTime($vendor['application_date']);
                                            $formattedDate = $date->format('d-m-Y H:i');
                                            
                                            echo $formattedDate;
                                             
                                             ?>
                                            
                                        </td>
                                        <td>
                                            <select class="select-status" onchange="vendorStatus(this.value,'<?= $vendor['id'] ?>')" style="color: black;">
                                                
                                                <option <?= ($vendor['is_verified']==1) ?'selected' : '' ?> class="active" value="1" >Active</option>
                                                <option <?= ($vendor['is_verified']==2) ?'selected' : '' ?> class="block" value="2" >Blocked</option>
                                                <?php if ($vendor['is_verified']==0) {?>
                                                    <option <?= ($vendor['is_verified']==0) ?'selected' : '' ?> class="unactive" value="0">Un-Active</option>
                                                <?php }?>
                                                
                                               
                                               
                                            </select>
                                        </td>
                                        <td>
                                            <div class="action-icons">
                                                <a href="<?= base_url('venderDetails') ?>" class="icon eye-icon" title="View"><img src="<?= base_url('/assets/images/eye.png') ?>" alt="View" width="20px"></a>
                                                <a href="#" class="icon hand-icon" title="Delete"><img src="<?= base_url('/assets/images/Trash.png') ?>" alt="Handle" width="20px"></a>
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
</script>
</body>

</html>