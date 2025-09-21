<?php
include "connect_db.php";

$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $task = $_POST['task'];
    $done = isset($_POST['done']) ? 1 : 0;
    mysqli_query($conn, "UPDATE todos SET task='$task', done=$done WHERE id=$id");
    header("Location: index.php");
    exit;
}

$result = mysqli_query($conn, "SELECT * FROM todos WHERE id=$id");
$todo = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>แก้ไขงาน</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-warning">
            <h3 class="mb-0">✏️ แก้ไขงาน</h3>
        </div>
        <div class="card-body">
            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">ชื่องาน</label>
                    <input type="text" name="task" class="form-control" value="<?php echo htmlspecialchars($todo['task']); ?>" required>
                </div>
                <div class="form-check mb-3">
                    <input type="checkbox" name="done" class="form-check-input" <?php echo $todo['done'] ? "checked" : ""; ?>>
                    <label class="form-check-label">ทำเสร็จแล้ว</label>
                </div>
                <button type="submit" class="btn btn-primary">บันทึก</button>
                <a href="index.php" class="btn btn-secondary">ยกเลิก</a>
            </form>
        </div>
    </div>
</div>
</body>
</html>
