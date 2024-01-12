<?php
include 'dbConnect.php'; // Stellt die Verbindung zur Datenbank her

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name']; // Der Name des Chatrooms
    $description = $_POST['description']; // Die Beschreibung des Chatrooms

    // SQL-Query zum Einfügen des neuen Chatrooms
    $sql = "INSERT INTO chatrooms (name, description) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $name, $description);

    if ($stmt->execute()) {
        echo "Chatroom erfolgreich erstellt.";
    } else {
        echo "Fehler: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
