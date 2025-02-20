<style>
    .mains-review {
        width: 100%;
        background-color: #FFFFFF;
    }

    .revieewss {
        width: 100%;
        margin: 40px auto;
        display: flex;
        justify-content: center;
    }

    .main-ratings {
        width: 26%;
    }

    .stars {
        text-align: center;
    }

    .star {
        font-size: 52px;
        color: #ccc; /* Default gray color for empty stars */
        cursor: pointer;
    }

    .star.selected {
        color: yellow; /* Yellow color for selected stars */
    }

    .input-review {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .input-review input {
        width: 100%;
        padding: 10px;
        border-radius: 5px;
        border: 1px solid #ccc;
        font-size: 15px;
    }

    .buttonss {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 10px;
    }

    .review-buuton {
        background-color: #007bff;
        color: #FFFFFF;
        border: 1px solid #007bff;
        padding: 8px 25px;
        font-size: 16px;
        border-radius: 50px;
    }

    .file-input-wrapper {
        position: relative;
        width: 100%;
        padding: 12px;
        background-color: #FFFFFF;
        border-radius: 5px;
        display: flex;
        align-items: center;
        border: 1px solid #ccc;
        justify-content: center;
    }

    .file-input-wrapper input[type="file"] {
        opacity: 0; /* Hide the default file input button */
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        cursor: pointer;
    }

    .file-input-wrapper label {
        background-size: 20px 20px;
        background-repeat: no-repeat;
        background-position: left 10px center;
        padding-left: 10px;
        color: #555;
    }

    .file-input-wrapper input[type="file"]:focus + label,
    .file-input-wrapper label:hover {
        color: #333;
    }

    .image-preview-container {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 10px;
    }

    .image-preview {
        position: relative;
        width: 100px;
        height: 100px;
    }

    .image-preview img {
        width: 100%;
        height: 100%;
        display: block;
    }

    .image-preview .delete-icon {
        position: absolute;
        top: 2px;
        right: 4px;
        background: rgba(0, 0, 0, 0.5);
        color: #fff;
        border-radius: 50%;
        padding: 3px 5px;
        font-size: 15px;
        cursor: pointer;
    }
</style>
<?php
$token = $this->session->userdata('userToken');
$this->load->model('UserModel');
$data = $this->UserModel->get_user($token);

$query = $this->db->select('reviews.*, GROUP_CONCAT(review_images.image_url) AS images, GROUP_CONCAT(review_images.id) AS image_ids')
    ->from('reviews')
    ->where([
        'reviews.user_id' => $data['UserID'],
        'reviews.varient_id' => $this->session->userdata('reviewVarient')
    ])
    ->join('review_images', 'reviews.id = review_images.review_id', 'left')
    ->group_by('reviews.id')
    ->get();

$result = $query->row_array();

// Convert images into an array
$result['images'] = !empty($result['images']) ? explode(',', $result['images']) : [];
$result['image_ids'] = !empty($result['image_ids']) ? explode(',', $result['image_ids']) : [];
// print_r($result['images']);
// exit;
?>


<section class="mains-review">
    <div class="revieewss">
        <div class="main-ratings">
            <div class="stars">
                <p>Rate your experience:</p>
                <span class="star <?= ($result['rating']>=1) ? 'selected' :''?>"  data-value="1">&#9733;</span>
                <span class="star <?= ($result['rating']>=2) ? 'selected' :''?>" data-value="2">&#9733;</span>
                <span class="star <?= ($result['rating']>=3) ? 'selected' :''?>" data-value="3">&#9733;</span>
                <span class="star <?= ($result['rating']>=4) ? 'selected' :''?>" data-value="4">&#9733;</span>
                <span class="star <?= ($result['rating']==5) ? 'selected' :''?>" data-value="5">&#9733;</span>
            </div>
            <div class="input-review">
                <input type="text" name="review" value="<?= $result['review']?>" placeholder="Enter your review">
                
                <!-- Show Existing Images -->
                <div class="existing-images">
                    <?php foreach ($result['images'] as $key => $image): ?>
                        <div class="image-preview" data-id="<?= $result['image_ids'][$key] ?>">
                            <img src="<?= base_url('uploads/reviews/' . $image) ?>" />
                            <span class="delete-existing-image">X</span>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="file-input-wrapper">
                    <input type="file" id="fileInput" multiple onchange="validateFiles()">
                    <label for="fileInput"> <img src="<?= base_url('assets/images/selects.png') ?>" /> Select images</label>
                </div>
                
                <div class="image-preview-container" id="imagePreviewContainer">
                    <!-- New image previews will appear here -->
                </div>

                <div class="buttonss">
                    <button type="button" onclick="submitReview()" class="review-buuton">Submit</button>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    let selectedRating = 0; // Store selected rating
let selectedFiles = []; // Store new images
let removedImages = []; // Store IDs of removed images

// Handle star rating
document.querySelectorAll(".star").forEach(function (star) {
    star.addEventListener("click", function () {
        selectedRating = parseInt(star.getAttribute("data-value"));
        document.querySelectorAll(".star").forEach(function (s) {
            s.classList.remove("selected");
            if (parseInt(s.getAttribute("data-value")) <= selectedRating) {
                s.classList.add("selected");
            }
        });
    });
});

// Handle new image uploads
document.getElementById("fileInput").addEventListener("change", function (e) {
    let files = e.target.files;
    let imagePreviewContainer = document.getElementById("imagePreviewContainer");
    
    Array.from(files).forEach(function (file, index) {
        selectedFiles.push(file); // Store new file

        let reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = function (event) {
            let imagePreviewDiv = document.createElement("div");
            imagePreviewDiv.classList.add("image-preview");

            let imgElement = document.createElement("img");
            imgElement.src = event.target.result;

            let deleteIcon = document.createElement("span");
            deleteIcon.classList.add("delete-icon");
            deleteIcon.textContent = "X";

            imagePreviewDiv.appendChild(imgElement);
            imagePreviewDiv.appendChild(deleteIcon);
            imagePreviewContainer.appendChild(imagePreviewDiv);

            // Remove new image from selection
            deleteIcon.addEventListener("click", function () {
                imagePreviewContainer.removeChild(imagePreviewDiv);
                selectedFiles.splice(index, 1);
            });
        };
    });
});

// Handle existing image deletion
document.querySelectorAll(".delete-existing-image").forEach(function (deleteBtn) {
    deleteBtn.addEventListener("click", function () {
        let parentDiv = deleteBtn.parentElement;
        let imageId = parentDiv.getAttribute("data-id");

        removedImages.push(imageId); // Store ID of removed image
        parentDiv.remove();
    });
});

// Submit Review
function submitReview() {
    let reviewText = document.querySelector(".input-review input").value;
    if (!selectedRating) {
        alert("Please select a rating!");
        return;
    }

    let formData = new FormData();
    formData.append("rating", selectedRating);
    formData.append("review", reviewText);

    // Append new images
    selectedFiles.forEach((file, index) => {
        formData.append(`images[]`, file);
    });

    // Append removed image IDs
    removedImages.forEach((id) => {
        formData.append("removed_images[]", id);
    });

    $.ajax({
        url: "<?= base_url('review/save') ?>",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
            alert("Review submitted successfully!");
            location.reload();
        },
        error: function () {
            alert("Error submitting review!");
        }
    });
}

    function validateFiles() {
        const fileInput = document.getElementById('fileInput');
        const files = fileInput.files;

        // Check if more than two files are selected
        if (files.length > 2) {
            alert("You can only upload up to 2 images.");
            fileInput.value = ""; // Clear the input field
        }
    }
</script>

