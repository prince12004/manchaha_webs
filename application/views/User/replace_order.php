<!-- Modal Structure -->
<div id="alertModal" class="modal" style="display: none;">
    <div class="modal-content">
        <div class="modal-logo">
            <img src="<?= base_url('/assets/images/images/header-new-logo.png') ?>" alt="Logo">
        </div>
        <h2 id="alertResponse">This is a default message.</h2>
        <div class="modal-buttons">
            <button class="close-btn" onclick="closeAlertModal()">OK</button>
        </div>
    </div>
</div>

<style>
    .modal {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        display: none;
        justify-content: center;
        align-items: center;
        z-index: 200000;
    }
    .modal-content {
        background-color: white;
        padding: 20px;
        border-radius: 10px;
        max-width: 400px;
        width: 100%;
        text-align: center;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }
    .modal-logo {
        margin-bottom: 20px;
    }

    .modal-logo img {
        width: 100px;
    }

    /* Modal Text */
    .modal h2 {
        font-size: 18px;
        margin: 5px 0;
        color: #333;
    }

    /* Modal Close Button */
    .close-btn {
        background-color: #007bff;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        margin-top: 20px;
        transition: background-color 0.3s ease;
    }

    .close-btn:hover {
        background-color: #0056b3;
    }

    .modal-buttons {
        margin-top: 0px;
    }

    .new-replacement {
        display: flex;
        flex-direction: column;
        width: 40%;
        margin: 20px auto;
        padding: 20px;
        background-color: #FFFFFF;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .replacement {
        display: flex;
        flex-direction: column;
    }

    .replacement label {
        font-size: 14px;
        color: #333;
        margin-bottom: 5px;
    }

    .replacement select,
    .replacement input[type="text"],
    .replacement input[type="file"] {
        padding: 10px;
        outline: none;
        font-size: 14px;
        border: 1px solid #ddd;
        border-radius: 5px;
        margin-bottom: 15px;
    }

    .replacement input[type="text"] {
        height: 40px;
    }

    .replacement input[type="file"] {
        display: none;
    }

    .replacement .upload-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #28a745;
        padding: 10px;
        border-radius: 5px;
        color: white;
        cursor: pointer;
        text-align: center;
        width: fit-content;
        margin-bottom: 15px;
    }

    .replacement .upload-btn i {
        margin-right: 5px;
    }

    .preview-container {
        margin-top: 10px;
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .preview-container img {
        width: 230px;
        height: 160px;
        object-fit: cover;
        border-radius: 8px;
    }

    .delete-btn {
        background-color: #ff4747;
        color: white;
        border: none;
        padding: 5px 10px;
        border-radius: 5px;
        cursor: pointer;
        margin-top: 10px;
    }

    .delete-btn:hover {
        background-color: #d33;
    }

    .submit-btn {
        padding: 12px 20px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        text-align: center;
        margin-top: 10px;
    }
    label span{
        color: red;
    }
    .submit-btn:hover {
        background-color: #0056b3;
    }

    @media (max-width: 768px) {
    .new-replacement {
        width: 90%;
    }
    .newsLetter-section{
        margin-top: 30px;
    }
    .modal-content {
        width: 90%;
    }
    .preview-container {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }
    .preview-container img{
        width: 48%;
        height: 100px;
    }
}

</style>

<section class="new-replacement">
    <div class="mains-section">
        <div class="replacement">
            <label for="replacement-reason">Reason for Replacement</label>
            <select id="replacement-reason" required onchange="showImageInput()">
                <option value="">Select a reason</option>
                <option value="Damaged">Damaged Item</option>
                <option value="Wrong Size">Wrong Size</option>
                <option value="Defective">Defective Product</option>
                <option value="Incorrect Color">Incorrect Color</option>
                <option value="Other">Other</option>
            </select>

            <label for="comments">Comments <span>*</span> </label>
            <input type="text" id="comments" placeholder="Enter your comment" required>

            <div id="image-container" style="display: none;">
                <label for="image-upload" class="upload-btn">
                    <i class="fa fa-upload"></i> Upload Image
                </label>
                <input type="file" id="image-upload" accept="image/*" onchange="previewImage()" required>
            </div>

            <div id="preview-container" class="preview-container">
                <!-- Image previews will appear here -->
            </div>

            <button class="submit-btn" onclick="submitForm(event)">Submit Replacement Request</button>
        </div>
    </div>
</section>

<script>
    // Function to show the image input when a reason is selected
    function showImageInput() {
        const reason = document.getElementById('replacement-reason').value;
        const imageContainer = document.getElementById('image-container');

        // Only show the image upload input if reason is 'Damaged', 'Defective', 'Incorrect Color', or 'Other'
        if (reason === 'Damaged' || reason === 'Defective' || reason === 'Incorrect Color' || reason === 'Other') {
            imageContainer.style.display = 'block';
        } else {
            imageContainer.style.display = 'none';
            document.getElementById('preview-container').innerHTML = ''; // Clear previews
        }
    }

   // Function to preview the uploaded image
function previewImage() {
    const fileInput = document.getElementById('image-upload');
    const previewContainer = document.getElementById('preview-container');
    const file = fileInput.files[0];

    if (file) {
        // // Check file size (100KB)
        // if (file.size > 100 * 1024) { 
        //     showAlert('The file size is too large. Please upload an image less than 100KB.');
        //     return;
        // }

        if (previewContainer.children.length >= 2) {
            showAlert('You can upload a maximum of 2 images.');
            return;
        }

        const reader = new FileReader();

        reader.onload = function(event) {
            const img = document.createElement('img');
            img.src = event.target.result;
            img.classList.add('preview-img');
            previewContainer.appendChild(img);
        };

        reader.readAsDataURL(file);
    }
}


    // Function to show a modal with a custom alert message
    function showAlert(message) {
        document.getElementById('alertResponse').innerText = message; // Set the alert message
        document.getElementById('alertModal').style.display = 'flex'; // Show modal
    }

    // Function to close the alert modal
    function closeAlertModal() {
        document.getElementById('alertModal').style.display = 'none'; // Hide modal
    }

    // Function to submit the form, ensuring all required fields are filled
    function submitForm(event) {
        event.preventDefault(); // Prevent form submission for validation

        // Check if all required fields are filled
        const reason = document.getElementById('replacement-reason').value;
        const comments = document.getElementById('comments').value;
        const imageCount = document.getElementById('preview-container').children.length / 2; // Each image has a delete button

        if (!reason || !comments || imageCount === 0) {
            showAlert('Please fill in all required fields and upload at least one image.');
            return;
        }

        // If everything is filled, you can submit the form here or perform the required action
        showAlert('Replacement request submitted successfully!');
    }
</script>
