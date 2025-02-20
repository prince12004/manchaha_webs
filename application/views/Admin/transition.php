<?php $this->load->View('Admin/header') ?>
<div class="content">
    <div class="product-earnings rounded">
        <div class="headingtab d-flex justify-content-between align-items-start mt-4">
            <h3>Transactions</h3>
        </div>
        <div class="col-md-12 d-flex justify-content-between align-items-center">
            <div class="circle-bar  mb-3">
                <!-- <div class="circle" data-percent="85">
                                <div class="percentage-num">85%</div>
                            </div> -->
                <div class="details">
                    <h6>Total Income: </h6>
                    <h3>₹ 00</h3>
                    <span>0%</span>
                </div>
                <div class="d-flex justify-content-center align-items-center flex-column">
                    <img src="<?= base_url('assets/images/circle-card-tick.png') ?>" alt="img" width="45px">
                    <span> +0%</span>
                </div>
            </div>

            <div class="circle-bar mb-3">
                <!-- <div class="circle  circle-2" data-percent="75">
                                <div class="percentage-num">75%</div>
                            </div> -->
                <div class="details">
                    <h6>Total Payments:</h6>
                    <h3>₹ 00</h3>
                    <span>0% </span>
                </div>
                <div class="d-flex justify-content-center align-items-center flex-column">
                    <img src="<?= base_url('assets/images/circle-card-tick.png') ?>" alt="img" width="45px">
                    <span> +0%</span>
                </div>
            </div>

            <div class="circle-bar mb-3">
                <!-- <div class="circle circle-3" data-percent="56">
                                    <div class="percentage-num">56%</div>
                                </div> -->

                <div class="details">
                    <h6>Remaining Payment:</h6>
                    <h3>₹ 00</h3>
                    <span>0% </span>
                </div>
                <div class="d-flex justify-content-center align-items-center flex-column">
                    <img src="<?= base_url('assets/images/circle-card-tick.png') ?>" alt="img" width="45px">
                    <span> +0%</span>
                </div>
            </div>

        </div>

    </div>
    <div class="row g-3">
        <div class=" col-lg-12">
            <div class="table-wrapper bg-white p-3 rounded">
                <div class="table-header d-flex justify-content-between align-items-center mb-3">
                    <h3>Customer Transactions</h3>
                </div>
                <div class="pb-2" style="overflow-x: scroll;">
                    <table id="transition-list" class=" table hover">
                        <thead>
                            <tr>
                                <th>Customer Name</th>
                                <th>Product ID</th>
                                <th>Product</th>
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
                                        <td>DC12#1234</td>
                                        <td>Simply dummy text</td>
                                        <td>Jul 23,2024 7:01 AM</td>
                                        <td>#111184</td>
                                        <td>32</td>
                                        <td>6,450 FullyPaid</td>
                                        <td>
                                            <select class="select-status" style="color: black;">
                                                <option class="pending" value="Processing">Processing</option>
                                                <option class="delivered" value="Successfull" selected>Successful</option>
                                                <option class="cancel" value="Cancel" selected>Cancel</option>
                                            </select>
                                        </td>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-circle-progress/1.2.2/circle-progress.min.js"></script>
<script src="<?= base_url('assets/javascript/common.js') ?>"></script>

<script>
$('input[name="daterange"]').daterangepicker();

$('#transition-list').DataTable({
    searching: false,
    "pageLength": 8
});








$('.circle').each(function() {
    const circle = $(this);
    const percent = circle.data('percent');

    circle.circleProgress({
        value: percent / 100,
        size: 100, // Adjust size as needed
        fill: {
            gradient: ['#FE6BBA']
        }, // Adjust fill colors for each circle
        startAngle: -Math.PI / 2, // Start from the top
        // Adjust empty fill color
    }).on('circle-animation-progress', function(event, progress) {
        circle.find('.circle-inner').html(Math.round(percent * progress) + '<i>%</i>');
    });
});
$('.circle-2').each(function() {
    const circle = $(this);
    const percent = circle.data('percent');

    circle.circleProgress({
        value: percent / 100,
        size: 100, // Adjust size as needed
        fill: {
            gradient: ['#9267F2']
        }, // Adjust fill colors for each circle
        startAngle: -Math.PI / 2, // Start from the top
        // Adjust empty fill color
    }).on('circle-animation-progress', function(event, progress) {
        circle.find('.circle-inner').html(Math.round(percent * progress) + '<i>%</i>');
    });
});
$('.circle-3').each(function() {
    const circle = $(this);
    const percent = circle.data('percent');

    circle.circleProgress({
        value: percent / 100,
        size: 100, // Adjust size as needed
        fill: {
            gradient: ['#76ACFE']
        }, // Adjust fill colors for each circle
        startAngle: -Math.PI / 2, // Start from the top
        // Adjust empty fill color
    }).on('circle-animation-progress', function(event, progress) {
        circle.find('.circle-inner').html(Math.round(percent * progress) + '<i>%</i>');
    });
});

// Example of dynamically updating percentage after a delay (just for demonstration)
setTimeout(function() {
    $('.circle[data-percent="85"]').circleProgress('value', 0.85);
    $('.circle-2[data-percent="75"]').circleProgress('value', 0.75);
    $('.circle-3[data-percent="56"]').circleProgress('value', 0.56);
}, 2000); // Delayed update after 2 seconds




// Apply color to select options
$('#transition-list').on('change', '.select-status', function() {
    const option = $(this).find('option:selected');
    if (option.hasClass('pending')) {
        $(this).css('color', 'orange');
    } else if (option.hasClass('delivered')) {
        $(this).css('color', 'green');
    } else if (option.hasClass('cancel')) {
        $(this).css('color', 'red');
    }
});
</script>
</body>

</html>