<?php

include('dbconnection.php');

if (!isset($_GET['editid']) ||
    !ctype_digit($_GET['editid'])) {

    die("Invalid user ID.");

}

$id = (int) $_GET['editid'];

// Fetch existing user
$stmt = mysqli_prepare(
    $con,
    "SELECT * FROM tblusers WHERE ID = ?"
);

mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

$user = mysqli_fetch_assoc($result);

mysqli_stmt_close($stmt);

if (!$user) {
    die("User not found.");
}

// Process update
if (isset($_POST['submit'])) {

    $fname = trim($_POST['fname']);
    $lname = trim($_POST['lname']);
    $mobile = trim($_POST['contactno']);
    $email = trim($_POST['email']);
    $address = trim($_POST['address']);

    $stmt = mysqli_prepare(
        $con,
        "UPDATE tblusers SET
        FirstName = ?,
        LastName = ?,
        MobileNumber = ?,
        Email = ?,
        Address = ?
        WHERE ID = ?"
    );

    mysqli_stmt_bind_param(
        $stmt,
        "sssssi",
        $fname,
        $lname,
        $mobile,
        $email,
        $address,
        $id
    );

    if (mysqli_stmt_execute($stmt)) {

        mysqli_stmt_close($stmt);

        header("Location: index.php");
        exit();

    } else {

        echo "Update failed: " .
        htmlspecialchars(mysqli_error($con));

    }

    mysqli_stmt_close($stmt);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
    content="width=device-width, initial-scale=1">

    <title>Edit User</title>

    <link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="style.css">
</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="card shadow mx-auto"
    style="max-width:600px;">

        <div class="card-header bg-warning">

            <h3>Update User Information</h3>

        </div>

        <div class="card-body">

            <form method="POST">

                <div class="mb-3">

                    <label>First Name</label>

                    <input type="text"
                    name="fname"
                    class="form-control"
                    value="<?php echo htmlspecialchars($user['FirstName']); ?>"
                    required>

                </div>

                <div class="mb-3">

                    <label>Last Name</label>

                    <input type="text"
                    name="lname"
                    class="form-control"
                    value="<?php echo htmlspecialchars($user['LastName']); ?>"
                    required>

                </div>

                <div class="mb-3">

                    <label>Mobile Number</label>

                    <input type="tel"
                    name="contactno"
                    class="form-control"
                    value="<?php echo htmlspecialchars($user['MobileNumber']); ?>"
                    required>

                </div>

                <div class="mb-3">

                    <label>Email Address</label>

                    <input type="email"
                    name="email"
                    class="form-control"
                    value="<?php echo htmlspecialchars($user['Email']); ?>"
                    required>

                </div>

                <div class="mb-3">

                    <label>Address</label>

                    <textarea name="address"
                    class="form-control"
                    required><?php echo htmlspecialchars($user['Address']); ?></textarea>

                </div>

                <button type="submit"
                name="submit"
                class="btn btn-success w-100">

                    Update Record

                </button>

            </form>

            <a href="index.php"
            class="btn btn-secondary w-100 mt-2">

                Cancel

            </a>

        </div>

    </div>

</div>

</body>

</html>