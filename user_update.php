<?php
require_once "dbconfig.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle form submission and update the user details in the database

    // Retrieve the submitted form data
    $id = $_POST['id'];
    $name = $_POST['name'];
    $role = $_POST['role'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];

    // Update the user details in the database
    $sql = "UPDATE registered SET name = ?, role = ?, email = ?, password = ?, address = ?, phone = ? WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$name, $role, $email, $password, $address, $phone, $id]);

    // Prepare the response data
    $response = array(
        'status' => 'success',
        'message' => 'User Updated Successfully!'
    );

    // Send the JSON response
    echo json_encode($response);
    exit();
} else {
    // Display the form for editing the user details

    // Check if the id parameter is provided
    if (!isset($_GET['id'])) {
        header("Location: list_users.php?msg=User ID is missing");
        exit();
    }

    // Retrieve the user details from the database based on the id
    $id = $_GET['id'];
    $sql = "SELECT * FROM registered WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    $user = $stmt->fetch();

    // Check if the user exists
    if (!$user) {
        header("Location: list_users.php?msg=User not found");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="product_style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="container">
        <form id="updateUserForm" method="post">
            <h4 class="display-4 text-center">Edit Record</h4><hr><br>
            <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" value="<?php echo $user['name']; ?>" name="name" required>
            </div>
            <div class="form-group">
                <label for="role">Role</label>
                <input type="text" class="form-control" value="<?php echo $user['role']; ?>" name="role" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" value="<?php echo $user['email']; ?>" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" value="<?php echo $user['password']; ?>" name="password" required>
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" class="form-control" value="<?php echo $user['address']; ?>" name="address" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="tel" class="form-control" value="<?php echo $user['phone']; ?>" name="phone" required>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Update</button>
        </form>
    </div>

    <script>
    $(document).ready(function() {
        // Form submit event handler
        $("#updateUserForm").on("submit", function(e) {
            e.preventDefault(); // Prevent the form from submitting

            // Validate form inputs
            var valid = true;

            // Validate name field
            var nameInput = $("input[name='name']");
            if (nameInput.val().trim() === "") {
                nameInput.addClass("is-invalid");
                valid = false;
            } else {
                nameInput.removeClass("is-invalid");
            }

            // Validate role field
            var roleInput = $("input[name='role']");
            if (roleInput.val().trim() === "") {
                roleInput.addClass("is-invalid");
                valid = false;
            } else {
                roleInput.removeClass("is-invalid");
            }

            // Validate email field
            var emailInput = $("input[name='email']");
            var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(emailInput.val())) {
                emailInput.addClass("is-invalid");
                valid = false;
            } else {
                emailInput.removeClass("is-invalid");
            }

            // Validate password field
            var passwordInput = $("input[name='password']");
            if (passwordInput.val().trim() === "") {
                passwordInput.addClass("is-invalid");
                valid = false;
            } else {
                passwordInput.removeClass("is-invalid");
            }

            // Validate address field
            var addressInput = $("input[name='address']");
            if (addressInput.val().trim() === "") {
                addressInput.addClass("is-invalid");
                valid = false;
            } else {
                addressInput.removeClass("is-invalid");
            }

            // Validate phone field
            var phoneInput = $("input[name='phone']");
            var phonePattern = /^\d{10}$/;
            if (!phonePattern.test(phoneInput.val())) {
                phoneInput.addClass("is-invalid");
                valid = false;
            } else {
                phoneInput.removeClass("is-invalid");
            }

            if (valid) {
                // If all inputs are valid, send the form data via AJAX
                var formData = new FormData(this); // Create FormData object to hold the form data
                $.ajax({
                    url: "user_update.php", // PHP script to handle the form submission
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
