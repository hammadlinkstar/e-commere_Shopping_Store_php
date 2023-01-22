<?php

require __DIR__ .'/dbconnect.php';
require __DIR__ .'/header.php';

if (isset($_GET['type']) && $_GET['type'] != '') {
    $type = $_GET['type'];
    if ($type == 'status') {
        $operation = $_GET['operation'];
        $id = $_GET['id'];
        if ($operation == 'active') {
            $status = '1';
        } else {
            $status = '0';
        }
        $update_status_sql = "UPDATE `product` SET `status`='$status' WHERE `product`.`id`='$id'";
        mysqli_query($conn, $update_status_sql);
    }

    if ($type == 'delete') {
        $id = $_GET['id'];
        $delete_sql = "DELETE FROM `product` WHERE `product`.`id`='$id'";
        mysqli_query($conn, $delete_sql);
    }
}


?>

<body>
    <div class="container mx-auto" style="padding-top: 100px; padding-left:200px">
        <div class="row">
            <div class="col-md-12 text-center border rounded bg-light my-10">
                <h1> Products</h1>
                <h4><a class="btn btn-outline-success" href="/Management/admin/manage_product.php"> Add Product</a></h4>
            </div>

            <div class="col-lg-12">
                <table class="table text-center" style="color: black;">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">ID</th>
                            <th scope="col">Categories</th>
                            <th scope="col">Name</th>
                            <th scope="col">Image</th>
                            <th scope="col">Price</th>
                            <th scope="col">Qty</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT `product`.*,`categories`.`categories` FROM `product`,`categories` WHERE `product`.`categories_id` = `categories`.`id` ORDER BY `product`.`id` desc";
                        $result = mysqli_query($conn, $sql);
                        $i = 1;
                        while ($row = mysqli_fetch_assoc($result)) { ?>
                            <tr>
                                <td style="font-weight: bold;" scope="row"><?php echo $i++ ?></td>
                                <td><?php echo $row['id'] ?></td>
                                <td><?php echo $row['categories'] ?></td>
                                <td><?php echo $row['name'] ?></td>
                                <td><img style="max-width: 200px;max-height: 70px;height: 70px;width: 200px;" src="/Management/media/product/<?php echo $row['image'] ?>" /></td>
                                <td><?php echo $row['price'] ?></td>
                                <td><?php echo $row['qty'] ?></td>
                                <td style="display: flex;padding-top: 30px;"><?php if ($row['status'] == 1) {
                                                                                    echo "<a class='btn btn-success' href='?type=status&operation=deactive&id=" . $row['id'] . "'>Active</a>&nbsp;";
                                                                                } else {
                                                                                    echo "<a class='btn btn-warning' href='?type=status&operation=active&id=" . $row['id'] . "'>Deactive</a>&nbsp;";
                                                                                }
                                                                                echo "<a class='btn btn-primary' href='/Management/admin/manage_product.php?id=" . $row['id'] . "'>Edit</a>&nbsp;";
                                                                                echo "<a class='btn btn-danger'  href='?type=delete&id=" . $row['id'] . "'>Delete</a>&nbsp;";
                                                                                ?></td>

                            </tr>

                        <?php } ?>
                    </tbody>
                </table>
            </div>



        </div>
    </div>

</body>

</html>
