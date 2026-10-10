
<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

include 'dbcon.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: index.php");
    exit;
}

$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');

if ($name === '' || $email === '' ||
    !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: index.php?msg=invalid");
    exit;
}

try {
    $stmt = $conn->prepare(
        "INSERT INTO users (name, email) VALUES (?, ?)"
    );

    $stmt->bind_param("ss", $name, $email);
    $stmt->execute();
    $stmt->close();

    header("Location: index.php?msg=added");
    exit;

} catch (mysqli_sql_exception $e) {
    die("Unable to save user: " . htmlspecialchars($e->getMessage()));
}
?>
