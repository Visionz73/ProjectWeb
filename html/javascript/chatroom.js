function loadChatrooms() {
    fetch('getChatrooms.php')
    .then(response => response.json())
    .then(chatrooms => {
        const list = document.getElementById('chatroomList');
        chatrooms.forEach(chatroom => {
            const listItem = document.createElement('li');
            listItem.textContent = chatroom.name;
            listItem.addEventListener('click', () => enterChatroom(chatroom.id));
            list.appendChild(listItem);
        });
    })
    .catch(error => console.error('Fehler beim Laden der Chatrooms:', error));
}

function enterChatroom(chatroomId) {
    // Hier können Sie die Logik implementieren, um einen Chatroom zu betreten.
    // Zum Beispiel könnte dies das Laden der Chatroom-Seite oder das Anzeigen von Nachrichten sein.
    console.log("Chatroom betreten mit ID:", chatroomId);
}
