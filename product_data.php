<html>
    <head>
        <title>Products</title>
    </head>
    <style>
        .content-table{
            border-collapse: collapse;
            margin: 25px 0;
            font-size: 20px;
            min-width: 400px;
            border-radius: 5px 5px 0 0;
            overflow: hidden;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
        }
        .content-table thead tr{
            background-color: #058283;
            color: #fff;
            text-align: left;
            font-weight: bold;
        }
        .content-table th,
        .content-table td{
            padding: 12px 15px;
            text-align:center;
        }
        .content-table tbody tr{
            border-bottom: 1px solid #dddddd;
        }
        .content-table tbody tr:nth-of-type(even){
            background-color: #f3f3f3;
        }
        .content-table tbody tr:last-of-type{
            border-bottom: 2px solid #009829;
        }
        .content-table tbody tr.active-row:hover{
            font-weight: bold;
            color: #fff;
            background-color:cornflowerblue;
        }
        .btn1{
            border-radius: 5px;
            background-color: green;
            width: 100px;
            height: 50px;
            font-size: 25px;
            cursor: pointer;
        }
        .btn1:hover{
            background-color: #fff;
            color: #058283;
        }
        .btn2{
            border-radius: 5px;
            background-color: red;
            width: 100px;
            height: 50px;
            font-size: 25px;
            cursor: pointer;
        }
        .btn2:hover{
            background-color: #fff;
            color: #058283;
        }
        .add{
            height: 10vh;
            width: 100%;
        }
        .btn1 a{
            text-decoration: none;
            color: inherit;
        }
        .btn2 a{
            text-decoration: none;
            color: inherit;
        }
    </style>
    <body>
        <?php
            if(isset($_REQUEST['msg'])){
                ?>
                <h4><?php echo $_REQUEST['msg'];?></h4>
                <?php
            }
        ?>
        <button type="submit" class="btn1"><a href="product_form.php">Add</a></button>
        <table class="content-table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>SKU</th>
                    <th>Name</th> 
                    <th>Category</th>
                    <th>Price</th>
                    <th>Image</th> 
                    <th colspan="2">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    require_once "dbconfig2.php";
                    $sql = "select * from products";
                    $res = $pdo->query($sql);
                    if($res->rowCount()>0)
                    {
                        while($row = $res->fetch()){
                            ?>
                            <tr class="active-row">
                                <td><?php echo $row["product_id"]; ?></td>
                                <td><?php echo $row["product_sku"]; ?></td>
                                <td><?php echo $row["product_name"]; ?></td>
                                <td><?php echo $row["product_category"]; ?></td>
                                <td><?php echo $row["product_price"]; ?></td>
                                <td><img src="<?php echo $row["product_img"]; ?>"></td>
                                <td><button type="submit" class="btn1"><a href="product_update.php?product_id=<?php echo $row['product_id']; ?>">Edit</a></button></td>
                                <td><button type="submit" class="btn2"><a href="product_delete.php?product_id=<?php echo $row['product_id'];?>" onclick="return confirm('are you sure want to delete.');">Delete</a></button></td>
                            </tr>
                            <?php
                        }
                    }
                ?>
            </tbody>
        </table>
    </body>
    <script>
        // When the user clicks on <div>, open the popup
        function myFunction() {
            var popup = document.getElementById("myPopup");
            popup.classList.toggle("show");
        }
    </script>
</html>