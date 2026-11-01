<?php
include('dbconnection.php');

// Fetch all registered users
$result = mysqli_query($con, "SELECT * FROM tblusers ORDER BY ID DESC");

// Handle deletion
if (isset($_POST['delete_id'])) {

    $id = (int) $_POST['delete_id'];

    $stmt = mysqli_prepare(
        $con,
        "DELETE FROM tblusers WHERE ID = ?"
    );

    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
    content="width=device-width, initial-scale=1">

    <title>PHP CRUD Application</title>

    <link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="style.css">
</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="card shadow">

        <div class="card-header bg-primary text-white">

            <h3>Registered Users</h3>

        </div>

        <div class="card-body">

            <a href="insert.php"
            class="btn btn-success mb-3">

                + Add New User

            </a>

            <div class="table-responsive">

                <table class="table table-bordered table-striped">

                    <thead class="table-dark">

                        <tr>

                            <th>ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Mobile</th>
                            <th>Email</th>
                            <th>Actions</th>

                        </tr>

                    </thead>

                    <tbody>

                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>

                        <tr>

                            <td>
                                <?php echo $row['ID']; ?>
                            </td>

                            <td>
                                <?php echo htmlspecialchars($row['FirstName']); ?>
                            </td>

                            <td>
                                <?php echo htmlspecialchars($row['LastName']); ?>
                            </td>

                            <td>
                                <?php echo htmlspecialchars($row['MobileNumber']); ?>
                            </td>

                            <td>
                                <?php echo htmlspecialchars($row['Email']); ?>
                            </td>

                            <td>

                                <a href="read.php?viewid=<?php echo $row['ID']; ?>"
                                class="btn btn-info btn-sm">
                                    View
                                </a>

                                <a href="edit.php?editid=<?php echo $row['ID']; ?>"
                                class="btn btn-warning btn-sm">
                                    Edit
                                </a>

                                <form method="POST"
                                style="display:inline;"
                                onsubmit="return confirm('Are you sure you want to delete this user?');">

                                    <input type="hidden"
                                    name="delete_id"
                                    value="<?php echo $row['ID']; ?>">

                                    <button type="submit"
                                    class="btn btn-danger btn-sm">
                                        Delete
                                    </button>

                                </form>

                            </td>

                        </tr>

                    <?php } ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

</body>

</html>