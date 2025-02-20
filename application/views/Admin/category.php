<?php $this->load->view('Admin/header') ?>
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
    max-width: 400px;
    width: 100%;
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

.eye-icon span {
    font-size: 17px !important;
    color: #666 !important;
}

.error-message {
    color: red;
    font-size: 13px
}

#category-detail-Table tr .product-image {
    width: 55px !important;
    height: 55px !important;
    border-radius: 50% !important;
    border: 3px solid #4A90E2;
    margin: 2px 0px;
}

table.dataTable tbody td {
    padding: 12px 10px;
}
</style>
<div class="content">
    <div class="table-header d-flex justify-content-between align-items-center ms-4">
        <div class="headings mb-5">
            <h3>All Category</h3>
        </div>
        <div class="d-flex g-2 align-items-center">
            <a href="<?= base_url('Web/Admin/Admin/subCategory') ?>">
                <button class="btn btn-primary px-3 me-2 d-flex align-items-center"><span
                        class="material-symbols-outlined">
                        add_circle
                    </span> Add Sub-Category
                </button>
            </a>
            <!-- <div class="daterange">
                        <img src="<?= base_url('assets/images/calender.png') ?>" alt="img">
                        <input type="text" name="daterange" id="daterange" class="form-control" placeholder="20/07/2024" />
                    </div> -->
        </div>
    </div>
    <div class="row g-3">
        <div class="col-md-3">
            <div class="">
                <form action="">
                    <div class="card p-4">
                        <h3 class="mb-4 card-heading">Add New Category</h3>

                        <!-- Category Name Input -->
                        <div class="mb-3">
                            <label for="categoryName" class="form-label">Category Name</label>
                            <input type="text" class="form-control" id="categoryName" name="categoryname"
                                value="<?= set_value('categoryname')?>" placeholder="Enter Category Name">
                        </div>

                        <!-- Sub Category Name Input -->
                        <div class="mb-3">
                            <label for="subCategoryName" class="form-label">Sub Category Name</label>
                            <select type="text" class="form-control" id="subCategoryName" name="subcategoryid">
                                <option value="">select subcategory</option>
                                <?php foreach ($categories as $cat) {?>
                                <option value="<?= $cat['CategoryID']?>"><?= $cat['CategoryName']?></option>
                                <?php }?>
                            </select>
                        </div>

                        <!-- Display Type Input -->
                        <div class="mb-3">
                            <label for="displayType" class="form-label">Display Type</label>
                            <!-- <input type="text" class="" id="" placeholder="Enter Display Type"> -->
                            <select name="categorystatus" id="displayType" class="form-control">
                                <option value="1">Default</option>
                                <option value="2">Hidden</option>
                            </select>
                        </div>

                        <!-- Description Textarea -->
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" name="categorydescription"
                                value="<?= set_value('description')?>" id="description" rows="4"
                                placeholder="Type Product Description here..."></textarea>
                        </div>

                        <!-- Image Uploader -->
                        <div id="product-category" class="mb-4 text-center p-3 uploader-container">
                            <div class="uploader uploader-image">
                                <img src="https://via.placeholder.com/50" alt="Image Preview">
                                <input type="file" id="catimage" name="categoryimage" accept="image/*">
                                <span class="upload-text">UPLOAD CATEGORY IMAGE</span>
                            </div>
                        </div>

                        <!-- Save Button -->
                        <div class="d-grid">
                            <button type="button" onclick="saveCategory('<?= $cat['CategoryID']?>')"
                                class="btn btn-primary btn-lg">Save Now</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-9 ">

            <div class="table-wrapper col-12 bg-white p-3 rounded">
                <div class="pb-2" style="overflow-x: scroll;">
                    <div class="buttons-filter">
                        <select class="btn btn-light select-status">
                            <option value="Active" selected>Published</option>
                            <option value="Non-active">Un-Published</option>
                        </select>
                        <!-- <button type="button" class="btn btn-light"><span class="material-symbols-outlined">
                                    tune
                                    </span>FILTERS</button> -->
                    </div>

                    <table id="category-detail-Table" class=" table hover">
                        <thead>
                            <tr>
                                <th>Categorie</th>
                                <th>ID</th>
                                <th>Description</th>
                                <!-- <th>Sub</th> -->
                                <th>Created At</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($categories as $category) {?>
                            <tr>
                                <td class="d-flex justify-content-start align-items-center gap-2"><img
                                        class="product-image" style="height: 50px;"
                                        src="<?= $category['categoryImage']?>"
                                        alt="User Image"><?= $category['CategoryName']?></td>
                                <td><?= $category['CategoryID']?></td>
                                <td class="discription"><?= $category['CategoryDescription']?></td>
                                <!-- <td><?= !empty($category['child_category_id']) ? $category['child_category_id'] : '-'; ?></td> -->
                                <td><?= date('M d, Y', strtotime($category['CreatedDate'])); ?></td>
                                <td><select class="select-status">
                                        <option class="Approved" value="Published">Pubished</option>
                                        <option class="Onhold" value="Scheduled">Scheduled</option>
                                        <option class="cancel" value="hidden">Hidden</option>
                                    </select></td>
                                <td>
                                    <div class="action-icons">
                                        <a href="#" class="icon view-icon" title="view"><img
                                                src="<?= base_url('assets/images/eye.png') ?>" alt="view"
                                                width="20px"></a>
                                        <button onclick="deletecategory('<?= $category['CategoryID']?>')"
                                            class="icon hand-icon" title="delete"><img
                                                src="<?= base_url('assets/images/Trash.png') ?>" alt="Handle"
                                                width="20px"></button>
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
<div id="alertModal" class="modal" style="display: none;">
    <div class="modal-content">
        <!-- Logo in the center -->
        <div class="modal-logo">
            <img src="<?= base_url('/assets/images/images/header-new-logo.png') ?>" alt="Logo">
        </div>
        <h2 id="alertResponse"></h2>
        <button class="close-btn" onclick="closeAlertModal()">Close</button>
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


    $('#category-detail-Table').DataTable({
        searching: true,
        "pageLength": 10,
        "initComplete": function(settings, json) {
            $('#category-detail-Table_filter input').attr('placeholder', 'Search Category here');
        }
    });

    // Set initial colors for select options
    $('#category-detail-Table').find('.select-status').each(function() {
        const option = $(this).find('option:selected');
        if (option.hasClass('Pending')) {
            $(this).css('color', 'rgba(236, 140, 56, 1)');
        } else if (option.hasClass('Approved')) {
            $(this).css('color', 'rgba(37, 222, 104, 1)');
        } else if (option.hasClass('Onhold')) {
            $(this).css('color', 'rgba(46, 91, 255, 1)');
        } else if (option.hasClass('cancel')) {
            $(this).css('color', 'rgba(236, 79, 79, 1)');
        }
    });

    // Apply color to select options on change
    $('#category-detail-Table').on('change', '.select-status', function() {
        const option = $(this).find('option:selected');
        if (option.hasClass('Pending')) {
            $(this).css('color', 'rgba(236, 140, 56, 1)');
        } else if (option.hasClass('Approved')) {
            $(this).css('color', 'rgba(37, 222, 104, 1)');
        } else if (option.hasClass('Onhold')) {
            $(this).css('color', 'rgba(46, 91, 255, 1)');
        } else if (option.hasClass('cancel')) {
            $(this).css('color', 'rgba(236, 79, 79, 1)');
        }
    });
});

function alertModal() {
    event.preventDefault();
    const modal = document.getElementById('alertModal');
    modal.style.display = 'block';
}

// Function to close the modal
function closeAlertModal() {
    event.preventDefault();
    const modal = document.getElementById('alertModal');
    modal.style.display = 'none';
}



// Trigger file input when clicking on image upload section
$('#product-category').on('click', '.uploader-image', function(event) {
    // Prevent recursion by stopping click event from re-triggering the parent
    if (!$(event.target).is('input[type="file"]')) {
        $(this).find('input[type="file"]').click();
    }
});

// Image upload functionality
$('#product-category').on('change', '.uploader-image input[type="file"]', function() {
    const $imageUpload = $(this).closest('.uploader-image');
    const file = this.files[0];
    const reader = new FileReader();

    reader.onload = function(e) {
        $imageUpload.find('img').attr('src', e.target.result).show();
        $imageUpload.find('span').hide();
    }

    if (file) {
        reader.readAsDataURL(file);
    }
});


function deletecategory(id) {
    console.log(id);
    $.ajax({
        url: '<?= base_url("deletecategory") ?>',
        type: 'POST',
        data: {
            id: id
        }, // Send ID as an object
        dataType: 'json', // Expect JSON response
        success: function(response) {
            response = JSON.parse(response);
            if (response.status === 'success') {
                // alert('Category deleted successfully');
                document.getElementById('alertResponse').innerHTML = "Category deleted successfully";
                alertModal();
                location.reload();
            } else {
                // alert('Error: ' + response.message);
                document.getElementById('alertResponse').innerHTML = 'Error: ' + response.message;
                alertModal();
            }
        },
        error: function(xhr, status, error) {
            console.error('Something went wrong:', error);
            alert('An error occurred. Please try again.');
            document.getElementById('alertResponse').innerHTML = 'An error occurred. Please try again';
            alertModal();
        }
    });
}



function saveCategory() {
    // Get form elements
    const formData = new FormData();
    formData.append('categoryname', document.getElementById('categoryName').value);
    formData.append('subcategoryid', document.getElementById('subCategoryName').value);
    formData.append('categorystatus', document.getElementById('displayType').value);
    formData.append('categorydescription', document.getElementById('description').value);

    // Get the uploaded file
    const categoryImage = document.getElementById('catimage').files[0];
    if (categoryImage) {
        formData.append('categoryimage', categoryImage);
    }

    // AJAX request to CodeIgniter controller
    $.ajax({
        url: '<?= base_url("savecategory") ?>',
        type: 'POST',
        data: formData,
        processData: false, // Prevent jQuery from automatically processing the data
        contentType: false, // Prevent jQuery from setting contentType
        success: function(response) {
            response = JSON.parse(response);
            if (response.status === 'success') {
                // alert('Category saved successfully');
                document.getElementById('alertResponse').innerHTML = 'Category saved successfully';
                alertModal();
                location.reload();
            } else {
                // alert('Error: ' + response.message);
                document.getElementById('alertResponse').innerHTML = 'Error: ' + response.message;
                alertModal();
            }
        },
        error: function(xhr, status, error) {
            console.error('Something went wrong:', error);
            alert('An error occurred. Please try again.');
            document.getElementById('alertResponse').innerHTML = 'An error occurred. Please try again.';
            alertModal();
        }
    });
}
</script>
</body>

</html>




<style>
.table-wrapper .btn-outline-success {
    display: none;
}

.dataTables_wrapper .dataTables_filter {
    right: 12vw;
}

.table-header .headings {
    margin-bottom: 0px;
    margin-top: 30px;
}

.table-header .btn-primary {
    font-size: 14px;
    border-radius: 42px;
    box-shadow: 0px 2px 10px #4a53d177;
}

.profile-card {
    margin-top: 66px;
}

.profile-img {
    margin-bottom: 80px;
}

.profile-img #uploadIcon {
    right: 35px;
}

.select-status option {
    color: black;
    /* Fallback color */
}

.select-status option.Pending {
    color: rgba(236, 140, 56, 1);
}

.select-status option.Approved {
    color: rgba(37, 222, 104, 1);
}

.select-status option.Onhold {
    color: rgba(46, 91, 255, 1);
}

.select-status option.cancel {
    color: rgba(236, 79, 79, 1);
}

#category-detail-Table .discription {
    min-width: min-content !important;
}


.card {
    max-width: 500px;
    margin: 0 auto;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    border: none;
    /* margin-top: 70px; */
}

.card-heading {
    font-size: 19px;
    font-weight: 600;

}

.form-label {
    font-weight: 600;
}

.uploader-container {
    background-color: #f1f5f9;
    border-radius: 10px;
    width: 260px;
    HEIGHT: 200px;
    padding: 20px;
}

.uploader-container .upload-text {
    cursor: pointer;
    padding: 5px 10px;
    font-size: 14px;
    border-radius: 10px;
    background-color: rgb(96, 96, 242);
    color: #FFF;

}

.uploader-image img {
    max-width: 100%;
    max-height: 100%;
    display: none;
}

.uploader-image input[type="file"] {
    display: none;
}



.btn-primary {
    background-color: #5c67f2;
    border-color: #5c67f2;
    padding: 6px 10px;
    font-size: 16px;
}

.btn-primary:hover {
    background-color: #4a54d1;
    border-color: #4a54d1;
}
</style>