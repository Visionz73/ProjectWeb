// Funktion zum Senden einer Nachricht
function sendMessage(message) {
    // Annahme: Die user_id und chatroom_id sollten auf der Client-Seite verfügbar sein,
    // entweder durch Einloggen, eine Session oder sie sind fest in das Skript eingebettet.
    // Hier sind sie als Platzhalter hartcodiert.
    const userId = 1; // Dies sollte die tatsächliche Benutzer-ID des eingeloggten Benutzers sein
    const chatroomId = 1; // Dies sollte die tatsächliche Chatroom-ID sein, in der sich der Benutzer befindet

    // Verwenden von FormData, um die POST-Daten einfach zu handhaben
    const formData = new FormData();
    formData.append('user_id', userId);
    formData.append('chatroom_id', chatroomId);
    formData.append('message_text', message);

    fetch('../PHP/sendMessage.php', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Netzwerkantwort war nicht ok.');
        }
        return response.text();
    })
    .then(data => {
        console.log(data);
        // Fügen Sie die Nachricht zum 'messagesContainer' hinzu
        displayMessage(message);
        // Feld nach dem Senden leeren
        document.getElementById('messageInput').value = '';
    })
    .catch(error => console.error('Fehler beim Senden der Nachricht:', error));
}

// Funktion zum Anzeigen der Nachricht im Chat
function displayMessage(message) {
    const messagesContainer = document.getElementById('messagesContainer');
    const messageDiv = document.createElement('div');
    messageDiv.classList.add('message');
    messageDiv.textContent = message;
    messagesContainer.appendChild(messageDiv);
    // Scrollen Sie zum neuesten Nachrichtenelement
    messageDiv.scrollIntoView();
}

// Event Listener für das Nachrichtenformular
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('messageForm').addEventListener('submit', function(event) {
        event.preventDefault();
        const messageInput = document.getElementById('messageInput');
        const message = messageInput.value;
        // Senden Sie die Nachricht
        sendMessage(message);
    });
});
