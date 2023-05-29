<?php
session_start();
$email = $_SESSION['email'];

if ($email == true) {
    // Assuming you have a PDO database connection established
    require_once 'dbconfig.php';

    $homeButtonVisible = false;
    $productButtonVisible = false;
    $contactButtonVisible = false;
    $roleButtonVisible = false;
    $userButtonVisible = false;
    // Fetch the user's role from the registered table
    $roleSql = "SELECT role FROM registered WHERE email = :email";
    $roleStmt = $pdo->prepare($roleSql);
    $roleStmt->bindParam(':email', $email);
    $roleStmt->execute();

    if ($roleStmt->rowCount() == 1) {
        $roleRow = $roleStmt->fetch(PDO::FETCH_ASSOC);
        $role = $roleRow['role'];

        // Retrieve the permissions associated with the role from the role table
        $permissionSql = "SELECT permission FROM role WHERE name = :role";
        $permissionStmt = $pdo->prepare($permissionSql);
        $permissionStmt->bindParam(':role', $role);
        $permissionStmt->execute();

        if ($permissionStmt->rowCount() == 1) {
            $permissionRow = $permissionStmt->fetch(PDO::FETCH_ASSOC);
            $permissions = explode(", ", $permissionRow['permission']);
            // Check the user's permissions and modify the visibility variables accordingly
            $homeButtonVisible = in_array('Home', $permissions);
            $productButtonVisible = in_array('Products', $permissions);
            $contactButtonVisible = in_array('Contact Us', $permissions);
            $roleButtonVisible = in_array('Add Role', $permissions);
            $userButtonVisible = in_array('List Users', $permissions);
        }
    }
} else {
    echo "<script>alert('Please Login First!!!');</script>";
    echo "<script>location.href = 'login.php'</script>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HomePage</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.2.0/fonts/remixicon.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/d98a6653af.js" crossorigin="anonymous"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <?php if ($homeButtonVisible): ?>
                    <a class="nav-link" href="HomePage.php"><i class="ri-home-4-fill"></i> Home<span
                            class="sr-only">(current)</span></a>
                    <?php else: ?>
                    <span class="nav-link disabled"><i class="ri-home-4-fill"></i> Home</span>
                    <?php endif; ?>
                </li>
                <li class="nav-item">
                    <?php if ($productButtonVisible): ?>
                    <a class="nav-link" href="product_data.php"><i class="ri-product-hunt-line"></i> Products</a>
                    <?php else: ?>
                    <span class="nav-link disabled"><i class="ri-product-hunt-line"></i> Products</span>
                    <?php endif; ?>
                </li>
                <li class="nav-item">
                    <?php if ($contactButtonVisible): ?>
                    <a class="nav-link" href="contact_us.php"><i class="ri-contacts-fill"></i> Contact us</a>
                    <?php else: ?>
                    <span class="nav-link disabled"><i class="ri-contacts-fill"></i> Contact us</span>
                    <?php endif; ?>
                </li>
                <li class="nav-item">
                    
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Reg_Form.php"><i class="ri-login-box-fill"></i> Register</a>
                </li>
                <li class="nav-item">
                    <?php if ($userButtonVisible): ?>
                    <a class="nav-link" href="list_users.php">List Users</a>
                    <?php else: ?>
                    <span class="nav-link disabled">List Users</span>
                    <?php endif; ?>
                </li>
                <li class="nav-item">
                    <?php if ($roleButtonVisible): ?>
                    <a class="nav-link" href="add_role.php">Add Role</a>
                    <?php else: ?>
                    <span class="nav-link disabled">Add Role</span>
                    <?php endif; ?>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                    <div class="btn-group">
                        <button type="button" class="btn btn-outline-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-user"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#"><b>Email: </b><?php echo $email; ?></a>
                            <a class="dropdown-item" href="#"><b>Role: </b><?php echo $role; ?></a>
                            <a class="nav-link" href="logout.php"><i class="ri-login-box-fill"></i> Log Out</a>
                        </div>
                    </div>
                </li>
            </ul>         
</body>
</html>
