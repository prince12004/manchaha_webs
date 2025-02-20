
$(document).ready(function() {
$('#sidebar').hover(
function() {
    // Mouse enter sidebar
    $(this).addClass('expanded');
    $('#main-content').addClass('collapsed');
},
function() {
    // Mouse leave sidebar
    $(this).removeClass('expanded');
    $('#main-content').removeClass('collapsed');
}
);

// Close sidebar on close button click
$('#sidebar .close-btn').click(function() {
$('#sidebar').removeClass('expanded');
$('#main-content').removeClass('collapsed');
});
});

// ======================Notification===============



$(document).ready(function() {
$('.notification-icon').on('click', function() {
$('.notify-dropdown').toggle();
});

const cartItems = [
{ sender: 'Deepak Gaur', role: 'Distributor', message: 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', date: 'Jul 23, 2024 2:40am' },
{ sender: 'Brand', role: '', message: 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', date: 'Jul 23, 2024 2:40am' },
{ sender: 'Brand', role: '', message: 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', date: 'Jul 23, 2024 2:40am' },
];

const cartDropdown = $('.notify-dropdown');

cartItems.forEach(item => {
const initials = getInitials(item.sender);
const cartItem = `
<div class="cart-item">
<div class=" d-flex align-items-center gap-1">
   <div class="initials-logo">${initials}</div>
   <strong>${item.sender} ${item.role ? `(${item.role})` : ''}</strong>
</div>
<div>
    <p>${item.message}</p>
    <small>${item.date}</small>
</div>
</div>
`;
cartDropdown.append(cartItem);
});

function getInitials(name) {
    const initials = name.split(' ').map(word => word[0]).join('').toUpperCase();
    return initials;
}
});



$(document).ready(function () {
    var maxImages = 4; // Maximum number of images
    var imageCountMap = {}; // Track the number of images uploaded per section
    var imageUrlsMap = {}; // Store image URLs per section

    // Function to collect all the form data and log it as an array
    function logFormData(sectionId, $section) {
        // Collect data from all input fields in the section as an array
        var formDataArray = [
            $section.find('input[placeholder="23 x 3 x 2 Centimeters"]').val(), // Item Dimensions
            $section.find('input[placeholder="Rose Gold"]').val(), // Color
            $section.find('input[placeholder="20 g"]').val(), // Weight
            $section.find('input[placeholder="256"]').val(), // Stock
            $section.find('input[placeholder="Type Base price"]').val(), // Product Base Price
            $section.find('input[placeholder="Type sale price"]').val(), // Sale Price
            $section.find('select').val(), // Product Status
            ...(imageUrlsMap[sectionId] || []) // Append image URLs
        ];

        // Log the form data array for this section
        console.log('Form data for section ' + sectionId + ':', formDataArray);
    }

    // Open file dialog when add image button is clicked
    $(document).on('click', '.add-image-btn', function () {
        var $section = $(this).closest('.section-cloned-3');
        var sectionId = $section.attr('id');

        if (!imageCountMap[sectionId]) {
            imageCountMap[sectionId] = 0;
        }

        if (imageCountMap[sectionId] < maxImages) {
            $section.find('.image-upload').click();
        }
    });

    // Handle image upload
    $(document).on('change', '.image-upload', function (e) {
        var $section = $(this).closest('.section-cloned-3');
        var sectionId = $section.attr('id');
        var files = e.target.files;
        var numberOfFiles = files.length;

        if (!imageCountMap[sectionId]) {
            imageCountMap[sectionId] = 0;
        }

        if (imageCountMap[sectionId] + numberOfFiles > maxImages) {
            alert('You cannot upload more than ' + maxImages + ' images in this section.');
            return;
        }

        if (!imageUrlsMap[sectionId]) {
            imageUrlsMap[sectionId] = [];
        }

        for (var i = 0; i < numberOfFiles; i++) {
            var file = files[i];
            var reader = new FileReader();

            reader.onload = function (e) {
                var imageUrl = e.target.result;

                // Add the image to the container
                $section.find('.image-preview-container').append(`
                    <div class="image-box">
                        <img src="${imageUrl}" alt="Uploaded Image">
                        <span class="material-symbols-outlined delete-icon">&times;</span>
                    </div>
                `);

                imageUrlsMap[sectionId].push(imageUrl); // Store the image URL
                imageCountMap[sectionId]++;

                // Log the form data as an array, including the image URLs and inputs
                logFormData(sectionId, $section);

                // Hide the add button if maximum images are uploaded
                if (imageCountMap[sectionId] >= maxImages) {
                    $section.find('.add-image-btn').hide();
                }
            };

            reader.readAsDataURL(file);
        }

        // Reset file input
        $(this).val('');
    });

    // Handle image deletion
    $(document).on('click', '.delete-icon', function () {
        var $section = $(this).closest('.section-cloned-3');
        var sectionId = $section.attr('id');
        var imageUrl = $(this).siblings('img').attr('src');
        $(this).closest('.image-box').remove();
        imageCountMap[sectionId]--;

        // Remove the URL from the array
        if (imageUrlsMap[sectionId]) {
            imageUrlsMap[sectionId] = imageUrlsMap[sectionId].filter(url => url !== imageUrl);
        }

        // Log the updated form data after image deletion
        logFormData(sectionId, $section);

        // Show the add button if the image count is less than maxImages
        if (imageCountMap[sectionId] < maxImages) {
            $section.find('.add-image-btn').show();
        }
    });

    // Cloning a new section when the "Product Details" button is clicked
    $('.product-info-btn').on('click', function () {
        var $originalSection = $('#product-sections-3 .section-cloned-3').first();
        var $newSection = $originalSection.clone(true);

        // Assign a new ID to the cloned section
        var newId = 'section-' + Date.now();
        $newSection.attr('id', newId);

        $newSection.find('input[type="text"], textarea').val(''); // Clear inputs in the cloned section
        $newSection.find('.image-preview-container').empty(); // Clear image previews in the cloned section
        $newSection.find('.add-image-btn').show(); // Reset add button visibility in the cloned section
        
        // Initialize image count and URLs for the new section
        imageCountMap[newId] = 0;
        imageUrlsMap[newId] = [];

        $('#product-sections-3').append($newSection); // Append the cloned section
    });

    // Delete section functionality with alert confirmation
    $('#product-sections-3').on('click', '.delete-btn', function () {
        if (confirm("Are you sure you want to delete this section?")) {
            var $section = $(this).closest('.section-cloned-3');
            var sectionId = $section.attr('id');
            delete imageCountMap[sectionId]; // Remove section data from maps
            delete imageUrlsMap[sectionId];
            $section.remove();
        }
    });
});


    
    





$(document).ready(function() {

// Trigger file input when clicking on image upload section
$('#product-sections').on('click', '.image-upload', function(event) {
// Prevent recursion by stopping click event from re-triggering the parent
if (!$(event.target).is('input[type="file"]')) {
$(this).find('input[type="file"]').click();
}
});

// Image upload functionality
$('#product-sections').on('change', '.image-upload input[type="file"]', function() {
const $imageUpload = $(this).closest('.image-upload');
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
});



$(document).ready(function() {


    // Trigger file input when clicking on image upload section
    $('#product-sections-2').on('click', '.image-upload-2', function(event) {
        // Prevent recursion by stopping click event from re-triggering the parent
        if (!$(event.target).is('input[type="file"]')) {
        $(this).find('input[type="file"]').click();
        }
    });

// Image upload functionality
$('#product-sections-2').on('change', '.image-upload-2 input[type="file"]', function() {
    const $imageUpload = $(this).closest('.image-upload-2');
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
});









$(document).ready(function() {
    // Store the original section as a clean copy for cloning
    const $originalSection = $('#product-sections-4 .product-container-4').first().clone(true);

    // Cloning new section when clicking "Product Size"
    $('.product-size-btn').on('click', function() {
        // Create a fresh clone of the original section
        const $clonedSection = $originalSection.clone(true);

        // Clear input fields and reset select dropdowns in the cloned section
        $clonedSection.find('input[type="text"], select').val('');

        // Append the cloned section
        $('#product-sections-4').append($clonedSection);
    });

    // Delete section functionality with alert confirmation
    $('#product-sections-4').on('click', '.delete-btn', function() {
        if (confirm("Are you sure you want to delete this section?")) {
            $(this).closest('.product-container-4').remove();
        }
    });
});







document.getElementById('upload-button').addEventListener('click', function () {
    document.getElementById('file-input').click();
});

document.getElementById('file-input').addEventListener('change', function (event) {
    const files = event.target.files;
    const imageGallery = document.getElementById('image-gallery');
    const uploadButton = document.getElementById('upload-button');

    for (const file of files) {
        if (file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function (e) {
                const imgElement = document.createElement('div');
                imgElement.classList.add('image-wrapper');
                imgElement.innerHTML = `
                    <img src="${e.target.result}" alt="${file.name}">
                    <button class="delete-button">&times;</button>
                `;
                imgElement.querySelector('.delete-button').addEventListener('click', function () {
                    imgElement.remove();
                    if (imageGallery.children.length === 0) {
                        uploadButton.textContent = 'Upload Images';
                        uploadButton.classList.remove('uploaded');
                    }
                });
                imgElement.querySelector('img').addEventListener('click', function () {
                    document.getElementById('modal-image').src = e.target.result;
                    document.getElementById('image-modal').style.display = 'flex';
                });
                imageGallery.appendChild(imgElement);
            };
            reader.readAsDataURL(file);
        } else {
            alert('Please select a valid image file.');
        }
    }

    uploadButton.textContent = 'Upload More Images';
    uploadButton.classList.add('uploaded');
});












