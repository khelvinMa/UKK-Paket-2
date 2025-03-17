<?php
require 'function.php';

$history = GetTask("SELECT * FROM task_history");

if (isset($_POST['hapus'])) {
    foreach ($_POST['pilih'] as $id) {
        mysqli_query($conn, "DELETE FROM task_history WHERE id = '$id'");
        echo "<script>
        alert('History Berhasil Dihapus')
        document.location.href = 'history.php'
        </script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List | History</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <h1>History</h1>
        <button class="home-button" onclick="document.location.href = 'index.php'">Back</button>
        <table>
            <thead>
                <tr>

                    <th>
                        <?php if (isset($_GET['Semua'])): ?>
                            <input type="checkbox" onclick="document.location.href = '?Pilih'" checked>
                        <?php elseif (isset($_GET['Pilih'])): ?>
                            <input type="checkbox" onclick="document.location.href = '?Semua'">
                        <?php else: ?>
                            <input type="checkbox" onclick="document.location.href = '?Semua'">
                        <?php endif ?>
                    </th>

                    <td>No</td>
                    <td>Nama Tugas</td>
                    <td>Status</td>
                    <td>Prioritas</td>
                    <td>Tanggal</td>
                    <td>Action</td>
                    <td>Waktu</td>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($history)): ?>
                    <tr>
                        <th colspan="10">No History</th>
                    </tr>
                <?php else: ?>
                    <form action="" method="post">
                        <?php $no = 1 ?>
                        <?php foreach ($history as $data): ?>
                            <tr>

                                <td>
                                    <?php if (isset($_GET['Semua'])): ?>
                                        <input type="checkbox" name="pilih[]" value="<?= $data['id'] ?>" checked>
                                    <?php elseif (isset($_GET['Pilih'])): ?>
                                        <input type="checkbox" name="pilih[]" value="<?= $data['id'] ?>">
                                    <?php else: ?>
                                        <input type="checkbox" name="pilih[]" value="<?= $data['id'] ?>">
                                    <?php endif ?>
                                </td>

                                <td><?= $no++ ?></td>
                                <td><?= $data['task_name'] ?></td>
                                <td><?= $data['status'] ?></td>
                                <td><?= $data['priority'] ?></td>
                                <td><?= $data['due_date'] ?></td>
                                <td><?= $data['action'] ?></td>
                                <td><?= $data['time'] ?></td>
                            </tr>
                        <?php endforeach ?>
                        <button type="submit" name="hapus" class="delete-button">Delete</button>
                    </form>
                <?php endif ?>
            </tbody>
        </table>
    </div>
</body>

</html>