<?php
session_start();
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once 'dbconfig.php';
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Validate the username and password
    $stmt = $pdo->prepare("SELECT * FROM registered WHERE email = :email AND password = :password");
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":password", $password);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $emailValue = $result['email'];
    $passwordValue = $result['password'];

    if($emailValue == $email && $passwordValue == $password){
        $_SESSION['email'] = $emailValue;
        $response = array(
            'success' => true,
            'message' => 'Login successful'
        );
    } else {
        $response = array(
            'success' => false,
            'message' => 'Incorrect username or password'
        );
    }

    echo json_encode($response);
}
?>
