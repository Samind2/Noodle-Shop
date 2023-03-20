<?php
require('../connect.php');


$sql = "delete from foodmenu where FoodMenu_ID = :FoodMenu_ID";
$stml = $conn->prepare($sql);
$stml->bindParam(':FoodMenu_ID',$_GET['FoodMenu_ID']);

if($stml->execute()){
    $message = "Successfully delete foodmenu".$_GET['FoodMenu_ID'].".";
}else{
    $message = "Fail to delete foodmenu information.";
}
echo $message;
$conn = null;
header("location:index.php");




?>


