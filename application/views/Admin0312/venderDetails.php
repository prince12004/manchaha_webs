<?php $this->load->view('Admin/header') ?>
        <div class="add-vendor-page content">
        <div class="content">
            <div class="table-header d-flex justify-content-between align-items-center ms-4 ">
                <div class="headings mt-4 mb-2">       
                    <h3>Add Vendor</h3>
                </div>
            </div>  

            <div class="vendor-details-cont my-2 mx-5">
                <div class="  d-flex flex-column">
                    <div class="profile-section mb-3 w-100">
                        <div class="profile-card ">
                            <a class="edit-vendor-icon" href="<?= base_url('editvender') ?>">
                               <img src="<?=base_url('/assets/images/edit-vendor.png')?>"  >
                            </a>
                        
                            <div class="d-flex flex-row">
                                <div class="profile-img mb-2" style="bottom:-30px">
                                    <img id="profileImage" src="https://via.placeholder.com/100" alt="Profile Image">
                                    <img src="<?=base_url('/assets/images/image-uploader.png')?>"  id="uploadIcon" alt="icon">
                                    <input type="file" id="imageUpload" class="hidden" accept="image/*">
                                </div>
                                <div class="card-details ps-4 p-3">
                                   <div class="content">
                                   <h2 id="profileName">Type Name in the input</h2>
                                    <p id="profileDescription">Type Description in the input</p>
                                    <img  src="<?= base_url('/assets/images/vendor-line.png') ?>" alt="icon" alt="">
                                    <div class="d-flex justify-content-start gap-5">
                                        <ul>
                                            <li><h6>Email ID:</h6> <span id="profileEmail">abc@gmail.com</span></li>
                                            <li><h6>Phone:</h6> <span id="profilePhone">+91 1234 567890</span></li>
                                            <li><h6>Joining Date:</h6> <span id="profileDate">23-07-2024</span></li>
                                            <li><h6>GST:</h6> <span id="profileGST">AB#123456</span></li>
                                        </ul>
                                        <ul>
                                            <li><h6>Company Name:</h6> <span id="companyName">Type Company name</span></li>
                                            <li><h6>Pen Card Number:</h6> <span id="pencardNumber">KXWPS7314B</span></li>
                                            <li><h6>City:</h6> <span id="profileCity">Noida</span></li>
                                            <li>
                                                <h6>Status:</h6> 
                                                <span id="profileStatus">Approved</span>
                                            </li>
                                        </ul>
                                    </div>
                                   </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="information-tags">
                             <div class="content">
                                <div class="info-tabs" data-tab="1">
                                    Basic Information
                                </div>
                                <div class="info-tabs" data-tab="2">
                                    Bank Details
                                </div>
                                <div class="info-tabs" data-tab="3">
                                    Supplier E-Signature
                                </div>
                                <div class="info-tabs" data-tab="4">
                                    Legal & Policies
                                </div>
                                <div class="info-tabs" data-tab="5">
                                    Email Notifications
                                </div>
                             </div>
                        </div> -->
                    </div>
                    <div class="row g-3">
                        <div class="col-12 ">
                            <div style="bottom: -50px;"  class="table-header d-flex justify-content-between align-items-center ms-4">
                                <div class="headings mt-2 mb-1">       
                                    <h3>Customer List</h3>
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

                                    <table  id="vendor-customer-Table" class=" table hover">
                                        <thead >
                                            <tr >
                                                <th>Customer Name</th>
                                                <th>Phone</th>
                                                <th>Email ID</th>
                                                <th>Order Time</th>
                                                <th>Invoice No.</th>
                                                <th>Quantity</th>
                                                <th>Payment</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <!-- <tr>
                                                <td>
                                                    <img class="user-image" src="<?= base_url('/assets/images/user-image.png') ?>" alt="User Image">Lorem Ipsum
                                                </td>
                                                <td>+91 123 4567890</td>
                                                <td>lorem@ipsum.com</td>
                                                <td>Jul23,2024 7:01 AM</td>
                                                <td>#11184</td>
                                                <td>265 </td>
                                                <td>6,450 Fully Paid</td>
                                                <td>
                                                    <select class="select-status" style="color: black;">
                                                    <option class="unactive" value="unactive">Un-Active</option>
                                                    <option class="active" value="active" selected>Active</option>
                                                    <option class="block" value="block" selected>Blocked</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <div class="action-icons">
                                                        <a href="#" class="icon eye-icon" title="View"><img src="<?= base_url('/assets/images/eye.png') ?>" alt="View" width="20px"></a>
                                                        <a href="#" class="icon hand-icon" title="Delete"><img src="<?= base_url('/assets/images/Trash.png') ?>" alt="Handle" width="20px"></a>
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
        </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/js/all.min.js"></script>
    <script src="<?= base_url('/assets/javascript/common.js') ?>"></script>
    <script>







flatpickr(".date", {
        enableTime: false,                // Enables time selection
        minDate: "today",                // Allows only future dates
        dateFormat: "d-m-Y ",         // Format: Year-Month-Day Hour:Minute
        allowInput: false                // Disables manual input
    });

   

    </script>




    <script>
  

        $(document).ready(function() {
            const distributorListTable = $('#vendor-customer-Table').DataTable({
                searching: true,
                "initComplete": function(settings, json) {
                    $('#vendor-customer-Table_filter input').attr('placeholder', 'Search customer name here');
                }
            });

           
            // Apply color to select options
            $('#vendor-customer-Table').on('change', '.select-status', function() {
                const option = $(this).find('option:selected');
                if (option.hasClass('unactive')) {
                    $(this).css('color', 'orange');
                } else if (option.hasClass('active')) {
                    $(this).css('color', 'green');
                }
                 else if (option.hasClass('block')) {
                    $(this).css('color', 'red');
                }
            });
        });
    

    </script>


</body>
</html>
