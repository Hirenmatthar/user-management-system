    <?php
    //database configuration to connect with DB
    try{
        $pdo = new PDO("mysql:host=localhost:3306; dbname=project2","root","");

        $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        ?>
        <?php
    }
    catch(PDOException $e){
        ?>
        <script>alert("Connection Error");</script>
        <?php
    }
?>