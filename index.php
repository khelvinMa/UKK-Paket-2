<?php
require 'function.php';

$task = GetTask("SELECT * FROM task ORDER BY due_date DESC ,priority DESC ");

if (isset($_POST['cari'])) {
    $task = SearchTask($_POST['task_name'] . $_POST['status'] . $_POST['priority']);
}

$date = [];
foreach ($task as $data) {
    $date[$data['due_date']][] = $data;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List | Home</title>
    <link rel="stylesheet" href="style.css">

<body>
    <div class="container">
        <h1>To-Do List</h1>
        <button class="add-button" onclick="document.location.href = 'tambah.php'">Tambah Tugas</button>
        <form action="" method="post" class="search-form">
            <input type="text" name="task_name" autocomplete="off" placeholder="Cari Tugas...">

            <select name="status">
                <option value="">-- Pilih Status --</option>
                <option value="not started">not started</option>
                <option value="in progress">in progress</option>
                <option value="postponed">postponed</option>
                <option value="cancelled">cancelled</option>
            </select>

            <select name="priority">
                <option value="">-- Pilih Prioritas --</option>
                <option value="Rendah">Rendah</option>
                <option value="Sedang">Sedang</option>
                <option value="Tinggi">Tinggi</option>
            </select>

            <button type="submit" name="cari" class="search-button">Cari</button>
        </form>
        <button class="history-button" onclick="document.location.href = 'history.php'">History</button>

        <table>
            <thead>
                <th colspan="10">
                    <h1>Daftar Tugas</h1>
                </th>
                <tr>
                    <th>Nama Tugas</th>
                    <th>Status</th>
                    <th>Prioritas</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($task)): ?>
                    <tr>
                        <th colspan="10">No Task</th>
                    </tr>
                <?php else: ?>
                    <?php foreach ($date as $due_date => $tasks): ?>
                        <tr>
                            <th colspan="10"><?= $due_date ?></th>

                        </tr>
                        <?php foreach ($tasks as $data): ?>
                            <tr>
                                <td><?= $data['task_name'] ?></td>
                                <td><?= $data['status'] ?></td>
                                <td><?= $data['priority'] ?></td>
                                <td><?= $data['due_date'] ?></td>

                                <td><button class="edit-button" onclick="document.location.href = 'edit.php?id=<?= $data['id'] ?>'"><img src="pencil-square.svg" alt=""> | Update</button>
                                    <button class="delete-button" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Tugas Ini?') , document.location.href = 'hapus.php?id=<?= $data['id'] ?>'"><img src="trash.svg" alt=""> | Delete</button>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    <?php endforeach ?>
                <?php endif ?>
            </tbody>
        </table>
    </div>
</body>

</html>