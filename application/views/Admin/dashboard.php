<?php $this->load->View('Admin/header') ?>
<div class="content">
    <div class="d-flex  justify-content-between align-items-center my-3">
        <h1 class="dash-head1">Dashboard</h1>

    </div>
    <div class="stat-box-row g-1 col-12 mb-3 d-flex ">
        <div class="cards ">
            <div class="stat-box p-3 text-center bg-light rounded">
                <h3>Total Sales</h3>
                <p>₹ 0</p>
                <span class="percent-stat d-flex gap-2"><span class="green d-flex align-items-center">0%</span> Super
                    Admin</span>
            </div>
        </div>
        <div class="cards ">
            <div class="stat-box p-3 text-center bg-light rounded">
                <h3>Recent Orders</h3>
                <p>₹ 0</p>
                <span class="percent-stat d-flex gap-2"><span class="green d-flex align-items-center">0%</span> Super
                    Admin</span>
            </div>
        </div>
        <div class="cards ">
            <div class="stat-box p-3 text-center bg-light rounded">
                <h3>Orders Paid</h3>
                <p>₹ 0</p>
                <span class="percent-stat d-flex gap-2"><span class="red d-flex align-items-center">0%</span> Super
                    Admin</span>
            </div>
        </div>
        <div class="cards ">
            <div class="stat-box p-3 text-center bg-light rounded">
                <h3>Total Visitor</h3>
                <p>0</p>
                <span class="percent-stat d-flex gap-2"><span class="green d-flex align-items-center">0%</span> Super
                    Admin</span>
            </div>
        </div>
        <div class="cards ">
            <div class="stat-box p-3 text-center bg-light rounded">
                <h3>Average Sales</h3>
                <p>₹ 0</p>
                <span class="percent-stat d-flex gap-2"><span class="red d-flex align-items-center">0%</span> Super
                    Admin</span>
            </div>
        </div>
    </div>
    <div class="row g-3">
        <div class=" col-lg-12">
            <div class="table-wrapper bg-white p-3 rounded">
                <div class="table-header d-flex justify-content-between align-items-center mb-3">
                    <h3>Recent Orders</h3>
                </div>
                <div class="pb-2" style="overflow-x: scroll;">
                    <table id="recentOrderlist" class=" table hover">
                        <thead>
                            <tr>
                                <th>#User</th>
                                <th>Email ID</th>
                                <th>Phone</th>
                                <th>City</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- <tr>
                                    <td>
                                        <img class="user-image"  src="<?= base_url('assets/images/user-image.png') ?>" alt="User Image">Lorem Ipsum
                                    </td>
                                    <td>lorem@ipsum.com</td>
                                    <td>+91 123 4567890</td>
                                    <td>Lorem Ipsum</td>
                                    <td>2024-12-25</td>
                                    <td>
                                        <div class="action-icons">
                                            <a href="#" class="icon eye-icon" title="View"><img src="<?= base_url('assets/images/index-eye.png') ?>" alt="View"></a>
                                            <a href="#" class="icon trash-icon" title="delete"><img src="<?= base_url('assets/images/index-trash.png') ?>" alt="delete"></a>
                                            <a href="#" class="icon pen-icon" title="Edit"><img src="<?= base_url('assets/images/index-edit.png') ?>" alt="Edit"></a>
                                       </div>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td>
                                        <img class="user-image"  src="<?= base_url('assets/images/user-image.png') ?>" alt="User Image">Lorem Ipsum
                                    </td>
                                    <td>lorem@ipsum.com</td>
                                    <td>+91 123 4567890</td>
                                    <td>Lorem Ipsum</td>
                                    <td>2024-12-25</td>
                                    <td>
                                        <div class="action-icons">
                                            <a href="#" class="icon eye-icon" title="View"><img src="<?= base_url('assets/images/index-eye.png') ?>" alt="View"></a>
                                            <a href="#" class="icon trash-icon" title="delete"><img src="<?= base_url('assets/images/index-trash.png') ?>" alt="delete"></a>
                                            <a href="#" class="icon pen-icon" title="Edit"><img src="<?= base_url('assets/images/index-edit.png') ?>" alt="Edit"></a>
                                       </div>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td>
                                        <img class="user-image"  src="<?= base_url('assets/images/user-image.png') ?>" alt="User Image">Lorem Ipsum
                                    </td>
                                    <td>lorem@ipsum.com</td>
                                    <td>+91 123 4567890</td>
                                    <td>Lorem Ipsum</td>
                                    <td>2024-12-25</td>
                                    <td>
                                        <div class="action-icons">
                                            <a href="#" class="icon eye-icon" title="View"><img src="<?= base_url('assets/images/index-eye.png') ?>" alt="View"></a>
                                            <a href="#" class="icon trash-icon" title="delete"><img src="<?= base_url('assets/images/index-trash.png') ?>" alt="delete"></a>
                                            <a href="#" class="icon pen-icon" title="Edit"><img src="<?= base_url('assets/images/index-edit.png') ?>" alt="Edit"></a>
                                       </div>
                                    </td>
                                  </tr> -->

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
$('#recentOrderlist').DataTable({
    searching: false,
    "pageLength": 8
});
</script>
</body>

</html>