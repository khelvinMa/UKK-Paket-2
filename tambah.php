<?php
require 'function.php';
if (isset($_POST['addtask'])) {
    if (AddTask($_POST) > 0) {
        echo "<script>
        alert('Berhasil Menambahkan Tugas')
        document.location.href = 'index.php'
        </script>";
    } else {
        echo "<script>
        alert('Gagal Menambahkan Tugas')
        </script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List | Tambah</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <h1>Tambah Tugas</h1>
        <button class="home-button" onclick="document.location.href = 'index.php'">Back</button>
        <form action="" method="post">
            <div class="form-group">
                <label for="task_name">Nama Tugas</label>
                <input type="text" name="task_name" id="task_name" placeholder="Masukkan Tugas..." autocomplete="off" required>
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" id="status">
                    <option value="">-- Pilih Status --</option>
                    <option value="not started">not started</option>
                    <option value="in progress">in progress</option>
                    <option value="postponed">postponed</option>
                    <option value="cancelled">cancelled</option>
                </select>
            </div>
            <div class="form-group">
                <label for="priority">Prioritas</label>
                <select name="priority" id="priority">
                    <option value="">-- Pilih Prioritas --</option>
                    <option value="Rendah">Rendah</option>
                    <option value="Sedang">Sedang</option>
                    <option value="Tinggi">Tinggi</option>
                </select>
            </div>
            <div class="form-group">
                <label for="due_date">Tanggal</label>
                <input type="date" name="due_date" id="due_date" value="<?= date('Y-m-d') ?>" required>
            </div>
            <button type="submit" name="addtask" class="add-button">Add</button>
        </form>
    </div>
</body>

</html>