<?php
require 'function.php';

$id = $_GET['id'];
if (DeleteTask($id) > 0) {
    echo "<script>
    alert('Berhasil Menghapus Tugas')
    document.location.href = 'index.php'
    </script>";
} else {
    echo "<script>
    alert('Gagal Menghapus Tugas')
    document.location.href = 'index.php'
    </script>";
}
