<?php
include "connect_db.php";


$result = mysqli_query($conn, "SELECT * FROM todos");


$total_tasks = mysqli_num_rows($result);


mysqli_data_seek($result, 0);


$done_result = mysqli_query($conn, "SELECT COUNT(*) AS done_count FROM todos WHERE done = 1");
$done_row = mysqli_fetch_assoc($done_result);
$done_count = $done_row['done_count'];


$not_done_count = $total_tasks - $done_count;
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


    <div class="card shadow mb-4">
        <div class="card-header bg-info text-white">
            <h4 class="mb-0">📊 งาน</h4>
        </div>
        <div class="card-body">
            <div class="row text-center">
                <div class="col-md-4">
                    <h5>📌 งานทั้งหมด</h5>
                    <p class="fs-4 fw-bold"><?php echo $total_tasks; ?></p>
                </div>
                <div class="col-md-4">
                    <h5 class="text-success">✅ เสร็จแล้ว</h5>
                    <p class="fs-4 fw-bold text-success"><?php echo $done_count; ?></p>
                </div>
                <div class="col-md-4">
                    <h5 class="text-danger">🕒 ยังไม่เสร็จ</h5>
                    <p class="fs-4 fw-bold text-danger"><?php echo $not_done_count; ?></p>
                </div>
            </div>
        </div>
    </div>


    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0">📋 My To-Do List</h3>
        </div>
        <div class="card-body">


            <form class="d-flex mb-3" action="add.php" method="POST">
                <input type="text" class="form-control me-2" name="task" placeholder="เพิ่มงานใหม่..." required>
                <button class="btn btn-success" type="submit">เพิ่ม</button>
            </form>


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
