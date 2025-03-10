<!DOCTYPE html>
<html>
<head>
    <title>Bulk Order Form</title>
</head>
<body>
    <h2>Bulk Order Form</h2>
    <form id="bulForm" method="post">
        <label for="name">Name:</label>
        <input class="form-control" type="text" name="name" id="name" required>
        <br><br>

        <label for="contact">Contact:</label>
        <input class="form-control" type="text" name="contact" id="contact" required>
        <br><br>

        <label for="email">Email:</label>
        <input class="form-control" type="email" name="email" id="email" required>
        <br><br>

        <label for="business_name">Business Name:</label>
        <input class="form-control" type="text" name="business_name" id="business_name" required>
        <br><br>

        <label for="category">Category:</label>
        <select class="form-control" name="category" id="category" required>
            <option value="">Select Category</option>
            
            <?php foreach ($categories as $category): ?>
                <option value="<?php echo $category->CategoryName; ?>"><?php echo $category->CategoryName; ?></option>
            <?php endforeach; ?>
        </select>
        <br><br>

        <label for="quantity">Quantity:</label>
        <input class="form-control" type="number" name="quantity" id="quantity" required>
        <br><br>



        <label for="address">Address:</label>
        <textarea class="form-control" name="address" id="address" required></textarea>
        <br><br>

        <button type="button" class="btn btn-primary" onclick="submitBulk()">Submit</button>
    </form>
</body>
</html>

<script>

function submitBulk()
{   formData = new FormData();
    var formElement = document.getElementById('bulForm');
    var formData = new FormData(formElement);

    fetch('<?= base_url('Welcome/bulk_query')?>', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        console.log('Success:', data);
        alert('Details saved successfully!');
        formElement.reset();

    })
    .catch((error) => {
        console.error('Error:', error);
        alert('Form submission failed!');
        
    });
    console.log(FormData);

}



</script>
