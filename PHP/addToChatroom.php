<?php
include 'dbConnect.php'; // Stellt die Verbindung zur Datenbank her

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST['user_id']; // Die UserID des Benutzers
    $chatroom_id = $_POST['chatroom_id']; // Die ID des Chatrooms

    // SQL-Query zum Hinzufügen des Benutzers zum Chatroom
    $sql = "INSERT INTO user_chatroom (user_id, chatroom_id) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $user_id, $chatroom_id);

    if ($stmt->execute()) {
        echo "Benutzer erfolgreich zum Chatroom hinzugefügt.";
    } else {
        echo "Fehler: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
