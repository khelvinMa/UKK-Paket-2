<?php
require 'function.php';

$id = $_GET['id'];
$data = GetTask("SELECT * FROM task WHERE id = '$id'")[0];
if (isset($_POST['edittask'])) {
    if (EditTask($_POST) > 0) {
        echo "<script>
        alert('Berhasil Mengedit Tugas')
        document.location.href = 'index.php'
        </script>";
    } else {
        echo "<script>
        alert('Gagal Mengedit Tugas')
        </script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List | edit</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <h1>edit Tugas</h1>
        <button class="home-button" onclick="document.location.href = 'index.php'">Back</button>
        <form action="" method="post">
            <div class="form-group">
                <label for="task_name">Nama Tugas</label>
                <input type="text" name="task_name" id="task_name" value="<?= $data['task_name'] ?>" autocomplete="off" required>
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" id="status">
                    <option value="">-- Pilih Status --</option>
                    <option value="not started" <?php if ($data['status'] == 'not started') echo 'selected' ?>>not started</option>
                    <option value="in progress" <?php if ($data['status'] == 'in progress') echo 'selected' ?>>in progress</option>
                    <option value="postponed" <?php if ($data['status'] == 'postponed') echo 'selected' ?>>postponed</option>
                    <option value="cancelled" <?php if ($data['status'] == 'cancelled') echo 'selected' ?>>cancelled</option>
                </select>
            </div>
            <div class="form-group">
                <label for="priority">Prioritas</label>
                <select name="priority" id="priority">
                    <option value="">-- Pilih Prioritas --</option>
                    <option value="Rendah" <?php if ($data['priority'] == 'Rendah') echo 'selected' ?>>Rendah</option>
                    <option value="Sedang" <?php if ($data['priority'] == 'Sedang') echo 'selected' ?>>Sedang</option>
                    <option value="Tinggi" <?php if ($data['priority'] == 'Tinggi') echo 'selected' ?>>Tinggi</option>
                </select>
            </div>
            <div class="form-group">
                <label for="due_date">Tanggal</label>
                <input type="date" name="due_date" id="due_date" value="<?= $data['due_date'] ?>" required>
            </div>
            <button type="submit" name="edittask" class="edit-button" onclick="return confirm('Apakah Anda Yakin Ingin Mengedit Tugas Ini?')">Save</button>
        </form>
    </div>
</body>

</html>