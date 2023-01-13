<?php
require '/xampp/htdocs/Management/admin/dbconnect.php';
require '/xampp/htdocs/Management/admin/header.php';

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
        $update_status_sql = "UPDATE `categories` SET `status`='$status' WHERE `categories`.`id`='$id'";
        mysqli_query($conn, $update_status_sql);
    }

    if ($type == 'delete') {
        $id = $_GET['id'];
        $delete_sql = "DELETE FROM `product` WHERE `product`.`categories_id`='$id'";
        mysqli_query($conn, $delete_sql);
        $delete_sql = "DELETE FROM `categories` WHERE `categories`.`id`='$id'";
        mysqli_query($conn, $delete_sql);
    }
}
?>

<body>
    <div class="container mx-auto" style="padding-top: 100px; padding-left:200px">
        <div class="row">
            <div class="col-md-12 text-center border rounded bg-light my-10">
                <h1> Categories</h1>
                <!-- <button class="btn btn-sm btn-outline-success">Add Categories</button> -->
                <h4><a class="btn btn-outline-success" href="/Management/admin/manage_categories.php"> Add Categories</a></h4>
            </div>

            <div class="col-lg-12">
                <table class="table text-center" style="color: black;">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">ID</th>
                            <th scope="col">Categories</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM categories order by categories asc";
                        $result = mysqli_query($conn, $sql);
                        $i = 1;
                        while ($row = mysqli_fetch_assoc($result)) { ?>
                            <tr>
                                <th scope="row"><?php echo $i++ ?></th>
                                <td><?php echo $row['id'] ?></td>
                                <td><?php echo $row['categories'] ?></td>
                                <td><?php if ($row['status'] == 1) {
                                        echo "<a class='btn btn-success' href='?type=status&operation=deactive&id=" . $row['id'] . "'>Active</a>&nbsp;";
                                    } else {
                                        echo "<a class='btn btn-warning' href='?type=status&operation=active&id=" . $row['id'] . "'>Deactive</a>&nbsp;";
                                    }
                                    echo "<a class='btn btn-primary' href='/Management/admin/manage_categories.php?id=" . $row['id'] . "'>Edit</a>&nbsp;";
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