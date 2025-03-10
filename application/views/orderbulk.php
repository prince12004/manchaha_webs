<!DOCTYPE html>
<html>
<head>
    <title>Bulk Order Form</title>
    <style>
        .main-bluks{
            display: flex;
            gap: 10px;
            width: 100%;
            margin: 10px 0px;
        }
        .bluk{
            display: flex;
            flex-direction: column;
            gap: 10px;
            width: 48%
        }
        .form-controls{
            border: 1px solid #ccc;
            padding: 8px 20px 8px 10px;
            border-radius: 5px;
            outline: none;
        }
        .mains-new-bulk{
            width: 90%;
            margin: 20px auto;

        }
        .bluk-headings{
            font-size: 25px;
            font-weight: 600;
            width: 90%;
            margin-left: 60px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h2 class="bluk-headings">Bulk Order Form</h2>
    <form id="bulForm" class="mains-new-bulk" method="post">
        <div class="main-bluks">
             <div class="bluk">
             <label for="name">Name:</label>
             <input class="form-control" type="text" name="name" id="name" required>
             </div>

      <div class="bluk">
      <label for="contact">Contact:</label>
      <input class="form-control" type="text" name="contact" id="contact" required>
      </div>
    </div>

    <div class="main-bluks">
             <div class="bluk">
             <label for="email">Email:</label>
             <input class="form-control" type="email" name="email" id="email" required>
             </div>

      <div class="bluk">
      <label for="business_name">Business Name:</label>
      <input class="form-control" type="text" name="business_name" id="business_name" required>
      </div>
    </div>

    <div class="main-bluks">
             <div class="bluk">
             <label for="category">Category:</label>
        <select class="form-controls" name="category" id="category" required>
            <option value="">Select Category</option>
            
            <?php foreach ($categories as $category): ?>
                <option value="<?php echo $category->CategoryName; ?>"><?php echo $category->CategoryName; ?></option>
            <?php endforeach; ?>
        </select>
             </div>

      <div class="bluk">
      <label for="quantity">Quantity:</label>
      <input class="form-control" type="number" name="quantity" id="quantity" required>
      </div>
    </div>
    <div class="main-bluks">
             <div class="bluk">
             <label for="address">Address:</label>
             <textarea class="form-control" name="address" id="address" required></textarea>
             </div>
    </div>



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
        alert('Form submitted successfully!');
    })
    .catch((error) => {
        console.error('Error:', error);
        alert('Form submission failed!');
    });
    console.log(FormData);

}



</script>
