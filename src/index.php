<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
        <title>CRUD Customer Information</title>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-12"> <br>
                    <h3>รายการอาหาร <a href="addFoodmenu_dropdown.php" class="btn btn-info float-end">+เพิ่มรายการอาหาร</a> </h3>
                    <table class="table table-striped  table-hover table-responsive table-bordered">
                        <thead align="center">                        
                            <tr>
                                <th width="10%">รหัสรายการอาหาร</th>
                                <th width="20%">รายการอาหาร</th>
                                <th width="10%">ราคา</th>
                                <th width="10%">ประเภทอาหาร</th>
                            </tr>                       
                        </thead>

                        <tbody>
                          <?php
                            require '../connect.php';
                            $sql =  "SELECT * FROM foodmenu, foodtype WHERE foodmenu.FoodType_ID = foodtype.FoodType_ID " ;
                            $stmt = $conn->prepare($sql);
                            $stmt->execute();
                            $result = $stmt->fetchAll();
                            foreach ($result as $r) { ?>
                            <tr>
                                <td><?= $r['FoodMenu_ID'] ?></td>
                                <td><?= $r['FoodMenu_Name'] ?></td>
                                <td><?= $r['FoodMenu_Price'] ?></td>
                                <td><?= $r['FoodType_Name'] ?></td>
                                <td><a href="updateCustomerForm.php?FoodMenu_ID=<?= $r['FoodMenu_ID'] ?>" class="btn btn-warning btn-sm">แก้ไข</a></td>
                                <td><a href="deleteCustomer.php?FoodMenu_ID=<?= $r['FoodMenu_ID'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('ยืนยันการลบข้อมูล !!');">ลบ</a></td>
                            </tr>
                          <?php 
                            }
                            $conn = null;
                          ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>  
        
        
    </body>
</html>