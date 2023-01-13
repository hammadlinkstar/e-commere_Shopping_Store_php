<?php
require('dbconnect.php');
session_start();


if (isset($_POST['submit'])) {
    $email = strtolower(trim($_POST['email']));
    $name = trim($_POST['name']);
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $cell = $_POST['cell'];
    $dob = $_POST['dob'];
    $category = $_POST['category'];
    $remarks = $_POST['remarks'];

    $checkIfUserExists = "SELECT * FROM users where email='$email'";
    $result = mysqli_query($conn, $checkIfUserExists);
    $user_id = null;
    if ($row = mysqli_fetch_assoc($result)) {
        $user_id = $row['id'];
    }
    if (!$user_id) {
        $sql = "INSERT INTO `users` (`name`, `email`, `address`, `work_phone_number`, `mobile_number`, `date_of_birth`, `category`, `remarks`) VALUES ('$name', ' $email', '$address','$phone', '$cell', '$dob', '$category', '$remarks')";
        $result = mysqli_query($conn, $sql);
        $user_id = mysqli_insert_id($conn);
    } else {
        $sql = "UPDATE users SET name='$name', address='$address', work_phone_number='$phone', mobile_number='$cell', date_of_birth=$dob, category=$category,remarks=$remarks where id=$user_id";
        $result = mysqli_query($conn, $sql);
    }

    foreach ($_SESSION['cart'] as $row) {
        $fieldVal1 = $row[0];
        $fieldVal2 = $row[1];
        $fieldVal3 = $row[2];
        $fieldVal4 = $row[3];
        $sql = "INSERT INTO `cart` (`name`,`user_id`, `price`, `quantity`,`product_id`) VALUES ('$fieldVal2', '$user_id', '$fieldVal3', '$fieldVal4','$fieldVal1')";
        $result = mysqli_query($conn, $sql);
    }

    session_destroy();
    session_reset();
    header('location: /Management/index.php');
}
