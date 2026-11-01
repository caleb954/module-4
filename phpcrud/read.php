<?php

include('dbconnection.php');

if (!isset($_GET['viewid']) ||
    !ctype_digit($_GET['viewid'])) {

    die("Invalid user ID.");

}

$id = (int) $_GET['viewid'];

$stmt = mysqli_prepare(
    $con,
    "SELECT * FROM tblusers WHERE ID = ?"
);

mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

$user = mysqli_fetch_assoc($result);

if (!$user) {
    die("User record not found.");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
    content="width=device-width, initial-scale=1">

    <title>View User Details</title>

    <link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="style.css">
</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="card shadow mx-auto"
    style="max-width:700px;">

        <div class="card-header bg-info text-white">

            <h3>User Details</h3>

        </div>

        <div class="card-body">

            <table class="table table-bordered">

                <tr>
                    <th>ID</th>
                    <td><?php echo $user['ID']; ?></td>
                </tr>

                <tr>
                    <th>First Name</th>
                    <td><?php echo htmlspecialchars($user['FirstName']); ?></td>
                </tr>

                <tr>
                    <th>Last Name</th>
                    <td><?php echo htmlspecialchars($user['LastName']); ?></td>
                </tr>

                <tr>
                    <th>Mobile Number</th>
                    <td><?php echo htmlspecialchars($user['MobileNumber']); ?></td>
                </tr>

                <tr>
                    <th>Email</th>
                    <td><?php echo htmlspecialchars($user['Email']); ?></td>
                </tr>

                <tr>
                    <th>Address</th>
                    <td><?php echo htmlspecialchars($user['Address']); ?></td>
                </tr>

                <tr>
                    <th>Creation Date</th>
                    <td><?php echo htmlspecialchars($user['CreationDate']); ?></td>
                </tr>

            </table>

            <a href="index.php" class="btn btn-primary">
                Back to Users
            </a>

            <a href="edit.php?editid=<?php echo $user['ID']; ?>"
            class="btn btn-warning">
                Edit User
            </a>

        </div>

    </div>

</div>

</body>

</html>