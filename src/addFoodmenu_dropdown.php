<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
	<title>User Registration</title>
</head>
<body>


<?php
require '../connect.php';

$sql_select = "select * from foodtype order by FoodType_ID ";
$stmt_s = $conn->prepare($sql_select);
$stmt_s->execute();


if (isset($_POST['submit'])) {
    echo "foodmenu_ID=".$_POST['FoodMenu_ID'];
    echo "foodmenu_Name=".$_POST['FoodMenu_Name'];
    
    if (!empty($_POST['FoodMenu_ID']) && !empty($_POST['FoodMenu_Name'])) {
        echo '<br> line25' . $_POST['FoodMenu_ID'];
        //require 'connect.php';
echo "FoodMenu_ID".$_POST['FoodMenu_ID'];
echo "FoodMenu_Name".$_POST['FoodMenu_Name']; 
echo "FoodMenu_Price".$_POST['FoodMenu_Price'];
echo "FoodType_ID".$_POST['FoodType_ID'];

        $sql = "insert into foodmenu values (:FoodMenu_ID, :FoodMenu_Name, :FoodMenu_Price, :FoodType_ID)";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':FoodMenu_ID', $_POST['FoodMenu_ID']);
        $stmt->bindParam(':FoodMenu_Name', $_POST['FoodMenu_Name']);
        $stmt->bindParam(':FoodMenu_Price', $_POST['FoodMenu_Price']);
        $stmt->bindParam(':FoodType_ID', $_POST['FoodType_ID']);
    
        

        try {
            if ($stmt->execute()):
                $message = 'Successfully add new foodmenu';
            else:
                $message = 'Fail to add new foodmenu';
            endif;
            echo $message;
        } catch (PDOException $e) {
            echo 'Fail! ' . $e;
        }

        $conn = null;
    }

     header("location:index.php");
}
?>



    <div class="container">
      <div class="row">
        <div class="col-md-4"> <br>
            <h3>ฟอร์มเพิ่มรายการอาหาร</h3>
            <form  action="addFoodmenu_dropdown.php" method="POST">

            <input type="text" placeholder="Enter FoodMenu ID" name="FoodMenu_ID"> 
            <br> <br>
            <input type="text" placeholder="FoodMenu Name" name="FoodMenu_Name">
            <br> <br>
            <input type="text" placeholder="FoodMenu Price" name="FoodMenu_Price">
            <br> <br> 

            <label>Select a FoodType</label>
                <select name="FoodType_ID">
                    <?php while ($cc = $stmt_s->fetch(PDO::FETCH_ASSOC)) { ?>
                        <option value="<?php echo $cc['FoodType_ID']; ?>">
                            <?php echo $cc['FoodType_Name']; ?>
                        </option>
                    <?php } ?>
                </select>       
            <br> <br>

            <input type="submit" value="Submit" name="submit" />
            </form>
            </div>
        </div>
    </div>
</body>
</html>



