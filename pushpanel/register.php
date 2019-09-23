<?php

$mysqlHost = "localhost";
$mysqlUser = "bibliapa__us3r";
$mysqlPwd = "6r7QnJfq50#P";
$mysqlDbname = "bibliapa_base";

if (!$_POST['user_android_token'] || $_POST['user_android_token'] == '') {
    die("Error: token required");
}
$token = $_POST['user_android_token'];
$latitude = (isset($_POST['user_lat'])) ? $_POST['user_lat'] : 0;
$longitude = (isset($_POST['user_lon'])) ? $_POST['user_lon'] : 0;
$app_version = $_POST['user_app_version'];

// Create connection
$conn = mysqli_connect($mysqlHost, $mysqlUser, $mysqlPwd, $mysqlDbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "INSERT INTO users (user_android_token, user_lat, user_lon, user_app_version) VALUES ('$token', '$latitude', '$longitude', '$app_version')";

if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

$conn->close();

?>