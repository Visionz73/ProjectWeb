<?php
include 'dbConnect.php'; // Stellt die Verbindung zur Datenbank her

$sql = "SELECT id, name, description FROM chatrooms";
$result = $conn->query($sql);

$chatrooms = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $chatrooms[] = $row;
    }
    echo json_encode($chatrooms);
} else {
    echo "Keine Chatrooms gefunden.";
}

$conn->close();
?>
