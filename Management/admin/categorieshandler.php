<?php
require __DIR__ .'/dbconnect.php';

$categories = '';
$msg = '';
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
        $msg = "Categories already exist";
    } else {

        if (isset($_GET['id']) && $_GET['id'] != '') {
            $sql = "UPDATE `categories` SET `categories` = '$categories' WHERE `categories`.`id` = '$id'";
            $result = mysqli_query($conn, $sql);
        } else {
            $sql = "INSERT INTO `categories`(`categories`, `status`) VALUES('$categories','1')";
            $result = mysqli_query($conn, $sql);
            header('location: /Management/admin/categories.php');
        }
        header('location: /Management/admin/categories.php');
        die();
    }
}
