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
    <!-- <div class="container " style="padding-top: 100px; padding-left:200px"> -->
    <div class="container " style="padding-top: 100px;">
        <!-- <div class="row"> -->
        <div class="">
            <div class=" text-center border rounded bg-light my-10">
                <h1> Users</h1>
            </div>

            <div class="">
                <table class="table text-center" style="color: black;">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Id</th>
                            <th scope="col">Name</th>
                            <th scope="col">email</th>
                            <th scope="col">address</th>
                            <th scope="col">work_phone_number</th>
                            <th scope="col">mobile_number</th>
                            <th scope="col">date_of_birth</th>
                            <th scope="col">category</th>
                            <th scope="col">remarks</th>
                            <th scope="col">added_on</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM `users` ORDER BY id desc";
                        $result = mysqli_query($conn, $sql);
                        $i = 1;
                        while ($row = mysqli_fetch_assoc($result)) { ?>
                            <tr>
                                <td style="font-weight: bold;" scope="row"><?php echo $i++ ?></td>
                                <td><?php echo $row['id'] ?></td>
                                <td><?php echo $row['name'] ?></td>
                                <td><?php echo $row['email'] ?></td>
                                <td><?php echo $row['address'] ?></td>
                                <td><?php echo $row['work_phone_number'] ?></td>
                                <td><?php echo $row['mobile_number'] ?></td>
                                <td><?php echo $row['date_of_birth'] ?></td>
                                <td><?php echo $row['category'] ?></td>
                                <td><?php echo $row['remarks'] ?></td>
                                <td><?php echo $row['added_on'] ?></td>
                                <td> <?php echo "<a class='btn btn-danger'  href='?type=delete&id=" . $row['id'] . "'>Delete</a>&nbsp;";
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