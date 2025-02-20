<?php $this->load->View('Admin/header') ?>
        <div class="content">
            <div class="table-header d-flex justify-content-between align-items-center ms-4">
                <div class="headings">       
                    <h3>All Sub-Category</h3>
                    <h6>Lorem Ipsum is simply dummy text</h6>
                </div>
                <div class="d-flex g-2 align-items-center">
                    <div class="daterange">
                        <img src="<?= base_url('assets/images/calender.png')?>" alt="img">
                        <input type="text" name="daterange" id="daterange" class="form-control" placeholder="20/07/2024" />
                    </div>
                </div>
            </div>
            <div class="row g-3">
                <div class="col-md-3">
                    <div class="">
                      <form action="">
                        <div class="card p-4">
                            <h3 class="mb-4 card-heading">Add New Sub-Category</h3>
                            
                            <!-- Category Name Input -->
                            <div class="mb-3">
                                <label for="categoryName" class="form-label">Category Name</label>
                                <input type="text" class="form-control" id="categoryName" placeholder="Enter Category Name">
                            </div>
                    
                            <!-- Sub Category Name Input -->
                            <div class="mb-3">
                                <label for="subCategoryName" class="form-label">Sub Category Name</label>
                                <input type="text" class="form-control" id="subCategoryName" placeholder="Enter Sub Category Name">
                            </div>
                    
                            <!-- Display Type Input -->
                            <div class="mb-3">
                                <label for="displayType" class="form-label">Display Type</label>
                                <!-- <input type="text" class="" id="" placeholder="Enter Display Type"> -->
                                <select name="" id="displayType" class="form-control">
                                    <option value="default">Default</option>
                                    <option value="hidden">Hidden</option>
                                </select>
                            </div>
                    
                            <!-- Description Textarea -->
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" rows="4" placeholder="Type Product Description here..."></textarea>
                            </div>
                    
                            <!-- Image Uploader -->
                            <div id="product-category" class="mb-4 text-center p-3 uploader-container">
                                <div class="uploader uploader-image">
                                    <img src="https://via.placeholder.com/50" alt="Image Preview">
                                        <input type="file" accept="image/*">
                                        <span class="upload-text">SUB-CATEGORY IMAGES</span>
                                </div>
                            </div>
                    
                            <!-- Save Button -->
                            <div class="d-grid">
                                <button class="btn btn-primary btn-lg">Save Now</button>
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
                                    <option  value="Active" selected>In-Stock</option>
                                   <option  value="Non-active">Out-Stock</option>
                               </select>
                                <!-- <button type="button" class="btn btn-light"><span class="material-symbols-outlined">
                                    tune
                                    </span>FILTERS</button> -->
                            </div>                            
    
                            <table  id="category-detail-Table" class=" table hover">
                                <thead >
                                    <tr >
                                        <th>Sub Categorie</th>
                                        <th>Category</th>
                                        <th>Statistics</th>
                                        <th>Sub</th>
                                        <th>Created At</th>
                                        <th>Stock</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <td><img class="product-image" src="<?= base_url('assets/images/product-1.png') ?>" alt="User Image">Mens</td>
                                    <td>Fashion</td>
                                    <td>Best Seller</td>
                                    <td>450</td>
                                    <td>March 13,2024</td>
                                    <td>In Stock(145)</td>
                                    <td><div class="action-icons">
                                        <a href="#" class="icon View-icon" title="View"><img src="<?= base_url('assets/images/eye.png') ?>" alt="download" width="20px"></a>
                                        <a href="#" class="icon hand-icon" title="delete"><img src="<?= base_url('assets/images/Trash.png') ?>" alt="Handle" width="20px"></a>
                                        <a href="#" class="icon pen-icon" title="Edit"><img src="<?= base_url('assets/images/edit.png') ?>" alt="Edit" width="20px"></a>
                                    </div></td>
                                  </tr>
                                  <tr>
                                    <td><img class="product-image" src="<?= base_url('assets/images/product-1.png') ?>" alt="User Image">Mens</td>
                                    <td>Fashion</td>
                                    <td>Best Seller</td>
                                    <td>450</td>
                                    <td>March 13,2024</td>
                                    <td>Out Stock</td>
                                    <td><div class="action-icons">
                                        <a href="#" class="icon View-icon" title="View"><img src="<?= base_url('assets/images/eye.png') ?>" alt="download" width="20px"></a>
                                        <a href="#" class="icon hand-icon" title="delete"><img src="<?= base_url('assets/images/Trash.png') ?>" alt="Handle" width="20px"></a>
                                        <a href="#" class="icon pen-icon" title="Edit"><img src="<?= base_url('assets/images/edit.png') ?>" alt="Edit" width="20px"></a>
                                    </div></td>
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
    <script src="<?= base_url('assets/javascript/common.js') ?>"></script>




    <script>
    $(document).ready(function() {
   

         $('#category-detail-Table').DataTable({
            searching: true,
            "pageLength": 10,
            "initComplete": function(settings, json) {
                $('#category-detail-Table_filter input').attr('placeholder', 'Search Category here');
            },
        "createdRow": function(row, data, dataIndex) {
            const stockCell = $('td', row).eq(5);
            if (stockCell.text().includes('In Stock')) {
                stockCell.css('color', 'blue');
            } else if (stockCell.text().includes('Out Stock')) {
                stockCell.css('color', 'red');
            }
        }
    });

     
    });



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
    </script>
</body>
</html>













<style>
      .table-wrapper .btn-outline-success{
            display: none;
        }
        .dataTables_wrapper .dataTables_filter{
            right: 10vw;
        }
        .table-header .headings{
            margin-bottom: 0px ;
            margin-top: 30px;
        }
       
        .profile-card{
            margin-top: 66px;
        }
        .profile-img{
            margin-bottom: 80px;
        }
        .profile-img #uploadIcon{
            right: 35px;
        }

        .select-status option {
            color: black; /* Fallback color */
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

        #category-detail-Table  .discription{
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
.card-heading{
    font-size: 19px;
    font-weight: 600;

}

.form-label {
    font-weight:600;
}

.uploader-container {
    background-color: #f1f5f9;
    border-radius: 10px;
    width: 260px;
    HEIGHT: 200px;
    padding: 20px;
}
.uploader-container .upload-text{
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
