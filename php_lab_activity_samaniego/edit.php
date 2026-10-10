<?php
include 'dbcon.php';

$id = $_GET['id']

$sql = 'SELECT * FROM users WHERE id = $id';
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
    <link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2>Edit User</h2>

    <form action="update.php" method="POST">
        <input type = "hidden" name = "id" value= "<?php echo $row['id']; ?>">

        <div class = "mb-3">
            <label>Name</label>
            <input type="text" name="name"
            class="form-control"
            value = "<?php echo htmlspecialchars($row['name']); ?>" <required> 
</div>

        <button type = "submit" class="btn
        btn-success">Update</button>
        <a href="index.php" class ="btn
        btn-secondary">Cncel</a>

</form>
</div>

</body>
</html>
            </required>

