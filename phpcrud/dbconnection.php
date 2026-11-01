<?php

$con = mysqli_connect(
    "localhost",
    "root",
    "",
    "phpcrud"
);

if (!$con) {
    die("Connection Failed: " . mysqli_connect_error());
}

mysqli_set_charset($con, "utf8mb4");

?>