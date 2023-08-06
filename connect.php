<?php
// Koneksi ke database MySQL
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'dbbengkel';
$connection = new mysqli($host, $user, $password, $database);

// Cek koneksi
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Set header respons ke JSON
header('Content-Type: application/json');

// GET /tbbengkel/{id}
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $id = $_GET['id'];
    $query = "SELECT * FROM tbbengkel WHERE id = $id";
    $result = $connection->query($query);
    
    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
        echo json_encode($data);
    } else {
        echo json_encode(array('message' => 'Data not found'));
    }
}

// GET /tbbengkel/all
if ($_SERVER['REQUEST_METHOD'] === 'GET' && empty($_GET['id'])) {
    $query = "SELECT * FROM tbbengkel";
    $result = $connection->query($query);
    
    if ($result->num_rows > 0) {
        $data = array();
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        echo json_encode($data);
    } else {
        echo json_encode(array());
    }
}

// POST /tbbengkel
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $query = "INSERT INTO tbbengkel (username, password, role) VALUES ('$username', '$password', '$role')";
    if ($connection->query($query) === TRUE) {
        echo json_encode(array('message' => 'Data added successfully'));
    } else {
        echo json_encode(array('message' => 'Failed to add data'));
    }
}

// PUT /tbbengkel/{id}
if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $id = $_GET['id'];
    $username = $_PUT['username'];
    $password = $_PUT['password'];
    $role = $_PUT['role'];

    $query = "UPDATE tbbengkel SET username = '$username', password = '$password', role = '$role' WHERE id = $id";
    if ($connection->query($query) === TRUE) {
        echo json_encode(array('message' => 'Data updated successfully'));
    } else {
        echo json_encode(array('message' => 'Failed to update data'));
    }
}

// DELETE /tbbengkel/{id}
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $id = $_GET['id'];

    $query = "DELETE FROM tbbengkel WHERE id = $id";
    if ($connection->query($query) === TRUE) {
        echo json_encode(array('message' => 'Data deleted successfully'));
    } else {
        echo json_encode(array('message' => 'Failed to delete data'));
    }
}

// Tutup koneksi database
$connection->close();
?>
