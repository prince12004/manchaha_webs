<?php $this->load->view('Admin/header') ?>
<style>
 .dash-head1 {
    font-family: 'Poppins';
    font-size: 24px;
    font-weight: 500;
    line-height: 36px;
    text-align: left;
}
    .modal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5); /* Semi-transparent background */
    display: none;
    justify-content: center;
    align-items: center;
    z-index: 9999; /* Ensure the modal is on top of all other content */
}

.modal-content {
    background-color: white;
    padding: 30px;
    border-radius: 10px;
    text-align: center;
    max-width: 400px;
    width: 100%;
    margin:20vh auto
}
.modal-content h2{
    font-size:20px;
}

.modal-logo {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-bottom: 20px; /* Space between logo and the rest of the modal content */
}

.modal-logo img {
    max-width: 100%; /* Ensure the logo doesn't overflow */
    height: auto;
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


.content {
    margin: 20px auto;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    background: #f9f9f9;
    max-width: 80%;
}

form {
    flex-direction: column;
    gap: 15px;
    display: flex;
}




form  input[type="text"],
form  input[type="file"],
form  button {
    padding: 10px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 5px;
    width: 100%;
}

form  input[type="text"]:focus,
form  button:focus {
    outline: none;
    border-color: #007bff;
 }

form button {
    color: #fff;
    cursor: pointer;
    transition: background-color 0.3s;
    background: #007bff;
}

form  button:hover {
    background: #0056b3;
}

 .image-preview {
     display: none;
     margin-top: 20px;
     width:90%;
     margin:auto;
    }

 .image-preview img {
     height: auto;
     border: 1px solid #ccc;
     border-radius: 5px;
     width: 80%;
     margin:auto;
     display:flex;
     justify-content:center;
     }

</style>

        <div class="add-Banner-page">
        <div class="d-flex  justify-content-between align-items-center my-3">
                <h1 class="dash-head1">Update Banner(HeroSection)</h1>
            </div>
            <div class="content">
                <form class="w-80" id="bannerForm" enctype="multipart/form-data">
                    <div>
                        <label for="description">Banner Description</label>
                        <input type="text" id="description" name="description" value="" placeholder="Banner Description">
                    </div>
                    <div>
                        <label for="BannerTitle">Banner Title</label>
                        <input type="text" id="BannerTitle" name="tittle" value="" placeholder="Banner Tittle">
                    </div>
                    <div>
                        <label for="BannerInput">Insert Banner</label>
                        <input type="file" id="BannerInput" name="image" id="imageInput">
                    </div>
                    <button type="button" id="submitBanner" onclick="submitBannerde()">Submit</button>
                </form>
            </div>
            <div class="image-preview" id="imagePreview">
                <img src="" alt="Image Preview">
            </div>
        
         
        <div id="alertModal" class="modal" style="display: none;">
                <div class="modal-content">
                    <!-- Logo in the center -->
                    <div class="modal-logo">
                      <img src="<?= base_url('/assets/images/images/logo.png') ?>" alt="Logo" >
                    </div>
                    <h2 id="alertResponse"></h2>
                    <button class="close-btn" onclick="closeAlertModal()">Close</button>
                </div>
            </div>      
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/js/all.min.js"></script>
    <script src="<?= base_url('/assets/javascript/common.js') ?>"></script>
    <script>
         
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

        const imageInput = document.getElementById('BannerInput');
    const imagePreview = document.getElementById('imagePreview');
    const previewImg = imagePreview.querySelector('img');

    imageInput.addEventListener('change', function () {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                previewImg.src = e.target.result;
                imagePreview.style.display = 'block';
            }
            reader.readAsDataURL(file);
        } else {
            imagePreview.style.display = 'none';
        }
    });


        function submitBannerde()
    {
        const formElement = document.getElementById('bannerForm');
        const formData = new FormData(formElement);
        $.ajax({
        url: '<?= base_url('saveBanner') ?>',  // Your endpoint
        type: 'POST',
        data: formData, // Send the FormData object
        contentType: false,  // Let jQuery handle the content type
        processData: false,  // Let jQuery handle the process data
        success: function(response) {
            // response = JSON.parse(response);
            if(response.status === 'success'){
            // alert('Details Updated Successfully');
            document.getElementById('alertResponse').innerHTML="Details Updated Successfully";
            alertModal()
            //window.location.reload(); // Assuming you have a function to close the modal
            }else{
                // alert('something went wrong');
                document.getElementById('alertResponse').innerHTML="something went wrong";
            alertModal()
                
            }
        },
        error: function(xhr, status, error) {
            console.error('Error Updating Details:', error);
            // alert('An error occurred while saving the details.');
            document.getElementById('alertResponse').innerHTML="An error occurred while saving the details.";
            alertModal()
        }
    });        
    

    }
    </script>
   

   

    

</body>
</html>

