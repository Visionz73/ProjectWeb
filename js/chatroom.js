function loadChatrooms() {
    fetch('../PHP/getChatrooms.php') // Angepasster Pfad, der von `js` zu `PHP` wechselt
    .then(response => response.json())
    .then(chatrooms => {
        const list = document.getElementById('chatroomList');
        chatrooms.forEach(chatroom => {
            const listItem = document.createElement('li');
            listItem.textContent = chatroom.name;
            listItem.classList.add('chatroom-item'); // Eine Klasse für CSS-Styling
            listItem.setAttribute('data-chatroom-id', chatroom.id); // Datenattribut für die Chatroom-ID
            listItem.addEventListener('click', () => enterChatroom(chatroom.id));
            list.appendChild(listItem);
        });
    })
    .catch(error => console.error('Fehler beim Laden der Chatrooms:', error));
}

function enterChatroom(chatroomId) {
    // Logik zum Betreten eines Chatrooms, z.B. Weiterleitung oder Anzeigen von Nachrichten
    console.log("Chatroom betreten mit ID:", chatroomId);
    // Weiterleitung zum Chatroom könnte hier durchgeführt werden
}
