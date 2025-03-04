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
    /* Modal Background */
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

    /* Modal Content */
    .modal-content {
        background-color: white;
        padding: 20px;
        border-radius: 10px;
        max-width: 400px;
        width: 100%;
        text-align: center;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    /* Logo in the modal */
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

    .new-return {
        display: flex;
        flex-direction: column;
        width: 40%;
        margin: 20px auto;
        padding: 20px;
        background-color: #FFFFFF;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .rertuns {
        display: flex;
        flex-direction: column;
    }

    .rertuns label {
        font-size: 14px;
        color: #333;
        margin-bottom: 5px;
    }

    .rertuns select,
    .rertuns input[type="text"],
    .rertuns input[type="file"] {
        padding: 10px;
        outline: none;
        font-size: 14px;
        border: 1px solid #ddd;
        border-radius: 5px;
        margin-bottom: 15px;
    }

    .rertuns input[type="text"] {
        height: 40px;
    }

    .rertuns input[type="file"] {
        display: none;
    }

    .rertuns .upload-btn {
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

    .rertuns .upload-btn i {
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
    .new-return {
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

<section class="new-return">
    <div class="mains-section">
    <form id="returnForm">
    <div class="rertuns">
        <label for="return-reason">Reason for Return</label>
        <select name="return_reason" id="return-reason" required onchange="showImageInput()">
            <option value="">Select a reason</option>
            <option value="Damaged">Damaged Item</option>
            <option value="Wrong Size">Wrong Size</option>
            <option value="Defective">Defective Product</option>
            <option value="Other">Other</option>
        </select>

        <label for="comments">Comments <span>*</span> </label>
        <input type="text" name="comment" id="comments" placeholder="Enter your comment" required>

        <div id="image-container" style="display: none;">
            <label for="image-upload" class="upload-btn">
                <i class="fa fa-upload"></i> Upload Image
            </label>
            <input type="file" multiple name="returnimage[]" id="image-upload" accept="image/*" onchange="previewImage()">
        </div>

        <div id="preview-container" class="preview-container">
            <!-- Image previews will appear here -->
        </div>

        <button class="submit-btn" type="button" onclick="submitreturn()">Submit Return Request</button>
    </div>
</form>
    </div>
</section>

<script>
    function showImageInput() {
        var reason = document.getElementById('return-reason').value;
        var imageContainer = document.getElementById('image-container');
        var imageInput = document.getElementById('image-upload');

        if (reason === 'Damaged' || reason === 'Defective') {
            imageContainer.style.display = 'block';
            imageInput.required = true;
        } else {
            imageContainer.style.display = 'none';
            imageInput.required = false;
        }
    }

    function previewImage() {
        var previewContainer = document.getElementById('preview-container');
        previewContainer.innerHTML = ''; // Clear previous previews

        var files = document.getElementById('image-upload').files;
        for (var i = 0; i < files.length; i++) {
            var file = files[i];
            var reader = new FileReader();

            reader.onload = function (e) {
                var img = document.createElement('img');
                img.src = e.target.result;
                img.classList.add('preview-img');

                var removeBtn = document.createElement('span');
                removeBtn.innerHTML = '&times;';
                removeBtn.classList.add('remove-btn');
                removeBtn.onclick = function () {
                    img.remove();
                    removeBtn.remove();
                };

                var div = document.createElement('div');
                div.classList.add('preview-item');
                div.appendChild(img);
                div.appendChild(removeBtn);
                previewContainer.appendChild(div);
            };

            reader.readAsDataURL(file);
        }
    }

    function submitreturn() {
        var formData = new FormData(document.getElementById('returnForm'));

        fetch('submitreturn', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
            if (data.status === 'success') {
                document.getElementById('returnForm').reset();
                document.getElementById('preview-container').innerHTML = '';
            }
        })
        .catch(error => console.error('Error:', error));
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


</script>
