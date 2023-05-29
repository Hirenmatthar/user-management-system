<?php
// Assuming you have already established a database connection
require_once 'dbconfig.php';
try {
    // Create a new PDO instance using the provided database credentials
    // Set PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Fetch roles from the role table
    $query = "SELECT * FROM role";
    $stmt = $pdo->query($query);
    // Check if the query was successful
    if ($stmt) {
        $roles = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // Process the roles data
        foreach ($roles as $role) {
            // Access role data using $role['column_name']
            $roleName = $role['name'];
            // Use the role data as needed
        }
    } else {
        echo "Failed to fetch roles.";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
// Close the database connection (not necessary with PDO)
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="product_style.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.2.0/fonts/remixicon.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Registration Form</title>
    <script src="Reg_Form_Ajax.js"></script>
</head>
<body>
    <div class="container">
        <form id="regForm" method="post">
            <h4 class="display-4 text-center">Registration Form</h4>
            <hr>
            <br>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control <?php echo isset($errors['name']) ? 'is-invalid' : ''; ?>"
                    name="name" id="name" placeholder="Enter Your Name"
                    value="<?php echo isset($_POST['name']) ? $_POST['name'] : ''; ?>">
                <?php if (isset($errors['name'])) : ?>
                <div class="invalid-feedback">
                    <?php echo $errors['name']; ?>
                </div>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="role">Role</label>
                <select class="form-control <?php echo isset($errors['role']) ? 'is-invalid' : ''; ?>" name="role"
                    id="role">
                    <option value="">Select Role</option>
                    <?php foreach ($roles as $role) : ?>
                    <option value="<?php echo $role['name']; ?>">
                        <?php echo $role['name']; ?>
                    </option>
                    <?php endforeach; ?>
                </select>
                <?php if (isset($errors['role'])) : ?>
                <div class="invalid-feedback">
                    <?php echo $errors['role']; ?>
                </div>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control <?php echo isset($errors['email']) ? 'is-invalid' : ''; ?>"
                    name="email" id="email" placeholder="Enter Your Email"
                    value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>">
                <?php if (isset($errors['email'])) : ?>
                <div class="invalid-feedback">
                    <?php echo $errors['email']; ?>
                </div>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" class="form-control <?php echo isset($errors['address']) ? 'is-invalid' : ''; ?>"
                    name="address" id="address" placeholder="Enter Your Address"
                    value="<?php echo isset($_POST['address']) ? $_POST['address'] : ''; ?>">
                <?php if (isset($errors['address'])) : ?>
                <div class="invalid-feedback">
                    <?php echo $errors['address']; ?>
                </div>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="tel" class="form-control <?php echo isset($errors['phone']) ? 'is-invalid' : ''; ?>"
                    name="phone" id="phone" placeholder="Enter the Phone No."
                    value="<?php echo isset($_POST['phone']) ? $_POST['phone'] : ''; ?>">
                <?php if (isset($errors['phone'])) : ?>
                <div class="invalid-feedback">
                    <?php echo $errors['phone']; ?>
                </div>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password"
                    class="form-control <?php echo isset($errors['password']) ? 'is-invalid' : ''; ?>" name="password"
                    id="password" placeholder="Enter Password">
                <?php if (isset($errors['password'])) : ?>
                <div class="invalid-feedback">
                    <?php echo $errors['password']; ?>
                </div>
                <?php endif; ?>
                <div class="password-indicator">
                    <span>Password Strength: <span id="passwordStrength"></span>8</span>
                    <span>Characters: <span id="passwordCharacters"></span>4</span>
                </div>
            </div>
            <br>
            <button type="submit" id="submitBtn" name="add" class="btn btn-primary">Submit</button>
            <div class="card-footer">
                <div class="d-flex justify-content-center links">
                    Already have an account?<a href="login.php">Login</a>
                </div>
            </div>
        </form>
    </div>
    <script>
        $(document).ready(function () {
            // Form submit event handler
            $("#regForm").on("add", function (e) {
                e.preventDefault(); // Prevent the form from submitting
                // Validate form inputs
                var valid = true;
                // Validate Name
                var name = $("#name").val().trim();
                if (name === "") {
                    $("#name").addClass("is-invalid")
                    valid = false;
                } else {
                    $("#name").removeClass("is-invalid");
                }
                // Validate Email
                var email = $("#email").val().trim();
                var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (email === "" || !emailRegex.test(email)) {
                    $("#email").addClass("is-invalid");
                    valid = false;
                } else {
                    $("#email").removeClass("is-invalid");
                }

                // Validate Address
                var address = $("#address").val().trim();
                if (address === "") {
                    $("#address").addClass("is-invalid");
                    valid = false;
                } else {
                    $("#address").removeClass("is-invalid");
                }

                // Validate Phone
                var phone = $("#phone").val().trim();
                var phoneRegex = /^\d{10}$/; // Assumes a 10-digit phone number format
                if (phone === "" || !phoneRegex.test(phone)) {
                    $("#phone").addClass("is-invalid");
                    valid = false;
                } else {
                    $("#phone").removeClass("is-invalid");
                }

                // Validate Password
                var password = $("#password").val().trim();
                if (password === "") {
                    $("#password").addClass("is-invalid");
                    valid = false;
                } else {
                    $("#password").removeClass("is-invalid");
                }
                if (valid) {
                    this.submit();
                }

                // Validate Role
                var role = $("#role").val();
                if (role === "") {
                    $("#role").addClass("is-invalid");
                    valid = false;
                } else {
                    $("#role").removeClass("is-invalid");
                }
            });
        });
    </script>
</body>
</html>