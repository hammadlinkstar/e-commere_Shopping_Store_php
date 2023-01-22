<?php
require __DIR__ .'/dbconnect.php';
require __DIR__ .'/header.php';

?>


<body>
    <div class="container mx-auto" style="padding-top: 100px; padding-left:200px">
        <div class="row">
            <div class="col-md-12 text-center border rounded bg-light my-10">
                <h1> Top 10 Users</h1>

            </div>

            <div class="col-lg-12">
                <table class="table text-center" style="color: black;">
                    <thead>
                        <tr>
                            <th scope="col">#</th>

                            <th scope="col">User Id</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Total Price</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT sum(c.price*c.quantity) total, u.name,u.email, u.id FROM users u join cart c on u.id=c.user_id group by u.id order by total desc limit 10";

                        $result = mysqli_query($conn, $query);

                        $result = mysqli_fetch_all($result, MYSQLI_ASSOC);
                        $i = 1;
                        foreach ($result as $r) {
                            $name = $r['name'];
                            $email = $r['email'];
                            $total = $r['total'];
                            $user_id = $r['id'];


                        ?>

                            <tr>
                                <th scope="row"><?php echo $i++ ?></th>
                                <td><?php echo $user_id ?></td>
                                <td><?php echo $name ?></td>
                                <td><?php echo $email ?></td>
                                <td><?php echo $total ?></td>
                            </tr>

                        <?php }

                        ?>
                    </tbody>
                </table>
            </div>



        </div>
    </div>

</body>

</html>
