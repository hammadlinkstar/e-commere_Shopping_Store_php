<?php
require '/xampp/htdocs/Management/admin/dbconnect.php';
require '/xampp/htdocs/Management/admin/header.php';
// $query = "SELECT sum(price*quantity) total, name, product_id FROM cart  group by name order by total desc limit 10";
$query = "SELECT sum(cart.price*cart.quantity) total, product.name,cart.quantity ,product.id FROM cart join product on cart.product_id=product.id  group by cart.product_id order by total desc limit 10";

$result = mysqli_query($conn, $query);

$result = mysqli_fetch_all($result, MYSQLI_ASSOC);
foreach ($result as $r) {
    $name = $r['name'];
    $total = $r['total'];
}

?>

<body>
    <div class="container mx-auto" style="padding-top: 100px; padding-left:200px">
        <div class="row">
            <div class="col-md-12 text-center border rounded bg-light my-10">
                <h1> Top 10 Selling Products</h1>
            </div>

            <div class="col-lg-12">
                <table class="table text-center" style="color: black;">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Product Id</th>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        foreach ($result as $r) {

                            $product_id = $r['id'];
                            $name = $r['name'];
                            $quantity = $r['quantity'];
                            $total = $r['total'];
                        ?>
                            <tr>
                                <th scope="row"><?php echo $i++ ?></th>
                                <td><?php echo $product_id ?></td>
                                <td><?php echo $name ?></td>
                                <td><?php echo $quantity ?></td>
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