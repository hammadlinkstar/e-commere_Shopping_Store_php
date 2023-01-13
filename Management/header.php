<?php
require('dbconnect.php');

$categories = "select * from categories where status=1 order by categories asc";
$cat_res = mysqli_query($conn, $categories);
$cat_arr = array();
while ($row = mysqli_fetch_assoc($cat_res)) {
  $cat_arr[] = $row;
}

?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  <title>Welcome to iShopping</title>
</head>

<body>




  <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
    <div class="container-fluid">
      <a class="navbar-brand" href="/Management">iShopping</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div style="display: flex;
    width: 100%; justify-content: center;">
        <a class="btn mx-1" href="/Management">Home</a>

        <?php
        foreach ($cat_arr as $list) {
        ?>
          <a class='btn mx-1' href='categories.php?id=<?php echo $list['id'] ?>'><?php echo $list['categories'] ?></a>

        <?php
        }
        ?>

      </div>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">

        </ul>

        <div class="mx-2">


          <form class="d-flex">


          </form>
        </div>
        <form action="searchProduct.php" method="GET" class="d-flex">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search">
          <input class="btn btn-success" type="submit" name="submit" value="Search">

        </form>

        <a class="btn btn-success mx-2" href="/Management/mycart.php">MyCart</a>



      </div>
    </div>
  </nav>



  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
  </script>


</body>

</html>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
</script>


</body>

</html>
