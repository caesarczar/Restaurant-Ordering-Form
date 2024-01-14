<!DOCTYPE html>
<?php

$customer_name = $_POST['customer_name'];
$email = $_POST['email'];
$quantity = $_POST['quantity'];
$date = $_POST['date'];
$time = $_POST['time'];
$order_id = $_POST['order_id'];
$item_id = $_POST['item_id'];

$insert_query = "INSERT INTO
`china_orders`
(`customer_name`, `email`, `quantity`, `date`, `time`, `order_id`, `item_id`)
VALUES 
('$customer_name', '$email', '$quantity', '$date', '$time', '$order_id', '$item_id')";

require_once("db_connect.php");
mysqli_select_db($conn, "aidancbradley");
$insert_result = mysqli_query($conn, $insert_query);

if (!$insert_result) {
    echo ("Couldn't insert into table.");
}

$order_query = "SELECT * FROM `imperial_china_menu`, `china_orders`,
WHERE `china_orders`.`order_id` = `imperial_china_menu`.`id`";

$order_result = mysqli_query($conn, $order_query);
mysqli_close($conn);
?>
