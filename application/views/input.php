<form id="product_form" action="addProduct" method="post" enctype="multipart/form-data">
    <div id="variants-container">
        <!-- First Variant -->
        <div class="variant-section">
            <div class="row">
                <div class="col-md-3">
                    <label for="dimensions">Item Dimensions:</label>
                    <input type="text" name="dimension[]" class="form-control" placeholder="Dimensions">
                </div>
                <div class="col-md-2">
                    <label for="color">Color:</label>
                    <input type="text" name="color[]" class="form-control" placeholder="Color">
                </div>
                <div class="col-md-2">
                    <label for="weight">Weight:</label>
                    <input type="text" name="weight[]" class="form-control" placeholder="Weight">
                </div>
                <div class="col-md-2">
                    <label for="stock">Stock:</label>
                    <input type="number" name="stock[]" class="form-control" placeholder="Stock">
                </div>
                <div class="col-md-3">
                    <label for="images">Upload Images:</label>
                    <input type="file" name="images[0][]" class="form-control" accept="image/*" multiple>
                </div>
            </div>
            <!-- Add more fields like Base Price, Sale Price, Status here -->
            <button type="button" class="btn btn-danger remove-variant">Remove Variant</button>
        </div>
    </div>

    <!-- Button to add more variants -->
    <button type="button" id="add-variant-btn" class="btn btn-primary">Add Variant</button>

    <button type="submit" class="btn btn-success">Submit</button>
</form>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
var variantCount = 1;

// Add new variant section
$('#add-variant-btn').on('click', function() {
    var newVariant = `
        <div class="variant-section">
            <div class="row">
                <div class="col-md-3">
                    <label for="dimensions">Item Dimensions:</label>
                    <input type="text" name="dimension[]" class="form-control" placeholder="Dimensions">
                </div>
                <div class="col-md-2">
                    <label for="color">Color:</label>
                    <input type="text" name="color[]" class="form-control" placeholder="Color">
                </div>
                <div class="col-md-2">
                    <label for="weight">Weight:</label>
                    <input type="text" name="weight[]" class="form-control" placeholder="Weight">
                </div>
                <div class="col-md-2">
                    <label for="stock">Stock:</label>
                    <input type="number" name="stock[]" class="form-control" placeholder="Stock">
                </div>
                <div class="col-md-3">
                    <label for="images">Upload Images:</label>
                    <input type="file" name="images[` + variantCount + `][0]" class="form-control" accept="image/*" multiple>
                </div>
            </div>
            <button type="button" class="btn btn-danger remove-variant">Remove Variant</button>
        </div>`;

    $('#variants-container').append(newVariant);
    variantCount++;
});

// Remove variant section
$(document).on('click', '.remove-variant', function() {
    $(this).closest('.variant-section').remove();
});
</script>