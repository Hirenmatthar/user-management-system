<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Role</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="product_style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="container">
        <form id="roleForm" method="post">
            <h4 class="display-4 text-center">Add Role</h4><hr><br>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Enter Role">
                <div class="invalid-feedback"></div>
            </div>
            <div class="form-group">
                <label for="permissions">Permissions</label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" value="Home" name="permissions[]">
                    <label class="form-check-label">Home</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" value="Products" name="permissions[]">
                    <label class="form-check-label">Products</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" value="Contact Us" name="permissions[]">
                    <label class="form-check-label">Contact Us</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" value="List Users" name="permissions[]">
                    <label class="form-check-label">List Users</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" value="Add Role" name="permissions[]">
                    <label class="form-check-label">Add Role</label>
                </div>
                <!-- Add more checkboxes for permissions as needed -->
            </div>
            <button type="submit" name="add" class="btn btn-primary">Add</button>
        </form>
    </div>

    <script>
        $(document).ready(function() {
            // Form submit event handler
            $("#roleForm").on("add", function(e) {
                e.preventDefault(); // Prevent the form from submitting

                // Validate form inputs
                var valid = true;

                // Perform your validation logic here
                // ...

                if (valid) {
                    // If all inputs are valid, send the form data via AJAX
                    var formData = new FormData(this); // Create FormData object to hold the form data
                    $.ajax({
                        url: "add_role_submit.php", // PHP script to handle the form submission
                        type: "POST",
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            // Handle the success response here
                            console.log(response);
                            // Update the page content or show a success message here
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
