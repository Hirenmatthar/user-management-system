<?php
// Assuming you have already established a database connection
require_once "dbconfig.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $name = $_POST['name'];
  $role = $_POST['role'];
  $email = $_POST['email'];
  $address = $_POST['address'];
  $phone = $_POST['phone'];
  $password = $_POST['password'];

  $errors = [];

  // Perform server-side validation
  // ...

  if (empty($errors)) {
    try {
      $stmt = $pdo->prepare("INSERT INTO registered (name, role, email, address, phone, password) VALUES (?, ?, ?, ?, ?, ?)");

      $stmt->bindParam(1, $name);
      $stmt->bindParam(2, $role);
      $stmt->bindParam(3, $email);
      $stmt->bindParam(4, $address);
      $stmt->bindParam(5, $phone);
      $stmt->bindParam(6, $password);

      $stmt->execute();

      // Return success response
      $response = [
        "success" => true
      ];
      echo json_encode($response);
      exit();
    } catch (PDOException $e) {
      // Return error response
      $response = [
        "success" => false,
        "message" => "Error: " . $e->getMessage()
      ];
      echo json_encode($response);
    }
  } else {
    // Return error response
    $response = [
      "success" => false,
      "message" => "Form validation failed."
    ];
    echo json_encode($response);
  }
}
?>
