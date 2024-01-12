<?php
include 'dbConnect.php'; // Stellt die Verbindung zur Datenbank her

// Prüfen, ob ein Chatroom-ID übergeben wurde
if (isset($_GET['chatroom_id'])) {
    $chatroom_id = $_GET['chatroom_id'];

    // SQL-Query, um Nachrichten des spezifischen Chatrooms abzurufen
    $sql = "SELECT m.*, u.username FROM messages m 
            INNER JOIN Benutzer u ON m.user_id = u.UserID 
            WHERE m.chatroom_id = ? 
            ORDER BY m.sent_time ASC";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $chatroom_id);
    $stmt->execute();
    
    $result = $stmt->get_result();
    $messages = array();

    // Nachrichten in ein Array einlesen
    while ($row = $result->fetch_assoc()) {
        $messages[] = $row;
    }

    // Array als JSON zurückgeben
    echo json_encode($messages);

    $stmt->close();
} else {
    echo "Keine Chatroom-ID angegeben.";
}

$conn->close();
?>
