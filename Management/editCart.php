<?php
require('dbconnect.php');
session_start();

$id = $_POST['id0'];
$name = $_POST['name1'];
$price = $_POST['price2'];
$qty = $_POST['qty3'];
$limit = $_POST['limit4'];

$update = $_POST['update'];
$delete = $_POST['delete'];
$save = $_POST['save'];

$product = array($id, $name, $price, $qty, $limit);


if ($update == "Update") {
    $_SESSION['cart'][$name] = $product;
} else if ($delete == "Delete") {
    unset($_SESSION['cart'][$name]);
}

header('location:/Management/mycart.php');
