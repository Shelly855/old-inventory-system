<?php
$current_page = 'communications'; // Set current page to communications for this page
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Communications</title>
    <link rel="stylesheet" href="css/styles.css"> <!-- Main styles -->
    <link rel="stylesheet" href="css/communications.css"> <!-- Communications page styles -->
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
</head>
<body>
    <!-- header -->
    <header>
        <div class="logo">
            <img src="images/Screenshot 2024-11-05 162943.png" alt="Logo">
        </div>
    </header>

    <!-- vertical navbar -->
    <nav class="vertical-navbar">
        <ul>
            <li><a href="manager_dashboard.php" class="<?php echo ($current_page == 'dashboard') ? 'active' : ''; ?>"><box-icon name='dashboard' type='solid'></box-icon>Dashboard ></a></li>
            <li><a href="inventory/inventory.php" class="<?php echo ($current_page == 'inventory') ? 'active' : ''; ?>"><box-icon name='table'></box-icon>Inventory ></a></li>
            <li><a href="manage_orders.php" class="<?php echo ($current_page == 'manage_orders') ? 'active' : ''; ?>"><box-icon name='package' type='solid'></box-icon>Manage Orders ></a></li>
            <li><a href="communications.php" class="<?php echo ($current_page == 'communications') ? 'active' : ''; ?>"><box-icon name='chat' type='solid'></box-icon>Communicate ></a></li>
            <li><a href="settings.php" class="<?php echo ($current_page == 'settings') ? 'active' : ''; ?>"><box-icon name='cog'></box-icon>Settings ></a></li>
            <li><a href="login.php" class="<?php echo ($current_page == 'login') ? 'active' : ''; ?>"><box-icon name='log-out-circle'></box-icon>Logout ></a></li>
        </ul>
    </nav>

    <!-- main content -->
    <main>
        <h1>Communications</h1>

        <!-- Chatbox / Email Section -->
        <section class="communications-box">
            <div class="messages">
                <!-- Received Message -->
                <div class="message received">
                    <div class="message-content">
                        <p><strong>Admin</strong>: Please update the stock levels for the following products.</p>
                        <span class="timestamp">10:30 AM</span>
                    </div>
                </div>

                <!-- Sent Message -->
                <div class="message sent">
                    <div class="message-content">
                        <p><strong>Manager</strong>: Noted. I'll handle it shortly.</p>
                        <span class="timestamp">10:32 AM</span>
                    </div>
                </div>

                <!-- Received Message -->
                <div class="message received">
                    <div class="message-content">
                        <p><strong>Admin</strong>: Also, please review the upcoming orders for approval.</p>
                        <span class="timestamp">10:35 AM</span>
                    </div>
                </div>
            </div>

            <!-- Message Input Area -->
            <div class="compose-message">
                <textarea id="messageInput" placeholder="Write your message..."></textarea>
                <button id="sendMessageBtn" class="btn">Send</button>
            </div>
        </section>

    </main>

    <script>
        // Dummy chat sending functionality
        document.getElementById("sendMessageBtn").addEventListener("click", function() {
            const messageInput = document.getElementById("messageInput");
            const messageText = messageInput.value;

            if (messageText.trim()) {
                const messageContainer = document.createElement('div');
                messageContainer.classList.add('message', 'sent');
                messageContainer.innerHTML = `
                    <div class="message-content">
                        <p><strong>Manager</strong>: ${messageText}</p>
                        <span class="timestamp">Just Now</span>
                    </div>
                `;
                document.querySelector('.messages').appendChild(messageContainer);
                messageInput.value = ''; // Clear input field
            }
        });
    </script>
</body>
</html>
