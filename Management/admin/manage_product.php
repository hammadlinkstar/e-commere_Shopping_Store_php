<?php
require __DIR__ .'/dbconnect.php';

$categories_id = '';
$name = '';
// $mrp = '';
$price = '';
$qty = '';
$image = '';
// $short_desc = '';
$description = '';
// $meta_title = '';
// $meta_desc = '';
// $meta_keyword = '';


$msg = '';
$id = '';
$image_required = 'required';
//FOR EDIT BUTTON TO SHOW ID ON FORM
if (isset($_GET['id']) && $_GET['id'] != '') {
    $image_required = '';

    $id = $_GET['id'];
    $sql = "SELECT * FROM `product` WHERE id='$id'";
    $result = mysqli_query($conn, $sql);
    $check = mysqli_num_rows($result);
    if ($check > 0) {
        $row = mysqli_fetch_assoc($result);

        $categories_id = $row['categories_id'];
        $name = $row['name'];
        $price = $row['price'];
        $qty = $row['qty'];
        $description = $row['description'];
    } else {
        header('location: /Management/admin/product.php');
        die();
    }
}

if (isset($_POST['submit'])) {
    $categories_id = $_POST['categories_id'];
    $name = $_POST['name'];

    $price = $_POST['price'];
    $qty = $_POST['qty'];
    $description = $_POST['description'];


    $sql = "SELECT * FROM `product` WHERE name='$name'";
    $result = mysqli_query($conn, $sql);
    $check = mysqli_num_rows($result);
    if ($check > 0) {
        if (isset($_GET['id']) && $_GET['id'] != '') {
            $getData = mysqli_fetch_assoc($result);
            if ($id == $getData['id']) {
            } else {
                $msg = "Product already exist";
            }
        } else {
            $msg = "Product already exist";
        }
    }
    if ($_FILES['image']['type'] != 'image/png' && $_FILES['image']['type'] != 'image/jpg' && $_FILES['image']['type'] != 'image/jpeg') {
        $msg = "Please select only png,jpg and jpeg image formate";
    }
    if ($msg == '') {

        if (isset($_GET['id']) && $_GET['id'] != '') {
            $id = $_GET['id'];
            if ($_FILES['image']['name'] != '') {
                $image = rand(111111111, 999999999) . '_' . $_FILES['image']['name'];
                move_uploaded_file($_FILES['image']['tmp_name'], '../media/product/' . $image);
                $update_sql = "UPDATE `product` SET `categories_id` = '$categories_id', `name` = '$name',`price` = '$price',`qty` = '$qty',`image` = '$image',`description` = '$description' WHERE `id`='$id'";
            } else {
                $update_sql = "UPDATE `product` SET `categories_id` = '$categories_id', `name` = '$name',`price` = '$price',`qty` = '$qty',`description` = '$description' WHERE `id`='$id'";
            }
            $result = mysqli_query($conn, $update_sql);
        } else {
            $image = rand(111111111, 999999999) . '_' . $_FILES['image']['name'];
            move_uploaded_file($_FILES['image']['tmp_name'], '../media/product/' . $image);
            $sql = "INSERT INTO `product`(`categories_id`, `name`,`price`,`qty`,`image`,`description`,`status`) VALUES('$categories_id','$name','$price','$qty','$image','$description','1')";
            $result = mysqli_query($conn, $sql);
        }
        header('location: /Management/admin/product.php');
        die();
    }
}

require '/xampp/htdocs/Management/admin/header.php';

?>
<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Product Form</h4>
                    <!-- <span class="ml-1">Element</span> -->
                </div>
            </div>

        </div>
        <!-- row -->
        <div class="row">
            <div class="col-xl-6 col-xxl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="basic-form">
                            <?php if ($id) {
                                echo '<form action="/Management/admin/manage_product.php?id=' . $id . '" method="POST" enctype="multipart/form-data">';
                            } else {
                                echo '<form action="/Management/admin/manage_product.php" method="POST" enctype="multipart/form-data">';
                            } ?>

                            <div class="form-group">
                                <label class="card-title" for="categories">Categories</label>
                                <select class="form-control input-default " name="categories_id">
                                    <option>Select Category</option>
                                    <?php
                                    $sql = "SELECT id,categories FROM categories ORDER BY categories asc";
                                    $result = mysqli_query($conn, $sql);
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        if ($row['id'] == $categories_id) {
                                            echo '<option selected value=' . $row['id'] . '>' . $row['categories'] . '</option>';
                                        } else {
                                            echo '<option value=' . $row['id'] . '>' . $row['categories'] . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>


                            <div class="form-group">
                                <label class="card-title" for="name">Product Name</label>
                                <input type="text" name="name" class="form-control input-default " placeholder="Enter product name" value="<?php echo $name ?>" required>
                            </div>
                            <div class="form-group">
                                <label class="card-title" for="description">Description</label>
                                <textarea name="description" class="form-control input-default " placeholder="Enter product description" required><?php echo $description ?></textarea>
                            </div>
                            <div class="form-group">
                                <label class="card-title" for="price">Price</label>
                                <input type="text" name="price" class="form-control input-default " placeholder="Enter product price" value="<?php echo $price ?>" required>
                            </div>
                            <div class="form-group">
                                <label class="card-title" for="qty">Quantity</label>
                                <input type="text" name="qty" class="form-control input-default " placeholder="Enter qty" value="<?php echo $qty ?>" required>
                            </div>
                            <div class="form-group">
                                <label class="card-title" for="image">Image</label>
                                <input type="file" name="image" class="form-control input-default " <?php echo $image_required ?>>
                            </div>
                            <button type="submit" name="submit" class="btn btn-sm btn-outline-success">Add Product</button>
                            <?php echo $msg; ?>
                            </form>
                        </div>
                    </div>
                </div>
