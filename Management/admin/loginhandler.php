<?php
session_start();
require '/xampp/htdocs/Management/admin/dbconnect.php';
$showError = false;
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM admin_users WHERE username='$username' and password='$password' ";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);
    if ($count == 1) {
        session_start();
        $_SESSION['ADMIN_LOGIN'] = 'yes';
        $_SESSION['ADMIN_USERNAME'] = $username;
        header('location: /Management/admin/categories.php');
    } else {
        $showError = 'Invalid credentials';
    }
}
