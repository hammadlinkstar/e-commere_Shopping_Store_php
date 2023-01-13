<?php
session_start();

$id = $_POST['id'];
$name = $_POST['name'];
$price = $_POST['price'];
$qty = $_POST['qty'];
$limit = $_POST['limit'];

$product = array($id, $name, $price, $qty, $limit);

$_SESSION['cart'][$name] = $product;

header('location:/Management/index.php');
