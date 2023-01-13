<?php

require '/xampp/htdocs/Management/admin/dbconnect.php';

$categories = '';
$msg = '';
$id = '';
//FOR EDIT BUTTON TO SHOW ID ON FORM
if (isset($_GET['id']) && $_GET['id'] != '') {
    $id = $_GET['id'];
    $sql = "SELECT * FROM `categories` WHERE id='$id'";
    $result = mysqli_query($conn, $sql);
    $check = mysqli_num_rows($result);
    if ($check > 0) {
        $row = mysqli_fetch_assoc($result);
        $categories = $row['categories'];
    } else {
        header('location: /Management/admin/categories.php');
        die();
    }
}

if (isset($_POST['submit'])) {
    $categories = $_POST['categories'];
    $sql = "SELECT * FROM `categories` WHERE categories='$categories'";
    $result = mysqli_query($conn, $sql);
    $check = mysqli_num_rows($result);
    if ($check > 0) {
        if (isset($_GET['id']) && $_GET['id'] != '') {
            $getData = mysqli_fetch_assoc($result);
            if ($id == $getData['id']) {
            } else {
                $msg = "Categories already exist";
            }
        } else {
            $msg = "Categories already exist";
        }
    }
    if ($msg == '') {
        if (isset($_GET['id']) && $_GET['id'] != '') {
            $id = $_GET['id'];
            $sql = "UPDATE `categories` SET `categories` = '$categories' WHERE `categories`.`id` = '$id'";
            $result = mysqli_query($conn, $sql);
        } else {
            $sql = "INSERT INTO `categories`(`categories`, `status`) VALUES('$categories','1')";
            $result = mysqli_query($conn, $sql);
        }
        header('location: /Management/admin/categories.php');
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
                    <h4>Categories Form</h4>
                    <!-- <span class="ml-1">Element</span> -->
                </div>
            </div>

        </div>
        <!-- row -->
        <div class="row">
            <div class="col-xl-6 col-xxl-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Categories</h4>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                            <?php
                            if ($id) {
                                echo  '<form action="/Management/admin/manage_categories.php?id=' . $id . '" method="POST">';
                            } else {
                                echo  '<form action="/Management/admin/manage_categories.php" method="POST">';
                            }


                            ?>
                            <div class="form-group">
                                <input type="text" name="categories" class="form-control input-default " placeholder="Enter Categories" value="<?php echo $categories ?>" required>
                            </div>
                            <button type="submit" name="submit" class="btn btn-sm btn-outline-success">Add Categories</button>
                            <?php echo $msg; ?>
                            </form>
                        </div>
                    </div>
                </div>