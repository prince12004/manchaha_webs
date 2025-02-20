<?php $this->load->View('Admin/header') ?>
        <div class="content">
            <div class="d-flex justify-content-between align-items-center my-3">
                <h1 class="dash-head1">Order History</h1>
                <div class="daterange">
                    <img src="<?= base_url('assets/images/calender.png') ?>" alt="img">
                    <input type="text" name="daterange" id="daterange" class="form-control" placeholder="20/07/2024" />
                </div>
            </div>
            <div class="row g-3">
                <div class="col-12">
                    <div class="table-header d-flex justify-content-between align-items-center ms-4">
                        <div class="headings">       
                            <h3>Order History List</h3>
                            <h6>Lorem Ipsum is simply dummy text</h6>
                        </div>
                    </div>
                    <div class="table-wrapper col-12 bg-white p-3 rounded">
                        <div class="pb-2" style="overflow-x: scroll;">
                            <table id="Order-History-Table" class="table hover">
                                <thead>
                                    <tr>
                                        <th>Customer Name</th>
                                        <th>Order ID</th>
                                        <th>Phone N0.</th>
                                        <th>Email ID</th>
                                        <th>Order Date</th>
                                        <th>Quantity</th>
                                        <th>Payment </th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($orders as $order){ ?>
                                    <tr>
                                        <td>
                                            <img class="user-image" src="<?= base_url('assets/images/user-image.png') ?>" alt="User Image"><?= $order['name']?>
                                        </td>
                                        <td><?= $order['id'] ?></td>
                                        <td><?= $order['PhoneNumber'] ?></td>
                                        <td><?= $order['Email'] ?></td>
                                        <td><?= $order['order_date'] ?></td>
                                        <td><?= $order['quantity'] ?></td>
                                        <td><?= $order['amount'] ?>(Fully Paid)</td>
                                        <td>
                                            <select class="select-status" style="color: black;">
                                                <option class="pending" value="Pending">Pending</option>
                                                <option class="delivered" value="Delivered" selected>Delivered</option>
                                                <option class="cancel" value="Cancel" selected>Cancel</option>
                                             </select>
                                        </td>
                                        <td>
                                            <div class="action-icons">
                                                <a href="<?= base_url('Web/Admin/Admin/OrderDetails/').$order['id'] ?>" class="icon eye-icon" title="View"><img src="<?= base_url('assets/images/eye.png') ?>" alt="View" width="20px"></a>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                   
                                   
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
     $('#Order-History-Table').DataTable({
        searching: true,
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
           }
            else if (option.hasClass('cancel')) {
               $(this).css('color', 'red');
           }
       });
});

    </script>
</body>
</html>











<style>
        .dataTables_wrapper .dataTables_filter{
            right: 1vw;
        }
        .additional-fields {
            display: none;
            margin-top: 10px;
        }
        #popup-form {
            display: none;
        }
        .model{
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
        .dispatch-select{
            border-radius: 32px;
            padding: 5px 10px;
            background-color: rgba(227, 232, 243, 1);
            font-family: 'Poppins';
            font-size: 12px;
            font-weight: 500;
            line-height: 18px;
            width: 115px;

        }
        .uploadpdf-btn{
            background: #D0DCEB;
            border-radius: 10px;
            height: 70px;
            width: 200px;
            margin-top:23px !important  
        }
        #imageContainer img {
            width: 30px;
        }
        .order-status .copy-btn{
            position: absolute;
            right: 0px;
            bottom: 0px;
            font-size: 12px;

        }
       
    </style>