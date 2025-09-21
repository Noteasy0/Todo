<?php
include "connect_db.php";

$result = mysqli_query($conn, "SELECT * FROM todos");
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>To-Do List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0">📋 My To-Do List</h3>
        </div>
        <div class="card-body">

            <!-- Add Task Form -->
            <form class="d-flex mb-3" action="add.php" method="POST">
                <input type="text" class="form-control me-2" name="task" placeholder="เพิ่มงานใหม่..." required>
                <button class="btn btn-success" type="submit">เพิ่ม</button>
            </form>

            <!-- Task List -->
            <ul class="list-group">
                <?php while($row = mysqli_fetch_assoc($result)) { ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <span class="<?php echo $row['done'] ? 'text-decoration-line-through text-muted' : ''; ?>">
                                <?php echo htmlspecialchars($row['task']); ?>
                            </span>
                            <small class="ms-2">
                                [<?php echo $row['done'] ? "✔ เสร็จแล้ว" : "⏳ ยังไม่เสร็จ"; ?>]
                            </small>
                        </div>
                        <div>
                            <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-warning">แก้ไข</a>
                            <a href="delete.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger"
                               onclick="return confirm('ลบงานนี้จริงหรือไม่?');">ลบ</a>
                        </div>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</div>

</body>
</html>
