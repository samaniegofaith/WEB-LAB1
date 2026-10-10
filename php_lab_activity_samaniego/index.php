
<?php
include 'dbcon.php';

$msg = $_GET['msg'] ?? '';

$result = $conn->query("SELECT * FROM users ORDER BY id DESC");

function e($value) {
    return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Management System</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">

    <h1 class="text-center mb-5">User Management System</h1>

    <?php
    if ($msg == 'added') {
        echo '<div class="alert alert-success">User added successfully!</div>';
    } elseif ($msg == 'updated') {
        echo '<div class="alert alert-warning">User updated successfully!</div>';
    } elseif ($msg == 'deleted') {
        echo '<div class="alert alert-danger">User deleted successfully!</div>';
    } elseif ($msg == 'invalid') {
        echo '<div class="alert alert-danger">Please enter a valid name and email.</div>';
    } elseif ($msg == 'notfound') {
        echo '<div class="alert alert-danger">User not found.</div>';
    }
    ?>

    <div class="row">

        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-header">
                    <h4 class="mb-0">Add New User</h4>
                </div>

                <div class="card-body">
                    <form method="POST" action="process.php">

                        <div class="mb-3">
                            <label class="form-label">Full Name</label>
                            <input type="text" name="name"
                                   class="form-control"
                                   placeholder="Enter Full Name"
                                   maxlength="255" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email Address</label>
                            <input type="email" name="email"
                                   class="form-control"
                                   placeholder="Enter Email Address"
                                   maxlength="255" required>
                        </div>

                        <button type="submit"
                                class="btn btn-primary w-100">
                            Submit
                        </button>

                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-8">

            <h4 class="mb-3">Registered Users</h4>

            <div class="table-responsive">
                <table class="table table-bordered table-striped bg-white">

                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Joined</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        if ($result && $result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                        ?>

                        <tr>
                            <td><?php echo e($row['id'] ?? ''); ?></td>
                            <td><?php echo e($row['name'] ?? ''); ?></td>
                            <td><?php echo e($row['email'] ?? ''); ?></td>
                            <td><?php echo e($row['created_at'] ?? ''); ?></td>


                            <td>
                                <a href="edit.php?id=<?php echo e($row['id']); ?>"
                                   class="btn btn-success btn-sm">
                                    Edit
                                </a>

                                <form method="POST" action="delete.php"
                                      class="d-inline"
                                      onsubmit="return confirm('Are you sure you want to delete this user?');">

                                    <input type="hidden" name="id"
                                           value="<?php echo e($row['id']); ?>">

                                    <button type="submit"
                                            class="btn btn-danger btn-sm">
                                        Delete
                                    </button>

                                </form>
                            </td>
                        </tr>

                        <?php
                            }
                        } else {
                            echo '<tr><td colspan="5" class="text-center">No data found</td></tr>';
                        }
                        ?>
                    </tbody>

                </table>
            </div>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
