<?php
include 'dbConnect.php'; // Stellt die Verbindung zur Datenbank her

// Prüfen, ob die Anfrage vom Typ POST ist
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Annahme: $user_id und $chatroom_id werden durch eine Session oder ähnliches gesetzt.
    // Diese müssen entsprechend Ihrer Anwendung angepasst werden.
    session_start();
    $user_id = $_SESSION['user_id'] ?? null;
    $chatroom_id = $_SESSION['chatroom_id'] ?? null;
    $message_text = $_POST['message'] ?? ''; // 'message' entspricht dem Schlüssel, der im JavaScript verwendet wird

    // Überprüfen Sie, ob alle erforderlichen Daten vorhanden sind
    if ($user_id === null || $chatroom_id === null || empty($message_text)) {
        echo "Fehler: Nicht alle Daten wurden übermittelt.";
        exit;
    }

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
} else {
    echo "Fehler: Anfrage muss vom Typ POST sein.";
}

$conn->close();
?>
