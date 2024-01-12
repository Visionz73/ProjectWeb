<?php
include 'dbConnect.php'; // Stellt die Verbindung zur Datenbank her

// Prüfen, ob die Anfrage vom Typ POST ist
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Extrahieren der Daten aus dem POST-Request
    $user_id = $_POST['user_id'];
    $chatroom_id = $_POST['chatroom_id'];
    $message_text = $_POST['message_text'];

    // Vorbereiten des SQL-Statements
    $sql = "INSERT INTO messages (user_id, chatroom_id, message_text) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);

    // Binden der Parameter an das vorbereitete Statement
    $stmt->bind_param("iis", $user_id, $chatroom_id, $message_text);

    // Ausführen des Statements
    if ($stmt->execute()) {
        echo "Nachricht erfolgreich gesendet.";
    } else {
        echo "Fehler: " . $stmt->error;
    }

    // Schließen des Statements und der Verbindung
    $stmt->close();
}

$conn->close();
?>
