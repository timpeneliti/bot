<?php
include 'db_config.php'; // Include database configuration

// Fetch user input from AJAX request
$userInput = isset($_POST['user_input']) ? $_POST['user_input'] : "";

// Default bot response
$defaultBotResponse = "I'm sorry, I don't understand.";

// Prepare SQL statement to fetch bot response based on user input
$query = "SELECT bot_response FROM chat_history WHERE user_message = ?";
$stmt = $conn->prepare($query);

// Bind parameter to the SQL statement
$stmt->bind_param("s", $userInput);

// Execute the prepared statement
$stmt->execute();

// Bind result variables
$stmt->bind_result($botResponse);

// Fetch the result
if ($stmt->fetch()) {
    echo $botResponse; // Echo fetched bot response for AJAX response
} else {
    echo $defaultBotResponse; // Echo default bot response if no match found
}

// Close the prepared statement and database connection
$stmt->close();
$conn->close();
?>
