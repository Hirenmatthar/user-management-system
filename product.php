<?php

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    require_once "dbconfig2.php";

    //SQL insert Statement
    $sql = "insert into products(product_id,product_sku,product_name, product_category, product_price,product_img) values(:product_id,:product_sku,:product_name,:product_category,:product_price,:product_img)";

    //create prepare statement template
    $res = $pdo->prepare($sql);

    //bind parameter to statement
    $res->bindParam(':product_id',$_REQUEST['product_id']);
    $res->bindParam(':product_sku',$_REQUEST['product_sku']);
    $res->bindParam(':product_name',$_REQUEST['product_name']);
    $res->bindParam(':product_category',$_REQUEST['product_category']);
    $res->bindParam(':product_price',$_REQUEST['product_price']);
    $res->bindParam(':product_img',$_REQUEST['product_img']);
    
    //execute prepare statement
    $res->execute();
    // echo  'Data Inserted!';

    echo "<script>alert('Inserted Successfull...');</script>";
    echo "<script>window.location.href = 'product_data.php';</script>";

    //close connection
    unset($pdo);
}
?>