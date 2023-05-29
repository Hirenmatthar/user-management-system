<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once "dbconfig.php";

    $name = $_POST['name'];
    $permissions = $_POST['permissions'];
    $errors = [];
    $per = implode(", ", $permissions);

    if (empty($errors)) {
        try {
            // Check if the role already exists
            $checkStmt = $pdo->prepare("SELECT COUNT(*) FROM role WHERE name = ?");
            $checkStmt->execute([$name]);
            $roleExists = ($checkStmt->fetchColumn() > 0);

            if ($roleExists) {
                echo "<script>alert('Role already exists in the database.');</script>";
                echo "<script>window.location.href = 'add_role.php';</script>";
                exit();
            }

            // Role does not exist, proceed with insertion
            $stmt = $pdo->prepare("INSERT INTO role (name, permission) VALUES (?, ?)");

            $stmt->bindParam(1, $name);
            $stmt->bindParam(2, $per);

            $stmt->execute();

            echo "<script>alert('Role added successfully.');</script>";
            echo "<script>window.location.href = 'HomePage.php';</script>";
            exit();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
?>
