<?php
$conn = mysqli_connect("localhost", "root", "", "ukk_paket_2");

function GetTask($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function AddTask($data)
{
    global $conn;
    $task_name = htmlspecialchars($data['task_name']);
    $status = htmlspecialchars($data['status']);
    $priority = htmlspecialchars($data['priority']);
    $due_date = htmlspecialchars($data['due_date']);

    if ($status == "") {
        echo "<script>
        alert('Silakan Pilih Status Terlebih Dahulu')
        </script>";
        return false;
    } elseif ($priority == "") {
        echo "<script>
        alert('Silakan Pilih Prioritas Terlebih Dahulu')
        </script>";
        return false;
    }

    mysqli_query($conn, "INSERT INTO task_history(task_name,status,priority,due_date,action) VALUES('$task_name','$status','$priority','$due_date','Added')");

    $AddQuery =  "INSERT INTO task(task_name,status,priority,due_date) VALUES('$task_name','$status','$priority','$due_date')";
    mysqli_query($conn, $AddQuery);
    return mysqli_affected_rows($conn);
}

function EditTask($data)
{
    global $conn;
    $id = $_GET['id'];
    $task_name = htmlspecialchars($data['task_name']);
    $status = htmlspecialchars($data['status']);
    $priority = htmlspecialchars($data['priority']);
    $due_date = htmlspecialchars($data['due_date']);

    if ($status == "") {
        echo "<script>
        alert('Silakan Pilih Status Terlebih Dahulu')
        </script>";
        return false;
    } elseif ($priority == "") {
        echo "<script>
        alert('Silakan Pilih Prioritas Terlebih Dahulu')
        </script>";
        return false;
    }

    mysqli_query($conn, "INSERT INTO task_history(task_id,task_name,status,priority,due_date,action) VALUES('$id','$task_name','$status','$priority','$due_date','Edited')");

    $EditQuery = "UPDATE task SET
    task_name = '$task_name',
    status = '$status',
    priority = '$priority',
    due_date = '$due_date'
    WHERE id = '$id'";
    mysqli_query($conn, $EditQuery);
    return mysqli_affected_rows($conn);
}

function DeleteTask($data)
{
    global $conn;
    $id = $_GET['id'];
    $data = GetTask("SELECT * FROM task WHERE id = '$id'")[0];
    $task_name = htmlspecialchars($data['task_name']);
    $status = htmlspecialchars($data['status']);
    $priority = htmlspecialchars($data['priority']);
    $due_date = htmlspecialchars($data['due_date']);

    mysqli_query($conn, "INSERT INTO task_history(task_id,task_name,status,priority,due_date,action) VALUES('$id','$task_name','$status','$priority','$due_date','Deleted')");

    $DeleteQuery = "DELETE FROM task WHERE id = '$id'";
    mysqli_query($conn, $DeleteQuery);
    return mysqli_affected_rows($conn);
}

function SearchTask($data)
{
    $SearchTask = "SELECT * FROM task WHERE
    task_name LIKE '%$data%' OR
    status LIKE '$data%' OR
    priority LIKE '%$data%'";
    return GetTask($SearchTask);
}
