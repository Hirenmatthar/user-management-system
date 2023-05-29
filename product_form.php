<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="product_style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="container">
        <form id="productForm" method="post">
            <h4 class="display-4 text-center">Product Form</h4><hr><br>
            <div class="form-group">
                <label for="product_sku">Stock Keeping Unit</label>
                <input type="text" class="form-control" name="product_sku" id="product_sku" placeholder="Enter Product SKU">
                <div class="invalid-feedback"></div>
            </div>
            <div class="form-group">
                <label for="product_name">Name</label>
                <select class="form-control" name="product_name" id="product_name">
                    <option value="">Select Product</option>
                    <option value="Product 1">Product 1</option>
                    <option value="Product 2">Product 2</option>
                    <option value="Product 3">Product 3</option>
                </select>
                <div class="invalid-feedback"></div>
            </div>
            <div class="form-group">
                <label for="product_category">Category</label>
                <select class="form-control" name="product_category" id="product_category">
                    <option value="">Select Category</option>
                    <option value="Category 1">Category 1</option>
                    <option value="Category 2">Category 2</option>
                    <option value="Category 3">Category 3</option>
                </select>
                <div class="invalid-feedback"></div>
            </div>
            <div class="form-group">
                <label for="product_price">Price</label>
                <input type="number" class="form-control" step="0.01" min="0" name="product_price" id="product_price" placeholder="Enter the Product Price">
                <div class="invalid-feedback"></div>
            </div>
            <div class="form-group">
                <label for="product_img">Product Image</label>
                <input type="file" class="form-control" name="product_img" accept="image/*" id="product_img" placeholder="Enter Customer ID">
                <div class="invalid-feedback"></div>
            </div>
            <button type="submit" name="add" class="btn btn-primary">Submit</button>
            <button type="button" name="view" class="btn btn-primary" onclick="window.location.href='product_data.php'">View</button>
        </form>
    </div>

    <script>
        $(document).ready(function() {
            // Form submit event handler
            $("#productForm").on("submit", function(e) {
                e.preventDefault(); // Prevent the form from submitting

                // Validate form inputs
                var valid = true;

                // Validate SKU
                var sku = $("#product_sku").val().trim();
                if (sku === "") {
                    $("#product_sku").addClass("is-invalid");
                    $("#product_sku").siblings(".invalid-feedback").text("SKU is required.");
                    valid = false;
                } else {
                    $("#product_sku").removeClass("is-invalid");
                    $("#product_sku").siblings(".invalid-feedback").text("");
                }

                // Validate Name
                var name = $("#product_name").val();
                if (name === "") {
                    $("#product_name").addClass("is-invalid");
                    $("#product_name").siblings(".invalid-feedback").text("Name is required.");
                    valid = false;
                } else {
                    $("#product_name").removeClass("is-invalid");
                    $("#product_name").siblings(".invalid-feedback").text("");
                }

                // Validate Category
                var category = $("#product_category").val();
                if (category === "") {
                    $("#product_category").addClass("is-invalid");
                    $("#product_category").siblings(".invalid-feedback").text("Category is required.");
                    valid = false;
                } else {
                    $("#product_category").removeClass("is-invalid");
                    $("#product_category").siblings(".invalid-feedback").text("");
                }

                // Validate Price
                var price = $("#product_price").val().trim();
                if (price === "") {
                    $("#product_price").addClass("is-invalid");
                    $("#product_price").siblings(".invalid-feedback").text("Price is required.");
                    valid = false;
                } else if (isNaN(price) || parseFloat(price) <= 0) {
                    $("#product_price").addClass("is-invalid");
                    $("#product_price").siblings(".invalid-feedback").text("Price must be a positive number.");
                    valid = false;
                } else {
                    $("#product_price").removeClass("is-invalid");
                    $("#product_price").siblings(".invalid-feedback").text("");
                }

                // Validate Image
                var image = $("#product_img").val();
                if (image === "") {
                    $("#product_img").addClass("is-invalid");
                    $("#product_img").siblings(".invalid-feedback").text("Image is required.");
                    valid = false;
                } else {
                    $("#product_img").removeClass("is-invalid");
                    $("#product_img").siblings(".invalid-feedback").text("");
                }

                if (valid) {
                    // If all inputs are valid, send the form data via AJAX
                    var formData = new FormData(this); // Create FormData object to hold the form data
                    $.ajax({
                        url: "submit_product.php", // PHP script to handle the form submission
                        type: "POST",
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            // Handle the response from the PHP script
                            console.log(response);
                            // You can update the page content or show a success message here
                        },
                        error: function(xhr, status, error) {
                            // Handle errors, if any
                            console.error(error);
                            // You can show an error message or handle the error as needed
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>
