<?php

if (isset($_POST['FoodMenu_ID'])) {
    require '../connect.php';

    $FoodMenu_ID = $_POST['FoodMenu_ID'];
    $FoodMenu_Name = $_POST['FoodMenu_Name'];
    $FoodMenu_Price = $_POST['FoodMenu_Price'];

    echo 'FoodMenu_ID = ' . $FoodMenu_ID;
    echo 'FoodMenu_Name = ' . $FoodMenu_Name;
    echo 'FoodMenu_Price = ' . $FoodMenu_Price; 
    $sql =  "UPDATE  foodmenu set FoodMenu_Name = :FoodMenu_Name , FoodMenu_Price = :FoodMenu_Price Where FoodMenu_ID = :FoodMenu_ID";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':FoodMenu_ID', $_POST['FoodMenu_ID']);
    $stmt->bindParam(':FoodMenu_Name', $_POST['FoodMenu_Name']);
    $stmt->bindParam(':FoodMenu_Price', $_POST['FoodMenu_Price']);
    $stmt->execute();

    echo '
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';

    if ($stmt->rowCount() >= 0) {
        echo '
        <script type="text/javascript">
        
        $(document).ready(function(){
        
            swal({
                title: "Success!",
                text: "Successfuly update foodmenu information",
                type: "success",
                timer: 2500,
                showConfirmButton: false
              }, function(){
                    window.location.href = "index.php";
              });
        });
        
        </script>
        ';
    }
    $conn = null;
    header("location:index.php");
}
?>
