<style>
.modal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    /* Semi-transparent background */
    display: none;
    justify-content: center;
    align-items: center;
    z-index: 9999;
    /* Ensure the modal is on top of all other content */
}

.modal-content {
    background-color: white;
    padding: 30px;
    border-radius: 10px;
    text-align: center;
    width: 35% !important;
    margin: 20vh auto
}

.modal-content h2 {
    font-size: 20px;
}

.modal-logo {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-bottom: 20px;
    /* Space between logo and the rest of the modal content */
}

.modal-logo img {
    max-width: 100%;
    /* Ensure the logo doesn't overflow */
    height: 100px;
}

.close-btn {
    background-color: #3182ce;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
}

.close-btn:hover {
    background-color: #2563eb;
}



#confirmDelete {
    padding: 8px 20px;
    border-radius: 25px;
    border: none;
    background-color: #4a90e2;
    color: #FFF;
    font-weight: 500
}

#cancelDelete {
    padding: 8px 20px;
    border-radius: 25px;
    border: none;
    background-color: #333;
    color: #FFF;
    font-weight: 500
}

.modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.8);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 1000;
}

.modal-overlay img {
    max-width: 90%;
    max-height: 90%;
}

#fullScreenModal .close-button {
    position: absolute;
    top: 20px;
    right: 20px;
    font-size: 30px;
    color: white;
    cursor: pointer;
}

.form-action-btn .btn {
    padding: 8px 20px;
    border-radius: 25px;
    box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.2);
}

.form-action-btn .btn span {
    margin-right: 5px;
}

tbody {
    white-space: nowrap;
}

thead {
    white-space: nowrap;
}

/* #product-list-Table .action-head::before{
       display:none !important;
    }
    #product-list-Table .action-head::after{
       display:none !important;
    } */
</style>

<?php $this->load->View('Admin/header') ?>
<div class="content">
    <div class="d-flex  justify-content-left align-items-center my-3">
        <h1 class="dash-head1">Our Products</h1>
    </div>
    <div class="row g-3">
        <div class="col-12 ">
            <div class="table-header d-flex justify-content-between align-items-center ms-4">
                <div class="headings">
                    <h3>Product List</h3>
                </div>
            </div>
            <div class="table-wrapper col-12 bg-white p-3 rounded">
                <div class="pb-2" style="overflow-x: scroll;">
                    <form action="" method="post">
                        <div style="margin:35px 0px -55px 10px; position:relative;"
                            class="d-flex gap-2 justify-content-start">
                            <div style="z-index:520" class="col-md-2">
                                <label for="product-category" class="form-label">Product Category</label>
                                <select id="product-category" name="category" class="form-select" required>
                                    <option value="">Select Category</option>
                                    <?php foreach ($products['categories'] as $cat) { ?>
                                    <option value="<?= $cat['CategoryID'] ?>"><?= $cat['CategoryName'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <!-- Sub Category 01 -->
                            <div style="z-index:520" class="col-md-2">
                                <label for="sub-category-01" class="form-label">Sub Category 01</label>
                                <select id="sub-category-01" name="sub-category-1" class="form-select" required>
                                    <option value="">Select Sub Category</option>
                                </select>
                            </div>

                            <div style="z-index:520" class="col-md-2 align-items-end d-flex">
                                <button type="button" style="padding:6px 30px;border-radius:25px;" onclick="filterCat()"
                                    class="btn btn-dark mb-1 ">Filter</button>
                            </div>
                        </div>
                    </form>

                    <table id="product-list-Table" class="table hover">
                        <thead>
                            <tr>
                                <th>#</th> <!-- New column for numbering -->
                                <th>Product Name</th>
                                <th>Product ID</th>
                                <th>SKU</th>
                                <th>Category</th>
                                <th>Price( &#8377 )</th>
                                <th>Sale Price( &#8377 )</th>
                                <!-- <th>Statistics</th> -->
                                <th>Date Last Modified:</th>
                                <th>Stock</th>
                                <th class="action-head">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                    $counter = 1; // Initialize counter
                                    foreach ($products['result'] as $product) { ?>
                            <tr>
                                <td><?= $counter++; ?></td> <!-- Display the counter and increment it -->
                                <td class="d-flex justify-content-left gap-3 align-items-center show-contents-contents">
                                    <span class="image-container">
                                        <img class="product-image"
                                            src="<?= base_url('uploads/products/').$product['images'][0] ?>"
                                            alt="User Image">
                                    </span>
                                    <span style="font-size:14px" class="product-name text-left"
                                        id="product-name-<?= $product['id'] ?>">
                                        <?php
                                                $words = explode(' ', $product['jwellary_name']);
                                                $firstWords = implode(' ', array_slice($words, 0, 3));
                                                $remainingWords = implode(' ', array_slice($words, 3));
                                                ?>
                                        <span class="text-preview text-left"><?= $firstWords ?></span>
                                        <?php if (!empty($remainingWords)): ?>
                                        <span class="dots">...</span>
                                        <span class="more-text" style="display: none;"><?= $remainingWords ?></span>
                                        <a style="cursor:pointer;" onclick="toggleText('<?= $product['id'] ?>')"
                                            class="toggle-btn"><small>Show More</small></a>
                                        <?php endif; ?>
                                    </span>
                                </td>
                                <td><?= $product['jwellary_id']?></td>
                                <td><?= $product['varient_sku']?></td>
                                <td><?= $product['CategoryName']?></td>
                                <td><?= $product['base_price']?></td>
                                <td><?= $product['sale_price']?></td>
                                <!-- <td>Best Seller</td> -->
                                <td><?= $product['created_at']?></td>
                                <td><?= $product['stock']?></td>
                                <td>
                                    <div class="action-icons">
                                        <a href="#" class="icon View-icon" title="View"><img
                                                src="<?= base_url('assets/images/eye.png') ?>" alt="download"
                                                width="20px"></a>
                                        <button onclick="deletejwellary('<?= $product['id']?>')" class="icon hand-icon"
                                            title="delete"><img src="<?= base_url('assets/images/Trash.png') ?>"
                                                alt="Handle" width="20px"></button>
                                        <a href="<?= base_url('editJwellary/').$product['id']?>" class="icon pen-icon"
                                            title="Edit"><img src="<?= base_url('assets/images/edit.png') ?>" alt="Edit"
                                                width="20px"></a>
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
<div id="content"></div>
<div id="deleteConfirmationModal" class="modal" style="display: none;">
    <div class="modal-content">
        <div class="modal-logo">
            <img src="<?= base_url('/assets/images/images/header-new-logo.png') ?>" alt="Logo">
        </div>
        <p>Are you sure you want to delete this product?</p>
        <div class="d-flex gap-5 justify-content-center">
            <button id="confirmDelete" class="modal-btn">Yes</button>
            <button id="cancelDelete" class="modal-btn">No</button>
        </div>
    </div>
</div>
<div id="successModal" class="modal" style="display: none;">
    <div class="modal-content">
        <div class="modal-logo">
            <img src="<?= base_url('/assets/images/images/header-new-logo.png') ?>" alt="Logo">
        </div>
        <p>Jewellery deleted successfully!</p>
        <div class="d-flex justify-content-center">
            <button id="closeSuccessModal" class="modal-btn close-btn">OK</button>
        </div>
    </div>
</div>
<div id="errorModal" class="modal" style="display: none;">
    <div class="modal-content">
        <div class="modal-logo">
            <img src="<?= base_url('/assets/images/images/header-new-logo.png') ?>" alt="Logo">
        </div>
        <p>Something went wrong!!</p>
        <p><small>Error Deleting Jewellery</small></p>
        <div class="d-flex justify-content-center">
            <button id="closeSuccessModal" class="modal-btn close-btn">OK</button>
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
// code to load categories
$(document).ready(function() {
    $('#product-category').on('change', function() {
        var categoryID = $(this).val();
        loadSubCategories(categoryID, '#sub-category-01');
    });
});
// $('#sub-category-01').on('change', function() {
//     var subCategoryID = $(this).val();
//     filterCat(subCategoryID)
// });
// $('#sub-category-02').on('change', function() {
//     var subCategoryID = $(this).val();
//     loadSubCategories(subCategoryID, '#sub-category-03');
// });
function loadSubCategories(parentCategoryID, targetDropdown) {
    if (parentCategoryID) {
        console.log(parentCategoryID);
        $.ajax({
            url: '<?= base_url('getChildCategories/')?>' + parentCategoryID,
            method: 'GET',
            success: function(data) {
                var dropdown = $(targetDropdown);
                dropdown.empty();
                dropdown.append('<option value="">Select Sub Category</option>');

                var childCategories = JSON.parse(data);
                $.each(childCategories, function(index, childCategory) {
                    dropdown.append('<option value="' + childCategory.CategoryID + '">' +
                        childCategory.CategoryName + '</option>');
                });
            }
        });
    } else {
        $(targetDropdown).empty().append('<option value="">Select Sub Category</option>');
    }
}




//     $(document).ready(function() {
//         if (document.getElementById('product-list-Table').classList.contains('searched')) {
//     return;
// }

const productListTable = $('#product-list-Table').DataTable({
    paging: !$('#product-list-Table').hasClass('searched'), // If class 'searched' is present, disable paging
    searching: true,
    "pageLength": 20,
    "initComplete": function(settings, json) {
        $('#product-list-Table_filter input').attr('placeholder', 'Search Product name here');
    },
    "createdRow": function(row, data, dataIndex) {
        const stockCell = $('td', row).eq(7);
        if (stockCell.text().includes('In Stock')) {
            stockCell.css('color', 'blue');
        } else if (stockCell.text().includes('Out Stock')) {
            stockCell.css('color', 'red');
        }
    },
    columnDefs: [{
            width: "83px",
            targets: 2
        }, // Set width for the first column
        {
            width: "100px",
            targets: 4
        }, // Set width for the second column
        {
            width: "120px",
            targets: 5
        }, // Set width for the second column
        {
            width: "200px",
            targets: 7
        }, // Set width for the second column
    ],
    scrollX: true // Enable horizontal scrolling if necessary
});



function deletejwellary(id) {
    // Show the delete confirmation modal
    $('#deleteConfirmationModal').show();

    // Handle the confirmation button click
    $('#confirmDelete').click(function() {
        $.ajax({
            url: '<?= base_url('deletejwellary') ?>',
            type: "POST",
            data: JSON.stringify({
                id: id
            }), // Wrap id as JSON object
            contentType: 'application/json', // Ensure proper content type
            success: function(response) {
                var res = JSON.parse(response);
                if (res.status === 'success') {
                    // Show success modal
                    $('#successModal').show();
                    // Hide the confirmation modal
                    $('#deleteConfirmationModal').hide();
                } else {
                    alert(res.message); // Show error message from server if deletion fails
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', status, error);
                // alert('Error Deleting Jewelry');
                $("#errorModal").show();
            }
        });
    });

    // Handle the cancel button click
    $('#cancelDelete').click(function() {
        // Close the confirmation modal without doing anything
        $('#deleteConfirmationModal').hide();
    });

    // Handle closing the success modal
    $('#closeSuccessModal').click(function() {
        // Close the success modal
        $('#successModal').hide();
        // Optionally reload the page or navigate to another page
        window.location.reload(); // Refresh the page after successful deletion
    });
}

function toggleText(productId) {
    const dots = document.querySelector(`#product-name-${productId} .dots`);
    const moreText = document.querySelector(`#product-name-${productId} .more-text`);
    const btnText = document.querySelector(`#product-name-${productId} .toggle-btn`);

    if (dots.style.display === "none") {
        dots.style.display = "inline";
        moreText.style.display = "none";
        btnText.textContent = "Show More";
    } else {
        dots.style.display = "none";
        moreText.style.display = "inline";
        btnText.textContent = "Show Less";
    }
}



//     function editProduct(id)
// {
//     $.ajax({
//         url: '<?= base_url('editJwellary') ?>',
//         type: "POST",
//         data: JSON.stringify({ id: id }), // Wrap id as JSON object
//         contentType: 'application/json', // Ensure proper content type
//         success: function (response) {
//             $('#content').html(response);
//             // var res = JSON.parse(response);
//             // if (res.status === 'success') {

//             //     // var successModal = new bootstrap.Modal(document.getElementById('successModal'));
//             //     // successModal.show();
//             //     // Optionally, reload the page or refresh content here
//             // } else {
//             //     alert(res.message);
//             // }
//         },
//         error: function (xhr, status, error) {
//             console.error('AJAX Error:', status, error);
//             alert('Error Editing Jewelry');
//         }
//     });
// }

function filterCat() {
    const subCategoryId = document.getElementById('sub-category-01').value;
    window.location.href = '<?= base_url('Web/Admin/Admin/filteredlist/')?>' + subCategoryId;

}

function filterCatold() {
    const subCategoryId = document.getElementById('sub-category-01').value;

    $.ajax({
        url: '<?= base_url('getProductsByCategory') ?>',
        type: "POST",
        data: JSON.stringify({
            subCategoryId: subCategoryId
        }), // Wrap id as JSON object
        contentType: 'application/json', // Ensure proper content type
        success: function(response) {
            const res = JSON.parse(response);
            console.log(res);
            if (res.status === 'success') {
                document.getElementsByClassName('table')[0].classList.add('searched');

                const tableBody = document.querySelector('.table tbody');
                tableBody.innerHTML = ''; // Clear existing rows

                if (res.message.length <= 0) {
                    alert('No products in this category');
                } else {

                    // Populate the table with the fetched products
                    res.message.forEach((product, index) => {
                        const row = document.createElement('tr');

                        row.innerHTML = `
                            <td>${index + 1}</td> <!-- Counter -->
                            <td class="d-flex justify-content-left gap-3 align-items-center">
                                <span class="image-container">
                                    <img class="product-image" src="<?= base_url('uploads/products/') ?>${product.images[0]}" alt="Product Image">
                                </span>
                                <span style="font-size:14px" class="product-name text-left" id="product-name-${product.id}">
                                    ${formatProductName(product.jwellary_name, product.id)}
                                </span>
                            </td>
                            <td>${product.jwellary_id}</td>
                            <td>${product.CategoryName}</td>
                            <td>${product.base_price}</td>
                            <td>${product.sale_price}</td>
                            <td>${product.created_at}</td>
                            <td>${product.stock}</td>
                            <td>
                                <div class="action-icons">
                                    <a href="#" class="icon View-icon" title="View">
                                        <img src="<?= base_url('assets/images/eye.png') ?>" alt="View" width="20px">
                                    </a>
                                    <button onclick="deletejwellary('${product.id}')" class="icon hand-icon" title="Delete">
                                        <img src="<?= base_url('assets/images/Trash.png') ?>" alt="Delete" width="20px">
                                    </button>
                                    <a href="<?= base_url('editJwellary/') ?>${product.id}" class="icon pen-icon" title="Edit">
                                        <img src="<?= base_url('assets/images/edit.png') ?>" alt="Edit" width="20px">
                                    </a>
                                </div>
                            </td>
                        `;

                        tableBody.appendChild(row);
                    });
                }
            } else {
                alert('Something went wrong');
            }
        },
        error: function(xhr, status, error) {
            console.error('AJAX Error:', status, error);
            alert('Error fetching products');
        }
    });
}

// Helper function to format product name with "Show More" functionality
function formatProductName(productName, productId) {
    const words = productName.split(' ');
    const firstWords = words.slice(0, 3).join(' ');
    const remainingWords = words.slice(3).join(' ');

    if (remainingWords) {
        return `
            <span class="text-preview text-left">${firstWords}</span>
            <span class="dots">...</span>
            <span class="more-text" style="display: none;">${remainingWords}</span>
            <a style="cursor:pointer;" onclick="toggleText('${productId}')" class="toggle-btn">
                <small>Show More</small>
            </a>
        `;
    } else {
        return `<span class="text-preview text-left">${productName}</span>`;
    }
}

// Toggle function for "Show More" text
function toggleText(productId) {
    const productNameElement = document.getElementById(`product-name-${productId}`);
    const dots = productNameElement.querySelector('.dots');
    const moreText = productNameElement.querySelector('.more-text');
    const toggleBtn = productNameElement.querySelector('.toggle-btn');

    if (moreText.style.display === 'none') {
        dots.style.display = 'none';
        moreText.style.display = 'inline';
        toggleBtn.innerHTML = '<small>Show Less</small>';
    } else {
        dots.style.display = 'inline';
        moreText.style.display = 'none';
        toggleBtn.innerHTML = '<small>Show More</small>';
    }
}
</script>
</body>

</html>