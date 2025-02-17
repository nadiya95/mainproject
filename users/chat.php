<?php
session_start();

// Fetching user and receiver details
$receiver_id = isset($_GET['user_id']) ? intval($_GET['user_id']) : 0;
include('../config/db.php');
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$receiver_query = "SELECT * FROM user WHERE user_id = $receiver_id";
$receiver_result = mysqli_query($conn, $receiver_query);
if (mysqli_num_rows($receiver_result) > 0) {
    $receiver = mysqli_fetch_assoc($receiver_result);
} else {
    echo "User with ID $receiver_id not found.";
    exit;
}
$sender = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat with <?php echo htmlspecialchars($receiver['username']); ?></title>
    <link rel="stylesheet" href="../css/chat.css">
    
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f1f1f1;
            margin: 0;
            padding: 0;
        }

        .chat-container {
            max-width: 800px;
            margin: 30px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
        }

        .chat-box {
            max-height: 500px;
            overflow-y: auto;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 10px;
            margin-bottom: 10px;
            background-color: #ffffff;
            position: relative;
        }

        .message {
            margin: 5px 0;
            padding: 10px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-direction: column; /* Stack items vertically */
        }

        .message.sent {
            background-color: #c06169;
            color: white;
            align-self: flex-end;
            margin-left: 50px;
        }

        .message.received {
            background-color: #e9e9e9;
            align-self: flex-start;
            margin-right: 50px;
        }

        .message .message-content {
            flex-grow: 1;
            padding: 10px;
            display: flex; /* Use flex to arrange items horizontally */
            align-items: center; /* Center items vertically */
            flex-direction: column; /* Stack elements vertically */
        }

        .timestamp {
            font-size: 0.8em;
            color: black;
            margin-bottom: 5px; /* Add space below the timestamp */
        }

        .delete-icon {
            color: red; /* Change to red for sent messages */
            cursor: pointer;
            font-size: 1.2em; /* Adjust size to make it more noticeable */
            transition: color 0.3s; /* Smooth color change on hover */
            margin-left: 10px; /* Add margin for spacing */
        }

        .delete-icon:hover {
            color: #a05259; /* Change color on hover for better visibility */
        }

        .message-form {
            display: flex;
            gap: 10px;
        }

        .message-form input {
            flex-grow: 1;
            padding: 10px;
            border-radius: 20px;
            border: 1px solid #ccc;
            outline: none;
            transition: border 0.3s;
        }

        .message-form input:focus {
            border: 1px solid #c06169;
        }

        .message-form button {
            padding: 10px 20px;
            background-color: #c06169;
            color: white;
            border: none;
            border-radius: 20px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .message-form button:hover {
            background-color: #a05259;
        }
    </style>
</head>
<body>

<div class="chat-container">
    <h2>Chat with <?php echo htmlspecialchars($receiver['username']); ?></h2>

    <!-- Chat box -->
    <div id="chat-box" class="chat-box">
        <!-- Messages will be loaded here dynamically -->
    </div>

    <form id="message-form" class="message-form" method="POST">
        <input type="text" id="message-input" placeholder="Type a message..." required>
        <button type="submit">Send</button>
    </form>
</div>
<script type="module">
    import { initializeApp } from "https://www.gstatic.com/firebasejs/9.1.0/firebase-app.js";
    import { getDatabase, ref, set, push, onChildAdded, remove } from "https://www.gstatic.com/firebasejs/9.1.0/firebase-database.js";
    
    const firebaseConfig = {
        apiKey: "YOUR API",
        authDomain: "vows-12f52.firebaseapp.com",
        databaseURL: "https://vows-12f52-default-rtdb.asia-southeast1.firebasedatabase.app/",
        projectId: "vows-12f52",
        storageBucket: "vows-12f52.appspot.com",
        messagingSenderId: "39753854321",
        appId: "1:39753854321:web:d33b2710c3f48be7c75ad0",
        measurementId: "G-VD4M6SN9JV"
    };

    // Initialize Firebase
    const app = initializeApp(firebaseConfig);
    const database = getDatabase(app);

    const chatBox = document.getElementById('chat-box');
    const messageForm = document.getElementById('message-form');
    const messageInput = document.getElementById('message-input');
    const sender = "<?php echo addslashes($sender); ?>";
    const receiver = "<?php echo addslashes($receiver['username']); ?>";

    // Send message
    messageForm.addEventListener('submit', (e) => {
        e.preventDefault();

        const message = messageInput.value.trim();
        if (message) {
            const timestamp = new Date().toISOString();
            const chatRefSender = ref(database, 'chats/' + sender + '_' + receiver);
            const chatRefReceiver = ref(database, 'chats/' + receiver + '_' + sender); // Added this reference for receiver

            // Message data to store
            const messageData = {
                sender: sender,
                receiver: receiver,
                message: message,
                timestamp: timestamp
            };

            // Push to both sender and receiver chat references
            push(chatRefSender, messageData)
                .then(() => push(chatRefReceiver, messageData)) // Store in receiver's reference
                .then(() => {
                    console.log('Message sent to both sender and receiver:', message);
                    messageInput.value = ''; // Clear input after sending
                })
                .catch((error) => console.error('Error sending message:', error));
        }
    });

    // Load messages from both sender's and receiver's references
    function loadMessages() {
        const chatRef = ref(database, 'chats/' + sender + '_' + receiver); // Only use one reference

        // Use a Set to track message keys and prevent duplicates
        const displayedMessages = new Set();

        // Listen to messages from the sender's reference
        onChildAdded(chatRef, (snapshot) => {
            if (!displayedMessages.has(snapshot.key)) {
                displayMessage(snapshot);
                displayedMessages.add(snapshot.key);
            }
        });
    }

    // Display message in the chat window
    function displayMessage(snapshot) {
        const messageData = snapshot.val();
        const messageDiv = document.createElement('div');
        messageDiv.classList.add('message');

        const timestamp = new Date(messageData.timestamp).toLocaleString(); // Format timestamp

        if (messageData.sender === sender) {
            messageDiv.classList.add('sent');
            messageDiv.innerHTML = `
                <div class="message-content">
                    <span class="timestamp">${timestamp}</span>
                    <i class="fas fa-trash delete-icon" data-id="${snapshot.key}"></i>
                    <p><strong>${messageData.sender}:</strong> ${messageData.message}</p>
                </div>
            `;
        } else {
            messageDiv.classList.add('received');
            messageDiv.innerHTML = `
                <div class="message-content">
                    <span class="timestamp">${timestamp}</span>
                    <p><strong>${messageData.sender}:</strong> ${messageData.message}</p>
                    <i class="fas fa-trash delete-icon" data-id="${snapshot.key}"></i>
                </div>
            `;
        }

        chatBox.appendChild(messageDiv);
        chatBox.scrollTop = chatBox.scrollHeight; // Scroll to the bottom

        // Add event listener to delete icon for deleting messages
        const deleteIcon = messageDiv.querySelector('.delete-icon');
        deleteIcon.addEventListener('click', () => deleteMessage(snapshot.key));
    }

    // Delete message function
    function deleteMessage(messageKey) {
        if (confirm('Are you sure you want to delete this message?')) {
            const chatRefSender = ref(database, 'chats/' + sender + '_' + receiver + '/' + messageKey);
            const chatRefReceiver = ref(database, 'chats/' + receiver + '_' + sender + '/' + messageKey); // Added this reference for receiver

            // Remove message from both sender and receiver chat
            remove(chatRefSender)
                .then(() => remove(chatRefReceiver)) // Also remove from receiver's reference
                .then(() => {
                    console.log('Message deleted');
                    const messageDiv = document.querySelector(`.delete-icon[data-id="${messageKey}"]`).closest('.message');
                    messageDiv.remove(); // Remove message from the chat box
                })
                .catch((error) => console.error('Error deleting message:', error));
        }
    }

    // Load messages on page load
    loadMessages(); // Ensure this is called only once
</script>
</body>
</html>
