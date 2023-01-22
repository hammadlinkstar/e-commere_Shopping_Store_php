    <?php

    session_start();
    include __DIR__ .'/header.php';

    include __DIR__ ."/checkOutModal.php";

    ?>


    <body>
      <div class="container">
        <div class="row">
          <div class="col-md-12 text-center border rounded bg-light my-5">
            <h1> MY CART</h1>
          </div>

          <div class="col-lg-12">
            <table class="table text-center">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Product Id</th>
                  <th scope="col">Item Name</th>
                  <th scope="col">Item Price</th>
                  <th scope="col">Quantity</th>
                  <th scope="col">Total Price</th>
                </tr>
              </thead>
              <tbody>
                <?php

                $bill = 0;
                $sno = 1;
                if (isset($_SESSION['cart'])) {
                  foreach ($_SESSION['cart'] as $products) {
                    $p = 0;
                    $q = 0;
                    $t = 2;
                    $limit = isset($products[4]) ? $products[4] : 10000;
                    echo '<tr>';

                    echo '<th scope="row">' . ($sno++) . '</th>';
                    echo '<form action="/Management/editCart.php" method="POST">';
                    foreach ($products as $key => $value) {
                      if ($key == 0) {
                        echo "<input type='hidden' name='id$key' value='" . $value . "'>";
                        echo ' <td>' . $value . '</td>';
                      } else if ($key == 1) {
                        echo "<input type='hidden' name='name$key' value='" . $value . "'>";
                        echo ' <td>' . $value . '</td>';
                        // $p = $value;
                      } else if ($key == 2) {
                        echo "<input type='hidden' name='price$key' value='" . $value . "'>";
                        echo ' <td>' . $value . '</td>';
                        $p = $value;
                      } else if ($key == 3) {
                        echo " <td><input type='number' min='1' max='$limit' name='qty$key' value='" . $value . "'></td>";
                        $q = $value;
                      } else if ($key == 4) {
                        echo " <input type='hidden' min='1' max='$limit' name='limit$key' value='" . $value . "'>";
                        // $q = $value;
                      }
                    }
                    $bill = $p * $q;


                    echo '<td>' . $bill . '</td>';
                    echo '<td><input type="submit" name="update" value="Update" class="btn btn-sm btn-outline-success"></td>';
                    echo '<td><input type="submit" name="delete" value="Delete"  class="btn btn-sm btn-outline-danger"></td>';
                    echo '</form>';
                    echo '</tr>';
                  }
                } ?>
              </tbody>


            </table>
          </div>


        </div>
        <?php
        echo '<a href="/Management/index.php" class="btn btn-primary">Continue Shopping</a>';
        if (isset($_SESSION['cart']) && isset($limit)) {
          echo '<a href="/Management/mycart.php" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#checkOutModal">Check out</a>';
        } else {
          echo '<button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#checkOutModal" disabled>Check out</button>';
        }
        ?>
      </div>
    </body>
