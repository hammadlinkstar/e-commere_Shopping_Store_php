<?php

require '/xampp/htdocs/Management/admin/dbconnect.php';
require '/xampp/htdocs/Management/admin/header.php';
if (isset($_GET['type']) && $_GET['type'] != '') {
    $type = $_GET['type'];
    if ($type == 'delete') {
        $id = $_GET['id'];
        $delete_sql = "DELETE FROM `users` WHERE `id`='$id'";
        mysqli_query($conn, $delete_sql);
    }
}

?>


<body>
    <div class="container mx-auto" style="padding-top: 100px; padding-left:200px">
        <div class="row">
            <div class="col-md-12 text-center border rounded bg-light my-10">
                <h1> Orders</h1>
            </div>

            <div class="col-lg-12">
                <table class="table text-center" style="color: black;">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">User Id</th>
                            <th scope="col">Product Id</th>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        $sql = "SELECT * FROM `cart`";
                        $result = mysqli_query($conn, $sql);
                        $i = 1;
                        while ($row = mysqli_fetch_assoc($result)) { ?>
                            <tr>
                                <th scope="row"><?php echo $i++ ?></th>

                                <td><?php echo $row['user_id'] ?></td>
                                <td><?php echo $row['product_id'] ?></td>
                                <td><?php echo $row['name'] ?></td>
                                <td><?php echo $row['price'] ?></td>
                                <td><?php echo $row['quantity'] ?></td>
                            </tr>

                        <?php } ?>
                    </tbody>
                </table>
            </div>



        </div>
    </div>

</body>

</html>