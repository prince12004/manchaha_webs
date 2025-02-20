<?php $this->load->view('Admin/header') ?>
        <div class="content">
            <div class="d-flex  justify-content-between align-items-center my-3">
                <h1 class="dash-head1">All Customer</h1>
                <div class="daterange">
                    <img src="<?= base_url('/assets/images/calender.png') ?>" alt="img">
                    <input type="text" name="daterange" id="daterange" class="form-control" placeholder="20/07/2024" />
                </div>
            </div>
             <!-- stat-box -->
             <div class="stat-box-row-1 g-1 col-12 mb-3 d-flex ">
                <div class="cards ">
                    <div class="stat-box-1 p-3 text-center bg-light rounded">
                        <img src="<?= base_url('/assets/images/stat-icon-5.png') ?>" alt="icon" width="42px">
                        <h3>Product Seals  </h3>
                        <p>₹ 86,450</p>
                        <div class="percent-stat d-flex gap-2">
                               <div class="green d-flex align-items-center">
                                <span class=" arrow-icon material-symbols-outlined">
                                    arrow_upward
                                </span>
                                1.23%
                                </div> 
                                <span>Super Admin</span>
                        </div>
                    </div>
                </div>
                <div class="cards ">
                    <div class="stat-box-1 p-3 text-center bg-light rounded">
                        <img src="<?= base_url('/assets/images/stat-icon-1.png') ?>" alt="icon" width="42px">
                        <h3>Order Delivered</h3>
                        <p>1,245</p>
                        <div class="percent-stat d-flex gap-2"><div class="green d-flex align-items-center"> <span class=" arrow-icon material-symbols-outlined">
                            arrow_upward
                            </span>5.20%</div> Super Admin</div>
                    </div>
                </div>
                <div class="cards ">
                    <div class="stat-box-1 p-3 text-center bg-light rounded">
                        <img src="<?= base_url('/assets/images/stat-icon-2.png') ?>" alt="icon" width="42px">
                        <h3>Order Pending</h3>
                        <p>1,456</p>
                        <span class="percent-stat d-flex gap-2"><span class="red d-flex align-items-center"><span class=" arrow-icon material-symbols-outlined">
                            arrow_downward
                            </span>3.35%</span> Super Admin</span>
                    </div>
                </div>
                <div class="cards ">
                    <div class="stat-box-1 p-3 text-center bg-light rounded">
                        <img src="<?= base_url('/assets/images/stat-icon-3.png') ?>" alt="icon" width="42px">
                        <h3>Order Processing </h3>
                        <p>1,868</p>
                        <span class="percent-stat d-flex gap-2"><span class="green d-flex align-items-center"><span class=" arrow-icon material-symbols-outlined">
                            arrow_upward
                            </span>1.23%</span> Super Admin</span>
                    </div>
                </div>
                <div class="cards ">
                    <div class="stat-box-1 p-3 text-center bg-light rounded">
                        <img src="<?= base_url('/assets/images/stat-icon-4.png') ?>" alt="icon" width="42px">
                        <h3>Order Cancel</h3>
                        <p>564</p>
                        <span class="percent-stat d-flex gap-2"><span class="green d-flex align-items-center"><span class=" arrow-icon material-symbols-outlined">
                            arrow_upward
                            </span>1.23%</span> Super Admin</span>
                    </div>
                </div>
            </div>
            <!-- stat-box ends -->
            
            <div class="row g-3">
                <div class="col-12 ">
                    <div class="table-header d-flex justify-content-between align-items-center ms-4">
                        <div class="headings">       
                            <h3>Customer List</h3>
                            <h6>Lorem Ipsum is simply dummy text</h6>
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

                            <table  id="customer-list-Table" class=" table hover">
                                <thead >
                                    <tr >
                                        <th>Name</th>
                                        <th>Email ID</th>
                                        <th>Phone</th>
                                        <th>Location</th>
                                        <th>City</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   <tr>
                                        <td>
                                            <img class="user-image" src="<?= base_url('/assets/images/user-image.png') ?>" alt="User Image">Lorem Ipsum
                                        </td>
                                        <td>lorem@ipsum.com</td>
                                        <td>+91 123 4567890</td>
                                        <td>Lorem Ipsum</td>
                                        <td>New Delhi</td>
                                        <td>2024-12-25</td>
                                        <td>
                                            <select class="select-status" style="color: black;">
                                               <option class="pending" value="Pending">Pending</option>
                                               <option class="delivered" value="Delivered" selected>Delivered</option>
                                               <option class="cancel" value="Cancel" selected>Cancel</option>
                                            </select>
                                        </td>
                                        <td>
                                            <div class="action-icons">
                                                <a href="#" class="icon eye-icon" title="View"><img src="<?= base_url('/assets/images/eye.png') ?>" alt="View" width="20px"></a>
                                                <a href="#" class="icon hand-icon" title="Delete"><img src="<?= base_url('/assets/images/Trash.png') ?>" alt="Handle" width="20px"></a>
                                            </div>
                                        </td>
                                   </tr>
                                   <tr>
                                        <td>
                                            <img class="user-image" src="<?= base_url('/assets/images/user-image.png') ?>" alt="User Image">Lorem Ipsum
                                        </td>
                                        <td>lorem@ipsum.com</td>
                                        <td>+91 123 4567890</td>
                                        <td>Lorem Ipsum</td>
                                        <td>New Delhi</td>
                                        <td>2024-12-25</td>
                                        <td>
                                            <select class="select-status" style="color: black;">
                                            <option class="pending" value="Pending">Pending</option>
                                            <option class="delivered" value="Delivered" selected>Delivered</option>
                                            <option class="cancel" value="Cancel" selected>Cancel</option>
                                        </select>
                                        </td>
                                        <td>
                                            <div class="action-icons">
                                                <a href="#" class="icon eye-icon" title="View"><img src="<?= base_url('/assets/images/eye.png') ?>" alt="View" width="20px"></a>
                                                <a href="#" class="icon hand-icon" title="Delete"><img src="<?= base_url('/assets/images/Trash.png') ?>" alt="Handle" width="20px"></a>
                                            </div>
                                        </td>
                                   </tr>
                                   <tr>
                                        <td>
                                            <img class="user-image" src="<?= base_url('/assets/images/user-image.png') ?>" alt="User Image">Lorem Ipsum
                                        </td>
                                        <td>lorem@ipsum.com</td>
                                        <td>+91 123 4567890</td>
                                        <td>Lorem Ipsum</td>
                                        <td>New Delhi</td>
                                        <td>2024-12-25</td>
                                        <td>
                                            <select class="select-status" style="color: black;">
                                            <option class="pending" value="Pending">Pending</option>
                                            <option class="delivered" value="Delivered" selected>Delivered</option>
                                            <option class="cancel" value="Cancel" selected>Cancel</option>
                                        </select>
                                        </td>
                                        <td>
                                            <div class="action-icons">
                                                <a href="#" class="icon eye-icon" title="View"><img src="<?= base_url('/assets/images/eye.png') ?>" alt="View" width="20px"></a>
                                                <a href="#" class="icon hand-icon" title="Delete"><img src="<?= base_url('/assets/images/Trash.png') ?>" alt="Handle" width="20px"></a>
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
    <script src="<?= base_url('/assets/javascript/common.js') ?>"></script>




    <script>
  

        $(document).ready(function() {
            const distributorListTable = $('#customer-list-Table').DataTable({
                searching: true,
                "initComplete": function(settings, json) {
                    $('#customer-list-Table_filter input').attr('placeholder', 'Search customer name here');
                }
            });

           
            // Apply color to select options
            $('#customer-list-Table').on('change', '.select-status', function() {
                const option = $(this).find('option:selected');
                if (option.hasClass('pending')) {
                    $(this).css('color', 'orange');
                } else if (option.hasClass('delivered')) {
                    $(this).css('color', 'green');
                }
                 else if (option.hasClass('cancel')) {
                    $(this).css('color', 'red');
                }
            });
        });
    

    </script>
</body>
</html>
