<?php
require_once "dbconfig2.php";

if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];

    // Delete the category
    $deleteProductSql = "DELETE FROM products WHERE product_id = :product_id";
    $deleteProductStmt = $pdo->prepare($deleteProductSql);
    $deleteProductStmt->bindParam(':product_id', $product_id);

    if ($deleteProductStmt->execute()) {
        $msg = "Product deleted successfully";
    } else {
        $msg = "Error deleting product";
    }
}

header("Location: product_data.php?msg=" . urlencode($msg));
exit();
?>
